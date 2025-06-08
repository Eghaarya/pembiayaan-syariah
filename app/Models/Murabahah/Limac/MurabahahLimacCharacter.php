<?php

namespace App\Models\Murabahah\Limac;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MurabahahLimacCharacter extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_pengajuan',
        'kode_nasabah',
        'nama_nasabah',

        // Nasabah
        'noid_checking1_nasabah',
        'fasilitas_pinjaman1_nasabah',
        'bank_pelapor1_nasabah',
        'plafond_pinjaman1_nasabah',
        'outstanding_pinjaman1_nasabah',
        'tanggal_realisasi1_nasabah',
        'tanggal_jatuh_tempo1_nasabah',
        'kolektabilitas1_nasabah',
        'keterangan1_nasabah',

        'noid_checking2_nasabah',
        'fasilitas_pinjaman2_nasabah',
        'bank_pelapor2_nasabah',
        'plafond_pinjaman2_nasabah',
        'outstanding_pinjaman2_nasabah',
        'tanggal_realisasi2_nasabah',
        'tanggal_jatuh_tempo2_nasabah',
        'kolektabilitas2_nasabah',
        'keterangan2_nasabah',

        'noid_checking3_nasabah',
        'fasilitas_pinjaman3_nasabah',
        'bank_pelapor3_nasabah',
        'plafond_pinjaman3_nasabah',
        'outstanding_pinjaman3_nasabah',
        'tanggal_realisasi3_nasabah',
        'tanggal_jatuh_tempo3_nasabah',
        'kolektabilitas3_nasabah',
        'keterangan3_nasabah',

        'noid_checking4_nasabah',
        'fasilitas_pinjaman4_nasabah',
        'bank_pelapor4_nasabah',
        'plafond_pinjaman4_nasabah',
        'outstanding_pinjaman4_nasabah',
        'tanggal_realisasi4_nasabah',
        'tanggal_jatuh_tempo4_nasabah',
        'kolektabilitas4_nasabah',
        'keterangan4_nasabah',

        'noid_checking5_nasabah',
        'fasilitas_pinjaman5_nasabah',
        'bank_pelapor5_nasabah',
        'plafond_pinjaman5_nasabah',
        'outstanding_pinjaman5_nasabah',
        'tanggal_realisasi5_nasabah',
        'tanggal_jatuh_tempo5_nasabah',
        'kolektabilitas5_nasabah',
        'keterangan5_nasabah',

        'noid_checking6_nasabah',
        'fasilitas_pinjaman6_nasabah',
        'bank_pelapor6_nasabah',
        'plafond_pinjaman6_nasabah',
        'outstanding_pinjaman6_nasabah',
        'tanggal_realisasi6_nasabah',
        'tanggal_jatuh_tempo6_nasabah',
        'kolektabilitas6_nasabah',
        'keterangan6_nasabah',

        // Pasangan
        'noid_checking1_pasangan',
        'fasilitas_pinjaman1_pasangan',
        'bank_pelapor1_pasangan',
        'plafond_pinjaman1_pasangan',
        'outstanding_pinjaman1_pasangan',
        'tanggal_realisasi1_pasangan',
        'tanggal_jatuh_tempo1_pasangan',
        'kolektabilitas1_pasangan',
        'keterangan1_pasangan',

        'noid_checking2_pasangan',
        'fasilitas_pinjaman2_pasangan',
        'bank_pelapor2_pasangan',
        'plafond_pinjaman2_pasangan',
        'outstanding_pinjaman2_pasangan',
        'tanggal_realisasi2_pasangan',
        'tanggal_jatuh_tempo2_pasangan',
        'kolektabilitas2_pasangan',
        'keterangan2_pasangan',

        'noid_checking3_pasangan',
        'fasilitas_pinjaman3_pasangan',
        'bank_pelapor3_pasangan',
        'plafond_pinjaman3_pasangan',
        'outstanding_pinjaman3_pasangan',
        'tanggal_realisasi3_pasangan',
        'tanggal_jatuh_tempo3_pasangan',
        'kolektabilitas3_pasangan',
        'keterangan3_pasangan',

        'noid_checking4_pasangan',
        'fasilitas_pinjaman4_pasangan',
        'bank_pelapor4_pasangan',
        'plafond_pinjaman4_pasangan',
        'outstanding_pinjaman4_pasangan',
        'tanggal_realisasi4_pasangan',
        'tanggal_jatuh_tempo4_pasangan',
        'kolektabilitas4_pasangan',
        'keterangan4_pasangan',

        'noid_checking5_pasangan',
        'fasilitas_pinjaman5_pasangan',
        'bank_pelapor5_pasangan',
        'plafond_pinjaman5_pasangan',
        'outstanding_pinjaman5_pasangan',
        'tanggal_realisasi5_pasangan',
        'tanggal_jatuh_tempo5_pasangan',
        'kolektabilitas5_pasangan',
        'keterangan5_pasangan',

        'noid_checking6_pasangan',
        'fasilitas_pinjaman6_pasangan',
        'bank_pelapor6_pasangan',
        'plafond_pinjaman6_pasangan',
        'outstanding_pinjaman6_pasangan',
        'tanggal_realisasi6_pasangan',
        'tanggal_jatuh_tempo6_pasangan',
        'kolektabilitas6_pasangan',
        'keterangan6_pasangan',

        'username',
        'kode_tempat',
    ];
}
