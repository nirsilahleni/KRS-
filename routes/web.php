<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ImpersonateController;
use App\Http\Controllers\Guest\LandingController;
use App\Http\Controllers\Guest\NewsController;

Auth::routes(
    [
        'verify' => true,
    ]
);

Route::get('/end-impersonation', [ImpersonateController::class, 'leaveImpersonation'])->name('leaveImpersonation');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/profil', [HomeController::class, 'profil'])->name('profil');
    Route::post('/profil', [HomeController::class, 'update'])->name('profil.update');
    // Route::post('/update-profile-picture', [ProfileController::class, 'updateProfilePicture'])->name('update-profile-picture');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    require_once __DIR__ . '/route/admin/setting.php';
    require_once __DIR__ . '/route/admin/usermanagement.php';
    require_once __DIR__ . '/route/admin/cms.php';
    require_once __DIR__ . '/route/admin/master.php';
    require_once __DIR__ . '/route/admin/monitoring.php';
    require_once __DIR__ . '/route/reference.php';
    require_once __DIR__ . '/route/asesmen.php';
    require_once __DIR__ . '/route/catin.php';
    // require_once __DIR__ . '/route/master.php';
    require_once __DIR__ . '/route/krs.php';
    // require_once __DIR__ . '/route/admin/kader.php';
});
require_once __DIR__ . '/route/simulasi.php';

Route::get('/berita', [NewsController::class, 'news'])->name('berita');
Route::get('/berita/kategori/{id}', [NewsController::class, 'kategori'])->name('kategori');
Route::get('/berita/detail/{id}', [NewsController::class, 'detail'])->name('detail');

Route::controller(LandingController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/chart', 'chart');
    Route::get('/unduh', 'unduh')->name('unduh');
    Route::get('/document/download/{document}', 'download')->name('document.download');
});
