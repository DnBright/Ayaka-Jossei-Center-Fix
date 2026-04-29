<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserContentController;

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

Route::get('/galeri', [UserContentController::class, 'galeri'])->name('galeri.index');

Route::get('/blog', [UserContentController::class, 'blog'])->name('blog.index');
Route::get('/blog/{slug}', [UserContentController::class, 'showArticle'])->name('blog.show');

Route::get('/alumni', [UserContentController::class, 'alumni'])->name('alumni.index');

Route::get('/kontak', function () {
    return view('user.kontak');
})->name('kontak');
Route::post('/kontak', [App\Http\Controllers\CommunicationController::class, 'store'])->name('kontak.store');

Route::get('/ebook', [UserContentController::class, 'ebook'])->name('ebook.index');
Route::get('/ebook/download/{id}', [UserContentController::class, 'downloadEbook'])->middleware('auth')->name('ebook.download');

Route::middleware(['auth:admin,penulis', 'role:admin,penulis'])->group(function () {
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Artikel Management (Shared for Admin & Penulis)
    Route::get('/admin/artikel', [App\Http\Controllers\ArticleController::class, 'index'])->name('admin.artikel.index');
    Route::get('/admin/artikel/create', [App\Http\Controllers\ArticleController::class, 'create'])->name('admin.artikel.create');
    Route::get('/admin/artikel/{id}/edit', [App\Http\Controllers\ArticleController::class, 'edit'])->name('admin.artikel.edit');
    Route::post('/admin/artikel', [App\Http\Controllers\ArticleController::class, 'store'])->name('admin.artikel.store');
    Route::put('/admin/artikel/{id}', [App\Http\Controllers\ArticleController::class, 'update'])->name('admin.artikel.update');
    Route::delete('/admin/artikel/{id}', [App\Http\Controllers\ArticleController::class, 'destroy'])->name('admin.artikel.destroy');

    // Other Admin-Only Modules (Optional: Keep here or move)
    Route::get('/admin/ebook', [App\Http\Controllers\EbookController::class, 'index'])->name('admin.ebook.index');
    Route::post('/admin/ebook', [App\Http\Controllers\EbookController::class, 'store'])->name('admin.ebook.store');
    Route::put('/admin/ebook/{id}', [App\Http\Controllers\EbookController::class, 'update'])->name('admin.ebook.update');
    Route::delete('/admin/ebook/{id}', [App\Http\Controllers\EbookController::class, 'destroy'])->name('admin.ebook.destroy');

    Route::get('/admin/halaman', [App\Http\Controllers\PageController::class, 'index'])->name('admin.halaman.index');
    Route::get('/admin/halaman/{slug}', [App\Http\Controllers\PageController::class, 'edit'])->name('admin.halaman.edit');
    Route::put('/admin/halaman/{slug}', [App\Http\Controllers\PageController::class, 'update'])->name('admin.halaman.update');

    Route::get('/admin/media', [App\Http\Controllers\MediaController::class, 'index'])->name('admin.media.index');
    Route::post('/admin/media', [App\Http\Controllers\MediaController::class, 'store'])->name('admin.media.store');
    Route::put('/admin/media/{id}', [App\Http\Controllers\MediaController::class, 'update'])->name('admin.media.update');
    Route::delete('/admin/media/{id}', [App\Http\Controllers\MediaController::class, 'destroy'])->name('admin.media.destroy');

    Route::get('/admin/alumni', [App\Http\Controllers\AlumniController::class, 'index'])->name('admin.alumni.index');
    Route::post('/admin/alumni', [App\Http\Controllers\AlumniController::class, 'store'])->name('admin.alumni.store');
    Route::put('/admin/alumni/{id}', [App\Http\Controllers\AlumniController::class, 'update'])->name('admin.alumni.update');
    Route::delete('/admin/alumni/{id}', [App\Http\Controllers\AlumniController::class, 'destroy'])->name('admin.alumni.destroy');

    Route::get('/admin/komunikasi', [App\Http\Controllers\CommunicationController::class, 'index'])->name('admin.komunikasi.index');
    Route::post('/admin/komunikasi/{id}/read', [App\Http\Controllers\CommunicationController::class, 'markAsRead'])->name('admin.komunikasi.read');
    Route::delete('/admin/komunikasi/{id}', [App\Http\Controllers\CommunicationController::class, 'destroy'])->name('admin.komunikasi.destroy');

    Route::get('/admin/users', [App\Http\Controllers\AdminController::class, 'users'])->name('admin.users');
    Route::post('/admin/users', [App\Http\Controllers\AdminController::class, 'createUser'])->name('admin.users.store');
    Route::post('/admin/users/{id}/approve', [App\Http\Controllers\AdminController::class, 'approveUser'])->name('admin.users.approve');
    Route::post('/admin/users/{id}/reject', [App\Http\Controllers\AdminController::class, 'rejectUser'])->name('admin.users.reject');

    Route::get('/admin/pengaturan', [App\Http\Controllers\SettingController::class, 'index'])->name('admin.pengaturan.index');
    Route::put('/admin/pengaturan', [App\Http\Controllers\SettingController::class, 'update'])->name('admin.pengaturan.update');
});

// Penulis Routes
Route::middleware(['auth:penulis', 'role:penulis'])->group(function () {
    Route::get('/penulis', [App\Http\Controllers\PenulisController::class, 'dashboard'])->name('penulis.dashboard');
    Route::get('/penulis/artikel', [App\Http\Controllers\PenulisController::class, 'artikel'])->name('penulis.artikel.index');
    Route::get('/penulis/artikel/create', [App\Http\Controllers\ArticleController::class, 'create'])->name('penulis.artikel.create');
    Route::get('/penulis/artikel/{id}/edit', [App\Http\Controllers\ArticleController::class, 'edit'])->name('penulis.artikel.edit');
    Route::post('/penulis/artikel', [App\Http\Controllers\ArticleController::class, 'store'])->name('penulis.artikel.store');
    Route::put('/penulis/artikel/{id}', [App\Http\Controllers\ArticleController::class, 'update'])->name('penulis.artikel.update');
    Route::delete('/penulis/artikel/{id}', [App\Http\Controllers\ArticleController::class, 'destroy'])->name('penulis.artikel.destroy');
    
    Route::get('/penulis/ebook', [App\Http\Controllers\PenulisController::class, 'ebook'])->name('penulis.ebook.index');
    Route::post('/penulis/ebook', [App\Http\Controllers\EbookController::class, 'store'])->name('penulis.ebook.store');
    Route::put('/penulis/ebook/{id}', [App\Http\Controllers\EbookController::class, 'update'])->name('penulis.ebook.update');
    Route::delete('/penulis/ebook/{id}', [App\Http\Controllers\EbookController::class, 'destroy'])->name('penulis.ebook.destroy');
    Route::get('/penulis/media', [App\Http\Controllers\PenulisController::class, 'media'])->name('penulis.media.index');
    Route::post('/penulis/media', [App\Http\Controllers\MediaController::class, 'store'])->name('penulis.media.store');
    Route::put('/penulis/media/{id}', [App\Http\Controllers\MediaController::class, 'update'])->name('penulis.media.update');
    Route::delete('/penulis/media/{id}', [App\Http\Controllers\MediaController::class, 'destroy'])->name('penulis.media.destroy');
    Route::get('/penulis/profile', [App\Http\Controllers\PenulisController::class, 'profile'])->name('penulis.profile');
});

// Emergency Migration Route
Route::get('/run-migrate', function () {
    try {
        // Gunakan Raw SQL untuk memastikan perubahan terjadi di server produksi
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE articles ADD COLUMN is_member_only TINYINT(1) DEFAULT 0 AFTER status');
        return "Database berhasil diperbarui! Kolom 'is_member_only' telah ditambahkan. Silakan coba simpan artikel lagi.";
    } catch (\Exception $e) {
        // Jika kolom sudah ada, abaikan errornya
        if (str_contains($e->getMessage(), 'Duplicate column name')) {
            return "Kolom 'is_member_only' sudah ada di database. Sistem aman digunakan.";
        }
        return "Gagal update database: " . $e->getMessage();
    }
});

