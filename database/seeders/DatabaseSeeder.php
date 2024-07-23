<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\AgamaSeeder;
use Database\Seeders\MenusSeeder;
use Database\Seeders\AccessSeeder;
use App\Models\Master\StatusHubungan;
use Database\Seeders\KecamatanSeeder;
use Database\Seeders\SumberAirSeeder;
use App\Models\payment\MidtransConfig;
use Database\Seeders\PermissionsSeeder;
use Database\Seeders\InterPretasiSeeder;
use Database\Seeders\StatusHubunganSeeder;
use Database\Seeders\StatusKeluargaSeeder;
use Database\Seeders\TempatBuangAirSeeder;
use Database\Seeders\JenisPendampinganSeeder;
use Database\Seeders\JenjangPendidikanSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            MenusSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            PermissionsSeeder::class,
            AccessSeeder::class,
            AgamaSeeder::class,
            InterPretasiSeeder::class,
            JenjangPendidikanSeeder::class,
            JenisPendampinganSeeder::class,
            StatusHubunganSeeder::class,
            SiteSettingSeeder::class,
            WilayahAdministrasiSeeder::class,
            StatusKeluargaSeeder::class,
            SumberAirSeeder::class,
            TempatBuangAirSeeder::class,
            PeriodeSeeder::class,
            FAQSeeder::class,
            TingkatKesejahteraanKeluargaSeeder::class,
            JenisKBSeeder::class,
            StandarDeviasiSeeder::class,
            // KepalaKeluargaSeeder::class,
        ]);
    }
}
