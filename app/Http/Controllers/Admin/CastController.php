<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CastController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $casts = Cast::all();
        return view('Admin.casts.index', compact('casts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name'   => ['required', 'string', 'min:2', 'max:255'],
            'description' => ['required', 'string'],
            'role'        => ['required', 'in:actor,director'],
            'image'       => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048'],
        ]);
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('cast', 'public');
        }
        Cast::create($validated);
        return redirect()->route('casts.index')->with('status', 'با موفقیت ایجاد شد.');
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
        $cast = Cast::findOrFail($id);
        $validated = $request->validate([
            'full_name'   => ['required', 'string', 'min:2', 'max:255'],
            'description' => ['required', 'string'],
            'role'        => ['required', 'in:actor,director'],
            'image'       => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048'],
        ]);
        if ($request->hasFile('image')) {
            if ($cast->image && Storage::disk('public')->exists($cast->image)) {
                Storage::disk('public')->delete($cast->image);
            }
            $validated['image'] = $request->file('image')->store('cast', 'public');
        }
        $cast->update($validated);
        return redirect()->route('casts.index')->with('status', 'با موفقیت به‌روزرسانی شد.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cast = Cast::findOrFail($id);
        if ($cast->image && Storage::disk('public')->exists($cast->image)) {
            Storage::disk('public')->delete($cast->image);
        }
        $cast->delete();
        return redirect()->route('casts.index')->with('status', 'با موفقیت حذف شد.');
    }
}
