<?php

namespace App\Models\Nasabah;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NasabahPekerjaan extends Model
{
    protected $table = 'nasabah_pekerjaan';

    protected $fillable = [
        'kode_nasabah',
        'nama_nasabah',

        'nama_perusahaan_nasabah',
        'bidang_perusahaan_nasabah',
        'skala_perusahaan_nasabah',
        'jenis_pekerjaan_nasabah',
        'jabatan_pekerjaan_nasabah',
        'dept_perusahaan_nasabah',
        'mulai_bekerja_nasabah',
        'lamabekerja_tahun_nasabah',
        'lamabekerja_bulan_nasabah',
        'pengalaman_perusahaan_nasabah',
        'totalbekerja_tahun_nasabah',
        'totalbekerja_bulan_nasabah',
        'pendidikan_terakhir_nasabah',
        'usia_nasabah',
        'usia_prapensiun_nasabah',
        'usia_pensiun_nasabah',
        'sisa_pensiun_nasabah',
        'nama_atasan_nasabah',
        'notelp_atasan_nasabah',
        'jenispekerjaan_atasan_nasabah',
        'alamat_perusahaan_nasabah',
        'notelp_perusahaan_nasabah',
        'penggajian_satu_nasabah',
        'penggajian_dua_nasabah',
        'perjanjian_kerjasama_nasabah',
        'pengalaman_perusahaanlain_nasabah',
        'sumber_penghasilan_nasabah',
        'tanggungan_nasabah',

        'nama_perusahaan_pasangan',
        'bidang_perusahaan_pasangan',
        'skala_perusahaan_pasangan',
        'jenis_pekerjaan_pasangan',
        'jabatan_pekerjaan_pasangan',
        'dept_perusahaan_pasangan',
        'mulai_bekerja_pasangan',
        'lamabekerja_tahun_pasangan',
        'lamabekerja_bulan_pasangan',
        'pengalaman_perusahaan_pasangan',
        'totalbekerja_tahun_pasangan',
        'totalbekerja_bulan_pasangan',
        'pendidikan_terakhir_pasangan',
        'usia_pasangan',
        'usia_prapensiun_pasangan',
        'usia_pensiun_pasangan',
        'nama_atasan_pasangan',
        'notelp_atasan_pasangan',
        'jenispekerjaan_atasan_pasangan',
        'alamat_perusahaan_pasangan',
        'notelp_perusahaan_pasangan',
        'penggajian_satu_pasangan',
        'penggajian_dua_pasangan',
        'pengalaman_perusahaanlain_pasangan',

        'nama_perusahaan_usaha',
        'bidang_perusahaan_usaha',
        'jabatan_usaha',
        'mulai_usaha',
        'lama_usaha',
        'total_lama_usaha',
        'jumlah_karyawan_usaha',
        'keterangan_tambahan_usaha',
        'usaha_pensiun_usaha',
        'nama_suppliersatu_usaha',
        'alamat_suppliersatu_usaha',
        'notelp_suppliersatu_usaha',
        'nama_supplierdua_usaha',
        'alamat_supplierdua_usaha',
        'notelp_supplierdua_usaha',
        'nama_suppliertiga_usaha',
        'alamat_suppliertiga_usaha',
        'notelp_suppliertiga_usaha',

        'username',
        'kode_tempat',

    ];
}
