<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Matakuliah;
use App\Models\Dosen;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwal = Jadwal::with(['matakuliah', 'dosen'])->get();
        return view('admin.jadwal.index', compact('jadwal'));
    }

    public function create()
    {
        $matakuliah = Matakuliah::all();
        $dosen = Dosen::all();

        return view('admin.jadwal.create', compact('matakuliah', 'dosen'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_matakuliah' => 'required',
            'nidn'            => 'required',
            'kelas'           => 'required|string',
            'hari'            => 'required|string',
            'jam'             => 'required',
        ]);

        Jadwal::create([
            'kode_matakuliah' => $request->kode_matakuliah,
            'nidn'            => $request->nidn,
            'kelas'           => strtoupper($request->kelas),
            'hari'            => $request->hari,
            'jam'             => $request->jam,
        ]);

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal baru berhasil diterbitkan.');
    }

    public function destroy($id)
    {
        Jadwal::findOrFail($id)->delete();
        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}
