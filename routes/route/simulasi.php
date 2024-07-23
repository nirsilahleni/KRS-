<?php

use App\Http\Controllers\Simulasi\UjiController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=> 'simulasi', 'as' => 'simulasi.'], function () {
   Route::get('/periode', [UjiController::class, 'periode'])->name('periode');
   Route::get(('/wilayah-administrasi'), [UjiController::class, 'wilayahAdministrasi'])->name('wilayah-administrasi');
});
 ?>