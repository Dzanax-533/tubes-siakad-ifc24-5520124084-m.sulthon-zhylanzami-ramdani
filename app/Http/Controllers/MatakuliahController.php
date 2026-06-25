<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{

    public function index()
    {
        $matakuliah = Matakuliah::all();
        return view('admin.matakuliah.index', compact('matakuliah'));
    }

    public function create()
    {
        return view('admin.matakuliah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_matakuliah' => 'required|string|max:8|unique:matakuliah,kode_matakuliah',
            'nama_matakuliah' => 'required|string|max:50',
            'sks'             => 'required|numeric|min:1|max:6',
        ], [
            'kode_matakuliah.required' => 'Kode mata kuliah wajib diisi.',
            'kode_matakuliah.max'      => 'Kode mata kuliah maksimal 8 karakter.',
            'kode_matakuliah.unique'   => 'Kode mata kuliah ini sudah terdaftar di sistem.',
            'nama_matakuliah.required' => 'Nama mata kuliah wajib diisi.',
            'sks.required'             => 'Bobot SKS wajib diisi.',
            'sks.numeric'              => 'Bobot SKS harus berupa angka.',
            'sks.min'                  => 'Bobot SKS minimal 1 SKS.',
            'sks.max'                  => 'Bobot SKS maksimal 6 SKS.',
        ]);

        Matakuliah::create([
            'kode_matakuliah' => strtoupper($request->kode_matakuliah), // Otomatis kapital
            'nama_matakuliah' => $request->nama_matakuliah,
            'sks'             => $request->sks,
        ]);

        return redirect()->route('admin.matakuliah.index')->with('success', 'Mata kuliah baru berhasil diterbitkan.');
    }

    public function edit($id)
    {
        $matakuliah = Matakuliah::findOrFail($id);
        return view('admin.matakuliah.edit', compact('matakuliah'));
    }

    public function update(Request $request, $id)
    {
        $matakuliah = Matakuliah::findOrFail($id);

        $request->validate([
            'kode_matakuliah' => 'required|string|max:8|unique:matakuliah,kode_matakuliah,' . $matakuliah->kode_matakuliah . ',kode_matakuliah',
            'nama_matakuliah' => 'required|string|max:50',
            'sks'             => 'required|numeric|min:1|max:6',
        ], [
            'kode_matakuliah.required' => 'Kode mata kuliah wajib diisi.',
            'kode_matakuliah.max'      => 'Kode mata kuliah maksimal 8 karakter.',
            'kode_matakuliah.unique'   => 'Kode mata kuliah ini sudah digunakan.',
            'nama_matakuliah.required' => 'Nama mata kuliah wajib diisi.',
            'sks.required'             => 'Bobot SKS wajib diisi.',
            'sks.min'                  => 'Minimal 1 SKS.',
            'sks.max'                  => 'Maksimal 6 SKS.',
        ]);

        $matakuliah->update([
            'kode_matakuliah' => strtoupper($request->kode_matakuliah),
            'nama_matakuliah' => $request->nama_matakuliah,
            'sks'             => $request->sks,
        ]);

        return redirect()->route('admin.matakuliah.index')->with('success', 'Data mata kuliah berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $matakuliah = Matakuliah::findOrFail($id);

        try {
            $matakuliah->delete();
            return redirect()->route('admin.matakuliah.index')->with('success', 'Mata kuliah berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('admin.matakuliah.index')->with('error', 'Gagal dihapus! Mata kuliah ini sedang aktif digunakan pada jadwal perkuliahan.');
        }
    }
}
