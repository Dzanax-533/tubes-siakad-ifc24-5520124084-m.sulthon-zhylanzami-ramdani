<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Tambah Data Mata Kuliah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <form action="{{ route('admin.matakuliah.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="kode_matakuliah" class="block mb-1 text-sm font-medium text-gray-700">Kode Mata Kuliah (Maks 8 Karakter)</label>
                        <input type="text" name="kode_matakuliah" id="kode_matakuliah" value="{{ old('kode_matakuliah') }}" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('kode_matakuliah') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="nama_matakuliah" class="block mb-1 text-sm font-medium text-gray-700">Nama Mata Kuliah</label>
                        <input type="text" name="nama_matakuliah" id="nama_matakuliah" value="{{ old('nama_matakuliah') }}" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('nama_matakuliah') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-6">
                        <label for="sks" class="block mb-1 text-sm font-medium text-gray-700">Bobot SKS (1 - 6)</label>
                        <input type="number" name="sks" id="sks" value="{{ old('sks') }}" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('sks') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-end gap-2">
                        <a href="{{ route('admin.matakuliah.index') }}" class="px-4 py-2 text-sm font-semibold text-gray-700 transition bg-gray-100 rounded-md hover:bg-gray-200">Batal</a>
                        <button type="submit" class="px-4 py-2 text-sm font-semibold text-white transition bg-blue-600 rounded-md hover:bg-blue-700">Simpan Mata Kuliah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
