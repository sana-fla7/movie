<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryNews;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies=Movie::all();
        return view("Admin.Movies.index" , compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view("Admin.Movies.create" , compact(['categories']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required' , 'min:3'],
            'category_id' => ['required'],
            'description' => ['min:5'],
            'country' => ['required' , 'min:2'],
            'year' => ['required' , 'min:2'],
            'time' => ['required' , 'min:2'],
            'poster' => ['mimes:jpg,jpeg,png'],
            'imdb' => ['numeric', 'min:0' , 'max:10'],
            'content' => ['min:5'],
        ]);
        $path=$request->file('poster')->store('posters' , 'public');
        Movie::create([
            'title' => $validated['title'] ,
            'category_id' => $validated['category_id'] ,
            'description' => $validated['description'] ,
            'country' => $validated['country'] ,
            'year' => $validated['year'] ,
            'time' => $validated['time'] ,
            'poster' => $path,
            'imdb' => $validated['imdb'] ,
            'content' => $validated['content'] ,
        ]);
        return redirect('Admin/Movies/')->with('status', 'با موفقیت ثبت شد.');
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
        $categories = Category::all();
        $movie = Movie::findOrFail($id);
        return view("Admin.Movies.edit" , compact(['movie' , 'categories']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $Movie = Movie::findOrFail($id);
        $validated = $request->validate([
            'title' => ['required' , 'min:3'],
            'category_id' => ['required'],
            'description' => ['min:5'],
            'country' => ['required' , 'min:2'],
            'year' => ['required' , 'min:2'],
            'time' => ['required' , 'min:2'],
            'poster' => ['mimes:jpg,jpeg,png'],
            'imdb' => ['numeric', 'min:0' , 'max:10'],
            'content' => ['min:5'],
        ]);

        if($request->file('poster') !== null){
            $validated["poster"]=$request->file('poster')->store('posters' , 'public');
        }else{
            $validated["poster"]="";
        }
        $Movie->update($validated);
        return redirect('Admin/movies/')->with('status', 'با موفقیت ویرایش شد.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Movie::findOrFail($id)->delete();
        return redirect()->route('movies.index')->with('status', 'فیلم با موفقیت حذف شد.');
    }
}
