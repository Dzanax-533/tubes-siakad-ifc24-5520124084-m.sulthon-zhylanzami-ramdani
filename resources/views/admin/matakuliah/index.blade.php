<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-black tracking-tight text-slate-900">
                    {{ __('Master Data Mata Kuliah') }}
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Manajemen kurikulum, bobot bobot SKS, dan kodifikasi mata kuliah aktif.</p>
            </div>

            <a href="{{ route('admin.matakuliah.create') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold rounded-xl shadow-sm hover:shadow transition duration-200 self-start sm:self-auto">
                <span>➕</span> Tambah Mata Kuliah Baru
            </a>
        </div>
    </x-slot>

    <div class="min-h-screen py-8 bg-slate-50">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="flex items-center gap-2 p-4 mb-6 text-xs font-bold text-white shadow-md bg-slate-900 rounded-xl">
                    ✨ {{ session('success') }}
                </div>
            @endif

            <div class="overflow-hidden bg-white border shadow-xs rounded-3xl border-slate-200/60">
                <div class="flex flex-col justify-between gap-4 p-6 bg-white border-b border-slate-100 sm:flex-row sm:items-center">
                    <div>
                        <h3 class="text-xs font-black tracking-wider uppercase text-slate-900">Manifes Kurikulum Aktif</h3>
                        <p class="text-xxs text-slate-400 mt-0.5">Perubahan kode mata kuliah di halaman ini akan otomatis memengaruhi modul distribusi jadwal kuliah.</p>
                    </div>
                    <div class="relative">
                        <input type="text" placeholder="Cari mata kuliah..." class="pl-8 pr-4 py-1.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 w-full sm:w-48 focus:outline-none focus:border-slate-400 transition" />
                        <span class="absolute left-2.5 top-2 text-slate-400 text-xs">🔍</span>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm divide-y divide-slate-100">
                        <thead>
                            <tr class="font-extrabold tracking-wider uppercase border-b bg-slate-50/70 text-slate-500 text-xxs border-slate-200/60">
                                <th class="px-6 py-4 text-left">Kode Mata Kuliah</th>
                                <th class="px-6 py-4 text-left">Nama Mata Kuliah</th>
                                <th class="px-6 py-4 text-center">Bobot Kredit (SKS)</th>
                                <th class="px-6 py-4 text-center">Status Distribusi</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-100 text-slate-700">
                            @forelse($matakuliah as $mk)
                                <tr class="transition duration-150 hover:bg-slate-50/60">

                                    <td class="px-6 py-4.5 whitespace-nowrap">
                                        <span class="font-mono font-bold text-slate-800 bg-slate-100 border border-slate-200 px-2.5 py-1 rounded-lg text-xs">
                                            {{ $mk->kode_matakuliah }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4.5">
                                        <div class="text-sm font-bold tracking-tight text-slate-900">{{ $mk->nama_matakuliah }}</div>
                                        <div class="text-xxs text-slate-400 mt-0.5">Kurikulum Inti Teknik Informatika</div>
                                    </td>

                                    <td class="px-6 py-4.5 whitespace-nowrap text-center">
                                        <span class="inline-block px-3 py-1 text-xs font-black text-indigo-700 border border-indigo-100 bg-indigo-50 rounded-xl shadow-xxs">
                                            {{ $mk->sks }} SKS
                                        </span>
                                    </td>

                                    <td class="px-6 py-4.5 whitespace-nowrap text-center">
                                        <div class="text-xxs text-emerald-600 font-bold inline-flex items-center gap-1.5 bg-emerald-50 border border-emerald-100 px-2 py-0.5 rounded-full">
                                            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span> Aktif
                                        </div>
                                    </td>

                                    <td class="px-6 py-4.5 whitespace-nowrap text-center text-xs font-medium">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('admin.matakuliah.edit', $mk->kode_matakuliah) }}" class="px-2.5 py-1.5 text-slate-700 hover:bg-slate-100 border border-slate-200 text-xxs font-bold rounded-lg transition duration-150">
                                                ✏️ Edit
                                            </a>

                                            <form action="{{ route('admin.matakuliah.destroy', $mk->kode_matakuliah) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus mata kuliah ini? Seluruh jadwal kuliah dan KRS mahasiswa yang terkait akan ikut terhapus.')" class="inline-block">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="px-2.5 py-1.5 text-rose-600 hover:text-white bg-rose-50 hover:bg-rose-600 border border-rose-100 hover:border-rose-600 text-xxs font-bold rounded-lg transition duration-150">
                                                    🗑️ Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-16 text-xs font-medium text-center text-slate-400">
                                        <div class="mb-2 text-2xl">📚</div>
                                        Belum ada data mata kuliah yang terdaftar dalam kurikulum sistem.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <style>
        .text-xxs { font-size: 0.68rem; }
        .py-4\.5 { padding-top: 1.125rem; padding-bottom: 1.125rem; }
        .shadow-xs { box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); }
        .shadow-xxs { box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.02); }
    </style>
</x-app-layout>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.querySelector('input[placeholder="Cari mata kuliah..."]');
        const tableRows = document.querySelectorAll('tbody tr');

        if (searchInput) {
            searchInput.addEventListener('keyup', function (e) {
                const term = e.target.value.toLowerCase();

                tableRows.forEach(row => {
                    const kode = row.cells[0]?.textContent.toLowerCase() || '';
                    const nama = row.cells[1]?.textContent.toLowerCase() || '';

                    if (kode.includes(term) || nama.includes(term)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        }
    });
</script>
