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
Route::get('/admin', function (UserController $userController) {

    if (session()->has('user_id')) {
        $userId = session('user_id');
        $user = $userController->getUserById($userId);

        if ($user && $user['acc_type'] === 'admin') {
            return redirect('/admin/main');
        }
    }
    return redirect('/admin/loginPage');
})->name('admin');