<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserAdminSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'username' => 'admin',
                'password' => Hash::make('admin123'),  // password di-hash untuk keamanan
                'tipe_akun' => 'admin',
                'kode_tempat' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
