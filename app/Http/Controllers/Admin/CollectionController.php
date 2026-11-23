<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;
use App\Models\Collection;
use Illuminate\Support\Facades\Storage;

class CollectionController extends Controller
{
    public function index()
    {
        $collections = Collection::with('movie')
            ->latest()
            ->paginate(15);

        return view('Admin.collection.index', compact('collections'));
    }

    public function create()
    {
        $movies = Movie::orderBy('title')->get();
        return view('Admin.collection.create', compact('movies'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'    => ['required', 'string', 'min:2', 'max:255'],
            'movie_id' => ['required', 'exists:movies,id'],
            'image'    => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:4096'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('collection/images', 'public');
        }

        Collection::create($validated);

        return redirect()
            ->route('collection.index')
            ->with('status', 'کالکشن با موفقیت ایجاد شد.');
    }

    public function edit(Collection $collection)
    {
        $movies = Movie::orderBy('title')->get();
        return view('Admin.collection.update', compact('collection', 'movies'));
    }

    public function update(Request $request, Collection $collection)
    {
        $validated = $request->validate([
            'title'    => ['required', 'string', 'min:2', 'max:255'],
            'movie_id' => ['required', 'exists:movies,id'],
            'image'    => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:4096'],
        ]);

        if ($request->hasFile('image')) {
            if ($collection->image && Storage::disk('public')->exists($collection->image)) {
                Storage::disk('public')->delete($collection->image);
            }
            $validated['image'] = $request->file('image')->store('collection/images', 'public');
        }

        $collection->update($validated);

        return redirect()
            ->route('collection.index')
            ->with('status', 'کالکشن با موفقیت به‌روزرسانی شد.');
    }

    public function destroy(Collection $collection)
    {
        if ($collection->image && Storage::disk('public')->exists($collection->image)) {
            Storage::disk('public')->delete($collection->image);
        }

        $collection->delete();

        return redirect()
            ->route('collection.index')
            ->with('status', 'کالکشن با موفقیت حذف شد.');
    }
}
