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
                                <form action="{{ route('nasabah.profil.store') }}" method="POST">
                                    @csrf
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-1-tab" data-toggle="tab"
                                                data-target="#nav-1" type="button" role="tab" aria-controls="nav-1"
                                                aria-selected="true">1. Identitas Nasabah</button>
                                            <button class="nav-link" id="nav-2-tab" data-toggle="tab" data-target="#nav-2"
                                                type="button" role="tab" aria-controls="nav-2" aria-selected="false">2.
                                                Identitas Pasangan</button>
                                            <button class="nav-link" id="nav-3-tab" data-toggle="tab" data-target="#nav-3"
                                                type="button" role="tab" aria-controls="nav-3" aria-selected="false">3.
                                                Hubungan Bank Syariah</button>
                                        </div>
                                    </nav>
                                    <div class="tab-content p-3" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-1" role="tabpanel"
                                            aria-labelledby="nav-1-tab">
                                            <h6 class="border-bottom pb-2">1. Identitas Nasabah</h6>
                                            <div class="row g-3 mb-3">
                                                <!-- Nama Nasabah -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark" for="nama_nasabah">Nama
                                                        Lengkap <span style="color: red">*</span></label>
                                                    <input type="text" class="form-control" id="nama_nasabah"
                                                        name="nama_nasabah" placeholder="Masukkan nama lengkap" required>
                                                </div>

                                                <!-- Tempat, Tanggal Lahir -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="ttl_lahir_nasabah">Tempat, Tanggal Lahir</label>
                                                    <input type="text" class="form-control" id="ttl_lahir_nasabah"
                                                        name="ttl_lahir_nasabah" placeholder="Contoh: Sidoarjo, 02-06-2000">
                                                </div>

                                                <!-- Alamat KTP -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="alamat_ktp_nasabah">Alamat (KTP)</label>
                                                    <input type="text" class="form-control" id="alamat_ktp_nasabah"
                                                        name="alamat_ktp_nasabah" placeholder="Masukkan alamat sesuai KTP">
                                                </div>

                                                <!-- Kota KTP -->
                                                <div class="col-md-3 mt-2">
                                                    <label class="form-label fw-bold text-dark" for="kota_ktp_nasabah">Kota
                                                        (KTP)</label>
                                                    <input type="text" class="form-control" id="kota_ktp_nasabah"
                                                        name="kota_ktp_nasabah" placeholder="Masukkan kota">
                                                </div>

                                                <!-- Kode Pos KTP -->
                                                <div class="col-md-3 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="kodepos_ktp_nasabah">Kode POS (KTP)</label>
                                                    <input type="text" class="form-control" id="kodepos_ktp_nasabah"
                                                        name="kodepos_ktp_nasabah" placeholder="Contoh: 61253">
                                                </div>

                                                <!-- Alamat Sekarang -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="alamat_sekarang_nasabah">Alamat (Sekarang)</label>
                                                    <input type="text" class="form-control" id="alamat_sekarang_nasabah"
                                                        name="alamat_sekarang_nasabah"
                                                        placeholder="Masukkan alamat tinggal sekarang">
                                                </div>

                                                <!-- Kota Sekarang -->
                                                <div class="col-md-3 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="kota_sekarang_nasabah">Kota (Sekarang)</label>
                                                    <input type="text" class="form-control" id="kota_sekarang_nasabah"
                                                        name="kota_sekarang_nasabah" placeholder="Masukkan kota">
                                                </div>

                                                <!-- Kode Pos Sekarang -->
                                                <div class="col-md-3 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="kodepos_sekarang_nasabah">Kode POS (Sekarang)</label>
                                                    <input type="text" class="form-control"
                                                        id="kodepos_sekarang_nasabah" name="kodepos_sekarang_nasabah"
                                                        placeholder="Contoh: 61253">
                                                </div>

                                                <!-- No KTP -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark" for="no_ktp_nasabah">No.
                                                        KTP</label>
                                                    <input type="text" class="form-control" id="no_ktp_nasabah"
                                                        name="no_ktp_nasabah" placeholder="Masukkan nomor KTP">
                                                </div>

                                                <!-- Berlaku KTP -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="berlaku_ktp_nasabah">Berlaku Sampai</label>
                                                    <input type="date" class="form-control" id="berlaku_ktp_nasabah"
                                                        name="berlaku_ktp_nasabah">
                                                </div>

                                                <!-- NPWP -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark" for="no_npwp_nasabah">No.
                                                        NPWP</label>
                                                    <input type="text" class="form-control" id="no_npwp_nasabah"
                                                        name="no_npwp_nasabah" placeholder="Masukkan nomor NPWP">
                                                </div>

                                                <!-- Kepemilikan Rumah -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark d-block">Kepemilikan
                                                        Rumah</label>

                                                    @foreach ([
            'sendiri' => 'Sendiri',
            'sewa/kontrak' => 'Sewa/Kontrak',
            'kredit' => 'Kredit',
            'orang tua' => 'Orang Tua',
            'instansi' => 'Instansi',
            'lainnya' => 'Lainnya',
        ] as $value => $label)
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="kepemilikan_rumah_nasabah"
                                                                id="rumah{{ strtoupper(preg_replace('/[^A-Za-z0-9]/', '', $value)) }}"
                                                                value="{{ $value }}">
                                                            <label class="form-check-label"
                                                                for="rumah{{ strtoupper(preg_replace('/[^A-Za-z0-9]/', '', $value)) }}">
                                                                {{ $label }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <!-- Lama Menetap -->
                                                <div class="col-md-3 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="lamamenetap_tahun_nasabah">Lama Menetap (Tahun)</label>
                                                    <input type="number" class="form-control"
                                                        id="lamamenetap_tahun_nasabah" name="lamamenetap_tahun_nasabah"
                                                        min="0" placeholder="Contoh: 2">
                                                </div>
                                                <div class="col-md-3 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="lamamenetap_bulan_nasabah">Lama Menetap (Bulan)</label>
                                                    <input type="number" class="form-control"
                                                        id="lamamenetap_bulan_nasabah" name="lamamenetap_bulan_nasabah"
                                                        min="0" max="11" placeholder="Contoh: 6">
                                                </div>

                                                <!-- No Telp Rumah -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="notelp_rumah_nasabah">No. Telp Rumah</label>
                                                    <input type="text" class="form-control" id="notelp_rumah_nasabah"
                                                        name="notelp_rumah_nasabah" placeholder="Contoh: 031-xxxxxxx">
                                                </div>

                                                <!-- No HP -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="notelp_hp_nasabah">No. HP</label>
                                                    <input type="text" class="form-control" id="notelp_hp_nasabah"
                                                        name="notelp_hp_nasabah" placeholder="Contoh: 0812xxxxxxx">
                                                </div>

                                                <!-- Email -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="email_nasabah">Email</label>
                                                    <input type="email" class="form-control" id="email_nasabah"
                                                        name="email_nasabah" placeholder="Contoh: email@example.com">
                                                </div>

                                                <!-- Jenis Kelamin -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark d-block">Jenis
                                                        Kelamin</label>

                                                    @foreach (['laki-laki' => 'Laki-Laki', 'perempuan' => 'Perempuan'] as $value => $label)
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="jenis_kelamin_nasabah"
                                                                id="jenisKelamin{{ strtoupper(str_replace('-', '', $value)) }}"
                                                                value="{{ $value }}">
                                                            <label class="form-check-label"
                                                                for="jenisKelamin{{ strtoupper(str_replace('-', '', $value)) }}">
                                                                {{ $label }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <!-- Status Kawin -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark d-block">Status
                                                        Perkawinan</label>

                                                    @foreach ([
            'menikah' => 'Menikah',
            'belum menikah' => 'Belum Menikah',
            'duda/janda' => 'Duda/Janda',
        ] as $value => $label)
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="status_kawin_nasabah"
                                                                id="statusKawin{{ strtoupper(preg_replace('/[^A-Za-z0-9]/', '', $value)) }}"
                                                                value="{{ $value }}">
                                                            <label class="form-check-label"
                                                                for="statusKawin{{ strtoupper(preg_replace('/[^A-Za-z0-9]/', '', $value)) }}">
                                                                {{ $label }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <!-- Nama Ibu -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="nama_ibu_nasabah">Nama Ibu Kandung</label>
                                                    <input type="text" class="form-control" id="nama_ibu_nasabah"
                                                        name="nama_ibu_nasabah" placeholder="Masukkan nama ibu kandung">
                                                </div>

                                                <!-- Nama Organisasi -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="nama_organisasi_nasabah">Nama Organisasi</label>
                                                    <input type="text" class="form-control"
                                                        id="nama_organisasi_nasabah" name="nama_organisasi_nasabah"
                                                        placeholder="Masukkan nama organisasi">
                                                </div>

                                                <!-- Jabatan di Organisasi -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="jabatan_organisasi_nasabah">Jabatan di Organisasi</label>
                                                    <input type="text" class="form-control"
                                                        id="jabatan_organisasi_nasabah" name="jabatan_organisasi_nasabah"
                                                        placeholder="Contoh: Ketua, Anggota">
                                                </div>

                                                <!-- Lama Ikut Organisasi -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="lama_organisasi_nasabah">Lama Ikut Organisasi</label>
                                                    <input type="text" class="form-control"
                                                        id="lama_organisasi_nasabah" name="lama_organisasi_nasabah"
                                                        placeholder="Contoh: 2 tahun">
                                                </div>
                                            </div>

                                            <h6 class="my-2">* Untuk keperluan mendadak (keluarga dekat
                                                yang
                                                tidak serumah)</h6>
                                            <div class="row g-3 mb-3">
                                                <!-- Nama Keluarga Nasabah -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="nama_keluarga_nasabah">Nama Keluarga Nasabah</label>
                                                    <input type="text" class="form-control" id="nama_keluarga_nasabah"
                                                        name="nama_keluarga_nasabah" placeholder="Masukkan nama lengkap">
                                                </div>

                                                <!-- Hubungan Keluarga Nasabah -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark d-block">Hubungan Keluarga
                                                        Nasabah</label>

                                                    @foreach ([
            'orang tua' => 'Orang Tua',
            'kakak/adik' => 'Kakak/Adik',
            'anak' => 'Anak',
            'lainnya' => 'Lainnya',
        ] as $value => $label)
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="hubungan_keluarga_nasabah"
                                                                id="hubungan{{ strtoupper(preg_replace('/[^A-Za-z0-9]/', '', $value)) }}"
                                                                value="{{ $value }}">
                                                            <label class="form-check-label"
                                                                for="hubungan{{ strtoupper(preg_replace('/[^A-Za-z0-9]/', '', $value)) }}">
                                                                {{ $label }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <!-- Alamat Keluarga Nasabah -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="alamat_keluarga_nasabah">Alamat Keluarga Nasabah</label>
                                                    <input type="text" class="form-control"
                                                        id="alamat_keluarga_nasabah" name="alamat_keluarga_nasabah"
                                                        placeholder="Masukkan alamat lengkap">
                                                </div>

                                                <!-- Kota Keluarga Nasabah -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="kota_keluarga_nasabah">Kota</label>
                                                    <input type="text" class="form-control" id="kota_keluarga_nasabah"
                                                        name="kota_keluarga_nasabah"
                                                        placeholder="Masukkan kota tempat tinggal">
                                                </div>

                                                <!-- Kode Pos Keluarga Nasabah -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="kodepos_keluarga_nasabah">Kode Pos</label>
                                                    <input type="text" class="form-control"
                                                        id="kodepos_keluarga_nasabah" name="kodepos_keluarga_nasabah"
                                                        placeholder="Masukkan kode pos">
                                                </div>

                                                <!-- No. Telepon Keluarga Nasabah -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="notelp_keluarga_nasabah">No. Telepon</label>
                                                    <input type="text" class="form-control"
                                                        id="notelp_keluarga_nasabah" name="notelp_keluarga_nasabah"
                                                        placeholder="Masukkan nomor telepon">
                                                </div>

                                                <!-- Pekerjaan Keluarga Nasabah -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="pekerjaan_keluarga_nasabah">Pekerjaan</label>
                                                    <input type="text" class="form-control"
                                                        id="pekerjaan_keluarga_nasabah" name="pekerjaan_keluarga_nasabah"
                                                        placeholder="Masukkan pekerjaan">
                                                </div>

                                                <!-- Alamat Kantor Keluarga Nasabah -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="alamatkantor_keluarga_nasabah">Alamat Kantor</label>
                                                    <input type="text" class="form-control"
                                                        id="alamatkantor_keluarga_nasabah"
                                                        name="alamatkantor_keluarga_nasabah"
                                                        placeholder="Masukkan alamat kantor">
                                                </div>

                                                <!-- No. Telepon Kantor Keluarga Nasabah -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="notelpkantor_keluarga_nasabah">No. Telepon Kantor</label>
                                                    <input type="text" class="form-control"
                                                        id="notelpkantor_keluarga_nasabah"
                                                        name="notelpkantor_keluarga_nasabah"
                                                        placeholder="Masukkan nomor telepon kantor">
                                                </div>
                                            </div>

                                            <div class="d-flex gap-2 justify-content-start" id="nav-tab"
                                                role="tablist">

                                                <a href="{{ route('nasabah.profil.data') }}" class="btn btn-secondary">←
                                                    Kembali</a>
                                            </div>

                                        </div>
                                        <div class="tab-pane fade" id="nav-2" role="tabpanel"
                                            aria-labelledby="nav-2-tab">
                                            <h6 class="border-bottom pb-2">2. Pasangan Nasabah</h6>
                                            <div class="row g-3 mb-3">
                                                <!-- Nama Pasangan -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark" for="nama_pasangan">Nama
                                                        Pasangan</label>
                                                    <input type="text" class="form-control" id="nama_pasangan"
                                                        name="nama_pasangan" placeholder="Masukkan nama pasangan">
                                                </div>

                                                <!-- Tempat, Tanggal Lahir Pasangan -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="ttl_lahir_pasangan">Tempat, Tanggal Lahir</label>
                                                    <input type="text" class="form-control" id="ttl_lahir_pasangan"
                                                        name="ttl_lahir_pasangan"
                                                        placeholder="Contoh: Sidoarjo, 02-06-1995">
                                                </div>

                                                <!-- No KTP Pasangan -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark" for="no_ktp_pasangan">No.
                                                        KTP</label>
                                                    <input type="text" class="form-control" id="no_ktp_pasangan"
                                                        name="no_ktp_pasangan" placeholder="Masukkan nomor KTP">
                                                </div>

                                                <!-- Berlaku KTP Pasangan -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="berlaku_ktp_pasangan">Berlaku Sampai</label>
                                                    <input type="date" class="form-control" id="berlaku_ktp_pasangan"
                                                        name="berlaku_ktp_pasangan">
                                                </div>

                                                <!-- Jumlah Anak -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="jumlah_anak_pasangan">Jumlah Anak</label>
                                                    <input type="number" class="form-control" id="jumlah_anak_pasangan"
                                                        name="jumlah_anak_pasangan" min="0"
                                                        placeholder="Contoh: 2">
                                                </div>

                                                <!-- No. NPWP Pasangan -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark" for="no_npwp_pasangan">No.
                                                        NPWP</label>
                                                    <input type="text" class="form-control" id="no_npwp_pasangan"
                                                        name="no_npwp_pasangan" placeholder="Masukkan nomor NPWP">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="tab-pane fade" id="nav-3" role="tabpanel"
                                            aria-labelledby="nav-3-tab">
                                            <h6 class="border-bottom pb-2">3. Hubungan Nasabah Bank Syariah</h6>
                                            <div class="row g-3 mb-3">

                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-info d-block">Apakah nasabah
                                                        memiliki rekening di bank ini?</label>
                                                    @php
                                                        $punyaOptions = ['Tidak (0)', 'Iya Punya (1)'];
                                                    @endphp

                                                    @foreach ($punyaOptions as $label)
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="punya_rekening_nasabah"
                                                                id="punya{{ strtoupper(preg_replace('/[^a-zA-Z0-9]/', '', $label)) }}"
                                                                value="{{ $label }}">
                                                            <label class="form-check-label"
                                                                for="punya{{ strtoupper(preg_replace('/[^a-zA-Z0-9]/', '', $label)) }}">
                                                                {{ $label }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-info d-block">Tahun Menjadi
                                                        Nasabah</label>
                                                    @php
                                                        $tahunOptions = [
                                                            '<1 Tahun (1)',
                                                            '1-3 Tahun (2)',
                                                            '>3 Tahun (3)',
                                                        ];
                                                    @endphp

                                                    @foreach ($tahunOptions as $label)
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="tahun_menjadi_nasabah"
                                                                id="tahun{{ strtoupper(preg_replace('/[^a-zA-Z0-9]/', '', $label)) }}"
                                                                value="{{ $label }}">
                                                            <label class="form-check-label"
                                                                for="tahun{{ strtoupper(preg_replace('/[^a-zA-Z0-9]/', '', $label)) }}">
                                                                {{ $label }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark d-block">Jenis Layanan
                                                        Nasabah</label>

                                                    @foreach (['Giro', 'Tabungan', 'Deposito', 'Pembiayaan', 'Lainnya'] as $option)
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="jenis_layanan_nasabah"
                                                                id="layanan{{ $option }}"
                                                                value="{{ $option }}">
                                                            <label class="form-check-label"
                                                                for="layanan{{ $option }}">{{ $option }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-info d-block">Mutasi Rekening Di
                                                        Bank UMSIDA Syariah/Performance Sebagai Nasabah Bank UMSIDA
                                                        Syariah</label>
                                                    @php
                                                        $mutasiOptions = [
                                                            'Mutasi Rekening Aktif (2)',
                                                            'Mutasi Rekening Tidak Aktif (1)',
                                                        ];

                                                    @endphp

                                                    @foreach ($mutasiOptions as $label)
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="mutasi_rekening_nasabah"
                                                                id="mutasi{{ strtoupper(preg_replace('/[^a-zA-Z0-9]/', '', $label)) }}"
                                                                value="{{ $label }}">
                                                            <label class="form-check-label"
                                                                for="mutasi{{ strtoupper(preg_replace('/[^a-zA-Z0-9]/', '', $label)) }}">
                                                                {{ $label }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>

                                            </div>
                                            <div class="d-flex gap-2 justify-content-start" id="nav-tab"
                                                role="tablist">

                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-save me-2"></i> Simpan Data Nasabah
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
    </div>
    <!-- [ Main Content ] end -->
@endsection
