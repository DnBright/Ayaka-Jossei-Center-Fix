<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('user.welcome');
});

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::get('/pending-approval', [AuthController::class, 'showPending'])->name('pending-approval');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/admin/login', [AuthController::class, 'showAdminLogin'])->name('login.admin');
Route::get('/penulis/login', [AuthController::class, 'showPenulisLogin'])->name('login.penulis');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

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
})->middleware('auth');

Route::get('/alumni', function () {
    return view('user.alumni');
});

Route::get('/kontak', function () {
    return view('user.kontak');
});

Route::get('/ebook', function () {
    return view('user.ebook');
})->middleware('auth');

Route::middleware('auth')->group(function () {
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

    Route::get('/admin/users', [App\Http\Controllers\AdminController::class, 'users'])->name('admin.users');
    Route::post('/admin/users/{id}/approve', [App\Http\Controllers\AdminController::class, 'approveUser'])->name('admin.users.approve');
    Route::post('/admin/users/{id}/reject', [App\Http\Controllers\AdminController::class, 'rejectUser'])->name('admin.users.reject');

    Route::get('/admin/pengaturan', function () {
        return view('admin.pengaturan');
    });
});

// Penulis Routes
Route::middleware('auth')->group(function () {
    Route::get('/penulis', function () {
        return view('penulis.dashboard');
    });

    Route::get('/penulis/artikel', function () {
        return view('penulis.artikel');
    });

    Route::get('/penulis/ebook', function () {
        return view('penulis.ebook');
    });

    Route::get('/penulis/media', function () {
        return view('penulis.media');
    });

    Route::get('/penulis/profile', function () {
        return view('penulis.profile');
    });
});
