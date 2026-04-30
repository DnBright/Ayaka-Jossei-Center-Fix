@extends('layouts.penulis')

@section('page-title', $article ? 'Edit Artikel' : 'Tulis Artikel Baru')

@section('content')
<div x-data="{ publishStatus: '{{ old('status', $initialStatus) }}' }" class="min-h-screen bg-slate-50 p-4 lg:p-8 -m-8">
    <div class="max-w-7xl mx-auto">
        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-black text-slate-800">
                {{ $article ? 'Edit Artikel' : 'Tulis Artikel Baru' }}
            </h1>
            <a href="{{ route('penulis.artikel.index') }}" class="text-slate-600 hover:text-slate-800 bg-white border border-slate-300 rounded-xl px-4 py-2 text-sm font-semibold flex items-center gap-2 hover:border-slate-400 transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Kembali
            </a>
        </div>

        {{-- Error Messages --}}
        @if($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700 text-sm font-medium">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Success Flash --}}
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ $formAction }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if($formMethod === 'PUT')
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                {{-- Main Content --}}
                <div class="lg:col-span-3 space-y-5">
                    {{-- Title --}}
                    <input
                        type="text"
                        name="title"
                        id="article-title"
                        required
                        placeholder="Masukkan judul artikel..."
                        value="{{ old('title', $article?->title) }}"
                        class="w-full text-2xl border border-slate-200 px-5 py-4 bg-white rounded-2xl shadow-sm focus:outline-none focus:border-[#da291c] focus:ring-2 focus:ring-red-100 font-bold text-slate-800 placeholder-slate-300"
                    >

                    {{-- TinyMCE Editor --}}
                    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
                        <div class="px-5 py-3 border-b border-slate-100 text-sm font-bold text-slate-500 uppercase tracking-widest">Konten Artikel</div>
                        <div class="p-4">
                            <textarea
                                name="content"
                                id="article-content"
                                rows="20"
                                required
                                placeholder="Mulai menulis konten artikel Anda..."
                                class="w-full px-4 py-3 text-sm text-slate-700 focus:outline-none border border-slate-200 rounded-xl"
                            >{{ old('content', $article?->content) }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="space-y-5">
                    {{-- Publish Panel --}}
                    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
                        <div class="px-5 py-3 border-b border-slate-100 text-sm font-bold text-slate-500 uppercase tracking-widest">Publikasi</div>
                        <div class="p-4 space-y-4">
                            {{-- Status Indicator --}}
                            <div class="flex items-center gap-2 text-sm text-slate-600">
                                <i data-lucide="circle-dot" class="w-4 h-4 text-amber-500"></i>
                                Status: <span class="font-bold text-slate-800" x-text="publishStatus"></span>
                            </div>

                            {{-- Member Only Toggle --}}
                            <div class="flex items-center justify-between py-2 border-y border-slate-100">
                                <div class="flex items-center gap-2 text-sm text-slate-600">
                                    <i data-lucide="users" class="w-4 h-4"></i>
                                    <span>Khusus Member</span>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="is_member_only" value="1" class="sr-only peer" {{ old('is_member_only', $article?->is_member_only) ? 'checked' : '' }}>
                                    <div class="w-9 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#da291c]"></div>
                                </label>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="flex flex-col gap-2">
                                <button
                                    type="submit"
                                    name="status"
                                    value="published"
                                    @click="publishStatus = 'published'"
                                    class="w-full bg-gradient-to-r from-[#da291c] to-[#b91c1c] text-white py-2.5 rounded-xl text-sm font-black uppercase tracking-widest shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all"
                                >
                                    <i data-lucide="send" class="w-4 h-4 inline mr-1"></i>
                                    {{ $article ? 'Update & Terbitkan' : 'Terbitkan' }}
                                </button>
                                <button
                                    type="submit"
                                    name="status"
                                    value="draft"
                                    @click="publishStatus = 'draft'"
                                    class="w-full border border-slate-300 bg-white text-slate-700 py-2.5 rounded-xl text-sm font-bold hover:bg-slate-50 transition-all"
                                >
                                    <i data-lucide="save" class="w-4 h-4 inline mr-1"></i>
                                    Simpan Draft
                                </button>
                                @if($article)
                                <form id="penulis-delete-form" action="{{ route('penulis.artikel.destroy', $article->id) }}" method="POST" class="w-full">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="button"
                                        onclick="if(confirm('Yakin ingin menghapus artikel ini?')) document.getElementById('penulis-delete-form').submit();"
                                        class="w-full border border-red-200 bg-red-50 text-red-600 py-2.5 rounded-xl text-sm font-bold hover:bg-red-100 transition-all"
                                    >
                                        <i data-lucide="trash-2" class="w-4 h-4 inline mr-1"></i>
                                        Hapus Artikel
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Categories Panel --}}
                    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
                        <div class="px-5 py-3 border-b border-slate-100 text-sm font-bold text-slate-500 uppercase tracking-widest">Kategori</div>
                        <div class="p-4">
                            <div class="max-h-48 overflow-y-auto space-y-2 mb-3">
                                @forelse($categories as $cat)
                                    <label class="flex items-center gap-3 text-sm text-slate-700 hover:text-[#da291c] cursor-pointer">
                                        <input
                                            type="radio"
                                            name="category_id"
                                            value="{{ $cat->id }}"
                                            class="accent-[#da291c] w-4 h-4"
                                            {{ (string)old('category_id', $article?->category_id) === (string)$cat->id ? 'checked' : '' }}
                                        >
                                        <span class="font-medium">{{ $cat->name }}</span>
                                    </label>
                                @empty
                                    <p class="text-xs text-slate-400">Belum ada kategori.</p>
                                @endforelse
                            </div>
                            <div class="border-t border-slate-100 pt-3">
                                <label class="block text-[11px] font-bold text-slate-400 mb-1 uppercase tracking-wider">Tambah Kategori Baru</label>
                                <input
                                    type="text"
                                    name="new_category"
                                    value="{{ old('new_category') }}"
                                    placeholder="Nama kategori..."
                                    class="w-full border border-slate-200 text-xs px-3 py-2 rounded-lg focus:outline-none focus:border-[#da291c]"
                                >
                                <p class="text-[11px] text-slate-400 mt-1">Kosongkan jika sudah memilih kategori di atas.</p>
                            </div>
                        </div>
                    </div>

                    {{-- Featured Image Panel --}}
                    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
                        <div class="px-5 py-3 border-b border-slate-100 text-sm font-bold text-slate-500 uppercase tracking-widest">Gambar Utama</div>
                        <div class="p-4">
                            {{-- Preview --}}
                            <div class="bg-slate-100 h-32 border border-dashed border-slate-300 rounded-xl flex items-center justify-center text-xs text-slate-400 mb-3 overflow-hidden">
                                @if($article?->featured_image)
                                    @if(str_starts_with($article->featured_image, 'http'))
                                        <img src="{{ $article->featured_image }}" class="w-full h-full object-cover" alt="Featured">
                                    @else
                                        <img src="{{ asset($article->featured_image) }}" class="w-full h-full object-cover" alt="Featured">
                                    @endif
                                @else
                                    <span>Belum ada gambar</span>
                                @endif
                            </div>
                            <label class="block text-[11px] font-bold text-slate-400 mb-1 uppercase tracking-wider">URL Gambar</label>
                            <input
                                type="url"
                                name="featured_image_url"
                                placeholder="https://example.com/gambar.jpg"
                                value="{{ old('featured_image_url', $article && str_starts_with($article->featured_image ?? '', 'http') ? $article->featured_image : '') }}"
                                class="w-full border border-slate-200 text-xs px-3 py-2 mb-3 rounded-lg focus:outline-none focus:border-[#da291c]"
                            >
                            <label class="block text-[11px] font-bold text-slate-400 mb-1 uppercase tracking-wider">Upload Gambar</label>
                            <input type="file" name="featured_image" accept="image/*" class="w-full border border-slate-200 text-xs px-2 py-1.5 rounded-lg">
                            <p class="text-[11px] text-slate-400 mt-2">Format: JPG, PNG, WebP. Maks 2MB.</p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.3/tinymce.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        tinymce.init({
            selector: '#article-content',
            plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table wordcount',
            toolbar: 'undo redo | blocks | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | removeformat | code',
            height: 500,
            menubar: false,
            content_style: 'body { font-family: Inter, Outfit, sans-serif; font-size: 16px; color: #334155; line-height: 1.75; }',
            branding: false,
            promotion: false,
            setup: function(editor) {
                editor.on('change', function() {
                    editor.save();
                });
            }
        });
    });
</script>
@endpush
