@extends('layouts.app')

@section('content')
    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="card card-social">
                    <div class="card-block border-bottom p-3">
                        <div class="row mb-2">
                            <div class="col-12">
                                <div class="d-flex gap-2 justify-content-start" id="nav-tab" role="tablist">
                                    <a href="{{ route('multiguna.pengajuan.data') }}" class="btn btn-secondary">
                                        ← Kembali
                                    </a>
                                </div>
                                <div class="row g-3 mb-3">
                                    @php
                                        use Carbon\Carbon;

                                        $marginPerBulan = floatval($pengajuan->keputusan_margin_bank);
                                        $jangkaTahun = floatval($pengajuan->keputusan_jangka_waktu_pembiayaan);
                                        $hargaBeli = floatval($pengajuan->keputusan_harga_beli_bank);

                                        $marginTahun = $marginPerBulan * $jangkaTahun;
                                        $nominalMargin = ($marginTahun / 100) * $hargaBeli;
                                        $hargaJualBank = $hargaBeli + $nominalMargin;

                                        $jangkaBulan = $jangkaTahun * 12;
                                        $angsuranPerBulan = $jangkaBulan != 0 ? $hargaJualBank / $jangkaBulan : 0;

                                        $tanggalPencairan = $pengajuan->tanggal_pencairan
                                            ? Carbon::parse($pengajuan->tanggal_pencairan)
                                            : null;
                                        $tanggalAngsuran = $tanggalPencairan
                                            ? $tanggalPencairan->copy()->addMonth()
                                            : null;
                                        $tanggalBerakhirAngsuran = $tanggalPencairan
                                            ? $tanggalPencairan->copy()->addMonths($jangkaBulan)
                                            : null;
                                    @endphp

                                    <div class="col-md-3 mt-2">
                                        <label for="nama_nasabah">Nama Pemohon</label>
                                    </div>
                                    <div class="col-md-3 mt-2" id="nama_nasabah">: <span
                                            class="font-weight-bold">{{ $pengajuan->nama_nasabah }}</span></div>

                                    <div class="col-md-3 mt-2">
                                        <label for="jenis_akad">Jenis Akad</label>
                                    </div>
                                    <div class="col-md-3 mt-2" id="jenis_akad">: <span
                                            class="font-weight-bold">{{ $pengajuan->keputusan_jenis_akad }}</span></div>

                                    <div class="col-md-3 mt-2">
                                        <label for="jenis_akad">Jenis Pembiayaan</label>
                                    </div>
                                    <div class="col-md-3 mt-2" id="jenis_akad">: <span
                                            class="font-weight-bold">{{ $pengajuan->keputusan_jenis_pembiayaan }}</span>
                                    </div>

                                    <div class="col-md-3 mt-2">
                                        <label for="tujuan_penggunaan">Tujuan untuk</label>
                                    </div>
                                    <div class="col-md-3 mt-2" id="tujuan_penggunaan">: <span
                                            class="font-weight-bold">{{ $pengajuan->keputusan_tujuan_penggunaan }}</span>
                                    </div>

                                    <div class="col-md-3 mt-2">
                                        <label for="harga_beli_bank">Harga Beli Bank</label>
                                    </div>
                                    <div class="col-md-3 mt-2" id="harga_beli_bank">: <span class="font-weight-bold">Rp
                                            {{ number_format($pengajuan->keputusan_harga_beli_bank, 0, ',', '.') }}</span>
                                    </div>

                                    <div class="col-md-3 mt-2">
                                        <label for="jangka_tahun">Jangka Waktu (tahun)</label>
                                    </div>
                                    <div class="col-md-3 mt-2" id="jangka_tahun">: <span
                                            class="font-weight-bold">{{ $jangkaTahun }} tahun</span></div>

                                    <div class="col-md-3 mt-2">
                                        <label for="jangka_bulan">Jangka Waktu (bulan)</label>
                                    </div>
                                    <div class="col-md-3 mt-2" id="jangka_bulan">: <span
                                            class="font-weight-bold">{{ $jangkaBulan }} bulan</span></div>

                                    <div class="col-md-3 mt-2">
                                        <label for="margin_per_bulan">Margin Bank (% / bulan)</label>
                                    </div>
                                    <div class="col-md-3 mt-2" id="margin_per_bulan">: <span
                                            class="font-weight-bold">{{ $marginPerBulan }}%</span></div>

                                    <div class="col-md-3 mt-2">
                                        <label for="margin_tahun">Margin Bank (% / tahun)</label>
                                    </div>
                                    <div class="col-md-3 mt-2" id="margin_tahun">: <span
                                            class="font-weight-bold">{{ number_format($marginTahun, 2, ',', '.') }}%</span>
                                    </div>

                                    <div class="col-md-3 mt-2">
                                        <label for="nominal_margin">Nominal Margin Bank</label>
                                    </div>
                                    <div class="col-md-3 mt-2" id="nominal_margin">: <span class="font-weight-bold">Rp
                                            {{ number_format($nominalMargin, 0, ',', '.') }}</span></div>

                                    <div class="col-md-3 mt-2">
                                        <label for="harga_jual_bank">Harga Jual Bank</label>
                                    </div>
                                    <div class="col-md-3 mt-2" id="harga_jual_bank">: <span class="font-weight-bold">Rp
                                            {{ number_format($hargaJualBank, 0, ',', '.') }}</span></div>

                                    <div class="col-md-3 mt-2">
                                        <label for="angsuran_per_bulan">Angsuran Per Bulan</label>
                                    </div>
                                    <div class="col-md-3 mt-2" id="angsuran_per_bulan">: <span class="font-weight-bold">Rp
                                            {{ number_format($angsuranPerBulan, 0, ',', '.') }}</span></div>

                                    <div class="col-md-3 mt-2">
                                        <label for="keputusan">Rekomendasi Keputusan Pembiayaan</label>
                                    </div>
                                    <div class="col-md-3 mt-2" id="keputusan">: <span class="font-weight-bold">
                                            {{ $pengajuan->keputusan }}</span></div>
                                </div>
                                <div class="row g-3 border-top mb-3">
                                    <div class="col-md-3 mt-2">
                                        <label for="tanggal_pencairan">Tanggal Pencairan</label>
                                    </div>
                                    <div class="col-md-9 mt-2" id="tanggal_pencairan">: <span class="font-weight-bold">
                                            {{ $tanggalPencairan ? $tanggalPencairan->format('d-m-Y') : '-' }}</span></div>

                                    <div class="col-md-3 mt-2">
                                        <label for="tanggal_angsuran_pertama">Tanggal Pertama kali angsuran</label>
                                    </div>
                                    <div class="col-md-9 mt-2" id="tanggal_angsuran_pertama">: <span
                                            class="font-weight-bold">
                                            {{ $tanggalAngsuran ? $tanggalAngsuran->format('d-m-Y') : '-' }}</span></div>

                                    <div class="col-md-3 mt-2">
                                        <label for="tanggal_angsuran_terakhir">Tanggal Berakhir Angsuran</label>
                                    </div>
                                    <div class="col-md-9 mt-2" id="tanggal_angsuran_terakhir">: <span
                                            class="font-weight-bold">
                                            {{ $tanggalBerakhirAngsuran ? $tanggalBerakhirAngsuran->format('d-m-Y') : '-' }}</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-block border-bottom p-3">
                        @php
                            // Data dasar
                            $marginTotal = (($marginPerBulan * $jangkaTahun) / 100) * $hargaBeli;

                            $hargaJualBank = $hargaBeli + $marginTotal;

                            // Cegah division by zero
                            $pokokPerBulan = $jangkaBulan != 0 ? $hargaBeli / $jangkaBulan : 0;
                            $marginPerBulanNominal = $jangkaBulan != 0 ? $marginTotal / $jangkaBulan : 0;
                            $totalAngsuranPerBulan = $pokokPerBulan + $marginPerBulanNominal;

                            // Sisa awal
                            $sisaPokok = $hargaBeli;
                            $sisaMargin = $marginTotal;
                            $sisaHargaJual = $hargaJualBank;
                        @endphp
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="text-center">
                                    <tr>
                                        <th class="align-middle p-1" rowspan="2">Angsuran ke</th>
                                        <th class="align-middle p-1" rowspan="2">Tanggal</th>
                                        <th class="align-middle p-1" colspan="3">Angsuran</th>
                                        <th class="align-middle p-1" colspan="3">Sisa (Outstanding)</th>
                                    </tr>
                                    <tr>
                                        <th class="align-middle p-1">Harga Pokok</th>
                                        <th class="align-middle p-1">Margin</th>
                                        <th class="align-middle p-1">Total</th>
                                        <th class="align-middle p-1">Harga Pokok</th>
                                        <th class="align-middle p-1">Margin</th>
                                        <th class="align-middle p-1">Harga Jual</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($pengajuan->tanggal_pencairan) && $tanggalAngsuran)
                                        @for ($i = 1; $i <= $jangkaBulan; $i++)
                                            <tr class="text-center">
                                                <td style="width: 30px;"
                                                    class="text-center text-wrap align-middle p-1 m-0">
                                                    {{ $i }}
                                                </td>
                                                <td class="text-center text-wrap align-middle p-1 m-0">
                                                    {{ $tanggalAngsuran->format('d-M-Y') }}
                                                </td>
                                                <td class="text-center text-wrap align-middle p-1 m-0">
                                                    Rp {{ number_format($pokokPerBulan, 0, ',', '.') }}
                                                </td>
                                                <td class="text-center text-wrap align-middle p-1 m-0">
                                                    Rp {{ number_format($marginPerBulanNominal, 0, ',', '.') }}
                                                </td>
                                                <td class="text-center text-wrap align-middle p-1 m-0">
                                                    Rp {{ number_format($totalAngsuranPerBulan, 0, ',', '.') }}
                                                </td>
                                                <td class="text-center text-wrap align-middle p-1 m-0">
                                                    Rp
                                                    {{ number_format(max(0, $sisaPokok - $pokokPerBulan), 0, ',', '.') }}
                                                </td>
                                                <td class="text-center text-wrap align-middle p-1 m-0">
                                                    Rp
                                                    {{ number_format(max(0, $sisaMargin - $marginPerBulanNominal), 0, ',', '.') }}
                                                </td>
                                                <td class="text-center text-wrap align-middle p-1 m-0">
                                                    Rp
                                                    {{ number_format(max(0, $sisaHargaJual - $totalAngsuranPerBulan), 0, ',', '.') }}
                                                </td>
                                            </tr>

                                            @php
                                                // Update tanggal & sisa outstanding
                                                $tanggalAngsuran->addMonth();
                                                $sisaPokok -= $pokokPerBulan;
                                                $sisaMargin -= $marginPerBulanNominal;
                                                $sisaHargaJual -= $totalAngsuranPerBulan;
                                            @endphp
                                        @endfor
                                    @else
                                        <tr>
                                            <td colspan="8" class="text-left text-muted p-2">
                                                Tanggal pencairan tidak ditemukan, jadwal angsuran tidak dapat ditampilkan.
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
@endsection
