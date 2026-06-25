<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-black text-2xl text-blue-900 tracking-tight">
                    {{ ('Master Data Mahasiswa') }}
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Skema warna kontras tinggi untuk mempermudah pemeriksaan akurasi data.</p>
            </div>
            <a href="{{ route('admin.mahasiswa.create') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold rounded-xl shadow-sm transition duration-200 self-start sm:self-auto">
                <span>➕</span> Registrasi Mahasiswa Baru
            </a>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 p-4 bg-blue-900 text-white rounded-xl text-xs font-bold shadow-md">
                    ✨ {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-3xl shadow-sm border border-blue-100 overflow-hidden">
                <div class="p-6 border-b border-slate-100 bg-white flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <h3 class="text-xs font-black text-blue-900 uppercase tracking-wider">Daftar Mahasiswa Aktif</h3>
                    </div>
                    <div class="relative">
                        <input type="text" placeholder="Cari mahasiswa..." class="pl-8 pr-4 py-1.5 bg-slate-50 border border-blue-200 rounded-xl text-xs text-slate-700 w-full sm:w-48 focus:outline-none focus:border-blue-500 transition" />
                        <span class="absolute left-2.5 top-2 text-blue-400 text-xs">🔍</span>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-blue-100 text-sm">
                        <thead>
                            <tr class="bg-blue-50/60 text-blue-900 font-extrabold uppercase text-xxs tracking-wider border-b border-blue-100">
                                <th class="px-6 py-4 text-left">Identitas Mahasiswa</th>
                                <th class="px-6 py-4 text-left">Nomor Pokok (NPM)</th>
                                <th class="px-6 py-4 text-left">Kontak & Akun</th>
                                <th class="px-6 py-4 text-left">Dosen Wali</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-700 bg-white">
                            @forelse($mahasiswa as $m)
                                <tr class="hover:bg-blue-50/30 transition duration-150">
                                    <td class="px-6 py-4.5">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 bg-blue-600 text-white font-black text-xs rounded-xl flex items-center justify-center shadow-sm">
                                                {{ strtoupper(substr($m->nama, 0, 1)) }}
                                            </div>
                                            <div class="font-bold text-blue-950 text-sm tracking-tight">{{ $m->nama }}</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4.5 whitespace-nowrap">
                                        <span class="font-mono font-bold text-blue-900 bg-blue-50 border border-blue-200 px-2.5 py-1 rounded-lg text-xs">
                                            {{ $m->npm }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4.5 font-mono text-xs font-semibold text-slate-900">
                                        {{ $m->email ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4.5 text-xs font-bold text-slate-800">
                                        {{ $m->dosen->nama ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4.5 whitespace-nowrap text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('admin.mahasiswa.edit', $m->npm) }}" class="px-2.5 py-1.5 text-blue-700 hover:bg-blue-50 border border-blue-200 text-xxs font-bold rounded-lg transition">✏️ Edit</a>
                                            <form action="{{ route('admin.mahasiswa.destroy', $m->npm) }}" method="POST" class="inline-block">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="px-2.5 py-1.5 text-rose-600 hover:bg-rose-50 border border-rose-200 text-xxs font-bold rounded-lg transition">🗑️ Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="px-6 py-12 text-center text-slate-400 text-xs">Data Kosong.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>