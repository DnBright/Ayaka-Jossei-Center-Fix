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

Route::get('/admin/ebook', function () {
    return view('admin.ebook');
});

Route::get('/admin/halaman', function () {
    return view('admin.halaman');
});

Route::get('/admin/halaman/home', function () {
    return view('admin.pages.home');
});

Route::get('/admin/halaman/about', function () {
    return view('admin.pages.about');
});

Route::get('/admin/halaman/program', function () {
    return view('admin.pages.program');
});

Route::get('/admin/media', function () {
    return view('admin.media');
});

Route::get('/admin/komunikasi', function () {
    return view('admin.komunikasi');
});

Route::get('/admin/users', function () {
    return view('admin.users');
});

Route::get('/admin/pengaturan', function () {
    return view('admin.pengaturan');
});
