<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@arkatama.test',
            'email_verified_at' => now(),
            'password' => Hash::make('12345'),
            'remember_token' => Str::random(10),
        ]);

        $admin->assignRole('admin');


        // for ($i = 1; $i <= 10; $i++) {
            // $kader = User::create([
                // 'name' => 'kader ' . $i,
                // 'email' => 'kader' . $i . '@arkatama.test',
                // 'email_verified_at' => now(),
                // 'password' => Hash::make('12345'),
                // 'remember_token' => Str::random(10),
            // ]);
            // $kader->assignRole('kader');
        // }
    }
}
