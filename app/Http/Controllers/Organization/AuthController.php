<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Organization log in page.
     * 
     */
    public function loginPage(Request $request)
    {
        return view('organization.pages.login');
    }

    /**
     * Organization attempt to log in.
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

            return redirect()->route('organization.dashboard');
        }

 
        return back()->withErrors([
            'email' => 'Email atau password anda salah.',
        ])->onlyInput('email');
    }

    /**
     * Log out from organization dashboard.
     * 
     */
    public function logout(Request $request)
    {
        Auth::logout();

        return redirect()->route('organization.login');
    }
}
