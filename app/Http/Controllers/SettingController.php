<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function edit()
    {
        $setting = Setting::firstOrCreate(['id' => 1]);
        return view('settings.edit', compact('setting'));
    }

    public function update(SettingRequest $request)
    {
        $setting = Setting::firstOrCreate(['id' => 1]);
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            if ($setting->logo) {
                Storage::disk('public')->delete($setting->logo);
            }
            $data['logo'] = $request->file('logo')->store('settings', 'public');
        }

        $setting->update($data);

        return back()->with('success', 'Pengaturan toko berhasil disimpan.');
    }
}