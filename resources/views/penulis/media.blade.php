@extends('layouts.penulis')

@section('page-title', 'Media Library Ayaka')

@section('content')
<div class="media-manager-container" x-data="{ openUploadModal: false, openEditModal: false, editData: { id: null, title: '', type: 'gallery' } }">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-6">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Media Library Ayaka</h1>
            <p class="text-slate-500 font-medium mt-1">Kelola koleksi aset visual, dokumentasi, dan media konten edukasi.</p>
        </div>
        <button @click="openUploadModal = true" class="bg-gradient-to-r from-[#da291c] to-[#b91c1c] text-white px-8 py-4 rounded-2xl font-black text-sm uppercase tracking-widest shadow-xl shadow-red-900/20 hover:-translate-y-1 transition-all flex items-center gap-3">
            <i data-lucide="upload" class="w-5 h-5"></i>
            Upload Media Baru
        </button>
    </div>

    @if(session('success'))
        <div class="mb-8 p-4 bg-emerald-50 text-emerald-700 rounded-2xl font-bold text-sm border border-emerald-100">
            {{ session('success') }}
        </div>
    @endif

    <!-- Toolbar -->
    <div class="bg-white rounded-[24px] p-4 border border-slate-100 shadow-sm mb-10">
        <form action="{{ route('penulis.media.index') }}" method="GET" class="flex flex-col lg:flex-row justify-between items-center gap-6">
            <div class="relative flex-1 w-full lg:max-w-md">
                <i data-lucide="search" class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 w-5 h-5"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Telusuri aset media..." class="w-full pl-14 pr-6 py-3.5 bg-slate-50 border border-slate-100 rounded-xl text-sm focus:outline-none focus:border-[#da291c] transition-all">
            </div>
            <div class="flex items-center gap-4 w-full lg:w-auto">
                <select name="type" onchange="this.form.submit()" class="px-6 py-3.5 bg-slate-50 border border-slate-100 rounded-xl text-xs font-black uppercase tracking-widest focus:outline-none focus:border-[#da291c] transition-all">
                    <option value="all">Semua Kategori</option>
                    <option value="gallery" {{ request('type') == 'gallery' ? 'selected' : '' }}>Galeri</option>
                    <option value="banner" {{ request('type') == 'banner' ? 'selected' : '' }}>Banner</option>
                    <option value="content" {{ request('type') == 'content' ? 'selected' : '' }}>Konten</option>
                </select>
                <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest bg-slate-50 px-4 py-3.5 rounded-xl border border-slate-100">
                    {{ $media->total() }} Assets
                </div>
            </div>
        </form>
    </div>

    <!-- Media Grid -->
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-6">
        @forelse($media as $item)
            <div class="bg-white rounded-3xl border border-slate-100 overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all group relative">
                <div class="aspect-square bg-slate-50 relative overflow-hidden">
                    @php
                        $imageSource = str_starts_with($item->file_path, 'http')
                            ? $item->file_path
                            : asset($item->file_path);
                    @endphp
                    <img src="{{ $imageSource }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-[2px] opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center gap-3">
                        <div class="flex gap-3">
                            <button @click="editData = { id: {{ $item->id }}, title: '{{ addslashes($item->title) }}', type: '{{ $item->type }}' }; openEditModal = true" class="w-10 h-10 bg-blue-600 text-white rounded-xl flex items-center justify-center hover:bg-blue-700 transition-all shadow-lg shadow-blue-900/20" title="Edit Media"><i data-lucide="edit" class="w-5 h-5"></i></button>
                            <form action="{{ route('penulis.media.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus media ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-10 h-10 bg-red-600 text-white rounded-xl flex items-center justify-center hover:bg-red-700 transition-all shadow-lg shadow-red-900/20" title="Hapus Media"><i data-lucide="trash-2" class="w-5 h-5"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="p-4">
                    <h5 class="text-[11px] font-black text-slate-900 truncate mb-1" title="{{ $item->title }}">{{ $item->title }}</h5>
                    <div class="flex items-center justify-between text-[9px] font-bold text-slate-400 uppercase tracking-widest">
                        <span>{{ round(($item->file_size ?? 0) / 1024, 1) }} KB</span>
                        <span class="w-1 h-1 bg-slate-200 rounded-full"></span>
                        <span>{{ $item->created_at->format('d/m/y') }}</span>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-20 text-center text-slate-400 font-bold text-xs uppercase tracking-widest bg-white rounded-[32px] border border-slate-100 shadow-sm">
                Media Library kosong
            </div>
        @endforelse
    </div>
    
    <div class="mt-10">
        {{ $media->links() }}
    </div>

    <!-- Upload Modal -->
    <div x-show="openUploadModal" 
         x-cloak
         class="fixed inset-0 z-[100] flex items-center justify-center p-6 bg-slate-900/60 backdrop-blur-sm">
        <div @click.away="openUploadModal = false" class="bg-white w-full max-w-lg rounded-[32px] shadow-2xl overflow-hidden animate-in zoom-in duration-300">
            <div class="px-10 py-8 border-b border-slate-100 flex justify-between items-center">
                <h2 class="text-2xl font-black text-slate-900">Upload Media Baru</h2>
                <button @click="openUploadModal = false" class="text-slate-400 hover:text-slate-600">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>
            <form action="{{ route('penulis.media.store') }}" method="POST" enctype="multipart/form-data" class="p-10">
                @csrf
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Pilih File (Gambar)</label>
                        <input type="file" name="file" required accept="image/*" class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Judul Media (Opsional)</label>
                        <input type="text" name="title" class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm focus:outline-none focus:border-[#da291c] transition-all">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Kategori Media</label>
                        <select name="type" required class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm focus:outline-none focus:border-[#da291c] transition-all">
                            <option value="gallery">Galeri Kegiatan</option>
                            <option value="banner">Banner / Slider</option>
                            <option value="content">Konten Umum</option>
                        </select>
                    </div>
                </div>
                <div class="mt-10 flex gap-4">
                    <button type="submit" class="flex-1 bg-[#da291c] text-white py-4 rounded-2xl font-black text-sm uppercase tracking-widest shadow-xl shadow-red-900/20">Upload & Publish</button>
                    <button type="button" @click="openUploadModal = false" class="px-8 py-4 bg-slate-100 text-slate-500 rounded-2xl font-black text-sm uppercase tracking-widest">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div x-show="openEditModal" 
         x-cloak
         class="fixed inset-0 z-[100] flex items-center justify-center p-6 bg-slate-900/60 backdrop-blur-sm">
        <div @click.away="openEditModal = false" class="bg-white w-full max-w-lg rounded-[32px] shadow-2xl overflow-hidden animate-in zoom-in duration-300">
            <div class="px-10 py-8 border-b border-slate-100 flex justify-between items-center">
                <h2 class="text-2xl font-black text-slate-900">Edit Media</h2>
                <button @click="openEditModal = false" class="text-slate-400 hover:text-slate-600">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>
            <form :action="'{{ url('penulis/media') }}/' + editData.id" method="POST" class="p-10">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Judul Media</label>
                        <input type="text" name="title" x-model="editData.title" class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm focus:outline-none focus:border-[#da291c] transition-all">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Kategori Media</label>
                        <select name="type" x-model="editData.type" required class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm focus:outline-none focus:border-[#da291c] transition-all">
                            <option value="gallery">Galeri Kegiatan</option>
                            <option value="banner">Banner / Slider</option>
                            <option value="content">Konten Umum</option>
                        </select>
                    </div>
                </div>
                <div class="mt-10 flex gap-4">
                    <button type="submit" class="flex-1 bg-blue-600 text-white py-4 rounded-2xl font-black text-sm uppercase tracking-widest shadow-xl shadow-blue-900/20 hover:bg-blue-700 transition-all">Simpan Perubahan</button>
                    <button type="button" @click="openEditModal = false" class="px-8 py-4 bg-slate-100 text-slate-500 rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-slate-200 transition-all">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
