<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ProductController;

Route::get('/', [StoreController::class, 'index'])->name('store.index');
Route::get('/buah/{product:slug}', [StoreController::class, 'show'])->name('store.show');

Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index');
Route::post('/keranjang/{product}', [CartController::class, 'add'])->name('cart.add');
Route::patch('/keranjang/{product}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/keranjang/{product}', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/pesanan/{order}', [CheckoutController::class, 'success'])->name('checkout.success');
// Pembeli liat pesanan dia sendiri
Route::get('/pesanan-saya', [App\Http\Controllers\CheckoutController::class, 'myOrders'])->name('pesanan.saya');

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.process');

    Route::middleware('admin')->group(function () {

        Route::get('/', [ProductController::class, 'index'])
            ->name('dashboard');

        Route::resource('products', ProductController::class)
            ->except(['show']);

        Route::post('/logout', [AuthController::class, 'logout'])
            ->name('logout');
    });

});

    Route::post('/admin/pesanan/{order}/konfirmasi', [CheckoutController::class, 'konfirmasiPesanan'])->name('admin.pesanan.konfirmasi');
    Route::post('/pesanan/{order}/batal', [CheckoutController::class, 'batalkanPesanan'])->name('pesanan.batal');

    
    Route::get('/admin/pesanan', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('admin.pesanan.index');