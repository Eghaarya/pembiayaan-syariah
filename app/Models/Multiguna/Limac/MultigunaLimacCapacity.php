<?php

namespace App\Models\Multiguna\Limac;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultigunaLimacCapacity extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_pengajuan',
        'kode_nasabah',
        'nama_nasabah',

        'memiliki_jabatan_rangkap',
        'publik_figur',
        'pemegang_jabatan_tertinggi',
        'bukan_pemegang_jabatan_tertinggi',
        'non_jabatan',
        'mendapat_rumah_dinas',
        'mendapat_mobil_dinas',
        'mendapat_sepeda_motor_dinas',
        'mendapat_fasilitas_pinjaman_uang',
        'belum_mendapat_fasilitas_dinas',

        'username',
        'kode_tempat',
    ];
}
