<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/profil', function () {
    return view('profil');
});

Route::get('/program', function () {
    return view('program');
});

Route::get('/galeri', function () {
    return view('galeri');
});

Route::get('/blog', function () {
    return view('blog');
});

Route::get('/alumni', function () {
    return view('alumni');
});

Route::get('/kontak', function () {
    return view('kontak');
});
