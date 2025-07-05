@extends('layouts.app')

@section('content')
    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="card card-social">
                    <div class="card-block border-bottom">
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table border table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <th class="align-middle p-3" rowspan="2">Aksi</th>
                                            <th class="align-middle p-3" rowspan="2">No</th>
                                            <th class="align-middle p-3" rowspan="2">Kode Pengajuan</th>
                                            <th class="align-middle p-3" rowspan="2">Kode Nasabah</th>
                                            <th class="align-middle p-3" rowspan="2">Nama Nasabah</th>
                                            <th class="align-middle p-3" colspan="6">Foto Dokumentasi Identitas</th>
                                            <th class="align-middle p-3" colspan="10">Foto Dokumentasi Capacity</th>
                                            <th class="align-middle p-3" colspan="10">Foto Dokumentasi Collateral
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="bg-white text-secondary p-1 pl-2">Foto Nasabah</th>
                                            <th class="bg-white text-secondary p-1 pl-2">Foto Identitas Nasabah</th>
                                            <th class="bg-white text-secondary p-1 pl-2">NPWP Nasabah</th>
                                            <th class="bg-white text-secondary p-1 pl-2">Foto Pasangan</th>
                                            <th class="bg-white text-secondary p-1 pl-2">Foto Identitas Pasangan</th>
                                            <th class="bg-white text-secondary p-1 pl-2">NPWP Pasangan</th>

                                            <th class="text-secondary p-1 pl-2">Slip Gaji Nasabah</th>
                                            <th class="text-secondary p-1 pl-2">Slip Gaji Pasangan</th>
                                            <th class="text-secondary p-1 pl-2">Rekening Gaji Nasabah</th>
                                            <th class="text-secondary p-1 pl-2">Rekening Gaji Pasangan</th>
                                            <th class="text-secondary p-1 pl-2">Tempat Kerja/Usaha Nasabah</th>
                                            <th class="text-secondary p-1 pl-2">Tempat Kerja/Usaha Pasangan</th>
                                            <th class="text-secondary p-1 pl-2">Foto Surat Pegawai Tetap Nasabah
                                            </th>
                                            <th class="text-secondary p-1 pl-2">Foto Surat Pegawai Tetap Pasangan
                                            </th>
                                            <th class="text-secondary p-1 pl-2">Foto Tabungan Nasabah 3 Bulan
                                                Terakhir</th>
                                            <th class="text-secondary p-1 pl-2">Foto Tabungan Pasangan 3 Bulan
                                                Terakhir</th>

                                            <th class="bg-white text-secondary p-1 pl-2">Foto Depan Agunan</th>
                                            <th class="bg-white text-secondary p-1 pl-2">Foto Dalam Agunan</th>
                                            <th class="bg-white text-secondary p-1 pl-2">Foto Barat Agunan</th>
                                            <th class="bg-white text-secondary p-1 pl-2">Foto Utara Agunan</th>
                                            <th class="bg-white text-secondary p-1 pl-2">Foto Timur Agunan</th>
                                            <th class="bg-white text-secondary p-1 pl-2">Foto Selatan Agunan</th>
                                            <th class="bg-white text-secondary p-1 pl-2">Foto Jaminan Depan KPM</th>
                                            <th class="bg-white text-secondary p-1 pl-2">Foto Jaminan Samping KPM</th>
                                            <th class="bg-white text-secondary p-1 pl-2">Foto Jaminan Atas KPM</th>
                                            <th class="bg-white text-secondary p-1 pl-2">Foto Jaminan Rangka Mesin KPM</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($multiguna_dokumentasi as $index => $multiguna)
                                            <tr class="text-center">
                                                <td class="align-middle text-center p-1">
                                                    <a href="{{ route('multiguna.dokumentasi.upload', $multiguna->kode_pengajuan) }}"
                                                        class="btn btn-sm btn-link text-warning p-1">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </td>
                                                <td class="align-middle text-center text-wrap p-1">
                                                    {{ $multiguna_dokumentasi->firstItem() + $index }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">{{ $multiguna->kode_pengajuan }}</td>
                                                <td class="align-middle text-wrap p-1">{{ $multiguna->kode_nasabah }}</td>
                                                <td class="align-middle text-wrap p-1">{{ $multiguna->nama_nasabah }}</td>

                                                @php
                                                    $dokumentasiFields = [
                                                        'foto_nasabah' => 'Foto Nasabah',
                                                        'foto_identitas_nasabah' => 'Foto Identitas Nasabah (KTP/SIM)',
                                                        'npwp_nasabah' => 'NPWP Nasabah',
                                                        'foto_pasangan' => 'Foto Pasangan',
                                                        'foto_identitas_pasangan' =>
                                                            'Foto Identitas Pasangan (KTP/SIM)',
                                                        'npwp_pasangan' => 'NPWP Pasangan',

                                                        'slip_gaji_nasabah' => 'Slip Gaji Nasabah',
                                                        'slip_gaji_pasangan' => 'Slip Gaji Pasangan',
                                                        'rekening_gaji_nasabah' =>
                                                            'Rekening Gaji/Payroll/Aktif Nasabah',
                                                        'rekening_gaji_pasangan' =>
                                                            'Rekening Gaji/Payroll/Aktif Pasangan',
                                                        'tempat_kerja_usaha_nasabah' => 'Tempat Kerja/Usaha Nasabah',
                                                        'tempat_kerja_usaha_pasangan' => 'Tempat Kerja/Usaha Pasangan',
                                                        'foto_surat_pegawai_tetap_nasabah' =>
                                                            'Foto Surat Pegawai Tetap Nasabah',
                                                        'foto_surat_pegawai_tetap_pasangan' =>
                                                            'Foto Surat Pegawai Tetap Pasangan',
                                                        'foto_tabungan_nasabah_3_bln_terakhir' =>
                                                            'Foto Tabungan Nasabah 3 Bulan Terakhir',
                                                        'foto_tabungan_pasangan_3_bln_terakhir' =>
                                                            'Foto Tabungan Pasangan 3 Bulan Terakhir',

                                                        'foto_depan_agunan' => 'Foto Depan Agunan',
                                                        'foto_dalam_agunan' => 'Foto Bagian Dalam Agunan',
                                                        'foto_barat_agunan' => 'Foto Sebelah Barat Agunan',
                                                        'foto_utara_agunan' => 'Foto Sebelah Utara Agunan',
                                                        'foto_timur_agunan' => 'Foto Sebelah Timur Agunan',
                                                        'foto_selatan_agunan' => 'Foto Sebelah Selatan Agunan',
                                                        'foto_jaminan_depan_kpm' =>
                                                            'Foto Jaminan Kendaraan Depan (KPM)',
                                                        'foto_jaminan_samping_kpm' =>
                                                            'Foto Jaminan Kendaraan Samping (KPM)',
                                                        'foto_jaminan_atas_kpm' => 'Foto Jaminan Kendaraan Atas (KPM)',
                                                        'foto_jaminan_rangka_mesin_kpm' =>
                                                            'Foto Jaminan Kendaraan Rangka Mesin (KPM)',
                                                    ];
                                                @endphp

                                                @foreach ($dokumentasiFields as $field => $label)
                                                    <td class="align-middle text-center p-1">
                                                        @if (isset($multiguna->$field) && $multiguna->$field)
                                                            <a href="{{ asset('storage/uploads/multiguna/' . $multiguna->$field) }}"
                                                                target="_blank">
                                                                <img src="{{ asset('storage/uploads/multiguna/' . $multiguna->$field) }}"
                                                                    alt="{{ $label }}" class="img-thumbnail"
                                                                    style="width: 80px; height: 80px; object-fit: cover;">
                                                            </a>
                                                        @endif
                                                    </td>
                                                @endforeach

                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="45" class="text-start">Data nasabah tidak ditemukan.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            {{-- Pagination --}}
                            <div class="d-flex justify-content-start mt-3">
                                {{ $multiguna_dokumentasi->links() }}
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
@endsection
