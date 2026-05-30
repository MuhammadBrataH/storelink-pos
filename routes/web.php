<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();

        return $user && $user->role === 'admin'
            ? redirect()->route('admin.home')
            : redirect()->route('pos.index');
    }

    return redirect()->route('login');
});

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.home');
    })->name('admin.home');
});

Route::middleware(['auth', 'role:kasir'])->group(function () {
    Route::get('/pos', function () {
        return view('pos.index');
    })->name('pos.index');
});
