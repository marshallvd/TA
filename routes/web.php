<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\PegawaiController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\KomponenCoreValuesController;
use App\Http\Controllers\Web\KomponenKompetensiController;
use App\Http\Controllers\Web\KomponenKPIController;
use App\Http\Controllers\Web\PenilaianKinerjaController;
use App\Http\Controllers\Web\GajiController;
use App\Http\Controllers\Web\JenisCutiController;
use App\Http\Controllers\Web\CutiController; // Import CutiController
use App\Http\Controllers\Web\JatahCutiController; // Import JatahCutiController
use App\Http\Controllers\Web\CutiPribadiController; // Import CutiPribadiController

Route::middleware(['web'])->group(function () {
    // Redirect root to login
    Route::get('/', function () {
        return redirect()->route('login');
    });

    // Optional: Register routes if needed
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');

    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // Route untuk Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // Route untuk Pengajuan Cuti
    Route::prefix('cuti')->group(function () {
        Route::get('/', [CutiController::class, 'index'])->name('cuti.index');
        Route::get('/create', [CutiController::class, 'create'])->name('cuti.create');
        Route::post('/', [CutiController::class, 'store'])->name('cuti.store');
        Route::get('/{id}', [CutiController::class, 'show'])->name('cuti.show');
        Route::get('/{id}/edit', [CutiController::class, 'edit'])->name('cuti.edit');
        Route::put('/{id}', [CutiController::class, 'update'])->name('cuti.update');
        Route::delete('/{id}', [CutiController::class, 'destroy'])->name('cuti.destroy');
        Route::get('/{id}/view', [CutiController::class, 'view'])->name('cuti.view'); // Pindahkan ke dalam group
        Route::get('/cuti/kalender', [CutiController::class, 'kalender'])->name('cuti.kalender');

    });


    // Route Kepegawaian
    Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');
    Route::get('/pegawai/create', [PegawaiController::class, 'create'])->name('pegawai.create');
    Route::get('/pegawai/edit/{id}', [PegawaiController::class, 'edit'])->name('pegawai.edit');

    // Route Manajemen Users
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');

    // Route Manajemen Komponen Penilaian Kinerja
    Route::prefix('komponen-penilaian')->group(function () {
        // Manajemen Komponen KPI
        Route::get('/kpi', [KomponenKPIController::class, 'index'])->name('komponen-kpi.index');
        Route::get('/kpi/create', [KomponenKPIController::class, 'create'])->name('komponen-kpi.create');
        Route::get('/kpi/edit/{id}', [KomponenKPIController::class, 'edit'])->name('komponen-kpi.edit');

        // Manajemen Komponen Kompetensi
        Route::get('/kompetensi', [KomponenKompetensiController::class, 'index'])->name('komponen-kompetensi.index');
        Route::get('/kompetensi/create', [KomponenKompetensiController::class, 'create'])->name('komponen-kompetensi.create');
        Route::get('/kompetensi/edit/{id}', [KomponenKompetensiController::class, 'edit'])->name('komponen-kompetensi.edit');

        // Manajemen Komponen Core Values
        Route::get('/core-values', [KomponenCoreValuesController::class, 'index'])->name('komponen-core-values.index');
        Route::get('/core-values/create', [KomponenCoreValuesController::class, 'create'])->name('komponen-core-values.create');
        Route::get('/core-values/edit/{id}', [KomponenCoreValuesController::class, 'edit'])->name('komponen-core-values.edit');
    });

    // Route Manajemen Penilaian Kinerja
    Route::get('/penilaian_kinerja', [PenilaianKinerjaController::class, 'index'])->name('penilaian_kinerja.index');
    Route::get('/penilaian_kinerja/create/{id_pegawai}/{periode}', [PenilaianKinerjaController::class, 'create'])->name('penilaian_kinerja.create');
    Route::get('/penila ian_kinerja/edit/{id}', [PenilaianKinerjaController::class, 'edit'])->name('penilaian_kinerja.edit');

    // Route Manajemen Gaji
    Route::get('/gaji', [GajiController::class, 'index'])->name('gaji.index');
    Route::get('/gaji/create/{id_pegawai}/{periode}', [GajiController::class, 'create'])->name('gaji.create');
    Route::get('/gaji/edit/{id}', [GajiController::class, 'edit'])->name('gaji.edit');
    Route::get('/gaji/view/{id}', [GajiController::class, 'view'])->name('gaji.view');

// Rute untuk Jenis Cuti
Route::prefix('jenis_cuti')->group(function () {
    Route::get('/', [JenisCutiController::class, 'index'])->name('jenis_cuti.index');
    Route::get('/create', [JenisCutiController::class, 'create'])->name('jenis_cuti.create'); // Pastikan ini ada
    Route::post('/', [JenisCutiController::class, 'store'])->name('jenis_cuti.store');
    Route::get('/{id}/edit', [JenisCutiController::class, 'edit'])->name('jenis_cuti.edit');
    Route::put('/{id}', [JenisCutiController::class, 'update'])->name('jenis_cuti.update');
    Route::delete('/{id}', [JenisCutiController::class, 'destroy'])->name('jenis_cuti.destroy');
});
    Route::prefix('jatah_cuti')->group(function () {
        Route::get('/', [JatahCutiController::class, 'index'])->name('jatah_cuti.index'); // Menampilkan daftar jatah cuti
        Route::get('/create', [JatahCutiController::class, 'create'])->name('jatah_cuti.create'); // Ubah ini
        Route::post('/', [JatahCutiController::class, 'store'])->name('jatah_cuti.store'); // Menyimpan jatah cuti baru
        Route::get('/{id}/edit', [JatahCutiController::class, 'edit'])->name('jatah_cuti.edit'); // Menampilkan form untuk mengedit jatah cuti
        Route::put('/{id}', [JatahCutiController::class, 'update'])->name('jatah_cuti.update'); // Memperbarui jatah cuti
        Route::delete('/{id}', [JatahCutiController::class, 'destroy'])->name('jatah_cuti.destroy'); // Menghapus jatah cuti
        Route::get('/check-jatah-cuti/{id_pegawai}', [JatahCutiController::class, 'checkExisting']);

    });

    Route::prefix('cuti-pribadi')->group(function () {
        Route::get('/', [CutiPribadiController::class, 'index'])->name('cuti_pribadi.index'); // Menampilkan daftar cuti pribadi
        Route::get('/create', [CutiPribadiController::class, 'create'])->name('cuti_pribadi.create'); // Menampilkan form untuk membuat cuti pribadi
        Route::post('/', [CutiPribadiController::class, 'store'])->name('cuti_pribadi.store'); // Menyimpan cuti pribadi baru
        Route::get('/{id}/edit', [CutiPribadiController::class, 'edit'])->name('cuti_pribadi.edit'); // Menampilkan form untuk mengedit cuti pribadi
        Route::put('/{id}', [CutiPribadiController::class, 'update'])->name('cuti_pribadi.update'); // Memperbarui cuti pribadi
        Route::delete('/{id}', [CutiPribadiController::class, 'destroy'])->name('cuti_pribadi.destroy'); // Menghapus cuti pribadi
    });


});