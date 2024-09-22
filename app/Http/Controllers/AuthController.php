<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use File;

class AuthController extends Controller
{
    public function showregister()
    {
        if (Auth::check()) {
            return redirect($this->redirectDash());
        }
        return view('Registers.create');
    }

    public function register(Request $request)
    {
        $request->validate(User::$rules);
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('image'), $imageName);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->image = 'image/' . $imageName;
        $user->password = Hash::make($request->password);
        $user->save();
        return back()->with('success', 'Your Registration has been successfull.');
    }

    public function showLogin()
    {
        if (Auth::check()) {
            return redirect($this->redirectDash());
        }

        return response()->view('Login.login')->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
                                            ->header('Pragma', 'no-cache');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ], [
            'email.required' => 'Email is required.',
            'email.email' => 'Please provide a valid email address.',
            'password.required' => 'Password is required.',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->put('User_Id', Auth::id());
            $request->session()->regenerate();
            return redirect($this->redirectDash());
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }



    public function redirectDash()
    {
        if (!Auth::check()) {
            return '/login';
        }

        switch (Auth::user()->rolefk) {
            case 1:
                return '/admin/dashboard';
            case 2:
                return '/driver/dashboard';
            case 3:
                return '/';
            default:
                return '/login';
        }
    }


    public function logout(Request $request)
    {
        Auth::logout(); // Log the user out
        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate CSRF token

        return redirect('/login')->with('success', 'Logged out successfully.'); // Redirect to login page
    }

}
