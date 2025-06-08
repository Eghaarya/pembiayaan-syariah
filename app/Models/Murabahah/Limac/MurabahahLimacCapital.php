<?php

namespace App\Models\Murabahah\Limac;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MurabahahLimacCapital extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_pengajuan',
        'kode_nasabah',
        'nama_nasabah',

        'jenis_akad',
        'tujuan_penggunaan',
        'harga_jual_barang',
        'urbun_uangmuka',
        'harga_beli_bank',
        'jangka_waktu_pembiayaan',
        'margin_bank',

        'besarnya_urbun',

        'username',
        'kode_tempat',
    ];
}
