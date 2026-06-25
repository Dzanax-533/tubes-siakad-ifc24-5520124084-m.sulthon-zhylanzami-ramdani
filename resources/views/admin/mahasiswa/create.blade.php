<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Registrasi Mahasiswa Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <form action="{{ route('admin.mahasiswa.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="npm" class="block mb-1 text-sm font-medium text-gray-700">NPM (Wajib 10 Digit Angka)</label>
                        <input type="text" name="npm" id="npm" maxlength="10" value="{{ old('npm') }}" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Contoh: 2443110021">
                        @error('npm') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="nama" class="block mb-1 text-sm font-medium text-gray-700">Nama Mahasiswa Lengkap</label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama') }}" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Ketik nama lengkap mahasiswa...">
                        @error('nama') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-6">
                        <label for="nidn" class="block mb-1 text-sm font-medium text-gray-700">Dosen Wali Pemimpin</label>
                        <select name="nidn" id="nidn" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">-- Pilih Dosen Wali --</option>
                            @foreach($dosen as $d)
                                <option value="{{ $d->nidn }}" {{ old('nidn') == $d->nidn ? 'selected' : '' }}>
                                    {{ $d->nama }} (NIDN: {{ $d->nidn }})
                                </option>
                            @endforeach
                        </select>
                        @error('nidn') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-end gap-2">
                        <a href="{{ route('admin.mahasiswa.index') }}" class="px-4 py-2 text-sm font-semibold text-gray-700 transition bg-gray-100 rounded-md hover:bg-gray-200">Batal</a>
                        <button type="submit" class="px-4 py-2 text-sm font-semibold text-white transition bg-blue-600 rounded-md hover:bg-blue-700">Daftarkan Mahasiswa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
