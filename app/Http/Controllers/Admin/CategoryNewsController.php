<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryNews;
use Illuminate\Http\Request;

class CategoryNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = CategoryNews::all();
        return view('Admin.category_news.index', compact('categories'));
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
            'title'       => ['required', 'string', 'min:2', 'max:255'],
            'description' => ['nullable', 'string'],
            'status'      => ['required', 'boolean'],
        ]);
        CategoryNews::create($validated);
        return redirect()->route('category_news.index')->with('status', 'دسته بندی با موفقیت ایجاد شد.');
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
        $category = CategoryNews::findOrFail($id);
        $validated = $request->validate([
            'title'       => ['required', 'string', 'min:2', 'max:255'],
            'description' => ['nullable', 'string'],
            'status'      => ['required', 'boolean'],
        ]);
        $category->update($validated);
        return redirect()->route('category_news.index')->with('status', 'دسته بندی با موفقیت به‌روزرسانی شد.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        CategoryNews::findOrFail($id)->delete();
        return redirect()->route('category_news.index')->with('status', 'دسته بندی با موفقیت حذف شد.');
    }
}
