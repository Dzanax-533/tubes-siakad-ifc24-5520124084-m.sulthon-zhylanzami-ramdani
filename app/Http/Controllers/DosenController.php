<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{

    public function index()
    {
        $dosen = Dosen::all();
        return view('admin.dosen.index', compact('dosen'));
    }

    public function create()
    {
        return view('admin.dosen.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nidn' => 'required|regex:/^[0-9]+$/|size:10|unique:dosen,nidn',
            'nama' => 'required|string|max:50',
        ], [
            'nidn.required' => 'NIDN wajib diisi.',
            'nidn.regex'    => 'NIDN harus berupa angka murni tanpa spasi atau simbol.',
            'nidn.size'     => 'NIDN harus tepat berukuran 10 digit.',
            'nidn.unique'   => 'NIDN ini sudah terdaftar di sistem.',
            'nama.required' => 'Nama dosen wajib diisi.',
            'nama.max'      => 'Nama dosen maksimal 50 karakter.',
        ]);

        Dosen::create([
            'nidn' => $request->nidn,
            'nama' => $request->nama,
        ]);

        return redirect()->route('admin.dosen.index')->with('success', 'Data Master Dosen berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $dosen = Dosen::findOrFail($id);
        return view('admin.dosen.edit', compact('dosen'));
    }

    public function update(Request $request, $id)
    {
        $dosen = Dosen::findOrFail($id);

        $request->validate([
            'nidn' => 'required|regex:/^[0-9]+$/|size:10|unique:dosen,nidn,' . $dosen->nidn . ',nidn',
            'nama' => 'required|string|max:50',
        ], [
            'nidn.required' => 'NIDN wajib diisi.',
            'nidn.regex'    => 'NIDN harus berupa angka murni.',
            'nidn.size'     => 'NIDN harus tepat 10 digit.',
            'nidn.unique'   => 'NIDN ini sudah digunakan oleh dosen lain.',
            'nama.required' => 'Nama dosen wajib diisi.',
            'nama.max'      => 'Nama dosen maksimal 50 karakter.',
        ]);

        $dosen->update([
            'nidn' => $request->nidn,
            'nama' => $request->nama,
        ]);

        return redirect()->route('admin.dosen.index')->with('success', 'Data Dosen berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $dosen = Dosen::findOrFail($id);

        try {
            $dosen->delete();
            return redirect()->route('admin.dosen.index')->with('success', 'Data Dosen berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('admin.dosen.index')->with('error', 'Gagal dihapus! Data dosen ini sedang digunakan pada modul mahasiswa atau jadwal perkuliahan.');
        }
    }
}
