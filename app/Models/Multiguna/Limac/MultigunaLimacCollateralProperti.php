<?php

namespace App\Models\Multiguna\Limac;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultigunaLimacCollateralProperti extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_pengajuan',
        'kode_nasabah',
        'nama_nasabah',

        'jenis_sertifikat_hak',
        'nomor_sertifikat',
        'tanggal_penerbitan',
        'instansi_yang_menerbitkan',
        'nama_pemegang_hak',
        'lama_tgl_akhir_hak_berlaku',
        'surat_ukur_nomor',
        'tanggal_ukur',
        'asal_agunan',
        'luas_agunan',
        'letak_agunan',
        'batas_utara_agunan',
        'batas_timur_agunan',
        'batas_selatan_agunan',
        'batas_barat_agunan',

        'lokasi_perumahan',
        'kenyamanan',
        'lokasi_agunan',
        'jarak_fasum_fasos',
        'fasilitas_perumahan',
        'jenis_jalan_lingkungan',
        'jarak_ke_jalan_provinsi',
        'jenis_dan_kondisi_jalan',
        'kondisi_jalan_ke_kota',
        'resiko_bencana_hidup',
        'kontribusi_pemohon_dp',
        'pertumbuhan_agunan',
        'kondisi_wilayah_agunan',

        'username',
        'kode_tempat',
    ];
}
