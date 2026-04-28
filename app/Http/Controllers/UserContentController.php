<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Ebook;
use App\Models\Media;
use App\Models\User;
use Illuminate\Support\Str;

class UserContentController extends Controller
{
    public function syncSharedContent(): void
    {
        $this->ensureSeededContent();
    }

    private function ensureSeededContent(): void
    {
        $this->ensureCategories();
        $this->ensureArticles();
        $this->ensureEbooks();
        $this->ensureGalleryMedia();
    }

    private function ensureCategories(): void
    {
        $defaults = ['Karir', 'Budaya', 'Pelatihan', 'Tips', 'Berita'];

        foreach ($defaults as $name) {
            Category::firstOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name, 'description' => 'Kategori konten ' . $name]
            );
        }
    }

    private function ensureArticles(): void
    {
        if (Article::count() > 0) {
            return;
        }

        $authorId = User::query()->value('id');
        if (!$authorId) {
            return;
        }

        $categoryIds = Category::pluck('id')->all();
        if (empty($categoryIds)) {
            return;
        }

        $samples = [
            'Strategi Lulus Interview User Jepang Untuk Pemula',
            'Memahami Budaya Kerja Kaizen di Industri Jepang',
            'Checklist Persiapan Keberangkatan ke Jepang',
            'Tips Adaptasi Lingkungan Kerja Baru di Jepang',
            'Peluang Karir Perempuan di Sektor Kaigo Jepang',
        ];

        foreach ($samples as $index => $title) {
            Article::create([
                'title' => $title,
                'slug' => Str::slug($title) . '-' . ($index + 1),
                'content' => 'Konten artikel contoh untuk sinkronisasi halaman user dan dashboard admin.',
                'featured_image' => 'images/hero-bg.png',
                'author_id' => $authorId,
                'category_id' => $categoryIds[$index % count($categoryIds)],
                'status' => 'published',
                'views_count' => 200 + ($index * 73),
            ]);
        }
    }

    private function ensureEbooks(): void
    {
        if (Ebook::count() > 0) {
            return;
        }

        $samples = [
            ['Panduan Dasar Bahasa Jepang', 'Bahasa'],
            ['Etika Kerja di Jepang', 'Budaya'],
            ['Persiapan Wawancara User', 'Karir'],
            ['Panduan Hidup di Jepang', 'Life'],
            ['Kamus Istilah Kaigo', 'Teknis'],
            ['Panduan Keberangkatan', 'Logistik'],
        ];

        foreach ($samples as $index => [$title, $category]) {
            Ebook::create([
                'title' => $title,
                'slug' => Str::slug($title) . '-' . ($index + 1),
                'description' => 'Materi ' . $category . ' untuk persiapan peserta Ayaka Josei Center.',
                'file_path' => 'ebooks/files/sample-' . ($index + 1) . '.pdf',
                'cover_image' => 'images/hero-bg.png',
                'download_count' => 120 + ($index * 45),
                'view_count' => 180 + ($index * 60),
                'is_active' => true,
            ]);
        }
    }

    private function ensureGalleryMedia(): void
    {
        if (Media::where('type', 'gallery')->count() > 0) {
            return;
        }

        for ($i = 1; $i <= 9; $i++) {
            Media::create([
                'filename' => 'gallery-batch-' . $i,
                'original_name' => 'gallery-batch-' . $i . '.png',
                'file_path' => 'images/hero-bg.png',
                'mime_type' => 'image/png',
                'file_size' => 160000,
                'title' => 'Momen Pelatihan Batch ' . $i,
                'type' => 'gallery',
                'uploaded_by' => User::query()->value('id'),
            ]);
        }
    }

    public function blog(\Illuminate\Http\Request $request)
    {
        $this->syncSharedContent();

        $search = $request->input('search');
        $categoryName = $request->input('category');

        $query = Article::with('category')
            ->where('status', 'published')
            ->when($search, function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            })
            ->when($categoryName && $categoryName !== 'Semua', function ($q) use ($categoryName) {
                $q->whereHas('category', function ($cq) use ($categoryName) {
                    $cq->where('name', $categoryName);
                });
            });

        // Get Featured Article (only on first page without filters)
        $featuredArticle = null;
        if (!$search && (!$categoryName || $categoryName === 'Semua') && $request->input('page', 1) == 1) {
            $featuredArticle = (clone $query)->latest()->first();
        }

        $regularArticles = $query->when($featuredArticle, fn ($q) => $q->where('id', '!=', $featuredArticle->id))
            ->latest()
            ->paginate(6)
            ->withQueryString();

        $categories = Category::orderBy('name')->pluck('name')->toArray();

        return view('user.blog', compact('featuredArticle', 'regularArticles', 'categories'));
    }

    public function showArticle($slug)
    {
        $article = Article::with('category', 'author')
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $article->increment('views_count');

        $relatedArticles = Article::with('category')
            ->where('status', 'published')
            ->where('id', '!=', $article->id)
            ->where('category_id', $article->category_id)
            ->latest()
            ->take(3)
            ->get();

        return view('user.artikel-detail', compact('article', 'relatedArticles'));
    }

    public function ebook(\Illuminate\Http\Request $request)
    {
        $this->syncSharedContent();

        $search = $request->input('search');

        $ebooks = Ebook::where('is_active', true)
            ->when($search, function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(6)
            ->withQueryString();

        return view('user.ebook', compact('ebooks'));
    }

    public function downloadEbook($id)
    {
        $ebook = Ebook::where('is_active', true)->findOrFail($id);

        $ebook->increment('download_count');

        // Serve file if it exists, otherwise redirect back with info
        $filePath = storage_path('app/public/' . $ebook->file_path);
        if (file_exists($filePath)) {
            return response()->download($filePath, $ebook->title . '.pdf');
        }

        return back()->with('info', 'File e-book sedang dipersiapkan.');
    }

    public function galeri(\Illuminate\Http\Request $request)
    {
        $this->syncSharedContent();

        $type = $request->input('type');

        $galleryItems = Media::where('type', 'gallery')
            ->when($type && $type !== 'all', function ($q) use ($type) {
                // Assuming we use titles or some other field for categories if needed, 
                // but let's just stick to the basic functional structure for now.
                // In a real scenario, we might have a 'category' column in media.
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('user.galeri', compact('galleryItems'));
    }

    public function alumni()
    {
        $this->syncSharedContent();
        
        $alumni = \App\Models\Alumni::where('is_featured', true)->latest()->get();
        
        return view('user.alumni', compact('alumni'));
    }
}
