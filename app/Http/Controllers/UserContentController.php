<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Ebook;
use App\Models\Media;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

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
        $this->ensureAlumni();
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

        $authorId = User::query()->where('role', 'admin')->value('id') ?? User::query()->value('id');
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
                'uploaded_by' => User::query()->where('role', 'admin')->value('id') ?? User::query()->value('id'),
            ]);
        }
    }

    private function ensureAlumni(): void
    {
        if (\App\Models\Alumni::count() > 0) {
            return;
        }

        $samples = [
            [
                'Aisyah Rahmawati', 
                'Batch 15', 
                'Kyoto Medical Center', 
                'Pelatihan di Ayaka Josei Center sangat komprehensif. Selain bahasa Jepang (N3), kami diajarkan etos kerja (Kaizen) dan budaya disiplin Jepang yang sangat berguna saat bekerja di rumah sakit berstandar internasional.'
            ],
            [
                'Dewi Sartika', 
                'Batch 12', 
                'Osaka City Hospital', 
                'Awalnya saya ragu bisa berkarir di luar negeri. Namun berkat bimbingan intensif dari para sensei di AJC, saya tidak hanya lulus wawancara dengan user, tapi juga berhasil beradaptasi dengan cepat di lingkungan kerja medis Osaka.'
            ],
            [
                'Kenjiro Tanaka', 
                'Batch 14', 
                'Tokyo Elderly Care', 
                'Program spesifik Kaigo (perawat lansia) di Ayaka sangat praktikal. Kosakata medis dan simulasi praktik langsung membuat saya sangat siap secara mental dan teknis ketika pertama kali terjun ke lapangan.'
            ],
            [
                'Rina Oktaviani', 
                'Batch 11', 
                'Fukuoka General Clinic', 
                'Fasilitas, kurikulum yang terstruktur, serta pendampingan penuh hingga keberangkatan adalah bukti profesionalitas AJC. Terima kasih telah mewujudkan mimpi saya menjadi tenaga kesehatan di Jepang.'
            ],
            [
                'Budi Santoso', 
                'Batch 16', 
                'Nagoya Rehabilitation Center', 
                'Sistem belajar yang disiplin layaknya di Jepang langsung diterapkan sejak hari pertama kelas. Hal ini sangat membentuk mental profesional saya. AJC adalah gerbang terbaik menuju karir global.'
            ],
            [
                'Meilisa Dwi', 
                'Batch 13', 
                'Sapporo Central Hospital', 
                'Dari mulai pengurusan dokumen COE (Certificate of Eligibility) hingga persiapan teknis keperawatan, semuanya didampingi dengan sangat transparan dan sangat membantu. Sangat direkomendasikan!'
            ],
            [
                'Sarah Kusuma', 
                'Batch 10', 
                'Yokohama Elderly Care', 
                'Bekerja sebagai caregiver di Jepang membutuhkan dedikasi tinggi. Untungnya, bekal dari AJC sangat membantu, mulai dari bahasa Jepang medis hingga pemahaman mendalam tentang standar pelayanan panti jompo (Kaigo) di Jepang.'
            ],
            [
                'Hendra Wijaya', 
                'Batch 15', 
                'Saitama General Clinic', 
                'Disiplin dan pantang menyerah adalah kunci sukses yang selalu ditekankan oleh instruktur AJC. Berkat itu, saya kini dipercaya memegang tanggung jawab besar di klinik perawatan Saitama. Terima kasih atas dukungannya!'
            ],
            [
                'Putri Lestari', 
                'Batch 14', 
                'Kobe Medical Center', 
                'Saya sangat bersyukur memilih AJC. Simulasi kerja nyata yang diberikan saat pelatihan membuat saya tidak kaget dengan budaya kerja cepat dan detail khas tenaga medis Jepang saat pertama kali tiba di Kobe.'
            ],
            [
                'Aditya Pratama', 
                'Batch 12', 
                'Fukuoka Nursing Home', 
                'Dari nol hingga bisa mengantongi sertifikat N3 dan persiapan N2, AJC memfasilitasi semuanya. Tidak hanya itu, pendampingan khusus saat interview dengan user Jepang benar-benar meningkatkan kepercayaan diri saya.'
            ],
        ];

        foreach ($samples as $index => [$name, $batch, $work, $testi]) {
            \App\Models\Alumni::create([
                'name' => $name,
                'batch' => $batch,
                'working_at' => $work,
                'testimonial' => $testi,
                'image_url' => null,
                'is_featured' => true,
            ]);
        }
    }

    public function blog(Request $request)
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
            ->firstOrFail();

        // Pengecekan Akses Preview Draft
        if ($article->status !== 'published') {
            if (!auth()->check() || (auth()->user()->role !== 'admin' && (auth()->user()->role !== 'penulis' || auth()->id() !== $article->author_id))) {
                abort(404);
            }
        }

        // Proteksi Konten: Wajib Login jika is_member_only = true
        if ($article->is_member_only && !auth()->check()) {
            return redirect()->route('login')->with('info', 'Jurnal ini bersifat eksklusif. Silakan login atau daftarkan akun Anda untuk membaca konten lengkapnya.');
        }

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

    public function ebook(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('info', 'Silakan mendaftar atau login terlebih dahulu untuk mengakses koleksi E-Book materi eksklusif Ayaka Josei Center.');
        }

        $this->syncSharedContent();

        $search = $request->input('search');

        $ebooks = Ebook::where('is_active', true)
            ->when($search, function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('user.ebook', compact('ebooks'));
    }

    public function downloadEbook($id)
    {
        $ebook = Ebook::where('is_active', true)->findOrFail($id);

        $filePath = public_path($ebook->file_path);
        
        // Cek fallback ke storage lama jika file adalah file legacy
        if (!file_exists($filePath)) {
            $filePath = storage_path('app/public/' . $ebook->file_path);
        }

        if (file_exists($filePath)) {
            $ebook->increment('download_count');
            return response()->download($filePath, $ebook->title . '.pdf');
        }

        return back()->with('info', 'File e-book sedang dipersiapkan.');
    }

    public function galeri(Request $request)
    {
        $this->syncSharedContent();

        $type = $request->input('type');

        $galleryItems = Media::where('type', 'gallery')
            ->when($type && $type !== 'all', function ($q) use ($type) {
                // Filter logic can be added here
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
