<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;
use App\Models\Collection;



class CollectionController extends Controller
{


        public function index()
    {
        $collections = Collection::all();

        return view("Admin.collections.index", compact('collections'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $movies = Movie::all();
        return view("Admin.collections.create", compact('movies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required' , 'min:3'],
            'movie_id' => ['required'],
            'image' => ['mimes:jpg,jpeg,png'],
        ]);
        $path=$request->file('image')->store('image' , 'public');
        Collection::create([
            'title' => $validated['title'] ,
            'movie_id' => $validated['movie_id'],
            'image' => $path,
        ]);
        return redirect('Admin/collection/')->with('status', 'با موفقیت ثبت شد.');
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
        $collections = Collection::findOrFail($id);
        $movies = Movie::all();

        return view("Admin.collections.edit", compact('collections', 'movies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $collections = Collection::findOrFail($id);
        $validated = $request->validate([
            'title' => ['required' , 'min:3'],
            'movie_id' => ['required'],
            'image' => ['mimes:jpg,jpeg,png'],
        ]);

        if($request->file('image') !== null){
            $validated["image"]=$request->file('image')->store('image' , 'public');
        }
        $collections->update($validated);
        return redirect('Admin/collection/')->with('status', 'با موفقیت ویرایش شد.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Collection::findOrFail($id)->delete();
        return redirect()->route('collection.index')->with('status', 'کالکشن با موفقیت حذف شد.');
    }
}



