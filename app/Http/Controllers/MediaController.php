<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index()
    {
        $media = Media::latest()->paginate(20);
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
        $path = $uploadedFile->store('media', 'public');

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

    public function destroy($id)
    {
        $media = Media::findOrFail($id);
        Storage::disk('public')->delete($media->file_path);
        $media->delete();

        return back()->with('success', 'Media berhasil dihapus.');
    }
}
