<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.users.index', [
            'users' => User::where('id', '!=', Auth::id())->get()
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        return view('dashboard.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('dashboard.users.edit', [
            'user' => $user 
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|max:255',
            'username' => 'required|min:3|max:255',
            'alamat' => 'required|string|max:255', 
            'phone' => 'required|digits_between:10,15',
        ];

        if($request->email != $user->email) {
            $rules['email'] = 'required|email|unique:users';
        }

        $validatedData = $request->validate($rules);


        // Membuat buku baru berdasarkan data yang divalidasi
        User::where('id', $user->id)
            ->update($validatedData);

        // Mengarahkan kembali ke daftar buku
        return redirect('/dashboard/users')->with('success', 'User has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        
        User::destroy($user->id);

        return redirect('/dashboard/users')->with('success' , 'User has been deleted!');

    }
}
