<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    private function resolveCategoryId(Request $request): ?int
    {
        if ($request->filled('category_id')) {
            return (int) $request->category_id;
        }

        if ($request->filled('new_category')) {
            $name = trim($request->new_category);
            $category = Category::firstOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name]
            );

            return (int) $category->id;
        }

        return null;
    }

    public function index()
    {
        $articles = Article::with(['category', 'author'])->latest()->paginate(10);
        return view('admin.artikel', compact('articles'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.artikel_editor', [
            'article' => null,
            'categories' => $categories,
            'formAction' => route('admin.artikel.store'),
            'formMethod' => 'POST',
            'initialStatus' => 'draft',
        ]);
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $categories = Category::orderBy('name')->get();

        return view('admin.artikel_editor', [
            'article' => $article,
            'categories' => $categories,
            'formAction' => route('admin.artikel.update', $article->id),
            'formMethod' => 'PUT',
            'initialStatus' => $article->status,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'new_category' => 'nullable|string|max:255',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'featured_image_url' => 'nullable|url|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        $categoryId = $this->resolveCategoryId($request);
        if (!$categoryId) {
            return back()->withInput()->withErrors([
                'category_id' => 'Pilih kategori atau buat kategori baru terlebih dahulu.',
            ]);
        }

        $imagePath = $request->filled('featured_image_url') ? $request->featured_image_url : null;
        if ($request->hasFile('featured_image')) {
            $imagePath = $request->file('featured_image')->store('articles', 'public');
        }

        Article::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . time(),
            'content' => $request->content,
            'featured_image' => $imagePath,
            'author_id' => Auth::id(),
            'category_id' => $categoryId,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'new_category' => 'nullable|string|max:255',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'featured_image_url' => 'nullable|url|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        $categoryId = $this->resolveCategoryId($request);
        if (!$categoryId) {
            return back()->withInput()->withErrors([
                'category_id' => 'Pilih kategori atau buat kategori baru terlebih dahulu.',
            ]);
        }

        if ($request->filled('featured_image_url')) {
            if ($article->featured_image && !str_starts_with($article->featured_image, 'http')) {
                Storage::disk('public')->delete($article->featured_image);
            }
            $article->featured_image = $request->featured_image_url;
        }

        if ($request->hasFile('featured_image')) {
            if ($article->featured_image && !str_starts_with($article->featured_image, 'http')) {
                Storage::disk('public')->delete($article->featured_image);
            }
            $article->featured_image = $request->file('featured_image')->store('articles', 'public');
        }

        $article->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . time(),
            'content' => $request->content,
            'category_id' => $categoryId,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        if ($article->featured_image && !str_starts_with($article->featured_image, 'http')) {
            Storage::disk('public')->delete($article->featured_image);
        }
        $article->delete();

        return back()->with('success', 'Artikel berhasil dihapus.');
    }
}
