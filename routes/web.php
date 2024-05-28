<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

//---------------------------Main page---------------------------
Route::get('/', function () {
    return view('index');
})->name("main");


//---------------------------Users---------------------------
//Log in form
Route::get('/users/loginForm', [UserController::class, 'logInForm'])->name("logInForm");
//Sign up form
Route::get('/users/signupForm', [UserController::class, 'signUpForm'])->name("signUpForm");