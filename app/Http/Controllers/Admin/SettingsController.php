<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = Settings::all();
        return view('Admin.settings.index', compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.settings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Settings::exists()) {
            return redirect()->route('settings.index')
                ->with('status', 'تنظیمات از قبل وجود دارد.');
        }
        $validated = $request->validate([
            'title' => ['required', 'string', 'min:3', 'max:100'],
            'description' => ['required', 'string', 'min:3'],
            'logo'        => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'phone'       => ['nullable', 'regex:/^[0-9]+$/', 'max:15'],
            'instagram' => ['nullable', 'string', 'max:100'],
        ]);
        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('setting/logo', 'public');
        }
        Settings::create($validated);
        return redirect()->route('settings.index')->with('status', 'تنظیمات با موفقیت ایجاد شد.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id)
    {
        $setting = Settings::findOrFail($id);
        $validated = $request->validate([
            'title' => ['required', 'string', 'min:3', 'max:100'],
            'description' => ['required', 'string', 'min:3'],
            'logo'        => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'phone'       => ['nullable', 'regex:/^[0-9]+$/', 'max:15'],
            'instagram' => ['nullable', 'string', 'max:100'],
        ]);
        if ($request->hasFile('logo')) {
            if ($setting->logo && Storage::disk('public')->exists($setting->logo)) {
                Storage::disk('public')->delete($setting->logo);
            }
            $validated['logo'] = $request->file('logo')->store('setting/logo', 'public');
        }
        $setting->update($validated);
        return redirect()->route('settings.index')->with('status', 'تنظیمات با موفقیت به‌روزرسانی شد.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $setting = Settings::findOrFail($id);
        if ($setting->logo && Storage::disk('public')->exists($setting->logo)) {
            Storage::disk('public')->delete($setting->logo);
        }
        $setting->delete();
        return redirect()->route('settings.index')->with('status', 'با موفقیت حذف شد.');
    }
}
