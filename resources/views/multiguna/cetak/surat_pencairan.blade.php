<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Pencairan Pembiayaan</title>
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

        <div class="text-center">
            <input type="text" id="nama_judul_surat" name="nama_judul_surat"
                class="form-control text-center bg-white text-danger border-0 font-weight-bold w-100"
                value="{{ strtoupper($nasabah_profil->nama_nasabah ?? '') }}">
        </div>

        <h6 class="text-center font-weight-bold mb-3">KANTOR CABANG SYARIAH SURABAYA</h6>
        <h6 class="text-center border-bottom font-weight-bold py-2">SURAT PENCAIRAN/ADVIS PEMBIAYAAN </h6>

        <div class="form-group row align-items-center my-0 py-0">
            <label for="telah_direalisasi" class="col-2 col-form-label mb-0">Telah direalisasi pembiayaan</label>
            <div class="col-1 text-right px-0">:</div>
            <div class="col-9">
                <input type="text" id="telah_direalisasi" name="telah_direalisasi"
                    class="form-control p-0 bg-white text-danger border-0 font-weight-bold"
                    value="Pembiayaan KPR/KPM Syariah">
            </div>
        </div>

        <div class="form-group row align-items-center my-0 py-0">
            <label for="keputusan_tujuan_penggunaan" class="col-2 col-form-label mb-0">Tujuan Penggunaan</label>
            <div class="col-1 text-right px-0">:</div>
            <div class="col-9">
                <select class="form-control p-0 bg-white text-danger border-0 font-weight-bold"
                    id="keputusan_tujuan_penggunaan" name="keputusan_tujuan_penggunaan">
                    @php
                        $options = ['--', 'Pembiayaan Konsumtif', 'Pembiayaan Produktif'];

                        $selected = old('keputusan_tujuan_penggunaan', $pengajuan->keputusan_tujuan_penggunaan ?? '');
                    @endphp
                    @foreach ($options as $option)
                        <option value="{{ $option }}" {{ $selected == $option ? 'selected' : '' }}>
                            {{ $option }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row align-items-center my-0 py-0">
            <label for="akad_pembiayaan" class="col-2 col-form-label mb-0">Akad Pembiayaan No.</label>
            <div class="col-1 text-right px-0">:</div>
            <div class="col-9">
                <input type="text" id="akad_pembiayaan" name="akad_pembiayaan"
                    class="form-control p-0 bg-white text-danger border-0 font-weight-bold"
                    value="{{ sprintf('%04d', $pengajuan->id ?? 0) . '/' . strtoupper($nasabah_profil->nama_nasabah ?? '-') . '/MULTIGUNASYARIAH' }}">
            </div>
        </div>

        <div class="form-group row align-items-center my-0 py-0">
            <label for="atas_nama" class="col-2 col-form-label mb-0">Atas Nama</label>
            <div class="col-1 text-right px-0">:</div>
            <div class="col-9">
                <input type="text" id="atas_nama" name="atas_nama"
                    class="form-control p-0 bg-white text-danger border-0 font-weight-bold"
                    value="{{ $nasabah_profil->nama_nasabah ?? '' }}">
            </div>
        </div>

        <div class="form-group row align-items-center my-0 py-0">
            <label for="no_rekening" class="col-2 col-form-label mb-0">No. Rekening</label>
            <div class="col-1 text-right px-0">:</div>
            <div class="col-9">
                <input type="text" id="no_rekening" name="no_rekening"
                    class="form-control p-0 bg-white text-danger border-0 font-weight-bold" value="--">
            </div>
        </div>

        <div class="form-group row border-bottom mt-0 mb-2 py-0">
            <label for="alamat_lagi" class="col-2 col-form-label mb-0">Alamat</label>
            <div class="col-1 text-right px-0">:</div>
            <div class="col-9">
                <textarea id="alamat_lagi" name="alamat_lagi" class="form-control p-0 bg-white text-danger border-0 font-weight-bold"
                    rows="2">{{ $nasabah_profil->alamat_ktp_nasabah ?? '' }}</textarea>
            </div>
        </div>

        {{-- Pembiayaan --}}
        <div class="form-group row align-items-center my-0 py-0">
            <label for="keputusan_harga_beli_bank" class="col-2 col-form-label mb-0">Harga Beli Bank</label>
            <div class="col-1 text-right mx-0 px-0">:</div>
            <div class="col-9">
                <input type="number" id="keputusan_harga_beli_bank" name="keputusan_harga_beli_bank"
                    class="form-control p-0 bg-white text-danger border-0 font-weight-bold"
                    value="{{ old('keputusan_harga_beli_bank', $pengajuan->keputusan_harga_beli_bank ?? '') }}">
            </div>
        </div>

        <div class="form-group row my-0 py-0 align-items-center" style="display: none">

            <label for="keputusan_jangka_waktu_pembiayaan" class="col-2 col-form-label mb-0">
                Jangka Waktu (Tahun)
            </label>
            <div class="col-1 text-right px-0">:</div>
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

        <div class="form-group row align-items-center my-0 py-0">

            <label for="keputusan_margin_bank" class="col-2 col-form-label mb-0">
                Margin Bank (%/bln)
            </label>
            <div class="col-1 text-right px-0">:</div>
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

        <div class="form-group row align-items-center my-0 py-0">
            <label class="col-2 col-form-label mb-0">Harga Jual Bank</label>
            <div class="col-1 text-right px-0">:</div>
            <div class="col-9">
                <div id="keputusan_harga_jual_output" class="font-weight-bold text-dark">—</div>
            </div>
        </div>

        <div class="form-group border-bottom row align-items-center mt-0 mb-2 py-0">
            <label class="col-2 col-form-label mb-0">Angsuran per Bulan</label>
            <div class="col-1 text-right px-0">:</div>
            <div class="col-9">
                <div id="keputusan_angsuran_bank_output" class="font-weight-bold text-dark">—</div>
            </div>
        </div>

        {{-- Jaminan --}}
        <div class="form-group row align-items-center font-weight-bold my-0 py-0">
            <label class="col-6 col-form-label mb-0">Jaminan Utama</label>
        </div>

        @php
            $options = [
                'sk_pengangkatan_pegawai_tetap' => ['--', 'ADA (1)', 'TIDAK ADA (0)'],
                'sk_jabatan_terakhir_terkini' => ['--', 'ADA (1)', 'TIDAK ADA (0)'],
            ];
        @endphp

        @foreach ($options as $field => $values)
            <div class="row mt-0 mb-2 py-0">
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

        {{-- Biaya --}}
        <p class="font-weight-bold">Biaya-biaya</p>
        {{-- 1. Administrasi --}}
        <div class="form-group row align-items-center my-0 py-0">
            <label for="biaya_administrasi" class="col-2 col-form-label mb-0">1. Administrasi</label>
            <div class="col-1 text-right mx-0 px-0">:</div>
            <div class="col-9">
                <input type="number" id="biaya_administrasi" name="biaya_administrasi"
                    class="form-control p-0 bg-white text-danger border-0 font-weight-bold" value="500000">
            </div>
        </div>

        {{-- 2. Blokir 1x Angsuran --}}
        <div class="form-group row align-items-center my-0 py-0">
            <label for="biaya_blokir_angsuran" class="col-2 col-form-label mb-0">2. Blokir 1x Angsuran</label>
            <div class="col-1 text-right mx-0 px-0">:</div>
            <div class="col-9">
                <input disabled type="number" id="biaya_blokir_angsuran" name="biaya_blokir_angsuran"
                    class="form-control p-0 bg-white text-dark border-0 font-weight-bold" value="">
            </div>
        </div>

        {{-- 3. Materai --}}
        <div class="form-group row align-items-center my-0 py-0">
            <label for="biaya_materai" class="col-2 col-form-label mb-0">3. Materai</label>
            <div class="col-1 text-right mx-0 px-0">:</div>
            <div class="col-9">
                <input type="number" id="biaya_materai" name="biaya_materai"
                    class="form-control p-0 bg-white text-danger border-0 font-weight-bold" value="60000">
            </div>
        </div>

        {{-- 4. Asuransi Jiwa, PHK, Pembiayaan/Macet --}}
        <div class="form-group row align-items-center my-0 py-0">
            <label for="biaya_asuransi_jiwa" class="col-2 col-form-label mb-0">4. Asuransi Jiwa/PHK/Macet</label>
            <div class="col-1 text-right mx-0 px-0">:</div>
            <div class="col-9">
                <input disabled type="number" id="biaya_asuransi_jiwa" name="biaya_asuransi_jiwa"
                    class="form-control p-0 bg-white text-dark border-0 font-weight-bold" value="">
            </div>
        </div>

        {{-- 5. Asuransi Kebakaran --}}
        <div class="form-group row align-items-center my-0 py-0">
            <label for="biaya_asuransi_kebakaran" class="col-2 col-form-label mb-0">5. Asuransi Kebakaran</label>
            <div class="col-1 text-right mx-0 px-0">:</div>
            <div class="col-9">
                <input disabled type="number" id="biaya_asuransi_kebakaran" name="biaya_asuransi_kebakaran"
                    class="form-control p-0 bg-white text-dark border-0 font-weight-bold" value="">
            </div>
        </div>

        {{-- TOTAL BIAYA YANG HARUS DIBAYAR --}}
        <div class="form-group row align-items-center my-0 py-0">
            <label class="col-2 col-form-label mb-0 font-weight-bold text-uppercase">Total
                Biaya</label>
            <div class="col-1 text-right mx-0 px-0 font-weight-bold">:</div>
            <div class="col-9">
                <div id="total_biaya_output" class="font-weight-bold text-dark">—</div>
            </div>
        </div>

        <div class="form-group row align-items-center text-center font-weight-bold mt-5 py-5">
            <div class="col-6">
                <div>Manager Pembiayaan</div>
                <br><br><br>
                <div class="border-top pt-1 w-75 mx-auto">
                    <input type="text"
                        class="form-control p-0 bg-white text-danger text-center border-0 font-weight-bold"
                        value="Rusdan Mukmin">
                </div>
            </div>
            <div class="col-6">
                <div>Pimpinan Cabang</div>
                <br><br><br>
                <div class="border-top pt-1 w-75 mx-auto">
                    <input type="text"
                        class="form-control p-0 bg-white text-danger text-center border-0 font-weight-bold"
                        value="Ahmad Baraja">
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
