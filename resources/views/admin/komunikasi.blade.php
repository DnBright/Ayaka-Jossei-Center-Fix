@extends('layouts.admin')

@section('page-title', 'Pusat Komunikasi Inbound')

@section('content')
<div class="comm-page-container" x-data="{ 
    selectedMessage: null,
    messages: {{ $messages->toJson() }},
    selectMessage(msg) {
        this.selectedMessage = msg;
        if(!msg.is_read) {
            // Mark as read via AJAX or just update local state
            fetch(`/admin/komunikasi/${msg.id}/read`, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            });
            msg.is_read = 1;
        }
    }
}">
    <!-- Stats Row -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-white p-8 rounded-[32px] border border-slate-100 shadow-sm flex items-center gap-6">
            <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-900/5">
                <i data-lucide="inbox" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Pesan</p>
                <p class="text-3xl font-black text-slate-900 leading-none">{{ $messages->total() }}</p>
            </div>
        </div>
        <div class="bg-white p-8 rounded-[32px] border border-slate-100 shadow-sm flex items-center gap-6">
            <div class="w-14 h-14 bg-red-50 text-red-600 rounded-2xl flex items-center justify-center shadow-lg shadow-red-900/5">
                <i data-lucide="alert-circle" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Belum Dibaca</p>
                <p class="text-3xl font-black text-slate-900 leading-none">{{ $messages->where('is_read', false)->count() }}</p>
            </div>
        </div>
        <div class="bg-white p-8 rounded-[32px] border border-slate-100 shadow-sm flex items-center gap-6">
            <div class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center shadow-lg shadow-emerald-900/5">
                <i data-lucide="check-circle-2" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Sudah Dibaca</p>
                <p class="text-3xl font-black text-slate-900 leading-none">{{ $messages->where('is_read', true)->count() }}</p>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-8 p-4 bg-emerald-50 text-emerald-700 rounded-2xl font-bold text-sm border border-emerald-100">
            {{ session('success') }}
        </div>
    @endif

    <!-- Main Layout -->
    <div class="flex flex-col lg:flex-row gap-8 h-[calc(100vh-320px)] min-h-[600px]">
        <!-- List Sidebar -->
        <div class="w-full lg:w-1/3 bg-white rounded-[32px] border border-slate-100 shadow-sm flex flex-col overflow-hidden">
            <div class="p-6 border-b border-slate-50">
                <h3 class="text-xl font-black text-slate-900 mb-6">Pesan Masuk</h3>
                <div class="relative">
                    <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 w-4 h-4"></i>
                    <input type="text" placeholder="Cari pesan..." class="w-full pl-11 pr-4 py-3 bg-slate-50 border-none rounded-xl text-sm focus:ring-2 focus:ring-red-500/20 transition-all">
                </div>
            </div>
            <div class="flex-1 overflow-y-auto custom-scrollbar">
                @forelse($messages as $msg)
                    <div @click='selectMessage(@json($msg))' 
                         :class="selectedMessage && selectedMessage.id === {{ $msg->id }} ? 'bg-slate-50' : ''"
                         class="p-6 border-b border-slate-50 hover:bg-slate-50/50 cursor-pointer transition-colors relative group">
                        <div class="flex gap-4 items-center mb-2">
                            <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 font-black text-xs">
                                {{ substr($msg->name, 0, 1) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between items-center mb-1">
                                    <h4 class="text-sm font-black text-slate-900 truncate">{{ $msg->name }}</h4>
                                    <span class="text-[9px] font-bold text-slate-400">{{ $msg->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-[11px] font-bold text-slate-600 truncate mb-1">{{ $msg->subject }}</p>
                                <div class="flex justify-between items-center">
                                    <p class="text-[10px] text-slate-400 truncate flex-1 mr-4">{{ $msg->message }}</p>
                                    <template x-if="!{{ $msg->is_read }}">
                                        <span class="bg-red-500 w-2 h-2 rounded-full"></span>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-20 text-center text-slate-400 font-bold text-xs uppercase tracking-widest">
                        Inbox Kosong
                    </div>
                @endforelse
            </div>
            <div class="p-4 border-t border-slate-50">
                {{ $messages->links() }}
            </div>
        </div>

        <!-- Detail Area -->
        <div class="flex-1 bg-white rounded-[32px] border border-slate-100 shadow-sm flex flex-col overflow-hidden relative">
            <template x-if="selectedMessage">
                <div class="flex-1 flex flex-col">
                    <div class="p-10 border-b border-slate-50 flex justify-between items-start">
                        <div class="flex gap-6 items-center">
                            <div class="w-16 h-16 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-400 font-black text-xl">
                                <span x-text="selectedMessage.name.charAt(0)"></span>
                            </div>
                            <div>
                                <h3 class="text-2xl font-black text-slate-900" x-text="selectedMessage.name"></h3>
                                <p class="text-sm font-bold text-slate-400" x-text="selectedMessage.email"></p>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <form :action="`/admin/komunikasi/${selectedMessage.id}`" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-4 bg-red-50 text-[#da291c] rounded-2xl hover:bg-[#da291c] hover:text-white transition-all">
                                    <i data-lucide="trash-2" class="w-5 h-5"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="flex-1 p-10 overflow-y-auto">
                        <div class="mb-8">
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">Subject</span>
                            <h4 class="text-xl font-black text-slate-800" x-text="selectedMessage.subject"></h4>
                        </div>
                        <div>
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-4">Message Content</span>
                            <div class="bg-slate-50 p-8 rounded-[32px] text-slate-600 leading-relaxed font-medium" x-text="selectedMessage.message"></div>
                        </div>
                    </div>
                    <div class="p-10 bg-slate-50/50 border-t border-slate-50">
                        <a :href="`mailto:${selectedMessage.email}`" class="inline-flex items-center gap-3 bg-slate-900 text-white px-8 py-4 rounded-2xl font-black text-sm uppercase tracking-widest shadow-xl shadow-slate-900/20 hover:-translate-y-1 transition-all">
                            <i data-lucide="mail" class="w-5 h-5"></i>
                            Balas via Email
                        </a>
                    </div>
                </div>
            </template>
            <template x-if="!selectedMessage">
                <div class="flex-1 flex flex-col items-center justify-center text-center p-12">
                    <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mb-6 text-slate-200">
                        <i data-lucide="inbox" class="w-12 h-12"></i>
                    </div>
                    <h3 class="text-2xl font-black text-slate-800 mb-2">Pilih Pesan</h3>
                    <p class="text-slate-400 max-w-xs text-sm font-medium">Klik salah satu pesan di samping untuk membaca detail pengiriman.</p>
                </div>
            </template>
        </div>
    </div>
</div>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #f1f5f9; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #e2e8f0; }
</style>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #f1f5f9; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #e2e8f0; }
</style>
@endsection
