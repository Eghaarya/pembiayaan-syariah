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
                                <form action="{{ route('murabahah.pengajuan.update', $pengajuan->kode_pengajuan) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-1-tab" data-toggle="tab"
                                                data-target="#nav-1" type="button" role="tab" aria-controls="nav-1"
                                                aria-selected="true">
                                                Edit Pengajuan
                                            </button>
                                            <button class="nav-link" id="nav-2-tab" data-toggle="tab" data-target="#nav-2"
                                                type="button" role="tab" aria-controls="nav-2"
                                                aria-selected="true">Permohonan Pembiayaan</button>
                                            <button class="nav-link" id="nav-3-tab" data-toggle="tab" data-target="#nav-3"
                                                type="button" role="tab" aria-controls="nav-3"
                                                aria-selected="true">Keputusan Pembiayaan</button>
                                        </div>
                                    </nav>
                                    <div class="tab-content p-3" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-1" role="tabpanel"
                                            aria-labelledby="nav-1-tab">
                                            <h6 class="border-bottom pb-2">Edit Pengajuan</h6>

                                            <div class="row g-3 mb-3">
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark" for="tanggal_pengajuan">
                                                        Tanggal Pengajuan <span style="color: red">*</span>
                                                    </label>
                                                    <input type="date" class="form-control" id="tanggal_pengajuan"
                                                        name="tanggal_pengajuan"
                                                        value="{{ old('tanggal_pengajuan', \Carbon\Carbon::parse($pengajuan->tanggal_pengajuan)->format('Y-m-d')) }}"
                                                        required>
                                                </div>
                                            </div>

                                            <div class="row g-3 mb-3">
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark" for="nasabah_pengajuan">
                                                        Nasabah <span style="color: red">*</span>
                                                    </label>
                                                    <select class="form-control" id="nasabah_pengajuan"
                                                        name="nasabah_pengajuan" required>
                                                        <option value="" disabled>-- Pilih Nasabah --</option>
                                                        @foreach ($nasabahs as $nasabah)
                                                            <option
                                                                value="{{ $nasabah->kode_nasabah }}-{{ $nasabah->nama_nasabah }}"
                                                                {{ $pengajuan->kode_nasabah == $nasabah->kode_nasabah ? 'selected' : '' }}>
                                                                {{ $nasabah->kode_nasabah }} - {{ $nasabah->nama_nasabah }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row g-3 mb-3">
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark" for="keputusan">
                                                        Keputusan
                                                    </label>
                                                    <select class="form-control" id="keputusan" name="keputusan">
                                                        <option value="">--</option>
                                                        <option value="disetujui"
                                                            {{ old('keputusan', $pengajuan->keputusan) == 'disetujui' ? 'selected' : '' }}>
                                                            Setujui Pengajuan
                                                        </option>
                                                        <option value="ditolak"
                                                            {{ old('keputusan', $pengajuan->keputusan) == 'ditolak' ? 'selected' : '' }}>
                                                            Tolak Pengajuan
                                                        </option>
                                                    </select>
                                                </div>

                                                <div class="col-md-6 mt-2" id="tanggalPencairanWrapper">
                                                    <label class="form-label fw-bold text-dark" for="tanggal_pencairan">
                                                        Tanggal Pencairan <span style="color: red">*</span>
                                                    </label>
                                                    <input type="date" class="form-control" id="tanggal_pencairan"
                                                        name="tanggal_pencairan"
                                                        value="{{ old('tanggal_pencairan', $pengajuan->tanggal_pencairan ? \Carbon\Carbon::parse($pengajuan->tanggal_pencairan)->format('Y-m-d') : '') }}"
                                                        required>
                                                </div>
                                            </div>

                                            <div class="d-flex gap-2 justify-content-start" id="nav-tab" role="tablist">
                                                <a href="{{ route('murabahah.pengajuan.data') }}"
                                                    class="btn btn-secondary">← Kembali</a>
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
                                                        name="permohonan_jenis_akad"
                                                        value="{{ old('permohonan_jenis_akad', $pengajuan->permohonan_jenis_akad ?? '') }}">
                                                </div>

                                                <div class="col-md-12 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="permohonan_jenis_pembiayaan">
                                                        Jenis Pembiayaan
                                                    </label>
                                                    <select class="form-control" id="permohonan_jenis_pembiayaan"
                                                        name="permohonan_jenis_pembiayaan">
                                                        @php
                                                            $options = [
                                                                '--',
                                                                'Pembiayaan rumah (KPR)',
                                                                'Pembiayaan Kendaraan Bermotor (PKB)',
                                                            ];
                                                            $selected = old(
                                                                'permohonan_jenis_pembiayaan',
                                                                $pengajuan->permohonan_jenis_pembiayaan ?? '',
                                                            );
                                                        @endphp

                                                        @foreach ($options as $option)
                                                            <option value="{{ $option }}"
                                                                {{ $selected == $option ? 'selected' : '' }}>
                                                                {{ $option }}</option>
                                                        @endforeach
                                                    </select>
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
                                                                'Pembelian rumah baru',
                                                                'Pembelian Rumah lama',
                                                                'Pembelian Kendaraan Baru',
                                                                'Pembelian Kendaraan lama',
                                                                'Take over KPR',
                                                                'Take Over KKB',
                                                            ];
                                                            $selected = old(
                                                                'permohonan_tujuan_penggunaan',
                                                                $pengajuan->permohonan_tujuan_penggunaan ?? '',
                                                            );
                                                        @endphp

                                                        @foreach ($options as $option)
                                                            <option value="{{ $option }}"
                                                                {{ $selected == $option ? 'selected' : '' }}>
                                                                {{ $option }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-12 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="permohonan_harga_jual_barang">
                                                        Harga Jual Barang
                                                    </label>
                                                    <input type="number" class="form-control"
                                                        id="permohonan_harga_jual_barang"
                                                        name="permohonan_harga_jual_barang"
                                                        value="{{ old('permohonan_harga_jual_barang', $pengajuan->permohonan_harga_jual_barang ?? '') }}">
                                                </div>

                                                <div class="col-md-12 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="permohonan_urbun_uangmuka">
                                                        Urbun / Uang Muka
                                                    </label>
                                                    <input type="number" class="form-control"
                                                        id="permohonan_urbun_uangmuka" name="permohonan_urbun_uangmuka"
                                                        value="{{ old('permohonan_urbun_uangmuka', $pengajuan->permohonan_urbun_uangmuka ?? '') }}">
                                                </div>

                                                <div class="col-md-12 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="permohonan_harga_beli_bank">
                                                        Harga Beli Bank
                                                    </label>
                                                    <input type="number" class="form-control"
                                                        id="permohonan_harga_beli_bank" name="permohonan_harga_beli_bank"
                                                        value="{{ old('permohonan_harga_beli_bank', $pengajuan->permohonan_harga_beli_bank ?? '') }}">
                                                </div>

                                                <!-- Jangka Waktu Pembiayaan (tahun) -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="permohonan_jangka_waktu_pembiayaan">
                                                        Jangka Waktu Pembiayaan (tahun)
                                                    </label>
                                                    <input type="number" class="form-control"
                                                        id="permohonan_jangka_waktu_pembiayaan"
                                                        name="permohonan_jangka_waktu_pembiayaan"
                                                        value="{{ old('permohonan_jangka_waktu_pembiayaan', $pengajuan->permohonan_jangka_waktu_pembiayaan ?? '') }}">
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
                                                        value="{{ old('permohonan_margin_bank', $pengajuan->permohonan_margin_bank ?? '') }}">
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
                                        </div>

                                        <div class="tab-pane fade" id="nav-3" role="tabpanel"
                                            aria-labelledby="nav-3-tab">

                                            <h6 class="border-bottom pb-2">Keputusan Pembiayaan <span
                                                    class="text-warning font-italic">(otomatis atau diketik
                                                    manual sesuai yang disetujui pimpinan)</span></h6>

                                            <div class="row g-3 mb-3">

                                                <div class="col-md-12 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="keputusan_jenis_akad">
                                                        Jenis Akad
                                                    </label>
                                                    <input type="text" class="form-control" id="keputusan_jenis_akad"
                                                        name="keputusan_jenis_akad"
                                                        value="{{ old('keputusan_jenis_akad', $pengajuan->keputusan_jenis_akad ?? '') }}">
                                                </div>

                                                <div class="col-md-12 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="keputusan_jenis_pembiayaan">
                                                        Jenis Pembiayaan
                                                    </label>
                                                    <select class="form-control" id="keputusan_jenis_pembiayaan"
                                                        name="keputusan_jenis_pembiayaan">
                                                        @php
                                                            $options = [
                                                                '--',
                                                                'Pembiayaan rumah (KPR)',
                                                                'Pembiayaan Kendaraan Bermotor (PKB)',
                                                            ];
                                                            $selected = old(
                                                                'keputusan_jenis_pembiayaan',
                                                                $pengajuan->keputusan_jenis_pembiayaan ?? '',
                                                            );
                                                        @endphp

                                                        @foreach ($options as $option)
                                                            <option value="{{ $option }}"
                                                                {{ $selected == $option ? 'selected' : '' }}>
                                                                {{ $option }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-12 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="keputusan_tujuan_penggunaan">
                                                        Tujuan Penggunaan
                                                    </label>
                                                    <select class="form-control" id="keputusan_tujuan_penggunaan"
                                                        name="keputusan_tujuan_penggunaan">
                                                        @php
                                                            $options = [
                                                                '--',
                                                                'Pembelian rumah baru',
                                                                'Pembelian Rumah lama',
                                                                'Pembelian Kendaraan Baru',
                                                                'Pembelian Kendaraan lama',
                                                                'Take over KPR',
                                                                'Take Over KKB',
                                                            ];
                                                            $selected = old(
                                                                'keputusan_tujuan_penggunaan',
                                                                $pengajuan->keputusan_tujuan_penggunaan ?? '',
                                                            );
                                                        @endphp

                                                        @foreach ($options as $option)
                                                            <option value="{{ $option }}"
                                                                {{ $selected == $option ? 'selected' : '' }}>
                                                                {{ $option }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-12 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="keputusan_harga_jual_barang">
                                                        Harga Jual Barang
                                                    </label>
                                                    <input type="number" class="form-control"
                                                        id="keputusan_harga_jual_barang"
                                                        name="keputusan_harga_jual_barang"
                                                        value="{{ old('keputusan_harga_jual_barang', $pengajuan->keputusan_harga_jual_barang ?? '') }}">
                                                </div>

                                                <div class="col-md-12 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="keputusan_urbun_uangmuka">
                                                        Urbun / Uang Muka
                                                    </label>
                                                    <input type="number" class="form-control"
                                                        id="keputusan_urbun_uangmuka" name="keputusan_urbun_uangmuka"
                                                        value="{{ old('keputusan_urbun_uangmuka', $pengajuan->keputusan_urbun_uangmuka ?? '') }}">
                                                </div>

                                                <div class="col-md-12 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="keputusan_harga_beli_bank">
                                                        Harga Beli Bank
                                                    </label>
                                                    <input type="number" class="form-control"
                                                        id="keputusan_harga_beli_bank" name="keputusan_harga_beli_bank"
                                                        value="{{ old('keputusan_harga_beli_bank', $pengajuan->keputusan_harga_beli_bank ?? '') }}">
                                                </div>

                                                <!-- Jangka Waktu Pembiayaan (tahun) -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="keputusan_jangka_waktu_pembiayaan">
                                                        Jangka Waktu Pembiayaan (tahun)
                                                    </label>
                                                    <input type="number" class="form-control"
                                                        id="keputusan_jangka_waktu_pembiayaan"
                                                        name="keputusan_jangka_waktu_pembiayaan"
                                                        value="{{ old('keputusan_jangka_waktu_pembiayaan', $pengajuan->keputusan_jangka_waktu_pembiayaan ?? '') }}">
                                                </div>

                                                <!-- Output bulan -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark">Jangka Waktu
                                                        (bulan)</label>
                                                    <div id="keputusan_jangka_waktu_bulan" class="mt-1">—</div>
                                                </div>

                                                <!-- Margin Bank -->
                                                <div class="col-md-3 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="keputusan_margin_bank">
                                                        Margin Bank (% per bulan)
                                                    </label>
                                                    <input type="number" step="0.01" class="form-control"
                                                        id="keputusan_margin_bank" name="keputusan_margin_bank"
                                                        value="{{ old('keputusan_margin_bank', $pengajuan->keputusan_margin_bank ?? '') }}">
                                                </div>

                                                <div class="col-md-3 mt-2">
                                                    <label class="form-label fw-bold text-dark">Margin Bank
                                                        (% per tahun)</label>
                                                    <div id="keputusan_margin_tahun_output" class="mt-1">—</div>
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark">Nominal Margin Bank</label>
                                                    <div id="keputusan_margin_nominal_output" class="mt-1">—</div>
                                                </div>

                                                <div class="col-md-12 mt-2">
                                                    <label class="form-label fw-bold text-dark">Harga Jual Bank</label>
                                                    <div id="keputusan_harga_jual_output" class="mt-1">—</div>
                                                </div>

                                                <div class="col-md-12 mt-2">
                                                    <label class="form-label fw-bold text-dark">Angsuran per Bulan</label>
                                                    <div id="keputusan_angsuran_bank_output" class="mt-1">—</div>
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
