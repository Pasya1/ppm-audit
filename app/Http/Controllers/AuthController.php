<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username_login' => 'required',
            'password' => 'required',
        ]);

        // Attempt login
        if (Auth::attempt(['name' => $request->username_login, 'password' => $request->password])) {
            return redirect()->intended('/admin'); // Redirect ke halaman dashboard
        }

        // Jika gagal login
        return back()->withErrors([
            'name' => 'Username atau password salah.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
