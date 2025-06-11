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
        Schema::create('nasabah_profil', function (Blueprint $table) {
            $table->id();
            $table->string('kode_nasabah')->unique();

            // 1.1 Identitas nasabah
            $table->string('nama_nasabah', 100);
            $table->string('ttl_lahir_nasabah', 50)->nullable();
            $table->string('alamat_ktp_nasabah', 200)->nullable();
            $table->string('kota_ktp_nasabah', 50)->nullable();
            $table->string('kodepos_ktp_nasabah', 10)->nullable();
            $table->string('alamat_sekarang_nasabah', 200)->nullable();
            $table->string('kota_sekarang_nasabah', 50)->nullable();
            $table->string('kodepos_sekarang_nasabah', 10)->nullable();
            $table->string('no_ktp_nasabah', 20)->nullable();
            $table->date('berlaku_ktp_nasabah')->nullable();
            $table->string('no_npwp_nasabah', 20)->nullable();
            $table->string('kepemilikan_rumah_nasabah', 20)->nullable();
            $table->integer('lamamenetap_tahun_nasabah')->nullable();
            $table->integer('lamamenetap_bulan_nasabah')->nullable();
            $table->string('notelp_rumah_nasabah', 20)->nullable();
            $table->string('notelp_hp_nasabah', 20)->nullable();
            $table->string('email_nasabah', 100)->nullable();
            $table->string('jenis_kelamin_nasabah', 10)->nullable();
            $table->string('status_kawin_nasabah', 20)->nullable();
            $table->string('nama_ibu_nasabah', 100)->nullable();
            $table->string('nama_organisasi_nasabah', 100)->nullable();
            $table->string('jabatan_organisasi_nasabah', 100)->nullable();
            $table->string('lama_organisasi_nasabah', 100)->nullable();

            $table->string('nama_keluarga_nasabah', 100)->nullable();
            $table->string('hubungan_keluarga_nasabah', 100)->nullable();
            $table->string('alamat_keluarga_nasabah', 200)->nullable();
            $table->string('kota_keluarga_nasabah', 50)->nullable();
            $table->string('kodepos_keluarga_nasabah', 10)->nullable();
            $table->string('notelp_keluarga_nasabah', 20)->nullable();
            $table->string('pekerjaan_keluarga_nasabah', 100)->nullable();
            $table->string('alamatkantor_keluarga_nasabah', 200)->nullable();
            $table->string('notelpkantor_keluarga_nasabah', 20)->nullable();

            // 1.2 Identitas Pasangan
            $table->string('nama_pasangan', 100)->nullable();
            $table->string('ttl_lahir_pasangan', 50)->nullable();
            $table->string('no_ktp_pasangan', 20)->nullable();
            $table->date('berlaku_ktp_pasangan')->nullable();
            $table->string('jumlah_anak_pasangan', 2)->nullable();
            $table->string('no_npwp_pasangan', 20)->nullable();

            // 1.3 Hubungan Nasabah bank syariah
            $table->string('punya_rekening_nasabah', 100)->nullable();
            $table->string('tahun_menjadi_nasabah', 100)->nullable();
            $table->string('jenis_layanan_nasabah', 100)->nullable();
            $table->string('mutasi_rekening_nasabah', 200)->nullable();

            $table->string('username')->nullable();
            $table->string('kode_tempat')->nullable();
            $table->timestamps();

            $table->foreign('username')
                ->references('username')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nasabah_profil');
    }
};
