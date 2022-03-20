<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('main/index');
})->name('home');

Route::get('/register', function(){
    return view('main/register');
})->name('register');