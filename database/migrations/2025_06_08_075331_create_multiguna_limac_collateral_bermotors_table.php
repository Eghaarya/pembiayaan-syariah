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
        Schema::create('multiguna_limac_collateral_bermotors', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pengajuan')->unique();
            $table->string('kode_nasabah');
            $table->string('nama_nasabah', 100);

            $table->string('tujuan_penggunaan', 100)->nullable();
            $table->string('jenis_kendaraan', 100)->nullable();
            $table->string('status_agunan_kendaraan', 100)->nullable();
            $table->string('nomor_stnk_agunan', 100)->nullable();
            $table->string('nama_pemilik_agunan', 100)->nullable();
            $table->string('alamat_pemilik_agunan', 100)->nullable();
            $table->string('merk_agunan', 100)->nullable();
            $table->string('tipe_agunan', 100)->nullable();
            $table->string('bahan_bakar', 100)->nullable();
            $table->string('warna_agunan', 100)->nullable();
            $table->string('isi_silinder', 100)->nullable();
            $table->string('nomor_rangka_agunan', 100)->nullable();
            $table->string('nomor_mesin_agunan', 100)->nullable();
            $table->string('tahun_pembuatan', 100)->nullable();
            $table->string('masa_berlaku', 100)->nullable();

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
        Schema::dropIfExists('multiguna_limac_collateral_bermotors');
    }
};
