<?php

namespace App\Http\Controllers\BiroAkpk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * View biro akpk login page.
     * 
     */
    public function loginPage(Request $request)
    {
        return view('biroakpk.pages.login');
    }

    /**
     * Attempt to login as biro akpk.
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

            return redirect()->route('biroakpk.dashboard');
        }


        return back()->withErrors([
            'email' => 'Email atau password anda salah.',
        ])->onlyInput('email');
    }

    /**
     * Log out biro akpk.
     * 
     */
    public function logout(Request $request)
    {
        Auth::logout();

        return redirect()->route('biroakpk.login');
    }
}
