<?php

namespace App\Models\Multiguna\Limac;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultigunaLimacCapital extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_pengajuan',
        'kode_nasabah',
        'nama_nasabah',

        'aktiva_lancar_keterangan_1',
        'aktiva_lancar_nilai_1',
        'aktiva_lancar_keterangan_2',
        'aktiva_lancar_nilai_2',
        'aktiva_lancar_keterangan_3',
        'aktiva_lancar_nilai_3',
        'tanah_lokasi_1',
        'tanah_luas_tanah_bangunan_1',
        'tanah_status_1',
        'tanah_atas_nama_1',
        'tanah_nilai_1',
        'tanah_lokasi_2',
        'tanah_luas_tanah_bangunan_2',
        'tanah_status_2',
        'tanah_atas_nama_2',
        'tanah_nilai_2',
        'tanah_lokasi_3',
        'tanah_luas_tanah_bangunan_3',
        'tanah_status_3',
        'tanah_atas_nama_3',
        'tanah_nilai_3',
        'kendaraan_jenis_merek_1',
        'kendaraan_tahun_pembuatan_1',
        'kendaraan_atas_nama_1',
        'kendaraan_nilai_1',
        'kendaraan_jenis_merek_2',
        'kendaraan_tahun_pembuatan_2',
        'kendaraan_atas_nama_2',
        'kendaraan_nilai_2',
        'kendaraan_jenis_merek_3',
        'kendaraan_tahun_pembuatan_3',
        'kendaraan_atas_nama_3',
        'kendaraan_nilai_3',
        'lain_jenis_1',
        'lain_lokasi_1',
        'lain_atas_nama_1',
        'lain_nilai_1',
        'lain_jenis_2',
        'lain_lokasi_2',
        'lain_atas_nama_2',
        'lain_nilai_2',
        'lain_jenis_3',
        'lain_lokasi_3',
        'lain_atas_nama_3',
        'lain_nilai_3',

        'jenis_akad',
        'jenis_pembiayaan',
        'tujuan_penggunaan',
        'harga_beli_bank',
        'jangka_waktu_pembiayaan',
        'margin_bank',

        'besarnya_urbun',

        'username',
        'kode_tempat',
    ];
}
