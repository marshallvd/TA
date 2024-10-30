<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Update semua import controller dengan namespace Api
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PegawaiController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\DivisiController;
use App\Http\Controllers\Api\JabatanController;
use App\Http\Controllers\Api\RoleController;

use App\Http\Controllers\Api\KomponenKpiController;
use App\Http\Controllers\Api\KomponenKompetensiController;
use App\Http\Controllers\Api\KomponenCoreValuesController;

use App\Http\Controllers\Api\PenilaianKPIController;
use App\Http\Controllers\Api\PenilaianKompetensiController;
use App\Http\Controllers\Api\PenilaianCoreValuesController;
use App\Http\Controllers\Api\PenilaianKinerjaController;
use App\Http\Controllers\Api\GajiController;
use App\Http\Controllers\Api\CutiController;

use App\Http\Controllers\Api\AuthPelamarController;
use App\Http\Controllers\Api\LowonganController;
use App\Http\Controllers\Api\PelamarController;
use App\Http\Controllers\Api\LamaranController;
use App\Http\Controllers\Api\WawancaraController;
use App\Http\Controllers\Api\HasilSeleksiController;
use App\Http\Controllers\Api\AdminLamaranController;

Route::group([
    'prefix' => 'pelamar',
], function () {
    // Auth Pelamar
    Route::post('auth/register', [AuthPelamarController::class, 'register']);
    Route::post('auth/login', [AuthPelamarController::class, 'login']);
    Route::get('lowongan', [LowonganController::class, 'index']);
    Route::get('lowongan/{id}', [LowonganController::class, 'show']);
});

// Employee Auth Routes
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', [UserController::class, 'login']);
    Route::post('logout', [UserController::class, 'logout']);
    Route::post('refresh', [UserController::class, 'refresh']);
});

// Protected Routes with Role Middleware
Route::group(['middleware' => ['auth:api']], function () {
    
    // Admin & HRD Routes
    Route::group(['middleware' => ['role:admin,hrd']], function () {
        // Penilaian Management
        Route::apiResource('penilaian-kpi', PenilaianKPIController::class);
        Route::apiResource('penilaian-kompetensi', PenilaianKompetensiController::class);
        Route::apiResource('penilaian-core-values', PenilaianCoreValuesController::class);
        Route::apiResource('penilaian-kinerja', PenilaianKinerjaController::class);
        
        // HR Management
        Route::apiResource('gaji', GajiController::class);
        Route::apiResource('cuti', CutiController::class);
        Route::put('cuti/{cuti}/diterima', [CutiController::class, 'diterima']);
        Route::put('cuti/{cuti}/ditolak', [CutiController::class, 'ditolak']);
        
        // Route untuk melihat semua pelamar
        Route::get('/pelamar', [PelamarController::class, 'index']);
        Route::get('/pelamar/{id}', [PelamarController::class, 'show']);
        Route::put('/pelamar/{id}/status', [PelamarController::class, 'updateStatus']);
        
        // Route untuk manajemen lamaran
        // Admin routes untuk manajemen lamaran
        Route::get('admin/lamaran', [AdminLamaranController::class, 'index']);
        Route::get('admin/lamaran/{id}', [AdminLamaranController::class, 'show']);
        Route::put('admin/lamaran/{id}/status', [AdminLamaranController::class, 'updateStatus']);

        
        // Route untuk statistik
        Route::get('/pelamar/statistics', [PelamarController::class, 'statistics']);
        Route::get('/pelamar/export', [PelamarController::class, 'export']);

        // Recruitment Management
        Route::apiResource('wawancara', WawancaraController::class);
        Route::apiResource('hasil-seleksi', HasilSeleksiController::class);
        Route::apiResource('lowongan', LowonganController::class)->except(['index', 'show']);
    });
    
    // Admin Only Routes
    Route::group(['middleware' => ['role:admin']], function () {
        // Master Data Management
        Route::apiResource('users', UserController::class);
        Route::apiResource('divisi', DivisiController::class);
        Route::apiResource('jabatan', JabatanController::class);
        Route::apiResource('role', RoleController::class);
        Route::apiResource('pegawai', PegawaiController::class);
        
        // Performance Components
        Route::apiResource('komponen-kpi', KomponenKpiController::class);
        Route::apiResource('komponen-kompetensi', KomponenKompetensiController::class);
        Route::apiResource('komponen-core-values', KomponenCoreValuesController::class);

        Route::get('/dashboard/stats', [App\Http\Controllers\Api\DashboardController::class, 'getStats']);
        Route::get('/dashboard/chart-data', [App\Http\Controllers\Api\DashboardController::class, 'getChartData']);
    });
    
    // Pegawai Routes
    Route::group(['middleware' => ['role:pegawai']], function () {
        Route::get('gaji/my', [GajiController::class, 'myGaji']);
        Route::get('penilaian-kinerja/my', [PenilaianKinerjaController::class, 'myPenilaian']);
        Route::apiResource('cuti', CutiController::class)->only(['store', 'index', 'show']);
        Route::get('profile', [PegawaiController::class, 'profile']);
        Route::put('profile', [PegawaiController::class, 'updateProfile']);
    });
});

// Protected Pelamar Routes
Route::group([
    'middleware' => ['auth:pelamar'],
    'prefix' => 'pelamar',
], function () {
    Route::post('auth/logout', [AuthPelamarController::class, 'logout']);
    Route::get('auth/me', [AuthPelamarController::class, 'me']);
    Route::apiResource('profile', PelamarController::class)->only(['show', 'update']);

    Route::get('lamaran', [LamaranController::class, 'index']);
    Route::get('lamaran/{id}', [LamaranController::class, 'show']);
    Route::post('lamaran', [LamaranController::class, 'store']);
    Route::put('lamaran/{id}', [LamaranController::class, 'update']);
    Route::delete('lamaran/{id}', [LamaranController::class, 'destroy']);
    Route::put('lamaran/{id}/cancel', [LamaranController::class, 'cancel']);
    
    Route::get('wawancara/my', [WawancaraController::class, 'myWawancara']);
    Route::get('hasil-seleksi/my', [HasilSeleksiController::class, 'myHasil']);
});

// Fallback route
Route::fallback(function(){
    return response()->json([
        'message' => 'Route Not Found. Check kembali api.php'
    ], 404);
});