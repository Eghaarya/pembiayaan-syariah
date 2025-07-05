<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KodeTempatSeeder extends Seeder
{
    public function run()
    {
        DB::table('tempats')->insert([
            [
                'kode_tempat' => 'umsida',
                'nama_tempat' => 'Universitas Muhammadiyah Sidoarjo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
