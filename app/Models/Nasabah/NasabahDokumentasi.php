<?php

namespace App\Models\Nasabah;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NasabahDokumentasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_nasabah',
        'nama_nasabah',

        'foto_nasabah',
        'foto_identitas_nasabah',
        'npwp_nasabah',
        'foto_pasangan',
        'foto_identitas_pasangan',
        'npwp_pasangan',

        'username',
        'kode_tempat',

    ];
}
