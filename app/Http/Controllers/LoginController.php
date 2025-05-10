<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index () {
        return view('dashboard.login.index', [
            'title' => 'Login',
        ]);
    }

    public function authenticate(Request $r) {

        $credentials = $r->validate([
            'email' => 'required|email',
            'password' => 'required|min:5|max:30'
        ]);

        // if (Auth::attempt($credentials)) {
        //     $r->session()->regenerate();
        //     return redirect()->intended('/dashboard');
        // }

        if (auth()->attempt($credentials)) {
            $r->session()->regenerate();
            return redirect()->intended('/'); //intended ini untuk melewati middleware
        }

        return back()->with('loginError', 'Login failed!');
    }


    public function logout(Request $r) {

        // Auth::logout();
        auth()->logout();

        $r->session()->invalidate();
        $r->session()->regenerateToken();

        return redirect('/')->with('success', 'Logout success!');
    }
}
