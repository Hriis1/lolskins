<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

//---------------------------Main page----------------------------
Route::get('/', function () {
    return view('index');
})->name("main");


//---------------------------Users--------------------------------
//Log in form
Route::get('/users/loginForm', [UserController::class, 'logInForm'])->name("logInForm");
//Log in
Route::post('/users/login', [UserController::class, 'logIn'])->name("logIn");
//Sign up form
Route::get('/users/signupForm', [UserController::class, 'signUpForm'])->name("signUpForm");
//Sign up
Route::post('/users/signup', [UserController::class, 'signUp'])->name("signUp");
//Log out
Route::get('/users/logout', [UserController::class, 'logOut'])->name("logOut");


//---------------------------Admin stuff---------------------------
//Redirect for /admin
Route::get('/admin', [UserController::class, 'adminRedirect'])->name('admin');
//Admin log in form
Route::get('/admin/loginForm', [UserController::class, 'adminLogInForm'])->name('adminLogInForm');
//Admin log in
Route::post('/admin/login', [UserController::class, 'adminLogIn'])->name('adminLogIn');