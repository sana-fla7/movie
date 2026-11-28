<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\Collection_movie;
use App\Models\Movie;
use Illuminate\Http\Request;

class Collection_movieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $collection_movie=Collection_movie::all();
        return view("Admin.collection_movie.index" , compact('collection_movie'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $movies = Movie::all();
        $collections = Collection::all();
        return view("Admin.collection_movie.create" , compact(['collections','movies']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'movie_id' => ['required'],
            'collection_id' => ['required'],
        ]);
        Collection_movie::create([
            'movie_id' => $validated['movie_id'] ,
            'collection_id' => $validated['collection_id'] ,
        ]);
        return redirect('Admin/collection_movie/')->with('status', 'با موفقیت ثبت شد.');
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
        $collection_movie=Collection_movie::findOrFail($id);
        $movies = Movie::all();
        $collections = Collection::all();

        return view("Admin.collection_movie.edit", compact('collection_movie', 'movies', 'collections'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $collection_movie=Collection_movie::findOrFail($id);
        $validated = $request->validate([
            'movie_id' => ['required'],
            'collection_id' => ['required'],
        ]);

        $collection_movie->update($validated);
        return redirect('Admin/collection_movie/')->with('status', 'با موفقیت ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Collection_movie::findOrFail($id)->delete();
        return redirect()->route('collection_movie.index')->with('status', 'خبر با موفقیت حذف شد.');
    }
}
