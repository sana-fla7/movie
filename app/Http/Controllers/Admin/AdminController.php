<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::latest()->get();
        return view('Admin.admins.index', compact('admins'));
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
            'fullname' => ['required', 'string', 'min:3', 'max:255'],
            'username' => ['required', 'string', 'min:3', 'max:255', 'unique:admins,username'],
            'email'    => ['required', 'email', 'max:255', 'unique:admins,email'],
            'phone'    => ['nullable', 'digits_between:8,20', 'unique:admins,phone'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        $validated['password'] = Hash::make($validated['password']);
        Admin::create($validated);
        return redirect()->route('admins.index')->with('status', 'مدیر با موفقیت ایجاد شد.');
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
        $admin = Admin::findOrFail($id);
        $validated = $request->validate([
            'fullname' => ['required', 'string', 'min:3', 'max:255'],
            'username' => ['required', 'string', 'min:3', 'max:255', 'unique:admins,username,' . $admin->id],
            'email'    => ['required', 'email', 'max:255', 'unique:admins,email,' . $admin->id],
            'phone'    => ['nullable', 'digits_between:8,20', 'unique:admins,phone,' . $admin->id],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
        ]);
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }
        $admin->update($validated);
        return redirect()->route('admins.index')->with('status', 'مدیر با موفقیت به‌روزرسانی شد.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Admin::findOrFail($id)->delete();
        return redirect()->route('admins.index')->with('status', 'مدیر با موفقیت حذف شد.');
    }
}
