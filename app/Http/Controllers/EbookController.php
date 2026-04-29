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
            'file' => 'required|mimes:pdf,epub|max:51200',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $file = $request->file('file');
        $fileFilename = time() . '_' . \Illuminate\Support\Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/ebooks/files'), $fileFilename);
        $filePath = 'uploads/ebooks/files/' . $fileFilename;

        $coverPath = null;
        if ($request->hasFile('cover_image')) {
            $coverFile = $request->file('cover_image');
            $coverFilename = time() . '_' . \Illuminate\Support\Str::slug(pathinfo($coverFile->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $coverFile->getClientOriginalExtension();
            $coverFile->move(public_path('uploads/ebooks/covers'), $coverFilename);
            $coverPath = 'uploads/ebooks/covers/' . $coverFilename;
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
            'file' => 'nullable|mimes:pdf,epub|max:51200',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
        ];

        if ($request->hasFile('file')) {
            if ($ebook->file_path && file_exists(public_path($ebook->file_path))) {
                unlink(public_path($ebook->file_path));
            }
            $file = $request->file('file');
            $fileFilename = time() . '_' . \Illuminate\Support\Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/ebooks/files'), $fileFilename);
            $data['file_path'] = 'uploads/ebooks/files/' . $fileFilename;
        }

        if ($request->hasFile('cover_image')) {
            if ($ebook->cover_image && !str_starts_with($ebook->cover_image, 'http') && file_exists(public_path($ebook->cover_image))) {
                unlink(public_path($ebook->cover_image));
            }
            $coverFile = $request->file('cover_image');
            $coverFilename = time() . '_' . \Illuminate\Support\Str::slug(pathinfo($coverFile->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $coverFile->getClientOriginalExtension();
            $coverFile->move(public_path('uploads/ebooks/covers'), $coverFilename);
            $data['cover_image'] = 'uploads/ebooks/covers/' . $coverFilename;
        }

        $ebook->update($data);

        return back()->with('success', 'E-Book berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $ebook = Ebook::findOrFail($id);
        if ($ebook->file_path && file_exists(public_path($ebook->file_path))) {
            unlink(public_path($ebook->file_path));
        }
        if ($ebook->cover_image && !str_starts_with($ebook->cover_image, 'http') && file_exists(public_path($ebook->cover_image))) {
            unlink(public_path($ebook->cover_image));
        }
        $ebook->delete();

        return back()->with('success', 'E-Book berhasil dihapus.');
    }
}
