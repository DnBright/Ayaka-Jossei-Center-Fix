@extends('layouts.admin')

@section('page-title', 'Artikel & Berita')

@section('content')
<div class="artikel-container">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-6">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Artikel & Media Journal</h1>
            <p class="text-slate-500 font-medium mt-1">Kelola semua publikasi artikel dan konten berita di platform.</p>
        </div>
        <a href="{{ route('admin.artikel.create') }}" class="bg-gradient-to-r from-[#da291c] to-[#b91c1c] text-white px-8 py-4 rounded-2xl font-black text-sm uppercase tracking-widest shadow-xl shadow-red-900/20 hover:-translate-y-1 transition-all flex items-center gap-3">
            <i data-lucide="plus" class="w-5 h-5"></i>
            Buat Artikel Baru
        </a>
    </div>

    @if(session('success'))
        <div class="mb-8 p-4 bg-emerald-50 text-emerald-700 rounded-2xl font-bold text-sm border border-emerald-100">
            {{ session('success') }}
        </div>
    @endif

    <!-- Filters -->
    <div class="flex flex-col lg:flex-row justify-between items-center mb-8 gap-6">
        <div class="relative flex-1 w-full lg:max-w-xl">
            <i data-lucide="search" class="absolute left-6 top-1/2 -translate-y-1/2 text-slate-400 w-5 h-5"></i>
            <input type="text" placeholder="Cari berdasarkan judul artikel..." class="w-full pl-16 pr-6 py-4 bg-white border border-slate-200 rounded-full text-sm focus:outline-none focus:border-[#da291c] shadow-sm transition-all">
        </div>
        <div class="text-xs font-black text-slate-400 uppercase tracking-[0.2em]">
            Showing {{ $articles->total() }} Articles
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50">Informasi Artikel</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50">Kategori</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50">Status</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50">Views</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50">Tanggal</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($articles as $art)
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-slate-100 rounded-xl flex items-center justify-center text-slate-400 group-hover:bg-red-50 group-hover:text-[#da291c] transition-colors overflow-hidden">
                                    @if($art->featured_image)
                                        <img src="{{ Storage::url($art->featured_image) }}" class="w-full h-full object-cover">
                                    @else
                                        <i data-lucide="file-text" class="w-5 h-5"></i>
                                    @endif
                                </div>
                                <div>
                                    <div class="font-bold text-slate-900 group-hover:text-[#da291c] transition-colors line-clamp-1">{{ $art->title }}</div>
                                    <div class="text-[10px] text-slate-400 font-medium">/{{ $art->slug }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <span class="bg-blue-50 text-blue-600 px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-wider">{{ $art->category->name ?? 'Uncategorized' }}</span>
                        </td>
                        <td class="px-8 py-6">
                            @if($art->status == 'published')
                                <span class="bg-emerald-50 text-emerald-600 px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-wider">Published</span>
                            @else
                                <span class="bg-slate-100 text-slate-500 px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-wider">Draft</span>
                            @endif
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-2 text-blue-600 font-black">
                                <i data-lucide="eye" class="w-3 h-3"></i>
                                {{ number_format($art->views_count) }}
                            </div>
                        </td>
                        <td class="px-8 py-6 text-sm font-bold text-slate-500">{{ $art->created_at->format('d M Y') }}</td>
                        <td class="px-8 py-6 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.artikel.edit', $art->id) }}" class="w-9 h-9 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                    <i data-lucide="edit-2" class="w-4 h-4"></i>
                                </a>
                                <form action="{{ route('admin.artikel.destroy', $art->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-9 h-9 bg-red-50 text-[#da291c] rounded-lg flex items-center justify-center hover:bg-[#da291c] hover:text-white transition-all shadow-sm">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-8 py-20 text-center text-slate-400 font-bold text-xs uppercase tracking-widest">Belum ada artikel dipublikasikan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-8 py-4 border-t border-slate-50">
            {{ $articles->links() }}
        </div>
    </div>

</div>
@endsection
