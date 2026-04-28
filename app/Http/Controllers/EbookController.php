<?php

namespace App\Http\Controllers;

use App\Models\Ebook;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EbookController extends Controller
{
    public function index()
    {
        $ebooks = Ebook::latest()->paginate(10);
        return view('admin.ebook', compact('ebooks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'file' => 'required|mimes:pdf,epub|max:10240',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $filePath = $request->file('file')->store('ebooks/files', 'public');
        $coverPath = null;
        if ($request->hasFile('cover_image')) {
            $coverPath = $request->file('cover_image')->store('ebooks/covers', 'public');
        }

        Ebook::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'file_path' => $filePath,
            'cover_image' => $coverPath,
            'is_active' => true,
        ]);

        return back()->with('success', 'E-Book berhasil diunggah.');
    }

    public function update(Request $request, $id)
    {
        $ebook = Ebook::findOrFail($id);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'file' => 'nullable|mimes:pdf,epub|max:10240',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
        ];

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($ebook->file_path);
            $data['file_path'] = $request->file('file')->store('ebooks/files', 'public');
        }

        if ($request->hasFile('cover_image')) {
            if ($ebook->cover_image) {
                Storage::disk('public')->delete($ebook->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('ebooks/covers', 'public');
        }

        $ebook->update($data);

        return back()->with('success', 'E-Book berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $ebook = Ebook::findOrFail($id);
        if ($ebook->file_path) {
            Storage::disk('public')->delete($ebook->file_path);
        }
        if ($ebook->cover_image) {
            Storage::disk('public')->delete($ebook->cover_image);
        }
        $ebook->delete();

        return back()->with('success', 'E-Book berhasil dihapus.');
    }
}
