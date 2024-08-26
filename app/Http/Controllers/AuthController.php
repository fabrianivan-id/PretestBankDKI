<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('rekening');
        }
        return redirect('login')->withErrors('Login gagal, periksa email dan password Anda.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
