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
        Schema::create('multiguna_pengajuan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pengajuan')->unique();
            $table->string('kode_nasabah')->nullable();
            $table->string('nama_nasabah', 100)->nullable();

            $table->date('tanggal_pengajuan')->nullable();

            $table->integer('total_character')->default(0);
            $table->integer('total_capacity')->default(0);
            $table->integer('total_capital')->default(0);
            $table->integer('total_collateralsk')->default(0);
            $table->integer('total_collateralproperti')->default(0);
            $table->integer('total_collateralbermotor')->default(0);
            $table->integer('total_condition')->default(0);

            $table->string('keputusan', 50)->nullable();
            $table->date('tanggal_pencairan')->nullable();

            $table->string('username')->nullable();
            $table->string('kode_tempat')->nullable();
            $table->timestamps();

            $table->foreign('kode_nasabah')
                ->references('kode_nasabah')
                ->on('nasabah_profil')
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
        Schema::dropIfExists('multiguna_pengajuan');
    }
};
