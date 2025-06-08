<?php

namespace App\Models\Murabahah\Limac;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MurabahahLimacCapacity extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_pengajuan',
        'kode_nasabah',
        'nama_nasabah',

        'tempatkerja_kelokasi_bank',
        'tempatkerja_kelokasi_agunan',
        'pembayaran_kolektif',
        'pembayaran_nonkolektif',

        'username',
        'kode_tempat',
    ];
}
