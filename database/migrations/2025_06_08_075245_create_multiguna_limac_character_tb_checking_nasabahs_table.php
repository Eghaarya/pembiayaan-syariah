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
        Schema::create('multiguna_limac_character_tb_checking_nasabahs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pengajuan');
            $table->string('kode_nasabah');
            $table->string('nama_nasabah', 100);

            $table->string("noid_checking_nasabah", 50)->nullable();
            $table->string("nama_debitur_nasabah", 100)->nullable();
            $table->string("fasilitas_pinjaman_nasabah", 100)->nullable();
            $table->string("bank_pelapor_nasabah", 100)->nullable();
            $table->decimal("plafond_pinjaman_nasabah", 15, 2)->nullable();
            $table->decimal("outstanding_pinjaman_nasabah", 15, 2)->nullable();
            $table->date("tanggal_realisasi_nasabah")->nullable();
            $table->date("tanggal_jatuh_tempo_nasabah")->nullable();
            $table->string("kolektabilitas_nasabah", 50)->nullable();
            $table->string("keterangan_nasabah", 100)->nullable();
            $table->string("agunan_nasabah", 100)->nullable();

            $table->string('username')->nullable();
            $table->string('kode_tempat')->nullable();
            $table->timestamps();

            $table->foreign('kode_pengajuan', 'fk_multiguna_checking_nasabah')
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
        Schema::dropIfExists('multiguna_limac_character_tb_checking_nasabahs');
    }
};
