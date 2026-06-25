<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-black tracking-tight text-slate-900">
                    {{ ('Manajemen Jadwal Kuliah') }}
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Otoritas kendali dan penerbitan waktu distribusi perkuliahan.</p>
            </div>

            <a href="{{ route('admin.jadwal.create') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold rounded-xl shadow-sm hover:shadow transition duration-200 self-start sm:self-auto">
                <span>➕</span> Terbitkan Jadwal Baru
            </a>
        </div>
    </x-slot>

    <div class="min-h-screen py-8 bg-slate-50">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="flex items-center gap-2 p-4 mb-6 text-xs font-bold text-white shadow-md bg-slate-900 rounded-xl animate-pulse">
                    ✨ {{ session('success') }}
                </div>
            @endif

            <div class="overflow-hidden bg-white border shadow-xs rounded-3xl border-slate-200/60">
                <div class="flex flex-col justify-between gap-4 p-6 bg-white border-b border-slate-100 sm:flex-row sm:items-center">
                    <div>
                        <h3 class="text-xs font-black tracking-wider uppercase text-slate-900">Manifes Jadwal Aktif</h3>
                        <p class="text-xxs text-slate-400 mt-0.5">Seluruh perubahan pada baris ini langsung berdampak pada portal krs mahasiswa.</p>
                    </div>
                    <div class="relative no-print">
                        <input type="text" placeholder="Cari jadwal..." class="pl-8 pr-4 py-1.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 w-full sm:w-48 focus:outline-none focus:border-slate-400 transition" />
                        <span class="absolute left-2.5 top-2 text-slate-400 text-xs">🔍</span>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm divide-y divide-slate-100">
                        <thead>
                            <tr class="font-extrabold tracking-wider uppercase border-b bg-slate-50/70 text-slate-500 text-xxs border-slate-200/60">
                                <th class="px-6 py-4 text-left">Detail Mata Kuliah</th>
                                <th class="px-6 py-4 text-left">Dosen Pengampu</th>
                                <th class="px-6 py-4 text-center">Kelas</th>
                                <th class="px-6 py-4 text-center">Alokasi Waktu</th>
                                <th class="px-6 py-4 text-center">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-100 text-slate-700">
                            @forelse($jadwal as $j)
                                <tr class="transition duration-150 hover:bg-slate-50/60">
                                    <td class="px-6 py-4.5">
                                        <div class="text-sm font-bold text-slate-900">{{ $j->matakuliah->nama_matakuliah }}</div>
                                        <div class="text-xxs font-mono text-slate-400 mt-0.5">{{ $j->kode_matakuliah }} &bull; {{ $j->matakuliah->sks }} SKS</div>
                                    </td>
                                    <td class="px-6 py-4.5">
                                        <div class="text-xs font-semibold text-slate-800 md:text-sm">{{ $j->dosen->nama }}</div>
                                        <div class="text-xxs text-slate-400 mt-0.5 font-mono">NIDN: {{ $j->dosen->nidn }}</div>
                                    </td>
                                    <td class="px-6 py-4.5 text-center">
                                        <span class="inline-block px-2.5 py-1 bg-slate-100 border border-slate-200 text-slate-800 font-mono font-black text-xs rounded-lg shadow-xxs">
                                            {{ $j->kelas }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4.5 text-center">
                                        <div class="text-xs font-bold text-slate-900">📆 {{ $j->hari }}</div>
                                        <div class="text-xxs text-indigo-600 font-semibold mt-0.5">⏱️ {{ \Carbon\Carbon::parse($j->jam)->format('H:i') }} WIB</div>
                                    </td>
                                    <td class="px-6 py-4.5 text-center">
                                        <form action="{{ route('admin.jadwal.destroy', $j->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan dan menghapus jadwal kuliah ini?')" class="inline-block">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 text-rose-600 hover:text-white bg-rose-50 hover:bg-rose-600 border border-rose-100 hover:border-rose-600 text-xxs font-bold rounded-xl transition duration-150 shadow-xxs">
                                                🗑️ Batalkan Rilis
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-16 text-xs font-medium text-center text-slate-400">
                                        <div class="mb-2 text-2xl">📭</div>
                                        Belum ada jadwal perkuliahan yang diterbitkan untuk semester ini.
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
        .shadow-xxs { box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.03); }
    </style>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.querySelector('input[placeholder="Cari jadwal..."]');
        const tableRows = document.querySelectorAll('tbody tr');

        if (searchInput) {
            searchInput.addEventListener('keyup', function (e) {
                const term = e.target.value.toLowerCase();

                tableRows.forEach(row => {
                    const matakuliah = row.cells[0]?.textContent.toLowerCase() || '';
                    const dosen = row.cells[1]?.textContent.toLowerCase() || '';

                    if (matakuliah.includes(term) || dosen.includes(term)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        }
    });
</script>
