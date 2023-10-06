<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Displays the register page view
     */
    public function view_register_page()
    {
        return view("auth.register");
    }

    /**
     * Displays the login page view
     */
    public function view_login_page()
    {
        return view("auth.login");
    }

    /**
     * Creates a new user account
     */
    public function register(Request $request)
    {
        $credentials = $request->validate([
            "username" => "required|unique:users|min:3|max:255",
            "email" => "required|unique:users|email",
            "password" => "min:8|max:255",
        ]);

        $user = new User($credentials);
        $user->save();

        return redirect()
            ->route("view_login_page")
            ->with("success", "Your account has been created");
    }

    /**
     * Logs in a user to their existing account
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            "email" => "required|email",
            "password" => "min:8|max:255",
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect("/")->with("success", "You are now logged in");
        }

        return back()->withErrors([
            "email" => "The provided credentials do not match our records",
        ])->onlyInput("email");
    }

    /**
     * Logs out a user
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect("/")->with("success", "You have logged out of your account");
    }
}
