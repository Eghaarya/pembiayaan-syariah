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
        Schema::create('multiguna_limac_characters', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pengajuan')->unique();
            $table->string('kode_nasabah');
            $table->string('nama_nasabah', 100);

            $table->string('responsif_komunikatif', 10)->nullable();
            $table->string('mudah_dihubungi', 10)->nullable();
            $table->string('wawasan_luas', 10)->nullable();
            $table->string('informatif', 10)->nullable();
            $table->string('terbuka_berkomunikasi', 10)->nullable();
            $table->string('tidak_blacklist_bi', 10)->nullable();
            $table->string('bg_cek_tidak_ditolak', 10)->nullable();
            $table->string('tidak_bermasalah_bank_lain', 10)->nullable();
            $table->string('fasilitas_sesuai_penggunaan', 10)->nullable();
            $table->string('mutasi_pinjaman_aktif', 10)->nullable();

            $table->string('username')->nullable();
            $table->string('kode_tempat')->nullable();
            $table->timestamps();

            $table->foreign('kode_pengajuan')
                ->references('kode_pengajuan')
                ->on('multiguna_pengajuan')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('multiguna_limac_characters');
    }
};
