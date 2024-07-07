<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\DirekturController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', [LoginController::class, 'index']);
    Route::post('/login', [LoginController::class, 'login'])->name('login');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::middleware('is_karyawan')->group(function () {
        Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan.index');
        Route::get('/request', [KaryawanController::class, 'request'])->name('karyawan.request');
        Route::post('/request/store', [KaryawanController::class, 'storeRequest'])->name('karyawan.storeRequest');
        Route::get('/request/cetak/{id}', [KaryawanController::class, 'cetakRequest'])->name('karyawan.cetakRequest');
    });

    Route::middleware('is_admin')->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/admin/tolak/{id}', [AdminController::class, 'tolak'])->name('admin.tolak');
        Route::get('/admin/setuju/{id}', [AdminController::class, 'setuju'])->name('admin.setuju');
    });

    Route::middleware('is_direktur')->group(function () {
        Route::get('/direktur', [DirekturController::class, 'index'])->name('direktur.index');
        Route::get('/direktur/tolak/{id}', [DirekturController::class, 'tolak'])->name('direktur.tolak');
        Route::get('/direktur/setuju/{id}', [DirekturController::class, 'setuju'])->name('direktur.setuju');
        Route::post('/direktur/export', [DirekturController::class, 'export'])->name('direktur.export');
    });
});
