<?php

namespace App\Providers;

use App\Models\Master\Agama;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AgamaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if (Schema::hasTable('ref_agama')) {
            $agamas = Agama::all();
            view()->share('agamas', $agamas);
        }   
    }
}
