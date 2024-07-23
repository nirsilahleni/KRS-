<?php

use App\Http\Controllers\Monitoring\MonitoringIbuHamilController;
use App\Http\Controllers\Monitoring\MonitoringBalitaController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'monitoring', 'as' => 'monitoring.'], function () {
    Route::resource("ibu-hamil", MonitoringIbuHamilController::class);
    Route::post("balita/import", [MonitoringBalitaController::class, "import"])->name("balita.import");
    Route::resource("balita", MonitoringBalitaController::class)->parameter("balita","pendampingan");
});
