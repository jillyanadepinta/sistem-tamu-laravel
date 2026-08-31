<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TamuController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

// Halaman pengunjung
Route::get('/', [TamuController::class, 'index']);
Route::get('/form-tamu', [TamuController::class, 'form']);
Route::get('/foto-tamu', [TamuController::class, 'foto']);
Route::post('/kirim-tamu', [TamuController::class, 'simpan']);
Route::get('/sukses', [TamuController::class, 'sukses']);

// Login admin
Route::get('/admin/login', [AuthController::class, 'showLogin']);
Route::post('/admin/login', [AuthController::class, 'login']);
Route::get('/admin/logout', [AuthController::class, 'logout']);

// Halaman admin (wajib login)
Route::middleware('cek.admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
    Route::get('/admin/daftar-tamu', [AdminController::class, 'daftarTamu']);
    Route::get('/admin/ubah-status/{id}', [AdminController::class, 'ubahStatus']);
    Route::get('/admin/hapus-tamu/{id}', [AdminController::class, 'hapusTamu']);
});