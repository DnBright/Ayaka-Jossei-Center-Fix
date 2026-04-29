@extends($layout ?? 'layouts.admin')

@section('page-title', $article ? 'Edit Post' : 'Add New Post')

@section('content')
<div x-data="{ publishStatus: '{{ old('status', $initialStatus) }}' }" class="min-h-screen bg-[#f0f0f1] p-4 lg:p-8 -m-8">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-normal text-slate-800">{{ $article ? 'Edit Post' : 'Add New Post' }}</h1>
            <a href="{{ Auth::user()->role === 'admin' ? route('admin.artikel.index') : route('penulis.artikel.index') }}" class="text-slate-600 hover:text-slate-800 bg-white border border-slate-300 rounded px-3 py-2 text-sm">
                Kembali
            </a>
        </div>

        @if($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded text-red-700 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ $formAction }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if($formMethod === 'PUT')
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                <div class="lg:col-span-3">
                    <input
                        type="text"
                        name="title"
                        required
                        placeholder="Enter title here"
                        value="{{ old('title', $article?->title) }}"
                        class="w-full text-2xl border border-[#dcdcde] px-4 py-3 bg-white shadow-sm focus:outline-none focus:border-[#8c8f94] focus:ring-1 focus:ring-[#8c8f94] mb-5"
                    >

                    <button type="button" class="inline-flex items-center gap-2 border border-[#dcdcde] bg-[#f6f7f7] text-[#2271b1] px-3 py-1.5 text-sm rounded mb-4 hover:bg-[#f0f0f1]">
                        <i data-lucide="image" class="w-4 h-4"></i>
                        Add Media
                    </button>

                    <div class="bg-white border border-[#dcdcde]">
                        <textarea
                            name="content"
                            rows="16"
                            required
                            placeholder="Start writing..."
                            class="w-full px-4 py-4 text-sm text-slate-700 focus:outline-none"
                        >{{ old('content', $article?->content) }}</textarea>
                    </div>

                    <div class="bg-white border border-[#dcdcde] mt-6">
                        <div class="px-4 py-2 border-b border-[#dcdcde] text-sm font-semibold text-slate-700">Excerpt</div>
                        <div class="p-4">
                            <textarea
                                rows="3"
                                placeholder="Write a short summary..."
                                class="w-full border border-[#dcdcde] px-3 py-2 text-sm text-slate-600 focus:outline-none focus:border-[#8c8f94]"
                            ></textarea>
                            <p class="text-xs text-slate-500 mt-2">Excerpts are optional hand-crafted summaries of your content.</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-5">
                    <div class="bg-white border border-[#dcdcde] shadow-sm">
                        <div class="px-4 py-2 border-b border-[#dcdcde] text-sm font-semibold text-slate-700">Publish</div>
                        <div class="p-4 text-sm space-y-4">
                            <div class="flex justify-between">
                                <button type="submit" name="status" value="draft" @click="publishStatus = 'draft'" class="border border-[#dcdcde] bg-[#f6f7f7] text-[#2271b1] px-3 py-1.5 rounded text-xs font-semibold hover:bg-[#f0f0f1]">
                                    Save Draft
                                </button>
                                @if($article)
                                    <a href="{{ route('blog.show', $article->slug) }}" target="_blank" class="border border-[#dcdcde] bg-[#f6f7f7] text-[#2271b1] px-3 py-1.5 rounded text-xs font-semibold hover:bg-[#f0f0f1] inline-block text-center no-underline">
                                        Preview
                                    </a>
                                @else
                                    <button type="button" onclick="alert('Silakan tekan tombol \'Save Draft\' terlebih dahulu agar sistem dapat membuatkan pratinjau untuk artikel baru ini.')" class="border border-[#dcdcde] bg-[#f6f7f7] text-[#2271b1] px-3 py-1.5 rounded text-xs font-semibold hover:bg-[#f0f0f1]">
                                        Preview
                                    </button>
                                @endif
                            </div>

                            <div class="py-3 border-y border-slate-100 space-y-3 text-slate-600">
                                <div class="flex items-center gap-2">
                                    <i data-lucide="lock" class="w-4 h-4"></i>
                                    Status: <span class="font-bold" x-text="publishStatus"></span>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <i data-lucide="users" class="w-4 h-4"></i>
                                        <span>Member Only</span>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="is_member_only" value="1" class="sr-only peer" {{ old('is_member_only', $article?->is_member_only) ? 'checked' : '' }}>
                                        <div class="w-9 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#da291c]"></div>
                                    </label>
                                </div>

                                <div class="flex items-center gap-2">
                                    <i data-lucide="calendar" class="w-4 h-4"></i>
                                    Publish: <span class="font-bold">Immediately</span>
                                </div>
                            </div>

                            <div class="flex justify-between items-center">
                                @if($article)
                                <button type="button" onclick="document.getElementById('delete-form').submit();" class="text-xs text-[#b32d2e] underline bg-transparent border-none p-0 cursor-pointer">
                                    Move to Trash
                                </button>
                                @endif
                                <button type="submit" name="status" value="published" @click="publishStatus = 'published'" class="border border-[#2271b1] bg-[#2271b1] text-white px-4 py-1.5 rounded text-xs font-semibold hover:bg-[#135e96]">
                                    {{ $article ? 'Update' : 'Publish' }}
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white border border-[#dcdcde] shadow-sm">
                        <div class="px-4 py-2 border-b border-[#dcdcde] text-sm font-semibold text-slate-700">Categories</div>
                        <div class="p-4">
                            <div class="max-h-60 overflow-y-auto border border-slate-200 bg-slate-50 rounded p-3 space-y-2">
                                @forelse($categories as $cat)
                                    <label class="flex items-center gap-3 text-sm font-semibold text-slate-600 hover:text-red-600 cursor-pointer">
                                        <input
                                            type="radio"
                                            name="category_id"
                                            value="{{ $cat->id }}"
                                            class="accent-red-600 w-4 h-4"
                                            {{ (string)old('category_id', $article?->category_id) === (string)$cat->id ? 'checked' : '' }}
                                        >
                                        {{ $cat->name }}
                                    </label>
                                @empty
                                    <p class="text-xs text-slate-500">Belum ada kategori. Tambahkan kategori baru di bawah ini.</p>
                                @endforelse
                            </div>
                            <div class="mt-3">
                                <label class="block text-[11px] font-semibold text-slate-500 mb-1">Add New Category</label>
                                <input
                                    type="text"
                                    name="new_category"
                                    value="{{ old('new_category') }}"
                                    placeholder="Contoh: Jurnal Internal"
                                    class="w-full border border-slate-300 text-xs px-2 py-1.5 focus:outline-none focus:border-[#8c8f94]"
                                >
                                <p class="text-[11px] text-slate-500 mt-1">Isi ini jika kategori belum tersedia.</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white border border-[#dcdcde] shadow-sm">
                        <div class="px-4 py-2 border-b border-[#dcdcde] text-sm font-semibold text-slate-700">Featured Image</div>
                        <div class="p-4">
                            <div class="bg-slate-100 h-32 border border-dashed border-slate-300 flex items-center justify-center text-xs text-slate-400 mb-3 overflow-hidden">
                                @if($article?->featured_image)
                                    @if(str_starts_with($article->featured_image, 'http'))
                                        <img src="{{ $article->featured_image }}" class="w-full h-full object-cover" alt="Featured">
                                    @else
                                        <img src="{{ asset($article->featured_image) }}" class="w-full h-full object-cover" alt="Featured">
                                    @endif
                                @else
                                    No image selected
                                @endif
                            </div>
                            <label class="block text-[11px] font-semibold text-slate-500 mb-1">Paste Image URL</label>
                            <input
                                type="url"
                                name="featured_image_url"
                                placeholder="https://example.com/your-image.jpg"
                                value="{{ old('featured_image_url', $article && str_starts_with($article->featured_image ?? '', 'http') ? $article->featured_image : '') }}"
                                class="w-full border border-slate-300 text-xs px-2 py-1.5 mb-3 focus:outline-none focus:border-[#8c8f94]"
                            >
                            <p class="text-[11px] text-slate-500 mb-3">Gunakan URL gambar jika ingin tanpa upload file.</p>
                            <input type="file" name="featured_image" accept="image/*" class="w-full border border-slate-300 text-xs px-2 py-1.5 mb-2">
                            <p class="text-xs text-[#2271b1] underline font-semibold">Set featured image (upload)</p>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        @if($article)
        <form id="delete-form" action="{{ route('admin.artikel.destroy', $article->id) }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
        @endif
    </div>
</div>
@endsection
