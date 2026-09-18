<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TamuController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\JenisKunjunganController;
use App\Http\Controllers\LandingController;

// Halaman utama langsung diarahkan ke login admin
Route::redirect('/', '/admin/login');

// Halaman pengunjung
Route::get('/buku-tamu', [TamuController::class, 'index']);
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
    Route::get('/admin/dilayani/{id}', [AdminController::class, 'dilayani']);
    Route::post('/admin/batalkan/{id}', [AdminController::class, 'batalkan']);

    Route::get('/admin/master-kunjungan', [JenisKunjunganController::class, 'index']);
    Route::post('/admin/master-kunjungan', [JenisKunjunganController::class, 'store']);
    Route::post('/admin/master-kunjungan/{id}', [JenisKunjunganController::class, 'update']);
    Route::get('/admin/master-kunjungan-hapus/{id}', [JenisKunjunganController::class, 'destroy']);
});

Route::get('/admin/laporan', [\App\Http\Controllers\LaporanController::class, 'index']);
Route::get('/admin/laporan/export-excel', [\App\Http\Controllers\LaporanController::class, 'exportExcel']);
Route::get('/admin/laporan/export-pdf', [\App\Http\Controllers\LaporanController::class, 'exportPdf']);

Route::get('/admin/pengaturan', [\App\Http\Controllers\PengaturanController::class, 'index']);
Route::post('/admin/pengaturan/username', [\App\Http\Controllers\PengaturanController::class, 'updateUsername']);
Route::post('/admin/pengaturan/password', [\App\Http\Controllers\PengaturanController::class, 'updatePassword']);
Route::get('/admin/pengaturan', [\App\Http\Controllers\PengaturanController::class, 'index']);
Route::post('/admin/pengaturan', [\App\Http\Controllers\PengaturanController::class, 'store']);
Route::post('/admin/pengaturan/{id}', [\App\Http\Controllers\PengaturanController::class, 'update']);
Route::get('/admin/pengaturan-hapus/{id}', [\App\Http\Controllers\PengaturanController::class, 'destroy']);