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
            return redirect('/users/loginForm')
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }

        // Extract credentials
        $credentials = $request->only('email', 'password');

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $request->session()->regenerate();

            // Store user_id in session
            $request->session()->put('user_id', Auth::user()->id);

            return redirect('/?logIn=success')->with('messageSuccess', 'Log in successful!');
        }

        // Authentication failed...
        return redirect('/users/loginForm')
            ->withInput($request->only('email'))
            ->with('logIn', 'authFail');
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

        $user = User::create($formFields);

        // Regenerate session ID
        $request->session()->regenerate();

        // Store user_id in session
        $request->session()->put('user_id', $user->id);

        return redirect('/?signUp=success')->with('messageSuccess', 'Sign up successful!');
    }

    public function logOut(Request $request)
    {
        $request->session()->forget('user_id');

        return redirect('/');
    }
}
