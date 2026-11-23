<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryNews;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::with(['category', 'admin'])->latest()->paginate(15);
        return view('Admin.news.index', compact('news'));
    }

    public function create()
    {
        $categories = CategoryNews::orderBy('title')->get();
        return view('Admin.news.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => ['required', 'string', 'min:3', 'max:255'],
            'description' => ['required', 'string', 'min:10'],
            'content'     => ['required', 'string', 'min:10'],
            'image'       => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:4096'],
            'category_id' => ['required', 'exists:category_news,id'],
            'status'      => ['required', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('news/images', 'public');
        }

        $validated['admin_id'] = Auth::id();

        News::create($validated);

        return redirect()
            ->route('news.index')
            ->with('status', 'خبر با موفقیت ایجاد شد.');
    }

    public function edit(News $news)
    {
        $categories = CategoryNews::orderBy('title')->get();
        return view('Admin.news.update', compact('news', 'categories'));
    }

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title'       => ['required', 'string', 'min:3', 'max:255'],
            'description' => ['required', 'string', 'min:10'],
            'content'     => ['required', 'string', 'min:10'],
            'image'       => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:4096'],
            'category_id' => ['required', 'exists:category_news,id'],
            'status'      => ['required', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            if ($news->image && Storage::disk('public')->exists($news->image)) {
                Storage::disk('public')->delete($news->image);
            }
            $validated['image'] = $request->file('image')->store('news/images', 'public');
        }

        $news->update($validated);

        return redirect()
            ->route('news.index')
            ->with('status', 'خبر با موفقیت به‌روزرسانی شد.');
    }

    public function destroy(News $news)
    {
        if ($news->image && Storage::disk('public')->exists($news->image)) {
            Storage::disk('public')->delete($news->image);
        }
        $news->delete();
        return redirect()->route('news.index')->with('status', 'خبر با موفقیت حذف شد.');
    }
}
