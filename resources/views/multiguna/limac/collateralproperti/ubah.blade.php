@extends('layouts.app')

@section('content')
    <!-- [ Main Content ] -->
    <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="card card-social">
                    <div class="card-block border-bottom p-3">
                        <div class="row mb-2">
                            <div class="col-12">
                                <form
                                    action="{{ route('multiguna.limac.collateralproperti.update', $pengajuan->kode_pengajuan) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')

                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-1-tab" data-toggle="tab"
                                                data-target="#nav-1" type="button" role="tab" aria-controls="nav-1"
                                                aria-selected="true">Legalitas Obyek / Agunan Pembiayaan</button>
                                            <button class="nav-link" id="nav-2-tab" data-toggle="tab" data-target="#nav-2"
                                                type="button" role="tab" aria-controls="nav-2"
                                                aria-selected="true">Keterangan Kondisi Agunan</button>
                                            <button class="nav-link" id="nav-3-tab" data-toggle="tab" data-target="#nav-3"
                                                type="button" role="tab" aria-controls="nav-3"
                                                aria-selected="true">Bangunan di atas Agunan</button>
                                            <button class="nav-link" id="nav-4-tab" data-toggle="tab" data-target="#nav-4"
                                                type="button" role="tab" aria-controls="nav-4"
                                                aria-selected="true">Marketabilitas Agunan</button>
                                        </div>

                                    </nav>

                                    <div class="tab-content p-3" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-1" role="tabpanel"
                                            aria-labelledby="nav-1-tab">
                                            <h6 class="border-bottom pb-2">Legalitas Obyek / Agunan Pembiayaan</h6>
                                            <div class="row g-3 mb-3">
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-info"
                                                        for="jenis_sertifikat_hak">Jenis Sertifikat Hak</label>
                                                    <select class="form-control" id="jenis_sertifikat_hak"
                                                        name="jenis_sertifikat_hak">
                                                        @php
                                                            $jenisSertifikatOptions = [
                                                                '--',
                                                                'Sertifikat Hak Milik (10)',
                                                                'Sertifikat hak Guna Bangunan Split (8)',
                                                                'Sertifikat Hak guna Bangunan Induk (5)',
                                                            ];
                                                            $selected = old(
                                                                'jenis_sertifikat_hak',
                                                                $pengajuan->jenis_sertifikat_hak ?? '',
                                                            );
                                                        @endphp

                                                        @foreach ($jenisSertifikatOptions as $option)
                                                            <option value="{{ $option }}"
                                                                {{ $selected == $option ? 'selected' : '' }}>
                                                                {{ $option }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark" for="nomor_sertifikat">Nomor
                                                        Sertifikat</label>
                                                    <input type="text" class="form-control" id="nomor_sertifikat"
                                                        name="nomor_sertifikat"
                                                        value="{{ old('nomor_sertifikat', $pengajuan->nomor_sertifikat ?? '') }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="tanggal_penerbitan">Tanggal Penerbitan</label>
                                                    <input type="date" class="form-control" id="tanggal_penerbitan"
                                                        name="tanggal_penerbitan"
                                                        value="{{ old('tanggal_penerbitan', $pengajuan->tanggal_penerbitan ? \Carbon\Carbon::parse($pengajuan->tanggal_penerbitan)->format('Y-m-d') : '') }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="instansi_yang_menerbitkan">Instansi yang
                                                        Menerbitkan</label>
                                                    <input type="text" class="form-control"
                                                        id="instansi_yang_menerbitkan" name="instansi_yang_menerbitkan"
                                                        value="{{ old('instansi_yang_menerbitkan', $pengajuan->instansi_yang_menerbitkan ?? '') }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark" for="nama_pemegang_hak">Nama
                                                        Pemegang Hak</label>
                                                    <input type="text" class="form-control" id="nama_pemegang_hak"
                                                        name="nama_pemegang_hak"
                                                        value="{{ old('nama_pemegang_hak', $pengajuan->nama_pemegang_hak ?? '') }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="lama_tgl_akhir_hak_berlaku">Lama & Tgl Akhir Hak
                                                        Berlaku</label>
                                                    <input type="text" class="form-control"
                                                        id="lama_tgl_akhir_hak_berlaku" name="lama_tgl_akhir_hak_berlaku"
                                                        value="{{ old('lama_tgl_akhir_hak_berlaku', $pengajuan->lama_tgl_akhir_hak_berlaku ?? '') }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="surat_ukur_nomor">Surat Ukur Nomor</label>
                                                    <input type="text" class="form-control" id="surat_ukur_nomor"
                                                        name="surat_ukur_nomor"
                                                        value="{{ old('surat_ukur_nomor', $pengajuan->surat_ukur_nomor ?? '') }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark" for="tanggal_ukur">Tanggal
                                                        Ukur</label>
                                                    <input type="date" class="form-control" id="tanggal_ukur"
                                                        name="tanggal_ukur"
                                                        value="{{ old('tanggal_ukur', $pengajuan->tanggal_ukur ? \Carbon\Carbon::parse($pengajuan->tanggal_ukur)->format('Y-m-d') : '') }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark" for="asal_agunan">Asal
                                                        Agunan</label>
                                                    <input type="text" class="form-control" id="asal_agunan"
                                                        name="asal_agunan"
                                                        value="{{ old('asal_agunan', $pengajuan->asal_agunan ?? '') }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark" for="luas_agunan">Luas
                                                        Agunan</label>
                                                    <input type="text" class="form-control" id="luas_agunan"
                                                        name="luas_agunan"
                                                        value="{{ old('luas_agunan', $pengajuan->luas_agunan ?? '') }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark" for="letak_agunan">Letak
                                                        Agunan</label>
                                                    <input type="text" class="form-control" id="letak_agunan"
                                                        name="letak_agunan"
                                                        value="{{ old('letak_agunan', $pengajuan->letak_agunan ?? '') }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="batas_utara_agunan">Batas Utara Agunan</label>
                                                    <input type="text" class="form-control" id="batas_utara_agunan"
                                                        name="batas_utara_agunan"
                                                        value="{{ old('batas_utara_agunan', $pengajuan->batas_utara_agunan ?? '') }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="batas_timur_agunan">Batas Timur Agunan</label>
                                                    <input type="text" class="form-control" id="batas_timur_agunan"
                                                        name="batas_timur_agunan"
                                                        value="{{ old('batas_timur_agunan', $pengajuan->batas_timur_agunan ?? '') }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="batas_selatan_agunan">Batas Selatan Agunan</label>
                                                    <input type="text" class="form-control" id="batas_selatan_agunan"
                                                        name="batas_selatan_agunan"
                                                        value="{{ old('batas_selatan_agunan', $pengajuan->batas_selatan_agunan ?? '') }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="batas_barat_agunan">Batas Barat Agunan</label>
                                                    <input type="text" class="form-control" id="batas_barat_agunan"
                                                        name="batas_barat_agunan"
                                                        value="{{ old('batas_barat_agunan', $pengajuan->batas_barat_agunan ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="d-flex gap-2 justify-content-start mt-3" id="nav-tab"
                                                role="tablist">
                                                <a href="{{ route('multiguna.limac.collateralproperti.data') }}"
                                                    class="btn btn-secondary">
                                                    ← Kembali
                                                </a>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-2" role="tabpanel"
                                            aria-labelledby="nav-2-tab">
                                            <h6 class="border-bottom pb-2">Keterangan Kondisi Agunan</h6>

                                            <div class="row g-3 mb-3">

                                                <div class="col-md-6 mt-2">
                                                    <label>Aksesibilitas Lokasi Agunan</label>
                                                    @php
                                                        $opsiAksesibilitas = ['mudah', 'cukup', 'sulit'];
                                                    @endphp
                                                    <select name="aksesibilitas_lokasi_agunan" class="form-control">
                                                        <option value="">--</option>
                                                        @foreach ($opsiAksesibilitas as $opsi)
                                                            <option value="{{ $opsi }}"
                                                                {{ old('aksesibilitas_lokasi_agunan', $pengajuan->aksesibilitas_lokasi_agunan) == $opsi ? 'selected' : '' }}>
                                                                {{ ucfirst($opsi) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label>Keterangan Mengenai Keadaan Lingkungan Agunan (tanah)</label>
                                                    @php
                                                        $opsiLingkunganTanah = [
                                                            'darat',
                                                            'sawah',
                                                            'rawa-rawa',
                                                            'pesisir pantai',
                                                        ];
                                                    @endphp
                                                    <select name="keterangan_lingkungan_agunan_tanah"
                                                        class="form-control">
                                                        <option value="">--</option>
                                                        @foreach ($opsiLingkunganTanah as $opsi)
                                                            <option value="{{ $opsi }}"
                                                                {{ old('keterangan_lingkungan_agunan_tanah', $pengajuan->keterangan_lingkungan_agunan_tanah) == $opsi ? 'selected' : '' }}>
                                                                {{ ucfirst($opsi) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label>Keterangan Mengenai Keadaan Lingkungan Agunan (Terletak di
                                                        Kawasan)</label>
                                                    @php
                                                        $opsiLingkunganKawasan = ['pemukiman', 'niaga', 'pertanian'];
                                                    @endphp
                                                    <select name="keterangan_lingkungan_agunan_kawasan"
                                                        class="form-control">
                                                        <option value="">--</option>
                                                        @foreach ($opsiLingkunganKawasan as $opsi)
                                                            <option value="{{ $opsi }}"
                                                                {{ old('keterangan_lingkungan_agunan_kawasan', $pengajuan->keterangan_lingkungan_agunan_kawasan) == $opsi ? 'selected' : '' }}>
                                                                {{ ucfirst($opsi) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label>Penggunaan Agunan Saat Ini</label>
                                                    @php
                                                        $opsiPenggunaanAgunan = [
                                                            'rumah tempat tinggal',
                                                            'Kosong',
                                                            'Disewakan',
                                                        ];
                                                    @endphp
                                                    <select name="penggunaan_agunan_saat_ini" class="form-control">
                                                        <option value="">--</option>
                                                        @foreach ($opsiPenggunaanAgunan as $opsi)
                                                            <option value="{{ $opsi }}"
                                                                {{ old('penggunaan_agunan_saat_ini', $pengajuan->penggunaan_agunan_saat_ini) == $opsi ? 'selected' : '' }}>
                                                                {{ ucfirst($opsi) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label>Harga Sewanya per Tahun <span
                                                            class="text-warning font-italic">(jika
                                                            disewakan)</span></label>
                                                    <input type="number" name="harga_sewa_per_tahun"
                                                        class="form-control"
                                                        value="{{ old('harga_sewa_per_tahun', $pengajuan->harga_sewa_per_tahun) }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label>Apakah Agunan Mempunyai Jalan Keluar ke Jalan Besar</label>
                                                    @php
                                                        $opsiAksesJalan = [
                                                            'di tepi jalan besar, akses keluar masuk mudah dan jalan cukup lebar',
                                                            'cukup dekat',
                                                            'jauh',
                                                        ];
                                                    @endphp
                                                    <select name="agunan_punya_akses_jalan_besar" class="form-control">
                                                        <option value="">--</option>
                                                        @foreach ($opsiAksesJalan as $opsi)
                                                            <option value="{{ $opsi }}"
                                                                {{ old('agunan_punya_akses_jalan_besar', $pengajuan->agunan_punya_akses_jalan_besar) == $opsi ? 'selected' : '' }}>
                                                                {{ ucfirst($opsi) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label>Apakah Agunan Termasuk Aktiva Warisan yang Belum Dibagi</label>
                                                    @php
                                                        $opsiWarisan = ['Tidak', 'Ya'];
                                                    @endphp
                                                    <select name="agunan_aktiva_warisan_belum_dibagi"
                                                        class="form-control">
                                                        <option value="">--</option>
                                                        @foreach ($opsiWarisan as $opsi)
                                                            <option value="{{ $opsi }}"
                                                                {{ old('agunan_aktiva_warisan_belum_dibagi', $pengajuan->agunan_aktiva_warisan_belum_dibagi) == $opsi ? 'selected' : '' }}>
                                                                {{ $opsi }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-3" role="tabpanel"
                                            aria-labelledby="nav-3-tab">
                                            <h6 class="border-bottom pb-2">Bangunan di atas Agunan</h6>

                                            <div class="row g-3 mb-3">
                                                <div class="col-md-6 mt-2">
                                                    <label>IMB (Izin Mendirikan Bangunan)</label>
                                                    <input type="text" name="memiliki_imb" class="form-control"
                                                        value="{{ old('memiliki_imb', $pengajuan->memiliki_imb) }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label>Tahun Pembuatan Bangunan</label>
                                                    <input type="text" name="tahun_pembuatan_bangunan"
                                                        class="form-control"
                                                        value="{{ old('tahun_pembuatan_bangunan', $pengajuan->tahun_pembuatan_bangunan) }}">
                                                </div>

                                                <div class="col-md-6 mt-2 d-none">
                                                    <label>Perkiraan Biaya Pembangunan pada Tahun Tersebut (Rp.)</label>
                                                    <input type="number" name="perkiraan_biaya_pembangunan"
                                                        class="form-control"
                                                        value="{{ old('perkiraan_biaya_pembangunan', $pengajuan->perkiraan_biaya_pembangunan) }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label>Keterangan Konstruksi Bangunan</label>
                                                    @php
                                                        $opsiKonstruksiBangunan = [
                                                            'Ada Bangunan',
                                                            'Tidak ada bangunan',
                                                        ];
                                                    @endphp
                                                    <select name="keterangan_konstruksi_bangunan" class="form-control">
                                                        <option value="">--</option>
                                                        @foreach ($opsiKonstruksiBangunan as $opsi)
                                                            <option value="{{ $opsi }}"
                                                                {{ old('keterangan_konstruksi_bangunan', $pengajuan->keterangan_konstruksi_bangunan) == $opsi ? 'selected' : '' }}>
                                                                {{ $opsi }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>


                                                @php
                                                    $fields = [
                                                        'luas_efektif',
                                                        'jumlah_lantai',
                                                        // 'pondasi',
                                                        // 'lantai',
                                                        // 'konstruksi',
                                                        // 'dinding',
                                                        // 'dinding_pemisah',
                                                        // 'kusen',
                                                        // 'pintu',
                                                        // 'jendela_ventilasi',
                                                        // 'plafond',
                                                        // 'konstruksi_atap',
                                                        // 'penutup_atap',
                                                        // 'instalasi_air',
                                                        // 'instalasi_listrik',
                                                    ];
                                                    $labels = [
                                                        'Luas Efektif (m²)',
                                                        'Jumlah Lantai',
                                                        // 'Pondasi',
                                                        // 'Lantai',
                                                        // 'Konstruksi',
                                                        // 'Dinding',
                                                        // 'Dinding Pemisah',
                                                        // 'Kusen',
                                                        // 'Pintu',
                                                        // 'Jendela/Ventilasi',
                                                        // 'Plafond',
                                                        // 'Konstruksi Atap',
                                                        // 'Penutup Atap',
                                                        // 'Instalasi Air',
                                                        // 'Instalasi Listrik',
                                                    ];
                                                @endphp

                                                @foreach ($fields as $index => $field)
                                                    <div class="col-md-3 mt-2">
                                                        <label>{{ $labels[$index] }}</label>
                                                        <input type="text" name="{{ $field }}"
                                                            class="form-control"
                                                            value="{{ old($field, $pengajuan->$field) }}">
                                                    </div>
                                                @endforeach

                                                <div class="col-md-3 mt-2 d-none">
                                                    <label>Perawatan</label>
                                                    @php
                                                        $opsiPerawatan = ['Baik', 'Cukup', 'Kurang'];
                                                    @endphp
                                                    <select name="perawatan" class="form-control">
                                                        <option value="">--</option>
                                                        @foreach ($opsiPerawatan as $opsi)
                                                            <option value="{{ $opsi }}"
                                                                {{ old('perawatan', $pengajuan->perawatan) == $opsi ? 'selected' : '' }}>
                                                                {{ $opsi }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-6 mt-2 d-none">
                                                    <label>Kondisi Sarana dan Emplasemen</label>
                                                    @php
                                                        $opsiKondisi = ['Baik', 'Cukup', 'Kurang'];
                                                    @endphp
                                                    <select name="kondisi_sarana_dan_emplasemen" class="form-control">
                                                        <option value="">--</option>
                                                        @foreach ($opsiKondisi as $opsi)
                                                            <option value="{{ $opsi }}"
                                                                {{ old('kondisi_sarana_dan_emplasemen', $pengajuan->kondisi_sarana_dan_emplasemen) == $opsi ? 'selected' : '' }}>
                                                                {{ $opsi }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-6 mt-2 d-none">
                                                    <label>Informasi Lain tentang Kondisi Bangunan di Atas Agunan</label>
                                                    <textarea name="informasi_lain_kondisi_bangunan" class="form-control" maxlength="50" rows="2">{{ old('informasi_lain_kondisi_bangunan', $pengajuan->informasi_lain_kondisi_bangunan) }}</textarea>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="tab-pane fade" id="nav-4" role="tabpanel"
                                            aria-labelledby="nav-4-tab">
                                            <h6 class="border-bottom pb-2">Marketabilitas Agunan</h6>

                                            <div class="row g-3 mb-3">
                                                @php
                                                    $options = [
                                                        'lokasi_perumahan' => [
                                                            '--',
                                                            'Dalam kota(3)',
                                                            'Dekat kota(2)',
                                                            'Jauh dari kota(1)',
                                                        ],
                                                        'kenyamanan' => [
                                                            '--',
                                                            'Cukup Jauh dari tempat maksiat, 2-10km (3)',
                                                            'Dekat dari tempat maksiat, <2km (2)',
                                                            'Jaun dari tempat maksiat, >10km (1)',
                                                        ],
                                                        'lokasi_agunan' => [
                                                            '--',
                                                            'Di Hook dan atau depan taman(3)',
                                                            'Tidak di Hook dan atau tidak depan taman(2)',
                                                            'Tusuk sate(1)',
                                                        ],
                                                        'jarak_fasum_fasos' => [
                                                            '--',
                                                            '>2km(5)',
                                                            '>10km(4)',
                                                            '2-5km(3)',
                                                            '5-7km(2)',
                                                            '7-10km(1)',
                                                        ],
                                                        'fasilitas_perumahan' => [
                                                            '--',
                                                            'Lengkap - Pasar, Sekolah, RS, Tempat Ibadah(3)',
                                                            'Minimal - Pasar, Sekolah, Klinik dan Tempat Ibadah(2)',
                                                            'Rata-rata - Pasar, Sekolah, Puskesmas dan Tempat Ibadah(1)',
                                                        ],
                                                        'jenis_jalan_lingkungan' => [
                                                            '--',
                                                            'Aspal / conblok(3)',
                                                            'Makadam / Pengerasan(2)',
                                                            'Tanah(1)',
                                                        ],
                                                        'jarak_ke_jalan_provinsi' => [
                                                            '--',
                                                            '>2km(5)',
                                                            '>10km(4)',
                                                            '2-5km(3)',
                                                            '5-7km(2)',
                                                            '7-10km(1)',
                                                        ],
                                                        'jenis_dan_kondisi_jalan' => [
                                                            '--',
                                                            'Aspal - Relatif macet (3)',
                                                            'Aspal - Sering macet(2)',
                                                            'Aspal - Tidak macet(4)',
                                                            'Selain aspal(1)',
                                                        ],
                                                        'kondisi_jalan_ke_kota' => [
                                                            '--',
                                                            'Relatif macet(2)',
                                                            'Sering macet(1)',
                                                            'Tidak macet(3)',
                                                        ],
                                                        'resiko_bencana_hidup' => [
                                                            '--',
                                                            'Kadang-kadang(2)',
                                                            'Sering(1)',
                                                            'Tidak ada(3)',
                                                        ],
                                                        'kontribusi_pemohon_dp' => [
                                                            '--',
                                                            'Antara 10 -20% dari nilai asset(2)',
                                                            'Antara 20 -30% dari nilai asset(3)',
                                                            'Lebih dari 30% dari nilai asset(4)',
                                                            'Seluruh pembiayaan dari bank(1)',
                                                        ],
                                                        'pertumbuhan_agunan' => [
                                                            '--',
                                                            'Cukup tinggi, antara 50% - 100% (4)',
                                                            'Penurunan Nilai(1)',
                                                            'Rata-rata, antara 10% - 50%(3)',
                                                            'Sangat tinggi, diatas 100%(5)',
                                                            'Tidak ada pertumbuhan(2)',
                                                        ],

                                                        'kondisi_wilayah_agunan' => [
                                                            '--',
                                                            'Akan berkembang dalam jangka panjang(3)',
                                                            'Akan berkembang dalam jangka pendek(4)',
                                                            'Mapan(6)',
                                                            'Sedang berkembang(5)',
                                                            'Terpencil(2)',
                                                            'Tidak berkembang(1)',
                                                        ],
                                                    ];
                                                @endphp

                                                @foreach ($options as $field => $list)
                                                    <div class="col-md-6 mt-2">
                                                        <label class="form-label fw-bold text-info"
                                                            for="{{ $field }}">
                                                            {{ ucwords(str_replace('_', ' ', $field)) }}
                                                        </label>
                                                        <select class="form-control" id="{{ $field }}"
                                                            name="{{ $field }}">
                                                            @php
                                                                $selected = old(
                                                                    $field,
                                                                    $pengajuan->$field ??
                                                                        ($multiguna_limac_collateralproperti->$field ??
                                                                            ''),
                                                                );
                                                            @endphp
                                                            @foreach ($list as $option)
                                                                <option value="{{ $option }}"
                                                                    {{ $selected == $option ? 'selected' : '' }}>
                                                                    {{ $option }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                @endforeach
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
    <!-- [ Main Content ] -->
@endsection
