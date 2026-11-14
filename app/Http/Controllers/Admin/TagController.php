<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Tags = Tag::all();
        return view('Admin.tags.index', compact('Tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required' , 'min:3'],
            'status' => ['required', 'integer'],
        ]);
        Tag::create([
            'title' => $validated['title'] ,
            'status' => $validated['status'] ,
        ]);
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
        $Tags = Tag::all();
        return view('Admin.tags.index', compact('Tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $Tags = Tag::findOrFail($id);

        $validated = $request->validate([
            'title' => ['required', 'min:3'],
            'status' => ['required', 'integer']
        ]);
        $Tags->update($validated);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
