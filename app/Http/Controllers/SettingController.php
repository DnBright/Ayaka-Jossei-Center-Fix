<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::firstOrCreate([], [
            'site_name' => 'Ayaka Josei Center',
            'site_tagline' => '',
            'site_description' => '',
            'instagram_url' => '',
            'facebook_url' => '',
        ]);

        $settings = $setting->toArray();

        return view('admin.pengaturan', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_tagline' => 'nullable|string|max:255',
            'site_description' => 'nullable|string|max:1000',
            'instagram_url' => 'nullable|string|max:255',
            'facebook_url' => 'nullable|string|max:255',
        ]);

        $setting = Setting::firstOrCreate([]);
        $setting->update($validated);

        return back()->with('success', 'Pengaturan website berhasil diperbarui.');
    }
}
