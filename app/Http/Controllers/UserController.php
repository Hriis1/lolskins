<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
        // Create a validator instance
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            return redirect('/users/loginForm?logIn=validFail')
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }

        // Extract credentials
        $credentials = $request->only('email', 'password');

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $request->session()->regenerate();

            return redirect('/?logIn=success')->with('messageSuccess', 'Log in successful!');
        }

        // Authentication failed...
        return redirect('/users/loginForm?logIn=authFail');
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
