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
        $path = 'uploads/media/' . $filename;

        $mimeType = $uploadedFile->getMimeType();
        $fileSize = $uploadedFile->getSize();
        $originalName = $uploadedFile->getClientOriginalName();
        $filenameOnly = pathinfo($originalName, PATHINFO_FILENAME);

        $uploadedFile->move(public_path('uploads/media'), $filename);

        Media::create([
            'filename' => $filenameOnly,
            'original_name' => $originalName,
            'file_path' => $path,
            'mime_type' => $mimeType,
            'file_size' => $fileSize,
            'title' => $request->title ?? $originalName,
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
            'file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $updateData = [
            'title' => $request->title ?? $media->original_name,
            'type' => $request->type,
        ];

        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($media->file_path && !str_starts_with($media->file_path, 'http') && file_exists(public_path($media->file_path))) {
                unlink(public_path($media->file_path));
            }

            $uploadedFile = $request->file('file');
            $filename = time() . '_' . \Illuminate\Support\Str::slug(pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $uploadedFile->getClientOriginalExtension();
            $path = 'uploads/media/' . $filename;

            $updateData['mime_type'] = $uploadedFile->getMimeType();
            $updateData['file_size'] = $uploadedFile->getSize();
            $updateData['original_name'] = $uploadedFile->getClientOriginalName();
            $updateData['filename'] = pathinfo($updateData['original_name'], PATHINFO_FILENAME);
            $updateData['file_path'] = $path;

            $uploadedFile->move(public_path('uploads/media'), $filename);
        }

        $media->update($updateData);

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
