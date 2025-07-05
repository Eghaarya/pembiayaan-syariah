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
            $table->string('nama_nasabah', 100);

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

            $table->decimal('penghasilan_nasabah', 18, 2)->nullable();
            $table->string('keterangan_penghasilan_nasabah', 50)->nullable();
            $table->decimal('penghasilan_pasangan', 18, 2)->nullable();
            $table->string('keterangan_penghasilan_pasangan', 50)->nullable();
            $table->decimal('sumber_penghasilan_lain', 18, 2)->nullable();
            $table->string('keterangan_sumber_penghasilan_lain', 50)->nullable();
            $table->decimal('biaya_sewa_rumah', 18, 2)->nullable();
            $table->string('keterangan_biaya_sewa_rumah', 50)->nullable();
            $table->decimal('biaya_makan', 18, 2)->nullable();
            $table->string('keterangan_biaya_makan', 50)->nullable();
            $table->decimal('biaya_transportasi', 18, 2)->nullable();
            $table->string('keterangan_biaya_transportasi', 50)->nullable();
            $table->decimal('biaya_pendidikan', 18, 2)->nullable();
            $table->string('keterangan_biaya_pendidikan', 50)->nullable();
            $table->decimal('biaya_listrik_air_gas', 18, 2)->nullable();
            $table->string('keterangan_biaya_listrik_air_gas', 50)->nullable();
            $table->decimal('angsuran_pinjaman', 18, 2)->nullable();
            $table->string('keterangan_angsuran_pinjaman', 50)->nullable();
            $table->decimal('premi_asuransi', 18, 2)->nullable();
            $table->string('keterangan_premi_asuransi', 50)->nullable();
            $table->decimal('tabungan_berjangka', 18, 2)->nullable();
            $table->string('keterangan_tabungan_berjangka', 50)->nullable();
            $table->decimal('pengeluaran_lain', 18, 2)->nullable();
            $table->string('keterangan_pengeluaran_lain', 50)->nullable();

            $table->string('tempatkerja_kelokasi_bank', 100)->nullable();
            $table->string('tempatkerja_kelokasi_agunan', 100)->nullable();
            $table->string('pembayaran_kolektif', 100)->nullable();
            $table->string('pembayaran_nonkolektif', 100)->nullable();

            $table->decimal('analis_harga_beli_bank', 18, 2)->nullable();
            $table->decimal('analis_margin_bank', 18, 2)->nullable();
            $table->decimal('analis_harga_jual_bank', 18, 2)->nullable();
            $table->string('analis_jangka_waktu_pembiayaan', 5)->nullable();

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
        Schema::dropIfExists('mudharabah_limac_capacities');
    }
};
