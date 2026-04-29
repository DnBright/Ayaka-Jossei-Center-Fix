@extends('layouts.penulis')

@section('page-title', 'Manajemen E-Book Materi')

@section('content')
<div class="ebook-manager-container" x-data="{ 
    openUploadModal: false, 
    openEditModal: false,
    editData: { id: '', title: '', description: '' }
}">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-6">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Manajemen E-Book Materi</h1>
            <p class="text-slate-500 font-medium mt-1">Kelola koleksi materi edukasi digital untuk member Ayaka Josei Center.</p>
        </div>
        <button @click="openUploadModal = true" class="bg-gradient-to-r from-[#da291c] to-[#b91c1c] text-white px-8 py-4 rounded-2xl font-black text-sm uppercase tracking-widest shadow-xl shadow-red-900/20 hover:-translate-y-1 transition-all flex items-center gap-3">
            <i data-lucide="plus" class="w-5 h-5"></i>
            Upload E-Book Baru
        </button>
    </div>

    @if(session('success'))
        <div class="mb-8 p-4 bg-emerald-50 text-emerald-700 rounded-2xl font-bold text-sm border border-emerald-100">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-8 p-4 bg-red-50 text-red-700 rounded-2xl font-bold text-sm border border-red-100">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        <div class="bg-white p-6 rounded-3xl border border-slate-100 flex items-center gap-5 shadow-sm">
            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center"><i data-lucide="book"></i></div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Koleksi</p>
                <p class="text-2xl font-black text-slate-900">{{ $ebooks->total() }} E-Book</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-3xl border border-slate-100 flex items-center gap-5 shadow-sm">
            <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center"><i data-lucide="download"></i></div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Download</p>
                <p class="text-2xl font-black text-slate-900">{{ number_format($ebooks->sum('download_count')) }} Kali</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-3xl border border-slate-100 flex items-center gap-5 shadow-sm">
            <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center"><i data-lucide="eye"></i></div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Views</p>
                <p class="text-2xl font-black text-slate-900">{{ number_format($ebooks->sum('view_count')) }} Views</p>
            </div>
        </div>
    </div>

    <!-- E-Book Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($ebooks as $ebook)
            <div class="bg-white p-6 rounded-[32px] border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all group">
                <div class="flex gap-6 items-start mb-6">
                    <div class="w-24 h-32 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-300 group-hover:bg-red-50 group-hover:text-[#da291c] transition-all relative shrink-0 border border-slate-100 shadow-inner overflow-hidden">
                        @if($ebook->cover_image)
                            <img src="{{ str_starts_with($ebook->cover_image, 'http') ? $ebook->cover_image : asset($ebook->cover_image) }}" class="w-full h-full object-cover">
                        @else
                            <i data-lucide="book" class="w-10 h-10"></i>
                        @endif
                        <span class="absolute -bottom-2 -right-2 bg-white border border-slate-100 px-3 py-1 rounded-full text-[9px] font-black text-blue-600 shadow-sm">
                            <i data-lucide="eye" class="w-2.5 h-2.5 inline mr-1"></i> {{ $ebook->view_count }}
                        </span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-center mb-2">
                            <span class="bg-red-50 text-[#da291c] px-2 py-0.5 rounded text-[8px] font-black uppercase tracking-widest">Materi</span>
                            <span class="bg-emerald-50 text-emerald-600 px-2 py-0.5 rounded text-[8px] font-black uppercase tracking-widest">Published</span>
                        </div>
                        <h4 class="text-lg font-black text-slate-900 line-clamp-2 mb-2 group-hover:text-[#da291c] transition-colors">{{ $ebook->title }}</h4>
                        <p class="text-xs text-slate-400 font-medium leading-relaxed line-clamp-2">{{ $ebook->description }}</p>
                    </div>
                </div>
                <div class="pt-6 border-t border-slate-50 flex justify-between items-center">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic">PDF Format</span>
                    <div class="flex gap-2">
                        <button @click="openEditModal = true; editData = { id: '{{ $ebook->id }}', title: '{{ addslashes($ebook->title) }}', description: '{{ addslashes($ebook->description) }}' }" class="text-xs font-black text-slate-600 hover:bg-slate-50 px-3 py-1.5 rounded-lg transition-colors">Edit</button>
                        <form action="{{ route('admin.ebook.destroy', $ebook->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus E-Book ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-xs font-black text-red-600 hover:bg-red-50 px-3 py-1.5 rounded-lg transition-colors">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-20 text-center text-slate-400 font-bold text-xs uppercase tracking-widest bg-white rounded-[32px] border border-slate-100 shadow-sm">
                Belum ada koleksi E-Book materi
            </div>
        @endforelse
    </div>

    <!-- Upload Modal -->
    <div x-show="openUploadModal" 
         x-cloak
         class="fixed inset-0 z-[100] flex items-center justify-center p-6 bg-slate-900/60 backdrop-blur-sm">
        <div @click.away="openUploadModal = false" class="bg-white w-full max-w-2xl rounded-[32px] shadow-2xl overflow-hidden animate-in zoom-in duration-300">
            <div class="px-10 py-8 border-b border-slate-100 flex justify-between items-center">
                <h2 class="text-2xl font-black text-slate-900">Upload E-Book Baru</h2>
                <button @click="openUploadModal = false" class="text-slate-400 hover:text-slate-600">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>
            <form action="{{ route('admin.ebook.store') }}" method="POST" enctype="multipart/form-data" class="p-10">
                @csrf
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Judul E-Book</label>
                        <input type="text" name="title" required class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm focus:outline-none focus:border-[#da291c] transition-all">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Deskripsi Singkat</label>
                        <textarea name="description" rows="3" required class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm focus:outline-none focus:border-[#da291c] transition-all"></textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">File E-Book (PDF)</label>
                            <input type="file" name="file" required accept=".pdf" class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Cover Image</label>
                            <input type="file" name="cover_image" accept="image/*" class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs">
                        </div>
                    </div>
                </div>
                <div class="mt-10 flex gap-4">
                    <button type="submit" class="flex-1 bg-[#da291c] text-white py-4 rounded-2xl font-black text-sm uppercase tracking-widest shadow-xl shadow-red-900/20">Upload & Simpan</button>
                    <button type="button" @click="openUploadModal = false" class="px-8 py-4 bg-slate-100 text-slate-500 rounded-2xl font-black text-sm uppercase tracking-widest">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div x-show="openEditModal" 
         x-cloak
         class="fixed inset-0 z-[100] flex items-center justify-center p-6 bg-slate-900/60 backdrop-blur-sm">
        <div @click.away="openEditModal = false" class="bg-white w-full max-w-2xl rounded-[32px] shadow-2xl overflow-hidden animate-in zoom-in duration-300">
            <div class="px-10 py-8 border-b border-slate-100 flex justify-between items-center">
                <h2 class="text-2xl font-black text-slate-900">Edit E-Book</h2>
                <button @click="openEditModal = false" class="text-slate-400 hover:text-slate-600">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>
            <form :action="'{{ url('admin/ebook') }}/' + editData.id" method="POST" enctype="multipart/form-data" class="p-10">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Judul E-Book</label>
                        <input type="text" name="title" x-model="editData.title" required class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm focus:outline-none focus:border-[#da291c] transition-all">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Deskripsi Singkat</label>
                        <textarea name="description" x-model="editData.description" rows="3" required class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm focus:outline-none focus:border-[#da291c] transition-all"></textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Ganti File (Opsional)</label>
                            <input type="file" name="file" accept=".pdf" class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Ganti Cover (Opsional)</label>
                            <input type="file" name="cover_image" accept="image/*" class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs">
                        </div>
                    </div>
                </div>
                <div class="mt-10 flex gap-4">
                    <button type="submit" class="flex-1 bg-slate-900 text-white py-4 rounded-2xl font-black text-sm uppercase tracking-widest shadow-xl shadow-slate-900/20">Simpan Perubahan</button>
                    <button type="button" @click="openEditModal = false" class="px-8 py-4 bg-slate-100 text-slate-500 rounded-2xl font-black text-sm uppercase tracking-widest">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
