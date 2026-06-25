<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-black tracking-tight text-slate-900">
                    {{ ('Master Data Dosen') }}
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Kelola data dosen pengampu, Nomor Induk (NIDN), dan otoritas dosen wali.</p>
            </div>

            <a href="{{ route('admin.dosen.create') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold rounded-xl shadow-sm hover:shadow transition duration-200 self-start sm:self-auto">
                <span>➕</span> Registrasi Dosen Baru
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
                        <h3 class="text-xs font-black tracking-wider uppercase text-slate-900">Daftar Tenaga Pengajar</h3>
                        <p class="text-xxs text-slate-400 mt-0.5">Seluruh data NIDN di bawah ini terintegrasi langsung sebagai validasi form rilis jadwal kuliah.</p>
                    </div>
                    <div class="relative">
                        <input type="text" placeholder="Cari dosen..." class="pl-8 pr-4 py-1.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 w-full sm:w-48 focus:outline-none focus:border-slate-400 transition" />
                        <span class="absolute left-2.5 top-2 text-slate-400 text-xs">🔍</span>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm divide-y divide-slate-100">
                        <thead>
                            <tr class="font-extrabold tracking-wider uppercase border-b bg-slate-50/70 text-slate-500 text-xxs border-slate-200/60">
                                <th class="px-6 py-4 text-left">Nama Lengkap Dosen</th>
                                <th class="px-6 py-4 text-left">Nomor Induk Nasional (NIDN)</th>
                                <th class="px-6 py-4 text-center">Jabatan Akademik</th>
                                <th class="px-6 py-4 text-center">Status Ikatan</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-100 text-slate-700">
                            @forelse($dosen as $d)
                                <tr class="transition duration-150 hover:bg-slate-50/60">
                                    <td class="px-6 py-4.5">
                                        <div class="flex items-center gap-3">
                                            <div class="flex items-center justify-center text-xs font-black shadow-sm w-9 h-9 bg-slate-800 text-slate-200 rounded-xl">
                                                👨‍🏫
                                            </div>
                                            <div>
                                                <div class="text-sm font-bold tracking-tight text-slate-900">{{ $d->nama }}</div>
                                                <div class="text-xxs text-slate-400 mt-0.5">Fakultas Teknik — Informatika</div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4.5 whitespace-nowrap">
                                        <span class="font-mono font-bold text-slate-800 bg-slate-100 border border-slate-200 px-2.5 py-1 rounded-lg text-xs">
                                            {{ $d->nidn }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4.5 whitespace-nowrap text-center text-xs font-semibold text-slate-800">
                                        Dosen Lektor / Wali
                                    </td>

                                    <td class="px-6 py-4.5 whitespace-nowrap text-center">
                                        <div class="text-xxs text-indigo-600 font-bold inline-flex items-center gap-1.5 bg-indigo-50 border border-indigo-100 px-2.5 py-0.5 rounded-full">
                                            <span class="w-1.5 h-1.5 bg-indigo-500 rounded-full"></span> Dosen Tetap
                                        </div>
                                    </td>

                                    <td class="px-6 py-4.5 whitespace-nowrap text-center text-xs font-medium">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('admin.dosen.edit', $d->nidn) }}" class="px-2.5 py-1.5 text-slate-700 hover:bg-slate-100 border border-slate-200 text-xxs font-bold rounded-lg transition duration-150">
                                                ✏️ Edit
                                            </a>

                                            <form action="{{ route('admin.dosen.destroy', $d->nidn) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data dosen ini? Seluruh jadwal kuliah dan relasi dosen wali mahasiswa terkait akan ikut terhapus.')" class="inline-block">
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
                                        <div class="mb-2 text-2xl">👨‍🏫</div>
                                        Belum ada data dosen yang terdaftar dalam basis data sistem.
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
    </style>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.querySelector('input[placeholder="Cari dosen..."]');
        const tableRows = document.querySelectorAll('tbody tr');

        if (searchInput) {
            searchInput.addEventListener('keyup', function (e) {
                const term = e.target.value.toLowerCase();

                tableRows.forEach(row => {
                    const nama = row.cells[0]?.textContent.toLowerCase() || '';
                    const nidn = row.cells[1]?.textContent.toLowerCase() || '';

                    if (nama.includes(term) || nidn.includes(term)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        }
    });
</script>
