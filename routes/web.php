<?php

use Illuminate\Support\Facades\Route;

// ==================== CONTROLLER IMPORTS ====================
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\SiswaLoginController;
use App\Http\Controllers\Auth\ParentLoginController;
use App\Http\Controllers\Auth\WaliKelasLoginController;
use App\Http\Controllers\Auth\ParentRegisterController;
use App\Http\Controllers\Auth\WaliKelasRegisterController;
use App\Http\Controllers\Auth\RegisterSiswaController;
use App\Http\Controllers\Siswa\SiswaController;
use App\Http\Controllers\Parent\OrangTuaController;
use App\Http\Controllers\WaliKelas\WaliKelasController;
use App\Http\Controllers\WaliKelas\IzinController as WaliKelasIzinController;
use App\Http\Controllers\Auth\RedirectController;

// ==================== HALAMAN UTAMA ====================
Route::get('/', fn () => view('welcome'));

// ==================== DASHBOARD DEFAULT ====================
Route::get('/dashboard', fn () => view('dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// ==================== PROFIL PENGGUNA (SEMUA ROLE) ====================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// ============================================================
// ==================== SISWA =================================
// ============================================================
Route::prefix('siswa')->name('siswa.')->group(function () {
    // LOGIN & LOGOUT
    Route::get('/login', [SiswaLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [SiswaLoginController::class, 'login'])->name('login.submit');
    Route::post('/logout', [SiswaLoginController::class, 'logout'])->name('logout');

    // REGISTER
    Route::get('/register', [RegisterSiswaController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterSiswaController::class, 'store'])->name('register.store');

    // DASHBOARD & FITUR SISWA
    Route::middleware('auth:siswa')->group(function () {
        Route::get('/dashboard', [SiswaController::class, 'dashboard'])->name('dashboard');
        Route::get('/izin', [SiswaController::class, 'izin'])->name('izin');
        Route::post('/izin', [SiswaController::class, 'storeIzin'])->name('izin.store');
        Route::get('/profil', [SiswaController::class, 'profil'])->name('profil');
    });
});


// ============================================================
// ==================== ORANG TUA =============================
// ============================================================
Route::prefix('parent')->name('parent.')->group(function () {
    // LOGIN & LOGOUT
    Route::get('/login', [ParentLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [ParentLoginController::class, 'login'])->name('login.submit');
    Route::post('/logout', [ParentLoginController::class, 'logout'])->name('logout');

    // REGISTER
    Route::get('/register', [ParentRegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [ParentRegisterController::class, 'store'])->name('register.store');

    // DASHBOARD & IZIN (PASTIKAN GUARD = ORANGTUA)
   Route::middleware('auth:parent')->group(function () {
        Route::get('/dashboard', [OrangTuaController::class, 'index'])->name('dashboard');
        Route::get('/izin/create/{siswa}', [OrangTuaController::class, 'createIzin'])->name('izin.create');
        Route::post('/izin/store', [OrangTuaController::class, 'storeIzin'])->name('izin.store');
    });
});
// ============================================================
// ==================== WALI KELAS ============================
// ============================================================

Route::prefix('walikelas')->name('walikelas.')->group(function () {
     // LOGIN & LOGOUT
    Route::get('/login', [WaliKelasLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [WaliKelasLoginController::class, 'login'])->name('login.submit');
    Route::post('/logout', [WaliKelasLoginController::class, 'logout'])->name('logout');

    // REGISTER
    Route::get('/register', [WaliKelasRegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [WaliKelasRegisterController::class, 'store'])->name('register.store');


    // DASHBOARD & IZIN
    Route::middleware('auth:walikelas')->group(function () {
        Route::get('/dashboard', [WaliKelasController::class, 'dashboard'])->name('dashboard');
        Route::get('/profil', [WaliKelasController::class, 'profil'])->name('profil');
        Route::get('/izin', [WaliKelasController::class, 'izinIndex'])->name('izin.index');
        Route::post('/izin/{id}/update', [WaliKelasController::class, 'updateIzin'])->name('izin.update');
    });
});


// ============================================================
// ==================== REDIRECT CONTROLLER ====================
// ============================================================
Route::get('/redirect', [RedirectController::class, 'redirect'])->name('redirect');

// ==================== AUTH DEFAULT (BREEZE) ====================
require __DIR__ . '/auth.php';

Route::get('/register', fn () => view('auth.register'))->name('register');
