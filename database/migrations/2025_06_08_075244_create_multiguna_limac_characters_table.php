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
            $table->string('nama_nasabah', 100)->nullable();

            $table->string('punya_rekening_nasabah', 100)->nullable();
            $table->string('tahun_menjadi_nasabah', 100)->nullable();
            $table->string('jenis_layanan_nasabah', 100)->nullable();
            $table->string('mutasi_rekening_nasabah', 200)->nullable();

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

            // 6 baris data checking untuk Nasabah
            for ($i = 1; $i <= 6; $i++) {
                $table->string("noid_checking{$i}_nasabah", 50)->nullable();
                $table->string("fasilitas_pinjaman{$i}_nasabah", 100)->nullable();
                $table->string("bank_pelapor{$i}_nasabah", 100)->nullable();
                $table->decimal("plafond_pinjaman{$i}_nasabah", 15, 2)->nullable();
                $table->decimal("outstanding_pinjaman{$i}_nasabah", 15, 2)->nullable();
                $table->date("tanggal_realisasi{$i}_nasabah")->nullable();
                $table->date("tanggal_jatuh_tempo{$i}_nasabah")->nullable();
                $table->string("kolektabilitas{$i}_nasabah", 50)->nullable();
                $table->string("keterangan{$i}_nasabah", 100)->nullable();
            }

            // 6 baris data checking untuk Pasangan
            for ($i = 1; $i <= 6; $i++) {
                $table->string("noid_checking{$i}_pasangan", 50)->nullable();
                $table->string("fasilitas_pinjaman{$i}_pasangan", 100)->nullable();
                $table->string("bank_pelapor{$i}_pasangan", 100)->nullable();
                $table->decimal("plafond_pinjaman{$i}_pasangan", 15, 2)->nullable();
                $table->decimal("outstanding_pinjaman{$i}_pasangan", 15, 2)->nullable();
                $table->date("tanggal_realisasi{$i}_pasangan")->nullable();
                $table->date("tanggal_jatuh_tempo{$i}_pasangan")->nullable();
                $table->string("kolektabilitas{$i}_pasangan", 50)->nullable();
                $table->string("keterangan{$i}_pasangan", 100)->nullable();
            }

            $table->string('username')->nullable();
            $table->string('kode_tempat')->nullable();
            $table->timestamps();

            $table->foreign('kode_pengajuan')
                ->references('kode_pengajuan')
                ->on('multiguna_pengajuan')
                ->onDelete('cascade');
            $table->foreign('nama_nasabah')
                ->references('nama_nasabah')
                ->on('nasabah_profil')
                ->onUpdate('cascade');
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
