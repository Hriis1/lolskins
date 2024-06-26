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

    public function adminLogInForm()
    {
        return view('users/adminLogin');
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

    public function adminLogIn(Request $request)
    {
        // Create a validator instance
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            return redirect('/admin/loginForm')
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }

        // Extract credentials
        $credentials = $request->only('email', 'password');

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            // Check if the authenticated user is an admin
            if (Auth::user()->acc_type === 'admin') {
                // Authentication passed and user is an admin...
                $request->session()->regenerate();

                // Store user_id in session
                $request->session()->put('user_id', Auth::user()->id);

                return redirect('/admin/main?logIn=success')->with('messageSuccess', 'Admin log in successful!');
            } else {
                // Log the user out if they are not an admin
                Auth::logout();
                return redirect('/admin/loginForm')
                    ->withInput($request->only('email'))
                    ->with('logIn', 'notAdmin');
            }
        }

        // Authentication failed...
        return redirect('/admin/loginForm')
            ->withInput($request->only('email'))
            ->with('logIn', 'authFail');
    }

    public function signUp(Request $request)
    {
        $formFields = $request->validate([
            'username' => ['required', Rule::unique('users', 'username')],
            'email' => ['required|email', Rule::unique('users', 'email')],
            'password' => 'required',
        ]);

        // Hash the password
        $formFields['password'] = Hash::make($formFields['password']);

        $user = User::create($formFields);

        // Log the user in
        Auth::login($user);

        // Regenerate session ID
        $request->session()->regenerate();

        // Store user_id in session
        $request->session()->put('user_id', $user->id);

        return redirect('/?signUp=success')->with('messageSuccess', 'Sign up successful!');
    }

    public function logOut(Request $request)
    {
        $request->session()->forget('user_id');

        Auth::logout();

        return redirect('/');
    }

    public function adminRedirect()
    {
        if ($this->isAdminLogged()) {
            return redirect('/admin/main');
        }
        return redirect('/admin/loginForm');
    }

    public function getUserById($id)
    {
        $user = User::find($id);
        if ($user) {
            return $user->toArray();
        }
        return null;
    }

    public function isAdminLogged()
    {
        if (session()->has('user_id')) {
            $userId = session('user_id');
            $user = $this->getUserById($userId);

            if ($user && $user['acc_type'] === 'admin') {
                return true;
            }
        }
        return false;
    }
}
