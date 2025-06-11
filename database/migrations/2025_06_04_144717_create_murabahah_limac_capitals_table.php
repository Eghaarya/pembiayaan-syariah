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
        Schema::create('murabahah_limac_capitals', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pengajuan')->unique();
            $table->string('kode_nasabah');
            $table->string('nama_nasabah', 100);

            for ($i = 1; $i <= 3; $i++) {
                $table->string("aktiva_lancar_keterangan_$i")->nullable();
                $table->decimal("aktiva_lancar_nilai_$i", 20, 2)->nullable();
            }

            for ($i = 1; $i <= 3; $i++) {
                $table->string("tanah_lokasi_$i")->nullable();
                $table->string("tanah_luas_tanah_bangunan_$i")->nullable();
                $table->string("tanah_status_$i")->nullable();
                $table->string("tanah_atas_nama_$i")->nullable();
                $table->decimal("tanah_nilai_$i", 20, 2)->nullable();
            }

            for ($i = 1; $i <= 3; $i++) {
                $table->string("kendaraan_jenis_merek_$i")->nullable();
                $table->string("kendaraan_tahun_pembuatan_$i")->nullable();
                $table->string("kendaraan_atas_nama_$i")->nullable();
                $table->decimal("kendaraan_nilai_$i", 20, 2)->nullable();
            }

            for ($i = 1; $i <= 3; $i++) {
                $table->string("lain_jenis_$i")->nullable();
                $table->string("lain_lokasi_$i")->nullable();
                $table->string("lain_atas_nama_$i")->nullable();
                $table->decimal("lain_nilai_$i", 20, 2)->nullable();
            }

            $table->string('jenis_akad', 100)->nullable();
            $table->string('jenis_pembiayaan', 100)->nullable();
            $table->string('tujuan_penggunaan', 100)->nullable();
            $table->string('harga_jual_barang', 50)->nullable();
            $table->string('urbun_uangmuka', 50)->nullable();
            $table->string('harga_beli_bank', 50)->nullable();
            $table->string('jangka_waktu_pembiayaan', 5)->nullable();
            $table->string('margin_bank', 50)->nullable();

            $table->string('besarnya_urbun', 100)->nullable();

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
        Schema::dropIfExists('murabahah_limac_capitals');
    }
};
