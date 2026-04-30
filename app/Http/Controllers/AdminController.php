<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\UserContentController;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        app(UserContentController::class)->syncSharedContent();

        $dateFilter = $request->input('date_filter');

        $stats = [
            'total_messages' => \App\Models\Message::when($dateFilter, fn($q) => $q->whereDate('created_at', $dateFilter))->count(),
            'total_articles' => \App\Models\Article::when($dateFilter, fn($q) => $q->whereDate('created_at', $dateFilter))->count(),
            'total_ebooks' => \App\Models\Ebook::when($dateFilter, fn($q) => $q->whereDate('created_at', $dateFilter))->count(),
            'total_users' => \App\Models\User::when($dateFilter, fn($q) => $q->whereDate('created_at', $dateFilter))->count(),
            'article_views' => \App\Models\Article::when($dateFilter, fn($q) => $q->whereDate('created_at', $dateFilter))->sum('views_count'),
            'ebook_downloads' => \App\Models\Ebook::when($dateFilter, fn($q) => $q->whereDate('created_at', $dateFilter))->sum('download_count'),
        ];

        $totalStats = [
            'total_messages' => \App\Models\Message::count(),
            'total_articles' => \App\Models\Article::count(),
            'total_ebooks' => \App\Models\Ebook::count(),
            'total_users' => \App\Models\User::count(),
            'article_views' => \App\Models\Article::sum('views_count'),
            'ebook_downloads' => \App\Models\Ebook::sum('download_count'),
        ];

        $topArticles = \App\Models\Article::with('category')->when($dateFilter, fn($q) => $q->whereDate('created_at', $dateFilter))->orderBy('views_count', 'desc')->take(5)->get();
        $topEbooks = \App\Models\Ebook::when($dateFilter, fn($q) => $q->whereDate('created_at', $dateFilter))->orderBy('download_count', 'desc')->take(5)->get();

        // === Chart Data ===

        // 1. Line Chart: Article views per article (top 10 by views, as a trend proxy)
        $lineArticles = \App\Models\Article::orderBy('views_count', 'desc')->take(10)->get();
        $chartData = [
            'labels'   => $lineArticles->pluck('title')->map(fn($t) => \Illuminate\Support\Str::limit($t, 15))->values()->toArray(),
            'views'    => $lineArticles->pluck('views_count')->map(fn($v) => (int)$v)->values()->toArray(),
            'downloads'=> \App\Models\Ebook::orderBy('download_count', 'desc')->take(10)->pluck('download_count')->map(fn($v) => (int)$v)->values()->toArray(),
            'ebookLabels' => \App\Models\Ebook::orderBy('download_count', 'desc')->take(10)->pluck('title')->map(fn($t) => \Illuminate\Support\Str::limit($t, 15))->values()->toArray(),
        ];

        // 2. Category Distribution for Doughnut
        $categoryDistribution = \App\Models\Article::selectRaw('category_id, count(*) as total')
            ->groupBy('category_id')
            ->with('category')
            ->get()
            ->map(fn($item) => [
                'name'  => $item->category->name ?? 'Tanpa Kategori',
                'total' => (int)$item->total,
            ])->values()->toArray();

        // 3. Latest Activity
        $latestMessages = \App\Models\Message::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'totalStats', 'topArticles', 'topEbooks', 'dateFilter', 'chartData', 'categoryDistribution', 'latestMessages'));
    }

    public function users()
    {
        $internalTeam = User::whereIn('role', ['admin', 'penulis'])->get();
        $pendingUsers = User::where('role', 'user')->where('is_approved', false)->get();
        $activeMembers = User::where('role', 'user')->where('is_approved', true)->get();

        return view('admin.users', compact('internalTeam', 'pendingUsers', 'activeMembers'));
    }

    public function createUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,penulis',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Hash::make($request->password),
            'role' => $request->role,
            'is_approved' => true,
        ]);

        return back()->with('success', 'Anggota tim baru berhasil ditambahkan.');
    }

    public function approveUser($id)
    {
        $user = User::findOrFail($id);
        $user->is_approved = true;
        $user->save();

        return back()->with('success', 'User ' . $user->name . ' telah berhasil disetujui.');
    }

    public function rejectUser($id)
    {
        $user = User::findOrFail($id);
        // We could just delete them or keep them as disapproved
        // The user says "jika admin tidak meng acc akun maka user tidak bisa login"
        // Deleting might be cleaner if they are rejected.
        $user->delete();

        return back()->with('success', 'Pendaftaran user telah ditolak.');
    }
}
