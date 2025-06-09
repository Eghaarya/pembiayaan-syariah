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
                                <form action="{{ route('murabahah.limac.capacity.update', $pengajuan->kode_pengajuan) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="kode_nasabah" value="{{ $pengajuan->kode_nasabah }}">

                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-1-tab" data-toggle="tab"
                                                data-target="#nav-1" type="button" role="tab" aria-controls="nav-1"
                                                aria-selected="true">Perincian Rekening Tabungan</button>
                                            <button class="nav-link" id="nav-2-tab" data-toggle="tab" data-target="#nav-2"
                                                type="button" role="tab" aria-controls="nav-2"
                                                aria-selected="true">Kondisi Keuangan</button>
                                            <button class="nav-link" id="nav-3-tab" data-toggle="tab" data-target="#nav-3"
                                                type="button" role="tab" aria-controls="nav-3"
                                                aria-selected="true">Kemauan Membayar</button>
                                            <button class="nav-link" id="nav-4-tab" data-toggle="tab" data-target="#nav-4"
                                                type="button" role="tab" aria-controls="nav-4"
                                                aria-selected="true">Perhitungan Nilai Pembiayaan</button>
                                        </div>
                                    </nav>

                                    <div class="tab-content p-3" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-1" role="tabpanel"
                                            aria-labelledby="nav-1-tab">
                                            <h6 class="border-bottom pb-2">Data Rekening Tabungan Nasabah 3 bulan terakhir
                                            </h6>

                                            <div class="row g-3 mb-3">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-sm text-center">
                                                        <thead>
                                                            <tr class="text-center">
                                                                <th class="align-middle bg-white p-1" rowspan="3">Nama
                                                                    Bank Nasabah</th>
                                                                <th class="align-middle bg-white p-1" rowspan="3">No
                                                                    Account Nasabah</th>
                                                                <th class="align-middle bg-white p-1">Tanggal</th>
                                                                <th class="align-middle bg-white p-1">Saldo Awal</th>
                                                                <th class="align-middle bg-white p-1">Total Debet</th>
                                                                <th class="align-middle bg-white p-1">Total Kredit</th>
                                                                <th class="align-middle bg-white p-1">Saldo Akhir</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @for ($i = 1; $i <= 3; $i++)
                                                                <tr>
                                                                    @if ($i == 1)
                                                                        <td class="p-1" class="p-1" rowspan="3">
                                                                            <input type="text" name="nama_bank_nasabah"
                                                                                value="{{ old('nama_bank_nasabah', $pengajuan->nama_bank_nasabah) }}"
                                                                                class="form-control form-control-sm text-center p-1" />
                                                                        </td>
                                                                        <td class="p-1" rowspan="3">
                                                                            <input type="text"
                                                                                name="no_bank_account_nasabah"
                                                                                value="{{ old('no_bank_account_nasabah', $pengajuan->no_bank_account_nasabah) }}"
                                                                                class="form-control form-control-sm text-center p-1" />
                                                                        </td>
                                                                    @endif

                                                                    <td class="p-1">
                                                                        <input type="date"
                                                                            name="tanggal_nasabah_bulan_{{ $i }}"
                                                                            value="{{ old("tanggal_nasabah_bulan_$i", $pengajuan->{"tanggal_nasabah_bulan_$i"}) }}"
                                                                            class="form-control form-control-sm text-center p-1" />
                                                                    </td>
                                                                    <td class="p-1">
                                                                        <input type="number" step="0.01"
                                                                            name="saldo_awal_nasabah_bulan_{{ $i }}"
                                                                            value="{{ old("saldo_awal_nasabah_bulan_$i", $pengajuan->{"saldo_awal_nasabah_bulan_$i"}) }}"
                                                                            class="form-control form-control-sm text-center p-1" />
                                                                    </td>
                                                                    <td class="p-1">
                                                                        <input type="number" step="0.01"
                                                                            name="total_debet_nasabah_bulan_{{ $i }}"
                                                                            value="{{ old("total_debet_nasabah_bulan_$i", $pengajuan->{"total_debet_nasabah_bulan_$i"}) }}"
                                                                            class="form-control form-control-sm text-center p-1" />
                                                                    </td>
                                                                    <td class="p-1">
                                                                        <input type="number" step="0.01"
                                                                            name="total_kredit_nasabah_bulan_{{ $i }}"
                                                                            value="{{ old("total_kredit_nasabah_bulan_$i", $pengajuan->{"total_kredit_nasabah_bulan_$i"}) }}"
                                                                            class="form-control form-control-sm text-center p-1" />
                                                                    </td>
                                                                    <td class="p-1">
                                                                        <input type="number" step="0.01"
                                                                            name="saldo_akhir_nasabah_bulan_{{ $i }}"
                                                                            value="{{ old("saldo_akhir_nasabah_bulan_$i", $pengajuan->{"saldo_akhir_nasabah_bulan_$i"}) }}"
                                                                            class="form-control form-control-sm text-center p-1" />
                                                                    </td>
                                                                </tr>
                                                            @endfor
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <h6 class="border-bottom pb-2 mt-4">Data Rekening Tabungan Pasangan 3 bulan
                                                terakhir
                                            </h6>

                                            <div class="row g-3 mb-3">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-sm text-center">
                                                        <thead>
                                                            <tr>
                                                                <th class="align-middle bg-white p-1" rowspan="3">Nama
                                                                    Bank Pasangan</th>
                                                                <th class="align-middle bg-white p-1" rowspan="3">No
                                                                    Account Pasangan</th>
                                                                <th class="align-middle bg-white p-1">Tanggal</th>
                                                                <th class="align-middle bg-white p-1">Saldo Awal</th>
                                                                <th class="align-middle bg-white p-1">Total Debet</th>
                                                                <th class="align-middle bg-white p-1">Total Kredit</th>
                                                                <th class="align-middle bg-white p-1">Saldo Akhir</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @for ($i = 1; $i <= 3; $i++)
                                                                <tr>
                                                                    @if ($i == 1)
                                                                        <td class="p-1" rowspan="3">
                                                                            <input type="text"
                                                                                name="nama_bank_pasangan"
                                                                                value="{{ old('nama_bank_pasangan', $pengajuan->nama_bank_pasangan) }}"
                                                                                class="form-control form-control-sm text-center p-1" />
                                                                        </td>
                                                                        <td class="p-1" rowspan="3">
                                                                            <input type="text"
                                                                                name="no_bank_account_pasangan"
                                                                                value="{{ old('no_bank_account_pasangan', $pengajuan->no_bank_account_pasangan) }}"
                                                                                class="form-control form-control-sm text-center p-1" />
                                                                        </td>
                                                                    @endif

                                                                    <td class="p-1">
                                                                        <input type="date"
                                                                            name="tanggal_pasangan_bulan_{{ $i }}"
                                                                            value="{{ old("tanggal_pasangan_bulan_$i", $pengajuan->{"tanggal_pasangan_bulan_$i"}) }}"
                                                                            class="form-control form-control-sm text-center p-1" />
                                                                    </td>
                                                                    <td class="p-1">
                                                                        <input type="number" step="0.01"
                                                                            name="saldo_awal_pasangan_bulan_{{ $i }}"
                                                                            value="{{ old("saldo_awal_pasangan_bulan_$i", $pengajuan->{"saldo_awal_pasangan_bulan_$i"}) }}"
                                                                            class="form-control form-control-sm text-center p-1" />
                                                                    </td>
                                                                    <td class="p-1">
                                                                        <input type="number" step="0.01"
                                                                            name="total_debet_pasangan_bulan_{{ $i }}"
                                                                            value="{{ old("total_debet_pasangan_bulan_$i", $pengajuan->{"total_debet_pasangan_bulan_$i"}) }}"
                                                                            class="form-control form-control-sm text-center p-1" />
                                                                    </td>
                                                                    <td class="p-1">
                                                                        <input type="number" step="0.01"
                                                                            name="total_kredit_pasangan_bulan_{{ $i }}"
                                                                            value="{{ old("total_kredit_pasangan_bulan_$i", $pengajuan->{"total_kredit_pasangan_bulan_$i"}) }}"
                                                                            class="form-control form-control-sm text-center p-1" />
                                                                    </td>
                                                                    <td class="p-1">
                                                                        <input type="number" step="0.01"
                                                                            name="saldo_akhir_pasangan_bulan_{{ $i }}"
                                                                            value="{{ old("saldo_akhir_pasangan_bulan_$i", $pengajuan->{"saldo_akhir_pasangan_bulan_$i"}) }}"
                                                                            class="form-control form-control-sm text-center p-1" />
                                                                    </td>
                                                                </tr>
                                                            @endfor
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="d-flex gap-2 justify-content-start mt-3" id="nav-tab"
                                                role="tablist">
                                                <a href="{{ route('murabahah.limac.capacity.data') }}"
                                                    class="btn btn-secondary">
                                                    ← Kembali
                                                </a>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-2" role="tabpanel"
                                            aria-labelledby="nav-2-tab">
                                            <h6 class="border-bottom pb-2">Hutang/Pinjaman Nasabah
                                            </h6>

                                            <div class="row g-3 mb-3 p-1">
                                                <div class="table-responsive mb-4">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr class="text-center">
                                                                <th class="bg-white p-1">#</th>
                                                                <th class="bg-white p-1">Jenis Pinjaman</th>
                                                                <th class="bg-white p-1">Limit</th>
                                                                <th class="bg-white p-1">Jangka Waktu</th>
                                                                <th class="bg-white p-1">Sisa Hutang</th>
                                                                <th class="bg-white p-1">Kreditur</th>
                                                                <th class="bg-white p-1">Agunan</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @for ($i = 1; $i <= 3; $i++)
                                                                <tr>
                                                                    <td class="p-1 align-middle text-center">
                                                                        {{ $i }}</td>
                                                                    <td class="p-1"><input type="text"
                                                                            name="jenis_pinjaman_nasabah_{{ $i }}"
                                                                            class="form-control align-middle text-center"
                                                                            value="{{ old("jenis_pinjaman_nasabah_$i", $pengajuan->{"jenis_pinjaman_nasabah_$i"}) }}">
                                                                    </td>
                                                                    <td class="p-1 "><input type="text"
                                                                            name="limit_nasabah_{{ $i }}"
                                                                            class="form-control align-middle text-center"
                                                                            value="{{ old("limit_nasabah_$i", $pengajuan->{"limit_nasabah_$i"}) }}">
                                                                    </td>
                                                                    <td class="p-1"><input type="text"
                                                                            name="jangka_waktu_nasabah_{{ $i }}"
                                                                            class="form-control align-middle text-center"
                                                                            value="{{ old("jangka_waktu_nasabah_$i", $pengajuan->{"jangka_waktu_nasabah_$i"}) }}">
                                                                    </td>
                                                                    <td class="p-1"><input type="number"
                                                                            step="0.01"
                                                                            name="sisa_hutang_nasabah_{{ $i }}"
                                                                            class="form-control align-middle text-center"
                                                                            value="{{ old("sisa_hutang_nasabah_$i", $pengajuan->{"sisa_hutang_nasabah_$i"}) }}">
                                                                    </td>
                                                                    <td class="p-1"><input type="text"
                                                                            name="kreditur_nasabah_{{ $i }}"
                                                                            class="form-control align-middle text-center"
                                                                            value="{{ old("kreditur_nasabah_$i", $pengajuan->{"kreditur_nasabah_$i"}) }}">
                                                                    </td>
                                                                    <td class="p-1"><input type="text"
                                                                            name="agunan_nasabah_{{ $i }}"
                                                                            class="form-control align-middle text-center"
                                                                            value="{{ old("agunan_nasabah_$i", $pengajuan->{"agunan_nasabah_$i"}) }}">
                                                                    </td>
                                                                </tr>
                                                            @endfor
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <h6 class="border-bottom pb-2">Hutang/Pinjaman Pasangan
                                            </h6>

                                            <div class="row g-3 mb-3 p-1">
                                                <div class="table-responsive mb-4">
                                                    <table class="table table-bordered text-center">
                                                        <thead class="thead-light">
                                                            <tr class="text-center">
                                                                <th class="bg-white p-1">#</th>
                                                                <th class="bg-white p-1">Jenis Pinjaman</th>
                                                                <th class="bg-white p-1">Limit</th>
                                                                <th class="bg-white p-1">Jangka Waktu</th>
                                                                <th class="bg-white p-1">Sisa Hutang</th>
                                                                <th class="bg-white p-1">Kreditur</th>
                                                                <th class="bg-white p-1">Agunan</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @for ($i = 1; $i <= 3; $i++)
                                                                <tr>
                                                                    <td class="p-1 align-middle text-center">
                                                                        {{ $i }}</td>
                                                                    <td class="p-1"><input type="text"
                                                                            name="jenis_pinjaman_pasangan_{{ $i }}"
                                                                            class="form-control align-middle text-center"
                                                                            value="{{ old("jenis_pinjaman_pasangan_$i", $pengajuan->{"jenis_pinjaman_pasangan_$i"}) }}">
                                                                    </td>
                                                                    <td class="p-1"><input type="text"
                                                                            name="limit_pasangan_{{ $i }}"
                                                                            class="form-control align-middle text-center"
                                                                            value="{{ old("limit_pasangan_$i", $pengajuan->{"limit_pasangan_$i"}) }}">
                                                                    </td>
                                                                    <td class="p-1"><input type="text"
                                                                            name="jangka_waktu_pasangan_{{ $i }}"
                                                                            class="form-control align-middle text-center"
                                                                            value="{{ old("jangka_waktu_pasangan_$i", $pengajuan->{"jangka_waktu_pasangan_$i"}) }}">
                                                                    </td>
                                                                    <td class="p-1"><input type="number"
                                                                            step="0.01"
                                                                            name="sisa_hutang_pasangan_{{ $i }}"
                                                                            class="form-control align-middle text-center"
                                                                            value="{{ old("sisa_hutang_pasangan_$i", $pengajuan->{"sisa_hutang_pasangan_$i"}) }}">
                                                                    </td>
                                                                    <td class="p-1"><input type="text"
                                                                            name="kreditur_pasangan_{{ $i }}"
                                                                            class="form-control align-middle text-center"
                                                                            value="{{ old("kreditur_pasangan_$i", $pengajuan->{"kreditur_pasangan_$i"}) }}">
                                                                    </td>
                                                                    <td class="p-1"><input type="text"
                                                                            name="agunan_pasangan_{{ $i }}"
                                                                            class="form-control align-middle text-center"
                                                                            value="{{ old("agunan_pasangan_$i", $pengajuan->{"agunan_pasangan_$i"}) }}">
                                                                    </td>
                                                                </tr>
                                                            @endfor
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <h6 class="border-bottom pb-2">Penghasilan dan Pengeluaran
                                            </h6>

                                            <div class="row g-3 mb-3 p-1">
                                                <div class="table-responsive">
                                                    @php
                                                        $penghasilan_fields = [
                                                            [
                                                                'label' => 'Penghasilan Nasabah',
                                                                'name' => 'penghasilan_nasabah',
                                                            ],
                                                            [
                                                                'label' => 'Penghasilan Pasangan',
                                                                'name' => 'penghasilan_pasangan',
                                                            ],
                                                            [
                                                                'label' => 'Sumber Penghasilan Lain',
                                                                'name' => 'sumber_penghasilan_lain',
                                                            ],
                                                        ];

                                                        $pengeluaran_fields = [
                                                            [
                                                                'label' => 'Sewa/Pemeliharaan Rumah',
                                                                'name' => 'biaya_sewa_rumah',
                                                            ],
                                                            ['label' => 'Biaya Makan', 'name' => 'biaya_makan'],
                                                            [
                                                                'label' => 'Biaya Transportasi',
                                                                'name' => 'biaya_transportasi',
                                                            ],
                                                            [
                                                                'label' => 'Biaya Pendidikan',
                                                                'name' => 'biaya_pendidikan',
                                                            ],
                                                            [
                                                                'label' => 'Biaya Listrik, Air, Gas',
                                                                'name' => 'biaya_listrik_air_gas',
                                                            ],
                                                            [
                                                                'label' => 'Angsuran Pinjaman',
                                                                'name' => 'angsuran_pinjaman',
                                                            ],
                                                            ['label' => 'Premi Asuransi', 'name' => 'premi_asuransi'],
                                                            [
                                                                'label' => 'Tabungan Berjangka',
                                                                'name' => 'tabungan_berjangka',
                                                            ],
                                                            [
                                                                'label' => 'Pengeluaran Lain',
                                                                'name' => 'pengeluaran_lain',
                                                            ],
                                                        ];
                                                    @endphp

                                                    <table class="table table-bordered text-center">
                                                        <thead>
                                                            <tr class="bg-light fw-bold">
                                                                <td colspan="3" class="text-left p-1"
                                                                    style="color: red">Penghasilan</td>
                                                            </tr>
                                                            <tr>
                                                                <th class="align-middle bg-white p-2">Penghasilan</th>
                                                                <th class="align-middle bg-white p-2">Jumlah per bulan
                                                                    (Rp.)</th>
                                                                <th class="align-middle bg-white p-2">Ket</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="penghasilan-section">
                                                            @foreach ($penghasilan_fields as $field)
                                                                <tr>
                                                                    <td class="align-middle text-left p-1">
                                                                        {{ $field['label'] }}</td>
                                                                    <td class="p-1">
                                                                        <input type="number" step="0.01"
                                                                            name="{{ $field['name'] }}"
                                                                            class="form-control align-middle text-center form-control-sm penghasilan-input"
                                                                            value="{{ old($field['name'], $pengajuan->{$field['name']}) }}"
                                                                            oninput="hitungTotal()">
                                                                    </td>
                                                                    <td class="p-1">
                                                                        <input type="text" maxlength="50"
                                                                            name="keterangan_{{ $field['name'] }}"
                                                                            class="form-control form-control-sm"
                                                                            value="{{ old('keterangan_' . $field['name'], $pengajuan->{'keterangan_' . $field['name']} ?? '') }}">
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            <tr class="font-weight-bold">
                                                                <td class="text-start p-2">Total Penghasilan</td>
                                                                <td class="text-end p-2" id="total-penghasilan">Rp. 0,00
                                                                </td>
                                                            </tr>
                                                        </tbody>

                                                        <thead>
                                                            <tr class="bg-light font-weight-bold">
                                                                <td colspan="3" class="text-left p-1"
                                                                    style="color: red">Pengeluaran</td>
                                                            </tr>
                                                            <tr>
                                                                <th class="align-middle bg-white p-2">Pengeluaran</th>
                                                                <th class="align-middle bg-white p-2">Jumlah per bulan
                                                                    (Rp.)</th>
                                                                <th class="align-middle bg-white p-2">Ket</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="pengeluaran-section">
                                                            @foreach ($pengeluaran_fields as $field)
                                                                <tr>
                                                                    <td class="align-middle text-left p-1">
                                                                        {{ $field['label'] }}</td>
                                                                    <td class="p-1">
                                                                        <input type="number" step="0.01"
                                                                            name="{{ $field['name'] }}"
                                                                            class="form-control align-middle text-center form-control-sm pengeluaran-input"
                                                                            value="{{ old($field['name'], $pengajuan->{$field['name']}) }}"
                                                                            oninput="hitungTotal()">
                                                                    </td>
                                                                    <td class="p-1">
                                                                        <input type="text" maxlength="50"
                                                                            name="keterangan_{{ $field['name'] }}"
                                                                            class="form-control align-middle form-control-sm"
                                                                            value="{{ old('keterangan_' . $field['name'], $pengajuan->{'keterangan_' . $field['name']} ?? '') }}">
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            <tr class="font-weight-bold">
                                                                <td class="text-start p-2">Total Pengeluaran</td>
                                                                <td class="text-end p-2" id="total-pengeluaran">Rp. 0,00
                                                                </td>
                                                            </tr>
                                                            <tr class="bg-success text-white font-weight-bold">
                                                                <td class="text-start p-2">Penghasilan Bersih</td>
                                                                <td class="text-end p-2" id="penghasilan-bersih">Rp. 0,00
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>

                                            <h6 class="border-bottom pb-2">Maksimal Angsuran
                                            </h6>

                                            <div class="row g-3 mb-3 p-1">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td class="align-middle p-1">Alternatif 1</td>
                                                                <td class="text-right p-2" id="nominal-alternatif-1">Rp.
                                                                    0,00

                                                                <td class="align-middle p-1"> x 70%</td>
                                                                <td class="align-middle p-1" id="maks-angsuran-1">Rp. 0,00
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="align-middle p-1">Alternatif 2</td>
                                                                <td class="text-right p-2" id="nominal-alternatif-2">Rp.
                                                                    0,00
                                                                <td class="align-middle p-1"> x 40%</td>
                                                                <td class="align-middle p-1" id="maks-angsuran-2">Rp. 0,00
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="tab-pane fade" id="nav-3" role="tabpanel"
                                            aria-labelledby="nav-3-tab">
                                            <h6 class="border-bottom pb-2">Kemauan Membayar</h6>

                                            <div class="row g-3 mb-3">
                                                <div class="col-md-6 mt-2">
                                                    <label for="tempatkerja_kelokasi_bank"
                                                        class="form-label fw-bold text-info">
                                                        Tempat Kerja Thd Lokasi Bank
                                                    </label>
                                                    @php
                                                        $tempatKerjaBankOptions = [
                                                            '--',
                                                            '<10km (5)',
                                                            '10-30km (4)',
                                                            '30-60km (3)',
                                                            'Luar negeri (1)',
                                                            'Luar pulau (2)',
                                                        ];
                                                        $selectedBank = old(
                                                            'tempatkerja_kelokasi_bank',
                                                            $pengajuan->tempatkerja_kelokasi_bank,
                                                        );
                                                    @endphp
                                                    <select class="form-control" id="tempatkerja_kelokasi_bank"
                                                        name="tempatkerja_kelokasi_bank">
                                                        @foreach ($tempatKerjaBankOptions as $label)
                                                            <option value="{{ $label }}"
                                                                {{ $selectedBank === $label ? 'selected' : '' }}>
                                                                {{ $label }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="tempatkerja_kelokasi_agunan"
                                                        class="form-label fw-bold text-info">
                                                        Tempat Kerja Thd Lokasi Agunan
                                                    </label>
                                                    @php
                                                        $tempatKerjaAgunanOptions = [
                                                            '--',
                                                            '<10km (5)',
                                                            '10-30km (4)',
                                                            '30-60km (3)',
                                                            'Luar negeri (2)',
                                                            'Luar pulau (1)',
                                                        ];
                                                        $selectedAgunan = old(
                                                            'tempatkerja_kelokasi_agunan',
                                                            $pengajuan->tempatkerja_kelokasi_agunan,
                                                        );
                                                    @endphp
                                                    <select class="form-control" id="tempatkerja_kelokasi_agunan"
                                                        name="tempatkerja_kelokasi_agunan">
                                                        @foreach ($tempatKerjaAgunanOptions as $label)
                                                            <option value="{{ $label }}"
                                                                {{ $selectedAgunan === $label ? 'selected' : '' }}>
                                                                {{ $label }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="pembayaran_kolektif" class="form-label fw-bold text-info">
                                                        Pembayaran Kolektif
                                                    </label>
                                                    @php
                                                        $pembayaranKolektifOptions = [
                                                            '--',
                                                            'Ada payroll & bersedia potong gaji (3)',
                                                            'Ada perjanjian kerjasama & Debitur bersedia (2)',
                                                            'Tidak ada perjanjian kerjasama & debitur berswdia (1)',
                                                        ];
                                                        $selectedKolektif = old(
                                                            'pembayaran_kolektif',
                                                            $pengajuan->pembayaran_kolektif,
                                                        );
                                                    @endphp
                                                    <select class="form-control" id="pembayaran_kolektif"
                                                        name="pembayaran_kolektif">
                                                        @foreach ($pembayaranKolektifOptions as $label)
                                                            <option value="{{ $label }}"
                                                                {{ $selectedKolektif === $label ? 'selected' : '' }}>
                                                                {{ $label }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="pembayaran_nonkolektif"
                                                        class="form-label fw-bold text-info">
                                                        Pembayaran Non Kolektif
                                                    </label>
                                                    @php
                                                        $pembayaranNonKolektifOptions = [
                                                            '--',
                                                            'Bersedia debit rekening (2)',
                                                            'Lainnya (1)',
                                                        ];
                                                        $selectedNonKolektif = old(
                                                            'pembayaran_nonkolektif',
                                                            $pengajuan->pembayaran_nonkolektif,
                                                        );
                                                    @endphp
                                                    <select class="form-control" id="pembayaran_nonkolektif"
                                                        name="pembayaran_nonkolektif">
                                                        @foreach ($pembayaranNonKolektifOptions as $label)
                                                            <option value="{{ $label }}"
                                                                {{ $selectedNonKolektif === $label ? 'selected' : '' }}>
                                                                {{ $label }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-4" role="tabpanel"
                                            aria-labelledby="nav-4-tab">
                                            <h6 class="border-bottom pb-2">Berdasarkan Income(terkecil dari Net atau Gross)
                                                dan Jangka Waktu Maksimal</h6>

                                            <div class="row g-3 mb-3">
                                                <div class="col-md-6 mt-2">
                                                    <label for="jangkaWaktuTahun">Jangka Waktu Pembiayaan (Tahun)</label>
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <input type="number" class="form-control" id="jangkaWaktuTahun"
                                                        name="jangka_waktu_pembiayaan"
                                                        value="{{ old('jangka_waktu_pembiayaan', $pengajuan->jangka_waktu_pembiayaan) }}"
                                                        oninput="hitungHargaJual()">
                                                </div>
                                            </div>
                                            <div class="row g-3 mb-3">
                                                <div class="col-6">Jangka Waktu Pembiayaan
                                                    (Bulan)</div>
                                                <div class="col-6 text-left font-weight-bold" id="jangkaWaktuBulan">12
                                                </div>
                                            </div>
                                            <div class="row g-3 mb-3">
                                                <div class="col-6">Pembiayaan</div>
                                                <div class="col-6 text-left font-weight-bold" id="pembiayaan">Rp. 0,00
                                                </div>
                                            </div>
                                            <div class="row g-3 mb-3">
                                                <div class="col-6">Margin Bank</div>
                                                <div class="col-6 text-left font-weight-bold" id="marginBank">Rp. 0,00
                                                </div>
                                            </div>
                                            <div class="row g-3 mb-3">
                                                <div class="col-6">Harga Jual Bank</div>
                                                <div class="col-6 text-left font-weight-bold" id="hargaJualBank">Rp. 0,00
                                                </div>
                                            </div>
                                            <div class="row g-3 mb-3">
                                                <div class="col-6">Angsuran Per Bulan <span
                                                        class="font-italic text-danger">(diambil
                                                        angsuran terkecil
                                                        pada maksimal angsuran)</span></div>
                                                <div class="col-6 text-left font-weight-bold" id="angsuranPerBulan">Rp.
                                                    0,00</div>
                                            </div>

                                            <div class="d-flex gap-2 justify-content-start mt-3" id="nav-tab"
                                                role="tablist">
                                                <button type="submit" class="btn btn-warning">
                                                    <i class="fas fa-save me-2"></i> Simpan Perubahan
                                                    {{ ucwords(str_replace('_', ' ', explode('.', Route::currentRouteName())[2] ?? '')) }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function hitungHargaJual() {
            let tahun = parseFloat(document.getElementById('jangkaWaktuTahun').value) || 0;
            let bulan = tahun * 12;
            document.getElementById('jangkaWaktuBulan').textContent = ': ' + bulan + ' bulan';

            // Ambil angsuran minimum dari dua alternatif
            let alt1 = parseCurrency(document.getElementById('maks-angsuran-1').textContent);
            let alt2 = parseCurrency(document.getElementById('maks-angsuran-2').textContent);
            let angsuranPerBulan = Math.min(alt1, alt2);

            let hargaJual = 0;
            let pembiayaan = 0;

            if (!isNaN(angsuranPerBulan) && bulan > 0) {
                hargaJual = angsuranPerBulan * bulan;

                if (!isNaN(tahun) && (1 + tahun) !== 0) {
                    pembiayaan = hargaJual / (1 + tahun);
                }
            }

            // Fallback ke 0 jika hasil tetap NaN
            hargaJual = isNaN(hargaJual) ? 0 : hargaJual;
            pembiayaan = isNaN(pembiayaan) ? 0 : pembiayaan;

            let margin = hargaJual - pembiayaan;

            document.getElementById('angsuranPerBulan').textContent = ': ' + formatRupiah(angsuranPerBulan);
            document.getElementById('hargaJualBank').textContent = ': ' + formatRupiah(hargaJual);
            document.getElementById('pembiayaan').textContent = ': ' + formatRupiah(pembiayaan);
            document.getElementById('marginBank').textContent = ': ' + formatRupiah(margin);
        }

        function parseCurrency(str) {
            return parseFloat(str.replace(/[^\d,-]/g, '').replace(',', '.')) || 0;
        }

        // Panggil ulang saat penghasilan dihitung
        function hitungTotal() {
            let totalPenghasilan = 0;
            let totalPengeluaran = 0;

            document.querySelectorAll('.penghasilan-input').forEach(input => {
                totalPenghasilan += parseFloat(input.value) || 0;
            });

            document.querySelectorAll('.pengeluaran-input').forEach(input => {
                totalPengeluaran += parseFloat(input.value) || 0;
            });

            let penghasilanBersih = totalPenghasilan - totalPengeluaran;

            document.getElementById('total-penghasilan').textContent = formatRupiah(totalPenghasilan);
            document.getElementById('total-pengeluaran').textContent = formatRupiah(totalPengeluaran);
            document.getElementById('penghasilan-bersih').textContent = formatRupiah(penghasilanBersih);

            let maksimalAngsuran1 = penghasilanBersih * 0.7;
            let maksimalAngsuran2 = totalPenghasilan * 0.4;

            document.getElementById('nominal-alternatif-1').textContent = formatRupiah(penghasilanBersih);
            document.getElementById('nominal-alternatif-2').textContent = formatRupiah(totalPenghasilan);
            document.getElementById('maks-angsuran-1').textContent = formatRupiah(maksimalAngsuran1);
            document.getElementById('maks-angsuran-2').textContent = formatRupiah(maksimalAngsuran2);

            hitungHargaJual(); // Tambahkan pemanggilan di sini agar update otomatis
        }

        function formatRupiah(angka) {
            return 'Rp. ' + angka.toLocaleString('id-ID', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }

        window.addEventListener('DOMContentLoaded', () => {
            hitungTotal();
            hitungHargaJual(); // Tambahan ini
        });
    </script>


    <!-- [ Main Content ] end -->
@endsection
