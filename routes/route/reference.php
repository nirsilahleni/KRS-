<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReferenceController;

Route::group(['prefix' => 'reference', 'as' => 'reference.'], function () {
    Route::get('/user', [ReferenceController::class, 'user'])->name('user');
    Route::get('/icon', [ReferenceController::class, 'icon'])->name('icon');
    Route::get('/kategori_berita', [ReferenceController::class, 'kategori_berita'])->name('kategori_berita');
    Route::get('/kecamatan', [ReferenceController::class, 'kecamatan'])->name('kecamatan');
    Route::get('/kelurahan', [ReferenceController::class, 'kelurahan'])->name('kelurahan');
    Route::get('/kepala-keluarga', [ReferenceController::class, 'kepala_keluarga'])->name('kepala_keluarga');
    Route::get('/balita', [ReferenceController::class, 'balita'])->name('balita');
    Route::get('/user_id', [ReferenceController::class, 'user_id'])->name('user_id');
    Route::get('/email', [ReferenceController::class, 'email'])->name('email');
    Route::get('/nik', [ReferenceController::class, 'nik'])->name('nik');
    Route::get('/user_id', [ReferenceController::class, 'user_id'])->name('user_id');
    Route::get('/posyandu', [ReferenceController::class, 'posyandu'])->name('posyandu');
    Route::get('/email', [ReferenceController::class, 'email'])->name('email');
    Route::get('/nik', [ReferenceController::class, 'nik'])->name('nik');
    Route::get('/ibu_hamil', [ReferenceController::class, 'ibu_hamil'])->name('ibu_hamil');
    Route::get('/nomor_kia', [ReferenceController::class, 'nomor_kia'])->name('nomor_kia');
    Route::get('/kelurahan_posyandu', [ReferenceController::class, 'kelurahan_posyandu'])->name('kelurahan_posyandu');
    Route::get('/periode', [ReferenceController::class, 'periode'])->name('periode');
});
