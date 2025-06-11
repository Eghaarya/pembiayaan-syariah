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
        Schema::create('nasabah_dokumentasis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_nasabah')->unique();
            $table->string('nama_nasabah', 100);

            $table->string('foto_nasabah', 100)->nullable();
            $table->string('foto_identitas_nasabah', 100)->nullable();
            $table->string('npwp_nasabah', 100)->nullable();
            $table->string('foto_pasangan', 100)->nullable();
            $table->string('foto_identitas_pasangan', 100)->nullable();
            $table->string('npwp_pasangan', 100)->nullable();

            $table->string('username')->nullable();
            $table->string('kode_tempat')->nullable();
            $table->timestamps();

            $table->foreign('kode_nasabah')
                ->references('kode_nasabah')
                ->on('nasabah_profil')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nasabah_dokumentasis');
    }
};
