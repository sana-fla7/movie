<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\User;
use App\Models\Watchlist;
use Illuminate\Http\Request;

class WatchlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $watchlist=Watchlist::all();
        return view("Admin.watchlist.index" , compact('watchlist'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $movies = Movie::all();
        return view("Admin.watchlist.create" , compact(['users' , 'movies']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => ['required'],
            'movie_id' => ['required'],
            'title' => ['required' , 'min:3'],
            'status' => ['required'],
        ]);

        Watchlist::create([
            'user_id' => $validated['user_id'] ,
            'movie_id' => $validated['movie_id'] ,
            'title' => $validated['title'] ,
            'status' => $validated['status'] ,
        ]);

        return redirect('Admin/watchlist/')->with('status', 'با موفقیت ثبت شد.');
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
        $users = User::all();
        $movies = Movie::all();
        $watchlist = Watchlist::findOrFail($id);

        return view("Admin.watchlist.edit" , compact(['watchlist' , 'users' , 'movies']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $watchlist = Watchlist::findOrFail($id);

        $validated = $request->validate([
            'user_id' => ['required'],
            'movie_id' => ['required'],
            'title' => ['required' , 'min:3'],
            'status' => ['required'],
        ]);

        $watchlist->update($validated);

        return redirect('Admin/watchlist/')->with('status', 'با موفقیت ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Watchlist::findOrFail($id)->delete();

        return redirect()->route('watchlist.index')->with('status', 'با موفقیت حذف شد.');
    }
}
