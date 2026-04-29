<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class MediaController extends Controller
{
    public function index(Request $request)
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

        return view('admin.media', compact('media'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
            'title' => 'nullable|string|max:255',
            'type' => 'required|in:gallery,banner,content',
        ]);

        $uploadedFile = $request->file('file');
        $filename = time() . '_' . \Illuminate\Support\Str::slug(pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $uploadedFile->getClientOriginalExtension();
        $uploadedFile->move(public_path('uploads/media'), $filename);
        $path = 'uploads/media/' . $filename;

        Media::create([
            'filename' => pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME),
            'original_name' => $uploadedFile->getClientOriginalName(),
            'file_path' => $path,
            'mime_type' => $uploadedFile->getMimeType(),
            'file_size' => $uploadedFile->getSize(),
            'title' => $request->title ?? $uploadedFile->getClientOriginalName(),
            'type' => $request->type,
            'uploaded_by' => Auth::id(),
        ]);

        return back()->with('success', 'Media berhasil diunggah.');
    }

    public function update(Request $request, $id)
    {
        $media = Media::findOrFail($id);

        $request->validate([
            'title' => 'nullable|string|max:255',
            'type' => 'required|in:gallery,banner,content',
        ]);

        $media->update([
            'title' => $request->title ?? $media->original_name,
            'type' => $request->type,
        ]);

        return back()->with('success', 'Informasi media berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $media = Media::findOrFail($id);
        if ($media->file_path && !str_starts_with($media->file_path, 'http') && file_exists(public_path($media->file_path))) {
            unlink(public_path($media->file_path));
        }
        $media->delete();

        return back()->with('success', 'Media berhasil dihapus.');
    }
}
