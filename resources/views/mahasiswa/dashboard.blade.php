<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 no-print">
            <div>
                <h2 class="font-black text-2xl text-blue-900 tracking-tight">
                    {{ ('Portal Rencana Studi') }}
                </h2>
            </div>
            <div class="flex items-center gap-2 bg-blue-600 text-white px-4 py-1.5 rounded-full shadow-sm">
                <span class="w-2 h-2 rounded-full bg-white animate-ping"></span>
                <span class="text-xs font-bold uppercase tracking-wider">KRS Online Aktif</span>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-50 min-h-screen printable-area">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(isset($error_profil))
                <div class="bg-white border-l-4 border-blue-600 p-6 rounded-2xl shadow-sm no-print">
                    <p class="text-sm font-bold text-blue-900">{{ $error_profil }}</p>
                </div>
            @else

                <div class="bg-gradient-to-br from-blue-900 to-blue-950 text-white rounded-3xl shadow-md p-6 md:p-8 mb-8 border border-blue-800 print-profile-card">
                    <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                        <div>
                            <span class="text-xxs font-extrabold uppercase tracking-widest text-sky-300">Akun Mahasiswa Terverifikasi</span>
                            <h3 class="text-2xl font-black tracking-tight mt-1 text-slate-900-print">{{ $mahasiswa->nama }}</h3>
                            <p class="text-xs text-blue-100 mt-1 font-mono text-slate-700-print">NPM: {{ $mahasiswa->npm }} &bull; Wali: {{ $mahasiswa->dosen->nama }}</p>
                        </div>
                        
                        <div class="bg-white/10 border border-white/20 px-6 py-4 rounded-2xl text-center md:text-right min-w-[200px] print-sks-badge">
                            <span class="text-xxs uppercase tracking-wider text-blue-200 block mb-1 text-slate-600-print">SKS Terpilih</span>
                            <div class="text-2xl font-black text-white text-slate-900-print">{{ $totalSks }} <span class="text-xs font-normal text-blue-200">/ 24 SKS</span></div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
                    
                    <div class="bg-white p-6 rounded-3xl shadow-sm border border-blue-100 no-print">
                        <h4 class="text-xs font-black text-blue-900 uppercase tracking-wider mb-4">Katalog Kelas Tersedia</h4>
                        <div class="space-y-3 max-h-[550px] overflow-y-auto">
                            @foreach($jadwalTersedia as $jadwal)
                                <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200 flex flex-col justify-between gap-3 group">
                                    <div>
                                        <div class="flex items-center justify-between gap-2 mb-1">
                                            <span class="px-2 py-0.5 bg-blue-100 text-blue-800 font-bold text-xxs rounded">{{ $jadwal->matakuliah->sks }} SKS</span>
                                            <span class="text-xxs font-bold text-slate-500">Kelas {{ $jadwal->kelas }}</span>
                                        </div>
                                        <h5 class="font-bold text-slate-900 text-sm group-hover:text-blue-600 transition">{{ $jadwal->matakuliah->nama_matakuliah }}</h5>
                                        <p class="text-xxs text-slate-600 mt-1">📆 {{ $jadwal->hari }}, {{ $jadwal->jam }}</p>
                                    </div>
                                    <form action="{{ route('mahasiswa.krs.isi') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="npm" value="{{ $mahasiswa->npm }}">
                                        <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">
                                        <button type="submit" class="w-full py-2 bg-blue-600 text-white text-xxs font-bold rounded-xl hover:bg-blue-700 transition">
                                            + Ambil Kelas
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="bg-white p-6 md:p-8 rounded-3xl shadow-sm border border-blue-100 lg:col-span-2 print-sheet-wrapper">
                        <div class="flex justify-between items-center mb-6 no-print">
                            <h4 class="text-xs font-black text-blue-900 uppercase tracking-wider">Kartu Rencana Studi Terpilih</h4>
                            <button onclick="window.print()" class="px-4 py-2 bg-blue-600 text-white hover:bg-blue-700 text-xxs font-bold rounded-xl transition shadow-sm">
                                🖨️ Cetak Dokumen / PDF
                            </button>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 print-grid-layout">
                            @forelse($krsTerpilih as $krs)
                                <div class="p-5 bg-blue-50/50 rounded-2xl border border-blue-100 flex flex-col justify-between print-card-item">
                                    <div>
                                        <span class="text-xxs font-bold text-blue-700 uppercase block mb-1">Mata Kuliah Terdaftar</span>
                                        <h5 class="font-extrabold text-blue-950 text-base leading-tight">{{ $krs->nama_matakuliah }}</h5>
                                        <p class="text-xs text-slate-600 mt-1">👨‍🏫 {{ $krs->nama_dosen }}</p>
                                    </div>
                                    <div class="mt-4 pt-3 border-t border-blue-100 flex items-center justify-between">
                                        <span class="text-xs font-black text-blue-900 bg-white px-2.5 py-1 rounded-lg border border-blue-200">{{ $krs->sks }} SKS</span>
                                        <span class="text-xs font-bold text-slate-700">Kelas: {{ $krs->kelas }}</span>
                                        <form action="{{ route('mahasiswa.krs.drop') }}" method="POST" class="no-print">
                                            @csrf @method('DELETE')
                                            <input type="hidden" name="npm" value="{{ $mahasiswa->npm }}">
                                            <input type="hidden" name="jadwal_id" value="{{ $krs->id }}">
                                            <button type="submit" class="text-rose-600 hover:bg-rose-50 text-xxs font-bold bg-white px-3 py-1.5 rounded-xl border border-rose-200 transition">Lepas</button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <div class="col-span-2 text-center py-12 border-2 border-dashed border-blue-200 rounded-2xl text-slate-400 text-xs">Belum mengambil kelas.</div>
                            @endforelse
                        </div>

                        <div class="mt-6 p-4 bg-blue-900 text-white rounded-2xl flex justify-between items-center print-total-bar">
                            <span class="text-xs font-bold uppercase text-blue-200">Total SKS Diajukan:</span>
                            <span class="text-base font-black text-white tracking-tight">{{ $totalSks }} / 24 SKS</span>
                        </div>
                    </div>

                </div>
            @endif
        </div>
    </div>

    <style>
        .text-xxs { font-size: 0.68rem; }
        .py-4\.5 { padding-top: 1.125rem; padding-bottom: 1.125rem; }
        @media print {
            nav, .no-print, header, .bg-slate-50 { display: none !important; }
            body, html, .printable-area, .print-sheet-wrapper { background-color: white !important; color: black !important; width: 100% !important; display: block !important; padding: 0 !important; }
            .print-profile-card { background: transparent !important; border: 1px solid #94a3b8 !important; color: black !important; padding: 16px !important; margin-bottom: 24px !important; }
            .print-grid-layout { display: block !important; }
            .print-card-item { display: block !important; page-break-inside: avoid !important; border: 1px solid #94a3b8 !important; margin-bottom: 12px !important; padding: 14px !important; }
            .print-total-bar { background: #f1f5f9 !important; border: 1px solid #94a3b8 !important; color: black !important; }
        }
    </style>
</x-app-layout>