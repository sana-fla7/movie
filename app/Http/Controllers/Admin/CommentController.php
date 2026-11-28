<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments=Comment::all();
        return view("Admin.comments.index" , compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $movies = Movie::all();
        return view("Admin.comments.create" , compact(['users' , 'movies']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => ['required'],
            'movie_id' => ['required'],
            'massage' => ['required' , 'min:3'],
        ]);

        Comment::create([
            'user_id' => $validated['user_id'] ,
            'movie_id' => $validated['movie_id'] ,
            'massage' => $validated['massage'] ,
        ]);

        return redirect('Admin/comments/')->with('status', 'با موفقیت ثبت شد.');
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
        $comment = Comment::findOrFail($id);

        return view("Admin.comments.edit" , compact(['comment' , 'users' , 'movies']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $comment = Comment::findOrFail($id);

        $validated = $request->validate([
            'user_id' => ['required'],
            'movie_id' => ['required'],
            'massage' => ['required' , 'min:3'],
        ]);

        $comment->update($validated);

        return redirect('Admin/comments/')->with('status', 'با موفقیت ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Comment::findOrFail($id)->delete();

        return redirect()->route('comments.index')->with('status', 'با موفقیت حذف شد.');
    }
}
