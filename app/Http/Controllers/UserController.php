<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function logInForm()
    {
        return view('users/login');
    }

    public function signUpForm()
    {
        return view('users/signup');
    }

    public function logIn(Request $request)
    {
        // Validate the credentials
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $request->session()->regenerate();

            return redirect('/?logIn=success')->with('messageSuccess', 'Log in successful!');
        }

        // Authentication failed...
        return redirect('/users/loginForm?logIn=fail');
    }

    public function signUp(Request $request)
    {
        $formFields = $request->validate([
            'username' => ['required', Rule::unique('users', 'username')],
            'email' => 'required',
            'password' => 'required',
        ]);

        // Hash the password
        $formFields['password'] = Hash::make($formFields['password']);

        User::create($formFields);

        return redirect('/?signUp=success')->with('messageSuccess', 'Sign up successful!');
    }
}
