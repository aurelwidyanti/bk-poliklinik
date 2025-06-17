<?php

use App\Http\Controllers\Pasien\JanjiPeriksaCOntroller;
use App\Http\Controllers\Pasien\JanjiPeriksaController as PasienJanjiPeriksaController;
use App\Http\Controllers\Pasien\RiwayatPeriksaController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:pasien'])->prefix('pasien')->group(function () {
    Route::get('/dashboard', function () {
        return view('pasien.dashboard');
    })->name('pasien.dashboard');

    Route::prefix('janji-periksa')->name('pasien.janji-periksa.')->group(function(){
        Route::get('/', [JanjiPeriksaController::class, 'index'])->name('index');
        Route::post('/', [PasienJanjiPeriksaController::class, 'store'])->name('store');
    });

    Route::prefix('riwayat-periksa')->name('pasien.riwayat-periksa.')->group(function () {
        Route::get('/', [RiwayatPeriksaController::class, 'index'])->name('index');
        Route::get('/{id}/detail', [RiwayatPeriksaController::class, 'detail'])->name('detail');
        Route::get('/{id}/riwayat', [RiwayatPeriksaController::class, 'riwayat'])->name('riwayat');
    });
});