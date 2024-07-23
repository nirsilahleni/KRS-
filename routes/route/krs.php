<?php

use App\Http\Controllers\Krs\BalitaController;
use App\Http\Controllers\Krs\DataKepalaKeluargaController;
use App\Http\Controllers\Krs\KepalaKeluargaAnggotaController;
use App\Http\Controllers\Krs\PendataanKrsController;
use App\Http\Controllers\Krs\RekapitulasiPendataanAnakController;
use App\Models\Krs\PendataanKrs;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'krs', 'as' => 'krs.'], function () {
    Route::resource('keluarga', DataKepalaKeluargaController::class);
    Route::resource('keluarga.anggota', KepalaKeluargaAnggotaController::class)->parameters([
        'keluarga' => 'keluarga',
        'anggota' => 'anggota'
    ]);
    Route::resource('balita', BalitaController::class)->parameter('balita', 'balita')->except(['create']);
    Route::group(["prefix" => "pendataan", "as" => "pendataan."], function () {
        Route::resource('pendataan-krs', PendataanKrsController::class)->parameters([
            'pendataan-krs' => 'pendataan_krs'
        ]);
        Route::get("rekapitulasi-data-anak",[RekapitulasiPendataanAnakController::class, 'index'])->name("rekapitulasi-pendataan-anak");
        Route::post('pendataan-krs/{pendataan_krs}/calculate', [PendataanKrsController::class, 'calculate'])->name("pendataan-krs.calculate-logic");
    });
});
