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
        Schema::create('multiguna_limac_capacities', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pengajuan')->unique();
            $table->string('kode_nasabah');
            $table->string('nama_nasabah', 100);

            $table->string('memiliki_jabatan_rangkap', 10)->nullable();
            $table->string('publik_figur', 10)->nullable();
            $table->string('pemegang_jabatan_tertinggi', 10)->nullable();
            $table->string('bukan_pemegang_jabatan_tertinggi', 10)->nullable();
            $table->string('non_jabatan', 10)->nullable();

            $table->string('mendapat_rumah_dinas', 10)->nullable();
            $table->string('mendapat_mobil_dinas', 10)->nullable();
            $table->string('mendapat_sepeda_motor_dinas', 10)->nullable();
            $table->string('mendapat_fasilitas_pinjaman_uang', 10)->nullable();
            $table->string('belum_mendapat_fasilitas_dinas', 10)->nullable();

            $table->string('nama_bank_nasabah', 100)->nullable();
            $table->string('no_bank_account_nasabah', 50)->nullable();
            $table->string('nama_bank_pasangan', 100)->nullable();
            $table->string('no_bank_account_pasangan', 50)->nullable();

            for ($i = 1; $i <= 3; $i++) {
                $table->date("tanggal_nasabah_bulan_{$i}")->nullable();
                $table->decimal("saldo_awal_nasabah_bulan_{$i}", 18, 2)->nullable();
                $table->decimal("total_debet_nasabah_bulan_{$i}", 18, 2)->nullable();
                $table->decimal("total_kredit_nasabah_bulan_{$i}", 18, 2)->nullable();
                $table->decimal("saldo_akhir_nasabah_bulan_{$i}", 18, 2)->nullable();

                $table->date("tanggal_pasangan_bulan_{$i}")->nullable();
                $table->decimal("saldo_awal_pasangan_bulan_{$i}", 18, 2)->nullable();
                $table->decimal("total_debet_pasangan_bulan_{$i}", 18, 2)->nullable();
                $table->decimal("total_kredit_pasangan_bulan_{$i}", 18, 2)->nullable();
                $table->decimal("saldo_akhir_pasangan_bulan_{$i}", 18, 2)->nullable();
            }

            $table->decimal('gaji_pokok', 15, 2)->nullable();
            $table->decimal('tunjangan_penghasilan', 15, 2)->nullable();
            $table->decimal('tunjangan_kesejahteraan', 15, 2)->nullable();
            $table->decimal('tunjangan_struktural', 15, 2)->nullable();
            $table->decimal('tunjangan_fungsional', 15, 2)->nullable();
            $table->decimal('tunjangan_suami_istri', 15, 2)->nullable();
            $table->decimal('tunjangan_anak', 15, 2)->nullable();
            $table->decimal('tunjangan_beras', 15, 2)->nullable();
            $table->decimal('tunjangan_lain_lain', 15, 2)->nullable();
            $table->decimal('tunjangan_pengobatan', 15, 2)->nullable();
            $table->decimal('penerimaan_lain_lain', 15, 2)->nullable();

            $table->decimal('simpanan_wajib', 15, 2)->nullable();
            $table->decimal('iuran_koperasi', 15, 2)->nullable();
            $table->decimal('iuran_bpjs', 15, 2)->nullable();
            $table->decimal('potongan_lain_lain', 15, 2)->nullable();
            $table->decimal('pajak_penghasilan_pph21', 15, 2)->nullable();
            $table->decimal('angsuran_pinjaman_lain', 15, 2)->nullable();

            $table->decimal('analis_harga_beli_bank', 18, 2)->nullable();
            $table->decimal('analis_margin_bank', 18, 2)->nullable();
            $table->string('analis_jangka_waktu_pembiayaan', 5)->nullable();

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
        Schema::dropIfExists('multiguna_limac_capacities');
    }
};
