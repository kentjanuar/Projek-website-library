<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index() {
        return view ('dashboard.register.index');
    }

    public function store(Request $request) {
        // dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|min:3|max:255',
            'email' => 'required|email:dns|unique:users',
            'alamat' => 'required|string|max:255', 
            'phone' => 'required|digits_between:10,15',
            'password' => 'required|min:5|max:30'
        ]);
        
        $validatedData['password'] = Hash::make($validatedData['password']);
        
        // Store user data in the database
        User::create($validatedData);
        
        return redirect('/login')->with('success', 'Your account has been created.');
    }
}
