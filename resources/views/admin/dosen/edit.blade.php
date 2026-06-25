<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Ubah Data Master Dosen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <form action="{{ route('admin.dosen.update', $dosen->nidn) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="nidn" class="block mb-1 text-sm font-medium text-gray-700">NIDN (10 Digit Angka)</label>
                        <input type="text" name="nidn" id="nidn" maxlength="10" value="{{ old('nidn', $dosen->nidn) }}" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('nidn')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="nama" class="block mb-1 text-sm font-medium text-gray-700">Nama Dosen Lengkap</label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama', $dosen->nama) }}" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('nama')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end gap-2">
                        <a href="{{ route('admin.dosen.index') }}" class="px-4 py-2 text-sm font-semibold text-gray-700 transition bg-gray-100 rounded-md hover:bg-gray-200">Batal</a>
                        <button type="submit" class="px-4 py-2 text-sm font-semibold text-white transition bg-yellow-600 rounded-md hover:bg-yellow-700">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
