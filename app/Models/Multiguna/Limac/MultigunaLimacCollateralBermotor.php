<?php

namespace App\Models\Multiguna\Limac;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultigunaLimacCollateralBermotor extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_pengajuan',
        'kode_nasabah',
        'nama_nasabah',

        'tujuan_penggunaan',
        'jenis_kendaraan',
        'status_agunan_kendaraan',
        'nomor_stnk_agunan',
        'nama_pemilik_agunan',
        'alamat_pemilik_agunan',
        'merk_agunan',
        'tipe_agunan',
        'bahan_bakar',
        'warna_agunan',
        'isi_silinder',
        'nomor_rangka_agunan',
        'nomor_mesin_agunan',
        'tahun_pembuatan',
        'masa_berlaku',

        'username',
        'kode_tempat',
    ];
}
