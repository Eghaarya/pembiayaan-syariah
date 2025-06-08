<?php

namespace App\Models\Multiguna\Limac;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultigunaLimacCollateral extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_pengajuan',
        'kode_nasabah',
        'nama_nasabah',

        'sk_pengangkatan_pegawai_tetap',
        'sk_jabatan_terakhir_terkini',

        'username',
        'kode_tempat',
    ];
}
