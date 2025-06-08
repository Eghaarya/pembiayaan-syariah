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
        Schema::create('multiguna_limac_capacities', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pengajuan')->unique();
            $table->string('kode_nasabah');
            $table->string('nama_nasabah', 100)->nullable();

            $table->string('memiliki_jabatan_rangkap', 10)->nullable();
            $table->string('publik_figur', 10)->nullable();
            $table->string('pemegang_jabatan_tertinggi', 10)->nullable();
            $table->string('bukan_pemegang_jabatan_tertinggi', 10)->nullable();
            $table->string('non_jabatan', 10)->nullable();
            $table->string('mendapat_rumah_dinas', 10)->nullable();
            $table->string('mendapat_mobil_dinas', 10)->nullable();
            $table->string('mendapat_sepeda_motor_dinas', 10)->nullable();
            $table->string('mendapat_fasilitas_pinjaman_uang', 10)->nullable();
            $table->string('belum_mendapat_fasilitas_dinas', 10)->nullable();

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
        Schema::dropIfExists('multiguna_limac_capacities');
    }
};
