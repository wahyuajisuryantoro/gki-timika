<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\TentangKamiController;
use App\Http\Controllers\UserDashboard\AuthController;
use App\Http\Controllers\UserDashboard\DashboardController;
use App\Http\Controllers\UserDashboard\InformasiController;
use App\Http\Controllers\UserDashboard\KeluargaController;
use App\Http\Controllers\UserDashboard\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang-kami', [TentangKamiController::class, 'index'])->name('tentang-kami');
Route::get('/informasi/{id}', [HomeController::class, 'showKonten'])->name('informasi.show');
Route::get('/kebaktian/{jenis?}', [HomeController::class, 'kebaktian'])->name('kebaktian');
Route::get('organisasi', [OrganisasiController::class, 'index'])->name('organisasi');
Route::get('/organisasi/{kategori}/anggota', [OrganisasiController::class, 'showAnggota'])->name('organisasi.anggota');
Route::get('/login/jemaat', [AuthController::class, 'loginUser'])->name('login.jemaat');
Route::post('/authenticate-jemaat', [AuthController::class, 'authenticateUser'])->name('authenticate.jemaat');
Route::prefix('pendaftaran')->group(function () {
    Route::get('/sidi', [PendaftaranController::class, 'sidi'])->name('pendaftaran.sidi');
    Route::post('/sidi', [PendaftaranController::class, 'storeSidi'])->name('pendaftaran.storeSidi');

    Route::get('/baptis', [PendaftaranController::class, 'baptis'])->name('pendaftaran.baptis');
    Route::post('/baptis', [PendaftaranController::class, 'storeBaptis'])->name('pendaftaran.storeBaptis');

    Route::get('/nikah', [PendaftaranController::class, 'nikah'])->name('pendaftaran.nikah');
    Route::post('/nikah', [PendaftaranController::class, 'storeNikah'])->name('pendaftaran.storeNikah');
    Route::get('/jemaat-list', [PendaftaranController::class, 'getJemaatList'])->name('pendaftaran.getJemaatList');
});

Route::middleware(['auth.jemaat'])->group(function () {
    Route::get('/dashboard/jemaat', [DashboardController::class, 'index'])->name('dashboard.jemaat');
    Route::prefix('dashboard/informasi')->group(function(){
        Route::get('/sidi', [InformasiController::class, 'informasiSidi'])->name('informasi.sidi');
        Route::get('/baptis', [InformasiController::class, 'informasiBaptis'])->name('informasi.baptis');
        Route::get('/nikah', [InformasiController::class, 'informasiNikah'])->name('informasi.nikah');
    });
    Route::get('/dashboard/keluarga', [KeluargaController::class, 'index'])->name('dashboard.keluarga');
    Route::get('/dashboard/profile', [ProfileController::class, 'index'])->name('dashboard.profile');
    Route::post('/dashboard/logout', [AuthController::class, 'logoutUser'])->name('logout.user');
});
