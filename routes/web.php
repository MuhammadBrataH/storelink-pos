<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PosController;

Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();

        return $user && $user->role === 'admin'
            ? redirect()->route('home')
            : redirect()->route('pos.index');
    }

    return redirect()->route('login');
});

// Authentication Routes
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin Routes (Dashboard & Inventory)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    Route::prefix('inventory')->name('inventory.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/', [ProductController::class, 'store'])->name('store');
        Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit');
        Route::put('/{product}', [ProductController::class, 'update'])->name('update');
        Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy');
    });


    Route::resource('users', App\Http\Controllers\UserController::class)->except(['show']);
});

// Kasir Routes (POS)
Route::middleware(['auth', 'role:kasir'])->group(function () {
    Route::get('/pos', [PosController::class, 'index'])->name('pos.index');
    Route::post('/pos/checkout', [PosController::class, 'checkout'])->name('pos.checkout');
    Route::get('/pos/receipt/{id}', [PosController::class, 'receipt'])->name('pos.receipt');
});