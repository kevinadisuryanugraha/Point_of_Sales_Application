<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\StockController; // tambahkan ini
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// route login
Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('login', [LoginController::class, 'actionLogin'])->name('login.action');

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    /**
     * Kasir + Admin
     * - Bisa kelola kategori, produk, order, transaksi, stock
     */
    Route::middleware('role:Kasir,Admin')->group(function () {
        Route::resource('categories', CategoriesController::class);
        Route::resource('products', ProductController::class);
        Route::resource('orders', OrderController::class);

        // Halaman invoice
        Route::get('orders/{id}/invoice', [OrderController::class, 'invoice'])->name('orders.invoice');

        // Tandai sudah bayar
        Route::post('orders/{id}/mark-paid', [OrderController::class, 'markAsPaid'])->name('orders.markPaid');

        // Transaksi
        Route::get('transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
        Route::get('transaksi/{id}', [TransaksiController::class, 'show'])->name('transaksi.show');
        Route::get('transaksi-export/pdf', [TransaksiController::class, 'exportPdf'])->name('transaksi.exportPdf');
    });

    /**
     * Manajemen + Admin
     * - Bisa lihat laporan keuangan
     */
    Route::middleware('role:Manajemen,Admin')->group(function () {
        Route::get('/keuangan', [KeuanganController::class, 'index'])->name('keuangan.index');
        Route::get('/keuangan/export-pdf', [KeuanganController::class, 'exportPdf'])->name('keuangan.exportPdf');
    });
});
