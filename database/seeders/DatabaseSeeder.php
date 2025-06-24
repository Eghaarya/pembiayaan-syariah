<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UserAdminSeeder;
use Database\Seeders\UserSiswaSeeder;
use Database\Seeders\UserPengajarSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(KodeTempatSeeder::class);
        $this->call(UserAdminSeeder::class);
        $this->call(UserPengajarSeeder::class);
        $this->call(UserSiswaSeeder::class);
    }
}
