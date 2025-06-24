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
        Schema::create('murabahah_limac_character_tb_checking_pasangans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pengajuan');
            $table->string('kode_nasabah');
            $table->string('nama_nasabah', 100);

            $table->string("noid_checking_pasangan", 50)->nullable();
            $table->string("nama_debitur_pasangan", 100)->nullable();
            $table->string("fasilitas_pinjaman_pasangan", 100)->nullable();
            $table->string("bank_pelapor_pasangan", 100)->nullable();
            $table->decimal("plafond_pinjaman_pasangan", 15, 2)->nullable();
            $table->decimal("outstanding_pinjaman_pasangan", 15, 2)->nullable();
            $table->date("tanggal_realisasi_pasangan")->nullable();
            $table->date("tanggal_jatuh_tempo_pasangan")->nullable();
            $table->string("kolektabilitas_pasangan", 50)->nullable();
            $table->string("keterangan_pasangan", 100)->nullable();
            $table->string("agunan_pasangan", 100)->nullable();

            $table->string('username')->nullable();
            $table->string('kode_tempat')->nullable();
            $table->timestamps();

            $table->foreign('kode_pengajuan', 'fk_murabahah_checking_pasangan')
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
        Schema::dropIfExists('murabahah_limac_character_tb_checking_pasangans');
    }
};
