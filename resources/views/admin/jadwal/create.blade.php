<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-black tracking-tight text-slate-900">
                {{ __('Terbitkan Jadwal Baru') }}
            </h2>
            <p class="text-xs text-slate-500 mt-0.5">Isi parameter di bawah secara presisi untuk merilis kelas kuliah baru.</p>
        </div>
    </x-slot>

    <div class="min-h-screen py-8 bg-slate-50">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            @if(session('error'))
                <div class="p-4 mb-4 text-xs font-bold text-white shadow-md bg-rose-600 rounded-xl">
                    🛑 {{ session('error') }}
                </div>
            @endif

            <div class="p-6 bg-white border shadow-sm md:p-8 rounded-3xl border-slate-200/60">
                <form action="{{ route('admin.jadwal.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block mb-2 text-xs font-black tracking-wider uppercase text-slate-900">Mata Kuliah</label>
                        <select name="kode_matakuliah" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-700 focus:outline-none focus:border-slate-400" required>
                            <option value="">-- Pilih Mata Kuliah --</option>
                            @foreach($matakuliah as $mk)
                                <option value="{{ $mk->kode_matakuliah }}" {{ old('kode_matakuliah') == $mk->kode_matakuliah ? 'selected' : '' }}>
                                    {{ $mk->nama_matakuliah }} ({{ $mk->sks }} SKS)
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block mb-2 text-xs font-black tracking-wider uppercase text-slate-900">Dosen Pengampu</label>
                        <select name="nidn" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-700 focus:outline-none focus:border-slate-400" required>
                            <option value="">-- Pilih Dosen --</option>
                            @foreach($dosen as $d)
                                <option value="{{ $d->nidn }}" {{ old('nidn') == $d->nidn ? 'selected' : '' }}>
                                    {{ $d->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                        <div>
                            <label class="block mb-2 text-xs font-black tracking-wider uppercase text-slate-900">Kode Kelas</label>
                            <input type="text" name="kelas" placeholder="Contoh: IF-4A" value="{{ old('kelas') }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-700 focus:outline-none focus:border-slate-400" required />
                        </div>

                        <div>
                            <label class="block mb-2 text-xs font-black tracking-wider uppercase text-slate-900">Hari</label>
                            <select name="hari" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-700 focus:outline-none focus:border-slate-400" required>
                                <option value="">-- Pilih Hari --</option>
                                @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $hari)
                                    <option value="{{ $hari }}" {{ old('hari') == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block mb-2 text-xs font-black tracking-wider uppercase text-slate-900">Jam Mulai</label>
                            <input type="time" name="jam" value="{{ old('jam') }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-700 focus:outline-none focus:border-slate-400" required />
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                        <a href="{{ route('admin.jadwal.index') }}" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-xl transition">
                            Batal
                        </a>
                        <button type="submit" class="px-4 py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold rounded-xl shadow-sm transition">
                            Simpan & Rilis Jadwal
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</x-app-layout>
