<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Admins = Admin::all();
        return view('Admin.admin.index', compact('Admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'fullname' => ['required' ,'string', 'min:3'],
            'username' => ['required' ,'string', 'min:3', 'unique:admins'],
            'password' => ['required','string', 'min:4'],
            'email' => ['required' , 'string','min:3','unique:admins'],
            'phone' => ['required' ,'string', 'min:3', 'unique:admins', ],
        ]);
        Admin::create([
            'fullname' => $validated['fullname'] ,
            'username' => $validated['username'] ,
            'password' => $validated['password'] ,
            'email' => $validated['email'] ,
            'phone' => $validated['phone'] ,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $Admins = Admin::all();
        return view('Admin.admin.index', compact('Admins'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $Admins = Admin::findOrFail($id);

        $validated = $request->validate([
            'fullname' => ['required' ,'string', 'min:3'],
            'username' => ['required' ,'string', 'min:3', 'unique:admins'],
            'password' => ['required','string', 'min:4'],
            'email' => ['required' , 'string','min:3','unique:admins'],
            'phone' => ['required' ,'string', 'min:3', 'unique:admins', ],
        ]);
        $Admins->update($validated);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
