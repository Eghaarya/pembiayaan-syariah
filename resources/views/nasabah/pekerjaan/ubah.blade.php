@extends('layouts.app')

@section('content')
    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="card card-social">
                    <div class="card-block border-bottom">
                        <div class="row">
                            <div class="col-12">
                                <form action="{{ route('nasabah.pekerjaan.update', $nasabah_pekerjaan->kode_nasabah) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')

                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-1-tab" data-toggle="tab"
                                                data-target="#nav-1" type="button" role="tab" aria-controls="nav-1"
                                                aria-selected="true">1. Pekerjaan Nasabah</button>
                                            <button class="nav-link" id="nav-2-tab" data-toggle="tab" data-target="#nav-2"
                                                type="button" role="tab" aria-controls="nav-2" aria-selected="false">2.
                                                Pekerjaan Pasangan</button>
                                            <button class="nav-link" id="nav-3-tab" data-toggle="tab" data-target="#nav-3"
                                                type="button" role="tab" aria-controls="nav-3" aria-selected="false">3.
                                                Usaha Nasabah/ Pasangan</button>
                                        </div>
                                    </nav>
                                    <div class="tab-content p-3" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-1" role="tabpanel"
                                            aria-labelledby="nav-1-tab">
                                            <h6 class="border-bottom pb-2">1. Pekerjaan Nasabah</h6>
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
                                                    <input type="text" class="form-control" id="nama_perusahaan_nasabah"
                                                        name="nama_perusahaan_nasabah" maxlength="100"
                                                        placeholder="Masukkan nama perusahaan"
                                                        value="{{ old('nama_perusahaan_nasabah', $nasabah_pekerjaan->nama_perusahaan_nasabah) }}">
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <label for="bidang_perusahaan_nasabah"
                                                        class="form-label fw-bold text-info">Bidang Perusahaan
                                                        Nasabah</label>
                                                    <select class="form-control" id="bidang_perusahaan_nasabah"
                                                        name="bidang_perusahaan_nasabah">
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
                                                    <select class="form-control" id="skala_perusahaan_nasabah"
                                                        name="skala_perusahaan_nasabah">
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
                                                        class="form-label fw-bold text-info">Jenis Pekerjaan Nasabah</label>
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
                                                    <select class="form-control" id="jenis_pekerjaan_nasabah"
                                                        name="jenis_pekerjaan_nasabah">
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

                                                    <select class="form-control" id="jabatan_pekerjaan_nasabah"
                                                        name="jabatan_pekerjaan_nasabah">
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
                                                    <input type="text" class="form-control" id="dept_perusahaan_nasabah"
                                                        name="dept_perusahaan_nasabah" maxlength="100"
                                                        placeholder="Masukkan departemen"
                                                        value="{{ old('dept_perusahaan_nasabah', $nasabah_pekerjaan->dept_perusahaan_nasabah) }}">
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <label for="mulai_bekerja_nasabah"
                                                        class="form-label fw-bold text-dark">Mulai Bekerja Nasabah</label>
                                                    <input type="text" class="form-control" id="mulai_bekerja_nasabah"
                                                        name="mulai_bekerja_nasabah" maxlength="5"
                                                        placeholder="Masukkan mulai bekerja (yyyy)"
                                                        value="{{ old('mulai_bekerja_nasabah', $nasabah_pekerjaan->mulai_bekerja_nasabah) }}">
                                                </div>
                                                <div class="col-md-3 mt-2">
                                                    <label for="lamabekerja_tahun_nasabah"
                                                        class="form-label fw-bold text-dark">Lama Bekerja Tahun</label>
                                                    <input type="text" class="form-control"
                                                        id="lamabekerja_tahun_nasabah" name="lamabekerja_tahun_nasabah"
                                                        maxlength="2" placeholder="Tahun"
                                                        value="{{ old('lamabekerja_tahun_nasabah', $nasabah_pekerjaan->lamabekerja_tahun_nasabah) }}">
                                                </div>
                                                <div class="col-md-3 mt-2">
                                                    <label for="lamabekerja_bulan_nasabah"
                                                        class="form-label fw-bold text-dark">Lama Bekerja Bulan</label>
                                                    <input type="text" class="form-control"
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

                                                    <select class="form-control" id="pengalaman_perusahaan_nasabah"
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
                                                    <input type="text" class="form-control"
                                                        id="totalbekerja_tahun_nasabah" name="totalbekerja_tahun_nasabah"
                                                        maxlength="2" placeholder="Tahun"
                                                        value="{{ old('totalbekerja_tahun_nasabah', $nasabah_pekerjaan->totalbekerja_tahun_nasabah) }}">
                                                </div>
                                                <div class="col-md-3 mt-2">
                                                    <label for="totalbekerja_bulan_nasabah"
                                                        class="form-label fw-bold text-dark">Total Bekerja Bulan</label>
                                                    <input type="text" class="form-control"
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
                                                            <input class="form-check-input" type="radio"
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

                                                    <select class="form-control" id="usia_nasabah" name="usia_nasabah">
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
                                                    <input type="text" class="form-control"
                                                        id="usia_prapensiun_nasabah" name="usia_prapensiun_nasabah"
                                                        maxlength="10" placeholder="Masukkan usia prapensiun"
                                                        value="{{ old('usia_prapensiun_nasabah', $nasabah_pekerjaan->usia_prapensiun_nasabah) }}">
                                                </div>
                                                <div class="col-md-3 mt-2">
                                                    <label for="usia_pensiun_nasabah"
                                                        class="form-label fw-bold text-dark">Usia Pensiun Nasabah</label>
                                                    <input type="text" class="form-control" id="usia_pensiun_nasabah"
                                                        name="usia_pensiun_nasabah" maxlength="10"
                                                        placeholder="Masukkan usia pensiun"
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

                                                    <select class="form-control" id="sisa_pensiun_nasabah"
                                                        name="sisa_pensiun_nasabah">
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
                                                    <input type="text" class="form-control" id="nama_atasan_nasabah"
                                                        name="nama_atasan_nasabah" maxlength="100"
                                                        placeholder="Masukkan nama atasan"
                                                        value="{{ old('nama_atasan_nasabah', $nasabah_pekerjaan->nama_atasan_nasabah) }}">
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <label for="notelp_atasan_nasabah"
                                                        class="form-label fw-bold text-dark">No. Telp Atasan
                                                        Nasabah</label>
                                                    <input type="text" class="form-control" id="notelp_atasan_nasabah"
                                                        name="notelp_atasan_nasabah" maxlength="20"
                                                        placeholder="Masukkan no. telp atasan"
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

                                                    <select class="form-control" id="jenispekerjaan_atasan_nasabah"
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
                                                    <textarea class="form-control" id="alamat_perusahaan_nasabah" name="alamat_perusahaan_nasabah" maxlength="200"
                                                        placeholder="Masukkan alamat perusahaan">{{ old('alamat_perusahaan_nasabah', $nasabah_pekerjaan->alamat_perusahaan_nasabah) }}</textarea>
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <label for="notelp_perusahaan_nasabah"
                                                        class="form-label fw-bold text-dark">No. Telp Perusahaan
                                                        Nasabah</label>
                                                    <input type="text" class="form-control"
                                                        id="notelp_perusahaan_nasabah" name="notelp_perusahaan_nasabah"
                                                        maxlength="20" placeholder="Masukkan no. telp perusahaan"
                                                        value="{{ old('notelp_perusahaan_nasabah', $nasabah_pekerjaan->notelp_perusahaan_nasabah) }}">
                                                </div>
                                                <div class="col-md-3 mt-2">
                                                    <label for="penggajian_satu_nasabah"
                                                        class="form-label fw-bold text-dark">Tanggal Penggajian
                                                        Satu</label>
                                                    <input type="text" maxlength="2" class="form-control"
                                                        id="penggajian_satu_nasabah" name="penggajian_satu_nasabah"
                                                        value="{{ old('penggajian_satu_nasabah', $nasabah_pekerjaan->penggajian_satu_nasabah) }}">
                                                </div>
                                                <div class="col-md-3 mt-2">
                                                    <label for="penggajian_dua_nasabah"
                                                        class="form-label fw-bold text-dark">Tanggal Penggajian Dua</label>
                                                    <input type="text" maxlength="2" class="form-control"
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

                                                    <select class="form-control" id="perjanjian_kerjasama_nasabah"
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
                                                    <textarea class="form-control" id="pengalaman_perusahaanlain_nasabah" name="pengalaman_perusahaanlain_nasabah"
                                                        maxlength="200" placeholder="Masukkan pengalaman perusahaan lain">{{ old('pengalaman_perusahaanlain_nasabah', $nasabah_pekerjaan->pengalaman_perusahaanlain_nasabah) }}</textarea>
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

                                                    <select class="form-control" id="sumber_penghasilan_nasabah"
                                                        name="sumber_penghasilan_nasabah">
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

                                                    <select class="form-control" id="tanggungan_nasabah"
                                                        name="tanggungan_nasabah">
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

                                            <div class="d-flex gap-2 justify-content-start" id="nav-tab"
                                                role="tablist">

                                                <a href="{{ route('nasabah.pekerjaan.data') }}"
                                                    class="btn btn-secondary">←
                                                    Kembali</a>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-2" role="tabpanel"
                                            aria-labelledby="nav-2-tab">
                                            <h6 class="border-bottom pb-2">2. Pekerjaan Pasangan</h6>
                                            <div class="row g-3 mb-3">

                                                <div class="col-md-6 mt-2">
                                                    <label for="nama_perusahaan_pasangan"
                                                        class="form-label fw-bold text-dark">Nama Perusahaan
                                                        Pasangan</label>
                                                    <input type="text" class="form-control"
                                                        id="nama_perusahaan_pasangan" name="nama_perusahaan_pasangan"
                                                        maxlength="100" placeholder="Masukkan nama perusahaan pasangan"
                                                        value="{{ old('nama_perusahaan_pasangan', $nasabah_pekerjaan->nama_perusahaan_pasangan) }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="bidang_perusahaan_pasangan"
                                                        class="form-label fw-bold text-dark">Bidang Perusahaan
                                                        Pasangan</label>
                                                    <select class="form-control" id="bidang_perusahaan_pasangan"
                                                        name="bidang_perusahaan_pasangan">
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
                                                    <select class="form-control" id="skala_perusahaan_pasangan"
                                                        name="skala_perusahaan_pasangan">
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
                                                    <select class="form-control" id="jenis_pekerjaan_pasangan"
                                                        name="jenis_pekerjaan_pasangan">
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

                                                    <select class="form-control" id="jabatan_pekerjaan_pasangan"
                                                        name="jabatan_pekerjaan_pasangan">
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
                                                    <input type="text" class="form-control"
                                                        id="dept_perusahaan_pasangan" name="dept_perusahaan_pasangan"
                                                        maxlength="100"
                                                        placeholder="Masukkan departemen perusahaan pasangan"
                                                        value="{{ old('dept_perusahaan_pasangan', $nasabah_pekerjaan->dept_perusahaan_pasangan) }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="mulai_bekerja_pasangan"
                                                        class="form-label fw-bold text-dark">Mulai Bekerja Pasangan</label>
                                                    <input type="text" class="form-control"
                                                        id="mulai_bekerja_pasangan" name="mulai_bekerja_pasangan"
                                                        maxlength="5" placeholder="Masukkan mulai bekerja pasangan"
                                                        value="{{ old('mulai_bekerja_pasangan', $nasabah_pekerjaan->mulai_bekerja_pasangan) }}">
                                                </div>

                                                <div class="col-md-3 mt-2">
                                                    <label for="lamabekerja_tahun_pasangan"
                                                        class="form-label fw-bold text-dark">Lama Bekerja (Tahun)
                                                        Pasangan</label>
                                                    <input type="text" class="form-control"
                                                        id="lamabekerja_tahun_pasangan" name="lamabekerja_tahun_pasangan"
                                                        maxlength="2" placeholder="Masukkan lama bekerja tahun pasangan"
                                                        value="{{ old('lamabekerja_tahun_pasangan', $nasabah_pekerjaan->lamabekerja_tahun_pasangan) }}">
                                                </div>

                                                <div class="col-md-3 mt-2">
                                                    <label for="lamabekerja_bulan_pasangan"
                                                        class="form-label fw-bold text-dark">Lama Bekerja (Bulan)
                                                        Pasangan</label>
                                                    <input type="text" class="form-control"
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

                                                    <select class="form-control" id="pengalaman_perusahaan_pasangan"
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
                                                    <input type="text" class="form-control"
                                                        id="totalbekerja_tahun_pasangan"
                                                        name="totalbekerja_tahun_pasangan" maxlength="2"
                                                        placeholder="Masukkan total bekerja tahun pasangan"
                                                        value="{{ old('totalbekerja_tahun_pasangan', $nasabah_pekerjaan->totalbekerja_tahun_pasangan) }}">
                                                </div>

                                                <div class="col-md-3 mt-2">
                                                    <label for="totalbekerja_bulan_pasangan"
                                                        class="form-label fw-bold text-dark">Total Bekerja (Bulan)
                                                        Pasangan</label>
                                                    <input type="text" class="form-control"
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
                                                            <input class="form-check-input" type="radio"
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

                                                    <select class="form-control" id="usia_pasangan" name="usia_pasangan">
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
                                                    <input type="text" class="form-control"
                                                        id="usia_prapensiun_pasangan" name="usia_prapensiun_pasangan"
                                                        maxlength="10" placeholder="Masukkan usia prapensiun pasangan"
                                                        value="{{ old('usia_prapensiun_pasangan', $nasabah_pekerjaan->usia_prapensiun_pasangan) }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="usia_pensiun_pasangan"
                                                        class="form-label fw-bold text-dark">Usia Pensiun Pasangan</label>
                                                    <input type="text" class="form-control" id="usia_pensiun_pasangan"
                                                        name="usia_pensiun_pasangan" maxlength="10"
                                                        placeholder="Masukkan usia pensiun pasangan"
                                                        value="{{ old('usia_pensiun_pasangan', $nasabah_pekerjaan->usia_pensiun_pasangan) }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="nama_atasan_pasangan"
                                                        class="form-label fw-bold text-dark">Nama Atasan Pasangan</label>
                                                    <input type="text" class="form-control" id="nama_atasan_pasangan"
                                                        name="nama_atasan_pasangan" maxlength="100"
                                                        placeholder="Masukkan nama atasan pasangan"
                                                        value="{{ old('nama_atasan_pasangan', $nasabah_pekerjaan->nama_atasan_pasangan) }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="notelp_atasan_pasangan"
                                                        class="form-label fw-bold text-dark">No Telp Atasan
                                                        Pasangan</label>
                                                    <input type="text" class="form-control"
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

                                                    <select class="form-control" id="jenispekerjaan_atasan_pasangan"
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
                                                    <input type="text" class="form-control"
                                                        id="alamat_perusahaan_pasangan" name="alamat_perusahaan_pasangan"
                                                        maxlength="200" placeholder="Masukkan alamat perusahaan pasangan"
                                                        value="{{ old('alamat_perusahaan_pasangan', $nasabah_pekerjaan->alamat_perusahaan_pasangan) }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="notelp_perusahaan_pasangan"
                                                        class="form-label fw-bold text-dark">No Telp Perusahaan
                                                        Pasangan</label>
                                                    <input type="text" class="form-control"
                                                        id="notelp_perusahaan_pasangan" name="notelp_perusahaan_pasangan"
                                                        maxlength="20"
                                                        placeholder="Masukkan nomor telepon perusahaan pasangan"
                                                        value="{{ old('notelp_perusahaan_pasangan', $nasabah_pekerjaan->notelp_perusahaan_pasangan) }}">
                                                </div>

                                                <div class="col-md-3 mt-2">
                                                    <label for="penggajian_satu_pasangan"
                                                        class="form-label fw-bold text-dark">Penggajian Satu
                                                        Pasangan</label>
                                                    <input type="text" maxlength="2" class="form-control"
                                                        id="penggajian_satu_pasangan" name="penggajian_satu_pasangan"
                                                        value="{{ old('penggajian_satu_pasangan', $nasabah_pekerjaan->penggajian_satu_pasangan) }}">
                                                </div>

                                                <div class="col-md-3 mt-2">
                                                    <label for="penggajian_dua_pasangan"
                                                        class="form-label fw-bold text-dark">Penggajian Dua
                                                        Pasangan</label>
                                                    <input type="text" maxlength="2" class="form-control"
                                                        id="penggajian_dua_pasangan" name="penggajian_dua_pasangan"
                                                        value="{{ old('penggajian_dua_pasangan', $nasabah_pekerjaan->penggajian_dua_pasangan) }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="pengalaman_perusahaanlain_pasangan"
                                                        class="form-label fw-bold text-dark">Pengalaman Perusahaan Lain
                                                        Pasangan</label>

                                                    <textarea class="form-control" id="pengalaman_perusahaanlain_pasangan" name="pengalaman_perusahaanlain_pasangan"
                                                        maxlength="200" placeholder="Masukkan pengalaman perusahaan lain">{{ old('pengalaman_perusahaanlain_pasangan', $nasabah_pekerjaan->pengalaman_perusahaanlain_pasangan) }}</textarea>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="tab-pane fade" id="nav-3" role="tabpanel"
                                            aria-labelledby="nav-3-tab">
                                            <h6 class="border-bottom pb-2">3. Usaha Nasabah/ Pasangan</h6>
                                            <div class="row g-3 mb-3">

                                                <div class="col-md-6 mt-2">
                                                    <label for="nama_perusahaan_usaha"
                                                        class="form-label fw-bold text-dark">Nama Perusahaan Usaha</label>
                                                    <input type="text" class="form-control" id="nama_perusahaan_usaha"
                                                        name="nama_perusahaan_usaha"
                                                        placeholder="Masukkan nama perusahaan usaha"
                                                        value="{{ old('nama_perusahaan_usaha', $nasabah_pekerjaan->nama_perusahaan_usaha) }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="bidang_perusahaan_usaha"
                                                        class="form-label fw-bold text-dark">Bidang Perusahaan
                                                        Usaha</label>
                                                    <input type="text" class="form-control"
                                                        id="bidang_perusahaan_usaha" name="bidang_perusahaan_usaha"
                                                        placeholder="Masukkan bidang perusahaan"
                                                        value="{{ old('bidang_perusahaan_usaha', $nasabah_pekerjaan->bidang_perusahaan_usaha) }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="jabatan_usaha"
                                                        class="form-label fw-bold text-dark">Jabatan Usaha</label>
                                                    <input type="text" class="form-control" id="jabatan_usaha"
                                                        name="jabatan_usaha" placeholder="Masukkan jabatan"
                                                        value="{{ old('jabatan_usaha', $nasabah_pekerjaan->jabatan_usaha) }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="mulai_usaha" class="form-label fw-bold text-dark">Mulai
                                                        Usaha</label>
                                                    <input type="text" class="form-control" id="mulai_usaha"
                                                        name="mulai_usaha" placeholder="Contoh: 2019"
                                                        value="{{ old('mulai_usaha', $nasabah_pekerjaan->mulai_usaha) }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="lama_usaha" class="form-label fw-bold text-dark">Lama
                                                        Usaha</label>
                                                    <input type="text" class="form-control" id="lama_usaha"
                                                        name="lama_usaha" placeholder="Masukkan lama usaha"
                                                        value="{{ old('lama_usaha', $nasabah_pekerjaan->lama_usaha) }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="total_lama_usaha"
                                                        class="form-label fw-bold text-dark">Total Lama Usaha</label>
                                                    <input type="text" class="form-control" id="total_lama_usaha"
                                                        name="total_lama_usaha" placeholder="Masukkan total lama usaha"
                                                        value="{{ old('total_lama_usaha', $nasabah_pekerjaan->total_lama_usaha) }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="jumlah_karyawan_usaha"
                                                        class="form-label fw-bold text-dark">Jumlah Karyawan Usaha</label>
                                                    <input type="number" class="form-control" id="jumlah_karyawan_usaha"
                                                        name="jumlah_karyawan_usaha"
                                                        placeholder="Masukkan jumlah karyawan"
                                                        value="{{ old('jumlah_karyawan_usaha', $nasabah_pekerjaan->jumlah_karyawan_usaha) }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="keterangan_tambahan_usaha"
                                                        class="form-label fw-bold text-dark">Keterangan Tambahan
                                                        Usaha</label>
                                                    <textarea class="form-control" id="keterangan_tambahan_usaha" name="keterangan_tambahan_usaha" rows="2"
                                                        placeholder="Masukkan keterangan tambahan">{{ old('keterangan_tambahan_usaha', $nasabah_pekerjaan->keterangan_tambahan_usaha) }}</textarea>
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="usaha_pensiun_usaha"
                                                        class="form-label fw-bold text-dark">Usaha Pensiun</label>
                                                    <input type="text" class="form-control" id="usaha_pensiun_usaha"
                                                        name="usaha_pensiun_usaha" placeholder="Masukkan usaha pensiun"
                                                        value="{{ old('usaha_pensiun_usaha', $nasabah_pekerjaan->usaha_pensiun_usaha) }}">
                                                </div>

                                                <!-- Supplier 1 -->
                                                <div class="col-md-6 mt-2">
                                                    <label for="nama_suppliersatu_usaha"
                                                        class="form-label fw-bold text-dark">Nama Supplier 1</label>
                                                    <input type="text" class="form-control"
                                                        id="nama_suppliersatu_usaha" name="nama_suppliersatu_usaha"
                                                        placeholder="Masukkan nama supplier 1"
                                                        value="{{ old('nama_suppliersatu_usaha', $nasabah_pekerjaan->nama_suppliersatu_usaha) }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="alamat_suppliersatu_usaha"
                                                        class="form-label fw-bold text-dark">Alamat Supplier 1</label>
                                                    <input type="text" class="form-control"
                                                        id="alamat_suppliersatu_usaha" name="alamat_suppliersatu_usaha"
                                                        placeholder="Masukkan alamat supplier 1"
                                                        value="{{ old('alamat_suppliersatu_usaha', $nasabah_pekerjaan->alamat_suppliersatu_usaha) }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="notelp_suppliersatu_usaha"
                                                        class="form-label fw-bold text-dark">No. Telp Supplier 1</label>
                                                    <input type="text" class="form-control"
                                                        id="notelp_suppliersatu_usaha" name="notelp_suppliersatu_usaha"
                                                        placeholder="Masukkan nomor telepon supplier 1"
                                                        value="{{ old('notelp_suppliersatu_usaha', $nasabah_pekerjaan->notelp_suppliersatu_usaha) }}">
                                                </div>

                                                <!-- Supplier 2 -->
                                                <div class="col-md-6 mt-2">
                                                    <label for="nama_supplierdua_usaha"
                                                        class="form-label fw-bold text-dark">Nama Supplier 2</label>
                                                    <input type="text" class="form-control"
                                                        id="nama_supplierdua_usaha" name="nama_supplierdua_usaha"
                                                        placeholder="Masukkan nama supplier 2"
                                                        value="{{ old('nama_supplierdua_usaha', $nasabah_pekerjaan->nama_supplierdua_usaha) }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="alamat_supplierdua_usaha"
                                                        class="form-label fw-bold text-dark">Alamat Supplier 2</label>
                                                    <input type="text" class="form-control"
                                                        id="alamat_supplierdua_usaha" name="alamat_supplierdua_usaha"
                                                        placeholder="Masukkan alamat supplier 2"
                                                        value="{{ old('alamat_supplierdua_usaha', $nasabah_pekerjaan->alamat_supplierdua_usaha) }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="notelp_supplierdua_usaha"
                                                        class="form-label fw-bold text-dark">No. Telp Supplier 2</label>
                                                    <input type="text" class="form-control"
                                                        id="notelp_supplierdua_usaha" name="notelp_supplierdua_usaha"
                                                        placeholder="Masukkan nomor telepon supplier 2"
                                                        value="{{ old('notelp_supplierdua_usaha', $nasabah_pekerjaan->notelp_supplierdua_usaha) }}">
                                                </div>

                                                <!-- Supplier 3 -->
                                                <div class="col-md-6 mt-2">
                                                    <label for="nama_suppliertiga_usaha"
                                                        class="form-label fw-bold text-dark">Nama Supplier 3</label>
                                                    <input type="text" class="form-control"
                                                        id="nama_suppliertiga_usaha" name="nama_suppliertiga_usaha"
                                                        placeholder="Masukkan nama supplier 3"
                                                        value="{{ old('nama_suppliertiga_usaha', $nasabah_pekerjaan->nama_suppliertiga_usaha) }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="alamat_suppliertiga_usaha"
                                                        class="form-label fw-bold text-dark">Alamat Supplier 3</label>
                                                    <input type="text" class="form-control"
                                                        id="alamat_suppliertiga_usaha" name="alamat_suppliertiga_usaha"
                                                        placeholder="Masukkan alamat supplier 3"
                                                        value="{{ old('alamat_suppliertiga_usaha', $nasabah_pekerjaan->alamat_suppliertiga_usaha) }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="notelp_suppliertiga_usaha"
                                                        class="form-label fw-bold text-dark">No. Telp Supplier 3</label>
                                                    <input type="text" class="form-control"
                                                        id="notelp_suppliertiga_usaha" name="notelp_suppliertiga_usaha"
                                                        placeholder="Masukkan nomor telepon supplier 3"
                                                        value="{{ old('notelp_suppliertiga_usaha', $nasabah_pekerjaan->notelp_suppliertiga_usaha) }}">
                                                </div>

                                            </div>

                                            <div class="d-flex gap-2 justify-content-start" id="nav-tab"
                                                role="tablist">

                                                <button type="submit" class="btn btn-warning">
                                                    <i class="fas fa-save me-2"></i> Simpan Perubahan
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
