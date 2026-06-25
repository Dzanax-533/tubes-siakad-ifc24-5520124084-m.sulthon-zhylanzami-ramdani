<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MahasiswaDashboardController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        $jadwalTersedia = Jadwal::with(['matakuliah', 'dosen'])->get();
        $krsTerpilih = collect();
        $totalSks = 0;

        $mahasiswa = Mahasiswa::with('dosen')->where('nama', $user->name)->first();

        if (!$mahasiswa) {
            return view('mahasiswa.dashboard', [
                'jadwalTersedia' => $jadwalTersedia,
                'krsTerpilih'    => $krsTerpilih,
                'totalSks'       => $totalSks,
                'error_profil'   => 'Profil akademik untuk akun "' . $user->name . '" belum didaftarkan oleh Admin. Pastikan nama lengkap Anda di menu Master Mahasiswa sudah diinput sama persis dengan nama akun login ini.'
            ]);
        }

        $krsTerpilih = DB::table('krs_mahasiswa')
            ->join('jadwal', 'krs_mahasiswa.jadwal_id', '=', 'jadwal.id')
            ->join('matakuliah', 'jadwal.kode_matakuliah', '=', 'matakuliah.kode_matakuliah')
            ->join('dosen', 'jadwal.nidn', '=', 'dosen.nidn')
            ->where('krs_mahasiswa.npm', $mahasiswa->npm)
            ->select('jadwal.*', 'matakuliah.nama_matakuliah', 'matakuliah.sks', 'dosen.nama as nama_dosen')
            ->get();

        $totalSks = $krsTerpilih->sum('sks');

        return view('mahasiswa.dashboard', compact('mahasiswa', 'jadwalTersedia', 'krsTerpilih', 'totalSks'));
    }

    public function isiKrs(Request $request)
    {
        $request->validate([
            'jadwal_id' => 'required',
            'npm'       => 'required',
        ]);

        $sudahDiambil = DB::table('krs_mahasiswa')
            ->where('npm', $request->npm)
            ->where('jadwal_id', $request->jadwal_id)
            ->exists();

        if ($sudahDiambil) {
            return redirect()->back()->with('error', 'Mata kuliah dengan jadwal tersebut sudah ada di KRS Anda.');
        }

        $jadwalBaru = Jadwal::with('matakuliah')->find($request->jadwal_id);
        $sksBaru = $jadwalBaru->matakuliah->sks;

        $currentKrs = DB::table('krs_mahasiswa')
            ->join('jadwal', 'krs_mahasiswa.jadwal_id', '=', 'jadwal.id')
            ->join('matakuliah', 'jadwal.kode_matakuliah', '=', 'matakuliah.kode_matakuliah')
            ->where('krs_mahasiswa.npm', $request->npm)
            ->sum('matakuliah.sks');

        if (($currentKrs + $sksBaru) > 24) {
            return redirect()->back()->with('error', 'Gagal ambil! Batas beban studi maksimal semester ini adalah 24 SKS.');
        }

        DB::table('krs_mahasiswa')->insert([
            'npm'        => $request->npm,
            'jadwal_id'  => $request->jadwal_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Mata kuliah berhasil ditambahkan ke rencana studi.');
    }

    public function dropKrs(Request $request)
    {
        DB::table('krs_mahasiswa')
            ->where('npm', $request->npm)
            ->where('jadwal_id', $request->jadwal_id)
            ->delete();

        return redirect()->back()->with('success', 'Mata kuliah berhasil dibatalkan dari KRS.');
    }
}
