<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\TentangKamiController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang-kami', [TentangKamiController::class, 'index'])->name('tentang-kami');
Route::get('/informasi/{id}', [HomeController::class, 'showKonten'])->name('informasi.show');
Route::get('/kebaktian/{jenis?}', [HomeController::class, 'kebaktian'])->name('kebaktian');
Route::get('organisasi', [OrganisasiController::class, 'index'])->name('organisasi');
Route::get('/organisasi/{kategori}/anggota', [OrganisasiController::class, 'showAnggota'])->name('organisasi.anggota');
Route::prefix('pendaftaran')->group(function () {
    Route::get('/sidi', [PendaftaranController::class, 'sidi'])->name('pendaftaran.sidi');
    Route::post('/sidi', [PendaftaranController::class, 'storeSidi'])->name('pendaftaran.storeSidi');
    
    Route::get('/baptis', [PendaftaranController::class, 'baptis'])->name('pendaftaran.baptis');
    Route::post('/baptis', [PendaftaranController::class, 'storeBaptis'])->name('pendaftaran.storeBaptis');
    
    Route::get('/nikah', [PendaftaranController::class, 'nikah'])->name('pendaftaran.nikah');
    Route::post('/nikah', [PendaftaranController::class, 'storeNikah'])->name('pendaftaran.storeNikah');
});
