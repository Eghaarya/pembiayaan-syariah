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
        Schema::create('murabahah_pengajuan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pengajuan')->unique();
            $table->string('kode_nasabah');
            $table->string('nama_nasabah', 100);

            $table->date('tanggal_pengajuan')->nullable();

            $fields = [
                'jenis_akad' => 100,
                'jenis_pembiayaan' => 100,
                'tujuan_penggunaan' => 100,
                'harga_jual_barang' => 50,
                'urbun_uangmuka' => 50,
                'harga_beli_bank' => 50,
                'jangka_waktu_pembiayaan' => 5,
                'margin_bank' => 10,
            ];

            foreach (['permohonan', 'keputusan'] as $prefix) {
                foreach ($fields as $field => $length) {
                    $table->string("{$prefix}_{$field}", $length)->nullable();
                }
            }

            $table->integer('total_character')->default(0);
            $table->integer('total_capacity')->default(0);
            $table->integer('total_capital')->default(0);
            $table->integer('total_collateralkpr')->default(0);
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
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('murabahah_pengajuan');
    }
};
