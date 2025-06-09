<?php

namespace App\Models\Multiguna\Limac;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultigunaLimacCapital extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_pengajuan',
        'kode_nasabah',
        'nama_nasabah',

        'jenis_akad',
        'jenis_pembiayaan',
        'tujuan_penggunaan',
        'harga_beli_bank',
        'jangka_waktu_pembiayaan',
        'margin_bank',

        'besarnya_urbun',

        'username',
        'kode_tempat',
    ];
}
