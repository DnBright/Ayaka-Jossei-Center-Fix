<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        $settings = $setting ? $setting->toArray() : [];
        return view('admin.pengaturan', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->only([
            'site_name', 'site_tagline', 'site_description',
            'instagram_url', 'facebook_url',
        ]);

        Setting::updateOrCreate(['id' => 1], $data);

        return back()->with('success', 'Pengaturan website berhasil disimpan.');
    }
}
