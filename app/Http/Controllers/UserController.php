<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
