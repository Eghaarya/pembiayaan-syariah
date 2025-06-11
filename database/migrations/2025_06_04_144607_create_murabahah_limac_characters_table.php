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
        Schema::create('murabahah_limac_characters', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pengajuan')->unique();
            $table->string('kode_nasabah');
            $table->string('nama_nasabah', 100);

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
                ->on('murabahah_pengajuan')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('murabahah_limac_characters');
    }
};
