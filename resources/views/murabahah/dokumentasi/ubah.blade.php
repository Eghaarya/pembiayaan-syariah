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
                                <form action="{{ route('murabahah.dokumentasi.update', $pengajuan->kode_pengajuan) }} "
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-1-tab" data-toggle="tab"
                                                data-target="#nav-1" type="button" role="tab" aria-controls="nav-1"
                                                aria-selected="true">Dokumentasi Murabahah</button>
                                        </div>
                                    </nav>
                                    <div class="tab-content p-3" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-1" role="tabpanel"
                                            aria-labelledby="nav-1-tab">

                                            <div class="row g-3 mb-3">

                                                @php
                                                    $identitasFields = [
                                                        'foto_nasabah' => 'Foto Nasabah',
                                                        'foto_identitas_nasabah' => 'Foto Identitas Nasabah (KTP/SIM)',
                                                        'npwp_nasabah' => 'NPWP Nasabah',
                                                        'foto_pasangan' => 'Foto Pasangan',
                                                        'foto_identitas_pasangan' =>
                                                            'Foto Identitas Pasangan (KTP/SIM)',
                                                        'npwp_pasangan' => 'NPWP Pasangan',
                                                    ];
                                                @endphp

                                                @foreach ($identitasFields as $field => $label)
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="{{ $field }}">{{ $label }}</label>
                                                            <input type="file"
                                                                class="form-control-file @error($field) is-invalid @enderror"
                                                                id="{{ $field }}" name="{{ $field }}">
                                                            @error($field)
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                            @if ($pengajuan->$field)
                                                                <small class="form-text text-muted">
                                                                    File saat ini:
                                                                    <a href="{{ asset('storage/uploads/murabahah/' . $pengajuan->$field) }}"
                                                                        download="{{ $pengajuan->$field }}"
                                                                        class="btn btn-sm btn-outline-primary py-0 px-1">
                                                                        <i class="fas fa-download"></i> Unduh
                                                                        {{ \Illuminate\Support\Str::limit($pengajuan->$field, 30) }}
                                                                    </a>
                                                                </small>
                                                                <a href="{{ asset('storage/uploads/murabahah/' . $pengajuan->$field) }}"
                                                                    target="_blank">
                                                                    <img src="{{ asset('storage/uploads/murabahah/' . $pengajuan->$field) }}"
                                                                        alt="{{ $label }} Preview"
                                                                        class="img-thumbnail" width="50%">
                                                                </a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <h6 class="border-bottom pb-2">Dokumentasi Capacity</h6>
                                            <div class="row g-3 mb-3">

                                                @php
                                                    $capacityFields = [
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
                                                    ];
                                                @endphp

                                                @foreach ($capacityFields as $field => $label)
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="{{ $field }}">{{ $label }}</label>
                                                            <input type="file"
                                                                class="form-control-file @error($field) is-invalid @enderror"
                                                                id="{{ $field }}" name="{{ $field }}">
                                                            @error($field)
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                            @if ($pengajuan->$field)
                                                                <small class="form-text text-muted">
                                                                    File saat ini:
                                                                    <a href="{{ asset('storage/uploads/murabahah/' . $pengajuan->$field) }}"
                                                                        download="{{ $pengajuan->$field }}"
                                                                        class="btn btn-sm btn-outline-primary py-0 px-1">
                                                                        <i class="fas fa-download"></i> Unduh
                                                                        {{ \Illuminate\Support\Str::limit($pengajuan->$field, 30) }}
                                                                    </a>
                                                                </small>
                                                                <a href="{{ asset('storage/uploads/murabahah/' . $pengajuan->$field) }}"
                                                                    target="_blank">
                                                                    <img src="{{ asset('storage/uploads/murabahah/' . $pengajuan->$field) }}"
                                                                        alt="{{ $label }} Preview"
                                                                        class="img-thumbnail" width="50%">
                                                                </a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <h6 class="border-bottom pb-2">Dokumentasi Collateral</h6>
                                            <div class="row g-3 mb-3">

                                                @php
                                                    $collateralFields = [
                                                        'foto_depan_agunan' => 'Foto Depan Agunan',
                                                        'foto_dalam_agunan' => 'Foto Bagian Dalam Agunan',
                                                        'foto_barat_agunan' => 'Foto Sebelah Barat Agunan',
                                                        'foto_utara_agunan' => 'Foto Sebelah Utara Agunan',
                                                        'foto_timur_agunan' => 'Foto Sebelah Timur Agunan',
                                                        'foto_selatan_agunan' => 'Foto Sebelah Selatan Agunan',
                                                        'foto_jaminan_depan_kpm' =>
                                                            'Jika KPM maka foto jaminan kendaraan depan',
                                                        'foto_jaminan_samping_kpm' =>
                                                            'Jika KPM maka foto jaminan kendaraan samping',
                                                        'foto_jaminan_atas_kpm' =>
                                                            'Jika KPM maka foto jaminan kendaraan atas',
                                                        'foto_jaminan_rangka_mesin_kpm' =>
                                                            'Jika KPM maka foto jaminan kendaraan rangka mesin ',
                                                    ];
                                                @endphp

                                                @foreach ($collateralFields as $field => $label)
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="{{ $field }}">{{ $label }}</label>
                                                            <input type="file"
                                                                class="form-control-file @error($field) is-invalid @enderror"
                                                                id="{{ $field }}" name="{{ $field }}">
                                                            @error($field)
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                            @if ($pengajuan->$field)
                                                                <small class="form-text text-muted">
                                                                    File saat ini:
                                                                    <a href="{{ asset('storage/uploads/murabahah/' . $pengajuan->$field) }}"
                                                                        download="{{ $pengajuan->$field }}"
                                                                        class="btn btn-sm btn-outline-primary py-0 px-1">
                                                                        <i class="fas fa-download"></i> Unduh
                                                                        {{ \Illuminate\Support\Str::limit($pengajuan->$field, 30) }}
                                                                    </a>
                                                                </small>
                                                                <a href="{{ asset('storage/uploads/murabahah/' . $pengajuan->$field) }}"
                                                                    target="_blank">
                                                                    <img src="{{ asset('storage/uploads/murabahah/' . $pengajuan->$field) }}"
                                                                        alt="{{ $label }} Preview"
                                                                        class="img-thumbnail" width="50%">
                                                                </a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <div class="d-flex gap-2 justify-content-start" id="nav-tab" role="tablist">

                                                <a href="{{ route('murabahah.dokumentasi.data') }}"
                                                    class="btn btn-secondary">←
                                                    Kembali</a>
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
