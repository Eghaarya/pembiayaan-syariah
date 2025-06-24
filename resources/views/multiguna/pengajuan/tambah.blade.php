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
                                <form action="{{ route('multiguna.pengajuan.store') }}" method="POST">
                                    @csrf
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-1-tab" data-toggle="tab"
                                                data-target="#nav-1" type="button" role="tab" aria-controls="nav-1"
                                                aria-selected="true">Buat Pengajuan</button>
                                            <button class="nav-link" id="nav-2-tab" data-toggle="tab" data-target="#nav-2"
                                                type="button" role="tab" aria-controls="nav-2"
                                                aria-selected="true">Permohonan Pembiayaan</button>
                                        </div>
                                    </nav>
                                    <div class="tab-content p-3" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-1" role="tabpanel"
                                            aria-labelledby="nav-1-tab">
                                            <h6 class="border-bottom pb-2">Buat Pengajuan</h6>
                                            <div class="row g-3 mb-3">
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="tanggal_pengajuan">Tanggal Pengajuan <span
                                                            style="color: red">*</span></label>
                                                    <input type="date" class="form-control" id="tanggal_pengajuan"
                                                        name="tanggal_pengajuan"
                                                        value="{{ old('tanggal_pengajuan', \Carbon\Carbon::now()->format('Y-m-d')) }}"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="row g-3 mb-3">
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="nasabah_pengajuan">Nasabah <span
                                                            style="color: red">*</span></label>
                                                    <select class="form-control" id="nasabah_pengajuan"
                                                        name="nasabah_pengajuan" required>
                                                        <option value="" disabled selected>-- Pilih Nasabah --
                                                        </option>
                                                        @foreach ($nasabahs as $nasabah)
                                                            <option
                                                                value="{{ $nasabah->kode_nasabah }}-{{ $nasabah->nama_nasabah }}">
                                                                {{ $nasabah->kode_nasabah }} - {{ $nasabah->nama_nasabah }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="d-flex gap-2 justify-content-start" id="nav-tab" role="tablist">

                                                <a href="{{ route('multiguna.pengajuan.data') }}"
                                                    class="btn btn-secondary">←
                                                    Kembali</a>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-2" role="tabpanel"
                                            aria-labelledby="nav-2-tab">

                                            <h6 class="border-bottom pb-2">Permohonan Pembiayaan</h6>

                                            <div class="row g-3 mb-3">
                                                <div class="col-md-12 mt-2">
                                                    <label class="form-label fw-bold text-dark" for="permohonan_jenis_akad">
                                                        Jenis Akad
                                                    </label>
                                                    <input type="text" class="form-control" id="permohonan_jenis_akad"
                                                        name="permohonan_jenis_akad" value="">
                                                </div>
                                                <div class="col-md-12 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="permohonan_jenis_pembiayaan">
                                                        Jenis Pembiayaan
                                                    </label>
                                                    <input type="text" class="form-control"
                                                        id="permohonan_jenis_pembiayaan" name="permohonan_jenis_pembiayaan"
                                                        value="">
                                                </div>


                                                <div class="col-md-12 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="permohonan_tujuan_penggunaan">
                                                        Tujuan Penggunaan
                                                    </label>
                                                    <select class="form-control" id="permohonan_tujuan_penggunaan"
                                                        name="permohonan_tujuan_penggunaan">
                                                        @php
                                                            $options = [
                                                                '--',
                                                                'Pembiayaan Konsumtif',
                                                                'Pembiayaan Produktif',
                                                            ];
                                                        @endphp

                                                        @foreach ($options as $option)
                                                            <option value="{{ $option }}"> {{ $option }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-12 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="permohonan_harga_beli_bank">
                                                        Harga Beli Bank
                                                    </label>
                                                    <input type="number" class="form-control"
                                                        id="permohonan_harga_beli_bank" name="permohonan_harga_beli_bank"
                                                        value="">
                                                </div>

                                                <!-- Jangka Waktu Pembiayaan (tahun) -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="permohonan_jangka_waktu_pembiayaan">
                                                        Jangka Waktu Pembiayaan (tahun)
                                                    </label>
                                                    <input type="number" class="form-control"
                                                        id="permohonan_jangka_waktu_pembiayaan"
                                                        name="permohonan_jangka_waktu_pembiayaan" value="">
                                                </div>

                                                <!-- Output bulan -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark">Jangka Waktu
                                                        (bulan)</label>
                                                    <div id="permohonan_jangka_waktu_bulan" class="mt-1">—</div>
                                                </div>

                                                <!-- Margin Bank -->
                                                <div class="col-md-3 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="permohonan_margin_bank">
                                                        Margin Bank (% per bulan)
                                                    </label>
                                                    <input type="number" step="0.01" class="form-control"
                                                        id="permohonan_margin_bank" name="permohonan_margin_bank"
                                                        value="">
                                                </div>

                                                <div class="col-md-3 mt-2">
                                                    <label class="form-label fw-bold text-dark">Margin Bank
                                                        (% per tahun)</label>
                                                    <div id="permohonan_margin_tahun_output" class="mt-1">—</div>
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark">Nominal Margin Bank</label>
                                                    <div id="permohonan_margin_nominal_output" class="mt-1">—</div>
                                                </div>

                                                <div class="col-md-12 mt-2">
                                                    <label class="form-label fw-bold text-dark">Harga Jual Bank</label>
                                                    <div id="permohonan_harga_jual_output" class="mt-1">—</div>
                                                </div>

                                                <div class="col-md-12 mt-2">
                                                    <label class="form-label fw-bold text-dark">Angsuran per Bulan</label>
                                                    <div id="permohonan_angsuran_bank_output" class="mt-1">—</div>
                                                </div>
                                            </div>

                                            <div class="d-flex gap-2 justify-content-start" id="nav-tab"
                                                role="tablist">

                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-save me-2"></i> Simpan Data Pengajuan
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
    <!-- [ Main Content ] end -->
@endsection
