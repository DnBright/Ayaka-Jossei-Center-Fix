<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('user.welcome');
});

Route::get('/profil', function () {
    return view('user.profil');
});

Route::get('/program', function () {
    return view('user.program');
});

Route::get('/galeri', function () {
    return view('user.galeri');
});

Route::get('/blog', function () {
    return view('user.blog');
});

Route::get('/alumni', function () {
    return view('user.alumni');
});

Route::get('/kontak', function () {
    return view('user.kontak');
});

Route::get('/admin', function () {
    return view('admin.dashboard');
});

Route::get('/admin/artikel', function () {
    return view('admin.artikel');
});

Route::get('/admin/users', function () {
    return view('admin.users');
});
