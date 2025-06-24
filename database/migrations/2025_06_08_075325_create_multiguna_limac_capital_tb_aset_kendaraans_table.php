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
        Schema::create('multiguna_limac_capital_tb_aset_kendaraans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pengajuan');
            $table->string('kode_nasabah');
            $table->string('nama_nasabah', 100);

            $table->string("kendaraan_jenis_merek")->nullable();
            $table->string("kendaraan_tahun_pembuatan")->nullable();
            $table->string("kendaraan_atas_nama")->nullable();
            $table->decimal("kendaraan_nilai", 20, 2)->nullable();

            $table->string('username')->nullable();
            $table->string('kode_tempat')->nullable();
            $table->timestamps();

            $table->foreign('kode_pengajuan', 'fk_multiguna_aset_kendaraan')
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
        Schema::dropIfExists('multiguna_limac_capital_tb_aset_kendaraans');
    }
};
