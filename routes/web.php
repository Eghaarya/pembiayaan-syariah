<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NasabahController;
use App\Http\Controllers\MultigunaLimacController;
use App\Http\Controllers\MurabahahLimacController;
use App\Http\Controllers\MultigunaPengajuanController;
use App\Http\Controllers\MurabahahPengajuanController;
use App\Http\Controllers\MultigunaDokumentasiController;
use App\Http\Controllers\MurabahahDokumentasiController;

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {

    // data nasabah
    Route::prefix('nasabah')->name('nasabah.')->group(function () {

        // Profil Nasabah
        Route::prefix('profil')->name('profil.')->group(function () {
            Route::get('/data', [NasabahController::class, 'indexNasabahProfil'])->name('data');
            Route::get('/tambah', [NasabahController::class, 'createNasabahProfil'])->name('tambah');
            Route::post('/tambah', [NasabahController::class, 'storeNasabahProfil'])->name('store');
            Route::get('/edit/{kode_nasabah}', [NasabahController::class, 'editNasabahProfil'])->name('edit');
            Route::put('/edit/{kode_nasabah}', [NasabahController::class, 'updateNasabahProfil'])->name('update');
            Route::delete('/hapus/{kode_nasabah}', [NasabahController::class, 'destroyNasabahProfil'])->name('hapus');
        });

        // Pekerjaan Nasabah
        Route::prefix('pekerjaan')->name('pekerjaan.')->group(function () {
            Route::get('/data', [NasabahController::class, 'indexNasabahPekerjaan'])->name('data');
            Route::get('/edit/{kode_nasabah}', [NasabahController::class, 'editNasabahPekerjaan'])->name('edit');
            Route::put('/edit/{kode_nasabah}', [NasabahController::class, 'updateNasabahPekerjaan'])->name('update');
        });
    });

    // 1. pembiayaan murabahah
    Route::prefix('murabahah')->name('murabahah.')->group(function () {
        // pengajuan murabahah
        Route::prefix('pengajuan')->name('pengajuan.')->group(function () {
            Route::get('/data', [MurabahahPengajuanController::class, 'indexPengajuan'])->name('data');
            Route::get('/tambah', [MurabahahPengajuanController::class, 'createPengajuan'])->name('tambah');
            Route::post('/tambah', [MurabahahPengajuanController::class, 'storePengajuan'])->name('store');
            Route::get('/edit/{kode_pengajuan}', [MurabahahPengajuanController::class, 'editPengajuan'])->name('edit');
            Route::put('/edit/{kode_pengajuan}', [MurabahahPengajuanController::class, 'updatePengajuan'])->name('update');
            Route::get('/angsuran/{kode_pengajuan}', [MurabahahPengajuanController::class, 'indexAngsuran'])->name('angsuran');
            Route::delete('/hapus/{kode_pengajuan}', [MurabahahPengajuanController::class, 'destroyPengajuan'])->name('hapus');
        });

        // limac murabahah
        Route::prefix('limac')->name('limac.')->group(function () {
            Route::prefix('character')->name('character.')->group(function () {
                Route::get('/data', [MurabahahLimacController::class, 'indexLimacCharacter'])->name('data');
                Route::get('/edit/{kode_pengajuan}', [MurabahahLimacController::class, 'editCharacter'])->name('edit');
                Route::put('/edit/{kode_pengajuan}', [MurabahahLimacController::class, 'updateCharacter'])->name('update');
            });
            Route::prefix('capacity')->name('capacity.')->group(function () {
                Route::get('/data', [MurabahahLimacController::class, 'indexLimacCapacity'])->name('data');
                Route::get('/edit/{kode_pengajuan}', [MurabahahLimacController::class, 'editCapacity'])->name('edit');
                Route::put('/edit/{kode_pengajuan}', [MurabahahLimacController::class, 'updateCapacity'])->name('update');
            });
            Route::prefix('capital')->name('capital.')->group(function () {
                Route::get('/data', [MurabahahLimacController::class, 'indexLimacCapital'])->name('data');
                Route::get('/edit/{kode_pengajuan}', [MurabahahLimacController::class, 'editCapital'])->name('edit');
                Route::put('/edit/{kode_pengajuan}', [MurabahahLimacController::class, 'updateCapital'])->name('update');
            });
            Route::prefix('collateralkpr')->name('collateralkpr.')->group(function () {
                Route::get('/data', [MurabahahLimacController::class, 'indexLimacCollateralKpr'])->name('data');
                Route::get('/edit/{kode_pengajuan}', [MurabahahLimacController::class, 'editCollateralKpr'])->name('edit');
                Route::put('/edit/{kode_pengajuan}', [MurabahahLimacController::class, 'updateCollateralKpr'])->name('update');
            });
            Route::prefix('collateralbermotor')->name('collateralbermotor.')->group(function () {
                Route::get('/data', [MurabahahLimacController::class, 'indexLimacCollateralBermotor'])->name('data');
                Route::get('/edit/{kode_pengajuan}', [MurabahahLimacController::class, 'editCollateralBermotor'])->name('edit');
                Route::put('/edit/{kode_pengajuan}', [MurabahahLimacController::class, 'updateCollateralBermotor'])->name('update');
            });
            Route::prefix('condition')->name('condition.')->group(function () {
                Route::get('/data', [MurabahahLimacController::class, 'indexLimacCondition'])->name('data');
                Route::get('/edit/{kode_pengajuan}', [MurabahahLimacController::class, 'editCondition'])->name('edit');
                Route::put('/edit/{kode_pengajuan}', [MurabahahLimacController::class, 'updateCondition'])->name('update');
            });
        });

        // Dokumen Murabahah
        Route::prefix('dokumentasi')->name('dokumentasi.')->group(function () {
            Route::get('/data', [MurabahahDokumentasiController::class, 'indexDokumentasi'])->name('data');
            Route::get('/upload/{kode_nasabah}', [MurabahahDokumentasiController::class, 'uploadDokumentasi'])->name('upload');
            Route::put('/upload/{kode_nasabah}', [MurabahahDokumentasiController::class, 'updateDokumentasi'])->name('update');
        });

        // Cetak Murabahah
        Route::prefix('cetak')->name('cetak.')->group(function () {
            Route::get('/data', [MurabahahPengajuanController::class, 'indexCetak'])->name('data');
            Route::get('/laporan_hasil/{kode_pengajuan}', [MurabahahPengajuanController::class, 'cetakLaporanHasil'])->name('laporan_hasil');
            Route::get('/surat_persetujuan/{kode_pengajuan}', [MurabahahPengajuanController::class, 'cetakSuratPersetujuan'])->name('surat_persetujuan');
            Route::get('/dokumen_akad/{kode_pengajuan}', [MurabahahPengajuanController::class, 'cetakDokumenAkad'])->name('dokumen_akad');
            Route::get('/surat_pencairan/{kode_pengajuan}', [MurabahahPengajuanController::class, 'cetakSuratPencairan'])->name('surat_pencairan');
        });
    });

    // 2. Pembiayaan Multiguna
    Route::prefix('multiguna')->name('multiguna.')->group(function () {
        // pengajuan multiguna
        Route::prefix('pengajuan')->name('pengajuan.')->group(function () {
            Route::get('/data', [MultigunaPengajuanController::class, 'indexPengajuan'])->name('data');
            Route::get('/tambah', [MultigunaPengajuanController::class, 'createPengajuan'])->name('tambah');
            Route::post('/tambah', [MultigunaPengajuanController::class, 'storePengajuan'])->name('store');
            Route::get('/edit/{kode_pengajuan}', [MultigunaPengajuanController::class, 'editPengajuan'])->name('edit');
            Route::put('/edit/{kode_pengajuan}', [MultigunaPengajuanController::class, 'updatePengajuan'])->name('update');
            Route::get('/angsuran/{kode_pengajuan}', [MultigunaPengajuanController::class, 'indexAngsuran'])->name('angsuran');
            Route::delete('/hapus/{kode_pengajuan}', [MultigunaPengajuanController::class, 'destroyPengajuan'])->name('hapus');
        });

        // limac multiguna
        Route::prefix('limac')->name('limac.')->group(function () {
            Route::prefix('character')->name('character.')->group(function () {
                Route::get('/data', [MultigunaLimacController::class, 'indexLimacCharacter'])->name('data');
                Route::get('/edit/{kode_pengajuan}', [MultigunaLimacController::class, 'editCharacter'])->name('edit');
                Route::put('/edit/{kode_pengajuan}', [MultigunaLimacController::class, 'updateCharacter'])->name('update');
            });
            Route::prefix('capacity')->name('capacity.')->group(function () {
                Route::get('/data', [MultigunaLimacController::class, 'indexLimacCapacity'])->name('data');
                Route::get('/edit/{kode_pengajuan}', [MultigunaLimacController::class, 'editCapacity'])->name('edit');
                Route::put('/edit/{kode_pengajuan}', [MultigunaLimacController::class, 'updateCapacity'])->name('update');
            });
            Route::prefix('capital')->name('capital.')->group(function () {
                Route::get('/data', [MultigunaLimacController::class, 'indexLimacCapital'])->name('data');
                Route::get('/edit/{kode_pengajuan}', [MultigunaLimacController::class, 'editCapital'])->name('edit');
                Route::put('/edit/{kode_pengajuan}', [MultigunaLimacController::class, 'updateCapital'])->name('update');
            });
            Route::prefix('collateralsk')->name('collateralsk.')->group(function () {
                Route::get('/data', [MultigunaLimacController::class, 'indexLimacCollateralsk'])->name('data');
                Route::get('/edit/{kode_pengajuan}', [MultigunaLimacController::class, 'editCollateralSk'])->name('edit');
                Route::put('/edit/{kode_pengajuan}', [MultigunaLimacController::class, 'updateCollateralSk'])->name('update');
            });
            Route::prefix('collateralproperti')->name('collateralproperti.')->group(function () {
                Route::get('/data', [MultigunaLimacController::class, 'indexLimacCollateralProperti'])->name('data');
                Route::get('/edit/{kode_pengajuan}', [MultigunaLimacController::class, 'editCollateralProperti'])->name('edit');
                Route::put('/edit/{kode_pengajuan}', [MultigunaLimacController::class, 'updateCollateralProperti'])->name('update');
            });
            Route::prefix('collateralbermotor')->name('collateralbermotor.')->group(function () {
                Route::get('/data', [MultigunaLimacController::class, 'indexLimacCollateralBermotor'])->name('data');
                Route::get('/edit/{kode_pengajuan}', [MultigunaLimacController::class, 'editCollateralBermotor'])->name('edit');
                Route::put('/edit/{kode_pengajuan}', [MultigunaLimacController::class, 'updateCollateralBermotor'])->name('update');
            });
            Route::prefix('condition')->name('condition.')->group(function () {
                Route::get('/data', [MultigunaLimacController::class, 'indexLimacCondition'])->name('data');
                Route::get('/edit/{kode_pengajuan}', [MultigunaLimacController::class, 'editCondition'])->name('edit');
                Route::put('/edit/{kode_pengajuan}', [MultigunaLimacController::class, 'updateCondition'])->name('update');
            });
        });

        // Dokumen Multiguna
        Route::prefix('dokumentasi')->name('dokumentasi.')->group(function () {
            Route::get('/data', [MultigunaDokumentasiController::class, 'indexDokumentasi'])->name('data');
            Route::get('/upload/{kode_nasabah}', [MultigunaDokumentasiController::class, 'uploadDokumentasi'])->name('upload');
            Route::put('/upload/{kode_nasabah}', [MultigunaDokumentasiController::class, 'updateDokumentasi'])->name('update');
        });

        // Cetak Multiguna
        Route::prefix('cetak')->name('cetak.')->group(function () {
            Route::get('/data', [MultigunaPengajuanController::class, 'indexCetak'])->name('data');
            Route::get('/laporan_hasil/{kode_pengajuan}', [MultigunaPengajuanController::class, 'cetakLaporanHasil'])->name('laporan_hasil');
            Route::get('/surat_persetujuan/{kode_pengajuan}', [MultigunaPengajuanController::class, 'cetakSuratPersetujuan'])->name('surat_persetujuan');
            Route::get('/dokumen_akad/{kode_pengajuan}', [MultigunaPengajuanController::class, 'cetakDokumenAkad'])->name('dokumen_akad');
            Route::get('/surat_pencairan/{kode_pengajuan}', [MultigunaPengajuanController::class, 'cetakSuratPencairan'])->name('surat_pencairan');
        });
    });

    // admin
    Route::prefix('admin/akun')->name('admin.akun.')->group(function () {
        Route::get('/data', [AdminController::class, 'indexAkun'])->name('data');
        Route::get('/tambah', [AdminController::class, 'createAkun'])->name('tambah');
        Route::post('/tambah', [AdminController::class, 'storeAkun'])->name('store');
        Route::get('/edit/{username}', [AdminController::class, 'editAkun'])->name('edit');
        Route::put('/edit/{username}', [AdminController::class, 'updateAkun'])->name('update');
        Route::delete('/hapus/{username}', [AdminController::class, 'destroyAkun'])->name('hapus');
    });
    Route::prefix('admin/tempat')->name('admin.tempat.')->group(function () {
        Route::get('/data', [AdminController::class, 'indexTempat'])->name('data');
        Route::get('/tambah', [AdminController::class, 'createTempat'])->name('tambah');
        Route::post('/tambah', [AdminController::class, 'storeTempat'])->name('store');
        Route::get('/edit/{kode_tempat}', [AdminController::class, 'editTempat'])->name('edit');
        Route::put('/edit/{kode_tempat}', [AdminController::class, 'updateTempat'])->name('update');
        Route::delete('/hapus/{kode_tempat}', [AdminController::class, 'destroyTempat'])->name('hapus');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
