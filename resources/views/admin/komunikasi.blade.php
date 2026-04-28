@extends('layouts.admin')

@section('page-title', 'Pusat Komunikasi Inbound')

@section('content')
<div class="comm-page-container">
    <!-- Stats Row -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-white p-8 rounded-[32px] border border-slate-100 shadow-sm flex items-center gap-6">
            <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-900/5">
                <i data-lucide="inbox" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Pesan</p>
                <p class="text-3xl font-black text-slate-900 leading-none">156</p>
            </div>
        </div>
        <div class="bg-white p-8 rounded-[32px] border border-slate-100 shadow-sm flex items-center gap-6">
            <div class="w-14 h-14 bg-red-50 text-red-600 rounded-2xl flex items-center justify-center shadow-lg shadow-red-900/5">
                <i data-lucide="alert-circle" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Belum Dibaca</p>
                <p class="text-3xl font-black text-slate-900 leading-none">12</p>
            </div>
        </div>
        <div class="bg-white p-8 rounded-[32px] border border-slate-100 shadow-sm flex items-center gap-6">
            <div class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center shadow-lg shadow-emerald-900/5">
                <i data-lucide="check-circle-2" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Selesai</p>
                <p class="text-3xl font-black text-slate-900 leading-none">144</p>
            </div>
        </div>
    </div>

    <!-- Main Layout -->
    <div class="flex flex-col lg:flex-row gap-8 h-[calc(100vh-320px)] min-h-[600px]">
        <!-- List Sidebar -->
        <div class="w-full lg:w-1/3 bg-white rounded-[32px] border border-slate-100 shadow-sm flex flex-col overflow-hidden">
            <div class="p-6 border-b border-slate-50">
                <h3 class="text-xl font-black text-slate-900 mb-6">Pesan Masuk</h3>
                <div class="relative mb-6">
                    <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 w-4 h-4"></i>
                    <input type="text" placeholder="Cari nama atau pesan..." class="w-full pl-11 pr-4 py-3 bg-slate-50 border-none rounded-xl text-sm focus:ring-2 focus:ring-red-500/20 transition-all">
                </div>
                <div class="flex bg-slate-100 p-1 rounded-xl">
                    <button class="flex-1 py-2 px-3 bg-white text-[#da291c] font-black text-[10px] uppercase tracking-widest rounded-lg shadow-sm">Semua</button>
                    <button class="flex-1 py-2 px-3 text-slate-400 font-black text-[10px] uppercase tracking-widest rounded-lg">Baru</button>
                    <button class="flex-1 py-2 px-3 text-slate-400 font-black text-[10px] uppercase tracking-widest rounded-lg">Selesai</button>
                </div>
            </div>
            <div class="flex-1 overflow-y-auto custom-scrollbar">
                @php
                    $messages = [
                        ['name' => 'Budi Santoso', 'subject' => 'Pertanyaan Program Tokutei Ginou', 'time' => '10:30', 'status' => 'unread'],
                        ['name' => 'Siti Aminah', 'subject' => 'Konfirmasi Pembayaran Batch 12', 'time' => 'Yesterday', 'status' => 'read'],
                        ['name' => 'Andi Wijaya', 'subject' => 'Masalah Login Member', 'time' => '24 Apr', 'status' => 'replied'],
                        ['name' => 'Dewi Lestari', 'subject' => 'Request Brosur Pelatihan', 'time' => '23 Apr', 'status' => 'read'],
                        ['name' => 'Eko Prasetyo', 'subject' => 'Tanya Jadwal Interview', 'time' => '22 Apr', 'status' => 'replied'],
                    ];
                @endphp

                @foreach($messages as $msg)
                    <div class="p-6 border-b border-slate-50 hover:bg-slate-50/50 cursor-pointer transition-colors relative group {{ $msg['status'] == 'unread' ? 'bg-red-50/30' : '' }}">
                        <div class="flex gap-4 items-center mb-2">
                            <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 font-black text-xs">
                                {{ substr($msg['name'], 0, 1) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between items-center mb-1">
                                    <h4 class="text-sm font-black text-slate-900 truncate">{{ $msg['name'] }}</h4>
                                    <span class="text-[9px] font-bold text-slate-400">{{ $msg['time'] }}</span>
                                </div>
                                <p class="text-[11px] font-bold text-slate-600 truncate mb-1">{{ $msg['subject'] }}</p>
                                <div class="flex justify-between items-center">
                                    <p class="text-[10px] text-slate-400 truncate flex-1 mr-4">Halo admin, saya ingin bertanya mengenai persyaratan program...</p>
                                    @if($msg['status'] == 'unread')
                                        <span class="bg-red-500 w-2 h-2 rounded-full"></span>
                                    @elseif($msg['status'] == 'replied')
                                        <i data-lucide="check-circle-2" class="w-3 h-3 text-emerald-500"></i>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="absolute right-4 top-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 group-hover:translate-x-0 -translate-x-2 transition-all">
                            <i data-lucide="chevron-right" class="w-4 h-4 text-[#da291c]"></i>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Detail Area -->
        <div class="flex-1 bg-white rounded-[32px] border border-slate-100 shadow-sm flex flex-col overflow-hidden relative">
            <!-- Empty State if no message selected -->
            <div class="flex-1 flex flex-col items-center justify-center text-center p-12">
                <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mb-6 text-slate-200">
                    <i data-lucide="inbox" class="w-12 h-12"></i>
                </div>
                <h3 class="text-2xl font-black text-slate-800 mb-2">Workflow Komunikasi</h3>
                <p class="text-slate-400 max-w-xs text-sm font-medium">Pilih salah satu pesan dari daftar inbound untuk mulai mengelola interaksi Anda.</p>
            </div>
        </div>
    </div>
</div>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #f1f5f9; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #e2e8f0; }
</style>
@endsection
