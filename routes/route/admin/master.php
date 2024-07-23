<?php

use App\Http\Controllers\Master\AgamaController;
use App\Http\Controllers\Master\InterpretasiController;
use App\Http\Controllers\Master\KecamatanController;
use App\Http\Controllers\Master\KelurahanController;
use App\Http\Controllers\Master\JenjangPendidikanController;
use App\Http\Controllers\Master\KaderController;
use App\Http\Controllers\Master\PeriodeController;
use App\Http\Controllers\Master\PosyanduController;
use App\Http\Controllers\Master\StatusKeluargaController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'master', 'as' => 'master.'], function () {
    Route::resource('/interpretasi', InterpretasiController::class);
    Route::resource('/kecamatan', KecamatanController::class);
    Route::resource('/kelurahan', KelurahanController::class);
    Route::resource('/pendidikan', JenjangPendidikanController::class);
    Route::resource('/keluarga', StatusKeluargaController::class)->parameter("keluarga", "sk");
    Route::resource('/posyandu', PosyanduController::class)->names('posyandu');
    Route::resource('/kader', KaderController::class)->names('kader');
    Route::resource('/agama', AgamaController::class)->names('agama');
    Route::resource('/periode', PeriodeController::class)->names('periode')->except('create', 'show');
    Route::put('/periode/{periode}/activate', [PeriodeController::class, 'activate'])
        ->name('periode.activate');
});
