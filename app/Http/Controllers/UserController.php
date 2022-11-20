<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Show register/create form
    public function getRegister()
    {
        return view('users.register');
    }

    // Create new user
    public function register(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        // Create User
        $user = User::create($formFields);

        // Login
        auth()->login($user);

        return redirect('/')->with('message', 'User Created & Logged In');
    }

    // Logout user
    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out');
    }

    // Show login/create form
    public function getLogin()
    {
        return view('users.login');
    }

    // Create new user
    public function login(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();
            return redirect('/')->with(
                'message',
                'You are now logged in'
            );
        }

        return back()->withErrors([
            'email' => 'Invalid Creadentials'
        ])->onlyInput('email');
    }
}
