<?php

namespace App\Providers;

use App\Models\Master\StatusHubungan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class StatusHubunganServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if (Schema::hasTable('ref_status_hubungan')) {
            $hubungans = StatusHubungan::all();
            view()->share('hubungans', $hubungans);
        }
    }
}
