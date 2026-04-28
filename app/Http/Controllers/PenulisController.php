<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Ebook;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenulisController extends Controller
{
    public function dashboard()
    {
        // Ambil statistik GLOBAL (sama dengan Admin)
        $stats = [
            'total_messages' => \App\Models\Message::count(),
            'total_articles' => \App\Models\Article::count(),
            'total_ebooks' => \App\Models\Ebook::count(),
            'total_users' => \App\Models\User::count(),
            'article_views' => \App\Models\Article::sum('views_count'),
            'ebook_downloads' => \App\Models\Ebook::sum('download_count'),
        ];

        // Ambil 5 artikel terpopuler secara global
        $topArticles = Article::with(['category', 'author'])
            ->orderBy('views_count', 'desc')
            ->take(5)
            ->get();

        return view('penulis.dashboard', compact('stats', 'topArticles'));
    }

    public function artikel()
    {
        // Tampilkan SEMUA artikel (sama seperti Admin)
        $articles = Article::with(['category', 'author'])->latest()->paginate(10);
        return view('penulis.artikel', compact('articles'));
    }

    public function ebook()
    {
        $ebooks = Ebook::latest()->paginate(10);
        return view('penulis.ebook', compact('ebooks'));
    }

    public function media(Request $request)
    {
        $search = $request->input('search');
        $type = $request->input('type');

        $media = Media::latest()
            ->when($search, function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('original_name', 'like', "%{$search}%");
            })
            ->when($type && $type !== 'all', function ($q) use ($type) {
                $q->where('type', $type);
            })
            ->paginate(18)
            ->withQueryString();

        return view('penulis.media', compact('media'));
    }

    public function profile()
    {
        return view('penulis.profile', ['user' => Auth::user()]);
    }
}
