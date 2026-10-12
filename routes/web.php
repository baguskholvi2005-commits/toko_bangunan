<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\StockOpnameController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\BackupController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ===== Master Data: index (lihat) terbuka untuk SEMUA role yang login =====
    Route::resource('categories', CategoryController::class)->only(['index']);
    Route::resource('suppliers', SupplierController::class)->only(['index']);
    Route::resource('customers', CustomerController::class)->only(['index']);
    Route::resource('products', ProductController::class)->only(['index']);

    // ===== Kategori & Produk: hanya Admin yang boleh tambah/edit/hapus =====
    Route::middleware('role:admin')->group(function () {
        Route::resource('categories', CategoryController::class)->except(['index']);
        Route::resource('products', ProductController::class)->except(['index']);
    });

    // ===== Supplier: Admin & Gudang yang boleh tambah/edit/hapus =====
    Route::middleware('role:admin,gudang')->group(function () {
        Route::resource('suppliers', SupplierController::class)->except(['index']);
    });

    // ===== Pelanggan: Admin & Kasir yang boleh tambah/edit/hapus =====
    Route::middleware('role:admin,kasir')->group(function () {
        Route::resource('customers', CustomerController::class)->except(['index']);
    });

    // ===== Pembelian & Stock Opname: Admin, Owner, Gudang — Kasir TIDAK BISA akses sama sekali =====
    Route::middleware('role:admin,owner,gudang')->group(function () {
        Route::resource('purchases', PurchaseController::class)->except(['edit', 'update']);
        Route::resource('stock-opnames', StockOpnameController::class)->except(['edit', 'update', 'destroy']);
    });

    // ===== Penjualan/POS: Admin, Owner, Kasir — Gudang TIDAK BISA akses sama sekali =====
    Route::middleware('role:admin,owner,kasir')->group(function () {
        Route::resource('sales', SaleController::class)->except(['edit', 'update']);
        Route::get('/sales/{sale}/receipt/pdf', [SaleController::class, 'receiptPdf'])->name('sales.receipt.pdf');
    });

    // ===== Laporan, Export, & Log Aktivitas: Admin & Owner saja =====
    Route::middleware('role:admin,owner')->group(function () {
        Route::get('/products/export/excel', [ProductController::class, 'export'])->name('products.export');
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/sales/pdf', [ReportController::class, 'exportPdf'])->name('reports.sales.pdf');
        Route::get('/reports/sales/excel', [ReportController::class, 'exportExcel'])->name('reports.sales.excel');
        Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');
    });

    // ===== Khusus Admin: Pengguna, Pengaturan, Backup & Restore =====
    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class);
        Route::get('/settings', [SettingController::class, 'edit'])->name('settings.edit');
        Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');

        Route::get('/backups', [BackupController::class, 'index'])->name('backups.index');
        Route::post('/backups', [BackupController::class, 'create'])->name('backups.create');
        Route::get('/backups/{filename}/download', [BackupController::class, 'download'])->name('backups.download');
        Route::delete('/backups/{filename}', [BackupController::class, 'destroy'])->name('backups.destroy');
        Route::post('/backups/restore', [BackupController::class, 'restore'])->name('backups.restore');
    });

});

require __DIR__.'/auth.php';