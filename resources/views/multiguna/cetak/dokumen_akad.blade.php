<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dokumen Akad Pembiayaan</title>
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('fonts/fontawesome/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/animation/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
        }

        @media print {
            @page {
                size: A4 portrait;
            }

            body {
                margin: 0;
                padding: 0;
            }

            .no-print {
                display: none;
            }

            .text-danger {
                color: black !important;
            }
        }
    </style>
</head>

<body contenteditable="true" spellcheck="false" class="bg-white text-dark">

    <button contenteditable="false" class="btn btn-danger position-fixed top-0 start-0 m-3 no-print"
        style ="z-index: 1055;" onclick="window.print()">
        🖨️ Print / Cetak
    </button>

    <div class="container p-5">

        <h6 class="text-center font-weight-bold mb-1">
            AKAD PEMBIAYAAN Multiguna iB BAROKAH
        </h6>
        <h6 class="text-center font-weight-bold mb-3">
            BERDASARKAN PRINSIP MURABAHAH
        </h6>

        <div class="text-center">
            <input type="text" class="form-control text-center bg-white text-danger border-0 font-weight-bold w-100"
                value="{{ 'Nomor: ' . sprintf('%04d', $pengajuan->id ?? 0) . '/' . strtoupper($nasabah_profil->nama_nasabah ?? '-') . '/MULTIGUNASYARIAH' }}">
        </div>

        @php
            use Carbon\Carbon;
            $tanggal = Carbon::now()->locale('id');
            $hari = $tanggal->translatedFormat('l'); // Contoh: Senin
            $tgl = $tanggal->translatedFormat('d'); // Contoh: 23
            $bulan = $tanggal->translatedFormat('F'); // Contoh: Juni
            $tahun = $tanggal->translatedFormat('Y'); // Contoh: 2025
        @endphp

        <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
            Pada hari ini, {{ $hari }} tanggal {{ $tgl }} {{ strtoupper($bulan) }} {{ $tahun }}
            di SIDOARJO, PARA PIHAK yang bertanda-tangan di bawah ini:
            <br><br>
            <span class="font-weight-bold">1. Ahmad Baraja, S.EI, MS.SEI,</span>
            Pemimpin BANK SYARIAH UMSIDA SIDOARJO dalam hal ini bertindak menjalankan jabatannya tersebut, berdasarkan
            Surat Keputusan Direksi BANK SYARIAH UMSIDA tentang pemindahan tugas pegawai & pengangkatan dalam jabatan
            No.010/01/01/2025 Surat Tanggal 1 JANUARI 2025, dan atas nama serta sah mewakili Direksi BANK SYARIAH UMSIDA
            SIDOARJO yang berkedudukan di SIDOARJO, Jl. Mojopahit No.666 B, Sidowayah, Celep, Kec. Sidoarjo, Kabupaten
            Sidoarjo, Jawa Timur 61215, berdasarkan Surat Kuasa Direksi BANK SYARIAH UMSIDA No.010/01/01/2025 Surat
            Tanggal 1 JANUARI 2025, untuk selanjutnya disebut <span class="font-weight-bold">PIHAK PERTAMA</span>.
            <br><br>
            2. {{ $nasabah_profil->nama_nasabah }}, pekerjaan {{ $nasabah_pekerjaan->jenis_pekerjaan_nasabah }}, usia
            {{ $nasabah_pekerjaan->usia_nasabah }}, bertempat tinggal di {{ $nasabah_profil->alamat_ktp_nasabah }}
            berdasarkan Kartu
            Tanda Penduduk (KTP) nomor {{ $nasabah_profil->no_ktp_nasabah }} yang berlaku Seumur Hidup dalam hal ini
            bertindak untuk dan
            atas nama sendiri, dalam hal ini telah mendapatkan persetujuan dari Istri bernama
            {{ $nasabah_profil->nama_pasangan }}, pekerjaan
            {{ $nasabah_pekerjaan->jenis_pekerjaan_nasabah }} bertempat tinggal di
            {{ $nasabah_profil->alamat_ktp_nasabah }} berdasarkan Kartu Tanda Penduduk (KTP) nomor
            {{ $nasabah_profil->no_ktp_pasangan }} yang berlaku seumur Hidup, untuk selanjutnya disebut <span
                class="font-weight-bold">PIHAK
                KEDUA</span>
            <br><br>
            PIHAK PERTAMA dan PIHAK KEDUA selanjutnya disebut PARA PIHAK. PARA PIHAK terlebih dahulu menerangkan hal-hal
            sebagai berikut :
            <br><br>
            1.  Bahwa PIHAK KEDUA telah mengajukan permohonan fasilitas pembiayaan Multiguna syariah kepada PIHAK
            PERTAMA
            untuk ­­Kebutuhan {{ $pengajuan->keputusan_tujuan_penggunaan }} dan selanjutnya PIHAK PERTAMA menyetujui
            untuk menyediakan fasilitas pembiayaan sesuai dengan ketentuan dan syarat-syarat sebagaimana dinyatakan
            dalam perjanjian.
            <br><br>
            2.  Bahwa pembiayaan oleh PIHAK PERTAMA kepada PIHAK KEDUA diatur dan akan berlangsung menurut
            ketentuan-ketentuan sebagai berikut :
            <br><br>
            - PIHAK PERTAMA menyediakan fasilitas pembiayaan pembelian barang kepada PIHAK KEDUA;<br>
            - PIHAK KEDUA melakukan transaksi jual-beli dengan pemasok barang dengan dana yang berasal dari pembiayaan
            PIHAK PERTAMA dalam hal ini PIHAK PERTAMA memberikan kuasa kepada PIHAK KEDUA untuk mewakili PIHAK PERTAMA
            melakukan pembayaran kepada pemasok barang.<br>
            - Penyerahan barang dilakukan oleh pemasok barang langsung kepada PIHAK KEDUA dengan persetujuan dan
            sepengetahuan PIHAK PERTAMA dengan harga yang telah disepakati oleh PIHAK KEDUA dan PIHAK PERTAMA, tidak
            termasuk biaya-biaya yang timbul sehubungan dengan pelaksanaan Perjanjian.<br>
            - PIHAK KEDUA membayar Harga Beli barang ditambah Margin Keuntungan kepada PIHAK PERTAMA. Pembayaran
            tersebut dilakukan dengan cara mengangsur selama jangka waktu tertentu yang disepakati oleh PARA
            PIHAK.<br><br>

            Berdasarkan keterangan diatas PARA PIHAK sepakat untuk mengikatkan diri dalam AKAD PEMBIAYAAN Multiguna iB
            BAROKAH BERDASARKAN PRINSIP MURABAHAH ini.<br>
            Selanjutnya PARA PIHAK sepakat menuangkan akad dengan syarat-syarat serta ketentuan sebagai berikut:
            <br><br>
        </div>

        <div class="form-control font-weight-bold bg-white border-0" style="text-align: center; resize: none;">
            PASAL 1 <br>
            DEFINISI <br>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    1. Akad
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
                    Adalah perjanjian tertulis tentang fasilitas pembiayaan yang dibuat oleh PIHAK PERTAMA dengan PIHAK
                    KEDUA
                    memuat ketentuan & syarat – syarat yang disepakati, berikut perubahan – perubahan dan tambahan
                    (addendum)
                    sesuai dengan ketentuan syariah dan perundangan yang berlaku khususnya Undang-Undang Perbankan.
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    2. Pembiayaan
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
                    Penyediaan uang atau tagihan yang dipersamakan dengan itu berdasarkan persetujuan atau kesepakatan
                    antara PIHAK PERTAMA dengan PIHAK KEDUA yang mewajibkan PIHAK KEDUA untuk mengembalikan uang atau
                    tagihan tersebut setelah jangka waktu tertentu dengan margin keuntungan.
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
                    3. Angsuran
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    Sejumlah uang untuk pembayaran jumlah harga jual yang wajib dibayar secara bulanan oleh PIHAK KEDUA
                    sebagaimana ditentukan dalam akad ini.
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    4. Jatuh Tempo Pembayaran Angsuran
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
                    Tanggal PIHAK KEDUA berkewajiban membayar angsuran tiap bulan.
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    5. Agunan
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
                    Merupakan agunan yang bersifat materiil maupun immateriil untuk mendukung keyakinan PIHAK PERTAMA
                    atas kemampuan dan kesanggupan PIHAK KEDUA untuk melunasi pembiayaan sesuai Akad ini.
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    6. Murabahah
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
                    Adalah prinsip akad jual beli dalam bentuk pembiayaan antara PIHAK PERTAMA dan PIHAK KEDUA.
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    7. Barang
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
                    Barang yang dibeli PIHAK KEDUA dengan pendanaan yang berasal dari pembiayaan PIHAK PERTAMA adalah
                    halal berdasarkan Syariah dan tidak mengandung unsur maksiat, baik zatnya maupun cara perolehannya.
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    8. Harga Beli PIHAK PERTAMA
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
                    Jumlah uang yang dikeluarkan PIHAK PERTAMA untuk membiayai pembelian barang kebutuhan PIHAK KEDUA
                    yang besarnya sesuai perhitungan/analisa PIHAK PERTAMA.
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    9. Margin keuntungan PIHAK PERTAMA
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
                    Sejumlah uang yang merupakan keuntungan PIHAK PERTAMA sebagai akibat terjadinya jual-beli yang
                    ditetapkan dalam perjanjian.
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    10. Harga Jual PIHAK PERTAMA
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
                    Total jumlah harga yang harus dibayar/dilunasi PIHAK KEDUA kepada PARA PIHAK secara angsuran selama
                    jangka waktu yang disepakati.
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    11. Hari Kerja PIHAK PERTAMA
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
                    Hari kerja PIHAK PERTAMA sesuai jam kerja Bank Indonesia.
                </div>
            </div>
        </div>

        <div class="form-control font-weight-bold bg-white border-0" style="text-align: center; resize: none;">
            PASAL 2 <br>
            KETENTUAN UMUM <br>
        </div>
        <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
            1.PIHAK PERTAMA menyetujui menyediakan fasilitas pembiayaan Multiguna konsumtif berdasarkan prinsip
            murabahah kepada PIHAK KEDUA yang digunakan untuk {{ $pengajuan->keputusan_tujuan_penggunaan }} <br>
            2.Penyerahan Barang dilakukan oleh Pemasok langsung kepada PIHAK KEDUA dengan persetujuan dan
            sepengetahuan PIHAK PERTAMA. <br>
            3.Sesuai dengan Prinsip Syariah, PARA PIHAK sepakat bahwa Kewajiban PIHAK KEDUA kepada PIHAK PERTAMA
            adalah sebagaimana diatur dalam Akad ini.
            <br>
        </div>
        <div class="form-control font-weight-bold bg-white border-0" style="text-align: center; resize: none;">
            PASAL 3 <br>
            JUMLAH KEWAJIBAN PIHAK KEDUA <br>
        </div>

        @php
            $keputusan_harga_beli_bank = $pengajuan->keputusan_harga_beli_bank ?? 0;
            $keputusan_margin_bank = ($pengajuan->keputusan_margin_bank ?? 0) / 100;
            $keputusan_jangka_waktu = $pengajuan->keputusan_jangka_waktu_pembiayaan ?? 0;

            if ($keputusan_harga_beli_bank > 0 && $keputusan_margin_bank > 0 && $keputusan_jangka_waktu > 0) {
                $keputusan_harga_jual =
                    $keputusan_harga_beli_bank +
                    $keputusan_harga_beli_bank * ($keputusan_margin_bank * $keputusan_jangka_waktu);
            } else {
                $keputusan_harga_jual = 0;
            }

            $terbilang_keputusan_harga_jual = ucfirst(terbilang($keputusan_harga_jual)) . ' rupiah';
        @endphp

        <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
            PARA PIHAK sepakat bahwa jumlah kewajiban yang harus dibayar PIHAK KEDUA kepada PIHAK PERTAMA adalah
            sejumlah Rp {{ $keputusan_harga_jual }} Harga jual ({{ $terbilang_keputusan_harga_jual }}) dengan rincian
            sebagai berikut :
            <br>
        </div>
        <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
            - PEMBIAYAAN Multiguna/Harga Beli PIHAK PERTAMA
            <br>
        </div>
        <div class="row align-items-center my-0 py-0">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: right; resize: none;">
                    Harga Beli
                </div>
            </div>
            <div class="col-9">
                <input type="number" id="keputusan_harga_beli_bank" name="keputusan_harga_beli_bank"
                    class="form-control p-0 bg-white text-danger border-0 font-weight-bold"
                    value="{{ old('keputusan_harga_beli_bank', $pengajuan->keputusan_harga_beli_bank ?? '') }}">
            </div>
        </div>
        <div class="row" style="display: none">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    - Jangka waktu pembiayaan
                </div>
            </div>
            <div class="col-1">
                <input type="number" id="keputusan_jangka_waktu_pembiayaan" name="keputusan_jangka_waktu_pembiayaan"
                    class="form-control p-0 bg-white text-danger border-0 font-weight-bold"
                    value="{{ old('keputusan_jangka_waktu_pembiayaan', $pengajuan->keputusan_jangka_waktu_pembiayaan ?? '') }}">
            </div>

            <div class="col-8 d-flex align-items-center">
                <label class="mb-0 mr-2">Jangka Waktu (Bulan)</label>
                <span class="mr-1">:</span>
                <div id="keputusan_jangka_waktu_bulan" class="font-weight-bold text-dark">—</div>
            </div>
        </div>
        <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
            - Margin Keuntungan PIHAK PERTAMA DALAM PROSENTASE DAN RP
            <br>
        </div>
        <div class="row align-items-center my-0 py-0">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: right; resize: none;">
                    Margin Bank (%/bln)
                </div>
            </div>
            <div class="col-1">
                <input type="number" step="0.01" id="keputusan_margin_bank" name="keputusan_margin_bank"
                    class="form-control p-0 bg-white text-danger border-0 font-weight-bold"
                    value="{{ old('keputusan_margin_bank', $pengajuan->keputusan_margin_bank ?? '') }}">
            </div>

            <div class="col-4 d-flex align-items-center">
                <label class="mb-0 mr-2">Margin (%/Tahun)</label>
                <span class="mr-1">:</span>
                <div id="keputusan_margin_tahun_output" class="font-weight-bold text-dark">—</div>
            </div>

            <div class="col-4 d-flex align-items-center">
                <label class="mb-0 mr-2">Nominal</label>
                <span class="mr-1">:</span>
                <div id="keputusan_margin_nominal_output" class="font-weight-bold text-dark">—</div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    - Harga Jual PIHAK PERTAMA
                </div>
            </div>
            <div class="col-9">
                <div id="keputusan_harga_jual_output" class="font-weight-bold text-dark">—</div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    - Angsuran Tiap Bulan
                </div>
            </div>
            <div class="col-9">
                <div id="keputusan_angsuran_bank_output" class="font-weight-bold text-dark">—</div>
            </div>
        </div>
        <div class="form-control font-weight-bold bg-white border-0" style="text-align: center; resize: none;">
            <br>PASAL 4 <br>
            BIAYA-BIAYA <br>
        </div>
        <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
            1.    PIHAK KEDUA berjanji dan dengan ini mengikatkan diri untuk menanggung segala biaya yang diperlukan
            berkenaan dengan pelaksanaan Akad ini, sepanjang hal itu diberitahukan oleh PIHAK PERTAMA kepada PIHAK KEDUA
            sebelum ditandatanginya Akad ini, dan PIHAK KEDUA menyatakan persetujuannya.
            <br>
        </div>
        <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
            2.    Adapun biaya-biaya yang dimaksud oleh ayat 1 tersebut adalah:
            <br>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    a. Biaya Administrasi
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
                    <input type="number" id="biaya_administrasi" name="biaya_administrasi"
                        class="form-control p-0 bg-white text-danger border-0 font-weight-bold" value="500000">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    b. Biaya Materai
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
                    <input type="number" id="biaya_materai" name="biaya_materai"
                        class="form-control p-0 bg-white text-danger border-0 font-weight-bold" value="60000">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    c. Biaya Asuransi Jiwa,PHK, MACET
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
                    <input disabled type="number" id="biaya_asuransi_jiwa" name="biaya_asuransi_jiwa"
                        class="form-control p-0 bg-white text-dark border-0 font-weight-bold" value="">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    d. Biaya asuransi kebakaran
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
                    <input disabled type="number" id="biaya_asuransi_kebakaran" name="biaya_asuransi_kebakaran"
                        class="form-control p-0 bg-white text-dark border-0 font-weight-bold" value="">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    e. Blokir 1x Angsuran
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
                    <input disabled type="number" id="biaya_blokir_angsuran" name="biaya_blokir_angsuran"
                        class="form-control p-0 bg-white text-dark border-0 font-weight-bold" value="">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    Total Biaya
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
                    <div id="total_biaya_output" class="font-weight-bold text-dark">—</div>
                </div>
            </div>
        </div>
        <div class="form-control font-weight-bold bg-white border-0" style="text-align: center; resize: none;">
            <br>PASAL 5 <br>
            SYARAT-SYARAT REALISASI PEMBIAYAAN <br>
        </div>
        <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
            PIHAK PERTAMA menyetujui merealisasikan pembiayaan setelah PIHAK KEDUA memenuhi seluruh
            persyaratan-persyaratan yang ditentukan sebagai berikut:<br><br>
            1. Sesuai dengan Prinsip Syariah, PARA PIHAK sepakat bahwa Kewajiban PIHAK KEDUA kepada PIHAK PERTAMA
            terdiri dari komponen Harga Beli PIHAK PERTAMA ditambah Margin Keuntungan PIHAK PERTAMA, termasuk
            biaya-biaya yang timbul sehubungan dengan Pelaksanaan Akad ini.<br>
            2. PIHAK KEDUA wajib memenuhi seluruh persyaratan penarikan pembiayaan serta menyerahkan kepada PIHAK
            PERTAMA seluruh dokumen yang disyaratkan oleh PIHAK PERTAMA termasuk tetapi tidak terbatas pada dokumen
            bukti diri PIHAK KEDUA, dokumen kepemilikan agunan dan atau surat lainnya yang berkaitan dengan Akad ini dan
            pengikatan agunan, yang ditentukan dalam Surat Persetujuan Pemberian Pembiayaan (SP-3) dari PIHAK PERTAMA
            sebagaimana tercantum dalam Surat Persetujuan Pemberian Pembiayaan berikut perubahannya yang telah
            disepakati bersama.<br>
            3. Melakukan pengikatan Perjanjian Pembiayaan dan Agunan sesuai ketentuan yang berlaku.<br>
            4. Menyerahkan bukti-bukti kepemilikan dan/atau dokumen-dokumen yang terkait dengan agunan.<br>
            5. Menyerahkan Surat Permohonan Penarikan/Realisasi Pembiayaan pada PIHAK PERTAMA.<br>
            6. PIHAK KEDUA wajib membuka dan memelihara rekening giro atau tabungan pada PIHAK PERTAMA selama PIHAK
            KEDUA mempunyai Pembiayaan dari PIHAK PERTAMA.<br>
            7. Menyerahkan surat kuasa yang tidak dapat dicabut kembali untuk mendebet / mengkredit rekening atas nama
            PIHAK KEDUA sebagai kewajiban yang harus dipenuhi untuk kepentingan PIHAK PERTAMA.<br>
            8. Menyetor biaya realisasi sebagaimana yang tercantum pada Pasal 4.<br>
            9. Menyerahkan Surat Kuasa kepada PIHAK PERTAMA untuk mengurus dan menerima hasil klaim asuransi.<br>
            10. Menandatangani Akad ini dan perjanjian pengikatan agunan yang disyaratkan oleh PIHAK PERTAMA.<br>
            11. Sebagai bukti telah diserahkan setiap surat, dokumen, bukti kepemilikan atas agunan dan/atau akta
            dimaksud oleh PIHAK KEDUA kepada PIHAK PERTAMA, PIHAK PERTAMA berkewajiban untuk menerbitkan dan menyerahkan
            Tanda Bukti Penerimanya kepada PIHAK KEDUA.
        </div>
        <div class="form-control font-weight-bold bg-white border-0" style="text-align: center; resize: none;">
            <br>PASAL 6 <br>
            JANGKA WAKTU DAN CARA PEMBAYARAN<br>
        </div>
        <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
            1. PARA PIHAK sepakat bahwa pembayaran kembali seluruh Kewajiban PIHAK KEDUA kepada PIHAK PERTAMA
            sebagaimana tersebut pada Pasal 3 Perjanjian ini akan berlangsung dalam jangka waktu
            {{ $pengajuan->keputusan_jangka_waktu_pembiayaan * 12 }} bulan terhitung
            sejak dari tanggal Perjanjian ini ditandatangani dan berakhir sampai pembiayaan dinyatakan lunas oleh PIHAK
            PERTAMA.<br>
            2. PARA PIHAK sepakat bahwa pembayaran kembali Kewajiban PIHAK KEDUA kepada PIHAK PERTAMA akan dibayar
            sesuai dengan jadwal pembayaran angsuran sebagaimana diatur dalam Lampiran Perjanjian berjudul “Jadwal
            Pembayaran” yang merupakan bagian tidak terpisah dari Perjanjian dan karenanya sebelum seluruh Kewajiban
            PIHAK KEDUA dilunasi oleh PIHAK KEDUA, PIHAK KEDUA mengaku berutang kepada PIHAK PERTAMA.<br>
            3. Dalam hal jatuh tempo pembayaran kembali Kewajiban PIHAK KEDUA jatuh bukan pada Hari Kerja, maka PIHAK
            KEDUA bersedia untuk melakukan pembayaran pada Hari Kerja sebelumnya.<br>
            4. Berakhirnya jatuh tempo pembiayaan sebagaimana dimaksud diatas, tidak dengan sendirinya menyebabkan
            pembiayaan lunas sepanjang masih terdapat sisa kewajiban PIHAK KEDUA kepada PIHAK PERTAMA.<br>
            5. Setiap pembayaran yang diterima oleh PIHAK PERTAMA dari PIHAK KEDUA atas kewajiban pembiayaan dibuktikan
            oleh PIHAK PERTAMA kedalam rekening PIHAK KEDUA sesuai dengan mekanisme yang berlaku PIHAK PERTAMA
            berdasarkan catatan dan pembukuan yang ada pada PIHAK PERTAMA.<br>
            6. PIHAK PERTAMA tidak diwajibkan untuk mengirim surat-surat tagihan kepada PIHAK KEDUA, sehingga dengan
            atau tanpa adanya surat tagihan PIHAK KEDUA harus tetap memenuhi pembayaran angsuran.<br>
            7. PIHAK KEDUA diwajibkan untuk menyimpan dengan baik dan tertib semua bukti pembayaran yang berhubungan
            dengan pembayaran kewajiban Pembiayaannya dan wajib untuk memperlihatkan kepada PIHAK PERTAMA, apabila
            diminta.<br>
            8. Sepanjang mengenai kewajiban-kewajiban pembayaran PIHAK KEDUA kepada PIHAK PERTAMA yang timbul dari akad
            ini, maka PIHAK KEDUA dengan ini memberi kuasa kepada PIHAK PERTAMA untuk meminta dan menerima bagian dari
            gaji atau penerimaan lainnya yang menjadi hak PIHAK KEDUA dari pejabat yang berwenang membayarkan gaji dan
            atau penerimaan lainya dari intansi/kantor dimana PIHAK KEDUA bekerja untuk pembayaran angsuran/Utang
            pembiayaan murabahah PIHAK KEDUA kepada PIHAK PERTAMA, mendahului kewajiban PIHAK KEDUA kepada Pihak
            lain.<br>
            9. Ketentuan seperti dimaksud pada ayat (8) pasal ini tidak mengurangi pertanggungjawaban pribadi PIHAK
            KEDUA atas kewajiban-kewajiban pembayaran kepada PIHAK PERTAMA yang timbul dari akad ini, sehingga
            bagaimanapun PIHAK KEDUA berhak untuk apabila menganggap perlu melakukan penagihan langsung kepada PIHAK
            KEDUA atas kewajiban-kewajiban pembayaran tersebut.
        </div>
        <div class="form-control font-weight-bold bg-white border-0" style="text-align: center; resize: none;">
            <br>PASAL 7 <br>
            KEWAJIBAN PIHAK KEDUA<br>
        </div>
        <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
            Sehubungan dengan fasilitas pembiayaan oleh PIHAK PERTAMA kepada PIHAK KEDUA berdasarkan akad ini, PIHAK
            KEDUA berjanji dan dengan ini mengikatkan diri untuk :<br><br>
            1. Mengembalikan seluruh jumlah pokok pembiayaan selambat-lambatnya tanggal 1 setiap bulan berikut bagian
            dari pendapatan Margin PIHAK PERTAMA berdasarkan akad yang telah disepakati.<br>
            2. Memberikan laporan secara tertulis kepada PIHAK PERTAMA dalam hal terjadi perubahan terkait status
            kepegawaian PIHAK KEDUA, termasuk namun tidak terbatas manakala terjadi mutasi dan promosi yang berpengaruh
            kepada penghasilan PIHAK KEDUA.<br>
            3. Melakukan pembayaran atas semua tagihan atau tanggungan dari pihak ketiga melalui rekening PIHAK KEDUA di
            PIHAK PERTAMA.<br>
            4. Membebaskan seluruh harta kekayaan milik PIHAK KEDUA dari beban penjamin terhadap pihak lain, kecuali
            penjaminan bagi kepentingan PIHAK PERTAMA berdasarkan akad ini.<br>
            5. Mengelola dan mengadakan pencatatan tersendiri atas pengeluaran dana secara jujur dan amanah dengan
            itikad baik.<br>
            6. Menyerahkan kepada PIHAK PERTAMA setiap dokumen, data dan atau keterangan-keterangan yang diminta PIHAK
            PERTAMA kepada PIHAK KEDUA.
        </div>
        <div class="form-control font-weight-bold bg-white border-0" style="text-align: center; resize: none;">
            <br>PASAL 8<br>
            DENDA KETERLAMBATAN<br>
        </div>
        <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
            1. Dalam hal terjadi keterlambatan pembayaran oleh PIHAK KEDUA kepada PIHAK PERTAMA, maka PIHAK KEDUA
            berjanji dan dengan ini mengikatkan diri pada PIHAK PERTAMA sebesar Rp 0 (Nol Rupiah) atau sesuai dengan
            ketentuan yang berlaku pada PIHAK PERTAMA untuk setiap hari keterlambatan, terhitung sejak saat kewajiban
            pembayaran tersebut jatuh tempo sampai dengan tanggal dilaksanakannya pembayaran kembali, dan untuk setiap
            kali keterlambatan, yang mana akan digunakan PIHAK PERTAMA sebagai dana kebijakan/sosial.<br>
            2. Pengenaan denda keterlambatan maupun penghapusan denda dari PIHAK PERTAMA kepada PIHAK KEDUA sepenuhnya
            menjadi kewenangan PIHAK PERTAMA.
        </div>
        <div class="form-control font-weight-bold bg-white border-0" style="text-align: center; resize: none;">
            <br>PASAL 9<br>
            GANTI RUGI<br>
        </div>
        <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
            1. Dalam hal terjadi keterlambatan pembayaran angsuran pembiayaan oleh PIHAK KEDUA kepada PIHAK PERTAMA,
            maka PIHAK KEDUA bersedia membayar ganti rugi atas biaya-biaya rill yang telah dikeluarkan PIHAK PERTAMA
            dalam rangka penagihan angsuran tersebut.<br>
            2. Komponen biaya-biaya rill sebagaimana pada pasal diatas meliputi penggantian biaya-biaya transportasi dan
            akomodasi, telekomunikasi, korespondensi dan tenaga kerja yang telah dikeluarkan PIHAK PERTAMA.<br>
            3. Pengenaan ganti rugi keterlambatan maupun penghapusan ganti rugi dari PIHAK PERTAMA kepada PIHAK KEDUA
            sepenuhnya menjadi kewenangan PIHAK PERTAMA.
        </div>
        <div class="form-control font-weight-bold bg-white border-0" style="text-align: center; resize: none;">
            <br>PASAL 10<br>
            PELUNASAN DIPERECEPAT<br>
        </div>
        <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
            1. PIHAK KEDUA diperkenankan melakukan pelunasan Pembiayaan Multiguna seluruhnya bersama-sama dengan
            kewajiban
            lain yang harus dibayar lebih cepat/awal dari tanggal pembayaran pelunasan /tanggal jatuh tempo kepada PIHAK
            PERTAMA.<br>
            2. Jika PIHAK KEDUA akan melakukan pelunasan dipercepat atas setiap bagian dari Harga Jual, maka PIHAK KEDUA
            wajib mengirimkan surat pemberitahuan kepada PIHAK PERTAMA minimal 5 (lima) Hari Kerja sebelumnya.<br>
            3. Setelah menerima surat pemberitahuan tersebut, PIHAK PERTAMA akan memberitahu PIHAK KEDUA secara tertulis
            informasi mengenai total jumlah yang terhutang kepada PIHAK PERTAMA berdasarkan Perjanjian pembiayaan
            termasuk seluruh biaya, beban, dan pengeluaran aktual, PIHAK KEDUA berkewajiban untuk melunasi seluruh
            jumlah yang terhutang kepada tersebut sebagaimana ditetapkan dalam Pemberitahuan Pembayaran dari PIHAK
            PERTAMA.<br>
            4. PIHAK KEDUA diperkenankan melakukan pembayaran dipercepat seluruhnya dengan biaya pelunasan dipercepat
            sesuai dengan prosedur dan ketentuan yang berlaku pada PIHAK PERTAMA.
        </div>
        <div class="form-control font-weight-bold bg-white border-0" style="text-align: center; resize: none;">
            <br>PASAL 11<br>
            TEMPAT PEMBAYARAN<br>
        </div>
        <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
            1. Setiap pembayaran kembali/pelunasan Kewajiban PIHAK KEDUA oleh PIHAK KEDUA kepada PIHAK PERTAMA dilakukan
            di kantor PIHAK PERTAMA atau di tempat lain dan cara lain yang ditentukan oleh PIHAK PERTAMA, atau dilakukan
            melalui rekening yang dibuka oleh dan atas nama PIHAK KEDUA di PIHAK PERTAMA.<br>
            2. Dalam hal pembayaran dilakukan melalui rekening PIHAK KEDUA di PIHAK PERTAMA, maka dengan ini PIHAK KEDUA
            memberi kuasa yang tidak dapat berakhir karena sebab-sebab yang ditentukan dalam Pasal 1813 Kitab
            Undang-Undang Hukum Perdata yang berbunyi “Pemberian kuasa berakhir: dengan penarikan kembali kuasa penerima
            kuasa; dengan pemberitahuan penghentian kuasanya oleh penerima kuasa; dengan meninggalnya, pengampuan atau
            pailitnya, baik pemberi kuasa maupun penerima kuasa” kepada PIHAK PERTAMA, untuk mendebet rekening PIHAK
            KEDUA guna membayar/melunasi Kewajiban PIHAK KEDUA Yang Dibayar Tangguh.
        </div>
        <div class="form-control font-weight-bold bg-white border-0" style="text-align: center; resize: none;">
            <br>PASAL 12<br>
            AGUNAN<br>
        </div>
        <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
            Untuk menjamin tertibnya pelaksanaan pembayaran kembali/pelunasan Pembiayaan dan Margin Keuntungan tepat
            pada waktu yang telah disepakati PARA PIHAK berdasarkan Akad ini, maka PIHAK KEDUA berjanji dan dengan ini
            mengikatkan diri untuk menyerahkan agunan dan membuat pengikatan agunan kepada PIHAK PERTAMA sesuai dengan
            peraturan perundang-undangan yang berlaku, yang merupakan bagian yang tidak terpisahkan dari Akad ini. Jenis
            agunan yang diserahkan berupa: <br>
        </div>

        {{-- Jaminan --}}
        <div class="form-group row align-items-center font-weight-bold px-4 my-0 py-0">
            <label class="col-6 col-form-label mb-0">Jaminan Utama</label>
        </div>

        @php
            $options = [
                'sk_pengangkatan_pegawai_tetap' => ['--', 'ADA (1)', 'TIDAK ADA (0)'],
                'sk_jabatan_terakhir_terkini' => ['--', 'ADA (1)', 'TIDAK ADA (0)'],
            ];
        @endphp

        @foreach ($options as $field => $values)
            <div class="row px-4 mt-0 mb-2 py-0">
                <div class="col-12">
                    <div class="form-group row align-items-center my-0 py-0">
                        <label class="col-2 col-form-label mb-0">{{ ucwords(str_replace('_', ' ', $field)) }}</label>
                        <div class="col-1 text-right px-0">:</div>
                        <div class="col-9">
                            <select name="{{ $field }}" id="{{ $field }}"
                                class="form-control p-0 bg-white text-danger border-0 font-weight-bold">
                                @foreach ($values as $value)
                                    <option value="{{ $value }}"
                                        {{ old($field, $pengajuan_collateralsk->$field ?? '') == $value ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="form-control font-weight-bold bg-white border-0" style="text-align: center; resize: none;">
            <br>PASAL 13<br>
            CIDERA JANJI<br>
        </div>
        <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
            PIHAK PERTAMA berhak untuk menuntut/menagih pembayaran dari PIHAK KEDUA atau siapa pun juga yang memperoleh
            hak darinya, atas sebagian atau seluruh jumlah utang PIHAK KEDUA kepada PIHAK PERTAMA berdasarkan
            Perjanjian, untuk dibayar dengan seketika dan sekaligus, tanpa diperlukan adanya surat pemberitahuan, surat
            teguran, atau surat lainnya, apabila terjadi salah satu hal atau peristiwa tersebut di bawah ini:<br><br>
            1. PIHAK KEDUA tidak melaksanakan kewajiban pembayaran/pelunasan Kewajiban PIHAK KEDUA pada waktu yang
            diperjanjikan sesuai dengan tanggal jatuh tempo pembayaran sebagaimana tercantum pada Lampiran Perjanjian
            berjudul Jadwal Pembayaran.<br>
            2. Dokumen atau keterangan yang diserahkan/diberikan PIHAK KEDUA kepada PIHAK PERTAMA terkait dengan
            pemberian fasilitas pembiayaan Multiguna konsumtif adalah palsu, tidak sah, atau tidak benar.<br>
            3. PIHAK KEDUA tidak memenuhi dan/atau melanggar ketentuan-ketentuan tersebut dalam Pasal 3 Perjanjian.<br>
            4. PIHAK KEDUA dinyatakan dalam keadaan pailit, ditaruh di bawah pengampuan, dibubarkan dan/atau
            likuidasi.<br>
            5. PIHAK KEDUA atau pihak ketiga telah memohon kepailitan terhadap PIHAK KEDUA.<br>
            6. Apabila karena sesuatu sebab, sebagian atau seluruh Akta dinyatakan batal berdasarkan putusan Pengadilan
            atau Badan Arbitrase.
        </div>
        <div class="form-control font-weight-bold bg-white border-0" style="text-align: center; resize: none;">
            <br>PASAL 14<br>
            AKIBAT CIDERA JANJI<br>
        </div>
        <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
            1. Apabila PIHAK KEDUA tidak melaksanakan pembayaran seketika dan sekaligus karena suatu hal atau peristiwa
            tersebut dalam Pasal 13 Perjanjian, maka PIHAK PERTAMA berhak menjual barang agunan sesuai dengan peraturan
            yang berlaku, dan uang hasil penjualan barang agunan tersebut digunakan PIHAK PERTAMA untuk
            membayar/melunasi Kewajiban PIHAK KEDUA atau sisa Kewajiban PIHAK KEDUA.<br>
            2. Apabila penjualan barang agunan dilakukan dibawah tangan maka PIHAK KEDUA dan PIHAK PERTAMA sepakat,
            harga penjualan barang agunan ditetapkan oleh PIHAK PERTAMA dengan harga yang wajar menurut harga pasar
            ketika barang agunan dijual.<br>
            3. Jika hasil penjualan barang agunan tidak mencukupi untuk membayar Kewajiban PIHAK KEDUA, maka PIHAK KEDUA
            wajib melunasi sisa Kewajiban PIHAK KEDUA yang belum dibayar sampai lunas. Apabila hasil penjualan barang
            agunan melebihi jumlah Kewajiban PIHAK KEDUA atau sisa Kewajiban PIHAK KEDUA, maka PIHAK PERTAMA wajib
            menyerahkan kelebihan tersebut kepada PIHAK KEDUA.<br>
            4. Apabila PIHAK KEDUA tidak melaksanakan pembayaran seketika dan sekaligus karena suatu hal atau peristiwa
            tersebut dalam Pasal 13 Perjanjian, PIHAK PERTAMA juga berhak melakukan tindakan-tindakan seperti: Penandaan
            Atas Agunan, Surat Teguran, Surat Peringatan, dan tindakan-tindakan lain yang dianggap perlu untuk dilakukan
            dengan tujuan dapat menyelesaikan pembiayaan bermasalah yang diakibatkan Cedera Janji atau wan prestasi oleh
            PIHAK KEDUA.
        </div>
        <div class="form-control font-weight-bold bg-white border-0" style="text-align: center; resize: none;">
            <br>PASAL 15<br>
            PERNYATAAN DAN JAMINAN PIHAK KEDUA<br>
        </div>
        <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
            PIHAK KEDUA menyatakan dengan sebenar-benarnya dan menjamin kepada PIHAK PERTAMA:<br><br>
            1. PIHAK KEDUA adalah perseorangan/Badan Usaha yang tunduk pada hukum Negara Republik Indonesia.<br>
            2. PIHAK KEDUA berhak dan berwenang sepenuhnya untuk menandatangani Perjanjian dan seluruh dokumen yang
            menyertainya.<br>
            3. PIHAK KEDUA tidak akan mengalihkan, menjaminkan dan/atau memberi kuasa kepada orang lain untuk
            mengalihkan dan/atau menjaminkan atas sebagian atau seluruh dari hartanya, termasuk tetapi tidak terbatas
            pada piutang dan/atau klaim asuransi, tidak dalam keadaan bersengketa, gugat–menggugat di muka atau di luar
            lembaga peradilan atau arbitrase, berutang pada pihak lain, diselidik atau dituntut oleh pihak yang
            berwajib, baik pada saat ini atau pun selama Jangka Waktu Perjanjian, yang dapat mempengaruhi asset, keadaan
            keuangan, dan/atau mengganggu jalannya usaha PIHAK KEDUA.<br>
            4. PIHAK KEDUA menjamin bahwa terhadap pembelian Barang dari Pemasok, Barang bebas dari penyitaan,
            pembebanan, tuntutan gugatan atau hak untuk menebus kembali.<br>
            5. PIHAK KEDUA akan menyerahkan kepada PIHAK PERTAMA, agunan tambahan yang dinilai cukup oleh PIHAK PERTAMA
            selama kewajiban membayar Kewajiban PIHAK KEDUA atau sisa Kewajiban PIHAK KEDUA kepada PIHAK PERTAMA belum
            lunas.<br>
            6. PIHAK KEDUA bersedia untuk tidak melakukan upaya hukum atas tindakan-tindakan PIHAK PERTAMA seperti yang
            tercantum dalam pasal 13 (4) diatas, karena tindakan-tindakan diatas memang dianggap perlu untuk dilakukan
            guna menyelesaikan pembiayaan bermasalah akibat Cidera Janji oleh PIHAK KEDUA dan bukan merupakan tindakan
            pencemaran nama baik atau tindakan yang dipersamakan dengan itu.
        </div>
        <div class="form-control font-weight-bold bg-white border-0" style="text-align: center; resize: none;">
            <br>PASAL 16<br>
            PERNYATAAN DAN JAMINAN PIHAK KEDUA<br>
        </div>
        <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
            Selama jangka waktu Perjanjian, PIHAK KEDUA tidak akan melakukan sebagian atau seluruhnya dari
            perbuatan-perbuatan sebagai berikut, kecuali setelah mendapatkan persetujuan tertulis dari PIHAK
            PERTAMA:<br><br>
            1. Menjual dan/atau menyewakan baik sebagian atau seluruh asset PIHAK KEDUA yang nyata-nyata akan
            mempengaruhi kemampuan atau cara membayar atau melunasi Kewajiban PIHAK KEDUA atau sisa Kewajiban PIHAK
            KEDUA.<br>
            2. Mengajukan pembiayaan baru kepada pihak ketiga tanpa sepengetahuan dan persetujuan PIHAK PERTAMA.<br>
            3. Memindahkan kedudukan/lokasi barang maupun barang agunan dari kedudukan/lokasi Barang itu semula atau
            sepatutnya berada, dan/atau mengalihkan hak atas barang atau barang agunan yang bersangkutan kepada pihak
            lain.<br>
            4. Mengajukan permohonan kepada yang berwenang untuk menunjuk eksekutor, kurator, likuidator atau pengawas
            atas sebagian atau seluruh harta kekayaannya.
        </div>
        <div class="form-control font-weight-bold bg-white border-0" style="text-align: center; resize: none;">
            <br>PASAL 17<br>
            RISIKO<br>
        </div>
        <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
            1. PIHAK KEDUA atas beban dan tanggung jawabnya, berkewajiban melakukan pemeriksaan, baik terhadap keadaan
            fisik obyek akad maupun sahnya bukti-bukti, surat-surat dan atau dokumen-dokumen yang berkaitan dengan
            kepemilikan atau hak-hak lainnya atas Obyek Akad dan barang-barang yang dijaminkan, sehingga karena itu
            PIHAK KEDUA berjanji untuk menanggung segala tuntutan, gugatan dan atau ganti rugi yang datang dari pihak
            manapun dan atau berdasar alasan apa pun atas risiko dimaksud.<br>
            2. Dalam hal di kemudian hari diketahui atau timbul cacat, kekurangan atau keadaan/masalah apapun yang
            menyangkut Obyek Akad dan atau pelaksanaan Akta Jual Beli Obyek Akad, jual beli yang mana seluruh atau
            sebagian dibiayai dengan Pembiayaan ini, maka segala risiko sepenuhnya menjadi tanggung jawab PIHAK KEDUA
            kecuali terdapat kesalahan dari pihak Bank.<br>
            3. Adanya cacat, kekurangan atau masalah yang timbul sebagaimana dimaksud dalam ayat 2 Pasal ini, tidak
            dapat dijadikan alasan untuk mengingkari, melalaikan atau menunda pelaksanaan kewajiban PIHAK KEDUA kepada
            PIHAK PERTAMA sesuai akad, termasuk namun tidak terbatas kepada pembayaran angsuran.<br>
            4. Dalam hal PIHAK PERTAMA mengambil tindakan ataupun mengambil upaya pengamanan karena adanya cacat dan
            kekurangan serta masalah yang timbul atas keadaan dari status Obyek Akad tersebut, maka hal ini adalah
            semata-mata sebagai tindakan PIHAK PERTAMA dalam rangka mengamankan jumlah Pembiayaan yang diberikan dan
            atau mengamankan Agunan yang bersangkutan.<br>
            5. PIHAK KEDUA tidak bertanggung jawab terhadap penyelesaian surat/dokumen atas Obyek Akad yang dibeli
            dengan akad ini, termasuk namun tidak terbatas pada Sertipikat Tanah, Ijin Mendirikan Bangunan (IMB) dan
            surat-surat lainnya yang menjadi tanggung jawab Pemasok.
        </div>
        <div class="form-control font-weight-bold bg-white border-0" style="text-align: center; resize: none;">
            <br>PASAL 18<br>
            ASURANSI<br>
        </div>
        <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
            1. Selama jangka waktu pembiayaan atau seluruh utang Murabahah belum dilunasi, PIHAK KEDUA wajib untuk
            menutup asuransi sebagaimana yang tercantum dalam Pasal 4.<br>
            2. Penutupan asuransi sebagaimana dimaksud dalam ayat (1) dilakukan dengan syarat Banker’s Clause pada
            perusahaan asuransi berdasarkan Syariah yang disetujui oleh PIHAK PERTAMA untuk nilai dan jenis risiko dan
            perluasannya, premi asuransi yang menjadi beban PIHAK KEDUA.<br>
            3. Kewajiban penutupan asuransi atas pembiayaan dan/atau agunan pembiayaan berlaku untuk selama jangka waktu
            pembiayaan atau selama jumlah seluruh kewajiban pembiayaan Multiguna yang diberikan oleh PIHAK PERTAMA
            kepada
            PIHAK KEDUA belum dilunasi, dengan demikian setiap jangka waktu suatu pertanggungan berakhir, maka PIHAK
            KEDUA wajib untuk melakukan penutupan pertanggungan lagi/memperpanjang jangka waktu pertanggungan sepenuhnya
            atas biaya PIHAK KEDUA.<br>
            4. PIHAK KEDUA wajib melaksanakan hak-hak klaimnya secara tetap dan penuh dan wajib memberitahukan kepada
            PIHAK PERTAMA perkembangannya untuk memungkinkan PIHAK PERTAMA mengetahui sepenuhnya setiap kerugian yang
            diminta dan satuan atas klaim sesuai dengan klaimnya.<br>
            5. Dalam hal terjadi risiko yang dipertanggungkan sebagaimana tercantum dalam polis asuransi atas harta yang
            dijaminkan kepada PIHAK PERTAMA dan kemudian dibayarkan hak klaimnya, maka PIHAK PERTAMA berhak untuk
            memperhitungkan hasil klaim tersebut dengan utang PIHAK KEDUA.
        </div>
        <div class="form-control font-weight-bold bg-white border-0" style="text-align: center; resize: none;">
            <br>PASAL 19<br>
            KEADAAN MEMAKSA <span class="font-italic">(FORCE MAJEURE)</span><br>
        </div>
        <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
            Apabila terjadi kejadian-kejadian force majeure di bawah ini:<br><br>
            1. Yang dianggap force majeure adalah Bencana alam (gempa bumi, longsor, letusan/ledakan gunung merapi dan
            banjir), kebakaran, perang, huru hara, pemberontakan dan epidemi (wabah penyakit), tindakan pemerintah di
            bidang moneter yang langsung mengakibatkan kerugian luar biasa.<br>
            2. Pengambilalihan kegiatan badan usaha oleh Pemerintah Republik Indonesia terhadap salah satu dari PARA
            PIHAK, yang mengakibatkan pihak dan/atau kantor perwakilan/cabang pihak yang mengalami force majeure
            tersebut tidak dapat menjalankan usahanya dan/atau melanjutkan kewajibannya menurut perjanjian ini, baik
            untuk seterusnya atau untuk sementara waktu, maka pihak yang mengalami force majeure tersebut akan segera
            memberitahukan secara tertulis dalam waktu paling lambat 14 (empat belas) hari kalender kepada pihak lain
            dan PARA PIHAK akan bertemu untuk membicarakan mengenai:<br>
            &nbsp;&nbsp;&nbsp;&nbsp;a. force majeure yang terjadi;<br>
            &nbsp;&nbsp;&nbsp;&nbsp;b. akibat dan besarnya pengaruh force majeure terhadap pelaksanaan kewajiban pihak
            dan/atau kantor perwakilan pihak yang mengalami force majeure;<br>
            &nbsp;&nbsp;&nbsp;&nbsp;c. usaha penanggulangan yang telah maupun akan dilakukan oleh pihak dan/atau kantor
            perwakilan pihak yang mengalami force majeure;<br><br>
            untuk kelancaran pekerjaan, penentuan keadaan memaksa dalam hal ini untuk segera tercapai kesepakatan atas
            hal tersebut di atas dan penyelesaian yang memuaskan PARA PIHAK.
        </div>
        <div class="form-control font-weight-bold bg-white border-0" style="text-align: center; resize: none;">
            <br>PASAL 20<br>
            PENYELESAIAN PERSELISIHAN<br>
        </div>
        <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
            1. Apabila terjadi perselisihan sebagai akibat dari pelaksanaan perjanjian ini, PARA PIHAK sepakat untuk
            menyelesaikannya terlebih dahulu secara musyawarah untuk mencapai mufakat, jika tidak tercapai kesepakatan
            paling lambat dalam jangka waktu 30 (tiga puluh) hari kerja maka PARA PIHAK sepakat untuk menyelesaikannya
            melalui Pengadilan.<br>
            2. Untuk perjanjian ini dan segala akibatnya PARA PIHAK sepakat untuk memilih domisili hukum yang tetap dan
            tidak berubah di Kantor Kepaniteraan Pengadilan Agama, atau pengadilan negeri, atau Badan Arbitrase
            setempat.
        </div>
        <div class="form-control font-weight-bold bg-white border-0" style="text-align: center; resize: none;">
            <br>PASAL 21<br>
            KORESPONDENSI<br>
        </div>
        <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
            Semua pemberitahuan yang harus diberikan oleh PARA PIHAK wajib disampaikan dengan mengirimkan pemberitahuan
            tersebut melalui media elektronik tercatat, pos tercatat, atau dikirim langsung dengan disertai bukti tanda
            terima ke alamat PARA PIHAK yang tersebut di bawah ini atau alamat lain dengan memberitahukan secara
            tertulis terlebih dahulu.
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control font-weight-bold bg-white border-0" style="text-align: left; resize: none;">
                    PIHAK PERTAMA
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
                    BANK SYARIAH UMSIDA
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    PIMPINAN
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
                    Ahmad Baraja, S.EI, M.SEI
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    A l a m a t
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
                    Jl. Mojopahit No.666 B, Sidowayah, Celep, Kec. Sidoarjo, Kabupaten Sidoarjo, Jawa Timur 61215
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    Telepon / Fax
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
                    031-8945444 / 08113091000
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control font-weight-bold bg-white border-0" style="text-align: left; resize: none;">
                    PIHAK KEDUA
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
                    {{ strtoupper($nasabah_profil->nama_nasabah) }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    Alamat
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
                    {{ $nasabah_profil->alamat_ktp_nasabah }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    Telepon/ Fax
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
                    {{ $nasabah_profil->notelp_hp_nasabah }}
                </div>
            </div>
        </div>
        <div class="form-control bg-white border-0" style="text-align: center; resize: none;">
            Atau ke alamat maupun nomor lain sesuai pemberitahuan dari masing-masing pihak. Jika tidak disampaikan
            secara khusus, tanggal dari tiap pemberitahuan akan dianggap sebagai (i) tanggal penerimaan jika disampaikan
            secara personil (ii) 7 (tujuh) hari kalender setelah disampaikan melalui pos/surat, atau (iii) tanggal
            pengiriman jika disampaikan melalui facsimile, yang mana terjadi terlebih dahulu.<br><br>
            PARA PIHAK dapat merubah alamat dengan pemberitahuan kepada PARA PIHAK.
        </div>
        <div class="form-control font-weight-bold bg-white border-0" style="text-align: center; resize: none;">
            <br>PASAL 22<br>
            KETENTUAN LAIN-LAIN<br>
        </div>
        <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
            1.     Perjanjian ini dapat berakhir dengan sendirinya apabila ada ketentuan perundang-undangan dan/ atau
            kebijakan Pemerintah yang tidak memungkinkan berlangsungnya Perjanjian ini;<br><br>
            2.     Kesepakatan dan tugas serta tanggung jawab PARA PIHAK berdasarkan Perjanjian ini tidak berakhir
            karena berhalangan tetapnya salah satu Pihak yang mewakili dan/ atau berakhirnya jabatan PARA PIHAK yang
            mewakili dalam Perjanjian, tetapi tetap wajib untuk dipenuhi dan ditaati oleh pengganti Hak dan Kewajiban
            (Rechtsopvolgers) dari masing-masing pihak.<br><br>
            3.     Segala perubahan manfaat, biaya, risiko, syarat dan ketentuan produk dan /atau layanan, Bank akan
            menyampaikan kepada nasabah paling lambat 30 (tiga puluh) hari kerja sebelum perubahan dimaksud
            diberlakukan.<br><br>
            4.     Perjanjian ini telah disesuaikan dengan Ketentuan Peraturan Perundang-Undangan termasuk ketentuan
            Peraturan Otoritas Jasa Keuangan.
        </div>
        <div class="form-control font-weight-bold bg-white border-0" style="text-align: center; resize: none;">
            <br>PASAL 23<br>
            PENUTUP<br>
        </div>
        <div class="form-control mb-3 pb-3 bg-white border-0" style="text-align: justify; resize: none;">
            1.     PARA PIHAK dengan ini menyatakan bahwa yang menandatangani Perjanjian ini dan atau surat-surat
            lainnya/ lampirannya, berhak dan berwenang mewakili masing-masing pihak sesuai ketentuan dalam Anggaran
            Dasar dan atau keputusan/ ketentuan yang berlaku pada masing-masing Pihak;<br><br>
            2.     Apabila ada hal-hal yang belum diatur atau belum cukup diatur dalam Perjanjian ini maka PIHAK KEDUA
            dan PIHAK PERTAMA akan mengaturnya bersama secara musyawarah untuk mufakat dalam suatu addendum.<br><br>
            3.     Tiap addendum dan lampiran dari Perjanjian merupakan satu kesatuan yang tidak terpisahkan dari
            Perjanjian.<br><br>
            4.     Surat Perjanjian dibuat dan ditanda tangani oleh PARA PIHAK pada tanggal dan tempat sebagaimana
            tersebut diatas, dalam rangkap 2 (dua) di atas kertas yang bermeterai cukup yang masing-masing berlaku
            sebagai aslinya bagi kepentingan masing-masing pihak.
        </div>
        <div class="row pb-4">
            <div class="col-4">
                <div class="form-control font-weight-bold bg-white border-0" style="text-align: left; resize: none;">
                    PIHAK PERTAMA <br>
                    PT BANK SYARIAH UMSIDA
                </div>
            </div>
            <div class="col-8">
                <div class="form-control font-weight-bold bg-white border-0" style="text-align: left; resize: none;">
                    PIHAK KEDUA
                </div>
            </div>
        </div>
        <div class="row pt-4">
            <div class="col-4">
                <div class="form-control font-weight-bold bg-white border-0" style="text-align: left; resize: none;">
                    Ahmad Baraja, S.EI, MS.SEI <br>
                    Pimpinan
                </div>
            </div>
            <div class="col-4">
                <div class="form-control font-weight-bold bg-white border-0" style="text-align: left; resize: none;">
                    {{ ucwords(strtolower($nasabah_profil->nama_nasabah)) }} <br>
                    Nasabah
                </div>
            </div>
            <div class="col-4">
                <div class="form-control font-weight-bold bg-white border-0" style="text-align: left; resize: none;">
                    {{ ucwords(strtolower($nasabah_profil->nama_pasangan)) }} <br>
                    Istri
                </div>
            </div>
        </div>


        <div class="form-control mt-5 pt-5 mb-3 pb-3 bg-white border-0" style="text-align: justify; resize: none;">
            Lampiran 9. Akad Pembiayaan Multiguna iB Barokah Berdasarkan Prinsip Ijarah
        </div>
        <h6 class="text-center font-weight-bold mb-1">
            AKAD PEMBIAYAAN MULTIGUNA iB BAROKAH
        </h6>
        <h6 class="text-center font-weight-bold mb-3">
            BERDASARKAN PRINSIP IJARAH
        </h6>

        <div class="text-center">
            <input type="text"
                class="form-control text-center bg-white text-danger border-0 font-weight-bold w-100"
                value="{{ 'Nomor: ' . sprintf('%04d', $pengajuan->id ?? 0) . '/' . strtoupper($nasabah_profil->nama_nasabah ?? '-') . '/Multiguna/SYARIAH' }}">
        </div>
        <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
            Pada hari ini, {{ $hari }}. tanggal {{ $tgl }} {{ strtoupper($bulan) }}
            {{ $tahun }}. di Surabaya, PARA PIHAK yang bertanda-tangan dibawah ini:<br><br>

            1. ……………., Pemimpin PT Bank Pembangunan Daerah Jawa Timur Tbk Cabang Syariah ……………. dalam hal ini bertindak
            menjalankan jabatannya tersebut, untuk dan atas nama serta sah mewakili Direksi PT Bank Pembangunan Daerah
            Jawa Timur Tbk yang berkedudukan di Surabaya, Jalan Basuki Rahmad Nomor 98-104, melalui Kantor Cabang
            Syariah di ………….., Jalan …………… Nomor ………., berdasarkan Surat Keputusan Direksi Nomor ………………… tanggal
            ……………….. tentang ……………. serta Surat Kuasa Direksi PT Bank Pembangunan Daerah Jawa Timur Tbk No. ……………
            tanggal …………, untuk selanjutnya disebut PIHAK PERTAMA;<br>
            2. ………………, pekerjaan …………. usia …….. tahun, bertempat tinggal di ………….. berdasarkan Kartu Tanda Penduduk
            (KTP) nomor ………….. yang berlaku Seumur Hidup dalam hal ini bertindak untuk dan atas nama sendiri, dalam hal
            ini telah mendapatkan persetujuan dari Suami/Istri bernama ………………, pekerjaan …………. usia …….. tahun,
            bertempat tinggal di ………….. berdasarkan Kartu Tanda Penduduk (KTP) nomor ………….. yang berlaku Seumur Hidup,
            untuk selanjutnya disebut <span class="font-weight-bold">PIHAK KEDUA</span><br><br>
            1.    PIHAK PERTAMA menyediakan fasilitas pembiayaan pembayaran jasa kepada Penyedia Jasa pendidikan/jasa
            kesehatan/jasa pariwisata rohani.<br>
            2.    Bahwa PIHAK KEDUA telah mengajkan permohonan kepada PIHAK PERTAMA untuk melakukan proses penyelesaian
            pembayaran kewajiban PIHAK KEDUA kepada PIHAK LAIN/PIHAK KETIGA untuk mendapatkan manfaat berupa jasa
            pendidikan/jasa kesehatan/jasa pariwisata rohani dari Penyedia Jasa.<br>
            3.    PIHAK KEDUA melakukan transaksi pembayaran kepada penyedia jasadengan dana yang berasal dari
            pembiayaan PIHAK PERTAMA dalam hal ini PIHAK PERTAMA memberikan kuasa kepada PIHAK KEDUA untuk mewakili
            PIHAK PERTAMA melakukan pembayaran kepada Penyedia Jasa.<br>
            4.    Penyerahan fasilitas jasa dilakukan oleh penyedia jas langsung kepada PIHAK KEDUA dengan persetujuan
            dan sepengetahuan PIHAK PERTAMA dengan harga yang telah disepakati oleh PARA PIHAK, tidak termasuk
            biaya-biaya yang timbul sehubungan dengan pelaksanaan Perjanjian.<br>
            5.    Atas manfaat yang diterima oleh PIHAK KEDUA, PIHAK PERTAMAmengenakan ujroh yang besarnya sebagaimana
            tertuang dalam Perjanjian ini.<br>
            6.    PIHAK KEDUA membayar pokok iaya jasa ditambah ujroh kepada PIHAK PERTAMA. Pembayaran tersebut
            dilakukan dengan cara mengangsur selama jangka waktu tertentu yang disepakati oleh PARA PIHAK.<br>
            Berdasarkan keterangan diatas PARA PIHAK sepakat untuk mengikatkan diri dalam AKAD PEMBIAYAAN Multiguna iB
            BAROKAH BERDASARKAN PRINSIP IJARAH ini.<br>
            Selanjutnya PARA PIHAK sepakat menuangkan akad dengan syarat-syarat serta ketentuan sebagai berikut:
        </div>

        <div class="form-control font-weight-bold bg-white border-0" style="text-align: center; resize: none;">
            <br>PASAL 1<br>
            DEFINISI<br>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    1. Akad
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
                    Adalah perjanjian tertulis tentang fasilitas pembiayaan yang dibuat oleh PIHAK PERTAMA dengan PIHAK
                    KEDUA memuat ketentuan & syarat – syarat yang disepakati, berikut perubahan – perubahan dan tambahan
                    (addendum) sesuai dengan ketentuan syariah dan perundangan yang berlaku khususnya Undang-Undang
                    Perbankan
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    2. Pembiayaan
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
                    Penyediaan uang atau tagihan yang dipersamakan dengan itu berdasarkan persetujuan atau kesepakatan
                    antara PIHAK PERTAMA dengan PIHAK KEDUA yang mewajibkan PIHAK KEDUA untuk mengembalikan uang atau
                    tagihan tersebut setelah jangka waktu tertentu dengan margin keuntungan.
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    3. Angsuran
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
                    Sejumlah uang untuk pembayaran harga sewa yang wajib dibayar secara bulanan oleh PIHAK KEDUA
                    sebagaimana ditentukan dalam akad ini.
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    4. Jatuh Tempo Pembayaran Angsuran
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
                    Tanggal PIHAK KEDUA berkewajiban membayar angsuran tiap bulan.
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    5. Agunan
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
                    Merupakan agunan yang bersifat materiil maupun immateriil untuk mendukung keyakinan PIHAK PERTAMA
                    atas kemampuan dan kesanggupan PIHAK KEDUA untuk melunasi pembiayaan sesuai Akad ini.
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    6. Pembiayaan Ijarah
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
                    Penyediaan dana dalam rangka pemindahan hak guna/manfaat atas suatu aset dalam waktu tertentu dengan
                    pembayaran sewa (ujrah) tanpa diikuti dengan pemindahan kepemilikan aset itu sendiri.
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    7. Ujroh
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
                    Jasa pelayanan yang diterima oleh PIHAK PERTAMA atas Manfaat yang telah diterima oleh PIHAK KEDUA
                    dari Penyedia Jasa. Badan Usaha / Badan Hukum berijin resmi yang bergerak di sektor penyedia Jasa
                    Pendidikan, Jasa Kesehatan dan Jasa Pariwisata Rohani. Nilai manfaat yang dibeli PIHAK KEDUA dengan
                    pendanaan yang berasal dari pembiayaan PIHAK PERTAMA adalah halal berdasarkan Syariah dan tidak
                    mengandung unsur maksiat, baik zatnya maupun cara perolehannya.
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    8. Penyedia Jasa
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    9. Jasa
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    10. Harga Perolehan
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
                    Jumlah uang yang dikeluarkan PIHAK PERTAMA untuk membiayai layanan atau jasa yang dibutuhkan PIHAK
                    KEDUA yang besarnya sesuai tagihan / Invoice yang diterbitkan oleh Penyedia Jasa.
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    11. Harga Sewa
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
                    Adalah Harga Perolehan Pemanfaatan Jasa ditambah dengan keuntungan PIHAK PERTAMA yang merupakan
                    total jumlah Harga Jual yang harus dibayar/dilunasi PIHAK KEDUA kepada PIHAK PERTAMA secara angsuran
                    selama jangka waktu yang disepakati.
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    12. Hari Kerja PIHAK PERTAMA
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
                    Hari kerja PIHAK PERTAMA sesuai jam kerja Bank Indonesia.
                </div>
            </div>
        </div>

        <div class="form-control font-weight-bold bg-white border-0" style="text-align: center; resize: none;">
            <br>PASAL 2<br>
            KETENTUAN UMUM<br>
        </div>
        <div class="form-control bg-white border-0" style="text-align: center; resize: none;">
            1.    PIHAK PERTAMA menyetujui menyediakan fasilitas pembiayaan Multiguna konsumtif berdasarkan prinsip
            Ijarah
            yang digunakan untuk pembayaran pemanfaatan fasilitas jasa jasa pendidikan/jasa kesehatan/jasa pariwisata
            rohani* (pilih salah satu), dan oleh karena itu PIHAK KEDUA mengaku berutang dan berjanji akan membayar
            kembali kepada PIHAK PERTAMA dengan ketentuan sebagai berikut :
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    - Jenis Jasa
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
                    Pendidikan/Kesehatan/Pariwisata Rohani*
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    - Nama Penyedia Jasa
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
                    ………………………………………
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    - Alamat Penyedia Jasa
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
                    ………………………………………
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    - Bukti Pemanfaatan Jasa
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
                    Surat / Invoice / Kuitansi…… Nomor …….
                </div>
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
                    Tanggal …… Perihal ….......
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    - Jumlah yang dibayar Kepada Penyedia Jasa
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
                    Rp.………………… (…………………….)
                </div>
            </div>
        </div>

        <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
            2. Penyerahan jasa dilakukan oleh penyedia jasa langsung kepada PIHAK KEDUA dengan persetujuan dan
            sepengetahuan PIHAK PERTAMA. <br><br>
            3. Sesuai dengan Prinsip Syariah, PARA PIHAK sepakat bahwa Kewajiban PIHAK KEDUA kepada PIHAK PERTAMA adalah
            sebesar Harga Sewa yang terdiri dari komponen Harga Perolehan ditambah Ujroh, tidak termasuk biaya-biaya
            yang timbul sehubungan dengan pelaksanaan Perjanjian.
        </div>
        <div class="form-control font-weight-bold bg-white border-0" style="text-align: center; resize: none;">
            <br>PASAL 3<br>
            JUMLAH KEWAJIBAN PIHAK KEDUA<br>
        </div>
        <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
            PARA PIHAK sepakat bahwa jumlah kewajiban yang harus dibayar PIHAK PERTAMA kepada PIHAK KEDUA adalah
            sejumlah Rp …..………… (……………………) dengan rincian sebagai berikut :
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    - Harga Perolehan
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
                    …………………………
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    - Ujroh
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
                    …………………………
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    - Harga Sewa
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
                    …………………………
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    - Angsuran Tiap Bulan
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
                    …………………………
                </div>
            </div>
        </div>
        <div class="form-control font-weight-bold bg-white border-0" style="text-align: center; resize: none;">
            <br>PASAL 4<br>
            BIAYA-BIAYA<br>
        </div>
        <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
            1.    PIHAK KEDUA berjanji dan dengan ini mengikatkan diri untuk menanggung segala biaya yang diperlukan
            berkenaan dengan pelaksanaan Akad ini, sepanjang hal itu diberitahukan oleh PIHAK PERTAMA kepada PIHAK KEDUA
            sebelum ditandatanginya Akad ini, dan PIHAK KEDUA menyatakan persetujuannya.
        </div>
        <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
            2.    Adapun biaya-biaya yang dimaksud oleh ayat 1 tersebut adalah:
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    a. Biaya Administrasi
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
                    Rp ………………
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    b. Biaya Materai
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
                    Rp ………………
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    c. Biaya Asuransi Jiwa
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
                    Rp ………………
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    d. Biaya Asuransi PHK
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
                    Rp ………………
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    e. Biaya Asuransi Pembiayaan
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
                    Rp ………………
                </div>
            </div>
        </div>
        <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
            (Dengan menunjuk dan menetapkan PIHAK PERTAMA sebagai pihak yang berhak menerima pembayaran claim asuransi
            tersebut <span class="font-italic">(Banker’s Clause)</span>).
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left; resize: none;">
                    f. Biaya
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
                    Rp ………………
                </div>
            </div>
        </div>
        <div class="form-control font-weight-bold bg-white border-0" style="text-align: center; resize: none;">
            <br>PASAL 5<br>
            SYARAT-SYARAT REALISASI PEMBIAYAAN<br>
        </div>
        <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
            PIHAK PERTAMA menyetujui merealisasikan pembiayaan setelah PIHAK KEDUA memenuhi seluruh
            persyaratan-persyaratan yang ditentukan sebagai berikut:<br>
            1. Sesuai dengan Prinsip Syariah, PARA PIHAK sepakat bahwa Kewajiban PIHAK KEDUA kepada PIHAK PERTAMA
            terdiri dari komponen Harga Perolehan PIHAK PERTAMA ditambah Ujroh PIHAK PERTAMA, termasuk biaya-biaya yang
            timbul sehubungan dengan Pelaksanaan Akad ini.<br>
            2. PIHAK KEDUA wajib memenuhi seluruh persyaratan penarikan pembiayaan serta menyerahkan kepada PIHAK
            PERTAMA seluruh dokumen yang disyaratkan oleh PIHAK PERTAMA termasuk tetapi tidak terbatas pada dokumen
            bukti diri PIHAK KEDUA, dokumen kepemilikan agunan dan atau surat lainnya yang berkaitan dengan Akad ini dan
            pengikatan agunan, yang ditentukan dalam Surat Persetujuan Pemberian Pembiayaan (SP-3) dari PIHAK PERTAMA
            sebagaimana tercantum dalam Surat Persetujuan Pemberian Pembiayaan No…………… tanggal ………… berikut perubahannya
            yang telah disepakati bersama.<br>
            3. Melakukan pengikatan Perjanjian Pembiayaan dan Agunan sesuai ketentuan yang berlaku.<br>
            4. Menyerahkan bukti-bukti kepemilikan dan/atau dokumen-dokumen yang terkait dengan agunan.<br>
            5. Menyerahkan Surat Permohonan Penarikan/Realisasi Pembiayaan pada PIHAK PERTAMA.<br>
            6. PIHAK KEDUA wajib membuka dan memelihara rekening giro atau tabungan pada PIHAK PERTAMA selama PIHAK
            KEDUA mempunyai Pembiayaan dari PIHAK PERTAMA.<br>
            7. Menyerahkan surat kuasa yang tidak dapat dicabut kembali untuk mendebet / mengkredit rekening atas nama
            PIHAK KEDUA sebagai kewajiban yang harus dipenuhi untuk kepentingan PIHAK PERTAMA.<br>
            8. Menyetor biaya realisasi sebagaimana tercantum dalam Pasal 4.<br>
            9. Menyerahkan Surat Kuasa kepada PIHAK PERTAMA untuk mengurus dan menerima hasil klaim asuransi.<br>
            10. Menandatangani Akad ini dan perjanjian pengikatan agunan yang disyaratkan oleh PIHAK PERTAMA.<br>
            11. Sebagai bukti telah diserahkan setiap surat, dokumen, bukti kepemilikan atas agunan dan/atau akta
            dimaksud oleh PIHAK KEDUA kepada PIHAK PERTAMA, PIHAK PERTAMA berkewajiban untuk menerbitkan dan menyerahkan
            Tanda Bukti Penerimanya kepada PIHAK KEDUA.
        </div>
        <div class="form-control font-weight-bold bg-white border-0" style="text-align: center; resize: none;">
            <br>PASAL 6<br>
            JANGKA WAKTU DAN CARA PEMBAYARAN<br>
        </div>
        <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
            1. PARA PIHAK sepakat bahwa pembayaran kembali seluruh Kewajiban PIHAK KEDUA kepada PIHAK PERTAMA
            sebagaimana tersebut pada Pasal 3 Perjanjian ini akan berlangsung dalam jangka waktu …… bulan terhitung
            sejak dari tanggal Perjanjian ini ditandatangani dan berakhir sampai pembiayaan dinyatakan lunas oleh PIHAK
            PERTAMA.<br>
            2. PARA PIHAK sepakat bahwa pembayaran kembali Kewajiban PIHAK KEDUA kepada PIHAK PERTAMA akan dibayar
            sesuai dengan jadwal pembayaran angsuran sebagaimana diatur dalam Lampiran Perjanjian berjudul “Jadwal
            Pembayaran” yang merupakan bagian tidak terpisah dari Perjanjian dan karenanya sebelum seluruh Kewajiban
            PIHAK KEDUA dilunasi oleh PIHAK KEDUA, PIHAK KEDUA mengaku berutang kepada PIHAK PERTAMA.<br>
            3. Dalam hal jatuh tempo pembayaran kembali Kewajiban PIHAK KEDUA jatuh bukan pada Hari Kerja, maka PIHAK
            KEDUA bersedia untuk melakukan pembayaran pada Hari Kerja sebelumnya.<br>
            4. Berakhirnya jatuh tempo pembiayaan sebagaimana dimaksud diatas, tidak dengan sendirinya menyebabkan
            pembiayaan lunas sepanjang masih terdapat sisa kewajiban PIHAK KEDUA kepada PIHAK PERTAMA.<br>
            5. Setiap pembayaran yang diterima oleh PIHAK PERTAMA dari PIHAK KEDUA atas kewajiban pembiayaan dibuktikan
            oleh PIHAK PERTAMA kedalam rekening PIHAK KEDUA sesuai dengan mekanisme yang berlaku PIHAK PERTAMA
            berdasarkan catatan dan pembukuan yang ada pada PIHAK PERTAMA.<br>
            6. PIHAK PERTAMA tidak diwajibkan untuk mengirim surat-surat tagihan kepada PIHAK KEDUA, sehingga dengan
            atau tanpa adanya surat tagihan PIHAK KEDUA harus tetap memenuhi pembayaran angsuran.<br>
            7. PIHAK KEDUA diwajibkan untuk menyimpan dengan baik dan tertib semua bukti pembayaran yang berhubungan
            dengan pembayaran kewajiban Pembiayaannya dan wajib untuk memperlihatkan kepada PIHAK PERTAMA, apabila
            diminta.<br>
            8. Sepanjang mengenai kewajiban-kewajiban pembayaran PIHAK KEDUA kepada PIHAK PERTAMA yang timbul dari akad
            ini, maka PIHAK KEDUA dengan ini memberi kuasa kepada PIHAK PERTAMA untuk meminta dan menerima bagian dari
            gaji atau penerimaan lainnya yang menjadi hak PIHAK KEDUA dari pejabat yang berwenang membayarkan gaji dan
            atau penerimaan lainya dari instansi/kantor dimana PIHAK KEDUA bekerja untuk pembayaran angsuran pembiayaan
            Ijarah PIHAK KEDUA kepada PIHAK PERTAMA, mendahului kewajiban PIHAK KEDUA kepada Pihak lain.<br>
            9. Ketentuan seperti dimaksud pada ayat (8) pasal ini tidak mengurangi pertanggungjawaban pribadi PIHAK
            KEDUA atas kewajiban-kewajiban pembayaran kepada PIHAK PERTAMA yang timbul dari akad ini, sehingga
            bagaimanapun PIHAK PERTAMA berhak untuk apabila menganggap perlu melakukan penagihan langsung kepada PIHAK
            KEDUA atas kewajiban-kewajiban pembayaran tersebut.
        </div>
        <div class="form-control font-weight-bold bg-white border-0" style="text-align: center; resize: none;">
            <br>PASAL 7<br>
            JANGKA WAKTU DAN CARA PEMBAYARAN<br>
        </div>
        <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
            Sehubungan dengan fasilitas pembiayaan oleh PIHAK PERTAMA kepada PIHAK KEDUA berdasarkan akad ini, PIHAK
            KEDUA berjanji dan dengan ini mengikatkan diri untuk:<br>
            1. Mengembalikan seluruh jumlah pokok pembiayaan selambat-lambatnya tanggal ………….. setiap bulan berikut
            bagian dari pendapatan Ujroh PIHAK PERTAMA berdasarkan akad yang telah disepakati.<br>
            2. Memberikan laporan secara tertulis kepada PIHAK PERTAMA dalam hal terjadi perubahan terkait status
            kepegawaian PIHAK KEDUA, termasuk namun tidak terbatas manakala terjadi mutasi dan promosi yang
            berpengaruh kepada penghasilan PIHAK KEDUA.<br>
            3. Melakukan pembayaran atas semua tagihan atau tanggungan dari pihak ketiga melalui rekening PIHAK
            KEDUA di PIHAK PERTAMA.<br>
            4. Membebaskan seluruh harta kekayaan milik PIHAK KEDUA dari beban penjamin terhadap pihak lain, kecuali
            penjaminan bagi kepentingan PIHAK PERTAMA berdasarkan akad ini.<br>
            5. Mengelola dan mengadakan pencatatan tersendiri atas pengeluaran dana secara jujur dan amanah dengan
            itikad baik.<br>
            6. Menyerahkan kepada PIHAK PERTAMA setiap dokumen, data dan atau keterangan-keterangan yang diminta
            PIHAK PERTAMA kepada PIHAK KEDUA.
        </div>
        <div class="form-control font-weight-bold bg-white border-0" style="text-align: center; resize: none;">
            <br>PASAL 8<br>
            DENDA KETERLAMBATAN<br>
        </div>
        <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
            1. Dalam hal terjadi keterlambatan pembayaran oleh PIHAK KEDUA kepada PIHAK PERTAMA, maka PIHAK KEDUA
            berjanji dan dengan ini mengikatkan diri pada PIHAK PERTAMA sebesar Rp ………… (………………) atau sesuai dengan
            ketentuan yang berlaku pada PIHAK PERTAMA untuk setiap hari keterlambatan, terhitung sejak saat
            kewajiban pembayaran tersebut jatuh tempo sampai dengan tanggal dilaksanakannya pembayaran kembali, dan
            untuk setiap kali keterlambatan, yang mana akan digunakan PIHAK PERTAMA sebagai dana
            kebijakan/sosial.<br>
            2. Pengenaan denda keterlambatan maupun penghapusan denda dari PIHAK KEDUA kepada PIHAK KEDUA sepenuhnya
            menjadi kewenangan PIHAK PERTAMA.
        </div>
        <div class="form-control font-weight-bold bg-white border-0" style="text-align: center; resize: none;">
            <br>PASAL 9<br>
            GANTI RUGI<br>
        </div>
        <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
            1. Dalam hal terjadi keterlambatan pembayaran angsuran pembiayaan oleh PIHAK KEDUA kepada PIHAK PERTAMA,
            maka PIHAK KEDUA bersedia membayar ganti rugi atas biaya-biaya rill yang telah dikeluarkan PIHAK PERTAMA
            dalam rangka penagihan angsuran tersebut.<br>
            2. Komponen biaya-biaya rill sebagaimana pada pasal di atas meliputi penggantian biaya-biaya
            transportasi dan akomodasi, telekomunikasi, korespondensi dan tenaga kerja yang telah dikeluarkan PIHAK
            PERTAMA.<br>
            3. Pengenaan ganti rugi keterlambatan maupun penghapusan ganti rugi dari PIHAK PERTAMA kepada PIHAK
            KEDUA sepenuhnya menjadi kewenangan PIHAK PERTAMA.
        </div>
        <div class="form-control font-weight-bold bg-white border-0" style="text-align: center; resize: none;">
            <br>PASAL 10<br>
            PELUNASAN DIPERCEPAT<br>
        </div>
        <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
            1. PIHAK KEDUA diperkenankan melakukan pelunasan Pembiayaan Multiguna seluruhnya bersama-sama dengan
            kewajiban lain yang harus dibayar lebih cepat/awal dari tanggal pembayaran pelunasan /tanggal jatuh
            tempo kepada PIHAK PERTAMA.<br>
            2. Jika PIHAK KEDUA akan melakukan pelunasan dipercepat atas setiap bagian dari Harga Sewa, maka PIHAK
            KEDUA wajib mengirimkan surat pemberitahuan kepada PIHAK PERTAMA minimal 5 (lima) Hari Kerja
            sebelumnya.<br>
            3. Setelah menerima surat pemberitahuan tersebut, PIHAK PERTAMA akan memberitahu PIHAK KEDUA secara
            tertulis informasi mengenai total jumlah yang terhutang kepada PIHAK PERTAMA berdasarkan Perjanjian
            pembiayaan termasuk seluruh biaya, beban, dan pengeluaran aktual. PIHAK KEDUA berkewajiban untuk
            melunasi seluruh jumlah yang terhutang tersebut sebagaimana ditetapkan dalam Pemberitahuan Pembayaran
            dari PIHAK PERTAMA.<br>
            4. PIHAK KEDUA diperkenankan melakukan pembayaran dipercepat seluruhnya dengan biaya pelunasan
            dipercepat sesuai dengan prosedur dan ketentuan yang berlaku pada PIHAK PERTAMA.
        </div>
        <div class="form-control font-weight-bold bg-white border-0" style="text-align: center; resize: none;">
            <br>PASAL 11<br>
            TEMPAT PEMBAYARAN<br>
        </div>
        <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
            1. Setiap pembayaran kembali/pelunasan Kewajiban PIHAK KEDUA oleh PIHAK KEDUA kepada PIHAK PERTAMA
            dilakukan di kantor PIHAK PERTAMA atau di tempat lain dan cara lain yang ditentukan oleh PIHAK PERTAMA,
            atau dilakukan melalui rekening yang dibuka oleh dan atas nama PIHAK KEDUA di PIHAK PERTAMA.<br>
            2. Dalam hal pembayaran dilakukan melalui rekening PIHAK KEDUA di PIHAK PERTAMA, maka dengan ini PIHAK
            KEDUA memberi kuasa yang tidak dapat berakhir karena sebab-sebab yang ditentukan dalam Pasal 1813 Kitab
            Undang-Undang Hukum Perdata yang berbunyi “Pemberian kuasa berakhir: dengan penarikan kembali kuasa
            penerima kuasa; dengan pemberitahuan penghentian kuasanya oleh penerima kuasa; dengan meninggalnya,
            pengampuan atau pailitnya, baik pemberi kuasa maupun penerima kuasa” kepada PIHAK PERTAMA, untuk
            mendebet rekening PIHAK KEDUA guna membayar/melunasi Kewajiban PIHAK KEDUA Yang Dibayar Tangguh.
        </div>
        <div class="form-control font-weight-bold bg-white border-0" style="text-align: center; resize: none;">
            <br>PASAL 12<br>
            AGUNAN<br>
        </div>
        <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
            Untuk menjamin tertibnya pelaksanaan pembayaran kembali/pelunasan Pembiayaan dan Margin Keuntungan tepat
            pada waktu yang telah disepakati PARA PIHAK berdasarkan Akad ini, maka PIHAK KEDUA berjanji dan dengan
            ini mengikatkan diri untuk menyerahkan agunan dan membuat pengikatan agunan kepada PIHAK PERTAMA sesuai
            dengan peraturan perundang-undangan yang berlaku, yang merupakan bagian yang tidak terpisahkan dari Akad
            ini. Jenis agunan yang diserahkan berupa:
        </div>
        <div class="form-control font-weight-bold bg-white border-0" style="text-align: center; resize: none;">
            <br>PASAL 13<br>
            CIDERA JANJI<br>
        </div>
        <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
            PIHAK PERTAMA berhak untuk menuntut/menagih pembayaran dari PIHAK KEDUA atau siapa pun juga yang
            memperoleh hak darinya, atas sebagian atau seluruh jumlah utang PIHAK KEDUA kepada PIHAK PERTAMA
            berdasarkan Perjanjian, untuk dibayar dengan seketika dan sekaligus, tanpa diperlukan adanya surat
            pemberitahuan, surat teguran, atau surat lainnya, apabila terjadi salah satu hal atau peristiwa tersebut
            di bawah ini:<br><br>
            1. PIHAK KEDUA tidak melaksanakan kewajiban pembayaran/pelunasan Kewajiban PIHAK KEDUA pada waktu yang
            diperjanjikan sesuai dengan tanggal jatuh tempo pembayaran sebagaimana tercantum pada Lampiran
            Perjanjian berjudul Jadwal Pembayaran.<br>
            2. Dokumen atau keterangan yang diserahkan/diberikan PIHAK KEDUA kepada PIHAK PERTAMA terkait dengan
            pemberian fasilitas pembiayaan Multiguna konsumtif adalah palsu, tidak sah, atau tidak benar.<br>
            3. PIHAK KEDUA tidak memenuhi dan/atau melanggar ketentuan-ketentuan tersebut dalam Pasal 3
            Perjanjian.<br>
            4. PIHAK KEDUA dinyatakan dalam keadaan pailit, ditaruh di bawah pengampuan, dibubarkan dan/atau
            likuidasi.<br>
            5. PIHAK KEDUA atau pihak ketiga telah memohon kepailitan terhadap PIHAK KEDUA.<br>
            6. Apabila karena sesuatu sebab, sebagian atau seluruh Akta dinyatakan batal berdasarkan putusan
            Pengadilan atau Badan Arbitrase.
        </div>
        <div class="form-control font-weight-bold bg-white border-0" style="text-align: center; resize: none;">
            <br>PASAL 14<br>
            AKIBAT CIDERA JANJI<br>
        </div>
        <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
            1. Apabila PIHAK KEDUA tidak melaksanakan pembayaran seketika dan sekaligus karena suatu hal atau
            peristiwa tersebut dalam Pasal 13 Perjanjian, maka PIHAK PERTAMA berhak menjual barang agunan sesuai
            dengan peraturan yang berlaku, dan uang hasil penjualan barang agunan tersebut digunakan PIHAK PERTAMA
            untuk membayar/melunasi Kewajiban PIHAK KEDUA atau sisa Kewajiban PIHAK KEDUA.<br><br>
            2. Apabila penjualan barang agunan dilakukan dibawah tangan maka PIHAK KEDUA dan PIHAK PERTAMA sepakat,
            harga penjualan barang agunan ditetapkan oleh PIHAK PERTAMA dengan harga yang wajar menurut harga pasar
            ketika barang agunan dijual.<br><br>
            3. Jika hasil penjualan barang agunan tidak mencukupi untuk membayar Kewajiban PIHAK KEDUA, maka PIHAK
            KEDUA wajib melunasi sisa Kewajiban PIHAK KEDUA yang belum dibayar sampai lunas. Apabila hasil penjualan
            barang agunan melebihi jumlah Kewajiban PIHAK KEDUA atau sisa Kewajiban PIHAK KEDUA, maka PIHAK PERTAMA
            wajib menyerahkan kelebihan tersebut kepada PIHAK KEDUA.<br><br>
            4. Apabila PIHAK KEDUA tidak melaksanakan pembayaran seketika dan sekaligus karena suatu hal atau
            peristiwa tersebut dalam Pasal 13 Perjanjian, PIHAK PERTAMA juga berhak melakukan tindakan-tindakan
            seperti: Penandaan Atas Agunan, Surat Teguran, Surat Peringatan, dan tindakan-tindakan lain yang
            dianggap perlu untuk dilakukan dengan tujuan dapat menyelesaikan pembiayaan bermasalah yang diakibatkan
            Cedera Janji atau wan prestasi oleh PIHAK KEDUA.
        </div>
        <div class="form-control font-weight-bold bg-white border-0" style="text-align: center; resize: none;">
            <br>PASAL 15<br>
            PERNYATAAN DAN JAMINAN PIHAK KEDUA<br>
        </div>
        <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
            PIHAK KEDUA menyatakan dengan sebenar-benarnya dan menjamin kepada PIHAK PERTAMA:<br><br>
            1. PIHAK KEDUA adalah perorangan yang tunduk pada hukum Negara Republik Indonesia.<br><br>
            2. PIHAK KEDUA berhak dan berwenang sepenuhnya untuk menandatangani Perjanjian dan seluruh dokumen yang
            menyertainya.<br><br>
            3. PIHAK KEDUA tidak akan mengalihkan, menjaminkan dan/atau memberi kuasa kepada orang lain untuk
            mengalihkan dan/atau menjaminkan atas sebagian atau seluruh dari hartanya, termasuk tetapi tidak
            terbatas pada piutang dan/atau klaim asuransi, tidak dalam keadaan bersengketa, gugat–menggugat di muka
            atau di luar lembaga peradilan atau arbitrase, berutang pada pihak lain, diselidik atau dituntut oleh
            pihak yang berwajib, baik pada saat ini atau pun selama Jangka Waktu Perjanjian, yang dapat mempengaruhi
            asset, keadaan keuangan, dan/atau mengganggu jalannya usaha PIHAK KEDUA.<br><br>
            4. PIHAK KEDUA menjamin bahwa terhadap pembelian Jasa dari Penyedia Jasa, Jasa yang diberikan bebas dari
            penyitaan, pembebanan, tuntutan gugatan atau hak untuk menebus kembali.<br><br>
            5. PIHAK KEDUA akan menyerahkan kepada PIHAK PERTAMA, agunan tambahan yang dinilai cukup oleh PIHAK
            PERTAMA selama kewajiban membayar Kewajiban PIHAK KEDUA atau sisa Kewajiban PIHAK KEDUA kepada PIHAK
            PERTAMA belum lunas.<br><br>
            6. PIHAK KEDUA bersedia untuk tidak melakukan upaya hukum atas tindakan-tindakan PIHAK PERTAMA seperti
            yang tercantum dalam pasal 13 (4) diatas, karena tindakan-tindakan diatas memang dianggap perlu untuk
            dilakukan guna menyelesaikan pembiayaan bermasalah akibat Cidera Janji oleh PIHAK KEDUA dan bukan
            merupakan tindakan pencemaran nama baik atau tindakan yang dipersamakan dengan itu.
        </div>
        <div class="form-control font-weight-bold bg-white border-0" style="text-align: center; resize: none;">
            <br>PASAL 16<br>
            PEMBATASAN TERHADAP TINDAKAN PIHAK KEDUA<br>
        </div>
        <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
            Selama jangka waktu Perjanjian, PIHAK KEDUA tidak akan melakukan sebagian atau seluruhnya dari
            perbuatan-perbuatan sebagai berikut, kecuali setelah mendapatkan persetujuan tertulis dari PIHAK
            PERTAMA:<br><br>
            1. Menjual dan/atau menyewakan baik sebagian atau seluruh asset PIHAK KEDUA yang nyata-nyata akan
            mempengaruhi kemampuan atau cara membayar atau melunasi Kewajiban PIHAK KEDUA atau sisa Kewajiban PIHAK
            KEDUA.<br><br>
            2. Mengajukan pembiayaan baru kepada pihak ketiga tanpa sepengetahuan dan persetujuan PIHAK
            PERTAMA.<br><br>
            3. Memindahkan kedudukan/lokasi barang maupun barang agunan dari kedudukan/lokasi Barang itu semula atau
            sepatutnya berada, dan/atau mengalihkan hak atas barang atau barang agunan yang bersangkutan kepada
            pihak lain.<br><br>
            4. Mengajukan permohonan kepada yang berwenang untuk menunjuk eksekutor, kurator, likuidator atau
            pengawas atas sebagian atau seluruh harta kekayaannya.
        </div>
        <div class="form-control font-weight-bold bg-white border-0" style="text-align: center; resize: none;">
            <br>PASAL 17<br>
            RISIKO<br>
        </div>
        <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
            PIHAK KEDUA bertanggung jawab untuk memastikan, memeriksa dan meneliti kondisi fasilitas jasa yang
            disediakan oleh penyedia jasa, termasuk terhadap sahnya dokumen-dokumen atau surat-surat bukti
            kepemilikan jasa.
        </div>
        <div class="form-control font-weight-bold bg-white border-0" style="text-align: center; resize: none;">
            <br>PASAL 18<br>
            ASURANSI<br>
        </div>
        <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
            1. Selama jangka waktu pembiayaan atau seluruh utang Ijarah belum dilunasi, PIHAK KEDUA wajib untuk
            menutup asuransi sebagaimana yang tercantum dalam Pasal 4.<br><br>
            2. Penutupan asuransi sebagaimana dimaksud dalam ayat (1) dilakukan dengan syarat Banker’s Clause pada
            perusahaan asuransi berdasarkan Syariah yang disetujui oleh PIHAK PERTAMA untuk nilai dan jenis risiko
            dan perluasannya, premi asuransi yang menjadi beban PIHAK KEDUA.<br><br>
            3. Kewajiban penutupan asuransi atas pembiayaan dan/atau agunan pembiayaan berlaku selama jangka waktu
            pembiayaan atau selama jumlah seluruh kewajiban pembiayaan Multiguna yang diberikan oleh PIHAK PERTAMA
            kepada PIHAK KEDUA belum dilunasi. Dengan demikian, setiap jangka waktu suatu pertanggungan berakhir,
            maka PIHAK KEDUA wajib melakukan penutupan pertanggungan lagi/memperpanjang jangka waktu pertanggungan
            sepenuhnya atas biaya PIHAK KEDUA.<br><br>
            4. PIHAK KEDUA wajib melaksanakan hak-hak klaimnya secara tetap dan penuh dan wajib memberitahukan
            kepada PIHAK PERTAMA perkembangannya untuk memungkinkan PIHAK PERTAMA mengetahui sepenuhnya setiap
            kerugian yang diminta dan satuan atas klaim sesuai dengan klaimnya.<br><br>
            5. Dalam hal terjadi risiko yang dipertanggungkan sebagaimana tercantum dalam polis asuransi atas harta
            yang dijaminkan kepada PIHAK PERTAMA dan kemudian dibayarkan hak klaimnya, maka PIHAK PERTAMA berhak
            untuk memperhitungkan hasil klaim tersebut dengan utang PIHAK KEDUA.
        </div>
        <div class="form-control font-weight-bold bg-white border-0" style="text-align: center; resize: none;">
            <br>PASAL 19<br>
            KEADAAN MEMAKSA <span class="font-italic">(FORCE MAJEURE)</span><br>
        </div>
        <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
            Apabila terjadi kejadian-kejadian force majeure di bawah ini:<br><br>

            1. Yang dianggap force majeure adalah bencana alam (gempa bumi, longsor, letusan/ledakan gunung merapi,
            dan banjir), kebakaran, perang, huru hara, pemberontakan, dan epidemi (wabah penyakit), serta tindakan
            pemerintah di bidang moneter yang langsung mengakibatkan kerugian luar biasa;<br><br>

            2. Pengambilalihan kegiatan badan usaha oleh Pemerintah Republik Indonesia terhadap salah satu dari PARA
            PIHAK, yang mengakibatkan pihak dan/atau kantor perwakilan/cabang pihak yang mengalami force majeure
            tersebut tidak dapat menjalankan usahanya dan/atau melanjutkan kewajibannya menurut perjanjian ini, baik
            untuk seterusnya atau untuk sementara waktu.<br><br>

            Maka pihak yang mengalami force majeure tersebut akan segera memberitahukan secara tertulis dalam waktu
            paling lambat 14 (empat belas) hari kalender kepada pihak lainnya dan PARA PIHAK akan bertemu untuk
            membicarakan mengenai:<br><br>

            a. Force majeure yang terjadi;<br>
            b. Akibat dan besarnya pengaruh force majeure terhadap pelaksanaan kewajiban pihak dan/atau kantor
            perwakilan pihak yang mengalami force majeure;<br>
            c. Usaha penanggulangan yang telah maupun akan dilakukan oleh pihak dan/atau kantor perwakilan pihak
            yang mengalami force majeure.<br><br>

            Untuk kelancaran pekerjaan, penentuan keadaan memaksa dalam hal ini dilakukan guna segera tercapainya
            kesepakatan atas hal-hal tersebut di atas dan penyelesaian yang memuaskan PARA PIHAK.
        </div>
        <div class="form-control font-weight-bold bg-white border-0" style="text-align: center; resize: none;">
            <br>PASAL 20<br>
            PENYELESAIAN PERSELISIHAN<br>
        </div>
        <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
            1. Apabila terjadi perselisihan sebagai akibat dari pelaksanaan perjanjian ini, PARA PIHAK sepakat untuk
            menyelesaikannya terlebih dahulu secara musyawarah untuk mencapai mufakat. Jika tidak tercapai
            kesepakatan paling lambat dalam jangka waktu 30 (tiga puluh) hari kerja, maka PARA PIHAK sepakat untuk
            menyelesaikannya melalui Pengadilan.<br><br>

            2. Untuk perjanjian ini dan segala akibatnya, PARA PIHAK sepakat untuk memilih domisili hukum yang tetap
            dan tidak berubah di Kantor Kepaniteraan Pengadilan Agama atau Pengadilan Negeri atau Arbitrase di
            ………………………………………….
        </div>
        <div class="form-control font-weight-bold bg-white border-0" style="text-align: center; resize: none;">
            <br>PASAL 21<br>
            KORESPONDENSI<br>
        </div>
        <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
            Semua pemberitahuan yang harus diberikan oleh PARA PIHAK wajib disampaikan dengan mengirimkan
            pemberitahuan tersebut melalui media elektronik tercatat, pos tercatat, atau dikirim langsung dengan
            disertai bukti tanda terima ke alamat PARA PIHAK yang tersebut di bawah ini atau alamat lain dengan
            memberitahukan secara tertulis terlebih dahulu:
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control font-weight-bold bg-white border-0" style="text-align: left;">
                    PIHAK PERTAMA
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: left;">
                    PT Bank Pembangunan Daerah Jawa Timur Tbk <br>
                    Cabang Pembantu Syariah Wiyung Surabaya
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left;">
                    UP
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: left;">
                    AGUNG PRIYAMBODO
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left;">
                    Alamat
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: left;">
                    Jl. Raya Menganti Ruko Pratama A-8 Surabaya
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left;">
                    Telepon / Fax
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: left;">
                    (031) 7524624
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control font-weight-bold bg-white border-0" style="text-align: left;">
                    PIHAK KEDUA
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: left;">
                    ANI KHOIRUNNISA
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left;">
                    Alamat
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: left;">
                    Jl.Hayam Wuruk RT.02 RW.007 <br>
                    Kel/Desa Sawotratap Kec.Gedangan SIdoarjo
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-control bg-white border-0" style="text-align: left;">
                    Telepon / Fax
                </div>
            </div>
            <div class="col-9">
                <div class="form-control bg-white border-0" style="text-align: left;">
                    0823 3538 8258
                </div>
            </div>
        </div>
        <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
            Atau ke alamat maupun nomor lain sesuai pemberitahuan dari masing-masing pihak. Jika tidak disampaikan
            secara khusus, tanggal dari tiap pemberitahuan akan dianggap sebagai (i) tanggal penerimaan jika disampaikan
            secara personil, (ii) 7 (tujuh) hari kalender setelah disampaikan melalui pos/surat, atau (iii) tanggal
            pengiriman jika disampaikan melalui facsimile, yang mana terjadi terlebih dahulu.
            <br><br>
            PARA PIHAK dapat merubah alamat dengan pemberitahuan kepada PARA PIHAK.
        </div>
        <div class="form-control font-weight-bold bg-white border-0" style="text-align: center; resize: none;">
            <br>PASAL 22<br>
            KETENTUAN LAIN-LAIN<br>
        </div>
        <div class="form-control bg-white border-0" style="text-align: justify; resize: none;">
            5. Perjanjian ini dapat berakhir dengan sendirinya apabila ada ketentuan perundang-undangan dan/atau
            kebijakan Pemerintah yang tidak memungkinkan berlangsungnya Perjanjian ini;<br><br>
            6. Kesepakatan dan tugas serta tanggung jawab PARA PIHAK berdasarkan Perjanjian ini tidak berakhir karena
            berhalangan tetapnya salah satu Pihak yang mewakili dan/atau berakhirnya jabatan PARA PIHAK yang mewakili
            dalam Perjanjian, tetapi tetap wajib untuk dipenuhi dan ditaati oleh pengganti Hak dan Kewajiban
            (Rechtsopvolgers) dari masing-masing pihak;<br><br>
            7. Segala perubahan manfaat, biaya, risiko, syarat dan ketentuan produk dan/atau layanan, PIHAK PERTAMA akan
            menyampaikan kepada PIHAK KEDUA paling lambat 30 (tiga puluh) hari kerja sebelum perubahan dimaksud
            diberlakukan;<br><br>
            8. Perjanjian ini telah disesuaikan dengan Ketentuan Peraturan Perundang-Undangan termasuk ketentuan
            Peraturan Otoritas Jasa Keuangan.
        </div>
        <div class="form-control font-weight-bold bg-white border-0" style="text-align: center; resize: none;">
            <br>PASAL 23<br>
            PENUTUP<br>
        </div>
        <div class="form-control mb-3 pb-3 bg-white border-0" style="text-align: justify; resize: none;">
            1.     PARA PIHAK dengan ini menyatakan bahwa yang menandatangani Perjanjian ini dan atau surat-surat
            lainnya/lampirannya, berhak dan berwenang mewakili masing-masing pihak sesuai ketentuan dalam Anggaran Dasar
            dan atau keputusan/ketentuan yang berlaku pada masing-masing Pihak;<br><br>
            2.     Apabila ada hal-hal yang belum diatur atau belum cukup diatur dalam Perjanjian ini maka PIHAK KEDUA
            dan PIHAK PERTAMA akan mengaturnya bersama secara musyawarah untuk mufakat dalam suatu addendum;<br><br>
            3.     Tiap addendum dan lampiran dari Perjanjian merupakan satu kesatuan yang tidak terpisahkan dari
            Perjanjian;<br><br>
            4.     Surat Perjanjian dibuat dan ditanda tangani oleh PARA PIHAK pada tanggal dan tempat sebagaimana
            tersebut diatas, dalam rangkap 2 (dua) di atas kertas yang bermeterai cukup yang masing-masing berlaku
            sebagai aslinya bagi kepentingan masing-masing pihak.
        </div>
        <div class="row pb-3 mb-3">
            <div class="col-6">
                <div class="form-control font-weight-bold bg-white border-0" style="text-align: left; resize: none;">
                    PIHAK PERTAMA <br>
                    PT BANK PEMBANGUNAN DAERAH <br>
                    JAWA TIMUR Tbk <br>
                    CABANG PEMBANTU SYARIAH WIYUNG, SURABAYA <br>
                </div>
            </div>
            <div class="col-6">
                <div class="form-control font-weight-bold bg-white border-0" style="text-align: left; resize: none;">
                    PIHAK KEDUA
                </div>
            </div>
        </div>
        <div class="row pt-3 mt-3">
            <div class="col-6">
                <div class="form-control font-weight-bold bg-white border-0" style="text-align: left; resize: none;">
                    Agung Priyambodo <br>
                    Pemimpin Cabang
                </div>
            </div>
            <div class="col-3">
                <div class="form-control font-weight-bold bg-white border-0" style="text-align: left; resize: none;">
                    Ani Khoirunnisa <br>
                    Pembantu
                </div>
            </div>
            <div class="col-3">
                <div class="form-control font-weight-bold bg-white border-0" style="text-align: left; resize: none;">
                    {{ ucwords(strtolower($nasabah_profil->nama_nasabah)) }} <br>
                    Nasabah
                </div>
            </div>
        </div>


    </div>

</body>
<script>
    // Start nilai pembiayaan permohonan, keputusan
    function hitungAngsuranPerBulan(prefix) {
        const jangka = document.getElementById(`${prefix}_jangka_waktu_pembiayaan`);
        const bulanOutput = document.getElementById(`${prefix}_jangka_waktu_bulan`);
        const margin = document.getElementById(`${prefix}_margin_bank`);
        const harga = document.getElementById(`${prefix}_harga_beli_bank`);
        const marginTahunOutput = document.getElementById(`${prefix}_margin_tahun_output`);
        const nominalOutput = document.getElementById(`${prefix}_margin_nominal_output`);
        const hargaJualOutput = document.getElementById(`${prefix}_harga_jual_output`);
        const angsuranOutput = document.getElementById(`${prefix}_angsuran_bank_output`);

        const blokirInputOutput = document.getElementById('biaya_blokir_angsuran');
        const asuransiJiwaOutput = document.getElementById('biaya_asuransi_jiwa');
        const asuransiKebakaranOutput = document.getElementById('biaya_asuransi_kebakaran');

        function updateBulan() {
            const tahunInput = parseFloat(jangka?.value || 0);
            if (!isNaN(tahunInput) && tahunInput > 0) {
                const bulan = tahunInput * 12;
                if (bulanOutput) bulanOutput.innerText = bulan + ' bulan';
            } else {
                if (bulanOutput) bulanOutput.innerText = '—';
            }
        }

        function updateOutput() {
            const marginPerBulan = parseFloat(margin?.value) || 0;
            const jangkaTahun = parseFloat(jangka?.value) || 0;
            const hargaBeli = parseFloat(harga?.value) || 0;

            const jangkaBulan = jangkaTahun * 12;
            const marginTahun = marginPerBulan * jangkaTahun;

            const asuransiJiwa = (4 / 1000) * hargaBeli;
            const asuransiKebakaran = (2 / 1000) * hargaBeli * jangkaTahun;

            if (marginTahunOutput)
                marginTahunOutput.innerText = jangkaTahun > 0 ? `${marginTahun.toFixed(2)}%` : '—';

            if (marginPerBulan > 0 && jangkaTahun > 0 && hargaBeli > 0) {
                const nominalMargin = (marginTahun / 100) * hargaBeli;
                const hargaJual = hargaBeli + nominalMargin;
                const angsuran = hargaJual / jangkaBulan;

                if (nominalOutput)
                    nominalOutput.innerText = `Rp ${nominalMargin.toLocaleString('id-ID')}`;
                if (hargaJualOutput)
                    hargaJualOutput.innerText = `Rp ${hargaJual.toLocaleString('id-ID')}`;
                if (angsuranOutput)
                    angsuranOutput.innerText =
                    `Rp ${angsuran.toLocaleString('id-ID', { minimumFractionDigits: 0 })}`;

                if (blokirInputOutput) {
                    blokirInputOutput.value = angsuran.toFixed(3);
                }
                if (asuransiJiwaOutput) {
                    asuransiJiwaOutput.value = asuransiJiwa.toFixed(3);
                }
                if (asuransiKebakaranOutput) {
                    asuransiKebakaranOutput.value = asuransiKebakaran.toFixed(3);
                }

            } else {
                if (nominalOutput) nominalOutput.innerText = '—';
                if (hargaJualOutput) hargaJualOutput.innerText = '—';
                if (angsuranOutput) angsuranOutput.innerText = '—';

                if (blokirInputOutput) blokirInputOutput.value = 0;
                if (asuransiJiwaOutput) asuransiJiwaOutput.value = 0;
                if (asuransiKebakaranOutput) asuransiKebakaranOutput.value = 0;

            }

            const adminValue = parseFloat(document.getElementById('biaya_administrasi')?.value || 0);
            const blokirValue = parseFloat(document.getElementById('biaya_blokir_angsuran')?.value || 0);
            const materaiValue = parseFloat(document.getElementById('biaya_materai')?.value || 0);
            const jiwaValue = parseFloat(document.getElementById('biaya_asuransi_jiwa')?.value || 0);
            const kebakaranValue = parseFloat(document.getElementById('biaya_asuransi_kebakaran')?.value || 0);

            const totalBiaya = adminValue + blokirValue + materaiValue + jiwaValue + kebakaranValue;

            document.getElementById('total_biaya_output').textContent = `Rp ${totalBiaya.toLocaleString('id-ID')}`;
        }

        // Jalankan hanya jika elemen penting ada
        if (jangka && margin && harga) {
            updateBulan();
            updateOutput();

            jangka.addEventListener('input', () => {
                updateBulan();
                updateOutput();
            });

            margin.addEventListener('input', updateOutput);
            harga.addEventListener('input', updateOutput);

            document.getElementById('biaya_administrasi').addEventListener('input', updateOutput);
            document.getElementById('biaya_materai').addEventListener('input', updateOutput);
        }
    }
    // End nilai pembiayaan permohonan, keputusan

    window.addEventListener('DOMContentLoaded', () => {
        // window.print()

        hitungAngsuranPerBulan('keputusan');
    });
</script>

</html>
