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
        $user = Auth::user();
        
        // Ambil statistik asli milik penulis
        $stats = [
            'total_artikel' => Article::where('author_id', $user->id)->count(),
            'total_views' => Article::where('author_id', $user->id)->sum('views_count'),
            'total_ebook' => Ebook::count(), // E-book saat ini masih global
        ];

        // Ambil 5 artikel terakhir milik penulis
        $recent_articles = Article::where('author_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        return view('penulis.dashboard', compact('stats', 'recent_articles'));
    }

    public function artikel()
    {
        $articles = Article::where('author_id', Auth::id())->latest()->paginate(10);
        return view('penulis.artikel', compact('articles'));
    }

    public function ebook()
    {
        $ebooks = Ebook::latest()->paginate(10);
        return view('penulis.ebook', compact('ebooks'));
    }

    public function media()
    {
        $media = Media::latest()->paginate(12);
        return view('penulis.media', compact('media'));
    }

    public function profile()
    {
        return view('penulis.profile', ['user' => Auth::user()]);
    }
}
