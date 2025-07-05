<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('nasabah_pekerjaan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_nasabah')->unique();
            $table->string('nama_nasabah', 100);

            // 1.1 Pekerjaan nasabah
            $table->string('nama_perusahaan_nasabah', 100)->nullable();
            $table->string('bidang_perusahaan_nasabah', 100)->nullable();
            $table->string('skala_perusahaan_nasabah', 100)->nullable();
            $table->string('jenis_pekerjaan_nasabah', 100)->nullable();
            $table->string('jabatan_pekerjaan_nasabah', 100)->nullable();
            $table->string('dept_perusahaan_nasabah', 100)->nullable();
            $table->string('mulai_bekerja_nasabah', 5)->nullable();
            $table->string('lamabekerja_tahun_nasabah', 2)->nullable();
            $table->string('lamabekerja_bulan_nasabah', 2)->nullable();
            $table->string('pengalaman_perusahaan_nasabah', 50)->nullable();
            $table->string('totalbekerja_tahun_nasabah', 2)->nullable();
            $table->string('totalbekerja_bulan_nasabah', 2)->nullable();
            $table->string('pendidikan_terakhir_nasabah', 10)->nullable();
            $table->string('usia_nasabah', 50)->nullable();
            $table->string('usia_prapensiun_nasabah', 10)->nullable();
            $table->string('usia_pensiun_nasabah', 10)->nullable();
            $table->string('sisa_pensiun_nasabah', 50)->nullable();
            $table->string('nama_atasan_nasabah', 100)->nullable();
            $table->string('notelp_atasan_nasabah', 20)->nullable();
            $table->string('jenispekerjaan_atasan_nasabah', 100)->nullable();
            $table->string('alamat_perusahaan_nasabah', 200)->nullable();
            $table->string('notelp_perusahaan_nasabah', 20)->nullable();
            $table->string('penggajian_satu_nasabah', 10)->nullable();
            $table->string('penggajian_dua_nasabah', 10)->nullable();
            $table->string('perjanjian_kerjasama_nasabah', 200)->nullable();
            $table->string('pengalaman_perusahaanlain_nasabah', 200)->nullable();
            $table->string('sumber_penghasilan_nasabah', 100)->nullable();
            $table->string('tanggungan_nasabah', 50)->nullable();

            // 1.2 Pekerjaan pasangan
            $table->string('nama_perusahaan_pasangan', 100)->nullable();
            $table->string('bidang_perusahaan_pasangan', 100)->nullable();
            $table->string('skala_perusahaan_pasangan', 100)->nullable();
            $table->string('jenis_pekerjaan_pasangan', 100)->nullable();
            $table->string('jabatan_pekerjaan_pasangan', 100)->nullable();
            $table->string('dept_perusahaan_pasangan', 100)->nullable();
            $table->string('mulai_bekerja_pasangan', 5)->nullable();
            $table->string('lamabekerja_tahun_pasangan', 2)->nullable();
            $table->string('lamabekerja_bulan_pasangan', 2)->nullable();
            $table->string('pengalaman_perusahaan_pasangan', 50)->nullable();
            $table->string('totalbekerja_tahun_pasangan', 2)->nullable();
            $table->string('totalbekerja_bulan_pasangan', 2)->nullable();
            $table->string('pendidikan_terakhir_pasangan', 10)->nullable();
            $table->string('usia_pasangan', 50)->nullable();
            $table->string('usia_prapensiun_pasangan', 10)->nullable();
            $table->string('usia_pensiun_pasangan', 10)->nullable();
            $table->string('nama_atasan_pasangan', 100)->nullable();
            $table->string('notelp_atasan_pasangan', 20)->nullable();
            $table->string('jenispekerjaan_atasan_pasangan', 100)->nullable();
            $table->string('alamat_perusahaan_pasangan', 200)->nullable();
            $table->string('notelp_perusahaan_pasangan', 20)->nullable();
            $table->string('penggajian_satu_pasangan', 10)->nullable();
            $table->string('penggajian_dua_pasangan', 10)->nullable();
            $table->string('pengalaman_perusahaanlain_pasangan', 200)->nullable();

            // 1.3 Usaha nasabah/ pasangan
            $table->string('nama_perusahaan_usaha', 100)->nullable();
            $table->string('bidang_perusahaan_usaha', 100)->nullable();
            $table->string('jabatan_usaha', 100)->nullable();
            $table->string('mulai_usaha', 10)->nullable();
            $table->string('lama_usaha', 10)->nullable();
            $table->string('total_lama_usaha', 10)->nullable();
            $table->string('jumlah_karyawan_usaha', 5)->nullable();
            $table->string('keterangan_tambahan_usaha', 200)->nullable();
            $table->string('usaha_pensiun_usaha', 10)->nullable();
            $table->string('nama_suppliersatu_usaha', 100)->nullable();
            $table->string('alamat_suppliersatu_usaha', 200)->nullable();
            $table->string('notelp_suppliersatu_usaha', 20)->nullable();
            $table->string('nama_supplierdua_usaha', 100)->nullable();
            $table->string('alamat_supplierdua_usaha', 200)->nullable();
            $table->string('notelp_supplierdua_usaha', 20)->nullable();
            $table->string('nama_suppliertiga_usaha', 100)->nullable();
            $table->string('alamat_suppliertiga_usaha', 200)->nullable();
            $table->string('notelp_suppliertiga_usaha', 20)->nullable();

            $table->string('username')->nullable();
            $table->string('kode_tempat')->nullable();
            $table->timestamps();

            $table->foreign('kode_nasabah')
                ->references('kode_nasabah')
                ->on('nasabah_profil')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nasabah_pekerjaan');
    }
};
