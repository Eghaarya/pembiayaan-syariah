<?php

namespace App\Models\Murabahah\Limac;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MurabahahLimacCondition extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_pengajuan',
        'kode_nasabah',
        'nama_nasabah',

        'ketahanan_usaha_berdiri',
        'bidang_usaha_langka',
        'cakupan_wilayah_skala_usaha',

        'username',
        'kode_tempat',
    ];
}
