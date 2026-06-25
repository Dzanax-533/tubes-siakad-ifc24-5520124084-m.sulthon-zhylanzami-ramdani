<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\MahasiswaDashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user->role === 'admin') {
        return view('dashboard');
    } elseif ($user->role === 'mahasiswa') {
        return redirect()->route('mahasiswa.dashboard');
    }

    return abort(403, 'Otoritas hak akses akun tidak dikenali oleh sistem.');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('dosen', DosenController::class);
    Route::resource('matakuliah', MatakuliahController::class);
    Route::resource('mahasiswa', MahasiswaController::class);
    Route::resource('jadwal', JadwalController::class)->except(['edit', 'update']);
});

Route::middleware(['auth', 'verified'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('/dashboard', [MahasiswaDashboardController::class, 'index'])->name('dashboard');
    Route::post('/krs/isi', [MahasiswaDashboardController::class, 'isiKrs'])->name('krs.isi');
    Route::delete('/krs/drop', [MahasiswaDashboardController::class, 'dropKrs'])->name('krs.drop');
});

require __DIR__.'/auth.php';
