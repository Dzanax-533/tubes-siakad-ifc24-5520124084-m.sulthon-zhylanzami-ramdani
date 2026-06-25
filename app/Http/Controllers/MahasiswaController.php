<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{

    public function index()
    {
        $mahasiswa = Mahasiswa::with('dosen')->get();
        return view('admin.mahasiswa.index', compact('mahasiswa'));
    }

    public function create()
    {
        $dosen = Dosen::all();
        return view('admin.mahasiswa.create', compact('dosen'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'npm'  => 'required|regex:/^[0-9]+$/|size:10|unique:mahasiswa,npm',
            'nama' => 'required|string|max:50',
            'nidn' => 'required|exists:dosen,nidn',
        ], [
            'npm.required'  => 'NPM wajib diisi.',
            'npm.regex'     => 'NPM harus berupa angka murni.',
            'npm.size'      => 'NPM harus tepat berukuran 10 digit.',
            'npm.unique'    => 'NPM ini sudah terdaftar di dalam sistem.',
            'nama.required' => 'Nama mahasiswa wajib diisi.',
            'nama.max'      => 'Nama mahasiswa maksimal 50 karakter.',
            'nidn.required' => 'Dosen Wali wajib dipilih.',
            'nidn.exists'   => 'Dosen Wali yang dipilih tidak valid.',
        ]);

        Mahasiswa::create([
            'npm'  => $request->npm,
            'nama' => $request->nama,
            'nidn' => $request->nidn,
        ]);

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Mahasiswa baru berhasil didaftarkan.');
    }
    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $dosen = Dosen::all();
        return view('admin.mahasiswa.edit', compact('mahasiswa', 'dosen'));
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        $request->validate([
            'npm'  => 'required|regex:/^[0-9]+$/|size:10|unique:mahasiswa,npm,' . $mahasiswa->npm . ',npm',
            'nama' => 'required|string|max:50',
            'nidn' => 'required|exists:dosen,nidn',
        ], [
            'npm.required'  => 'NPM wajib diisi.',
            'npm.regex'     => 'NPM harus berupa angka murni.',
            'npm.size'      => 'NPM harus tepat berukuran 10 digit.',
            'npm.unique'    => 'NPM ini sudah digunakan oleh mahasiswa lain.',
            'nama.required' => 'Nama mahasiswa wajib diisi.',
            'nama.max'      => 'Nama mahasiswa maksimal 50 karakter.',
            'nidn.required' => 'Dosen Wali wajib dipilih.',
        ]);

        $mahasiswa->update([
            'npm'  => $request->npm,
            'nama' => $request->nama,
            'nidn' => $request->nidn,
        ]);

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data mahasiswa akademik berhasil dihapus.');
    }
}
