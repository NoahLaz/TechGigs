<?php

namespace App\Http\Controllers;

use App\Models\User;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // show registration form
    public function create()
    {
        return View('users.register');
    }

    // store a new user
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        // hash the password
        $formFields['password'] = bcrypt($formFields['password']);

        // create the user
        $user = User::create($formFields);

        // login the user
        auth()->login($user);

        return redirect('/')->with('message', 'Your account have been successfuly created');
    }

    // logout the user
    public function logout()
    {
        auth()->logout();

        return redirect('/')->with('message', 'You have been logged out');
    }

    // show loggin the form
    public function login()
    {
        return View('users.login');
    }

    // authenticate the user
    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        // attempt auth
        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/')->with('message', "You've been logged in!");
        }

        return back()->with('message', 'Invalid credentials');
    }
}
