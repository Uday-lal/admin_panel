<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function getLogin(Request $request)
    {
        $user = Auth::user();
        if ($user)
            return redirect('/');
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            session()->put('user_id', $user->id);
            return redirect("/");
        }
        return redirect('/login')->with('error', 'Wrong email or password');
    }
}
