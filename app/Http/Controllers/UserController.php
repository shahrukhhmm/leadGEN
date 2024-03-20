<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::latest()->get();
        return view('user.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => 'required',
            'role_id' => 'required'
        ]);
       User::create($request->all());
       return redirect()->back()->with('success', 'User created successfully.');
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
    public function edit(User $user)
    {
        $users = User::latest()->get();
        return view('user.create', compact('user','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,User $user)
    {
        $user->update(
            $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'email' => ['sometimes', 'string', 'email', 'max:255', function ($attribute, $value, $fail) use ($user) {
                // Only validate uniqueness if the email has changed
                if ($value !== $user->email && User::where('email', $value)->exists()) {
                    $fail('The email has already been taken.');
                }
            }],
            'password' => 'sometimes',
            'role_id' => 'sometimes'
        ])
        );
       return redirect()->back()->with('success', 'User Updated successfully.');

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
       return redirect()->back()->with('success', 'User Deleted successfully.');

    }
}
