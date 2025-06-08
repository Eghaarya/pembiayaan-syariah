<?php

namespace App\Models\Nasabah;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NasabahProfil extends Model
{
    protected $table = 'nasabah_profil';

    protected $fillable = [
        'kode_nasabah',
        'nama_nasabah',
        'ttl_lahir_nasabah',
        'alamat_ktp_nasabah',
        'kota_ktp_nasabah',
        'kodepos_ktp_nasabah',
        'alamat_sekarang_nasabah',
        'kota_sekarang_nasabah',
        'kodepos_sekarang_nasabah',
        'no_ktp_nasabah',
        'berlaku_ktp_nasabah',
        'no_npwp_nasabah',
        'kepemilikan_rumah_nasabah',
        'lamamenetap_tahun_nasabah',
        'lamamenetap_bulan_nasabah',
        'notelp_rumah_nasabah',
        'notelp_hp_nasabah',
        'email_nasabah',
        'jenis_kelamin_nasabah',
        'status_kawin_nasabah',
        'pendidikan_terakhir_nasabah',
        'nama_ibu_nasabah',
        'nama_organisasi_nasabah',
        'jabatan_organisasi_nasabah',
        'lama_organisasi_nasabah',

        'nama_keluarga_nasabah',
        'hubungan_keluarga_nasabah',
        'alamat_keluarga_nasabah',
        'kota_keluarga_nasabah',
        'kodepos_keluarga_nasabah',
        'notelp_keluarga_nasabah',
        'pekerjaan_keluarga_nasabah',
        'alamatkantor_keluarga_nasabah',
        'notelpkantor_keluarga_nasabah',

        'nama_pasangan',
        'ttl_lahir_pasangan',
        'no_ktp_pasangan',
        'berlaku_ktp_pasangan',
        'jumlah_anak_pasangan',
        'no_npwp_pasangan',

        'punya_rekening_nasabah',
        'tahun_menjadi_nasabah',
        'jenis_layanan_nasabah',
        'mutasi_rekening_nasabah',

        'username',
        'kode_tempat',
    ];
}
