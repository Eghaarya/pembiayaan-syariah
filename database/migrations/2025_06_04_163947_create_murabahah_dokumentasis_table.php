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
        Schema::create('murabahah_dokumentasis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pengajuan')->unique();
            $table->string('kode_nasabah');
            $table->string('nama_nasabah', 100);

            $table->string('foto_nasabah', 100)->nullable();
            $table->string('foto_identitas_nasabah', 100)->nullable();
            $table->string('npwp_nasabah', 100)->nullable();
            $table->string('foto_pasangan', 100)->nullable();
            $table->string('foto_identitas_pasangan', 100)->nullable();
            $table->string('npwp_pasangan', 100)->nullable();

            $table->string('slip_gaji_nasabah', 100)->nullable();
            $table->string('slip_gaji_pasangan', 100)->nullable();
            $table->string('rekening_gaji_nasabah', 100)->nullable();
            $table->string('rekening_gaji_pasangan', 100)->nullable();
            $table->string('tempat_kerja_usaha_nasabah', 100)->nullable();
            $table->string('tempat_kerja_usaha_pasangan', 100)->nullable();
            $table->string('foto_surat_pegawai_tetap_nasabah', 100)->nullable();
            $table->string('foto_surat_pegawai_tetap_pasangan', 100)->nullable();
            $table->string('foto_tabungan_nasabah_3_bln_terakhir', 100)->nullable();
            $table->string('foto_tabungan_pasangan_3_bln_terakhir', 100)->nullable();

            $table->string('foto_depan_agunan', 100)->nullable();
            $table->string('foto_dalam_agunan', 100)->nullable();
            $table->string('foto_barat_agunan', 100)->nullable();
            $table->string('foto_utara_agunan', 100)->nullable();
            $table->string('foto_timur_agunan', 100)->nullable();
            $table->string('foto_selatan_agunan', 100)->nullable();
            $table->string('foto_jaminan_depan_kpm', 100)->nullable();
            $table->string('foto_jaminan_samping_kpm', 100)->nullable();
            $table->string('foto_jaminan_atas_kpm', 100)->nullable();
            $table->string('foto_jaminan_rangka_mesin_kpm', 100)->nullable();

            $table->string('username')->nullable();
            $table->string('kode_tempat')->nullable();
            $table->timestamps();

            $table->foreign('kode_pengajuan')
                ->references('kode_pengajuan')
                ->on('murabahah_pengajuan')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('murabahah_dokumentasis');
    }
};
