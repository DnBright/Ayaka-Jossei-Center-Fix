<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('admin.pengaturan', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->only([
            'site_name', 'site_tagline', 'site_description',
            'instagram_url', 'facebook_url',
        ]);

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return back()->with('success', 'Pengaturan website berhasil disimpan.');
    }
}
