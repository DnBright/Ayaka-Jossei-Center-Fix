@extends('layouts.admin')

@section('page-title', 'Manajemen User & Role')

@section('content')
<div class="user-manager-container">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-6">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Manajemen Hak Akses & User</h1>
            <p class="text-slate-500 font-medium mt-1">Kelola tim internal, editor, dan validasi keanggotaan member Ayaka.</p>
        </div>
        <button class="bg-slate-900 text-white px-8 py-4 rounded-2xl font-black text-sm uppercase tracking-widest shadow-xl hover:-translate-y-1 transition-all flex items-center gap-3">
            <i data-lucide="plus" class="w-5 h-5"></i>
            Tambah Admin Baru
        </button>
    </div>

    <!-- Tabs -->
    <div class="flex gap-10 border-b-2 border-slate-100 mb-10 overflow-x-auto pb-1">
        <button class="pb-6 border-b-4 border-[#da291c] text-[#da291c] font-black text-sm uppercase tracking-widest whitespace-nowrap">
            Tim Internal Ayaka
        </button>
        <button class="pb-6 border-b-4 border-transparent text-slate-400 hover:text-slate-600 font-black text-sm uppercase tracking-widest whitespace-nowrap flex items-center gap-3">
            Antrean Validasi Member
            <span class="bg-[#da291c] text-white text-[10px] px-2 py-0.5 rounded-full">3</span>
        </button>
        <button class="pb-6 border-b-4 border-transparent text-slate-400 hover:text-slate-600 font-black text-sm uppercase tracking-widest whitespace-nowrap">
            Database Member Aktif
        </button>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50">Identitas User</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50">Informasi Kontak</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50">Otoritas / Status</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @php
                        $users = [
                            ['name' => 'Admin Utama', 'email' => 'admin@ayakajosei.com', 'role' => 'Super Admin', 'status' => 'Active'],
                            ['name' => 'Editor Konten', 'email' => 'editor@ayakajosei.com', 'role' => 'Editor', 'status' => 'Active'],
                            ['name' => 'Budi Santoso', 'email' => 'budi@gmail.com', 'role' => 'Penulis', 'status' => 'Active'],
                            ['name' => 'Siti Aminah', 'email' => 'siti@gmail.com', 'role' => 'Member', 'status' => 'Active'],
                        ];
                    @endphp

                    @foreach($users as $user)
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-4">
                                <div class="w-11 h-11 bg-slate-100 rounded-2xl flex items-center justify-center text-slate-500 font-black text-lg border border-slate-200">
                                    {{ substr($user['name'], 0, 1) }}
                                </div>
                                <div>
                                    <div class="font-bold text-slate-900 group-hover:text-[#da291c] transition-colors">{{ $user['name'] }}</div>
                                    <div class="text-[10px] text-slate-400 font-medium uppercase tracking-widest">UID-00{{ $loop->iteration }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <div class="text-sm font-bold text-slate-700">{{ $user['email'] }}</div>
                        </td>
                        <td class="px-8 py-6">
                            @if($user['role'] == 'Super Admin')
                                <span class="bg-purple-50 text-purple-600 px-3 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-wider flex items-center gap-2 w-fit">
                                    <i data-lucide="shield" class="w-3 h-3"></i>
                                    Super Admin
                                </span>
                            @elseif($user['role'] == 'Editor')
                                <span class="bg-blue-50 text-blue-600 px-3 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-wider flex items-center gap-2 w-fit">
                                    <i data-lucide="edit-2" class="w-3 h-3"></i>
                                    Editor
                                </span>
                            @else
                                <span class="bg-slate-100 text-slate-600 px-3 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-wider flex items-center gap-2 w-fit">
                                    <i data-lucide="user" class="w-3 h-3"></i>
                                    {{ $user['role'] }}
                                </span>
                            @endif
                        </td>
                        <td class="px-8 py-6 text-right">
                            <div class="flex justify-end gap-2">
                                <button class="w-9 h-9 bg-slate-100 text-slate-600 rounded-lg flex items-center justify-center hover:bg-slate-900 hover:text-white transition-all">
                                    <i data-lucide="more-vertical" class="w-4 h-4"></i>
                                </button>
                                <button class="w-9 h-9 bg-red-50 text-[#da291c] rounded-lg flex items-center justify-center hover:bg-[#da291c] hover:text-white transition-all shadow-sm">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
