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
        Schema::create('murabahah_limac_capacities', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pengajuan')->unique();
            $table->string('kode_nasabah');
            $table->string('nama_nasabah', 100)->nullable();

            $table->string('tempatkerja_kelokasi_bank', 100)->nullable();
            $table->string('tempatkerja_kelokasi_agunan', 100)->nullable();
            $table->string('pembayaran_kolektif', 100)->nullable();
            $table->string('pembayaran_nonkolektif', 100)->nullable();

            $table->string('username')->nullable();
            $table->string('kode_tempat')->nullable();
            $table->timestamps();

            $table->foreign('kode_pengajuan')
                ->references('kode_pengajuan')
                ->on('murabahah_pengajuan')
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
        Schema::dropIfExists('mudharabah_limac_capacities');
    }
};
