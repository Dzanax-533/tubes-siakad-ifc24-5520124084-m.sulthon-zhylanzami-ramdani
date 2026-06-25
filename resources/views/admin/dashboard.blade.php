<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ ('Dashboard Utama Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <h3 class="mb-2 text-lg font-bold text-gray-800">Selamat Datang di SIAKAD Control Panel</h3>
                <p class="mb-6 text-sm text-gray-600">Gunakan menu di bawah ini untuk mengelola seluruh data master akademik sesuai dengan kebutuhan otoritas sistem.</p>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
                    <a href="{{ route('admin.dosen.index') }}" class="block p-6 transition border border-blue-200 rounded-lg shadow-sm bg-blue-50 hover:bg-blue-100">
                        <div class="text-lg font-bold text-blue-700">Kelola Dosen</div>
                        <div class="mt-1 text-xs text-blue-500">Tambah, edit, dan hapus data master dosen.</div>
                    </a>

                    <a href="{{ route('admin.mahasiswa.index') }}" class="block p-6 transition border border-green-200 rounded-lg shadow-sm bg-green-50 hover:bg-green-100">
                        <div class="text-lg font-bold text-green-700">Kelola Mahasiswa</div>
                        <div class="mt-1 text-xs text-green-500">Manajemen data master mahasiswa & dosen wali.</div>
                    </a>

                    <a href="{{ route('admin.matakuliah.index') }}" class="block p-6 transition border border-yellow-200 rounded-lg shadow-sm bg-yellow-50 hover:bg-yellow-100">
                        <div class="text-lg font-bold text-yellow-700">Kelola Mata Kuliah</div>
                        <div class="mt-1 text-xs text-yellow-500">Pengaturan daftar mata kuliah dan bobot SKS.</div>
                    </a>

                    <a href="{{ route('admin.jadwal.index') }}" class="block p-6 transition border border-purple-200 rounded-lg shadow-sm bg-purple-50 hover:bg-purple-100">
                        <div class="text-lg font-bold text-purple-700">Kelola Jadwal</div>
                        <div class="mt-1 text-xs text-purple-500">Atur hari, jam, kelas, dan dosen pengajar.</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
