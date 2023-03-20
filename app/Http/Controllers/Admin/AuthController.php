<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * View admin login page.
     * 
     */
    public function loginPage(Request $request)
    {
        return view('admin.pages.login');
    }

    /**
     * Attempt to login as admin.
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

            return redirect()->route('admin.dashboard');
        }


        return back()->withErrors([
            'email' => 'Email atau password anda salah.',
        ])->onlyInput('email');
    }

    /**
     * Log out admin.
     * 
     */
    public function logout(Request $request)
    {
        Auth::logout();

        return redirect()->route('admin.login');
    }
}
