<?php

namespace App\Providers;

use App\Models\Master\JenjangPendidikan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class JenjangPendidikanServiceProvider extends ServiceProvider
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
        if (Schema::hasTable('ref_jenjang_pendidikan')) {
            $pendidikans = JenjangPendidikan::all();
            view()->share('pendidikans', $pendidikans);
        }
    }
}
