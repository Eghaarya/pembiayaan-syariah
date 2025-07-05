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
                                <form action="{{ route('multiguna.limac.capacity.update', $pengajuan->kode_pengajuan) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="kode_nasabah" value="{{ $pengajuan->kode_nasabah }}">

                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-1-tab" data-toggle="tab"
                                                data-target="#nav-1" type="button" role="tab" aria-controls="nav-1"
                                                aria-selected="true">Pekerjaan Nasabah</button>
                                            <button class="nav-link" id="nav-2-tab" data-toggle="tab" data-target="#nav-2"
                                                type="button" role="tab" aria-controls="nav-2"
                                                aria-selected="true">Reputasi Nasabah dalam Pekerjaan</button>
                                            <button class="nav-link" id="nav-3-tab" data-toggle="tab" data-target="#nav-3"
                                                type="button" role="tab" aria-controls="nav-3"
                                                aria-selected="true">Fasilitas Dinas Yang Diterima</button>
                                            <button class="nav-link" id="nav-4-tab" data-toggle="tab" data-target="#nav-4"
                                                type="button" role="tab" aria-controls="nav-4"
                                                aria-selected="true">Perincian Rekening Tabungan</button>
                                            <button class="nav-link" id="nav-5-tab" data-toggle="tab" data-target="#nav-5"
                                                type="button" role="tab" aria-controls="nav-5"
                                                aria-selected="true">Kondisi Keuangan</button>
                                            <button class="nav-link" id="nav-6-tab" data-toggle="tab" data-target="#nav-6"
                                                type="button" role="tab" aria-controls="nav-6"
                                                aria-selected="true">Nilai Pembiayaan</button>
                                            <button class="nav-link" id="nav-7-tab" data-toggle="tab" data-target="#nav-7"
                                                type="button" role="tab" aria-controls="nav-7"
                                                aria-selected="true">Analis Pembiayaan</button>
                                        </div>
                                    </nav>

                                    <div class="tab-content p-3" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-1" role="tabpanel"
                                            aria-labelledby="nav-1-tab">

                                            <div
                                                class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2">
                                                <h6 class="mb-0">1. Pekerjaan Nasabah</h6>
                                                <a href="{{ route('nasabah.pekerjaan.edit', $nasabah_pekerjaan->kode_nasabah) }}"
                                                    class="btn btn-sm btn-link text-warning p-1" id="target-shake">
                                                    Ubah data Pekerjaan di sini ... <i class="fas fa-edit"></i>
                                                </a>
                                            </div>

                                            <div class="row g-3 mb-3">

                                                <div class="col-md-12 mt-2">
                                                    <label class="form-label fw-bold text-dark">Kode Nasabah - Nama</label>
                                                    <h5 class="border-bottom">
                                                        {{ '( ' . ($nasabah_pekerjaan->kode_nasabah ?? '') . ' ) ' . ($nasabah_pekerjaan->nama_nasabah ?? '') }}
                                                    </h5>

                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <label for="nama_perusahaan_nasabah"
                                                        class="form-label fw-bold text-dark">Nama Perusahaan Nasabah</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="nama_perusahaan_nasabah" name="nama_perusahaan_nasabah"
                                                        maxlength="100" placeholder="Masukkan nama perusahaan"
                                                        value="{{ old('nama_perusahaan_nasabah', $nasabah_pekerjaan->nama_perusahaan_nasabah) }}">
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <label for="bidang_perusahaan_nasabah"
                                                        class="form-label fw-bold text-info">Bidang Perusahaan
                                                        Nasabah</label>
                                                    <select disabled class="form-control border-0 bg-white text-dark"
                                                        id="bidang_perusahaan_nasabah" name="bidang_perusahaan_nasabah">
                                                        @php
                                                            $bidangOptions = [
                                                                'agrobisnis (10)',
                                                                'aparatur negara (10)',
                                                                'keuangan (10)',
                                                                'kesehatan (10)',
                                                                'jasa (10)',
                                                                'pariwisata (10)',
                                                                'pendidikan (10)',
                                                                'perindustrian (10)',
                                                                'pertambangan/perminyakan (10)',
                                                                'property (10)',
                                                                'teknologi, komunikasi dan informasi (10)',
                                                                'transportasi (10)',
                                                            ];

                                                            $selectedBidang = strtolower(
                                                                old(
                                                                    'bidang_perusahaan_nasabah',
                                                                    $nasabah_pekerjaan->bidang_perusahaan_nasabah,
                                                                ),
                                                            );
                                                        @endphp

                                                        <option value="">-- Pilih Bidang --</option>
                                                        @foreach ($bidangOptions as $label)
                                                            <option value="{{ $label }}"
                                                                {{ $selectedBidang === $label ? 'selected' : '' }}>
                                                                {{ $label }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <label for="skala_perusahaan_nasabah"
                                                        class="form-label fw-bold text-info">
                                                        Skala Perusahaan Nasabah
                                                    </label>
                                                    @php
                                                        $skalaOptions = [
                                                            'INTERNASIONAL - Penanaman Modal Asing(3)',
                                                            'NASIONAL - Aset min 200 jt, Omset 10 M/th(2)',
                                                            'UMKM - Aset <200jt, Omset ± 1 M/th(1)',
                                                        ];

                                                        $selectedSkala = old(
                                                            'skala_perusahaan_nasabah',
                                                            $nasabah_pekerjaan->skala_perusahaan_nasabah,
                                                        );
                                                    @endphp
                                                    <select disabled class="form-control border-0 bg-white text-dark"
                                                        id="skala_perusahaan_nasabah" name="skala_perusahaan_nasabah">
                                                        <option value="">-- Pilih Skala Perusahaan --</option>
                                                        @foreach ($skalaOptions as $label)
                                                            <option value="{{ $label }}"
                                                                {{ $selectedSkala === $label ? 'selected' : '' }}>
                                                                {{ $label }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <label for="jenis_pekerjaan_nasabah"
                                                        class="form-label fw-bold text-info">Jenis Pekerjaan
                                                        Nasabah</label>
                                                    @php
                                                        $jenisPekerjaanOptions = [
                                                            'BUMN(12)',
                                                            'PNS(11)',
                                                            'POLRI/TNI(9)',
                                                            'Perusahaan SWASTA Asing - Penanaman Modal Asing, Karyawan Kedubes(10)',
                                                            'Perusahaan SWASTA BESAR - Aset min 10M(5)',
                                                            'Perusahaan SWASTA Sedang - Aset >200jt - 10M, Omset Tidak Teratur(4)',
                                                            'Perusahaan SWASTA KECIL - Aset < 200jt, Omset 1M/thn(1)',
                                                            'Wiraswasta Besar - Aset min 10M(3)',
                                                            'Wiraswasta Kecil - Aset min 200jt, Omset max 1M(2)',
                                                        ];

                                                        $selectedJenisPekerjaan = old(
                                                            'jenis_pekerjaan_nasabah',
                                                            $nasabah_pekerjaan->jenis_pekerjaan_nasabah,
                                                        );
                                                    @endphp
                                                    <select disabled class="form-control border-0 bg-white text-dark"
                                                        id="jenis_pekerjaan_nasabah" name="jenis_pekerjaan_nasabah">
                                                        <option value="">-- Pilih Jenis Pekerjaan --</option>
                                                        @foreach ($jenisPekerjaanOptions as $label)
                                                            <option value="{{ $label }}"
                                                                {{ $selectedJenisPekerjaan === $label ? 'selected' : '' }}>
                                                                {{ $label }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="jabatan_pekerjaan_nasabah"
                                                        class="form-label fw-bold text-info">Jabatan Pekerjaan
                                                        Nasabah</label>

                                                    @php
                                                        $jabatanOptions = [
                                                            'Karyawan Lini Bawah (3)',
                                                            'Karyawan Lini Tengah / Manager (4)',
                                                            'Karyawan Lini Atas / Direktur (6)',
                                                            'Pemilik (5)',
                                                        ];
                                                        $selectedJabatan = old(
                                                            'jabatan_pekerjaan_nasabah',
                                                            $nasabah_pekerjaan->jabatan_pekerjaan_nasabah,
                                                        );
                                                    @endphp

                                                    <select disabled class="form-control border-0 bg-white text-dark"
                                                        id="jabatan_pekerjaan_nasabah" name="jabatan_pekerjaan_nasabah">
                                                        <option value="">-- Pilih Jabatan --</option>
                                                        @foreach ($jabatanOptions as $label)
                                                            <option value="{{ $label }}"
                                                                {{ $selectedJabatan === $label ? 'selected' : '' }}>
                                                                {{ $label }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="dept_perusahaan_nasabah"
                                                        class="form-label fw-bold text-dark">Departemen Perusahaan
                                                        Nasabah</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="dept_perusahaan_nasabah" name="dept_perusahaan_nasabah"
                                                        maxlength="100" placeholder="Masukkan departemen"
                                                        value="{{ old('dept_perusahaan_nasabah', $nasabah_pekerjaan->dept_perusahaan_nasabah) }}">
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <label for="mulai_bekerja_nasabah"
                                                        class="form-label fw-bold text-dark">Mulai Bekerja Nasabah</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="mulai_bekerja_nasabah" name="mulai_bekerja_nasabah"
                                                        maxlength="5" placeholder="Masukkan mulai bekerja (yyyy)"
                                                        value="{{ old('mulai_bekerja_nasabah', $nasabah_pekerjaan->mulai_bekerja_nasabah) }}">
                                                </div>
                                                <div class="col-md-3 mt-2">
                                                    <label for="lamabekerja_tahun_nasabah"
                                                        class="form-label fw-bold text-dark">Lama Bekerja Tahun</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="lamabekerja_tahun_nasabah" name="lamabekerja_tahun_nasabah"
                                                        maxlength="2" placeholder="Tahun"
                                                        value="{{ old('lamabekerja_tahun_nasabah', $nasabah_pekerjaan->lamabekerja_tahun_nasabah) }}">
                                                </div>
                                                <div class="col-md-3 mt-2">
                                                    <label for="lamabekerja_bulan_nasabah"
                                                        class="form-label fw-bold text-dark">Lama Bekerja Bulan</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="lamabekerja_bulan_nasabah" name="lamabekerja_bulan_nasabah"
                                                        maxlength="2" placeholder="Bulan"
                                                        value="{{ old('lamabekerja_bulan_nasabah', $nasabah_pekerjaan->lamabekerja_bulan_nasabah) }}">
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <label for="pengalaman_perusahaan_nasabah"
                                                        class="form-label fw-bold text-info">Pengalaman Perusahaan
                                                        Nasabah</label>

                                                    @php
                                                        $pengalamanOptions = [
                                                            '1-3 th (1)',
                                                            '4-6 th (2)',
                                                            '7-9 th (3)',
                                                            '>10 th (4)',
                                                        ];
                                                        $selectedPengalaman = old(
                                                            'pengalaman_perusahaan_nasabah',
                                                            $nasabah_pekerjaan->pengalaman_perusahaan_nasabah,
                                                        );
                                                    @endphp

                                                    <select disabled class="form-control border-0 bg-white text-dark"
                                                        id="pengalaman_perusahaan_nasabah"
                                                        name="pengalaman_perusahaan_nasabah">
                                                        <option value="">-- Pilih Pengalaman --</option>
                                                        @foreach ($pengalamanOptions as $label)
                                                            <option value="{{ $label }}"
                                                                {{ $selectedPengalaman == $label ? 'selected' : '' }}>
                                                                {{ $label }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-3 mt-2">
                                                    <label for="totalbekerja_tahun_nasabah"
                                                        class="form-label fw-bold text-dark">Total Bekerja Tahun</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="totalbekerja_tahun_nasabah" name="totalbekerja_tahun_nasabah"
                                                        maxlength="2" placeholder="Tahun"
                                                        value="{{ old('totalbekerja_tahun_nasabah', $nasabah_pekerjaan->totalbekerja_tahun_nasabah) }}">
                                                </div>
                                                <div class="col-md-3 mt-2">
                                                    <label for="totalbekerja_bulan_nasabah"
                                                        class="form-label fw-bold text-dark">Total Bekerja Bulan</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="totalbekerja_bulan_nasabah" name="totalbekerja_bulan_nasabah"
                                                        maxlength="2" placeholder="Bulan"
                                                        value="{{ old('totalbekerja_bulan_nasabah', $nasabah_pekerjaan->totalbekerja_bulan_nasabah) }}">
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-info d-block">Pendidikan Terakhir
                                                        Nasabah</label>

                                                    @php
                                                        $pendidikanOptions = [
                                                            'SD (1)',
                                                            'SMP (2)',
                                                            'SMA (3)',
                                                            'D1 (4)',
                                                            'D2 (5)',
                                                            'D3 (6)',
                                                            'D4 (7)',
                                                            'S1 (7)',
                                                            'S2 (8)',
                                                            'S3 (9)',
                                                        ];

                                                        $pendidikan = old(
                                                            'pendidikan_terakhir_nasabah',
                                                            $nasabah_pekerjaan->pendidikan_terakhir_nasabah,
                                                        );
                                                    @endphp

                                                    @foreach ($pendidikanOptions as $label)
                                                        @php
                                                            $inputId =
                                                                'pendidikan' .
                                                                strtoupper(preg_replace('/[^a-zA-Z0-9]/', '', $label));
                                                        @endphp

                                                        <div class="form-check form-check-inline">
                                                            <input disabled class="form-check-input" type="radio"
                                                                name="pendidikan_terakhir_nasabah"
                                                                id="{{ $inputId }}" value="{{ $label }}"
                                                                {{ $pendidikan == $label ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="{{ $inputId }}">
                                                                {{ $label }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <div class="col-md-3 mt-2">
                                                    <label for="usia_nasabah" class="form-label fw-bold text-info">Usia
                                                        Nasabah</label>

                                                    @php
                                                        // Array opsi usia dengan label dan value yang sama
                                                        $usiaNasabahOptions = [
                                                            '<24 th (6)',
                                                            '24 - 30 th (5)',
                                                            '31 - 40 th (4)',
                                                            '41 - 50 th (3)',
                                                            '51 - 60 th (2)',
                                                            '>60 th (1)',
                                                        ];

                                                        // Ambil nilai lama (old input) atau default dari model
                                                        $selectedUsiaNasabah = old(
                                                            'usia_nasabah',
                                                            $nasabah_pekerjaan->usia_nasabah,
                                                        );
                                                    @endphp

                                                    <select disabled class="form-control border-0 bg-white text-dark"
                                                        id="usia_nasabah" name="usia_nasabah">
                                                        <option value="">-- Pilih Usia --</option>
                                                        @foreach ($usiaNasabahOptions as $label)
                                                            <option value="{{ $label }}"
                                                                {{ $selectedUsiaNasabah == $label ? 'selected' : '' }}>
                                                                {{ $label }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-3 mt-2">
                                                    <label for="usia_prapensiun_nasabah"
                                                        class="form-label fw-bold text-dark">Usia Pra-Pensiun
                                                        Nasabah</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="usia_prapensiun_nasabah" name="usia_prapensiun_nasabah"
                                                        maxlength="10" placeholder="Masukkan usia prapensiun"
                                                        value="{{ old('usia_prapensiun_nasabah', $nasabah_pekerjaan->usia_prapensiun_nasabah) }}">
                                                </div>
                                                <div class="col-md-3 mt-2">
                                                    <label for="usia_pensiun_nasabah"
                                                        class="form-label fw-bold text-dark">Usia Pensiun Nasabah</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="usia_pensiun_nasabah" name="usia_pensiun_nasabah"
                                                        maxlength="10" placeholder="Masukkan usia pensiun"
                                                        value="{{ old('usia_pensiun_nasabah', $nasabah_pekerjaan->usia_pensiun_nasabah) }}">
                                                </div>

                                                <div class="col-md-3 mt-2">
                                                    <label for="sisa_pensiun_nasabah"
                                                        class="form-label fw-bold text-info">Sisa Pensiun Nasabah</label>

                                                    @php
                                                        $sisaPensiunOptions = [
                                                            '10-20 TH (3)',
                                                            '21-30 TH (4)',
                                                            '>31 TH (5)',
                                                        ];

                                                        $selectedSisaPensiun = old(
                                                            'sisa_pensiun_nasabah',
                                                            $nasabah_pekerjaan->sisa_pensiun_nasabah,
                                                        );
                                                    @endphp

                                                    <select disabled class="form-control border-0 bg-white text-dark"
                                                        id="sisa_pensiun_nasabah" name="sisa_pensiun_nasabah">
                                                        <option value="">-- Pilih Usia --</option>
                                                        @foreach ($sisaPensiunOptions as $label)
                                                            <option value="{{ $label }}"
                                                                {{ $selectedSisaPensiun == $label ? 'selected' : '' }}>
                                                                {{ $label }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="nama_atasan_nasabah"
                                                        class="form-label fw-bold text-dark">Nama Atasan Nasabah</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="nama_atasan_nasabah" name="nama_atasan_nasabah"
                                                        maxlength="100" placeholder="Masukkan nama atasan"
                                                        value="{{ old('nama_atasan_nasabah', $nasabah_pekerjaan->nama_atasan_nasabah) }}">
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <label for="notelp_atasan_nasabah"
                                                        class="form-label fw-bold text-dark">No. Telp Atasan
                                                        Nasabah</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="notelp_atasan_nasabah" name="notelp_atasan_nasabah"
                                                        maxlength="20" placeholder="Masukkan no. telp atasan"
                                                        value="{{ old('notelp_atasan_nasabah', $nasabah_pekerjaan->notelp_atasan_nasabah) }}">
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <label for="jenispekerjaan_atasan_nasabah"
                                                        class="form-label fw-bold text-dark">
                                                        Jenis Pekerjaan Atasan Nasabah
                                                    </label>

                                                    @php
                                                        $jenisPekerjaanAtasanOptions = [
                                                            'Pegawai Negeri' => 'Pegawai Negeri',
                                                            'Swasta' => 'Swasta',
                                                            'Lainnya' => 'Lainnya',
                                                        ];

                                                        $selectedJenisPekerjaan = old(
                                                            'jenispekerjaan_atasan_nasabah',
                                                            $nasabah_pekerjaan->jenispekerjaan_atasan_nasabah,
                                                        );
                                                    @endphp

                                                    <select disabled class="form-control border-0 bg-white text-dark"
                                                        id="jenispekerjaan_atasan_nasabah"
                                                        name="jenispekerjaan_atasan_nasabah">
                                                        <option value="">-- Pilih Jenis Pekerjaan --</option>
                                                        @foreach ($jenisPekerjaanAtasanOptions as $value => $label)
                                                            <option value="{{ $value }}"
                                                                {{ $selectedJenisPekerjaan == $value ? 'selected' : '' }}>
                                                                {{ $label }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="alamat_perusahaan_nasabah"
                                                        class="form-label fw-bold text-dark">Alamat Perusahaan
                                                        Nasabah</label>
                                                    <textarea class="form-control border-0 bg-white text-dark" id="alamat_perusahaan_nasabah"
                                                        name="alamat_perusahaan_nasabah" maxlength="200" placeholder="Masukkan alamat perusahaan">{{ old('alamat_perusahaan_nasabah', $nasabah_pekerjaan->alamat_perusahaan_nasabah) }}</textarea>
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <label for="notelp_perusahaan_nasabah"
                                                        class="form-label fw-bold text-dark">No. Telp Perusahaan
                                                        Nasabah</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="notelp_perusahaan_nasabah" name="notelp_perusahaan_nasabah"
                                                        maxlength="20" placeholder="Masukkan no. telp perusahaan"
                                                        value="{{ old('notelp_perusahaan_nasabah', $nasabah_pekerjaan->notelp_perusahaan_nasabah) }}">
                                                </div>
                                                <div class="col-md-3 mt-2">
                                                    <label for="penggajian_satu_nasabah"
                                                        class="form-label fw-bold text-dark">Tanggal Penggajian
                                                        Satu</label>
                                                    <input disabled type="text" maxlength="2"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="penggajian_satu_nasabah" name="penggajian_satu_nasabah"
                                                        value="{{ old('penggajian_satu_nasabah', $nasabah_pekerjaan->penggajian_satu_nasabah) }}">
                                                </div>
                                                <div class="col-md-3 mt-2">
                                                    <label for="penggajian_dua_nasabah"
                                                        class="form-label fw-bold text-dark">Tanggal Penggajian Dua</label>
                                                    <input disabled type="text" maxlength="2"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="penggajian_dua_nasabah" name="penggajian_dua_nasabah"
                                                        value="{{ old('penggajian_dua_nasabah', $nasabah_pekerjaan->penggajian_dua_nasabah) }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="perjanjian_kerjasama_nasabah"
                                                        class="form-label fw-bold text-info">Perjanjian Kerjasama</label>

                                                    @php
                                                        $perjanjianNasabahOptions = [
                                                            'Ada PKS Potong Gaji/Payroll (2)',
                                                            'Tidak Ada PKS Payroll, tapi Potong Gaji oleh Bendahara/Pimpinan dan Surat Kuasa Potong Gaji (1)',
                                                        ];

                                                        $selectedPerjanjianNasabah = old(
                                                            'perjanjian_kerjasama_nasabah',
                                                            $nasabah_pekerjaan->perjanjian_kerjasama_nasabah,
                                                        );
                                                    @endphp

                                                    <select disabled class="form-control border-0 bg-white text-dark"
                                                        id="perjanjian_kerjasama_nasabah"
                                                        name="perjanjian_kerjasama_nasabah">
                                                        <option value="">-- Pilih Perjanjian --</option>
                                                        @foreach ($perjanjianNasabahOptions as $label)
                                                            <option value="{{ $label }}"
                                                                {{ $selectedPerjanjianNasabah == $label ? 'selected' : '' }}>
                                                                {{ $label }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="pengalaman_perusahaanlain_nasabah"
                                                        class="form-label fw-bold text-dark">Pengalaman Perusahaan Lain
                                                        Nasabah</label>
                                                    <textarea class="form-control border-0 bg-white text-dark" id="pengalaman_perusahaanlain_nasabah"
                                                        name="pengalaman_perusahaanlain_nasabah" maxlength="200" placeholder="Masukkan pengalaman perusahaan lain">{{ old('pengalaman_perusahaanlain_nasabah', $nasabah_pekerjaan->pengalaman_perusahaanlain_nasabah) }}</textarea>
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <label for="sumber_penghasilan_nasabah"
                                                        class="form-label fw-bold text-info">
                                                        Sumber Penghasilan Nasabah
                                                    </label>

                                                    @php
                                                        $sumberPenghasilanOptions = [
                                                            'Dari anak2/dana pensiun (2)',
                                                            'Nasabah atau pasangan, 1 penghasilan (3)',
                                                            'Nasabah dan pasangan, 2 penghasilan (4)',
                                                            'Nasabah, pasangan, anak, banyak penghasilan (5)',
                                                            'Saudara/kerabat/lain2 (1)',
                                                        ];

                                                        $selectedSumberPenghasilan = old(
                                                            'sumber_penghasilan_nasabah',
                                                            $nasabah_pekerjaan->sumber_penghasilan_nasabah,
                                                        );
                                                    @endphp

                                                    <select disabled class="form-control border-0 bg-white text-dark"
                                                        id="sumber_penghasilan_nasabah" name="sumber_penghasilan_nasabah">
                                                        <option value="">-- Pilih Sumber Penghasilan --</option>
                                                        @foreach ($sumberPenghasilanOptions as $label)
                                                            <option value="{{ $label }}"
                                                                {{ $selectedSumberPenghasilan == $label ? 'selected' : '' }}>
                                                                {{ $label }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="tanggungan_nasabah"
                                                        class="form-label fw-bold text-info">Tanggungan Nasabah</label>

                                                    @php
                                                        $tanggunganOptions = [
                                                            'pasangan saja/single, belum ada anak (5)',
                                                            'pasangan, 1 anak (4)',
                                                            'pasangan, 2 anak (3)',
                                                            'pasangan, 3 anak (2)',
                                                            'pasangan, 4 anak (1)',
                                                        ];

                                                        $selectedTanggungan = old(
                                                            'tanggungan_nasabah',
                                                            $nasabah_pekerjaan->tanggungan_nasabah,
                                                        );
                                                    @endphp

                                                    <select disabled class="form-control border-0 bg-white text-dark"
                                                        id="tanggungan_nasabah" name="tanggungan_nasabah">
                                                        <option value="">-- Pilih Tanggungan --</option>
                                                        @foreach ($tanggunganOptions as $label)
                                                            <option value="{{ $label }}"
                                                                {{ $selectedTanggungan == $label ? 'selected' : '' }}>
                                                                {{ $label }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <h6 class="border-bottom pb-2">2. Pekerjaan Pasangan</h6>
                                            <div class="row g-3 mb-3">

                                                <div class="col-md-6 mt-2">
                                                    <label for="nama_perusahaan_pasangan"
                                                        class="form-label fw-bold text-dark">Nama Perusahaan
                                                        Pasangan</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="nama_perusahaan_pasangan" name="nama_perusahaan_pasangan"
                                                        maxlength="100" placeholder="Masukkan nama perusahaan pasangan"
                                                        value="{{ old('nama_perusahaan_pasangan', $nasabah_pekerjaan->nama_perusahaan_pasangan) }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="bidang_perusahaan_pasangan"
                                                        class="form-label fw-bold text-dark">Bidang Perusahaan
                                                        Pasangan</label>
                                                    <select disabled class="form-control border-0 bg-white text-dark"
                                                        id="bidang_perusahaan_pasangan" name="bidang_perusahaan_pasangan">
                                                        @php
                                                            $bidangOptions = [
                                                                'agrobisnis',
                                                                'aparatur negara',
                                                                'keuangan',
                                                                'kesehatan',
                                                                'jasa',
                                                                'pariwisata',
                                                                'pendidikan',
                                                                'perindustrian',
                                                                'pertambangan/perminyakan',
                                                                'property',
                                                                'teknologi, komunikasi dan informasi',
                                                                'transportasi',
                                                            ];

                                                            $selectedBidang = strtolower(
                                                                old(
                                                                    'bidang_perusahaan_pasangan',
                                                                    $nasabah_pekerjaan->bidang_perusahaan_pasangan,
                                                                ),
                                                            );
                                                        @endphp

                                                        <option value="">-- Pilih Bidang --</option>
                                                        @foreach ($bidangOptions as $option)
                                                            <option value="{{ $option }}"
                                                                {{ $selectedBidang === $option ? 'selected' : '' }}>
                                                                {{ strtoupper($option) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="skala_perusahaan_pasangan"
                                                        class="form-label fw-bold text-dark">
                                                        Skala Perusahaan Pasangan
                                                    </label>
                                                    @php
                                                        $skalaOptions = [
                                                            'INTERNASIONAL - Penanaman Modal Asing',
                                                            'NASIONAL - Aset min 200 jt, Omset 10 M/th',
                                                            'UMKM - Aset <200jt, Omset ± 1 M/th',
                                                        ];

                                                        $selectedSkala = old(
                                                            'skala_perusahaan_pasangan',
                                                            $nasabah_pekerjaan->skala_perusahaan_pasangan,
                                                        );
                                                    @endphp
                                                    <select disabled class="form-control border-0 bg-white text-dark"
                                                        id="skala_perusahaan_pasangan" name="skala_perusahaan_pasangan">
                                                        <option value="">-- Pilih Skala Perusahaan --</option>
                                                        @foreach ($skalaOptions as $label)
                                                            <option value="{{ $label }}"
                                                                {{ $selectedSkala === $label ? 'selected' : '' }}>
                                                                {{ $label }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="jenis_pekerjaan_pasangan"
                                                        class="form-label fw-bold text-dark">Jenis Pekerjaan
                                                        Pasangan</label>
                                                    @php
                                                        $jenisPekerjaanOptions = [
                                                            'BUMN',
                                                            'PNS',
                                                            'POLRI/TNI',
                                                            'Perusahaan SWASTA Asing - Penanaman Modal Asing, Karyawan Kedubes',
                                                            'Perusahaan SWASTA BESAR - Aset min 10M',
                                                            'Perusahaan SWASTA Sedang - Aset >200jt - 10M, Omset Tidak Teratur',
                                                            'Perusahaan SWASTA KECIL - Aset < 200jt, Omset 1M/thn',
                                                            'Wiraswasta Besar - Aset min 10M',
                                                            'Wiraswasta Kecil - Aset min 200jt, Omset max 1M',
                                                        ];

                                                        $selectedJenisPekerjaan = old(
                                                            'jenis_pekerjaan_pasangan',
                                                            $nasabah_pekerjaan->jenis_pekerjaan_pasangan,
                                                        );
                                                    @endphp
                                                    <select disabled class="form-control border-0 bg-white text-dark"
                                                        id="jenis_pekerjaan_pasangan" name="jenis_pekerjaan_pasangan">
                                                        <option value="">-- Pilih Jenis Pekerjaan --</option>
                                                        @foreach ($jenisPekerjaanOptions as $label)
                                                            <option value="{{ $label }}"
                                                                {{ $selectedJenisPekerjaan === $label ? 'selected' : '' }}>
                                                                {{ $label }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="jabatan_pekerjaan_pasangan"
                                                        class="form-label fw-bold text-dark">Jabatan Pekerjaan
                                                        Pasangan</label>

                                                    @php
                                                        $jabatanOptions = [
                                                            'Karyawan Lini Bawah',
                                                            'Karyawan Lini Tengah / Manager',
                                                            'Karyawan Lini Atas / Direktur',
                                                            'Pemilik',
                                                        ];
                                                        $selectedJabatan = old(
                                                            'jabatan_pekerjaan_pasangan',
                                                            $nasabah_pekerjaan->jabatan_pekerjaan_pasangan,
                                                        );
                                                    @endphp

                                                    <select disabled class="form-control border-0 bg-white text-dark"
                                                        id="jabatan_pekerjaan_pasangan" name="jabatan_pekerjaan_pasangan">
                                                        <option value="">-- Pilih Jabatan --</option>
                                                        @foreach ($jabatanOptions as $label)
                                                            <option value="{{ $label }}"
                                                                {{ $selectedJabatan === $label ? 'selected' : '' }}>
                                                                {{ $label }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="dept_perusahaan_pasangan"
                                                        class="form-label fw-bold text-dark">Departemen Perusahaan
                                                        Pasangan</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="dept_perusahaan_pasangan" name="dept_perusahaan_pasangan"
                                                        maxlength="100"
                                                        placeholder="Masukkan departemen perusahaan pasangan"
                                                        value="{{ old('dept_perusahaan_pasangan', $nasabah_pekerjaan->dept_perusahaan_pasangan) }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="mulai_bekerja_pasangan"
                                                        class="form-label fw-bold text-dark">Mulai Bekerja Pasangan</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="mulai_bekerja_pasangan" name="mulai_bekerja_pasangan"
                                                        maxlength="5" placeholder="Masukkan mulai bekerja pasangan"
                                                        value="{{ old('mulai_bekerja_pasangan', $nasabah_pekerjaan->mulai_bekerja_pasangan) }}">
                                                </div>

                                                <div class="col-md-3 mt-2">
                                                    <label for="lamabekerja_tahun_pasangan"
                                                        class="form-label fw-bold text-dark">Lama Bekerja (Tahun)
                                                        Pasangan</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="lamabekerja_tahun_pasangan" name="lamabekerja_tahun_pasangan"
                                                        maxlength="2" placeholder="Masukkan lama bekerja tahun pasangan"
                                                        value="{{ old('lamabekerja_tahun_pasangan', $nasabah_pekerjaan->lamabekerja_tahun_pasangan) }}">
                                                </div>

                                                <div class="col-md-3 mt-2">
                                                    <label for="lamabekerja_bulan_pasangan"
                                                        class="form-label fw-bold text-dark">Lama Bekerja (Bulan)
                                                        Pasangan</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="lamabekerja_bulan_pasangan" name="lamabekerja_bulan_pasangan"
                                                        maxlength="2" placeholder="Masukkan lama bekerja bulan pasangan"
                                                        value="{{ old('lamabekerja_bulan_pasangan', $nasabah_pekerjaan->lamabekerja_bulan_pasangan) }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="pengalaman_perusahaan_pasangan"
                                                        class="form-label fw-bold text-dark">Pengalaman Perusahaan
                                                        Pasangan</label>

                                                    @php
                                                        $pengalamanOptions = ['1-3 th', '4-6 th', '7-9 th', '>10 th'];
                                                        $selectedPengalaman = old(
                                                            'pengalaman_perusahaan_pasangan',
                                                            $nasabah_pekerjaan->pengalaman_perusahaan_pasangan,
                                                        );
                                                    @endphp

                                                    <select disabled class="form-control border-0 bg-white text-dark"
                                                        id="pengalaman_perusahaan_pasangan"
                                                        name="pengalaman_perusahaan_pasangan">
                                                        <option value="">-- Pilih Pengalaman --</option>
                                                        @foreach ($pengalamanOptions as $label)
                                                            <option value="{{ $label }}"
                                                                {{ $selectedPengalaman == $label ? 'selected' : '' }}>
                                                                {{ $label }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-3 mt-2">
                                                    <label for="totalbekerja_tahun_pasangan"
                                                        class="form-label fw-bold text-dark">Total Bekerja (Tahun)
                                                        Pasangan</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="totalbekerja_tahun_pasangan"
                                                        name="totalbekerja_tahun_pasangan" maxlength="2"
                                                        placeholder="Masukkan total bekerja tahun pasangan"
                                                        value="{{ old('totalbekerja_tahun_pasangan', $nasabah_pekerjaan->totalbekerja_tahun_pasangan) }}">
                                                </div>

                                                <div class="col-md-3 mt-2">
                                                    <label for="totalbekerja_bulan_pasangan"
                                                        class="form-label fw-bold text-dark">Total Bekerja (Bulan)
                                                        Pasangan</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="totalbekerja_bulan_pasangan"
                                                        name="totalbekerja_bulan_pasangan" maxlength="2"
                                                        placeholder="Masukkan total bekerja bulan pasangan"
                                                        value="{{ old('totalbekerja_bulan_pasangan', $nasabah_pekerjaan->totalbekerja_bulan_pasangan) }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark d-block">Pendidikan Terakhir
                                                        Pasangan</label>

                                                    @php
                                                        // Array pendidikan dengan skor sebagai value
                                                        $pendidikanOptions = [
                                                            'SD',
                                                            'SMP',
                                                            'SMA',
                                                            'D1',
                                                            'D2',
                                                            'D3',
                                                            'D4',
                                                            'S1',
                                                            'S2',
                                                            'S3',
                                                        ];

                                                        $pendidikan = old(
                                                            'pendidikan_terakhir_pasangan',
                                                            $nasabah_pekerjaan->pendidikan_terakhir_pasangan,
                                                        );
                                                    @endphp

                                                    @foreach ($pendidikanOptions as $label)
                                                        <div class="form-check form-check-inline">
                                                            <input disabled class="form-check-input" type="radio"
                                                                name="pendidikan_terakhir_pasangan"
                                                                id="pendidikan{{ strtoupper(preg_replace('/[^a-zA-Z0-9]/', '', $label)) }}"
                                                                value="{{ $label }}"
                                                                {{ $pendidikan == $label ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="pendidikan{{ strtoupper(preg_replace('/[^a-zA-Z0-9]/', '', $label)) }}">
                                                                {{ $label }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <div class="col-md-3 mt-2">
                                                    <label for="usia_pasangan" class="form-label fw-bold text-dark">Usia
                                                        Pasangan</label>

                                                    @php
                                                        $usiaNasabahOptions = [
                                                            '24 - 30 th',
                                                            '31 - 40 th',
                                                            '41 - 50 th',
                                                            '51 - 60 th',
                                                            'lebih dari 60 th',
                                                            'kurang dari 24 th',
                                                        ];

                                                        $selectedUsiaNasabah = old(
                                                            'usia_pasangan',
                                                            $nasabah_pekerjaan->usia_pasangan,
                                                        );
                                                    @endphp

                                                    <select disabled class="form-control border-0 bg-white text-dark"
                                                        id="usia_pasangan" name="usia_pasangan">
                                                        <option value="">-- Pilih Usia --</option>
                                                        @foreach ($usiaNasabahOptions as $label)
                                                            <option value="{{ $label }}"
                                                                {{ $selectedUsiaNasabah == $label ? 'selected' : '' }}>
                                                                {{ $label }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-3 mt-2">
                                                    <label for="usia_prapensiun_pasangan"
                                                        class="form-label fw-bold text-dark">Usia Prapensiun
                                                        Pasangan</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="usia_prapensiun_pasangan" name="usia_prapensiun_pasangan"
                                                        maxlength="10" placeholder="Masukkan usia prapensiun pasangan"
                                                        value="{{ old('usia_prapensiun_pasangan', $nasabah_pekerjaan->usia_prapensiun_pasangan) }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="usia_pensiun_pasangan"
                                                        class="form-label fw-bold text-dark">Usia Pensiun Pasangan</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="usia_pensiun_pasangan" name="usia_pensiun_pasangan"
                                                        maxlength="10" placeholder="Masukkan usia pensiun pasangan"
                                                        value="{{ old('usia_pensiun_pasangan', $nasabah_pekerjaan->usia_pensiun_pasangan) }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="nama_atasan_pasangan"
                                                        class="form-label fw-bold text-dark">Nama Atasan Pasangan</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="nama_atasan_pasangan" name="nama_atasan_pasangan"
                                                        maxlength="100" placeholder="Masukkan nama atasan pasangan"
                                                        value="{{ old('nama_atasan_pasangan', $nasabah_pekerjaan->nama_atasan_pasangan) }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="notelp_atasan_pasangan"
                                                        class="form-label fw-bold text-dark">No Telp Atasan
                                                        Pasangan</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="notelp_atasan_pasangan" name="notelp_atasan_pasangan"
                                                        maxlength="20"
                                                        placeholder="Masukkan nomor telepon atasan pasangan"
                                                        value="{{ old('notelp_atasan_pasangan', $nasabah_pekerjaan->notelp_atasan_pasangan) }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="jenispekerjaan_atasan_pasangan"
                                                        class="form-label fw-bold text-dark">
                                                        Jenis Pekerjaan Atasan Pasangan
                                                    </label>

                                                    @php
                                                        $jenisPekerjaanAtasanOptions = [
                                                            'Pegawai Negeri',
                                                            'Swasta',
                                                            'Lainnya',
                                                        ];

                                                        $selectedJenisPekerjaan = old(
                                                            'jenispekerjaan_atasan_pasangan',
                                                            $nasabah_pekerjaan->jenispekerjaan_atasan_pasangan,
                                                        );
                                                    @endphp

                                                    <select disabled class="form-control border-0 bg-white text-dark"
                                                        id="jenispekerjaan_atasan_pasangan"
                                                        name="jenispekerjaan_atasan_pasangan">
                                                        <option value="">-- Pilih Jenis Pekerjaan --</option>
                                                        @foreach ($jenisPekerjaanAtasanOptions as $label)
                                                            <option value="{{ $label }}"
                                                                {{ $selectedJenisPekerjaan == $label ? 'selected' : '' }}>
                                                                {{ $label }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="alamat_perusahaan_pasangan"
                                                        class="form-label fw-bold text-dark">Alamat Perusahaan
                                                        Pasangan</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="alamat_perusahaan_pasangan" name="alamat_perusahaan_pasangan"
                                                        maxlength="200" placeholder="Masukkan alamat perusahaan pasangan"
                                                        value="{{ old('alamat_perusahaan_pasangan', $nasabah_pekerjaan->alamat_perusahaan_pasangan) }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="notelp_perusahaan_pasangan"
                                                        class="form-label fw-bold text-dark">No Telp Perusahaan
                                                        Pasangan</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="notelp_perusahaan_pasangan" name="notelp_perusahaan_pasangan"
                                                        maxlength="20"
                                                        placeholder="Masukkan nomor telepon perusahaan pasangan"
                                                        value="{{ old('notelp_perusahaan_pasangan', $nasabah_pekerjaan->notelp_perusahaan_pasangan) }}">
                                                </div>

                                                <div class="col-md-3 mt-2">
                                                    <label for="penggajian_satu_pasangan"
                                                        class="form-label fw-bold text-dark">Penggajian Satu
                                                        Pasangan</label>
                                                    <input disabled type="text" maxlength="2"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="penggajian_satu_pasangan" name="penggajian_satu_pasangan"
                                                        value="{{ old('penggajian_satu_pasangan', $nasabah_pekerjaan->penggajian_satu_pasangan) }}">
                                                </div>

                                                <div class="col-md-3 mt-2">
                                                    <label for="penggajian_dua_pasangan"
                                                        class="form-label fw-bold text-dark">Penggajian Dua
                                                        Pasangan</label>
                                                    <input disabled type="text" maxlength="2"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="penggajian_dua_pasangan" name="penggajian_dua_pasangan"
                                                        value="{{ old('penggajian_dua_pasangan', $nasabah_pekerjaan->penggajian_dua_pasangan) }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="pengalaman_perusahaanlain_pasangan"
                                                        class="form-label fw-bold text-dark">Pengalaman Perusahaan Lain
                                                        Pasangan</label>

                                                    <textarea class="form-control border-0 bg-white text-dark" id="pengalaman_perusahaanlain_pasangan"
                                                        name="pengalaman_perusahaanlain_pasangan" maxlength="200" placeholder="Masukkan pengalaman perusahaan lain">{{ old('pengalaman_perusahaanlain_pasangan', $nasabah_pekerjaan->pengalaman_perusahaanlain_pasangan) }}</textarea>
                                                </div>

                                            </div>

                                            <h6 class="border-bottom pb-2">3. Usaha Nasabah/ Pasangan</h6>
                                            <div class="row g-3 mb-3">

                                                <div class="col-md-6 mt-2">
                                                    <label for="nama_perusahaan_usaha"
                                                        class="form-label fw-bold text-dark">Nama Perusahaan Usaha</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="nama_perusahaan_usaha" name="nama_perusahaan_usaha"
                                                        placeholder="Masukkan nama perusahaan usaha"
                                                        value="{{ old('nama_perusahaan_usaha', $nasabah_pekerjaan->nama_perusahaan_usaha) }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="bidang_perusahaan_usaha"
                                                        class="form-label fw-bold text-dark">Bidang Perusahaan
                                                        Usaha</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="bidang_perusahaan_usaha" name="bidang_perusahaan_usaha"
                                                        placeholder="Masukkan bidang perusahaan"
                                                        value="{{ old('bidang_perusahaan_usaha', $nasabah_pekerjaan->bidang_perusahaan_usaha) }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="jabatan_usaha"
                                                        class="form-label fw-bold text-dark">Jabatan Usaha</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="jabatan_usaha" name="jabatan_usaha"
                                                        placeholder="Masukkan jabatan"
                                                        value="{{ old('jabatan_usaha', $nasabah_pekerjaan->jabatan_usaha) }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="mulai_usaha" class="form-label fw-bold text-dark">Mulai
                                                        Usaha</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark" id="mulai_usaha"
                                                        name="mulai_usaha" placeholder="Contoh: 2019"
                                                        value="{{ old('mulai_usaha', $nasabah_pekerjaan->mulai_usaha) }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="lama_usaha" class="form-label fw-bold text-dark">Lama
                                                        Usaha</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark" id="lama_usaha"
                                                        name="lama_usaha" placeholder="Masukkan lama usaha"
                                                        value="{{ old('lama_usaha', $nasabah_pekerjaan->lama_usaha) }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="total_lama_usaha"
                                                        class="form-label fw-bold text-dark">Total Lama Usaha</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="total_lama_usaha" name="total_lama_usaha"
                                                        placeholder="Masukkan total lama usaha"
                                                        value="{{ old('total_lama_usaha', $nasabah_pekerjaan->total_lama_usaha) }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="jumlah_karyawan_usaha"
                                                        class="form-label fw-bold text-dark">Jumlah Karyawan Usaha</label>
                                                    <input disabled type="number"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="jumlah_karyawan_usaha" name="jumlah_karyawan_usaha"
                                                        placeholder="Masukkan jumlah karyawan"
                                                        value="{{ old('jumlah_karyawan_usaha', $nasabah_pekerjaan->jumlah_karyawan_usaha) }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="keterangan_tambahan_usaha"
                                                        class="form-label fw-bold text-dark">Keterangan Tambahan
                                                        Usaha</label>
                                                    <textarea class="form-control border-0 bg-white text-dark" id="keterangan_tambahan_usaha"
                                                        name="keterangan_tambahan_usaha" rows="2" placeholder="Masukkan keterangan tambahan">{{ old('keterangan_tambahan_usaha', $nasabah_pekerjaan->keterangan_tambahan_usaha) }}</textarea>
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="usaha_pensiun_usaha"
                                                        class="form-label fw-bold text-dark">Usaha Pensiun</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="usaha_pensiun_usaha" name="usaha_pensiun_usaha"
                                                        placeholder="Masukkan usaha pensiun"
                                                        value="{{ old('usaha_pensiun_usaha', $nasabah_pekerjaan->usaha_pensiun_usaha) }}">
                                                </div>

                                                <!-- Supplier 1 -->
                                                <div class="col-md-6 mt-2">
                                                    <label for="nama_suppliersatu_usaha"
                                                        class="form-label fw-bold text-dark">Nama Supplier 1</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="nama_suppliersatu_usaha" name="nama_suppliersatu_usaha"
                                                        placeholder="Masukkan nama supplier 1"
                                                        value="{{ old('nama_suppliersatu_usaha', $nasabah_pekerjaan->nama_suppliersatu_usaha) }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="alamat_suppliersatu_usaha"
                                                        class="form-label fw-bold text-dark">Alamat Supplier 1</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="alamat_suppliersatu_usaha" name="alamat_suppliersatu_usaha"
                                                        placeholder="Masukkan alamat supplier 1"
                                                        value="{{ old('alamat_suppliersatu_usaha', $nasabah_pekerjaan->alamat_suppliersatu_usaha) }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="notelp_suppliersatu_usaha"
                                                        class="form-label fw-bold text-dark">No. Telp Supplier 1</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="notelp_suppliersatu_usaha" name="notelp_suppliersatu_usaha"
                                                        placeholder="Masukkan nomor telepon supplier 1"
                                                        value="{{ old('notelp_suppliersatu_usaha', $nasabah_pekerjaan->notelp_suppliersatu_usaha) }}">
                                                </div>

                                                <!-- Supplier 2 -->
                                                <div class="col-md-6 mt-2">
                                                    <label for="nama_supplierdua_usaha"
                                                        class="form-label fw-bold text-dark">Nama Supplier 2</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="nama_supplierdua_usaha" name="nama_supplierdua_usaha"
                                                        placeholder="Masukkan nama supplier 2"
                                                        value="{{ old('nama_supplierdua_usaha', $nasabah_pekerjaan->nama_supplierdua_usaha) }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="alamat_supplierdua_usaha"
                                                        class="form-label fw-bold text-dark">Alamat Supplier 2</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="alamat_supplierdua_usaha" name="alamat_supplierdua_usaha"
                                                        placeholder="Masukkan alamat supplier 2"
                                                        value="{{ old('alamat_supplierdua_usaha', $nasabah_pekerjaan->alamat_supplierdua_usaha) }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="notelp_supplierdua_usaha"
                                                        class="form-label fw-bold text-dark">No. Telp Supplier 2</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="notelp_supplierdua_usaha" name="notelp_supplierdua_usaha"
                                                        placeholder="Masukkan nomor telepon supplier 2"
                                                        value="{{ old('notelp_supplierdua_usaha', $nasabah_pekerjaan->notelp_supplierdua_usaha) }}">
                                                </div>

                                                <!-- Supplier 3 -->
                                                <div class="col-md-6 mt-2">
                                                    <label for="nama_suppliertiga_usaha"
                                                        class="form-label fw-bold text-dark">Nama Supplier 3</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="nama_suppliertiga_usaha" name="nama_suppliertiga_usaha"
                                                        placeholder="Masukkan nama supplier 3"
                                                        value="{{ old('nama_suppliertiga_usaha', $nasabah_pekerjaan->nama_suppliertiga_usaha) }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="alamat_suppliertiga_usaha"
                                                        class="form-label fw-bold text-dark">Alamat Supplier 3</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="alamat_suppliertiga_usaha" name="alamat_suppliertiga_usaha"
                                                        placeholder="Masukkan alamat supplier 3"
                                                        value="{{ old('alamat_suppliertiga_usaha', $nasabah_pekerjaan->alamat_suppliertiga_usaha) }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="notelp_suppliertiga_usaha"
                                                        class="form-label fw-bold text-dark">No. Telp Supplier 3</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="notelp_suppliertiga_usaha" name="notelp_suppliertiga_usaha"
                                                        placeholder="Masukkan nomor telepon supplier 3"
                                                        value="{{ old('notelp_suppliertiga_usaha', $nasabah_pekerjaan->notelp_suppliertiga_usaha) }}">
                                                </div>

                                            </div>

                                            <div class="d-flex gap-2 justify-content-start mt-3" id="nav-tab"
                                                role="tablist">
                                                <a href="{{ route('multiguna.limac.capacity.data') }}"
                                                    class="btn btn-secondary">
                                                    ← Kembali
                                                </a>
                                            </div>

                                        </div>
                                        <div class="tab-pane fade" id="nav-2" role="tabpanel"
                                            aria-labelledby="nav-2-tab">
                                            <h6 class="border-bottom pb-2">Reputasi Nasabah dalam Pekerjaan</h6>

                                            <div class="row g-3 mb-3">
                                                @php
                                                    $options = ['Iya (2)', 'Tidak (1)'];

                                                    $fields = [
                                                        'memiliki_jabatan_rangkap' => 'Memiliki Jabatan Rangkap?',
                                                        'publik_figur' => 'Publik Figur?',
                                                        'pemegang_jabatan_tertinggi' => 'Pemegang Jabatan Tertinggi?',
                                                        'bukan_pemegang_jabatan_tertinggi' =>
                                                            'Bukan Pemegang Jabatan Tertinggi?',
                                                        'non_jabatan' => 'Non Jabatan?',
                                                    ];

                                                @endphp

                                                @foreach ($fields as $field => $label)
                                                    @php
                                                        $selected = old($field, $pengajuan->$field ?? '');
                                                        $firstOptionId =
                                                            $field . preg_replace('/[^a-zA-Z0-9]/', '', $options[0]);
                                                    @endphp

                                                    <div class="col-md-4 mt-2">
                                                        <label for="{{ $firstOptionId }}"
                                                            class="form-label fw-bold text-info d-block">{{ $label }}</label>

                                                        @foreach ($options as $option)
                                                            @php
                                                                $inputId =
                                                                    $field .
                                                                    preg_replace('/[^a-zA-Z0-9]/', '', $option);
                                                            @endphp
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="{{ $field }}"
                                                                    id="{{ $inputId }}"
                                                                    value="{{ $option }}"
                                                                    {{ $selected == $option ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                    for="{{ $inputId }}">
                                                                    {{ $option }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-3" role="tabpanel"
                                            aria-labelledby="nav-3-tab">
                                            <h6 class="border-bottom pb-2">Fasilitas Dinas Yang Diterima</h6>
                                            <div class="row g-3 mb-3">

                                                @php
                                                    $fields = [
                                                        'mendapat_rumah_dinas' => 'Mendapat Rumah Dinas?',
                                                        'mendapat_mobil_dinas' => 'Mendapat Mobil Dinas?',
                                                        'mendapat_sepeda_motor_dinas' => 'Mendapat Sepeda Motor Dinas?',
                                                        'mendapat_fasilitas_pinjaman_uang' =>
                                                            'Mendapat Fasilitas Pinjaman Uang?',
                                                        'belum_mendapat_fasilitas_dinas' =>
                                                            'Belum Mendapat Fasilitas Dinas?',
                                                    ];
                                                @endphp

                                                @foreach ($fields as $field => $label)
                                                    @php
                                                        $selected = old($field, $pengajuan->$field ?? '');
                                                        $firstOptionId =
                                                            $field . preg_replace('/[^a-zA-Z0-9]/', '', $options[0]);
                                                    @endphp

                                                    <div class="col-md-4 mt-2">
                                                        <label for="{{ $firstOptionId }}"
                                                            class="form-label fw-bold text-info d-block">{{ $label }}</label>

                                                        @foreach ($options as $option)
                                                            @php
                                                                $inputId =
                                                                    $field .
                                                                    preg_replace('/[^a-zA-Z0-9]/', '', $option);
                                                            @endphp
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="{{ $field }}"
                                                                    id="{{ $inputId }}"
                                                                    value="{{ $option }}"
                                                                    {{ $selected == $option ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                    for="{{ $inputId }}">
                                                                    {{ $option }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-4" role="tabpanel"
                                            aria-labelledby="nav-4-tab">
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
                                        </div>
                                        <div class="tab-pane fade" id="nav-5" role="tabpanel"
                                            aria-labelledby="nav-5-tab">
                                            <div
                                                class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2">
                                                <h6>Hutang/Pinjaman Nasabah
                                                </h6>
                                                <a href="{{ route('multiguna.limac.character.edit', $pengajuan->kode_pengajuan) }}"
                                                    class="btn btn-sm btn-link text-warning p-1">
                                                    Ubah data Checking Nasabah di sini ... <i class="fas fa-edit"></i>
                                                </a>
                                            </div>

                                            <div class="row g-3 mb-3 p-1">
                                                <div class="table-responsive mb-4">
                                                    <table class="table table-bordered">
                                                        <thead class="text-light">
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
                                                            @foreach ($pengajuan_checking_nasabah as $i => $item)
                                                                <tr>
                                                                    <td class="p-1 align-middle text-center">
                                                                        {{ $i + 1 }}</td>

                                                                    <td class="p-1"><input disabled type="text"
                                                                            class="form-control align-middle text-center border-0 bg-white text-dark"
                                                                            name="id_checking_nasabah[{{ $i }}][fasilitas_pinjaman]"
                                                                            value="{{ $item->fasilitas_pinjaman_nasabah }}">
                                                                    </td>

                                                                    <td class="p-1"><input disabled type="text"
                                                                            class="form-control align-middle text-center border-0 bg-white text-dark"
                                                                            name="id_checking_nasabah[{{ $i }}][plafond_pinjaman]"
                                                                            value="{{ $item->plafond_pinjaman_nasabah }}">
                                                                    </td>

                                                                    <input disabled type="hidden"
                                                                        id="tanggal_realisasi_nasabah_{{ $i }}"
                                                                        name="id_checking_nasabah[{{ $i }}][tanggal_realisasi]"
                                                                        value="{{ $item->tanggal_realisasi_nasabah }}">

                                                                    <input disabled type="hidden"
                                                                        id="tanggal_jatuh_tempo_nasabah_{{ $i }}"
                                                                        name="id_checking_nasabah[{{ $i }}][tanggal_jatuh_tempo]"
                                                                        value="{{ $item->tanggal_jatuh_tempo_nasabah }}">
                                                                    @php
                                                                        $tanggalRealisasi =
                                                                            $item->tanggal_realisasi_nasabah;
                                                                        $tanggalTempo =
                                                                            $item->tanggal_jatuh_tempo_nasabah;

                                                                        $jangkaWaktu = '-';

                                                                        if ($tanggalRealisasi && $tanggalTempo) {
                                                                            $start = \Carbon\Carbon::parse(
                                                                                $tanggalRealisasi,
                                                                            );
                                                                            $end = \Carbon\Carbon::parse($tanggalTempo);

                                                                            $totalBulan = $start->diffInMonths($end);

                                                                            $tahun = floor($totalBulan / 12);
                                                                            $bulan = $totalBulan % 12;

                                                                            if ($tahun > 0 && $bulan > 0) {
                                                                                $jangkaWaktu = "$tahun tahun $bulan bulan";
                                                                            } elseif ($tahun > 0) {
                                                                                $jangkaWaktu = "$tahun tahun";
                                                                            } elseif ($bulan > 0) {
                                                                                $jangkaWaktu = "$bulan bulan";
                                                                            } else {
                                                                                $jangkaWaktu = '0 bulan';
                                                                            }
                                                                        }
                                                                    @endphp

                                                                    <td class="p-1"><input disabled type="text"
                                                                            class="form-control align-middle text-center border-0 bg-white text-dark"
                                                                            value="{{ $jangkaWaktu }}">
                                                                    </td>

                                                                    <td class="p-1"><input disabled type="text"
                                                                            class="form-control align-middle text-center border-0 bg-white text-dark"
                                                                            name="id_checking_nasabah[{{ $i }}][outstanding_pinjaman]"
                                                                            value="{{ $item->outstanding_pinjaman_nasabah }}">
                                                                    </td>
                                                                    <td class="p-1"><input disabled type="text"
                                                                            class="form-control align-middle text-center border-0 bg-white text-dark"
                                                                            name="id_checking_nasabah[{{ $i }}][bank_pelapor]"
                                                                            value="{{ $item->bank_pelapor_nasabah }}">
                                                                    </td>
                                                                    <td class="p-1"><input disabled type="text"
                                                                            class="form-control align-middle text-center border-0 bg-white text-dark"
                                                                            name="id_checking_nasabah[{{ $i }}][agunan]"
                                                                            value="{{ $item->agunan_nasabah }}">
                                                                    </td>
                                                                </tr>
                                                            @endforeach
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
                                                            @foreach ($pengajuan_checking_pasangan as $i => $item)
                                                                <tr>
                                                                    <td class="p-1 align-middle text-center">
                                                                        {{ $i + 1 }}</td>

                                                                    <td class="p-1"><input disabled type="text"
                                                                            class="form-control align-middle text-center border-0 bg-white text-dark"
                                                                            name="id_checking_pasangan[{{ $i }}][fasilitas_pinjaman]"
                                                                            value="{{ $item->fasilitas_pinjaman_pasangan }}">
                                                                    </td>

                                                                    <td class="p-1"><input disabled type="text"
                                                                            class="form-control align-middle text-center border-0 bg-white text-dark"
                                                                            name="id_checking_pasangan[{{ $i }}][plafond_pinjaman]"
                                                                            value="{{ $item->plafond_pinjaman_pasangan }}">
                                                                    </td>

                                                                    <input disabled type="hidden"
                                                                        id="tanggal_realisasi_pasangan_{{ $i }}"
                                                                        name="id_checking_pasangan[{{ $i }}][tanggal_realisasi]"
                                                                        value="{{ $item->tanggal_realisasi_pasangan }}">

                                                                    <input disabled type="hidden"
                                                                        id="tanggal_jatuh_tempo_pasangan_{{ $i }}"
                                                                        name="id_checking_pasangan[{{ $i }}][tanggal_jatuh_tempo]"
                                                                        value="{{ $item->tanggal_jatuh_tempo_pasangan }}">
                                                                    @php
                                                                        $tanggalRealisasi =
                                                                            $item->tanggal_realisasi_pasangan;
                                                                        $tanggalTempo =
                                                                            $item->tanggal_jatuh_tempo_pasangan;

                                                                        $jangkaWaktu = '-';

                                                                        if ($tanggalRealisasi && $tanggalTempo) {
                                                                            $start = \Carbon\Carbon::parse(
                                                                                $tanggalRealisasi,
                                                                            );
                                                                            $end = \Carbon\Carbon::parse($tanggalTempo);

                                                                            $totalBulan = $start->diffInMonths($end);

                                                                            $tahun = floor($totalBulan / 12);
                                                                            $bulan = $totalBulan % 12;

                                                                            if ($tahun > 0 && $bulan > 0) {
                                                                                $jangkaWaktu = "$tahun tahun $bulan bulan";
                                                                            } elseif ($tahun > 0) {
                                                                                $jangkaWaktu = "$tahun tahun";
                                                                            } elseif ($bulan > 0) {
                                                                                $jangkaWaktu = "$bulan bulan";
                                                                            } else {
                                                                                $jangkaWaktu = '0 bulan';
                                                                            }
                                                                        }
                                                                    @endphp

                                                                    <td class="p-1"><input disabled type="text"
                                                                            class="form-control align-middle text-center border-0 bg-white text-dark"
                                                                            value="{{ $jangkaWaktu }}">
                                                                    </td>

                                                                    <td class="p-1"><input disabled type="text"
                                                                            class="form-control align-middle text-center border-0 bg-white text-dark"
                                                                            name="id_checking_pasangan[{{ $i }}][outstanding_pinjaman]"
                                                                            value="{{ $item->outstanding_pinjaman_pasangan }}">
                                                                    </td>
                                                                    <td class="p-1"><input disabled type="text"
                                                                            class="form-control align-middle text-center border-0 bg-white text-dark"
                                                                            name="id_checking_pasangan[{{ $i }}][bank_pelapor]"
                                                                            value="{{ $item->bank_pelapor_pasangan }}">
                                                                    </td>
                                                                    <td class="p-1"><input disabled type="text"
                                                                            class="form-control align-middle text-center border-0 bg-white text-dark"
                                                                            name="id_checking_pasangan[{{ $i }}][agunan]"
                                                                            value="{{ $item->agunan_pasangan }}">
                                                                    </td>
                                                                </tr>
                                                            @endforeach
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
                                                            ['label' => 'Gaji Pokok', 'name' => 'gaji_pokok'],
                                                            [
                                                                'label' => 'Tunjangan Penghasilan',
                                                                'name' => 'tunjangan_penghasilan',
                                                            ],
                                                            [
                                                                'label' => 'Tunjangan Kesejahteraan',
                                                                'name' => 'tunjangan_kesejahteraan',
                                                            ],
                                                            [
                                                                'label' => 'Tunjangan Struktural',
                                                                'name' => 'tunjangan_struktural',
                                                            ],
                                                            [
                                                                'label' => 'Tunjangan Fungsional',
                                                                'name' => 'tunjangan_fungsional',
                                                            ],
                                                            [
                                                                'label' => 'Tunjangan Suami/Istri',
                                                                'name' => 'tunjangan_suami_istri',
                                                            ],
                                                            ['label' => 'Tunjangan Anak', 'name' => 'tunjangan_anak'],
                                                            ['label' => 'Tunjangan Beras', 'name' => 'tunjangan_beras'],
                                                            [
                                                                'label' => 'Tunjangan Lain-lain',
                                                                'name' => 'tunjangan_lain_lain',
                                                            ],
                                                            [
                                                                'label' => 'Tunjangan Pengobatan',
                                                                'name' => 'tunjangan_pengobatan',
                                                            ],
                                                            [
                                                                'label' => 'Penerimaan Lain-lain',
                                                                'name' => 'penerimaan_lain_lain',
                                                            ],
                                                        ];

                                                        $pengeluaran_fields = [
                                                            ['label' => 'Simpanan Wajib', 'name' => 'simpanan_wajib'],
                                                            ['label' => 'Iuran Koperasi', 'name' => 'iuran_koperasi'],
                                                            ['label' => 'Iuran BPJS', 'name' => 'iuran_bpjs'],
                                                            [
                                                                'label' => 'Potongan Lain-lain',
                                                                'name' => 'potongan_lain_lain',
                                                            ],
                                                            [
                                                                'label' => 'Pajak Penghasilan (PPH 21)',
                                                                'name' => 'pajak_penghasilan_pph21',
                                                            ],
                                                            [
                                                                'label' => 'Angsuran Pinjaman di Tempat Lain',
                                                                'name' => 'angsuran_pinjaman_lain',
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
                                                                </tr>
                                                            @endforeach
                                                            <tr class="font-weight-bold">
                                                                <td class="text-start p-2">Total Pengeluaran</td>
                                                                <td class="text-end p-2" id="total-pengeluaran">Rp. 0,00
                                                                </td>
                                                            </tr>
                                                            <tr class="bg-success text-white font-weight-bold">
                                                                <td class="text-start p-2">Penghasilan Bersih</td>
                                                                <td class="text-end p-2" id="penghasilan-bersih">Rp.
                                                                    0,00
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>

                                        </div>
                                        <div class="tab-pane fade" id="nav-6" role="tabpanel"
                                            aria-labelledby="nav-6-tab">

                                            <div
                                                class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2">
                                                <h6 class="text-danger mb-0">Permohonan Pembiayaan</h6>
                                                <a href="{{ route('multiguna.pengajuan.edit', $pengajuan_pembiayaan->kode_pengajuan) }}"
                                                    class="btn btn-sm btn-link text-warning p-1" id="target-shake">
                                                    Ubah data Permohonan Pembiayaan di sini ... <i
                                                        class="fas fa-edit"></i>
                                                </a>
                                            </div>

                                            <div class="row g-3 mb-3">
                                                <div class="col-md-12 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="permohonan_jenis_akad">
                                                        Jenis Akad
                                                    </label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="permohonan_jenis_akad" name="permohonan_jenis_akad"
                                                        value="{{ old('permohonan_jenis_akad', $pengajuan_pembiayaan->permohonan_jenis_akad ?? '--') }}">
                                                </div>
                                                <div class="col-md-12 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="permohonan_jenis_pembiayaan">
                                                        Jenis Pembiayaan
                                                    </label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="permohonan_jenis_pembiayaan"
                                                        name="permohonan_jenis_pembiayaan"
                                                        value="{{ old('permohonan_jenis_pembiayaan', $pengajuan_pembiayaan->permohonan_jenis_pembiayaan ?? '--') }}">
                                                </div>


                                                <div class="col-md-12 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="permohonan_tujuan_penggunaan">
                                                        Tujuan Penggunaan
                                                    </label>
                                                    <select disabled class="form-control border-0 bg-white text-dark"
                                                        id="permohonan_tujuan_penggunaan"
                                                        name="permohonan_tujuan_penggunaan">
                                                        @php
                                                            $options = [
                                                                '--',
                                                                'Pembiayaan Konsumtif',
                                                                'Pembiayaan Produktif',
                                                            ];
                                                            $selected = old(
                                                                'permohonan_tujuan_penggunaan',
                                                                $pengajuan_pembiayaan->permohonan_tujuan_penggunaan ??
                                                                    '--',
                                                            );
                                                        @endphp

                                                        <option value="" disabled
                                                            {{ $selected == '' ? 'selected' : '' }}>-- Pilih Tujuan
                                                            Penggunaan --</option>
                                                        @foreach ($options as $option)
                                                            <option value="{{ $option }}"
                                                                {{ $selected == $option ? 'selected' : '' }}>
                                                                {{ $option }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-12 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="permohonan_harga_beli_bank">
                                                        Harga Beli Bank
                                                    </label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="permohonan_harga_beli_bank"
                                                        name="permohonan_harga_beli_bank"
                                                        value="{{ old('permohonan_harga_beli_bank', $pengajuan_pembiayaan->permohonan_harga_beli_bank ?? '--') }}">
                                                </div>

                                                <!-- Jangka Waktu Pembiayaan (tahun) -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="permohonan_jangka_waktu_pembiayaan">
                                                        Jangka Waktu Pembiayaan (tahun)
                                                    </label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="permohonan_jangka_waktu_pembiayaan"
                                                        name="permohonan_jangka_waktu_pembiayaan"
                                                        value="{{ old('permohonan_jangka_waktu_pembiayaan', $pengajuan_pembiayaan->permohonan_jangka_waktu_pembiayaan ?? '--') }}">
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
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="permohonan_margin_bank" name="permohonan_margin_bank"
                                                        value="{{ old('permohonan_margin_bank', $pengajuan_pembiayaan->permohonan_margin_bank ?? '--') }}">
                                                </div>

                                                <div class="col-md-3 mt-2">
                                                    <label class="form-label fw-bold text-dark">Margin Bank
                                                        (% per tahun)</label>
                                                    <div id="permohonan_margin_tahun_output" class="mt-1">—</div>
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark">Nominal Margin
                                                        Bank</label>
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

                                            <h6 class="text-danger border-bottom pb-2">Pembiayaan Berdasarkan Net Income
                                            </h6>

                                            <div class="row g-3 mb-3">
                                                <div class="col-6">Harga beli Bank/ Pembiayaan</div>
                                                <div class="col-6 text-left font-weight-bold"
                                                    id="netincome_harga_beli_bank">
                                                    Rp. 0,00
                                                </div>
                                            </div>
                                            <div class="row g-3 mb-3">
                                                <div class="col-6">Margin Bank</div>
                                                <div class="col-6 text-left font-weight-bold"
                                                    id="netincome_margin_bank">
                                                    Rp. 0,00
                                                </div>
                                            </div>
                                            <div class="row g-3 mb-3">
                                                <div class="col-6">
                                                    <label for="netincome_jangka_waktu_pembiayaan">Jangka Waktu Pembiayaan
                                                        (Tahun)</label>
                                                </div>
                                                <div class="col-6">
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white font-weight-bold text-left p-0 m-0"
                                                        id="netincome_jangka_waktu_pembiayaan"
                                                        name="netincome_jangka_waktu_pembiayaan"
                                                        value="{{ ': ' . $pengajuan_pembiayaan->permohonan_jangka_waktu_pembiayaan . ' tahun' }}"
                                                        oninput="hitungHargaJual()">
                                                </div>
                                            </div>
                                            <div class="row g-3 mb-3">
                                                <div class="col-6">Jangka Waktu Pembiayaan
                                                    (Bulan)</div>
                                                <div class="col-6 text-left font-weight-bold"
                                                    id="netincome_jangka_waktu_bulan">12
                                                </div>
                                            </div>
                                            <div class="row g-3 mb-3">
                                                <div class="col-6">Angsuran Per Bulan</div>
                                                <div class="col-6 text-left font-weight-bold"
                                                    id="netincome_angsuran_per_bulan">Rp.
                                                    0,00</div>
                                            </div>
                                            <div class="row g-3 mb-3">
                                                <div class="col-6 font-weight-bold">Repayment Capacity (kemampuan gaji
                                                    nasabah membayar
                                                    angsuran)</div>
                                                <div class="col-6 text-left font-weight-bold" id="netincome_repayment">1
                                                </div>
                                            </div>

                                        </div>
                                        <div class="tab-pane fade" id="nav-7" role="tabpanel"
                                            aria-labelledby="nav-7-tab">

                                            <h6 class="text-danger border-bottom pb-2">Pembiayaan Berdasarkan Analis
                                            </h6>

                                            <div class="row g-3 mb-3">
                                                <div class="col-6">
                                                    <label for="analis_harga_beli_bank">Harga Beli Bank /
                                                        Pembiayaan</label>
                                                </div>
                                                <div class="col-6">
                                                    <input type="hidden" id="analis_harga_beli_bank_from_db"
                                                        value="{{ $pengajuan->analis_harga_beli_bank ? '1' : '0' }}">

                                                    <input type="number" step="0.01"
                                                        class="form-control font-weight-bold text-left p-0 pl-2 py-1 m-0"
                                                        id="analis_harga_beli_bank" name="analis_harga_beli_bank"
                                                        value="{{ old('analis_harga_beli_bank', $pengajuan->analis_harga_beli_bank ?? '') }}"
                                                        oninput="hitungAngsuranAnalis()">

                                                </div>
                                            </div>

                                            <div class="row g-3 mb-3">
                                                <div class="col-6">Margin Bank</div>
                                                <div class="col-6">
                                                    <input type="hidden" id="analis_margin_bank_from_db"
                                                        value="{{ $pengajuan->analis_margin_bank ? '1' : '0' }}">
                                                    <input type="hidden" id="save_analis_margin_bank_from_db"
                                                        name="save_analis_margin_bank_from_db" value="">

                                                    <input type="number" step="0.01"
                                                        class="form-control font-weight-bold text-left p-0 pl-2 py-1 m-0"
                                                        id="analis_margin_bank" name="analis_margin_bank"
                                                        value="{{ old('analis_margin_bank', $pengajuan->analis_margin_bank ?? '') }}"
                                                        oninput="hitungAngsuranAnalis()">
                                                </div>
                                            </div>
                                            <div class="row g-3 mb-3">
                                                <div class="col-6">
                                                    <label for="analis_jangka_waktu_pembiayaan">Jangka Waktu Pembiayaan
                                                        (Tahun)</label>
                                                </div>
                                                <div class="col-6">
                                                    <input type="text"
                                                        class="form-control font-weight-bold text-left p-0 pl-2 py-1 m-0"
                                                        id="analis_jangka_waktu_pembiayaan"
                                                        name="analis_jangka_waktu_pembiayaan"
                                                        value="{{ ($pengajuan->analis_jangka_waktu_pembiayaan ?? '') !== '' ? $pengajuan->analis_jangka_waktu_pembiayaan : $pengajuan_pembiayaan->permohonan_jangka_waktu_pembiayaan ?? '' }}"
                                                        oninput="hitungAngsuranAnalis()">
                                                </div>
                                            </div>
                                            <div class="row g-3 mb-3">
                                                <div class="col-6">Jangka Waktu Pembiayaan
                                                    (Bulan)</div>
                                                <div class="col-6 text-left font-weight-bold"
                                                    id="analis_jangka_waktu_bulan">12
                                                </div>
                                            </div>
                                            <div class="row g-3 mb-3">
                                                <div class="col-6">
                                                    <label for="analis_angsuran_per_bulan">Angsuran Per Bulan</label>
                                                </div>
                                                <div class="col-6">
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark p-0 py-1 m-0"
                                                        id="analis_angsuran_per_bulan" name="analis_angsuran_per_bulan">
                                                </div>
                                            </div>
                                            <div class="row g-3 mb-3">
                                                <div class="col-6 font-weight-bold">Repayment Capacity (kemampuan gaji
                                                    nasabah membayar
                                                    angsuran)</div>
                                                <div class="col-6 text-left font-weight-bold" id="analis_repayment">1
                                                </div>
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
    <!-- [ Main Content ] end -->
@endsection
