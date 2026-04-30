<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AlumniController extends Controller
{
    public function index()
    {
        app(\App\Http\Controllers\UserContentController::class)->syncSharedContent();
        $alumnis = Alumni::latest()->paginate(10);
        return view('admin.alumni', compact('alumnis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'batch' => 'required|string|max:255',
            'working_at' => 'required|string|max:255',
            'testimonial' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = 'images/hero-bg.png'; // fallback default
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/alumni'), $filename);
            $imagePath = 'uploads/alumni/' . $filename;
        }

        Alumni::create([
            'name' => $request->name,
            'batch' => $request->batch,
            'working_at' => $request->working_at,
            'testimonial' => $request->testimonial,
            'image_url' => $imagePath,
            'is_featured' => $request->has('is_featured'),
        ]);

        return back()->with('success', 'Data alumni berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $alumni = Alumni::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'batch' => 'required|string|max:255',
            'working_at' => 'required|string|max:255',
            'testimonial' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'batch' => $request->batch,
            'working_at' => $request->working_at,
            'testimonial' => $request->testimonial,
            'is_featured' => $request->has('is_featured'),
        ];

        if ($request->hasFile('image')) {
            if ($alumni->image_url && $alumni->image_url !== 'images/hero-bg.png' && !str_starts_with($alumni->image_url, 'http') && file_exists(public_path($alumni->image_url))) {
                unlink(public_path($alumni->image_url));
            }

            $file = $request->file('image');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/alumni'), $filename);
            $data['image_url'] = 'uploads/alumni/' . $filename;
        }

        $alumni->update($data);

        return back()->with('success', 'Data alumni berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $alumni = Alumni::findOrFail($id);

        if ($alumni->image_url && $alumni->image_url !== 'images/hero-bg.png' && !str_starts_with($alumni->image_url, 'http') && file_exists(public_path($alumni->image_url))) {
            unlink(public_path($alumni->image_url));
        }

        $alumni->delete();

        return back()->with('success', 'Data alumni berhasil dihapus.');
    }
}
