<?php

namespace App\Models\Multiguna\Pengajuan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultigunaPengajuan extends Model
{
    use HasFactory;

    protected $table = 'multiguna_pengajuan';

    protected $fillable = [
        'kode_pengajuan',
        'kode_nasabah',
        'nama_nasabah',

        'tanggal_pengajuan',
        'total_character',
        'total_capacity',
        'total_capital',
        'total_collateral',
        'total_condition',
        'keputusan',

        'username',
        'kode_tempat',
    ];
}
