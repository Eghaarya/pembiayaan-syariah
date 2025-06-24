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
        Schema::create('multiguna_limac_collateral_propertis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pengajuan')->unique();
            $table->string('kode_nasabah');
            $table->string('nama_nasabah', 100);

            $table->string('jenis_sertifikat_hak', 100)->nullable();
            $table->string('nomor_sertifikat', 100)->nullable();
            $table->date('tanggal_penerbitan', 100)->nullable();
            $table->string('instansi_yang_menerbitkan', 100)->nullable();
            $table->string('nama_pemegang_hak', 100)->nullable();
            $table->string('lama_tgl_akhir_hak_berlaku', 100)->nullable();
            $table->string('surat_ukur_nomor', 100)->nullable();
            $table->date('tanggal_ukur', 100)->nullable();
            $table->string('asal_agunan', 100)->nullable();
            $table->string('luas_agunan', 100)->nullable();
            $table->string('letak_agunan', 100)->nullable();
            $table->string('batas_utara_agunan', 100)->nullable();
            $table->string('batas_timur_agunan', 100)->nullable();
            $table->string('batas_selatan_agunan', 100)->nullable();
            $table->string('batas_barat_agunan', 100)->nullable();

            $table->string('aksesibilitas_lokasi_agunan', 50)->nullable();
            $table->string('keterangan_lingkungan_agunan_tanah', 50)->nullable();
            $table->string('keterangan_lingkungan_agunan_kawasan', 50)->nullable();
            $table->string('penggunaan_agunan_saat_ini', 50)->nullable();
            $table->decimal('harga_sewa_per_tahun', 15, 2)->nullable();
            $table->string('agunan_punya_akses_jalan_besar', 150)->nullable(); //
            $table->string('agunan_aktiva_warisan_belum_dibagi', 50)->nullable();

            $table->string('memiliki_imb', 50)->nullable();
            $table->string('tahun_pembuatan_bangunan', 50)->nullable();
            $table->decimal('perkiraan_biaya_pembangunan', 15, 2)->nullable();
            $table->string('keterangan_konstruksi_bangunan', 50)->nullable();
            $table->string('luas_efektif', 10, 2)->nullable();
            $table->string('jumlah_lantai', 50)->nullable();
            $table->string('pondasi', 50)->nullable();
            $table->string('lantai', 50)->nullable();
            $table->string('konstruksi', 50)->nullable();
            $table->string('dinding', 50)->nullable();
            $table->string('dinding_pemisah', 50)->nullable();
            $table->string('kusen', 50)->nullable();
            $table->string('pintu', 50)->nullable();
            $table->string('jendela_ventilasi', 50)->nullable();
            $table->string('plafond', 50)->nullable();
            $table->string('konstruksi_atap', 50)->nullable();
            $table->string('penutup_atap', 50)->nullable();
            $table->string('instalasi_air', 50)->nullable();
            $table->string('instalasi_listrik', 50)->nullable();
            $table->string('perawatan', 50)->nullable();
            $table->string('kondisi_sarana_dan_emplasemen', 50)->nullable();
            $table->string('informasi_lain_kondisi_bangunan', 100)->nullable();

            $table->string('lokasi_perumahan', 100)->nullable();
            $table->string('kenyamanan', 100)->nullable();
            $table->string('lokasi_agunan', 100)->nullable();
            $table->string('jarak_fasum_fasos', 100)->nullable();
            $table->string('fasilitas_perumahan', 100)->nullable();
            $table->string('jenis_jalan_lingkungan', 100)->nullable();
            $table->string('jarak_ke_jalan_provinsi', 100)->nullable();
            $table->string('jenis_dan_kondisi_jalan', 100)->nullable();
            $table->string('kondisi_jalan_ke_kota', 100)->nullable();
            $table->string('resiko_bencana_hidup', 100)->nullable();
            $table->string('kontribusi_pemohon_dp', 100)->nullable();
            $table->string('pertumbuhan_agunan', 100)->nullable();
            $table->string('kondisi_wilayah_agunan', 100)->nullable();

            $table->string('username')->nullable();
            $table->string('kode_tempat')->nullable();
            $table->timestamps();

            $table->foreign('kode_pengajuan')
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
        Schema::dropIfExists('multiguna_limac_collateral_propertis');
    }
};
