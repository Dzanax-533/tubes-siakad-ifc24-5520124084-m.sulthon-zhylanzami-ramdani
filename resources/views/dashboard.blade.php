<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-black text-2xl text-blue-900 tracking-tight">
                    {{ ('Pusat Kendali Akademik') }}
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Selamat datang kembali, Administrator.</p>
            </div>
            <div class="bg-white border border-blue-200 px-4 py-2 rounded-xl text-xxs font-bold text-blue-800 shadow-sm">
                📅 {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-3xl border border-blue-100 shadow-sm hover:shadow-md transition duration-300 transform hover:-translate-y-0.5 flex items-center justify-between group">
                    <div>
                        <span class="text-xxs font-black text-slate-400 uppercase tracking-wider block">Total Dosen</span>
                        <span class="text-2xl font-black text-blue-900 block mt-1 tracking-tight">Active</span>
                        <a href="{{ route('admin.dosen.index') }}" class="text-xxs font-bold text-blue-600 group-hover:underline block mt-2">Kelola Data &rarr;</a>
                    </div>
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-xl font-bold">👨‍🏫</div>
                </div>

                <div class="bg-white p-6 rounded-3xl border border-blue-100 shadow-sm hover:shadow-md transition duration-300 transform hover:-translate-y-0.5 flex items-center justify-between group">
                    <div>
                        <span class="text-xxs font-black text-slate-400 uppercase tracking-wider block">Total Mahasiswa</span>
                        <span class="text-2xl font-black text-blue-900 block mt-1 tracking-tight">Active</span>
                        <a href="{{ route('admin.mahasiswa.index') }}" class="text-xxs font-bold text-blue-600 group-hover:underline block mt-2">Kelola Data &rarr;</a>
                    </div>
                    <div class="w-12 h-12 bg-sky-100 text-blue-600 rounded-2xl flex items-center justify-center text-xl font-bold">🎓</div>
                </div>

                <div class="bg-white p-6 rounded-3xl border border-blue-100 shadow-sm hover:shadow-md transition duration-300 transform hover:-translate-y-0.5 flex items-center justify-between group">
                    <div>
                        <span class="text-xxs font-black text-slate-400 uppercase tracking-wider block">Mata Kuliah</span>
                        <span class="text-2xl font-black text-blue-900 block mt-1 tracking-tight">Master</span>
                        <a href="{{ route('admin.matakuliah.index') }}" class="text-xxs font-bold text-blue-600 group-hover:underline block mt-2">Kelola Data &rarr;</a>
                    </div>
                    <div class="w-12 h-12 bg-blue-50 text-blue-700 rounded-2xl flex items-center justify-center text-xl font-bold">📚</div>
                </div>

                <div class="bg-white p-6 rounded-3xl border border-blue-100 shadow-sm hover:shadow-md transition duration-300 transform hover:-translate-y-0.5 flex items-center justify-between group">
                    <div>
                        <span class="text-xxs font-black text-slate-400 uppercase tracking-wider block">Jadwal Kuliah</span>
                        <span class="text-2xl font-black text-blue-900 block mt-1 tracking-tight">Published</span>
                        <a href="{{ route('admin.jadwal.index') }}" class="text-xxs font-bold text-blue-600 group-hover:underline block mt-2">Buka Distribusi &rarr;</a>
                    </div>
                    <div class="w-12 h-12 bg-sky-50 text-blue-600 rounded-2xl flex items-center justify-center text-xl font-bold">⏱️</div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="bg-white p-6 md:p-8 rounded-3xl border border-blue-100 shadow-sm lg:col-span-2">
                    <div class="mb-6 border-b border-slate-100 pb-4">
                        <h3 class="text-sm font-black text-blue-900 uppercase tracking-wider">Alur Kerja Administrasi</h3>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-start gap-4 p-4 bg-slate-50 rounded-2xl border border-slate-200">
                            <div class="w-8 h-8 rounded-xl bg-blue-900 text-white font-bold flex items-center justify-center text-xs">1</div>
                            <div>
                                <h4 class="text-xs font-bold text-slate-900">Validasi Data Master</h4>
                                <p class="text-xxs text-slate-600 mt-0.5">Pastikan parameter input dikunci dengan benar.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 md:p-8 rounded-3xl shadow-sm border-2 border-blue-600 relative overflow-hidden">
                    <div class="mb-6 border-b border-blue-100 pb-4">
                        <h3 class="text-xs font-black text-blue-900 uppercase tracking-wider">Sesi Otoritas Admin</h3>
                    </div>
                    <div class="space-y-4 text-xs font-medium">
                        <div class="bg-blue-50 border border-blue-200 p-3 rounded-xl">
                            <span class="text-xxs text-blue-800 block">Nama Operator:</span>
                            <span class="font-bold text-blue-950 text-sm block mt-0.5">{{ auth()->user()->name }}</span>
                        </div>
                        <div class="bg-blue-50 border border-blue-200 p-3 rounded-xl">
                            <span class="text-xxs text-blue-800 block">Email Akun:</span>
                            <span class="font-mono text-blue-950 block mt-0.5">{{ auth()->user()->email }}</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>