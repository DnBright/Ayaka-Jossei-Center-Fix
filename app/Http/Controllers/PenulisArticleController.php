<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PenulisArticleController extends Controller
{
    /**
     * Ambil user penulis yang sedang login.
     */
    private function getPenulis()
    {
        return Auth::guard('penulis')->user();
    }

    /**
     * Resolve category ID dari input request.
     */
    private function resolveCategoryId(Request $request): ?int
    {
        if ($request->filled('new_category')) {
            $name = trim($request->new_category);
            $category = Category::firstOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name]
            );
            return (int) $category->id;
        }

        if ($request->filled('category_id')) {
            return (int) $request->category_id;
        }

        return null;
    }

    /**
     * Tampilkan daftar artikel penulis.
     */
    public function index()
    {
        $user = $this->getPenulis();
        // Penulis hanya melihat artikelnya sendiri
        $articles = Article::with(['category', 'author'])
            ->where('author_id', $user->id)
            ->latest()
            ->paginate(10);

        return view('penulis.artikel', compact('articles'));
    }

    /**
     * Tampilkan form tambah artikel baru.
     */
    public function create()
    {
        $user = $this->getPenulis();
        $categories = Category::orderBy('name')->get();

        return view('penulis.artikel_editor', [
            'article'     => null,
            'categories'  => $categories,
            'formAction'  => route('penulis.artikel.store'),
            'formMethod'  => 'POST',
            'initialStatus' => 'draft',
            'currentUser' => $user,
        ]);
    }

    /**
     * Simpan artikel baru oleh penulis.
     */
    public function store(Request $request)
    {
        $user = $this->getPenulis();

        $request->validate([
            'title'              => 'required|string|max:255',
            'content'            => 'nullable',
            'category_id'        => 'nullable|exists:categories,id',
            'new_category'       => 'nullable|string|max:255',
            'featured_image'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'featured_image_url' => 'nullable|url|max:2048',
            'status'             => 'required|in:draft,published',
        ]);

        $categoryId = $this->resolveCategoryId($request);

        $imagePath = $request->filled('featured_image_url') ? $request->featured_image_url : null;
        if ($request->hasFile('featured_image')) {
            $file     = $request->file('featured_image');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            if (!file_exists(public_path('uploads/articles'))) {
                mkdir(public_path('uploads/articles'), 0755, true);
            }
            $file->move(public_path('uploads/articles'), $filename);
            $imagePath = 'uploads/articles/' . $filename;
        }

        Article::create([
            'title'         => $request->title,
            'slug'          => Str::slug($request->title) . '-' . uniqid(),
            'content'       => $request->content,
            'featured_image' => $imagePath,
            'author_id'     => $user->id,
            'category_id'   => $categoryId,
            'status'        => $request->status,
            'is_member_only' => $request->boolean('is_member_only'),
        ]);

        return redirect()->route('penulis.artikel.index')->with('success', 'Artikel berhasil ditambahkan!');
    }

    /**
     * Tampilkan form edit artikel.
     */
    public function edit($id)
    {
        $user    = $this->getPenulis();
        $article = Article::findOrFail($id);

        if ($article->author_id !== $user->id) {
            abort(403, 'Anda tidak memiliki izin untuk mengedit artikel ini.');
        }

        $categories = Category::orderBy('name')->get();

        return view('penulis.artikel_editor', [
            'article'       => $article,
            'categories'    => $categories,
            'formAction'    => route('penulis.artikel.update', $article->id),
            'formMethod'    => 'PUT',
            'initialStatus' => $article->status,
            'currentUser'   => $user,
        ]);
    }

    /**
     * Update artikel oleh penulis.
     */
    public function update(Request $request, $id)
    {
        $user    = $this->getPenulis();
        $article = Article::findOrFail($id);

        if ($article->author_id !== $user->id) {
            abort(403, 'Anda tidak memiliki izin untuk mengubah artikel ini.');
        }

        $request->validate([
            'title'              => 'required|string|max:255',
            'content'            => 'nullable',
            'category_id'        => 'nullable|exists:categories,id',
            'new_category'       => 'nullable|string|max:255',
            'featured_image'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'featured_image_url' => 'nullable|url|max:2048',
            'status'             => 'required|in:draft,published',
        ]);

        $categoryId = $this->resolveCategoryId($request);

        // Update gambar jika ada
        if ($request->filled('featured_image_url')) {
            if ($article->featured_image && !str_starts_with($article->featured_image, 'http') && file_exists(public_path($article->featured_image))) {
                unlink(public_path($article->featured_image));
            }
            $article->featured_image = $request->featured_image_url;
        }

        if ($request->hasFile('featured_image')) {
            if ($article->featured_image && !str_starts_with($article->featured_image, 'http') && file_exists(public_path($article->featured_image))) {
                unlink(public_path($article->featured_image));
            }
            $file     = $request->file('featured_image');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/articles'), $filename);
            $article->featured_image = 'uploads/articles/' . $filename;
        }

        $article->update([
            'title'         => $request->title,
            'slug'          => ($request->title !== $article->title) ? Str::slug($request->title) . '-' . uniqid() : $article->slug,
            'content'       => $request->content,
            'featured_image' => $article->featured_image,
            'category_id'   => $categoryId,
            'status'        => $request->status,
            'is_member_only' => $request->boolean('is_member_only'),
        ]);

        return redirect()->route('penulis.artikel.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    /**
     * Hapus artikel oleh penulis.
     */
    public function destroy($id)
    {
        $user    = $this->getPenulis();
        $article = Article::findOrFail($id);

        if ($article->author_id !== $user->id) {
            abort(403, 'Anda tidak memiliki izin untuk menghapus artikel ini.');
        }

        if ($article->featured_image && !str_starts_with($article->featured_image, 'http') && file_exists(public_path($article->featured_image))) {
            unlink(public_path($article->featured_image));
        }

        $article->delete();

        return redirect()->route('penulis.artikel.index')->with('success', 'Artikel berhasil dihapus.');
    }
}
