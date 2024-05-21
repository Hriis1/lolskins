<?php

use Illuminate\Support\Facades\Route;

//---------------------------Main page---------------------------
Route::get('/', function () {
    return view('index');
});
