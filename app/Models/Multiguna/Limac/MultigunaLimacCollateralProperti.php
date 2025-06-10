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

        'aksesibilitas_lokasi_agunan',
        'keterangan_lingkungan_agunan_tanah',
        'keterangan_lingkungan_agunan_kawasan',
        'penggunaan_agunan_saat_ini',
        'harga_sewa_per_tahun',
        'agunan_punya_akses_jalan_besar',
        'agunan_aktiva_warisan_belum_dibagi',

        'memiliki_imb',
        'tahun_pembuatan_bangunan',
        'perkiraan_biaya_pembangunan',
        'keterangan_konstruksi_bangunan',
        'luas_efektif',
        'jumlah_lantai',
        'pondasi',
        'lantai',
        'konstruksi',
        'dinding',
        'dinding_pemisah',
        'kusen',
        'pintu',
        'jendela_ventilasi',
        'plafond',
        'konstruksi_atap',
        'penutup_atap',
        'instalasi_air',
        'instalasi_listrik',
        'perawatan',
        'kondisi_sarana_dan_emplasemen',
        'informasi_lain_kondisi_bangunan',

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
