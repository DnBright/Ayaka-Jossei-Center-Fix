@extends('layouts.admin')

@section('page-title', 'Manajemen User & Role')

@section('content')
<div class="user-manager-container" x-data="{ tab: 'internal', openCreateModal: false }">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-6">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Manajemen Hak Akses & User</h1>
            <p class="text-slate-500 font-medium mt-1">Kelola tim internal, editor, dan validasi keanggotaan member Ayaka.</p>
        </div>
        <button @click="openCreateModal = true" class="bg-slate-900 text-white px-8 py-4 rounded-2xl font-black text-sm uppercase tracking-widest shadow-xl hover:-translate-y-1 transition-all flex items-center gap-3">
            <i data-lucide="plus" class="w-5 h-5"></i>
            Tambah Admin Baru
        </button>
    </div>

    @if(session('success'))
        <div class="mb-8 p-4 bg-emerald-50 text-emerald-700 rounded-2xl font-bold text-sm border border-emerald-100">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabs -->
    <div class="flex gap-10 border-b-2 border-slate-100 mb-10 overflow-x-auto pb-1">
        <button 
            @click="tab = 'internal'"
            :class="tab === 'internal' ? 'border-[#da291c] text-[#da291c]' : 'border-transparent text-slate-400 hover:text-slate-600'"
            class="pb-6 border-b-4 font-black text-sm uppercase tracking-widest whitespace-nowrap transition-all">
            Tim Internal Ayaka
        </button>
        <button 
            @click="tab = 'pending'"
            :class="tab === 'pending' ? 'border-[#da291c] text-[#da291c]' : 'border-transparent text-slate-400 hover:text-slate-600'"
            class="pb-6 border-b-4 font-black text-sm uppercase tracking-widest whitespace-nowrap flex items-center gap-3 transition-all">
            Antrean Validasi Member
            @if($pendingUsers->count() > 0)
                <span class="bg-[#da291c] text-white text-[10px] px-2 py-0.5 rounded-full">{{ $pendingUsers->count() }}</span>
            @endif
        </button>
        <button 
            @click="tab = 'active'"
            :class="tab === 'active' ? 'border-[#da291c] text-[#da291c]' : 'border-transparent text-slate-400 hover:text-slate-600'"
            class="pb-6 border-b-4 font-black text-sm uppercase tracking-widest whitespace-nowrap transition-all">
            Database Member Aktif
        </button>
    </div>

    <!-- Table Container -->
    <div>
        <!-- Internal Team Table -->
        <div x-show="tab === 'internal'" class="bg-white rounded-[32px] border border-slate-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50">Identitas User</th>
                            <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50">Informasi Kontak</th>
                            <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50">Otoritas</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($internalTeam as $user)
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-11 h-11 bg-slate-100 rounded-2xl flex items-center justify-center text-slate-500 font-black text-lg border border-slate-200">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="font-bold text-slate-900 group-hover:text-[#da291c] transition-colors">{{ $user->name }}</div>
                                        <div class="text-[10px] text-slate-400 font-medium uppercase tracking-widest">ID: #{{ $user->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="text-sm font-bold text-slate-700">{{ $user->email }}</div>
                            </td>
                            <td class="px-8 py-6">
                                @if($user->role == 'admin')
                                    <span class="bg-purple-50 text-purple-600 px-3 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-wider flex items-center gap-2 w-fit">
                                        <i data-lucide="shield" class="w-3 h-3"></i>
                                        Administrator
                                    </span>
                                @elseif($user->role == 'penulis')
                                    <span class="bg-blue-50 text-blue-600 px-3 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-wider flex items-center gap-2 w-fit">
                                        <i data-lucide="edit-2" class="w-3 h-3"></i>
                                        Penulis / Editor
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pending Validation Table -->
        <div x-show="tab === 'pending'" class="bg-white rounded-[32px] border border-slate-100 shadow-sm overflow-hidden" style="display: none;">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50">Identitas User</th>
                            <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50">Waktu Daftar</th>
                            <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50 text-right">Konfirmasi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($pendingUsers as $user)
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-11 h-11 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-500 font-black text-lg border border-amber-100">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="font-bold text-slate-900 group-hover:text-[#da291c] transition-colors">{{ $user->name }}</div>
                                        <div class="text-[10px] text-slate-400 font-medium tracking-tight">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="text-xs font-bold text-slate-700">{{ $user->created_at->diffForHumans() }}</div>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <div class="flex justify-end gap-3">
                                    <form action="{{ route('admin.users.reject', $user->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-5 py-2.5 bg-slate-100 text-slate-600 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-red-50 hover:text-[#da291c] transition-all">
                                            Tolak
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.users.approve', $user->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-5 py-2.5 bg-[#da291c] text-white rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-[#da291c]/20 hover:-translate-y-1 transition-all">
                                            Terima
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-8 py-20 text-center">
                                <div class="flex flex-col items-center gap-4 opacity-30">
                                    <i data-lucide="inbox" class="w-12 h-12"></i>
                                    <p class="font-black text-sm uppercase tracking-widest">Tidak ada antrean validasi</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Active Members Table -->
        <div x-show="tab === 'active'" class="bg-white rounded-[32px] border border-slate-100 shadow-sm overflow-hidden" style="display: none;">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50">Member Aktif</th>
                            <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50">Kontak</th>
                            <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($activeMembers as $user)
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-11 h-11 bg-green-50 rounded-2xl flex items-center justify-center text-green-500 font-black text-lg border border-green-100">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="font-bold text-slate-900">{{ $user->name }}</div>
                                        <div class="text-[10px] text-slate-400 font-medium">Bergabung {{ $user->created_at->format('M Y') }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="text-sm font-bold text-slate-700">{{ $user->email }}</div>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <form action="{{ route('admin.users.reject', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menonaktifkan member ini?')">
                                    @csrf
                                    <button type="submit" class="w-9 h-9 bg-red-50 text-[#da291c] rounded-lg flex items-center justify-center hover:bg-[#da291c] hover:text-white transition-all mx-auto">
                                        <i data-lucide="user-x" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-8 py-20 text-center">
                                <div class="flex flex-col items-center gap-4 opacity-30">
                                    <i data-lucide="users" class="w-12 h-12"></i>
                                    <p class="font-black text-sm uppercase tracking-widest">Belum ada member aktif</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Create Admin Modal -->
    <div x-show="openCreateModal" 
         x-cloak
         class="fixed inset-0 z-[100] flex items-center justify-center p-6 bg-slate-900/60 backdrop-blur-sm">
        <div @click.away="openCreateModal = false" class="bg-white w-full max-w-lg rounded-[32px] shadow-2xl overflow-hidden animate-in zoom-in duration-300">
            <div class="px-10 py-8 border-b border-slate-100 flex justify-between items-center">
                <h2 class="text-2xl font-black text-slate-900">Tambah Tim Internal</h2>
                <button @click="openCreateModal = false" class="text-slate-400 hover:text-slate-600">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>
            <form action="{{ route('admin.users.store') }}" method="POST" class="p-10">
                @csrf
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Nama Lengkap</label>
                        <input type="text" name="name" required class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm focus:outline-none focus:border-[#da291c] transition-all">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Alamat Email</label>
                        <input type="email" name="email" required class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm focus:outline-none focus:border-[#da291c] transition-all">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Password</label>
                        <input type="password" name="password" required class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm focus:outline-none focus:border-[#da291c] transition-all">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Role / Hak Akses</label>
                        <select name="role" required class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm focus:outline-none focus:border-[#da291c] transition-all">
                            <option value="admin">Administrator (Full Access)</option>
                            <option value="penulis">Penulis / Editor (Content Only)</option>
                        </select>
                    </div>
                </div>
                <div class="mt-10 flex gap-4">
                    <button type="submit" class="flex-1 bg-slate-900 text-white py-4 rounded-2xl font-black text-sm uppercase tracking-widest shadow-xl shadow-slate-900/20">Daftarkan Tim</button>
                    <button type="button" @click="openCreateModal = false" class="px-8 py-4 bg-slate-100 text-slate-500 rounded-2xl font-black text-sm uppercase tracking-widest">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
