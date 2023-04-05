<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

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
            'phone' => ['required', 'string'],
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
        $user->assignRole('student');

        // Log user in
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('student.home')->with('success', 'Pendaftaran Anda berhasil. Selamat menggunakan fitur-fitur di VENTRUE.');
    }

    /**
     * Redirect to OAuth2 Provider Authorization page
     * 
     */
    public function redirect(Request $request, $provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Callback method from OAuth2 Provider
     * 
     */
    public function callback(Request $request, $provider)
    {
        $user = Socialite::driver($provider)->user();

        // Check if student exists, if not then redirect back to login page with error.
        $student = Student::whereHas('user', function (Builder $query) use ($user) {
            $query->where('email', $user->email);
        })->first();

        if (is_null($student)) {
            return redirect()->route('student.login')->withErrors(['Email anda belum terdaftar. Silahkan registrasi mahasiswa terlebih dahulu.']);
        }

        Auth::login($student->user);

        return redirect()->route('student.home');
    }
}
