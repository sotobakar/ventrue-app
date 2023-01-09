<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Login page for students
     * 
     */
    public function loginPage(Request $request)
    {
        return view('student.pages.login');
    }

    /**
     * Attempt to login student
     * 
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();

            return redirect()->route('student.home');
        };

        return back()->withErrors([
            'email' => 'Email atau password anda salah'
        ])->onlyInput('email');
    }

    /**
     * Logout current student.
     * 
     */
    public function logout(Request $request)
    {
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();

        return redirect()->route('student.home');
    }

    /**
     * Register page for students
     * 
     */
    public function registerPage(Request $request)
    {
        $faculties = Faculty::get();
        return view('student.pages.register', [
            'faculties' => $faculties
        ]);
    }

    /**
     * Register student
     * 
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string'],
            'name' => ['required', 'string'],
            'sid' => ['required', 'string', 'unique:students,sid', 'min:10'],
            'faculty_id' => ['required', 'exists:faculties,id'],
            'year' => ['required', 'integer', 'digits:4', 'min:1900', 'max:2050']
        ]);

        // Create user
        $user = User::create([
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);

        // Create student
        $user->student()->create($validated);

        // Log user in
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('student.home')->with('success', 'Pendaftaran Anda berhasil. Selamat menggunakan fitur-fitur di VENTRUE.');
    }
}
