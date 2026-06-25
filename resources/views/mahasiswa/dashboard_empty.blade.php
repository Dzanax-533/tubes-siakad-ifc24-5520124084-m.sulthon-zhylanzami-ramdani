<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ ('Panel Akademik Mahasiswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 text-center border border-yellow-200 rounded-lg shadow-sm bg-yellow-50">
                <svg class="w-12 h-12 mx-auto mb-4 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                </svg>

                <h3 class="text-lg font-bold text-yellow-800">Akun Anda Belum Terhubung dengan Data Akademik</h3>
                <p class="mt-2 text-sm text-yellow-600">
                    Akun otentikasi Anda berhasil terdaftar. Namun, Anda melihat halaman ini karena Admin belum memasukkan Nama Anda (<strong>{{ Auth::user()->name }}</strong>) ke dalam master data Mahasiswa beserta NPM dan Dosen Wali Anda di sistem SIAKAD.
                </p>
                <p class="py-2 mt-4 text-xs text-gray-500 rounded bg-yellow-100/50">
                    <strong>Solusi:</strong> Silakan masuk menggunakan akun Admin, lalu tambahkan data mahasiswa dengan nama yang <strong>sama persis</strong> seperti akun ini agar sistem sinkron otomatis.
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
