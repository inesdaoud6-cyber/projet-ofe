<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/auth/login', function () {
    return view('auth.login');
})->name('auth.login');

Route::post('/auth/login', function () {
    return "Login POST OK"; 
})->name('auth.login.post');