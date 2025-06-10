<?php

namespace App\Models\Multiguna\Dokumentasi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultigunaDokumentasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_pengajuan',
        'kode_nasabah',
        'nama_nasabah',

        'slip_gaji_nasabah',
        'rekening_gaji_nasabah',
        'tempat_kerja_usaha_nasabah',
        'foto_surat_pegawai_tetap_nasabah',
        'foto_tabungan_nasabah_3_bln_terakhir',
        'slip_gaji_pasangan',
        'rekening_gaji_pasangan',
        'tempat_kerja_usaha_pasangan',
        'foto_surat_pegawai_tetap_pasangan',
        'foto_tabungan_pasangan_3_bln_terakhir',

        'foto_depan_agunan',
        'foto_dalam_agunan',
        'foto_barat_agunan',
        'foto_utara_agunan',
        'foto_timur_agunan',
        'foto_selatan_agunan',
        'foto_jaminan_depan_kpm',
        'foto_jaminan_atas_kpm',
        'foto_jaminan_samping_kpm',
        'foto_jaminan_rangka_mesin_kpm',

        'username',
        'kode_tempat',
    ];
}
