<?php

namespace App\Http\Controllers\BiroUmum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * View biro umum login page.
     * 
     */
    public function loginPage(Request $request)
    {
        return view('biroumum.pages.login');
    }

    /**
     * Attempt to login as biro umum.
     * 
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();

            return redirect()->route('biroumum.dashboard');
        }


        return back()->withErrors([
            'email' => 'Email atau password anda salah.',
        ])->onlyInput('email');
    }

    /**
     * Log out biro umum.
     * 
     */
    public function logout(Request $request)
    {
        Auth::logout();

        return redirect()->route('biroumum.login');
    }
}
