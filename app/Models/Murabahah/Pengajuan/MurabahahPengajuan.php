<?php

namespace App\Models\Murabahah\Pengajuan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MurabahahPengajuan extends Model
{
    protected $table = 'murabahah_pengajuan';

    protected $fillable = [
        'kode_pengajuan',
        'kode_nasabah',
        'nama_nasabah',

        'tanggal_pengajuan',
        'total_character',
        'total_capacity',
        'total_capital',
        'total_collateral_kpr',
        'total_collateral_bermotor',
        'total_condition',
        'keputusan',

        'username',
        'kode_tempat',
    ];
}
