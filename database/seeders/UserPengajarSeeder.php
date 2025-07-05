<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserPengajarSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'username' => 'pengajar',
                'password' => Hash::make('123'),  // password di-hash untuk keamanan
                'tipe_akun' => 'pengajar',
                'kode_tempat' => 'umsida',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
