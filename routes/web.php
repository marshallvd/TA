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
use App\Http\Controllers\Web\DivisiController; // Import 
use App\Http\Controllers\Web\JabatanController; // Import 
use App\Http\Controllers\Web\RoleController; // Import 
use App\Http\Controllers\Web\LowonganController; // Import 
use App\Http\Controllers\Web\LamaranController; // Import 
use App\Http\Controllers\Web\AdminLamaranController; // Import 
use App\Http\Controllers\Web\LandingPageController;
use App\Http\Controllers\Web\UserPelamarController;
use App\Http\Controllers\Web\WawancaraController;
use App\Http\Controllers\Web\HasilSeleksiController;
use App\Http\Controllers\Web\KomponenGajiController;
use App\Http\Controllers\Web\LaporanController;
use App\Http\Controllers\Web\ProfileController;

Route::middleware(['web'])->group(function () {
// Default route to landing page
Route::get('/', function () {
    return redirect()->route('landing.index');
});
// Route for Profile
Route::get('/profile/pegawai', [ProfileController::class, 'pegawai'])->name('profile.pegawai');
Route::get('/profile/pelamar', [ProfileController::class, 'pelamar'])->name('profile.pelamar');

// Route for Edit Profile
Route::get('/profile/pegawai/edit', [ProfileController::class, 'editpegawai'])->name('profile.pegawai.edit');
Route::get('/profile/pelamar/edit', [ProfileController::class, 'editpelamar'])->name('profile.pelamar.edit');

// Route for Edit User
Route::get('/profile/user/edit', [ProfileController::class, 'edituserpegawai'])->name('profile.user.edit');
Route::get('/profile/pelamar/password', [ProfileController::class, 'editpasswordpelamar'])->name('profile.pelamar.password');


    Route::prefix('landing')->group(function () {
        Route::get('/', [LandingPageController::class, 'index'])->name('landing.index');
        Route::get('/career', [LandingPageController::class, 'career'])->name('landing.career');
        Route::get('/tentang', [LandingPageController::class, 'about'])->name('landing.about'); // Tambahkan route ini

        // Pelamar Authentication Routes
        Route::get('/login', [LandingPageController::class, 'showLoginForm'])->name('pelamar.login');
        Route::get('/register', [LandingPageController::class, 'showRegistrationForm'])->name('pelamar.register');
    });

    // Optional: Register routes if needed
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');

    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // Route untuk Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    
    // Rute untuk halaman dashboard berdasarkan role
    Route::get('dashboard/admin', [DashboardController::class, 'admin'])->name('dashboard.admin');
    Route::get('dashboard/hrd', [DashboardController::class, 'hrd'])->name('dashboard.hrd');
    Route::get('dashboard/pegawai', [DashboardController::class, 'pegawai'])->name('dashboard.pegawai');

    Route::get('dashboard/pelamar', [DashboardController::class, 'pelamar'])->name('dashboard.pelamar');
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
        Route::get('/kpi', [KomponenKPIController::class, 'index'])->name('web.komponen-kpi.index');
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
    Route::get('/penilaian_kinerja/edit/{id}', [PenilaianKinerjaController::class, 'edit'])->name('penilaian_kinerja.edit');
    Route::get('/penilaian_kinerja/pribadi', [PenilaianKinerjaController::class, 'pribadi'])
    ->name('penilaian_kinerja.pribadi');
    Route::get('/penilaian_kinerja/view/{id}', [PenilaianKinerjaController::class, 'view'])->name('penilaian_kinerja.view');
    // Di routes/web.php
    Route::get('/penilaian-kinerja/setting', [PenilaianKinerjaController::class, 'setting'])->name('penilaian_kinerja.setting');

    // Route Manajemen Gaji
    Route::get('/gaji', [GajiController::class, 'index'])->name('gaji.index');
    Route::get('/gaji/create/{id_pegawai}/{periode}', [GajiController::class, 'create'])->name('gaji.create');
    Route::get('/gaji/edit/{id}', [GajiController::class, 'edit'])->name('gaji.edit');
    Route::get('/gaji/view/{id}', [GajiController::class, 'view'])->name('gaji.view');
    Route::get('/pribadi', [GajiController::class, 'pribadi'])->name('gaji.pribadi');

    Route::get('gaji/setting', [GajiController::class, 'setting'])->name('gaji.setting');

    Route::prefix('komponen-gaji')->group(function () {
        Route::get('/', [KomponenGajiController::class, 'index'])
            ->name('komponen_gaji.index');
        
        Route::get('/create', [KomponenGajiController::class, 'create'])
            ->name('komponen_gaji.create');
        
        Route::get('/{id}/edit', [KomponenGajiController::class, 'edit'])
            ->name('komponen_gaji.edit');
        
        // Route::post('/', [KomponenGajiController::class, 'store'])
        //     ->name('komponen_gaji.store');
        
        // Route::put('/{id}', [KomponenGajiController::class, 'update'])
        //     ->name('master_data.komponen_gaji.update');
        
        // Route::delete('/{id}', [KomponenGajiController::class, 'destroy'])
        //     ->name('master_data.komponen_gaji.destroy');
    });

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
        Route::get('/{id}/view', [CutiPribadiController::class, 'show'])->name('cuti_pribadi.view');
    });

    Route::prefix('master_data')->group(function () {
    // Rute untuk Divisi
        Route::prefix('divisi')->group(function () {
            Route::get('/', [DivisiController::class, 'index'])->name('master_data.divisi.index');
            Route::get('/create', [DivisiController::class, 'create'])->name('master_data.divisi.create');
            Route::post('/', [DivisiController::class, 'store'])->name('master_data.divisi.store');
            Route::get('/{id}/edit', [DivisiController::class, 'edit'])->name('master_data.divisi.edit');
            Route::put('/{id}', [DivisiController::class, 'update'])->name('master_data.divisi.update');
            Route::delete('/{id}', [DivisiController::class, 'destroy'])->name('master_data.divisi.destroy');
        });

        Route::prefix('jabatan')->group(function () {
            Route::get('/', [JabatanController::class, 'index'])->name('master_data.jabatan.index');
            Route::get('/create', [JabatanController::class, 'create'])->name('master_data.jabatan.create');
            Route::get('/{id}/edit', [JabatanController::class, 'edit'])->name('master_data.jabatan.edit');
        });

        // Route for Role
        Route::prefix('role')->group(function () {
            Route::get('/', [RoleController::class, 'index'])->name('master_data.role.index');
            Route::get('/create', [RoleController::class, 'create'])->name('master_data.role.create');
            Route::get('/{id}/edit', [RoleController::class, 'edit'])->name('master_data.role.edit');
        });



    });
    Route::prefix('rekrutmen')->group(function () {
        Route::prefix('lowongan')->group(function () {
            Route::get('/pelamar/{id}', [LowonganController::class, 'viewPelamar'])
            ->name('rekrutmen.lowongan.pelamar.view');
            Route::get('/', [LowonganController::class, 'index'])
                ->name('rekrutmen.lowongan.index');
            Route::get('/create', [LowonganController::class, 'create'])
                ->name('rekrutmen.lowongan.create');
            Route::get('/{id}/edit', [LowonganController::class, 'edit'])
                ->name('rekrutmen.lowongan.edit');
            Route::get('/pelamar', [LowonganController::class, 'pelamarIndex'])
                ->name('rekrutmen.lowongan.pelamar_index');
        });
        Route::prefix('lamaran')->group(function () {
            Route::get('/', [AdminLamaranController::class, 'index'])
                ->name('rekrutmen.lamaran.index');
            
            Route::get('/create', [AdminLamaranController::class, 'create'])
                ->name('rekrutmen.lamaran.create');
            
            Route::get('/{id}', [AdminLamaranController::class, 'show'])
                ->name('rekrutmen.lamaran.show');
            
            Route::put('/{id}/update-status', [AdminLamaranController::class, 'updateStatus'])
                ->name('rekrutmen.lamaran.update-status');
            Route::get('/rekrutmen/lamaran/{lamaran}/view', [AdminLamaranController::class, 'showView'])
                ->name('rekrutmen.lamaran.view');

            Route::get('/{id}/view', [AdminLamaranController::class, 'showView'])
                ->name('rekrutmen.lamaran.view');

            Route::get('/rekrutmen/lamaran/pribadi', [AdminLamaranController::class, 'pribadi'])->name('rekrutmen.lamaran.pribadi');

            Route::get('/pelamar/lamaran/{id}/view', [AdminLamaranController::class, 'showViewPelamar'])
            ->name('pelamar.lamaran.view');
        });
        Route::prefix('wawancara')->group(function () {
            Route::get('/', [WawancaraController::class, 'index'])
                ->name('rekrutmen.wawancara.index');
            
            Route::get('/create', [WawancaraController::class, 'create'])
                ->name('rekrutmen.wawancara.create');
            
            Route::get('/{id}/detail', [WawancaraController::class, 'show'])
                ->name('rekrutmen.wawancara.show');
            
            Route::get('/{id}/view', [WawancaraController::class, 'view'])
                ->name('rekrutmen.wawancara.view');

            Route::get('/{id}/edit', [WawancaraController::class, 'edit'])
                ->name('rekrutmen.wawancara.edit');
            Route::put('/{id}/update-status', [WawancaraController::class, 'updateStatus'])
                ->name('rekrutmen.wawancara.update-status');

            Route::get('/pribadi', [WawancaraController::class, 'pribadi'])
                ->name('rekrutmen.wawancara.pribadi');

            Route::get('/{id}/view-pelamar', [WawancaraController::class, 'viewPelamar'])
    ->name('pelamar.wawancara.view');
        });
        Route::get('hasil_seleksi/pribadi/{id}/view-pelamar', [HasilSeleksiController::class, 'viewPelamar'])
        ->name('pelamar.hasil_seleksi.view');
            Route::prefix('hasil_seleksi')->group(function () {

                Route::get('pribadi', [HasilSeleksiController::class, 'pribadi'])
                ->name('rekrutmen.hasil_seleksi.pribadi');
                // Route::get('/{id}/view-pelamar', [HasilSeleksiController::class, 'viewPelamar'])
                // ->name('pelamar.hasil_seleksi.view');
                Route::get('/', [HasilSeleksiController::class, 'index'])
                    ->name('rekrutmen.hasil_seleksi.index');
                
                Route::get('/create', [HasilSeleksiController::class, 'create'])
                    ->name('rekrutmen.hasil_seleksi.create');
                
                Route::post('/store', [HasilSeleksiController::class, 'store'])
                    ->name('rekrutmen.hasil_seleksi.store');
                
                Route::get('/{id}/edit', [HasilSeleksiController::class, 'edit'])
                    ->name('rekrutmen.hasil_seleksi.edit');


                Route::get('/{id}', [HasilSeleksiController::class, 'show'])
                    ->name('rekrutmen.hasil_seleksi.show');
                Route::get('/{id}/view', [HasilSeleksiController::class, 'view'])
                    ->name('rekrutmen.hasil_seleksi.view');

                    

                // Route::get('/rekrutmen/hasil_seleksi/pribadi', [HasilSeleksiController::class, 'pribadi'])
                //     ->name('rekrutmen.hasil_seleksi.pribadi');
            });

    });

    Route::prefix('laporan')->group(function () {
        Route::get('/pegawai', [LaporanController::class, 'indexPegawai'])
            ->name('laporan.pegawai.index');
    
        Route::get('/penggajian', [LaporanController::class, 'indexPenggajian'])
            ->name('laporan.penggajian.index');
    
        Route::get('/penilaian_kinerja', [LaporanController::class, 'indexPenilaianKinerja'])
            ->name('laporan.penilaian_kinerja.index');
    
        Route::get('/rekrutmen', [LaporanController::class, 'indexRekrutmen'])
            ->name('laporan.rekrutmen.index');
    
        Route::get('/cuti', [LaporanController::class, 'indexCuti'])
            ->name('laporan.cuti.index');
        Route::get('/rekrutmen', [LaporanController::class, 'indexRekrutmen'])
            ->name('laporan.rekrutmen.index');
    });
    



    Route::prefix('pelamar')->group(function () {
        Route::get('/', [UserPelamarController::class, 'index'])->name('pelamar.index'); // Daftar pelamar
        Route::get('/create', [UserPelamarController::class, 'create'])->name('pelamar.create'); // Form tambah pelamar
        Route::post('/', [UserPelamarController::class, 'store'])->name('pelamar.store'); // Simpan pelamar baru
        Route::get('/edit/{id}', [UserPelamarController::class, 'edit'])->name('pelamar.edit'); // Form edit pelamar
        Route::put('/{id}', [UserPelamarController::class, 'update'])->name('pelamar.update'); // Update pelamar
        Route::delete('/{id}', [UserPelamarController::class, 'destroy'])->name('pelamar.destroy'); // Hapus pelamar


        Route::get('/pelamar/{id}/edit', [UserPelamarController::class, 'edit'])
        ->name('pelamar.edit');

        
    });
});