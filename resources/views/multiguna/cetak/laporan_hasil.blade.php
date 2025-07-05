<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Hasil Analisis</title>
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

        .mob-toggler {
            display: none !important;
        }

        .alert-fixed-right {
            position: fixed !important;
            top: 1rem !important;
            right: 1rem !important;
            z-index: 1050 !important;
        }

        .form-check-input[type="radio"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .form-check-label {
            font-size: 0.8rem;
            cursor: pointer;
        }

        th {
            font-size: 11px !important;
        }
    </style>
</head>

<body contenteditable="true" spellcheck="false" class="bg-white text-dark">

    <button contenteditable="false" class="btn btn-danger position-fixed top-0 start-0 m-3 no-print"
        style ="z-index: 1055;" onclick="window.print()">
        🖨️ Print / Cetak
    </button>

    <div class="container p-5">

        <h4 class="text-center font-weight-bold py-2">Laporan Hasil Analisis</h4>

        {{-- Start Character --}}
        <h5 class="mb-0 py-1 mt-3">CHARACTER</h5>
        <h6 class="border-bottom py-1">Identitas Nasabah</h6>

        @php
            $characterIdentitasNasabah = [
                'Nama Lengkap' => $nasabah_profil->nama_nasabah,
                'Tempat, Tanggal Lahir' => $nasabah_profil->ttl_lahir_nasabah,
                'Alamat (KTP)' => $nasabah_profil->alamat_ktp_nasabah,
                'Kota (KTP)' => $nasabah_profil->kota_ktp_nasabah,
                'Kode POS (KTP)' => $nasabah_profil->kodepos_ktp_nasabah,
                'Alamat (Sekarang)' => $nasabah_profil->alamat_sekarang_nasabah,
                'Kota (Sekarang)' => $nasabah_profil->kota_sekarang_nasabah,
                'Kode POS (Sekarang)' => $nasabah_profil->kodepos_sekarang_nasabah,
                'No. KTP' => $nasabah_profil->no_ktp_nasabah,
                'Berlaku KTP' => $nasabah_profil->berlaku_ktp_nasabah,
                'No. NPWP' => $nasabah_profil->no_npwp_nasabah,
                'Kepemilikan Rumah' => ucfirst($nasabah_profil->kepemilikan_rumah_nasabah),
                'Lama Menetap' =>
                    $nasabah_profil->lamamenetap_tahun_nasabah .
                    ' Tahun ' .
                    $nasabah_profil->lamamenetap_bulan_nasabah .
                    ' Bulan',
                'No. Telp Rumah' => $nasabah_profil->notelp_rumah_nasabah,
                'No. HP' => $nasabah_profil->notelp_hp_nasabah,
                'Email' => $nasabah_profil->email_nasabah,
                'Jenis Kelamin' => ucfirst($nasabah_profil->jenis_kelamin_nasabah),
                'Status Perkawinan' => ucfirst($nasabah_profil->status_kawin_nasabah),
                'Nama Ibu Kandung' => $nasabah_profil->nama_ibu_nasabah ?? '-',
                'Nama Organisasi' => $nasabah_profil->nama_organisasi_nasabah ?? '-',
                'Jabatan di Organisasi' => $nasabah_profil->jabatan_organisasi_nasabah ?? '-',
                'Lama Ikut Organisasi' => $nasabah_profil->lama_organisasi_nasabah ?? '-',
            ];
        @endphp

        @foreach ($characterIdentitasNasabah as $label => $value)
            <div class="row mb-1">
                <div class="col-4 fw-bold text-dark d-flex justify-content-between">
                    <span>{{ $label }}</span>
                    <span>:</span>
                </div>
                <div class="col-8 text-dark pl-1">{{ $value }}</div>
            </div>
        @endforeach

        <h6 class="my-2 mt-3">* Untuk keperluan mendadak (keluarga dekat
            yang
            tidak serumah)</h6>

        @php
            $characterIdentitasNasabahKeluarga = [
                'Nama Keluarga Nasabah' => $nasabah_profil->nama_keluarga_nasabah ?? '-',
                'Hubungan Keluarga Nasabah' => ucfirst($nasabah_profil->hubungan_keluarga_nasabah ?? '-'),
                'Alamat Keluarga Nasabah' => $nasabah_profil->alamat_keluarga_nasabah ?? '-',
                'Kota Keluarga Nasabah' => $nasabah_profil->kota_keluarga_nasabah ?? '-',
                'Kode Pos Keluarga Nasabah' => $nasabah_profil->kodepos_keluarga_nasabah ?? '-',
                'No. Telepon Keluarga Nasabah' => $nasabah_profil->notelp_keluarga_nasabah ?? '-',
                'Pekerjaan Keluarga Nasabah' => $nasabah_profil->pekerjaan_keluarga_nasabah ?? '-',
                'Alamat Kantor Keluarga Nasabah' => $nasabah_profil->alamatkantor_keluarga_nasabah ?? '-',
                'No. Telepon Kantor Keluarga Nasabah' => $nasabah_profil->notelpkantor_keluarga_nasabah ?? '-',
            ];
        @endphp

        @foreach ($characterIdentitasNasabahKeluarga as $label => $value)
            <div class="row mb-1">
                <div class="col-4 fw-bold text-dark d-flex justify-content-between">
                    <span>{{ $label }}</span>
                    <span>:</span>
                </div>
                <div class="col-8 text-dark pl-1">{{ $value }}</div>
            </div>
        @endforeach

        <h6 class="border-bottom pb-2 mt-3">Pasangan Nasabah</h6>

        @php
            $characterIdentitasPasangan = [
                'Nama Pasangan' => $nasabah_profil->nama_pasangan ?? '-',
                'Tempat, Tanggal Lahir Pasangan' => $nasabah_profil->ttl_lahir_pasangan ?? '-',
                'No. KTP Pasangan' => $nasabah_profil->no_ktp_pasangan ?? '-',
                'Berlaku KTP Pasangan' => $nasabah_profil->berlaku_ktp_pasangan ?? '-',
                'Jumlah Anak' => $nasabah_profil->jumlah_anak_pasangan ?? '-',
                'No. NPWP Pasangan' => $nasabah_profil->no_npwp_pasangan ?? '-',
            ];
        @endphp

        @foreach ($characterIdentitasPasangan as $label => $value)
            <div class="row mb-1">
                <div class="col-4 fw-bold text-dark d-flex justify-content-between">
                    <span>{{ $label }}</span>
                    <span>:</span>
                </div>
                <div class="col-8 text-dark pl-1">{{ $value }}</div>
            </div>
        @endforeach

        <h6 class="border-bottom pb-2 mt-3">Hubungan Nasabah Bank Syariah</h6>
        @php
            $characterHubunganBank = [
                'Apakah memiliki rekening di bank ini?' => $nasabah_profil->punya_rekening_nasabah ?? '-',
                'Tahun Menjadi Nasabah' => $nasabah_profil->tahun_menjadi_nasabah ?? '-',
                'Jenis Layanan Nasabah' => $nasabah_profil->jenis_layanan_nasabah ?? '-',
                'Mutasi Rekening / Performance' => $nasabah_profil->mutasi_rekening_nasabah ?? '-',
            ];
        @endphp

        @foreach ($characterHubunganBank as $label => $value)
            <div class="row mb-1">
                <div class="col-4 fw-bold text-dark d-flex justify-content-between">
                    <span>{{ $label }}</span>
                    <span>:</span>
                </div>
                <div class="col-8 text-dark pl-1">{{ $value }}</div>
            </div>
        @endforeach

        <h6 class="border-bottom pb-2 mt-3">Karakter Nasabah</h6>
        @php
            $characterKarakterNasabah = [
                'Responsif Komunikatif' => $pengajuan_character->responsif_komunikatif ?? '-',
                'Mudah Dihubungi' => $pengajuan_character->mudah_dihubungi ?? '-',
                'Wawasan Luas' => $pengajuan_character->wawasan_luas ?? '-',
                'Informatif' => $pengajuan_character->informatif ?? '-',
                'Terbuka Berkomunikasi' => $pengajuan_character->terbuka_berkomunikasi ?? '-',
                'Tidak Blacklist BI' => $pengajuan_character->tidak_blacklist_bi ?? '-',
                'BG Cek Tidak Ditolak' => $pengajuan_character->bg_cek_tidak_ditolak ?? '-',
                'Tidak Bermasalah Bank Lain' => $pengajuan_character->tidak_bermasalah_bank_lain ?? '-',
                'Fasilitas Sesuai Penggunaan' => $pengajuan_character->fasilitas_sesuai_penggunaan ?? '-',
                'Mutasi Pinjaman Aktif' => $pengajuan_character->mutasi_pinjaman_aktif ?? '-',
            ];
        @endphp

        @foreach ($characterKarakterNasabah as $label => $value)
            <div class="row mb-1">
                <div class="col-4 fw-bold text-dark d-flex justify-content-between">
                    <span>{{ $label }}</span>
                    <span>:</span>
                </div>
                <div class="col-8 text-dark pl-1">{{ $value }}</div>
            </div>
        @endforeach

        <h6 class="border-bottom pb-2 mt-3">Data Checking Nasabah</h6>
        {{-- Tabel Data Checking Nasabah --}}
        <table class="table table-bordered table-sm w-100 text-center" style="table-layout: fixed;">
            <thead class="small">
                <tr>
                    <th style="width: 30px;" class="bg-white align-middle text-wrap p-1 m-0">#</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">No Id
                        Checking</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">Nama
                        Nasabah (Debitur)</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">
                        Fasilitas Pinjaman / Jenis Pinjaman
                    </th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">Bank
                        Pelapor / Kreditur</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">
                        Plafond</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">
                        Outstanding</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">Tgl
                        Realisasi</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">Tgl
                        Jatuh Tempo</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">
                        Kolektabilitas</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">
                        Keterangan</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">Agunan
                    </th>
                </tr>
            </thead>
            <tbody class="small">
                @foreach ($pengajuan_checking_nasabah as $i => $item)
                    <tr>
                        <td style="width: 30px;" class="text-center text-wrap align-middle p-1 m-0">{{ $i + 1 }}
                        </td>
                        <td class="text-center text-wrap align-middle p-1 m-0">{{ $item->noid_checking_nasabah }}</td>
                        <td class="text-center text-wrap align-middle p-1 m-0">{{ $item->nama_debitur_nasabah }}</td>
                        <td class="text-center text-wrap align-middle p-1 m-0">{{ $item->fasilitas_pinjaman_nasabah }}
                        </td>
                        <td class="text-center text-wrap align-middle p-1 m-0">{{ $item->bank_pelapor_nasabah }}</td>
                        <td class="text-center text-wrap align-middle p-1 m-0">
                            {{ number_format($item->plafond_pinjaman_nasabah, 2, ',', '.') }}</td>
                        <td class="text-center text-wrap align-middle p-1 m-0">
                            {{ number_format($item->outstanding_pinjaman_nasabah, 2, ',', '.') }}</td>
                        <td class="text-center text-wrap align-middle p-1 m-0">
                            {{ $item->tanggal_realisasi_nasabah ? \Carbon\Carbon::parse($item->tanggal_realisasi_nasabah)->format('d/m/Y') : '' }}
                        </td>
                        <td class="text-center text-wrap align-middle p-1 m-0">
                            {{ $item->tanggal_jatuh_tempo_nasabah ? \Carbon\Carbon::parse($item->tanggal_jatuh_tempo_nasabah)->format('d/m/Y') : '' }}
                        </td>
                        <td class="text-center text-wrap align-middle p-1 m-0">{{ $item->kolektabilitas_nasabah }}</td>
                        <td class="text-center text-wrap align-middle p-1 m-0">{{ $item->keterangan_nasabah }}</td>
                        <td class="text-center text-wrap align-middle p-1 m-0">{{ $item->agunan_nasabah }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Tabel Data Checking Pasangan --}}
        <h6 class="mt-4 mb-2">Data Checking Pasangan</h6>
        <table class="table table-bordered table-sm w-100 text-center" style="table-layout: fixed;">
            <thead class="small">
                <tr>
                    <th style="width: 30px;" class="bg-white align-middle text-wrap p-1 m-0">#</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">No Id
                        Checking</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">Nama
                        Pasangan (Debitur)</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">
                        Fasilitas Pinjaman / Jenis Pinjaman
                    </th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">Bank
                        Pelapor / Kreditur</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">
                        Plafond</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">
                        Outstanding</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">Tgl
                        Realisasi</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">Tgl
                        Jatuh Tempo</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">
                        Kolektabilitas</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">
                        Keterangan</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">
                        Agunan</th>
                </tr>
            </thead>
            <tbody class="small">
                @foreach ($pengajuan_checking_pasangan as $i => $item)
                    <tr>
                        <td style="width: 30px;" class="text-center text-wrap align-middle p-1 m-0">
                            {{ $i + 1 }}
                        </td>
                        <td class="text-center text-wrap align-middle p-1 m-0">{{ $item->noid_checking_pasangan }}
                        </td>
                        <td class="text-center text-wrap align-middle p-1 m-0">{{ $item->nama_debitur_pasangan }}</td>
                        <td class="text-center text-wrap align-middle p-1 m-0">
                            {{ $item->fasilitas_pinjaman_pasangan }}
                        </td>
                        <td class="text-center text-wrap align-middle p-1 m-0">{{ $item->bank_pelapor_pasangan }}</td>
                        <td class="text-center text-wrap align-middle p-1 m-0">
                            {{ number_format($item->plafond_pinjaman_pasangan, 2, ',', '.') }}</td>
                        <td class="text-center text-wrap align-middle p-1 m-0">
                            {{ number_format($item->outstanding_pinjaman_pasangan, 2, ',', '.') }}</td>
                        <td class="text-center text-wrap align-middle p-1 m-0">
                            {{ $item->tanggal_realisasi_pasangan ? \Carbon\Carbon::parse($item->tanggal_realisasi_pasangan)->format('d/m/Y') : '' }}
                        </td>
                        <td class="text-center text-wrap align-middle p-1 m-0">
                            {{ $item->tanggal_jatuh_tempo_pasangan ? \Carbon\Carbon::parse($item->tanggal_jatuh_tempo_pasangan)->format('d/m/Y') : '' }}
                        </td>
                        <td class="text-center text-wrap align-middle p-1 m-0">{{ $item->kolektabilitas_pasangan }}
                        </td>
                        <td class="text-center text-wrap align-middle p-1 m-0">{{ $item->keterangan_pasangan }}</td>
                        <td class="text-center text-wrap align-middle p-1 m-0">{{ $item->agunan_pasangan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- End Character --}}

        {{-- Start Capacity --}}
        <h5 class="mb-0 py-1 mt-3">CAPACITY</h5>
        <h6 class="border-bottom pb-2">Pekerjaan Nasabah</h6>

        @php
            $capacityPekerjaanNasabah = [
                'Nama Nasabah' => $nasabah_pekerjaan->nama_nasabah ?? '--',
                'Nama Perusahaan Nasabah' => $nasabah_pekerjaan->nama_perusahaan_nasabah ?? '--',
                'Alamat Perusahaan Nasabah' => $nasabah_pekerjaan->alamat_perusahaan_nasabah ?? '--',
                'No. Telp Perusahaan Nasabah' => $nasabah_pekerjaan->notelp_perusahaan_nasabah ?? '--',
                'Departemen Perusahaan Nasabah' => $nasabah_pekerjaan->dept_perusahaan_nasabah ?? '--',
                'Bidang Perusahaan Nasabah' => $nasabah_pekerjaan->bidang_perusahaan_nasabah ?? '--',
                'Skala Perusahaan Nasabah' => $nasabah_pekerjaan->skala_perusahaan_nasabah ?? '--',
                'Jenis Pekerjaan Nasabah' => $nasabah_pekerjaan->jenis_pekerjaan_nasabah ?? '--',
                'Jabatan Pekerjaan Nasabah' => $nasabah_pekerjaan->jabatan_pekerjaan_nasabah ?? '--',
                'Mulai Bekerja Nasabah' => $nasabah_pekerjaan->mulai_bekerja_nasabah ?? '--',
                'Lama Bekerja (Tahun)' => $nasabah_pekerjaan->lamabekerja_tahun_nasabah ?? '--',
                'Lama Bekerja (Bulan)' => $nasabah_pekerjaan->lamabekerja_bulan_nasabah ?? '--',
                'Tanggal Penggajian Satu' => $nasabah_pekerjaan->penggajian_satu_nasabah ?? '--',
                'Tanggal Penggajian Dua' => $nasabah_pekerjaan->penggajian_dua_nasabah ?? '--',
                'Perjanjian Kerjasama' => $nasabah_pekerjaan->perjanjian_kerjasama_nasabah ?? '--',
                'Pengalaman Perusahaan' => $nasabah_pekerjaan->pengalaman_perusahaan_nasabah ?? '--',
                'Pengalaman Perusahaan Lain' => $nasabah_pekerjaan->pengalaman_perusahaanlain_nasabah ?? '--',
                'Total Bekerja (Tahun)' => $nasabah_pekerjaan->totalbekerja_tahun_nasabah ?? '--',
                'Total Bekerja (Bulan)' => $nasabah_pekerjaan->totalbekerja_bulan_nasabah ?? '--',
                'Pendidikan Terakhir Nasabah' => $nasabah_pekerjaan->pendidikan_terakhir_nasabah ?? '--',
                'Usia Nasabah' => $nasabah_pekerjaan->usia_nasabah ?? '--',
                'Usia Pra-Pensiun Nasabah' => $nasabah_pekerjaan->usia_prapensiun_nasabah ?? '--',
                'Usia Pensiun Nasabah' => $nasabah_pekerjaan->usia_pensiun_nasabah ?? '--',
                'Sisa Pensiun Nasabah' => $nasabah_pekerjaan->sisa_pensiun_nasabah ?? '--',
                'Nama Atasan Nasabah' => $nasabah_pekerjaan->nama_atasan_nasabah ?? '--',
                'No. Telp Atasan Nasabah' => $nasabah_pekerjaan->notelp_atasan_nasabah ?? '--',
                'Jenis Pekerjaan Atasan Nasabah' => $nasabah_pekerjaan->jenispekerjaan_atasan_nasabah ?? '--',
                'Sumber Penghasilan Nasabah' => $nasabah_pekerjaan->sumber_penghasilan_nasabah ?? '--',
                'Tanggungan Nasabah' => $nasabah_pekerjaan->tanggungan_nasabah ?? '--',
            ];
        @endphp

        @foreach ($capacityPekerjaanNasabah as $label => $value)
            <div class="row mb-1">
                <div class="col-4 fw-bold text-dark d-flex justify-content-between">
                    <span>{{ $label }}</span>
                    <span>:</span>
                </div>
                <div class="col-8 text-dark pl-1">{{ $value }}</div>
            </div>
        @endforeach

        <h6 class="border-bottom pb-2 mt-3">Pekerjaan Pasangan</h6>

        @php
            $capacityPekerjaanPasangan = [
                'Nama Perusahaan Pasangan' => $nasabah_pekerjaan->nama_perusahaan_pasangan ?? '-',
                'Bidang Perusahaan Pasangan' => ucfirst($nasabah_pekerjaan->bidang_perusahaan_pasangan ?? '-'),
                'Skala Perusahaan Pasangan' => ucfirst($nasabah_pekerjaan->skala_perusahaan_pasangan ?? '-'),
                'Jenis Pekerjaan Pasangan' => ucfirst($nasabah_pekerjaan->jenis_pekerjaan_pasangan ?? '-'),
                'Jabatan Pekerjaan Pasangan' => ucfirst($nasabah_pekerjaan->jabatan_pekerjaan_pasangan ?? '-'),
                'Departemen Perusahaan Pasangan' => $nasabah_pekerjaan->dept_perusahaan_pasangan ?? '-',
                'Mulai Bekerja Pasangan' => $nasabah_pekerjaan->mulai_bekerja_pasangan ?? '-',
                'Lama Bekerja Tahun Pasangan' => $nasabah_pekerjaan->lamabekerja_tahun_pasangan ?? '-',
                'Lama Bekerja Bulan Pasangan' => $nasabah_pekerjaan->lamabekerja_bulan_pasangan ?? '-',
                'Pengalaman Perusahaan Pasangan' => ucfirst($nasabah_pekerjaan->pengalaman_perusahaan_pasangan ?? '-'),
                'Total Bekerja Tahun Pasangan' => $nasabah_pekerjaan->totalbekerja_tahun_pasangan ?? '-',
                'Total Bekerja Bulan Pasangan' => $nasabah_pekerjaan->totalbekerja_bulan_pasangan ?? '-',
                'Pendidikan Terakhir Pasangan' => strtoupper($nasabah_pekerjaan->pendidikan_terakhir_pasangan ?? '-'),
                'Usia Pasangan' => ucfirst($nasabah_pekerjaan->usia_pasangan ?? '-'),
                'Usia Prapensiun Pasangan' => $nasabah_pekerjaan->usia_prapensiun_pasangan ?? '-',
                'Usia Pensiun Pasangan' => $nasabah_pekerjaan->usia_pensiun_pasangan ?? '-',
                'Nama Atasan Pasangan' => $nasabah_pekerjaan->nama_atasan_pasangan ?? '-',
                'No. Telp Atasan Pasangan' => $nasabah_pekerjaan->notelp_atasan_pasangan ?? '-',
                'Jenis Pekerjaan Atasan Pasangan' => ucfirst($nasabah_pekerjaan->jenispekerjaan_atasan_pasangan ?? '-'),
                'Alamat Perusahaan Pasangan' => $nasabah_pekerjaan->alamat_perusahaan_pasangan ?? '-',
                'No Telp Perusahaan Pasangan' => $nasabah_pekerjaan->notelp_perusahaan_pasangan ?? '-',
                'Tanggal Penggajian Satu Pasangan' => $nasabah_pekerjaan->penggajian_satu_pasangan ?? '-',
                'Tanggal Penggajian Dua Pasangan' => $nasabah_pekerjaan->penggajian_dua_pasangan ?? '-',
                'Pengalaman Perusahaan Lain Pasangan' => $nasabah_pekerjaan->pengalaman_perusahaanlain_pasangan ?? '-',
            ];
        @endphp

        @foreach ($capacityPekerjaanPasangan as $label => $value)
            <div class="row mb-1">
                <div class="col-4 fw-bold text-dark d-flex justify-content-between">
                    <span>{{ $label }}</span>
                    <span>:</span>
                </div>
                <div class="col-8 text-dark pl-1">{{ $value }}</div>
            </div>
        @endforeach

        <h6 class="border-bottom pb-2 mt-3">Usaha Nasabah/ Pasangan</h6>

        @php
            $capacityUsaha = [
                'Nama Perusahaan Usaha' => $nasabah_pekerjaan->nama_perusahaan_usaha ?? '-',
                'Bidang Perusahaan Usaha' => ucfirst($nasabah_pekerjaan->bidang_perusahaan_usaha ?? '-'),
                'Jabatan Usaha' => ucfirst($nasabah_pekerjaan->jabatan_usaha ?? '-'),
                'Mulai Usaha' => $nasabah_pekerjaan->mulai_usaha ?? '-',
                'Lama Usaha' => $nasabah_pekerjaan->lama_usaha ?? '-',
                'Total Lama Usaha' => $nasabah_pekerjaan->total_lama_usaha ?? '-',
                'Jumlah Karyawan Usaha' => $nasabah_pekerjaan->jumlah_karyawan_usaha ?? '-',
                'Keterangan Tambahan Usaha' => $nasabah_pekerjaan->keterangan_tambahan_usaha ?? '-',
                'Usaha Pensiun' => $nasabah_pekerjaan->usaha_pensiun_usaha ?? '-',
                'Nama Supplier 1' => $nasabah_pekerjaan->nama_suppliersatu_usaha ?? '-',
                'Alamat Supplier 1' => $nasabah_pekerjaan->alamat_suppliersatu_usaha ?? '-',
                'No. Telp Supplier 1' => $nasabah_pekerjaan->notelp_suppliersatu_usaha ?? '-',
                'Nama Supplier 2' => $nasabah_pekerjaan->nama_supplierdua_usaha ?? '-',
                'Alamat Supplier 2' => $nasabah_pekerjaan->alamat_supplierdua_usaha ?? '-',
                'No. Telp Supplier 2' => $nasabah_pekerjaan->notelp_supplierdua_usaha ?? '-',
                'Nama Supplier 3' => $nasabah_pekerjaan->nama_suppliertiga_usaha ?? '-',
                'Alamat Supplier 3' => $nasabah_pekerjaan->alamat_suppliertiga_usaha ?? '-',
                'No. Telp Supplier 3' => $nasabah_pekerjaan->notelp_suppliertiga_usaha ?? '-',
            ];
        @endphp

        @foreach ($capacityUsaha as $label => $value)
            <div class="row mb-1">
                <div class="col-4 fw-bold text-dark d-flex justify-content-between">
                    <span>{{ $label }}</span>
                    <span>:</span>
                </div>
                <div class="col-8 text-dark pl-1">{{ $value }}</div>
            </div>
        @endforeach

        <h6 class="border-bottom pb-2 mt-3">Reputasi Nasabah dalam Pekerjaan</h6>

        @php
            $capacityReputasiPekerjaan = [
                'Memiliki Jabatan Rangkap?' => $pengajuan_capacity->memiliki_jabatan_rangkap ?? '-',
                'Publik Figur?' => $pengajuan_capacity->publik_figur ?? '-',
                'Pemegang Jabatan Tertinggi?' => $pengajuan_capacity->pemegang_jabatan_tertinggi ?? '-',
                'Bukan Pemegang Jabatan Tertinggi?' => $pengajuan_capacity->bukan_pemegang_jabatan_tertinggi ?? '-',
                'Non Jabatan?' => $pengajuan_capacity->non_jabatan ?? '-',
            ];
        @endphp

        @foreach ($capacityReputasiPekerjaan as $label => $value)
            <div class="row mb-1">
                <div class="col-4 fw-bold text-dark d-flex justify-content-between">
                    <span>{{ $label }}</span>
                    <span>:</span>
                </div>
                <div class="col-8 text-dark pl-1">{{ $value }}</div>
            </div>
        @endforeach

        <h6 class="border-bottom pb-2 mt-3">Fasilitas Dinas yang Diterima</h6>

        @php
            $capacityFasilitasDinas = [
                'Mendapat Rumah Dinas?' => $pengajuan_capacity->mendapat_rumah_dinas ?? '-',
                'Mendapat Mobil Dinas?' => $pengajuan_capacity->mendapat_mobil_dinas ?? '-',
                'Mendapat Sepeda Motor Dinas?' => $pengajuan_capacity->mendapat_sepeda_motor_dinas ?? '-',
                'Mendapat Fasilitas Pinjaman Uang?' => $pengajuan_capacity->mendapat_fasilitas_pinjaman_uang ?? '-',
                'Belum Mendapat Fasilitas Dinas?' => $pengajuan_capacity->belum_mendapat_fasilitas_dinas ?? '-',
            ];
        @endphp

        @foreach ($capacityFasilitasDinas as $label => $value)
            <div class="row mb-1">
                <div class="col-4 fw-bold text-dark d-flex justify-content-between">
                    <span>{{ $label }}</span>
                    <span>:</span>
                </div>
                <div class="col-8 text-dark pl-1">{{ $value }}</div>
            </div>
        @endforeach

        <h6 class="border-bottom pb-2 mt-3">Data Rekening Tabungan Nasabah 3 bulan terakhir
        </h6>
        <table class="table table-bordered table-sm w-100 text-center" style="table-layout: fixed;">
            <thead class="small">
                <tr>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0" rowspan="3">
                        Nama Bank Nasabah</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0" rowspan="3">
                        No Account Nasabah</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">
                        Tanggal</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">
                        Saldo Awal</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">
                        Total Debet</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">
                        Total Kredit</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">
                        Saldo Akhir</th>
                </tr>
            </thead>
            <tbody class="small">
                @for ($i = 1; $i <= 3; $i++)
                    <tr>
                        @if ($i == 1)
                            <td class="text-center text-wrap align-middle p-1 m-0" rowspan="3">
                                {{ $pengajuan_capacity->nama_bank_nasabah ?? '-' }}
                            </td>
                            <td class="text-center text-wrap align-middle p-1 m-0" rowspan="3">
                                {{ $pengajuan_capacity->no_bank_account_nasabah ?? '-' }}
                            </td>
                        @endif

                        <td class="text-center text-wrap align-middle p-1 m-0">
                            {{ $pengajuan_capacity->{'tanggal_nasabah_bulan_' . $i}
                                ? \Carbon\Carbon::parse($pengajuan_capacity->{'tanggal_nasabah_bulan_' . $i})->format('d/m/Y')
                                : '-' }}
                        </td>
                        <td class="text-center text-wrap align-middle p-1 m-0">
                            {{ $pengajuan_capacity->{'saldo_awal_nasabah_bulan_' . $i} ?? '-' }}
                        </td>
                        <td class="text-center text-wrap align-middle p-1 m-0">
                            {{ $pengajuan_capacity->{'total_debet_nasabah_bulan_' . $i} ?? '-' }}
                        </td>
                        <td class="text-center text-wrap align-middle p-1 m-0">
                            {{ $pengajuan_capacity->{'total_kredit_nasabah_bulan_' . $i} ?? '-' }}
                        </td>
                        <td class="text-center text-wrap align-middle p-1 m-0">
                            {{ $pengajuan_capacity->{'saldo_akhir_nasabah_bulan_' . $i} ?? '-' }}
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>

        <h6 class="border-bottom pb-2 mt-3">Data Rekening Tabungan Pasangan 3 bulan terakhir
        </h6>
        <table class="table table-bordered table-sm w-100 text-center" style="table-layout: fixed;">
            <thead class="small">
                <tr>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0" rowspan="3">
                        Nama Bank Pasangan</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0" rowspan="3">
                        No Account Pasangan</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">
                        Tanggal</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">
                        Saldo Awal</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">
                        Total Debet</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">
                        Total Kredit</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">
                        Saldo Akhir</th>
                </tr>
            </thead>
            <tbody class="small">
                @for ($i = 1; $i <= 3; $i++)
                    <tr>
                        @if ($i == 1)
                            <td class="text-center text-wrap align-middle p-1 m-0" rowspan="3">
                                {{ $pengajuan_capacity->nama_bank_pasangan ?? '-' }}
                            </td>
                            <td class="text-center text-wrap align-middle p-1 m-0" rowspan="3">
                                {{ $pengajuan_capacity->no_bank_account_pasangan ?? '-' }}
                            </td>
                        @endif

                        <td class="text-center text-wrap align-middle p-1 m-0">
                            {{ $pengajuan_capacity->{'tanggal_pasangan_bulan_' . $i}
                                ? \Carbon\Carbon::parse($pengajuan_capacity->{'tanggal_pasangan_bulan_' . $i})->format('d/m/Y')
                                : '-' }}
                        </td>
                        <td class="text-center text-wrap align-middle p-1 m-0">
                            {{ $pengajuan_capacity->{'saldo_awal_pasangan_bulan_' . $i} ?? '-' }}
                        </td>
                        <td class="text-center text-wrap align-middle p-1 m-0">
                            {{ $pengajuan_capacity->{'total_debet_pasangan_bulan_' . $i} ?? '-' }}
                        </td>
                        <td class="text-center text-wrap align-middle p-1 m-0">
                            {{ $pengajuan_capacity->{'total_kredit_pasangan_bulan_' . $i} ?? '-' }}
                        </td>
                        <td class="text-center text-wrap align-middle p-1 m-0">
                            {{ $pengajuan_capacity->{'saldo_akhir_pasangan_bulan_' . $i} ?? '-' }}
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>

        <h6 class="border-bottom pb-2 mt-3">Hutang/Pinjaman Nasabah</h6>
        <table class="table table-bordered table-sm w-100 text-center" style="table-layout: fixed;">
            <thead class="small">
                <tr>
                    <th style="width: 30px;" class="bg-white align-middle text-wrap p-1 m-0">#</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">
                        Jenis Pinjaman</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">
                        Limit</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">
                        Jangka Waktu</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">Sisa
                        Hutang</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">
                        Kreditur</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">
                        Agunan</th>
                </tr>
            </thead>
            <tbody class="small">
                @foreach ($pengajuan_checking_nasabah as $i => $item)
                    <tr>
                        <td style="width: 30px;" class="text-center text-wrap align-middle p-1 m-0">
                            {{ $i + 1 }}
                        </td>
                        <td class="text-center text-wrap align-middle p-1 m-0">{{ $item->fasilitas_pinjaman_nasabah }}
                        </td>
                        <td class="text-center text-wrap align-middle p-1 m-0">{{ $item->plafond_pinjaman_nasabah }}
                        </td>

                        @php
                            $tanggalRealisasi = $item->tanggal_realisasi_nasabah;
                            $tanggalTempo = $item->tanggal_jatuh_tempo_nasabah;
                            $jangkaWaktu = '-';

                            if ($tanggalRealisasi && $tanggalTempo) {
                                $start = \Carbon\Carbon::parse($tanggalRealisasi);
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

                        <td class="text-center text-wrap align-middle p-1 m-0">{{ $jangkaWaktu }}</td>
                        <td class="text-center text-wrap align-middle p-1 m-0">
                            {{ $item->outstanding_pinjaman_nasabah }}</td>
                        <td class="text-center text-wrap align-middle p-1 m-0">{{ $item->bank_pelapor_nasabah }}</td>
                        <td class="text-center text-wrap align-middle p-1 m-0">{{ $item->agunan_nasabah }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h6 class="border-bottom pb-2 mt-3">Hutang/Pinjaman Pasangan</h6>
        <table class="table table-bordered table-sm w-100 text-center text-center" style="table-layout: fixed;">
            <thead class="small">
                <tr>
                    <th style="width: 30px;" class="bg-white align-middle text-wrap p-1 m-0">#</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">
                        Jenis Pinjaman</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">
                        Limit</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">
                        Jangka Waktu</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">Sisa
                        Hutang</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">
                        Kreditur</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">
                        Agunan</th>
                </tr>
            </thead>
            <tbody class="small">
                @foreach ($pengajuan_checking_pasangan as $i => $item)
                    <tr>
                        <td style="width: 30px;" class="text-center text-wrap align-middle p-1 m-0">
                            {{ $i + 1 }}
                        </td>
                        <td class="text-center text-wrap align-middle p-1 m-0">
                            {{ $item->fasilitas_pinjaman_pasangan }}
                        </td>
                        <td class="text-center text-wrap align-middle p-1 m-0">{{ $item->plafond_pinjaman_pasangan }}
                        </td>

                        @php
                            $tanggalRealisasi = $item->tanggal_realisasi_pasangan;
                            $tanggalTempo = $item->tanggal_jatuh_tempo_pasangan;
                            $jangkaWaktu = '-';

                            if ($tanggalRealisasi && $tanggalTempo) {
                                $start = \Carbon\Carbon::parse($tanggalRealisasi);
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

                        <td class="text-center text-wrap align-middle p-1 m-0">{{ $jangkaWaktu }}</td>
                        <td class="text-center text-wrap align-middle p-1 m-0">
                            {{ $item->outstanding_pinjaman_pasangan }}</td>
                        <td class="text-center text-wrap align-middle p-1 m-0">{{ $item->bank_pelapor_pasangan }}</td>
                        <td class="text-center text-wrap align-middle p-1 m-0">{{ $item->agunan_pasangan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h6 class="border-bottom pb-2 mt-3">Penghasilan dan Pengeluaran
        </h6>

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

        <table class="table table-bordered table-sm w-100 text-center text-center" style="table-layout: fixed;">
            <thead class="small">
                <tr>
                    <td colspan="2" class="text-left p-1" style="color: red">Penghasilan</td>
                </tr>
                <tr>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">
                        Penghasilan</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">
                        Jumlah per bulan
                        (Rp.)</th>
                </tr>
            </thead>
            <tbody class="small" id="penghasilan-section">
                @foreach ($penghasilan_fields as $field)
                    <tr>
                        <td class="align-middle text-left p-1">
                            {{ $field['label'] }}</td>
                        <td class="p-1">
                            <input type="number" step="0.01" name="{{ $field['name'] }}"
                                class="form-control border-0 bg-white text-dark align-middle text-center form-control-sm penghasilan-input"
                                value="{{ old($field['name'], $pengajuan_capacity->{$field['name']}) }}"
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

            <thead class="small">
                <tr class="bg-light font-weight-bold">
                    <td colspan="2" class="text-left p-1" style="color: red">Pengeluaran</td>
                </tr>
                <tr>
                    <th class="align-middle bg-white p-2">Pengeluaran</th>
                    <th class="align-middle bg-white p-2">Jumlah per bulan
                        (Rp.)</th>
                </tr>
            </thead>
            <tbody class="small" id="pengeluaran-section">
                @foreach ($pengeluaran_fields as $field)
                    <tr>
                        <td class="align-middle text-left p-1">
                            {{ $field['label'] }}</td>
                        <td class="p-1">
                            <input type="number" step="0.01" name="{{ $field['name'] }}"
                                class="form-control border-0 bg-white text-dark align-middle text-center form-control-sm pengeluaran-input"
                                value="{{ old($field['name'], $pengajuan_capacity->{$field['name']}) }}"
                                oninput="hitungTotal()">
                        </td>
                    </tr>
                @endforeach
                <tr class="font-weight-bold">
                    <td class="text-start p-2">Total Pengeluaran</td>
                    <td class="text-end p-2" id="total-pengeluaran">Rp. 0,00
                    </td>
                </tr>
                <tr class="font-weight-bold">
                    <td class="text-start p-2">Penghasilan Bersih</td>
                    <td class="text-end p-2" id="penghasilan-bersih">Rp.
                        0,00
                    </td>
                </tr>
            </tbody>
        </table>

        <h6 class="border-bottom pb-2 mt-3">Permohonan Pembiayaan</h6>
        @php
            // Ambil data dasar
            $jangkaTahun = $pengajuan->permohonan_jangka_waktu_pembiayaan ?? 0;
            $jangkaBulan = $jangkaTahun * 12;

            $marginPerBulan = $pengajuan->permohonan_margin_bank ?? 0;
            $hargaBeliBank = $pengajuan->permohonan_harga_beli_bank ?? 0;

            $marginPerTahun = $marginPerBulan * $jangkaTahun;
            $nominalMargin = ($marginPerTahun / 100) * $hargaBeliBank;
            $hargaJualBank = $hargaBeliBank + $nominalMargin;
            $angsuranPerBulan = $jangkaBulan > 0 ? $hargaJualBank / $jangkaBulan : 0;

            // Bangun array final
            $capitalPermohonanPembiayaan = [
                'Jenis Akad' => $pengajuan->permohonan_jenis_akad ?? '--',
                'Jenis Pembiayaan' => $pengajuan->permohonan_jenis_pembiayaan ?? '--',
                'Tujuan Penggunaan' => $pengajuan->permohonan_tujuan_penggunaan ?? '--',
                'Harga Beli Bank' => $pengajuan->permohonan_harga_beli_bank ?? '--',
                'Jangka Waktu Pembiayaan (tahun)' => $jangkaTahun ?: '--',
                'Jangka Waktu (bulan)' => $jangkaBulan ?: '--',
                'Margin Bank (% per bulan)' => $marginPerBulan ?: '--',
                'Margin Bank per Tahun' => $jangkaTahun > 0 ? number_format($marginPerTahun, 2, ',', '.') . '%' : '--',
                'Nominal Margin Bank' => $nominalMargin > 0 ? 'Rp ' . number_format($nominalMargin, 2, ',', '.') : '--',
                'Harga Jual Bank' => $hargaJualBank > 0 ? 'Rp ' . number_format($hargaJualBank, 2, ',', '.') : '--',
                'Angsuran Bank' => $angsuranPerBulan > 0 ? 'Rp ' . number_format($angsuranPerBulan, 2, ',', '.') : '--',
            ];
        @endphp

        @foreach ($capitalPermohonanPembiayaan as $label => $value)
            <div class="row mb-1">
                <div class="col-4 fw-bold text-dark d-flex justify-content-between">
                    <span>{{ $label }}</span>
                    <span>:</span>
                </div>
                <div class="col-8 text-dark pl-1">{{ $value }}</div>
            </div>
        @endforeach

        <h6 class="border-bottom pb-2 mt-3">Pembiayaan Berdasarkan Net Income
        </h6>

        <div class="row g-3 mb-3">
            <div class="col-6">Harga beli Bank/ Pembiayaan</div>
            <div class="col-6 text-left" id="netincome_harga_beli_bank">
                Rp. 0,00
            </div>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-6">Margin Bank</div>
            <div class="col-6 text-left" id="netincome_margin_bank">
                Rp. 0,00
            </div>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-6">
                <label for="netincome_jangka_waktu_pembiayaan">Jangka Waktu Pembiayaan
                    (Tahun)</label>
            </div>
            <div class="col-6">
                <input disabled type="text" class="form-control border-0 bg-white text-left p-0 m-0"
                    id="netincome_jangka_waktu_pembiayaan" name="netincome_jangka_waktu_pembiayaan"
                    value="{{ ': ' . $pengajuan->permohonan_jangka_waktu_pembiayaan . ' tahun' }}"
                    oninput="hitungHargaJual()">
            </div>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-6">Jangka Waktu Pembiayaan
                (Bulan)</div>
            <div class="col-6 text-left" id="netincome_jangka_waktu_bulan">12
            </div>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-6">Angsuran Per Bulan</div>
            <div class="col-6 text-left" id="netincome_angsuran_per_bulan">Rp.
                0,00</div>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-6">Repayment Capacity (kemampuan gaji
                nasabah membayar
                angsuran)</div>
            <div class="col-6 text-left" id="netincome_repayment">1
            </div>
        </div>

        <h6 class="border-bottom pb-2 mt-3">Pembiayaan Berdasarkan Analis
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
                    class="form-control border-0 bg-white text-dark text-left p-0 pl-2 py-1 m-0"
                    id="analis_harga_beli_bank" name="analis_harga_beli_bank"
                    value="{{ old('analis_harga_beli_bank', $pengajuan_capacity->analis_harga_beli_bank ?? '') }}"
                    oninput="hitungAngsuranAnalis()">

            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-6">Margin Bank</div>
            <div class="col-6">
                <input type="hidden" id="analis_margin_bank_from_db"
                    value="{{ $pengajuan_capacity->analis_margin_bank ? '1' : '0' }}">
                <input type="hidden" id="save_analis_margin_bank_from_db" name="save_analis_margin_bank_from_db"
                    value="">

                <input type="number" step="0.01"
                    class="form-control border-0 bg-white text-dark text-left p-0 pl-2 py-1 m-0"
                    id="analis_margin_bank" name="analis_margin_bank"
                    value="{{ old('analis_margin_bank', $pengajuan_capacity->analis_margin_bank ?? '') }}"
                    oninput="hitungAngsuranAnalis()">
            </div>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-6">
                <label for="analis_jangka_waktu_pembiayaan">Jangka Waktu Pembiayaan
                    (Tahun)</label>
            </div>
            <div class="col-6">
                <input type="text" class="form-control border-0 bg-white text-dark text-left p-0 pl-2 py-1 m-0"
                    id="analis_jangka_waktu_pembiayaan" name="analis_jangka_waktu_pembiayaan"
                    value="{{ ($pengajuan_capacity->analis_jangka_waktu_pembiayaan ?? '') !== '' ? $pengajuan_capacity->analis_jangka_waktu_pembiayaan : $pengajuan->permohonan_jangka_waktu_pembiayaan ?? '' }}"
                    oninput="hitungAngsuranAnalis()">
            </div>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-6">Jangka Waktu Pembiayaan
                (Bulan)</div>
            <div class="col-6 text-left" id="analis_jangka_waktu_bulan">12
            </div>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-6">
                <label for="analis_angsuran_per_bulan">Angsuran Per Bulan</label>
            </div>
            <div class="col-6">
                <input disabled type="text" class="form-control border-0 bg-white text-dark p-0 py-1 m-0"
                    id="analis_angsuran_per_bulan" name="analis_angsuran_per_bulan">
            </div>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-6">Repayment Capacity (kemampuan gaji
                nasabah membayar
                angsuran)</div>
            <div class="col-6 text-left" id="analis_repayment">1
            </div>
        </div>
        {{-- End Capacity --}}

        {{-- Start Capital --}}
        <h5 class="mb-0 py-1 mt-3">CAPITAL</h5>
        <h6 class="border-bottom pb-2">Aktiva Lancar</h6>

        <table class="table table-bordered table-sm w-100 text-center" style="table-layout: fixed;">
            <thead class="small">
                <tr>
                    <th style="width: 30px;" class="bg-white align-middle text-wrap p-1 m-0">#</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">
                        Keterangan</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">
                        Nilai (Rp.)</th>
                </tr>
            </thead>
            <tbody class="small">
                @foreach ($pengajuan_aset_aktivalancar as $i => $item)
                    <tr>
                        <td style="width: 30px;" class="text-center text-wrap align-middle p-1 m-0">
                            {{ $i + 1 }}
                        </td>
                        <td class="text-center text-wrap align-middle p-1 m-0">{{ $item->aktiva_lancar_keterangan }}
                        </td>
                        <td class="text-center text-wrap align-middle p-1 m-0">
                            {{ $item->aktiva_lancar_nilai }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h6 class="border-bottom pb-2">Tanah dan Bangunan</h6>

        <table class="table table-bordered table-sm w-100 text-center" style="table-layout: fixed;">
            <thead class="small">
                <tr>
                    <th style="width: 30px;" class="bg-white align-middle text-wrap p-1 m-0">#</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">
                        Lokasi</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">
                        Luas T/B</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">
                        Status</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">
                        Atas Nama</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">
                        Nilai (Rp.)</th>
                </tr>
            </thead>
            <tbody class="small">
                @foreach ($pengajuan_aset_tanahbangunan as $i => $item)
                    <tr>
                        <td style="width: 30px;" class="text-center text-wrap align-middle p-1 m-0">
                            {{ $i + 1 }}
                        </td>
                        <td class="text-center text-wrap align-middle p-1 m-0">{{ $item->tanah_lokasi }}
                        </td>
                        <td class="text-center text-wrap align-middle p-1 m-0">{{ $item->tanah_luas_tanah_bangunan }}
                        </td>
                        <td class="text-center text-wrap align-middle p-1 m-0">{{ $item->tanah_status }}
                        </td>
                        <td class="text-center text-wrap align-middle p-1 m-0">{{ $item->tanah_atas_nama }}
                        </td>
                        <td class="text-center text-wrap align-middle p-1 m-0">{{ $item->tanah_nilai }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h6 class="border-bottom pb-2">Kendaraan</h6>

        <table class="table table-bordered table-sm w-100 text-center" style="table-layout: fixed;">
            <thead class="small">
                <tr>
                    <th style="width: 30px;" class="bg-white align-middle text-wrap p-1 m-0">#</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">
                        Jenis/Merek</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">
                        Tahun Pembuatan</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">
                        Atas Nama</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">
                        Nilai (Rp.)</th>
                </tr>
            </thead>
            <tbody class="small">
                @foreach ($pengajuan_aset_kendaraan as $i => $item)
                    <tr>
                        <td style="width: 30px;" class="text-center text-wrap align-middle p-1 m-0">
                            {{ $i + 1 }}
                        </td>
                        <td class="text-center text-wrap align-middle p-1 m-0">{{ $item->kendaraan_jenis_merek }}
                        </td>
                        <td class="text-center text-wrap align-middle p-1 m-0">{{ $item->kendaraan_tahun_pembuatan }}
                        </td>
                        <td class="text-center text-wrap align-middle p-1 m-0">{{ $item->kendaraan_atas_nama }}
                        </td>
                        <td class="text-center text-wrap align-middle p-1 m-0">{{ $item->kendaraan_nilai }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h6 class="border-bottom pb-2">Lain - lain (Emas,Saham, Obligasi, dll)</h6>

        <table class="table table-bordered table-sm w-100 text-center" style="table-layout: fixed;">
            <thead class="small">
                <tr>
                    <th style="width: 30px;" class="bg-white align-middle text-wrap p-1 m-0">#</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">
                        Jenis</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">
                        Lokasi</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">
                        Atas Nama</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">
                        Nilai (Rp.)</th>
                </tr>
            </thead>
            <tbody class="small">
                @foreach ($pengajuan_aset_lainnya as $i => $item)
                    <tr>
                        <td style="width: 30px;" class="text-center text-wrap align-middle p-1 m-0">
                            {{ $i + 1 }}
                        </td>
                        <td class="text-center text-wrap align-middle p-1 m-0">{{ $item->lain_jenis }}
                        <td class="text-center text-wrap align-middle p-1 m-0">{{ $item->lain_lokasi }}
                        <td class="text-center text-wrap align-middle p-1 m-0">{{ $item->lain_atas_nama }}
                        <td class="text-center text-wrap align-middle p-1 m-0">{{ $item->lain_nilai }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h6 class="border-bottom pb-2 mt-3">Permohonan Pembiayaan</h6>
        @php
            // Ambil data dasar
            $jangkaTahun = $pengajuan->permohonan_jangka_waktu_pembiayaan ?? 0;
            $jangkaBulan = $jangkaTahun * 12;

            $marginPerBulan = $pengajuan->permohonan_margin_bank ?? 0;
            $hargaBeliBank = $pengajuan->permohonan_harga_beli_bank ?? 0;

            $marginPerTahun = $marginPerBulan * $jangkaTahun;
            $nominalMargin = ($marginPerTahun / 100) * $hargaBeliBank;
            $hargaJualBank = $hargaBeliBank + $nominalMargin;
            $angsuranPerBulan = $jangkaBulan > 0 ? $hargaJualBank / $jangkaBulan : 0;

            // Bangun array final
            $capitalPermohonanPembiayaan = [
                'Jenis Akad' => $pengajuan->permohonan_jenis_akad ?? '--',
                'Jenis Pembiayaan' => $pengajuan->permohonan_jenis_pembiayaan ?? '--',
                'Tujuan Penggunaan' => $pengajuan->permohonan_tujuan_penggunaan ?? '--',
                'Harga Beli Bank' => $pengajuan->permohonan_harga_beli_bank ?? '--',
                'Jangka Waktu Pembiayaan (tahun)' => $jangkaTahun ?: '--',
                'Jangka Waktu (bulan)' => $jangkaBulan ?: '--',
                'Margin Bank (% per bulan)' => $marginPerBulan ?: '--',
                'Margin Bank per Tahun' => $jangkaTahun > 0 ? number_format($marginPerTahun, 2, ',', '.') . '%' : '--',
                'Nominal Margin Bank' => $nominalMargin > 0 ? 'Rp ' . number_format($nominalMargin, 2, ',', '.') : '--',
                'Harga Jual Bank' => $hargaJualBank > 0 ? 'Rp ' . number_format($hargaJualBank, 2, ',', '.') : '--',
                'Angsuran Bank' => $angsuranPerBulan > 0 ? 'Rp ' . number_format($angsuranPerBulan, 2, ',', '.') : '--',
            ];
        @endphp

        @foreach ($capitalPermohonanPembiayaan as $label => $value)
            <div class="row mb-1">
                <div class="col-4 fw-bold text-dark d-flex justify-content-between">
                    <span>{{ $label }}</span>
                    <span>:</span>
                </div>
                <div class="col-8 text-dark pl-1">{{ $value }}</div>
            </div>
        @endforeach
        {{-- End Capital --}}

        {{-- Start Collateral SK --}}
        <h5 class="mb-0 py-1 mt-3">COLLATERAL SK</h5>
        <h6 class="border-bottom pb-2">Scooring Collateral SK</h6>

        @php
            $collateralskScooring = [
                'Perjanjian Kerjasama' => $nasabah_pekerjaan->perjanjian_kerjasama_nasabah ?? '--',
                'SK Pengangkatan Pegawai Tetap' => $pengajuan_collateralsk->sk_pengangkatan_pegawai_tetap ?? '--',
                'SK Jabatan Terakhir Terkini' => $pengajuan_collateralsk->sk_jabatan_terakhir_terkini ?? '--',
            ];
        @endphp

        @foreach ($collateralskScooring as $label => $value)
            <div class="row mb-1">
                <div class="col-4 fw-bold text-dark d-flex justify-content-between">
                    <span>{{ $label }}</span>
                    <span>:</span>
                </div>
                <div class="col-8 text-dark pl-1">{{ $value }}</div>
            </div>
        @endforeach
        {{-- End Collateral SK --}}

        {{-- Start Collateral Properti --}}
        <h5 class="mb-0 py-1 mt-3">COLLATERAL PROPERTI</h5>
        <h6 class="border-bottom pb-2">Legalitas Obyek/ Agunan Pembiayaan</h6>
        @php
            $collateralpropertiLegalitasObyek = [
                'Jenis Sertifikat Hak' => $pengajuan_collateralproperti->jenis_sertifikat_hak ?? '-',
                'Nomor Sertifikat' => $pengajuan_collateralproperti->nomor_sertifikat ?? '-',
                'Tanggal Penerbitan' => $pengajuan_collateralproperti->tanggal_penerbitan
                    ? \Carbon\Carbon::parse($pengajuan_collateralproperti->tanggal_penerbitan)->format('d/m/Y')
                    : '-',
                'Instansi yang Menerbitkan' => $pengajuan_collateralproperti->instansi_yang_menerbitkan ?? '-',
                'Nama Pemegang Hak' => $pengajuan_collateralproperti->nama_pemegang_hak ?? '-',
                'Lama & Tgl Akhir Hak Berlaku' => $pengajuan_collateralproperti->lama_tgl_akhir_hak_berlaku ?? '-',
                'Surat Ukur Nomor' => $pengajuan_collateralproperti->surat_ukur_nomor ?? '-',
                'Tanggal Ukur' => $pengajuan_collateralproperti->tanggal_ukur
                    ? \Carbon\Carbon::parse($pengajuan_collateralproperti->tanggal_ukur)->format('d/m/Y')
                    : '-',
                'Asal Agunan' => $pengajuan_collateralproperti->asal_agunan ?? '-',
                'Luas Agunan' => $pengajuan_collateralproperti->luas_agunan ?? '-',
                'Letak Agunan' => $pengajuan_collateralproperti->letak_agunan ?? '-',
                'Batas Utara Agunan' => $pengajuan_collateralproperti->batas_utara_agunan ?? '-',
                'Batas Timur Agunan' => $pengajuan_collateralproperti->batas_timur_agunan ?? '-',
                'Batas Selatan Agunan' => $pengajuan_collateralproperti->batas_selatan_agunan ?? '-',
                'Batas Barat Agunan' => $pengajuan_collateralproperti->batas_barat_agunan ?? '-',
            ];
        @endphp

        @foreach ($collateralpropertiLegalitasObyek as $label => $value)
            <div class="row mb-1">
                <div class="col-4 fw-bold text-dark d-flex justify-content-between">
                    <span>{{ $label }}</span>
                    <span>:</span>
                </div>
                <div class="col-8 text-dark pl-1">{{ $value }}</div>
            </div>
        @endforeach

        <h6 class="border-bottom pb-2 mt-3">Keterangan Kondisi Agunan</h6>
        @php
            $collateralpropertiKondisiAgunan = [
                'Aksesibilitas Lokasi Agunan' => ucfirst(
                    $pengajuan_collateralproperti->aksesibilitas_lokasi_agunan ?? '-',
                ),
                'Keadaan Lingkungan Agunan (Tanah)' => ucfirst(
                    $pengajuan_collateralproperti->keterangan_lingkungan_agunan_tanah ?? '-',
                ),
                'Keadaan Lingkungan Agunan (Kawasan)' => ucfirst(
                    $pengajuan_collateralproperti->keterangan_lingkungan_agunan_kawasan ?? '-',
                ),
                'Penggunaan Agunan Saat Ini' => ucfirst(
                    $pengajuan_collateralproperti->penggunaan_agunan_saat_ini ?? '-',
                ),
                'Harga Sewa per Tahun' => $pengajuan_collateralproperti->harga_sewa_per_tahun
                    ? 'Rp. ' . number_format($pengajuan_collateralproperti->harga_sewa_per_tahun, 0, ',', '.')
                    : '-',
                'Akses Jalan ke Jalan Besar' => ucfirst(
                    $pengajuan_collateralproperti->agunan_punya_akses_jalan_besar ?? '-',
                ),
                'Termasuk Aktiva Warisan Belum Dibagi' =>
                    $pengajuan_collateralproperti->agunan_aktiva_warisan_belum_dibagi ?? '-',
            ];
        @endphp

        @foreach ($collateralpropertiKondisiAgunan as $label => $value)
            <div class="row mb-1">
                <div class="col-4 fw-bold text-dark d-flex justify-content-between">
                    <span>{{ $label }}</span>
                    <span>:</span>
                </div>
                <div class="col-8 text-dark pl-1">{{ $value }}</div>
            </div>
        @endforeach

        <h6 class="border-bottom pb-2 mt-3">Bangunan di atas Agunan</h6>
        @php
            $collateralpropertiBangunanAgunan = [
                'IMB (Izin Mendirikan Bangunan)' => $pengajuan_collateralproperti->memiliki_imb ?? '-',
                'Tahun Pembuatan Bangunan' => $pengajuan_collateralproperti->tahun_pembuatan_bangunan ?? '-',
                'Perkiraan Biaya Pembangunan (Rp)' => $pengajuan_collateralproperti->perkiraan_biaya_pembangunan
                    ? 'Rp. ' . number_format($pengajuan_collateralproperti->perkiraan_biaya_pembangunan, 0, ',', '.')
                    : '-',
                'Keterangan Konstruksi Bangunan' =>
                    $pengajuan_collateralproperti->keterangan_konstruksi_bangunan ?? '-',
                'Luas Efektif (m²)' => $pengajuan_collateralproperti->luas_efektif ?? '-',
                'Jumlah Lantai' => $pengajuan_collateralproperti->jumlah_lantai ?? '-',
                'Pondasi' => $pengajuan_collateralproperti->pondasi ?? '-',
                'Lantai' => $pengajuan_collateralproperti->lantai ?? '-',
                'Konstruksi' => $pengajuan_collateralproperti->konstruksi ?? '-',
                'Dinding' => $pengajuan_collateralproperti->dinding ?? '-',
                'Dinding Pemisah' => $pengajuan_collateralproperti->dinding_pemisah ?? '-',
                'Kusen' => $pengajuan_collateralproperti->kusen ?? '-',
                'Pintu' => $pengajuan_collateralproperti->pintu ?? '-',
                'Jendela/Ventilasi' => $pengajuan_collateralproperti->jendela_ventilasi ?? '-',
                'Plafond' => $pengajuan_collateralproperti->plafond ?? '-',
                'Konstruksi Atap' => $pengajuan_collateralproperti->konstruksi_atap ?? '-',
                'Penutup Atap' => $pengajuan_collateralproperti->penutup_atap ?? '-',
                'Instalasi Air' => $pengajuan_collateralproperti->instalasi_air ?? '-',
                'Instalasi Listrik' => $pengajuan_collateralproperti->instalasi_listrik ?? '-',
                'Perawatan' => $pengajuan_collateralproperti->perawatan ?? '-',
                'Kondisi Sarana dan Emplasemen' => $pengajuan_collateralproperti->kondisi_sarana_dan_emplasemen ?? '-',
                'Informasi Lain tentang Kondisi Bangunan' =>
                    $pengajuan_collateralproperti->informasi_lain_kondisi_bangunan ?? '-',
            ];
        @endphp

        @foreach ($collateralpropertiBangunanAgunan as $label => $value)
            <div class="row mb-1">
                <div class="col-4 fw-bold text-dark d-flex justify-content-between">
                    <span>{{ $label }}</span>
                    <span>:</span>
                </div>
                <div class="col-8 text-dark pl-1">{{ $value }}</div>
            </div>
        @endforeach

        <h6 class="border-bottom pb-2 mt-3">Marketabilitas Agunan</h6>
        @php
            $collateralpropertiMarketabilitasAgunan = [
                'Lokasi Perumahan' => $pengajuan_collateralproperti->lokasi_perumahan ?? '-',
                'Kenyamanan' => $pengajuan_collateralproperti->kenyamanan ?? '-',
                'Lokasi Agunan' => $pengajuan_collateralproperti->lokasi_agunan ?? '-',
                'Jarak Fasum/Fasos' => $pengajuan_collateralproperti->jarak_fasum_fasos ?? '-',
                'Fasilitas Perumahan' => $pengajuan_collateralproperti->fasilitas_perumahan ?? '-',
                'Jenis Jalan Lingkungan' => $pengajuan_collateralproperti->jenis_jalan_lingkungan ?? '-',
                'Jarak ke Jalan Provinsi' => $pengajuan_collateralproperti->jarak_ke_jalan_provinsi ?? '-',
                'Jenis dan Kondisi Jalan' => $pengajuan_collateralproperti->jenis_dan_kondisi_jalan ?? '-',
                'Kondisi Jalan ke Kota' => $pengajuan_collateralproperti->kondisi_jalan_ke_kota ?? '-',
                'Resiko Bencana Hidup' => $pengajuan_collateralproperti->resiko_bencana_hidup ?? '-',
                'Kontribusi Pemohon DP' => $pengajuan_collateralproperti->kontribusi_pemohon_dp ?? '-',
                'Pertumbuhan Agunan' => $pengajuan_collateralproperti->pertumbuhan_agunan ?? '-',
                'Kondisi Wilayah Agunan' => $pengajuan_collateralproperti->kondisi_wilayah_agunan ?? '-',
            ];
        @endphp

        @foreach ($collateralpropertiMarketabilitasAgunan as $label => $value)
            <div class="row mb-1">
                <div class="col-4 fw-bold text-dark d-flex justify-content-between">
                    <span>{{ $label }}</span>
                    <span>:</span>
                </div>
                <div class="col-8 text-dark pl-1">{{ $value }}</div>
            </div>
        @endforeach
        {{-- End Collateral Properti --}}

        {{-- Start Collateral Bermotor --}}
        <h5 class="mb-0 py-1 mt-3">COLLATERAL BERMOTOR</h5>
        <h6 class="border-bottom pb-2">Scooring Kendaraan Bermotor</h6>
        @php
            $collateralbermotorScooring = [
                'Tujuan Penggunaan' => $pengajuan_collateralbermotor->tujuan_penggunaan ?? '-',
                'Jenis Kendaraan' => $pengajuan_collateralbermotor->jenis_kendaraan ?? '-',
                'Status Agunan Kendaraan' => $pengajuan_collateralbermotor->status_agunan_kendaraan ?? '-',
                'Nomor STNK Agunan' => $pengajuan_collateralbermotor->nomor_stnk_agunan ?? '-',
                'Nama Pemilik Agunan' => $pengajuan_collateralbermotor->nama_pemilik_agunan ?? '-',
                'Alamat Pemilik Agunan' => $pengajuan_collateralbermotor->alamat_pemilik_agunan ?? '-',
                'Merk Agunan' => $pengajuan_collateralbermotor->merk_agunan ?? '-',
                'Tipe Agunan' => $pengajuan_collateralbermotor->tipe_agunan ?? '-',
                'Teknologi' => $pengajuan_collateralbermotor->teknologi ?? '-',
                'Bahan Bakar' => $pengajuan_collateralbermotor->bahan_bakar ?? '-',
                'Warna Agunan' => $pengajuan_collateralbermotor->warna_agunan ?? '-',
                'Isi Silinder' => $pengajuan_collateralbermotor->isi_silinder ?? '-',
                'Nomor Rangka Agunan' => $pengajuan_collateralbermotor->nomor_rangka_agunan ?? '-',
                'Nomor Mesin Agunan' => $pengajuan_collateralbermotor->nomor_mesin_agunan ?? '-',
                'Tahun Pembuatan' => $pengajuan_collateralbermotor->tahun_pembuatan ?? '-',
                'Masa Berlaku' => $pengajuan_collateralbermotor->masa_berlaku ?? '-',
            ];
        @endphp

        @foreach ($collateralbermotorScooring as $label => $value)
            <div class="row mb-1">
                <div class="col-4 fw-bold text-dark d-flex justify-content-between">
                    <span>{{ $label }}</span>
                    <span>:</span>
                </div>
                <div class="col-8 text-dark pl-1">{{ $value }}</div>
            </div>
        @endforeach
        {{-- End Collateral Bermotor --}}

        {{-- Start Condition --}}
        <h5 class="mb-0 py-1 mt-3">CONDITION</h5>
        <h6 class="border-bottom pb-2">Scooring Condition of Economy</h6>

        @php
            $conditionScooring = [
                'Apakah usaha atau perusahaan tempat nasabah mampu bertahan dalam persaingan di Indonesia dilihat dari lamanya perusahaan berdiri?' =>
                    $pengajuan_condition->ketahanan_usaha_berdiri ?? '-',
                'Apakah bidang pekerjaan atau bidang usaha nasabah termasuk bidang usaha yang jarang ditemukan di Indonesia?' =>
                    $pengajuan_condition->bidang_usaha_langka ?? '-',
                'Apakah cakupan wilayah perusahaan dan usaha nasabah luas dilihat dari skala usaha semakin besar skala usaha maka semakin mampu bertahan' =>
                    $pengajuan_condition->cakupan_wilayah_skala_usaha ?? '-',
            ];
        @endphp

        @foreach ($conditionScooring as $label => $value)
            <div class="row mb-1">
                <div class="col-4 fw-bold text-dark d-flex justify-content-between">
                    <span>{{ $label }}</span>
                    <span>:</span>
                </div>
                <div class="col-8 text-dark pl-1">{{ $value }}</div>
            </div>
        @endforeach
        {{-- End Condition --}}

        {{-- Start Dokumentasi --}}
        <h5 class="mb-0 py-1 mt-3">DOKUMENTASI</h5>
        <h6 class="border-bottom pb-2">Dokumentasi Identitas</h6>
        @php
            $dokumentasiIdentitas = [
                'Foto Nasabah' => $pengajuan_dokumentasi->foto_nasabah ?? null,
                'Foto Identitas Nasabah (KTP/SIM)' => $pengajuan_dokumentasi->foto_identitas_nasabah ?? null,
                'NPWP Nasabah' => $pengajuan_dokumentasi->npwp_nasabah ?? null,
                'Foto Pasangan' => $pengajuan_dokumentasi->foto_pasangan ?? null,
                'Foto Identitas Pasangan (KTP/SIM)' => $pengajuan_dokumentasi->foto_identitas_pasangan ?? null,
                'NPWP Pasangan' => $pengajuan_dokumentasi->npwp_pasangan ?? null,
            ];
        @endphp

        <div class="row">
            @foreach ($dokumentasiIdentitas as $label => $filename)
                @if ($filename)
                    <div class="col-6 mb-3 text-end">
                        <div class="fw-bold mb-1">{{ $label }}</div>
                        <img src="{{ asset('storage/uploads/multiguna/' . $filename) }}" alt="{{ $label }}"
                            style="max-width: 180px; height: auto;" class="img-fluid border rounded shadow-sm">
                    </div>
                @endif
            @endforeach
        </div>

        <h6 class="border-bottom pb-2">Dokumentasi Capacity</h6>
        @php
            $dokumentasiCapacity = [
                'Slip Gaji Nasabah' => $pengajuan_dokumentasi->slip_gaji_nasabah ?? null,
                'Slip Gaji Pasangan' => $pengajuan_dokumentasi->slip_gaji_pasangan ?? null,
                'Rekening Gaji/Payroll/Aktif Nasabah' => $pengajuan_dokumentasi->rekening_gaji_nasabah ?? null,
                'Rekening Gaji/Payroll/Aktif Pasangan' => $pengajuan_dokumentasi->rekening_gaji_pasangan ?? null,
                'Tempat Kerja/Usaha Nasabah' => $pengajuan_dokumentasi->tempat_kerja_usaha_nasabah ?? null,
                'Tempat Kerja/Usaha Pasangan' => $pengajuan_dokumentasi->tempat_kerja_usaha_pasangan ?? null,
                'Foto Surat Pegawai Tetap Nasabah' => $pengajuan_dokumentasi->foto_surat_pegawai_tetap_nasabah ?? null,
                'Foto Surat Pegawai Tetap Pasangan' =>
                    $pengajuan_dokumentasi->foto_surat_pegawai_tetap_pasangan ?? null,
                'Foto Tabungan Nasabah 3 Bulan Terakhir' =>
                    $pengajuan_dokumentasi->foto_tabungan_nasabah_3_bln_terakhir ?? null,
                'Foto Tabungan Pasangan 3 Bulan Terakhir' =>
                    $pengajuan_dokumentasi->foto_tabungan_pasangan_3_bln_terakhir ?? null,
            ];
        @endphp

        <div class="row">
            @foreach ($dokumentasiCapacity as $label => $filename)
                @if ($filename)
                    <div class="col-6 mb-3 text-end">
                        <div class="fw-bold mb-1">{{ $label }}</div>
                        <img src="{{ asset('storage/uploads/multiguna/' . $filename) }}" alt="{{ $label }}"
                            style="max-width: 180px; height: auto;" class="img-fluid border rounded shadow-sm">
                    </div>
                @endif
            @endforeach
        </div>

        <h6 class="border-bottom pb-2">Dokumentasi Collateral</h6>
        @php
            $dokumentasiCollateral = [
                'Foto Depan Agunan' => $pengajuan_dokumentasi->foto_depan_agunan ?? null,
                'Foto Bagian Dalam Agunan' => $pengajuan_dokumentasi->foto_dalam_agunan ?? null,
                'Foto Sebelah Barat Agunan' => $pengajuan_dokumentasi->foto_barat_agunan ?? null,
                'Foto Sebelah Utara Agunan' => $pengajuan_dokumentasi->foto_utara_agunan ?? null,
                'Foto Sebelah Timur Agunan' => $pengajuan_dokumentasi->foto_timur_agunan ?? null,
                'Foto Sebelah Selatan Agunan' => $pengajuan_dokumentasi->foto_selatan_agunan ?? null,
                'Jika KPM maka foto jaminan kendaraan depan' => $pengajuan_dokumentasi->foto_jaminan_depan_kpm ?? null,
                'Jika KPM maka foto jaminan kendaraan samping' =>
                    $pengajuan_dokumentasi->foto_jaminan_samping_kpm ?? null,
                'Jika KPM maka foto jaminan kendaraan atas' => $pengajuan_dokumentasi->foto_jaminan_atas_kpm ?? null,
                'Jika KPM maka foto jaminan kendaraan rangka mesin' =>
                    $pengajuan_dokumentasi->foto_jaminan_rangka_mesin_kpm ?? null,
            ];
        @endphp

        <div class="row">
            @foreach ($dokumentasiCollateral as $label => $filename)
                @if ($filename)
                    <div class="col-6 mb-3 text-end">
                        <div class="fw-bold mb-1">{{ $label }}</div>
                        <img src="{{ asset('storage/uploads/multiguna/' . $filename) }}" alt="{{ $label }}"
                            style="max-width: 180px; height: auto;" class="img-fluid border rounded shadow-sm">
                    </div>
                @endif
            @endforeach
        </div>
        {{-- End Dokumentasi --}}

        {{-- Start Keputusan Pembiayaan --}}
        <h5 class="border-bottom mb-0 py-1 mt-3">KEPUTUSAN PEMBIAYAAN</h5>

        @php
            // Ambil data dasar
            $jangkaTahun = $pengajuan->keputusan_jangka_waktu_pembiayaan ?? 0;
            $jangkaBulan = $jangkaTahun * 12;

            $marginPerBulan = $pengajuan->keputusan_margin_bank ?? 0;
            $hargaBeliBank = $pengajuan->keputusan_harga_beli_bank ?? 0;

            $marginPerTahun = $marginPerBulan * $jangkaTahun;
            $nominalMargin = ($marginPerTahun / 100) * $hargaBeliBank;
            $hargaJualBank = $hargaBeliBank + $nominalMargin;
            $angsuranPerBulan = $jangkaBulan > 0 ? $hargaJualBank / $jangkaBulan : 0;

            // Bangun array final
            $keputusanPembiayaan = [
                'Jenis Akad' => $pengajuan->keputusan_jenis_akad ?? '--',
                'Jenis Pembiayaan' => $pengajuan->keputusan_jenis_pembiayaan ?? '--',
                'Tujuan Penggunaan' => $pengajuan->keputusan_tujuan_penggunaan ?? '--',
                'Harga Beli Bank' => $pengajuan->keputusan_harga_beli_bank ?? '--',
                'Jangka Waktu Pembiayaan (tahun)' => $jangkaTahun ?: '--',
                'Jangka Waktu (bulan)' => $jangkaBulan ?: '--',
                'Margin Bank (% per bulan)' => $marginPerBulan ?: '--',
                'Margin Bank per Tahun' => $jangkaTahun > 0 ? number_format($marginPerTahun, 2, ',', '.') . '%' : '--',
                'Nominal Margin Bank' => $nominalMargin > 0 ? 'Rp ' . number_format($nominalMargin, 2, ',', '.') : '--',
                'Harga Jual Bank' => $hargaJualBank > 0 ? 'Rp ' . number_format($hargaJualBank, 2, ',', '.') : '--',
                'Angsuran Bank' => $angsuranPerBulan > 0 ? 'Rp ' . number_format($angsuranPerBulan, 2, ',', '.') : '--',
            ];
        @endphp

        @foreach ($keputusanPembiayaan as $label => $value)
            <div class="row mb-1">
                <div class="col-4 fw-bold text-dark d-flex justify-content-between">
                    <span>{{ $label }}</span>
                    <span>:</span>
                </div>
                <div class="col-8 text-dark pl-1">{{ $value }}</div>
            </div>
        @endforeach
        {{-- End Keputusan Pembiayaan --}}

        {{-- Start Hasil Scooring --}}
        <h5 class="border-bottom mb-0 py-1 mt-3">Hasil Scooring</h5>
        @php
            $hasilScooring = [
                'Total Character' => $pengajuan->total_character ?? 0,
                'Total Capacity' => $pengajuan->total_capacity ?? 0,
                'Total Capital' => $pengajuan->total_capital ?? 0,
                'Total Collateral SK' => $pengajuan->total_collateralsk ?? 0,
                'Total Collateral Properti' => $pengajuan->total_collateralproperti ?? 0,
                'Total Collateral Bermotor' => $pengajuan->total_collateralbermotor ?? 0,
                'Total Condition' => $pengajuan->total_condition ?? 0,
                'Rekomendasi Keputusan Pembiayaan' => strtoupper($pengajuan->keputusan ?? '--'),
            ];
        @endphp

        @foreach ($hasilScooring as $label => $value)
            <div class="row mb-1">
                <div class="col-4 fw-bold text-dark d-flex justify-content-between">
                    <span>{{ $label }}</span>
                    <span>:</span>
                </div>
                <div class="col-8 text-dark pl-1">{{ $value }}</div>
            </div>
        @endforeach
        {{-- End Hasil Scooring --}}

        {{-- Start Jadwal Angsuran --}}
        <h5 class="border-bottom mb-0 py-1 mt-3">Jadwal Angsuran</h5>
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

            $tanggalPencairan = $pengajuan->tanggal_pencairan ? Carbon::parse($pengajuan->tanggal_pencairan) : null;
            $tanggalAngsuran = $tanggalPencairan ? $tanggalPencairan->copy()->addMonth() : null;
            $tanggalBerakhirAngsuran = $tanggalPencairan ? $tanggalPencairan->copy()->addMonths($jangkaBulan) : null;

            $jadwalAngsuran = [
                'Tanggal Pencairan' => $tanggalPencairan ? $tanggalPencairan->format('d-m-Y') : '-',
                'Tanggal Angsuran Pertama' => $tanggalAngsuran ? $tanggalAngsuran->format('d-m-Y') : '-',
                'Tanggal Angsuran Terakhir' => $tanggalBerakhirAngsuran
                    ? $tanggalBerakhirAngsuran->format('d-m-Y')
                    : '-',
            ];
        @endphp

        @foreach ($jadwalAngsuran as $label => $value)
            <div class="row mb-1">
                <div class="col-4 fw-bold text-dark d-flex justify-content-between">
                    <span>{{ $label }}</span>
                    <span>:</span>
                </div>
                <div class="col-8 text-dark pl-1">{{ $value }}</div>
            </div>
        @endforeach

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
        <table class="table table-bordered table-sm w-100 text-center" style="table-layout: fixed;">
            <thead class="small">
                <tr>
                    <th style="text-transform: none; width: 60px;" class="bg-white align-middle text-wrap p-1 m-0"
                        rowspan="2">
                        Angsuran ke</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0" rowspan="2">
                        Tanggal</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0" colspan="3">
                        Angsuran</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0" colspan="3">
                        Sisa (Outstanding)</th>
                </tr>
                <tr>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">Harga Pokok</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">Margin</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">Total</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">Harga Pokok</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">Margin</th>
                    <th style="text-transform: none;" class="bg-white align-middle text-wrap p-1 m-0">Harga Jual</th>
                </tr>
            </thead>
            <tbody class="small">
                @if (!empty($pengajuan->tanggal_pencairan) && $tanggalAngsuran)
                    @for ($i = 1; $i <= $jangkaBulan; $i++)
                        <tr class="text-center">
                            <td style="width: 30px;" class="text-center text-wrap align-middle p-1 m-0">
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
                                Rp {{ number_format(max(0, $sisaPokok - $pokokPerBulan), 0, ',', '.') }}
                            </td>
                            <td class="text-center text-wrap align-middle p-1 m-0">
                                Rp {{ number_format(max(0, $sisaMargin - $marginPerBulanNominal), 0, ',', '.') }}
                            </td>
                            <td class="text-center text-wrap align-middle p-1 m-0">
                                Rp {{ number_format(max(0, $sisaHargaJual - $totalAngsuranPerBulan), 0, ',', '.') }}
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
        {{-- End Jadwal Angsuran --}}
    </div>
</body>

@include('layouts.footer')
