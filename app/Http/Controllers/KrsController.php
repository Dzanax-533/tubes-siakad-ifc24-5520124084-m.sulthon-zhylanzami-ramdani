<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use App\Models\Jadwal;
use App\Models\Krs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KrsController extends Controller
{

    public function index()
    {
        $mahasiswa = Mahasiswa::where('nama', Auth::user()->name)->first();

        if (!$mahasiswa) {
            return view('mahasiswa.dashboard_empty');
        }

        $krsDiambil = $mahasiswa->matakuliah;
        $kodeKrsDiambil = $krsDiambil->pluck('kode_matakuliah')->toArray();

        $matakuliahTersedia = Matakuliah::whereNotIn('kode_matakuliah', $kodeKrsDiambil)->get();

        $jadwalKuliah = Jadwal::with(['dosen', 'matakuliah'])
            ->whereIn('kode_matakuliah', $kodeKrsDiambil)
            ->get();

        return view('mahasiswa.dashboard', compact('mahasiswa', 'krsDiambil', 'matakuliahTersedia', 'jadwalKuliah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_matakuliah' => 'required|exists:matakuliah,kode_matakuliah',
        ], [
            'kode_matakuliah.required' => 'Mata kuliah harus dipilih.',
            'kode_matakuliah.exists'   => 'Mata kuliah tidak valid di sistem.',
        ]);

        $mahasiswa = Mahasiswa::where('nama', Auth::user()->name)->firstOrFail();

        $sudahAmbil = Krs::where('npm', $mahasiswa->npm)
            ->where('kode_matakuliah', $request->kode_matakuliah)
            ->exists();

        if ($sudahAmbil) {
            return redirect()->back()->with('error', 'Mata kuliah ini sudah ada di Kartu Rencana Studi Anda.');
        }

        Krs::create([
            'npm' => $mahasiswa->npm,
            'kode_matakuliah' => $request->kode_matakuliah,
        ]);

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Mata kuliah berhasil ditambahkan ke KRS.');
    }

    public function destroy($kode_matakuliah)
    {
        $mahasiswa = Mahasiswa::where('nama', Auth::user()->name)->firstOrFail();

        Krs::where('npm', $mahasiswa->npm)
            ->where('kode_matakuliah', $kode_matakuliah)
            ->delete();

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Mata kuliah berhasil dihapus dari KRS.');
    }
}
