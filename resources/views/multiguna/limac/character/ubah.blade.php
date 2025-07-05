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
                                <form action="{{ route('multiguna.limac.character.update', $pengajuan->kode_pengajuan) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="kode_nasabah" value="{{ $pengajuan->kode_nasabah }}">

                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-1-tab" data-toggle="tab"
                                                data-target="#nav-1" type="button" role="tab" aria-controls="nav-1"
                                                aria-selected="true">Profil Nasabah</button>
                                            <button class="nav-link" id="nav-2-tab" data-toggle="tab" data-target="#nav-2"
                                                type="button" role="tab" aria-controls="nav-2"
                                                aria-selected="true">Karakter Nasabah</button>
                                            <button class="nav-link" id="nav-3-tab" data-toggle="tab" data-target="#nav-3"
                                                type="button" role="tab" aria-controls="nav-3"
                                                aria-selected="true">Data Checking Nasabah</button>
                                        </div>
                                    </nav>

                                    <div class="tab-content p-3" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-1" role="tabpanel"
                                            aria-labelledby="nav-1-tab">

                                            <div
                                                class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2">
                                                <h6 class="mb-0">1. Identitas Nasabah</h6>
                                                <a href="{{ route('nasabah.profil.edit', $nasabah_profil->kode_nasabah) }}"
                                                    class="btn btn-sm btn-link text-warning p-1" id="target-shake">
                                                    Ubah data Profil di sini ... <i class="fas fa-edit"></i>
                                                </a>
                                            </div>

                                            <div class="row g-3 mb-3">
                                                <!-- Nama Nasabah -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark" for="nama_nasabah">Nama
                                                        Lengkap <span style="color: red">*</span></label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark" id="nama_nasabah"
                                                        name="nama_nasabah" placeholder="Masukkan nama lengkap"
                                                        value="{{ old('nama_nasabah', $nasabah_profil->nama_nasabah) }}"
                                                        required>
                                                </div>

                                                <!-- Tempat, Tanggal Lahir -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="ttl_lahir_nasabah">Tempat, Tanggal Lahir</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="ttl_lahir_nasabah" name="ttl_lahir_nasabah"
                                                        placeholder="Contoh: Sidoarjo, 02-06-2000"
                                                        value="{{ old('ttl_lahir_nasabah', $nasabah_profil->ttl_lahir_nasabah) }}">
                                                </div>

                                                <!-- Alamat KTP -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="alamat_ktp_nasabah">Alamat (KTP)</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="alamat_ktp_nasabah" name="alamat_ktp_nasabah"
                                                        placeholder="Masukkan alamat sesuai KTP"
                                                        value="{{ old('alamat_ktp_nasabah', $nasabah_profil->alamat_ktp_nasabah) }}">
                                                </div>

                                                <!-- Kota KTP -->
                                                <div class="col-md-3 mt-2">
                                                    <label class="form-label fw-bold text-dark" for="kota_ktp_nasabah">Kota
                                                        (KTP)</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="kota_ktp_nasabah" name="kota_ktp_nasabah"
                                                        placeholder="Masukkan kota"
                                                        value="{{ old('kota_ktp_nasabah', $nasabah_profil->kota_ktp_nasabah) }}">
                                                </div>

                                                <!-- Kode Pos KTP -->
                                                <div class="col-md-3 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="kodepos_ktp_nasabah">Kode POS (KTP)</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="kodepos_ktp_nasabah" name="kodepos_ktp_nasabah"
                                                        placeholder="Contoh: 61253"
                                                        value="{{ old('kodepos_ktp_nasabah', $nasabah_profil->kodepos_ktp_nasabah) }}">
                                                </div>

                                                <!-- Alamat Sekarang -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="alamat_sekarang_nasabah">Alamat (Sekarang)</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="alamat_sekarang_nasabah" name="alamat_sekarang_nasabah"
                                                        placeholder="Masukkan alamat tinggal sekarang"
                                                        value="{{ old('alamat_sekarang_nasabah', $nasabah_profil->alamat_sekarang_nasabah) }}">
                                                </div>

                                                <!-- Kota Sekarang -->
                                                <div class="col-md-3 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="kota_sekarang_nasabah">Kota (Sekarang)</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="kota_sekarang_nasabah" name="kota_sekarang_nasabah"
                                                        placeholder="Masukkan kota"
                                                        value="{{ old('kota_sekarang_nasabah', $nasabah_profil->kota_sekarang_nasabah) }}">
                                                </div>

                                                <!-- Kode Pos Sekarang -->
                                                <div class="col-md-3 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="kodepos_sekarang_nasabah">Kode POS (Sekarang)</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="kodepos_sekarang_nasabah" name="kodepos_sekarang_nasabah"
                                                        placeholder="Contoh: 61253"
                                                        value="{{ old('kodepos_sekarang_nasabah', $nasabah_profil->kodepos_sekarang_nasabah) }}">
                                                </div>

                                                <!-- No KTP -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark" for="no_ktp_nasabah">No.
                                                        KTP</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="no_ktp_nasabah" name="no_ktp_nasabah"
                                                        placeholder="Masukkan nomor KTP"
                                                        value="{{ old('no_ktp_nasabah', $nasabah_profil->no_ktp_nasabah) }}">
                                                </div>

                                                <!-- Berlaku KTP -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="berlaku_ktp_nasabah">Berlaku Sampai</label>
                                                    <input disabled type="date"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="berlaku_ktp_nasabah" name="berlaku_ktp_nasabah"
                                                        value="{{ old('berlaku_ktp_nasabah', $nasabah_profil->berlaku_ktp_nasabah) }}">
                                                </div>

                                                <!-- NPWP -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark" for="no_npwp_nasabah">No.
                                                        NPWP</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="no_npwp_nasabah" name="no_npwp_nasabah"
                                                        placeholder="Masukkan nomor NPWP"
                                                        value="{{ old('no_npwp_nasabah', $nasabah_profil->no_npwp_nasabah) }}">
                                                </div>

                                                <!-- Kepemilikan Rumah -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark d-block">Kepemilikan
                                                        Rumah</label>

                                                    @php
                                                        $kepemilikanRumah = old(
                                                            'kepemilikan_rumah_nasabah',
                                                            $nasabah_profil->kepemilikan_rumah_nasabah ?? '',
                                                        );
                                                    @endphp

                                                    @foreach ([
            'sendiri' => 'Sendiri',
            'sewa/kontrak' => 'Sewa/Kontrak',
            'kredit' => 'Kredit',
            'orang tua' => 'Orang Tua',
            'instansi' => 'Instansi',
            'lainnya' => 'Lainnya',
        ] as $value => $label)
                                                        <div class="form-check form-check-inline">
                                                            <input disabled class="form-check-input" type="radio"
                                                                name="kepemilikan_rumah_nasabah"
                                                                id="rumah{{ strtoupper(preg_replace('/[^A-Za-z0-9]/', '', $value)) }}"
                                                                value="{{ $value }}"
                                                                {{ $kepemilikanRumah == $value ? 'checked' : '' }}>
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
                                                    <input disabled type="number"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="lamamenetap_tahun_nasabah" name="lamamenetap_tahun_nasabah"
                                                        min="0" placeholder="Contoh: 2"
                                                        value="{{ old('lamamenetap_tahun_nasabah', $nasabah_profil->lamamenetap_tahun_nasabah) }}">
                                                </div>
                                                <div class="col-md-3 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="lamamenetap_bulan_nasabah">Lama Menetap (Bulan)</label>
                                                    <input disabled type="number"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="lamamenetap_bulan_nasabah" name="lamamenetap_bulan_nasabah"
                                                        min="0" max="11" placeholder="Contoh: 6"
                                                        value="{{ old('lamamenetap_bulan_nasabah', $nasabah_profil->lamamenetap_bulan_nasabah) }}">
                                                </div>

                                                <!-- No Telp Rumah -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="notelp_rumah_nasabah">No. Telp Rumah</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="notelp_rumah_nasabah" name="notelp_rumah_nasabah"
                                                        placeholder="Contoh: 031-xxxxxxx"
                                                        value="{{ old('notelp_rumah_nasabah', $nasabah_profil->notelp_rumah_nasabah) }}">
                                                </div>

                                                <!-- No HP -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="notelp_hp_nasabah">No. HP</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="notelp_hp_nasabah" name="notelp_hp_nasabah"
                                                        placeholder="Contoh: 0812xxxxxxx"
                                                        value="{{ old('notelp_hp_nasabah', $nasabah_profil->notelp_hp_nasabah) }}">
                                                </div>

                                                <!-- Email -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="email_nasabah">Email</label>
                                                    <input disabled type="email"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="email_nasabah" name="email_nasabah"
                                                        placeholder="Contoh: email@example.com"
                                                        value="{{ old('email_nasabah', $nasabah_profil->email_nasabah) }}">
                                                </div>

                                                <!-- Jenis Kelamin -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark d-block">Jenis
                                                        Kelamin</label>

                                                    @php
                                                        $jenisKelamin = old(
                                                            'jenis_kelamin_nasabah',
                                                            $nasabah_profil->jenis_kelamin_nasabah ?? '',
                                                        );
                                                    @endphp

                                                    @foreach (['laki-laki' => 'Laki-Laki', 'perempuan' => 'Perempuan'] as $value => $label)
                                                        <div class="form-check form-check-inline">
                                                            <input disabled class="form-check-input" type="radio"
                                                                name="jenis_kelamin_nasabah"
                                                                id="jenisKelamin{{ strtoupper(str_replace('-', '', $value)) }}"
                                                                value="{{ $value }}"
                                                                {{ $jenisKelamin == $value ? 'checked' : '' }}>
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

                                                    @php
                                                        $statusKawin = old(
                                                            'status_kawin_nasabah',
                                                            $nasabah_profil->status_kawin_nasabah ?? '',
                                                        );
                                                    @endphp

                                                    @foreach ([
            'menikah' => 'Menikah',
            'belum menikah' => 'Belum Menikah',
            'duda/janda' => 'Duda/Janda',
        ] as $value => $label)
                                                        <div class="form-check form-check-inline">
                                                            <input disabled class="form-check-input" type="radio"
                                                                name="status_kawin_nasabah"
                                                                id="statusKawin{{ strtoupper(preg_replace('/[^A-Za-z0-9]/', '', $value)) }}"
                                                                value="{{ $value }}"
                                                                {{ $statusKawin == $value ? 'checked' : '' }}>
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
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="nama_ibu_nasabah" name="nama_ibu_nasabah"
                                                        placeholder="Masukkan nama ibu kandung"
                                                        value="{{ old('nama_ibu_nasabah', $nasabah_profil->nama_ibu_nasabah ?? '') }}">
                                                </div>

                                                <!-- Nama Organisasi -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="nama_organisasi_nasabah">Nama Organisasi</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="nama_organisasi_nasabah" name="nama_organisasi_nasabah"
                                                        placeholder="Masukkan nama organisasi"
                                                        value="{{ old('nama_organisasi_nasabah', $nasabah_profil->nama_organisasi_nasabah ?? '') }}">
                                                </div>

                                                <!-- Jabatan di Organisasi -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="jabatan_organisasi_nasabah">Jabatan di Organisasi</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="jabatan_organisasi_nasabah" name="jabatan_organisasi_nasabah"
                                                        placeholder="Contoh: Ketua, Anggota"
                                                        value="{{ old('jabatan_organisasi_nasabah', $nasabah_profil->jabatan_organisasi_nasabah ?? '') }}">
                                                </div>

                                                <!-- Lama Ikut Organisasi -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="lama_organisasi_nasabah">Lama Ikut Organisasi</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="lama_organisasi_nasabah" name="lama_organisasi_nasabah"
                                                        placeholder="Contoh: 2 tahun"
                                                        value="{{ old('lama_organisasi_nasabah', $nasabah_profil->lama_organisasi_nasabah ?? '') }}">
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
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="nama_keluarga_nasabah" name="nama_keluarga_nasabah"
                                                        placeholder="Masukkan nama lengkap"
                                                        value="{{ old('nama_keluarga_nasabah', $nasabah_profil->nama_keluarga_nasabah ?? '') }}">
                                                </div>

                                                <!-- Hubungan Keluarga Nasabah -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark d-block">Hubungan Keluarga
                                                        Nasabah</label>

                                                    @php
                                                        $hubunganKeluarga = old(
                                                            'hubungan_keluarga_nasabah',
                                                            $nasabah_profil->hubungan_keluarga_nasabah ?? '',
                                                        );
                                                    @endphp

                                                    @foreach ([
            'orang tua' => 'Orang Tua',
            'kakak/adik' => 'Kakak/Adik',
            'anak' => 'Anak',
            'lainnya' => 'Lainnya',
        ] as $value => $label)
                                                        <div class="form-check form-check-inline">
                                                            <input disabled class="form-check-input" type="radio"
                                                                name="hubungan_keluarga_nasabah"
                                                                id="hubungan{{ strtoupper(preg_replace('/[^A-Za-z0-9]/', '', $value)) }}"
                                                                value="{{ $value }}"
                                                                {{ $hubunganKeluarga == $value ? 'checked' : '' }}>
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
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="alamat_keluarga_nasabah" name="alamat_keluarga_nasabah"
                                                        placeholder="Masukkan alamat lengkap"
                                                        value="{{ old('alamat_keluarga_nasabah', $nasabah_profil->alamat_keluarga_nasabah ?? '') }}">
                                                </div>

                                                <!-- Kota Keluarga Nasabah -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="kota_keluarga_nasabah">Kota</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="kota_keluarga_nasabah" name="kota_keluarga_nasabah"
                                                        placeholder="Masukkan kota tempat tinggal"
                                                        value="{{ old('kota_keluarga_nasabah', $nasabah_profil->kota_keluarga_nasabah ?? '') }}">
                                                </div>

                                                <!-- Kode Pos Keluarga Nasabah -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="kodepos_keluarga_nasabah">Kode Pos</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="kodepos_keluarga_nasabah" name="kodepos_keluarga_nasabah"
                                                        placeholder="Masukkan kode pos"
                                                        value="{{ old('kodepos_keluarga_nasabah', $nasabah_profil->kodepos_keluarga_nasabah ?? '') }}">
                                                </div>

                                                <!-- No. Telepon Keluarga Nasabah -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="notelp_keluarga_nasabah">No. Telepon</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="notelp_keluarga_nasabah" name="notelp_keluarga_nasabah"
                                                        placeholder="Masukkan nomor telepon"
                                                        value="{{ old('notelp_keluarga_nasabah', $nasabah_profil->notelp_keluarga_nasabah ?? '') }}">
                                                </div>

                                                <!-- Pekerjaan Keluarga Nasabah -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="pekerjaan_keluarga_nasabah">Pekerjaan</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="pekerjaan_keluarga_nasabah" name="pekerjaan_keluarga_nasabah"
                                                        placeholder="Masukkan pekerjaan"
                                                        value="{{ old('pekerjaan_keluarga_nasabah', $nasabah_profil->pekerjaan_keluarga_nasabah ?? '') }}">
                                                </div>

                                                <!-- Alamat Kantor Keluarga Nasabah -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="alamatkantor_keluarga_nasabah">Alamat Kantor</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="alamatkantor_keluarga_nasabah"
                                                        name="alamatkantor_keluarga_nasabah"
                                                        placeholder="Masukkan alamat kantor"
                                                        value="{{ old('alamatkantor_keluarga_nasabah', $nasabah_profil->alamatkantor_keluarga_nasabah ?? '') }}">
                                                </div>

                                                <!-- No. Telepon Kantor Keluarga Nasabah -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="notelpkantor_keluarga_nasabah">No. Telepon Kantor</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="notelpkantor_keluarga_nasabah"
                                                        name="notelpkantor_keluarga_nasabah"
                                                        placeholder="Masukkan nomor telepon kantor"
                                                        value="{{ old('notelpkantor_keluarga_nasabah', $nasabah_profil->notelpkantor_keluarga_nasabah ?? '') }}">
                                                </div>
                                            </div>

                                            <h6 class="border-bottom pb-2">2. Pasangan Nasabah</h6>
                                            <div class="row g-3 mb-3">
                                                <!-- Nama Pasangan -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark" for="nama_pasangan">Nama
                                                        Pasangan</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="nama_pasangan" name="nama_pasangan"
                                                        placeholder="Masukkan nama pasangan"
                                                        value="{{ old('nama_pasangan', $nasabah_profil->nama_pasangan ?? '') }}">
                                                </div>

                                                <!-- Tempat, Tanggal Lahir Pasangan -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="ttl_lahir_pasangan">Tempat, Tanggal Lahir</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="ttl_lahir_pasangan" name="ttl_lahir_pasangan"
                                                        placeholder="Contoh: Sidoarjo, 02-06-1995"
                                                        value="{{ old('ttl_lahir_pasangan', $nasabah_profil->ttl_lahir_pasangan ?? '') }}">
                                                </div>

                                                <!-- No KTP Pasangan -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark" for="no_ktp_pasangan">No.
                                                        KTP</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="no_ktp_pasangan" name="no_ktp_pasangan"
                                                        placeholder="Masukkan nomor KTP"
                                                        value="{{ old('no_ktp_pasangan', $nasabah_profil->no_ktp_pasangan ?? '') }}">
                                                </div>

                                                <!-- Berlaku KTP Pasangan -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="berlaku_ktp_pasangan">Berlaku Sampai</label>
                                                    <input disabled type="date"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="berlaku_ktp_pasangan" name="berlaku_ktp_pasangan"
                                                        value="{{ old('berlaku_ktp_pasangan', $nasabah_profil->berlaku_ktp_pasangan ?? '') }}">
                                                </div>

                                                <!-- Jumlah Anak -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="jumlah_anak_pasangan">Jumlah Anak</label>
                                                    <input disabled type="number"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="jumlah_anak_pasangan" name="jumlah_anak_pasangan"
                                                        min="0" placeholder="Contoh: 2"
                                                        value="{{ old('jumlah_anak_pasangan', $nasabah_profil->jumlah_anak_pasangan ?? '') }}">
                                                </div>

                                                <!-- No. NPWP Pasangan -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark" for="no_npwp_pasangan">No.
                                                        NPWP</label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="no_npwp_pasangan" name="no_npwp_pasangan"
                                                        placeholder="Masukkan nomor NPWP"
                                                        value="{{ old('no_npwp_pasangan', $nasabah_profil->no_npwp_pasangan ?? '') }}">
                                                </div>
                                            </div>

                                            <h6 class="border-bottom pb-2">3. Hubungan Nasabah Bank Syariah</h6>
                                            <div class="row g-3 mb-3">

                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label text-info fw-bold d-block">Apakah nasabah
                                                        memiliki rekening di bank ini?</label>
                                                    @php
                                                        $punyaOptions = ['Tidak (0)', 'Iya Punya (1)'];
                                                        $selectedPunya = old(
                                                            'punya_rekening_nasabah',
                                                            $nasabah_profil->punya_rekening_nasabah ?? '',
                                                        );
                                                    @endphp

                                                    @foreach ($punyaOptions as $label)
                                                        <div class="form-check form-check-inline">
                                                            <input disabled class="form-check-input" type="radio"
                                                                name="punya_rekening_nasabah"
                                                                id="punya{{ strtoupper(preg_replace('/[^a-zA-Z0-9]/', '', $label)) }}"
                                                                value="{{ $label }}"
                                                                {{ $selectedPunya == $label ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="punya{{ strtoupper(preg_replace('/[^a-zA-Z0-9]/', '', $label)) }}">
                                                                {{ $label }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label text-info fw-bold d-block">Tahun Menjadi
                                                        Nasabah</label>
                                                    @php
                                                        $tahunOptions = [
                                                            '<1 Tahun (1)',
                                                            '1-3 Tahun (2)',
                                                            '>3 Tahun (3)',
                                                        ];
                                                        $selectedTahun = old(
                                                            'tahun_menjadi_nasabah',
                                                            $nasabah_profil->tahun_menjadi_nasabah ?? '',
                                                        );
                                                    @endphp

                                                    @foreach ($tahunOptions as $label)
                                                        <div class="form-check form-check-inline">
                                                            <input disabled class="form-check-input" type="radio"
                                                                name="tahun_menjadi_nasabah"
                                                                id="tahun{{ strtoupper(preg_replace('/[^a-zA-Z0-9]/', '', $label)) }}"
                                                                value="{{ $label }}"
                                                                {{ $selectedTahun == $label ? 'checked' : '' }}>
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
                                                    @php
                                                        $jenisLayanan = old(
                                                            'jenis_layanan_nasabah',
                                                            $nasabah_profil->jenis_layanan_nasabah ?? '',
                                                        );
                                                    @endphp

                                                    @foreach (['Giro', 'Tabungan', 'Deposito', 'Pembiayaan', 'Lainnya'] as $option)
                                                        <div class="form-check form-check-inline">
                                                            <input disabled class="form-check-input" type="radio"
                                                                name="jenis_layanan_nasabah"
                                                                id="layanan{{ $option }}"
                                                                value="{{ $option }}"
                                                                {{ $jenisLayanan == $option ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="layanan{{ $option }}">{{ $option }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label text-info fw-bold d-block">Mutasi Rekening Di
                                                        Bank UMSIDA Syariah / Performance Sebagai Nasabah Bank UMSIDA
                                                        Syariah</label>
                                                    @php
                                                        $mutasiOptions = [
                                                            'Mutasi Rekening Aktif (2)',
                                                            'Mutasi Rekening Tidak Aktif (1)',
                                                        ];
                                                        $selectedMutasi = old(
                                                            'mutasi_rekening_nasabah',
                                                            $nasabah_profil->mutasi_rekening_nasabah ?? '',
                                                        );
                                                    @endphp

                                                    @foreach ($mutasiOptions as $label)
                                                        <div class="form-check form-check-inline">
                                                            <input disabled class="form-check-input" type="radio"
                                                                name="mutasi_rekening_nasabah"
                                                                id="mutasi{{ strtoupper(preg_replace('/[^a-zA-Z0-9]/', '', $label)) }}"
                                                                value="{{ $label }}"
                                                                {{ $selectedMutasi == $label ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="mutasi{{ strtoupper(preg_replace('/[^a-zA-Z0-9]/', '', $label)) }}">
                                                                {{ $label }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="d-flex gap-2 justify-content-start mt-3" id="nav-tab"
                                                role="tablist">
                                                <a href="{{ route('multiguna.limac.character.data') }}"
                                                    class="btn btn-secondary">
                                                    ← Kembali
                                                </a>
                                            </div>

                                        </div>
                                        <div class="tab-pane fade" id="nav-2" role="tabpanel"
                                            aria-labelledby="nav-2-tab">
                                            <h6>Personality/ Kepribadian</h6>
                                            <div class="row g-3 mb-3">
                                                @php
                                                    $fields = [
                                                        'responsif_komunikatif' => 'Responsif Komunikatif',
                                                        'mudah_dihubungi' => 'Mudah Dihubungi',
                                                        'wawasan_luas' => 'Wawasan Luas',
                                                        'informatif' => 'Informatif',
                                                        'terbuka_berkomunikasi' => 'Terbuka Berkomunikasi',
                                                    ];

                                                    $options = ['Tidak (0)', 'Iya (1)'];
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
                                                                    name="{{ $field }}" id="{{ $inputId }}"
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
                                            <h6>Account Behaviour</h6>
                                            <div class="row g-3 mb-3">
                                                @php
                                                    $fields = [
                                                        'tidak_blacklist_bi' => 'Tidak Blacklist BI',
                                                        'bg_cek_tidak_ditolak' => 'BG Cek Tidak Ditolak',
                                                        'tidak_bermasalah_bank_lain' => 'Tidak Bermasalah Bank Lain',
                                                        'fasilitas_sesuai_penggunaan' => 'Fasilitas Sesuai Penggunaan',
                                                        'mutasi_pinjaman_aktif' => 'Mutasi Pinjaman Aktif',
                                                    ];

                                                    $options = ['Tidak (0)', 'Iya (1)'];
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
                                                                    name="{{ $field }}" id="{{ $inputId }}"
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
                                            <input type="hidden" name="kode_nasabah"
                                                value="{{ $pengajuan->kode_nasabah }}">
                                            <input type="hidden" name="nama_nasabah"
                                                value="{{ $pengajuan->nama_nasabah }}">
                                            <input type="hidden" name="username" value="{{ $pengajuan->username }}">
                                            <input type="hidden" name="kode_tempat"
                                                value="{{ $pengajuan->kode_tempat }}">

                                            <h6 class="border-bottom pb-2">Data Checking Nasabah</h6>

                                            {{-- Tabel Data Checking Nasabah --}}
                                            <div class="table-responsive">
                                                <table id="table-checking-nasabah" class="table table-bordered table-sm">
                                                    <thead class="table-light text-center align-middle">
                                                        <tr>
                                                            <th>No</th>
                                                            <th>No Id Checking</th>
                                                            <th>Nama Nasabah (Debitur)</th>
                                                            <th>Fasilitas Pinjaman / Jenis Pinjaman</th>
                                                            <th>Bank Pelapor / Kreditur</th>
                                                            <th>Plafond Pinjaman / Limit</th>
                                                            <th>Outstanding Pinjaman / Sisa Hutang</th>
                                                            <th>Tanggal Realisasi / Jangka Waktu</th>
                                                            <th>Tanggal Jatuh Tempo / Jangka Waktu</th>
                                                            <th class="text-info">Kolektabilitas</th>
                                                            <th>Keterangan</th>
                                                            <th>Agunan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $options = [
                                                                '--',
                                                                'LANCAR/TIDAK MENUNGGAK (5)',
                                                                'MENUNGGAK 1 - 2 (4)',
                                                                'MENUNGGAK 3 - 6 (3)',
                                                                'MENUNGGAK 7 - 10 (2)',
                                                                'MENUNGGAK >10 (1)',
                                                            ];
                                                        @endphp
                                                        @foreach ($pengajuan_checking_nasabah as $i => $item)
                                                            <tr>
                                                                <input type="hidden"
                                                                    name="id_checking_nasabah[{{ $i }}][id]"
                                                                    value="{{ $item->id }}">
                                                                <td class="p-1 text-center align-middle">
                                                                    {{ $i + 1 }}</td>
                                                                <td class="p-1"><input type="text"
                                                                        name="id_checking_nasabah[{{ $i }}][noid_checking]"
                                                                        value="{{ $item->noid_checking_nasabah }}"
                                                                        class="form-control text-center align-middle"></td>
                                                                <td class="p-1"><input type="text"
                                                                        name="id_checking_nasabah[{{ $i }}][nama_debitur]"
                                                                        value="{{ $item->nama_debitur_nasabah }}"
                                                                        class="form-control text-center align-middle"></td>
                                                                <td class="p-1"><input type="text"
                                                                        name="id_checking_nasabah[{{ $i }}][fasilitas_pinjaman]"
                                                                        value="{{ $item->fasilitas_pinjaman_nasabah }}"
                                                                        class="form-control text-center align-middle"></td>
                                                                <td class="p-1"><input type="text"
                                                                        name="id_checking_nasabah[{{ $i }}][bank_pelapor]"
                                                                        value="{{ $item->bank_pelapor_nasabah }}"
                                                                        class="form-control text-center align-middle"></td>
                                                                <td class="p-1"><input type="number" step="0.01"
                                                                        name="id_checking_nasabah[{{ $i }}][plafond_pinjaman]"
                                                                        value="{{ $item->plafond_pinjaman_nasabah }}"
                                                                        class="form-control text-center align-middle"></td>
                                                                <td class="p-1"><input type="number" step="0.01"
                                                                        name="id_checking_nasabah[{{ $i }}][outstanding_pinjaman]"
                                                                        value="{{ $item->outstanding_pinjaman_nasabah }}"
                                                                        class="form-control text-center align-middle"></td>
                                                                <td class="p-1"><input type="date"
                                                                        name="id_checking_nasabah[{{ $i }}][tanggal_realisasi]"
                                                                        value="{{ $item->tanggal_realisasi_nasabah ? \Carbon\Carbon::parse($item->tanggal_realisasi_nasabah)->format('Y-m-d') : '' }}"
                                                                        class="form-control text-center align-middle"></td>
                                                                <td class="p-1"><input type="date"
                                                                        name="id_checking_nasabah[{{ $i }}][tanggal_jatuh_tempo]"
                                                                        value="{{ $item->tanggal_jatuh_tempo_nasabah ? \Carbon\Carbon::parse($item->tanggal_jatuh_tempo_nasabah)->format('Y-m-d') : '' }}"
                                                                        class="form-control text-center align-middle"></td>
                                                                <td class="p-1">
                                                                    <select
                                                                        name="id_checking_nasabah[{{ $i }}][kolektabilitas]"
                                                                        class="form-control">

                                                                        @foreach ($options as $option)
                                                                            <option value="{{ $option }}"
                                                                                {{ $item->kolektabilitas_nasabah === $option ? 'selected' : '' }}>
                                                                                {{ $option }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>
                                                                <td class="p-1"><input type="text"
                                                                        name="id_checking_nasabah[{{ $i }}][keterangan]"
                                                                        value="{{ $item->keterangan_nasabah }}"
                                                                        class="form-control text-center align-middle"></td>
                                                                <td class="p-1"><input type="text"
                                                                        name="id_checking_nasabah[{{ $i }}][agunan]"
                                                                        value="{{ $item->agunan_nasabah }}"
                                                                        class="form-control text-center align-middle"></td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="d-flex justify-content-end gap-2 mt-3">
                                                <button type="button" id="btn-add-row-checking-nasabah"
                                                    class="btn btn-sm btn-info">+
                                                    Tambah baris table</button>
                                                <button type="button" id="btn-remove-row-checking-nasabah"
                                                    class="btn btn-sm btn-danger">− Hapus baris table</button>
                                            </div>

                                            {{-- Tabel Data Checking Pasangan --}}
                                            <h6 class="mt-4 mb-2 fw-bold">Data Checking Pasangan</h6>
                                            <div class="table-responsive">
                                                <table id="table-checking-pasangan" class="table table-bordered table-sm">
                                                    <thead class="table-light text-center align-middle">
                                                        <tr>
                                                            <th>No</th>
                                                            <th>No Id Checking</th>
                                                            <th>Nama Pasangan (Debitur)</th>
                                                            <th>Fasilitas Pinjaman / Jenis Pinjaman</th>
                                                            <th>Bank Pelapor / Kreditur</th>
                                                            <th>Plafond Pinjaman / Limit</th>
                                                            <th>Outstanding Pinjaman / Sisa Hutang</th>
                                                            <th>Tanggal Realisasi / Jangka Waktu</th>
                                                            <th>Tanggal Jatuh Tempo / Jangka Waktu</th>
                                                            <th class="text-info">Kolektabilitas</th>
                                                            <th>Keterangan</th>
                                                            <th>Agunan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($pengajuan_checking_pasangan as $i => $item)
                                                            <tr>
                                                                <input type="hidden"
                                                                    name="id_checking_pasangan[{{ $i }}][id]"
                                                                    value="{{ $item->id }}">
                                                                <td class="p-1 text-center align-middle">
                                                                    {{ $i + 1 }}</td>
                                                                <td class="p-1"><input type="text"
                                                                        name="id_checking_pasangan[{{ $i }}][noid_checking]"
                                                                        value="{{ $item->noid_checking_pasangan }}"
                                                                        class="form-control text-center align-middle"></td>
                                                                <td class="p-1"><input type="text"
                                                                        name="id_checking_pasangan[{{ $i }}][nama_debitur]"
                                                                        value="{{ $item->nama_debitur_pasangan }}"
                                                                        class="form-control text-center align-middle"></td>
                                                                <td class="p-1"><input type="text"
                                                                        name="id_checking_pasangan[{{ $i }}][fasilitas_pinjaman]"
                                                                        value="{{ $item->fasilitas_pinjaman_pasangan }}"
                                                                        class="form-control text-center align-middle"></td>
                                                                <td class="p-1"><input type="text"
                                                                        name="id_checking_pasangan[{{ $i }}][bank_pelapor]"
                                                                        value="{{ $item->bank_pelapor_pasangan }}"
                                                                        class="form-control text-center align-middle"></td>
                                                                <td class="p-1"><input type="number" step="0.01"
                                                                        name="id_checking_pasangan[{{ $i }}][plafond_pinjaman]"
                                                                        value="{{ $item->plafond_pinjaman_pasangan }}"
                                                                        class="form-control text-center align-middle"></td>
                                                                <td class="p-1"><input type="number" step="0.01"
                                                                        name="id_checking_pasangan[{{ $i }}][outstanding_pinjaman]"
                                                                        value="{{ $item->outstanding_pinjaman_pasangan }}"
                                                                        class="form-control text-center align-middle"></td>
                                                                <td class="p-1"><input type="date"
                                                                        name="id_checking_pasangan[{{ $i }}][tanggal_realisasi]"
                                                                        value="{{ $item->tanggal_realisasi_pasangan ? \Carbon\Carbon::parse($item->tanggal_realisasi_pasangan)->format('Y-m-d') : '' }}"
                                                                        class="form-control text-center align-middle"></td>
                                                                <td class="p-1"><input type="date"
                                                                        name="id_checking_pasangan[{{ $i }}][tanggal_jatuh_tempo]"
                                                                        value="{{ $item->tanggal_jatuh_tempo_pasangan ? \Carbon\Carbon::parse($item->tanggal_jatuh_tempo_pasangan)->format('Y-m-d') : '' }}"
                                                                        class="form-control text-center align-middle"></td>
                                                                <td class="p-1">
                                                                    <select
                                                                        name="id_checking_pasangan[{{ $i }}][kolektabilitas]"
                                                                        class="form-control">

                                                                        @foreach ($options as $option)
                                                                            <option value="{{ $option }}"
                                                                                {{ $item->kolektabilitas_pasangan === $option ? 'selected' : '' }}>
                                                                                {{ $option }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>
                                                                <td class="p-1"><input type="text"
                                                                        name="id_checking_pasangan[{{ $i }}][keterangan]"
                                                                        value="{{ $item->keterangan_pasangan }}"
                                                                        class="form-control text-center align-middle"></td>
                                                                <td class="p-1"><input type="text"
                                                                        name="id_checking_pasangan[{{ $i }}][agunan]"
                                                                        value="{{ $item->agunan_pasangan }}"
                                                                        class="form-control text-center align-middle"></td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="d-flex justify-content-end gap-2 mt-3">
                                                <button type="button" id="btn-add-row-checking-pasangan"
                                                    class="btn btn-sm btn-info">+
                                                    Tambah baris table</button>
                                                <button type="button" id="btn-remove-row-checking-pasangan"
                                                    class="btn btn-sm btn-danger">− Hapus baris table</button>
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
