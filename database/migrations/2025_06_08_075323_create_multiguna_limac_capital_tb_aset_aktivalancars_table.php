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
        Schema::create('multiguna_limac_capital_tb_aset_aktivalancars', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pengajuan');
            $table->string('kode_nasabah');
            $table->string('nama_nasabah', 100);

            $table->string("aktiva_lancar_keterangan")->nullable();
            $table->decimal("aktiva_lancar_nilai", 20, 2)->nullable();

            $table->string('username')->nullable();
            $table->string('kode_tempat')->nullable();
            $table->timestamps();

            $table->foreign('kode_pengajuan', 'fk_multiguna_aset_aktivalancar')
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
        Schema::dropIfExists('multiguna_limac_capital_tb_aset_aktivalancars');
    }
};
