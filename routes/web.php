<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PosController;
// use App\Http\Controllers\Admin\DashboardController;
// use App\Http\Controllers\Admin\ProductController;

Route::get('/', function () {
    return redirect('/login');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Kasir Routes (POS)
Route::middleware(['auth', 'role:kasir'])->group(function () {
    Route::get('/pos', [PosController::class, 'index'])->name('pos.index');
    Route::post('/pos/checkout', [PosController::class, 'checkout'])->name('pos.checkout');
    // Receipt dummy page (if needed, otherwise window.print handles it)
    Route::get('/pos/receipt/{id}', [PosController::class, 'receipt'])->name('pos.receipt');
});

// Admin Routes (Dashboard & Inventory)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/inventory', \App\Http\Controllers\Admin\ProductController::class);
});