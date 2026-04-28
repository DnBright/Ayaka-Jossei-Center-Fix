<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Page;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::all();
        return view('admin.halaman', compact('pages'));
    }

    public function edit($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        return view('admin.halaman_edit', compact('page'));
    }

    public function update(Request $request, $slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        
        $request->validate([
            'content' => 'required|array',
        ]);

        $page->update([
            'content' => $request->content
        ]);

        return back()->with('success', 'Konten halaman berhasil diperbarui.');
    }
}
