<?php

use App\Http\Controllers\SkinRatingController;
use Illuminate\Support\Facades\Route;

use App\Models\SkinRating;

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

//Routes where there has to be a logged admin
Route::middleware(['isAdmin'])->group(function () {
    //Main admin page
    Route::get('/admin/main', function () {
        //Get the id and ratings of the authorized admin
        $id = \Auth::user()->id;
        return view('admin/index', [
            'ratings' => SkinRating::where('deleted', false)->where('user_id', $id)->latest()->get()
        ]);
    })->name('adminMain');
});

//---------------------------Skin Ratings--------------------------------
//Store in db
Route::post('/skinRating/store', [SkinRatingController::class, 'store'])->name('storeSkinRating');
//Edit rating
Route::post('/skinRating/edit', [SkinRatingController::class, 'edit'])->name('editSkinRating');
//Delete rating
Route::post('/skinRating/delete/{id}', [SkinRatingController::class, 'delete'])->name('deleteSkinRating');
//Get the skin ratings of a certain user for certain champ
Route::get('/skinRating/getUsersRatingsOfChamp', [SkinRatingController::class, 'getUsersRatingsOfChamp'])->name('getUsersRatingsOfChamp');
//Get the skin ratings of the admin for certain champ
Route::get('/skinRating/getAdminsRatingsOfChamp', [SkinRatingController::class, 'getAdminsRatingsOfChamp'])->name('getAdminsRatingsOfChamp');
