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
use App\Http\Controllers\Api\JenisCutiController;

use App\Http\Controllers\Api\AuthPelamarController;
use App\Http\Controllers\Api\LowonganController;
use App\Http\Controllers\Api\PelamarController;
use App\Http\Controllers\Api\LamaranController;
use App\Http\Controllers\Api\WawancaraController;
use App\Http\Controllers\Api\HasilSeleksiController;
use App\Http\Controllers\Api\AdminLamaranController;
use App\Http\Controllers\Api\JatahCutiController;

// Route::middleware(['cache.response'])->group(function () {

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


    Route::get('jatah-cuti', [JatahCutiController::class, 'index']);
    Route::get('jatah-cuti/{id}', [JatahCutiController::class, 'show']);
    Route::post('jatah-cuti', [JatahCutiController::class, 'store']);
    Route::put('jatah-cuti/{id}', [JatahCutiController::class, 'update']);
    Route::delete('jatah-cuti/{id}', [JatahCutiController::class, 'destroy']);
                
        Route::get('auth/me', [UserController::class, 'userProfile']);
        Route::put('cuti/{id}', [CutiController::class, 'update']);


        // Admin & HRD Routes
        Route::group(['middleware' => ['role:admin,hrd']], function () {
            // Penilaian Management
            Route::apiResource('penilaian-kpi', PenilaianKPIController::class);
            Route::apiResource('penilaian-kompetensi', PenilaianKompetensiController::class);
            Route::apiResource('penilaian-core-values', PenilaianCoreValuesController::class);
            Route::apiResource('penilaian-kinerja', PenilaianKinerjaController::class);
            
            // Update details routes
            Route::put('penilaian-kpi/{id}/update-details', [PenilaianKPIController::class, 'update']);
            Route::put('penilaian-kompetensi/{id}/update-details', [PenilaianKompetensiController::class, 'update']);
            Route::put('penilaian-core-values/{id}/update-details', [PenilaianCoreValuesController::class, 'update']);
            Route::put('penilaian-kinerja/{id}', [PenilaianKinerjaController::class, 'update']);
            Route::get('penilaian-kinerja/pegawai/{id}', [PenilaianKinerjaController::class, 'show']);
            Route::get('penilaian-kinerja/pegawai/{id}/tahun/{tahun}/bulan/{bulan}', [PenilaianKinerjaController::class, 'getPenilaianByPegawaiAndPeriod']);
            Route::get('/penilaian-kinerja', [PenilaianKinerjaController::class, 'getPenilaianKinerja']);

            // HR Management
            Route::apiResource('gaji', GajiController::class);
            Route::get('pegawai/gaji-status', [GajiController::class, 'getGajiStatus']);
            Route::put('/update-gaji/{id}', [GajiController::class, 'update']);


            // Route untuk melihat semua pelamar
            Route::get('/pelamar', [PelamarController::class, 'index']);
            Route::get('/pelamar/{id}', [PelamarController::class, 'show']);
            Route::put('/pelamar/{id}/status', [PelamarController::class, 'updateStatus']);

            // Route untuk statistik
            Route::get('/pelamar/statistics', [PelamarController::class, 'statistics']);
            Route::get('/pelamar/export', [PelamarController::class, 'export']);

            // Recruitment Management
            Route::apiResource('wawancara', WawancaraController::class);
            Route::apiResource('hasil-seleksi', HasilSeleksiController::class);
            Route::apiResource('lowongan', LowonganController::class)->except(['index', 'show']);

            Route::get('cuti/all', [CutiController::class, 'index']); // endpoint khusus admin untuk lihat semua cuti
            Route::put('cuti/{id}/diterima', [CutiController::class, 'diterima']);
            Route::put('cuti/{id}/ditolak', [CutiController::class, 'ditolak']);
            Route::put('cuti/{id}', [CutiController::class, 'update']); // Tambahkan baris ini
            Route::get('check-jatah-cuti/{id_pegawai}', [JatahCutiController::class, 'checkJatahCuti']);

            Route::get('jatah-cuti/check-jatah-cuti/{idPegawai}', [JatahCutiController::class, 'checkJatahCuti']);

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
            Route::apiResource('jenis-cuti', JenisCutiController::class);




            Route::get('/dashboard/stats', [App\Http\Controllers\Api\DashboardController::class, 'getStats']);
            Route::get('/dashboard/chart-data', [App\Http\Controllers\Api\DashboardController::class, 'getChartData']);
        });

        // Pegawai Routes
        Route::group(['middleware' => ['role:pegawai']], function () {
            Route::get('gaji/my', [GajiController::class, 'myGaji']);
            Route::get('penilaian-kinerja/my', [PenilaianKinerjaController::class, 'myPenilaian']);
            // Route::apiResource('cuti', CutiController::class)->only(['store', 'index', 'show']);\


            Route::get('profile', [PegawaiController::class, 'profile']);
            Route::put('profile', [PegawaiController::class, 'updateProfile']);
        });

        // Route yang bisa diakses pegawai (dan admin)
        Route::group(['middleware' => ['role:admin,pegawai']], function () {
            Route::get('cuti', [CutiController::class, 'index']); // untuk lihat cuti sendiri
            Route::post('cuti', [CutiController::class, 'store']);
            Route::get('cuti/{id}', [CutiController::class, 'show']);
            Route::delete('/cuti/{id}', [CutiController::class, 'destroy']);
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

    Route::get('/health-check', function() {
        return response()->json(['status' => 'ok']);
    });

    // Fallback route
    Route::fallback(function(){
        return response()->json([
            'message' => 'Route Not Found. Check kembali api.php'
        ], 404);
    });

// });