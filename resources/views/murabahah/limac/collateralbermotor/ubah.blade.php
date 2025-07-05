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
                                <form
                                    action="{{ route('murabahah.limac.collateralbermotor.update', $pengajuan->kode_pengajuan) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')

                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-1-tab" data-toggle="tab"
                                                data-target="#nav-1" type="button" role="tab" aria-controls="nav-1"
                                                aria-selected="true">Scooring Collateral Bermotor</button>
                                        </div>

                                    </nav>

                                    <div class="tab-content p-3" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-1" role="tabpanel"
                                            aria-labelledby="nav-1-tab">
                                            <h6 class="border-bottom pb-2">Scooring Collateral Bermotor</h6>

                                            <div class="row g-3 mb-3">
                                                @php
                                                    $options = [
                                                        'tujuan_penggunaan' => [
                                                            '--',
                                                            'Pembelian kendaraan baru (5)',
                                                            'Pembelian kendaraan lama (3)',
                                                        ],
                                                        'jenis_kendaraan' => [
                                                            '--',
                                                            'Kendaraan roda 2 (1)',
                                                            'Kendaraan roda 3 (2)',
                                                            'Kendaraan roda 4 (5)',
                                                            'Kendaraan roda >4 (3)',
                                                        ],
                                                        'status_agunan_kendaraan' => ['--', 'Baru (2)', 'Lama (1)'],
                                                    ];
                                                @endphp

                                                @foreach ($options as $field => $values)
                                                    <div class="col-md-6 mt-2">
                                                        <label for="{{ $field }}"
                                                            class="form-label text-info">{{ ucwords(str_replace('_', ' ', $field)) }}</label>
                                                        <select name="{{ $field }}" id="{{ $field }}"
                                                            class="form-control">
                                                            @foreach ($values as $value)
                                                                <option value="{{ $value }}"
                                                                    {{ old($field, $pengajuan->$field ?? '') == $value ? 'selected' : '' }}>
                                                                    {{ $value }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                @endforeach

                                                <div class="col-md-6 mt-2">
                                                    <label for="nomor_stnk_agunan" class="form-label">Nomor STNK
                                                        Agunan</label>
                                                    <input type="text" name="nomor_stnk_agunan" class="form-control"
                                                        value="{{ old('nomor_stnk_agunan', $pengajuan->nomor_stnk_agunan) }}">
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <label for="nama_pemilik_agunan" class="form-label">Nama Pemilik
                                                        Agunan</label>
                                                    <input type="text" name="nama_pemilik_agunan" class="form-control"
                                                        value="{{ old('nama_pemilik_agunan', $pengajuan->nama_pemilik_agunan) }}">
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <label for="alamat_pemilik_agunan" class="form-label">Alamat Pemilik
                                                        Agunan</label>
                                                    <input type="text" name="alamat_pemilik_agunan" class="form-control"
                                                        value="{{ old('alamat_pemilik_agunan', $pengajuan->alamat_pemilik_agunan) }}">
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <label for="merk_agunan" class="form-label">Merk Agunan</label>
                                                    <input type="text" name="merk_agunan" class="form-control"
                                                        value="{{ old('merk_agunan', $pengajuan->merk_agunan) }}">
                                                </div>

                                                @php
                                                    $options = [
                                                        'tipe_agunan' => [
                                                            '--',
                                                            'Sepeda motor Bebek (1)',
                                                            'Sepeda motor Matic (2)',
                                                            'Kendaraan khusus (RODA 3 VIAR) (3)',
                                                            'Mobil barang (4)',
                                                            'Mobil penumpang (6)',
                                                            'Mobil bus (5)',
                                                        ],
                                                        'teknologi' => ['--', 'Manual', 'Matic'],
                                                        'bahan_bakar' => [
                                                            '--',
                                                            'Pertamax (3)',
                                                            'Solar (1)',
                                                            'Pertalite (2)',
                                                            'Listrik (3)',
                                                        ],
                                                    ];
                                                @endphp
                                                @foreach ($options as $field => $values)
                                                    <div class="col-md-6 mt-2">
                                                        <label for="{{ $field }}"
                                                            class="form-label text-info">{{ ucwords(str_replace('_', ' ', $field)) }}</label>
                                                        <select name="{{ $field }}" id="{{ $field }}"
                                                            class="form-control">
                                                            @foreach ($values as $value)
                                                                <option value="{{ $value }}"
                                                                    {{ old($field, $pengajuan->$field ?? '') == $value ? 'selected' : '' }}>
                                                                    {{ $value }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                @endforeach

                                                <div class="col-md-6 mt-2">
                                                    <label for="warna_agunan" class="form-label">Warna Agunan</label>
                                                    <input type="text" name="warna_agunan" class="form-control"
                                                        value="{{ old('warna_agunan', $pengajuan->warna_agunan) }}">
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <label for="isi_silinder" class="form-label">Isi Silinder</label>
                                                    <input type="text" name="isi_silinder" class="form-control"
                                                        value="{{ old('isi_silinder', $pengajuan->isi_silinder) }}">
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <label for="nomor_rangka_agunan" class="form-label">Nomor Rangka
                                                        Agunan</label>
                                                    <input type="text" name="nomor_rangka_agunan" class="form-control"
                                                        value="{{ old('nomor_rangka_agunan', $pengajuan->nomor_rangka_agunan) }}">
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <label for="nomor_mesin_agunan" class="form-label">Nomor Mesin
                                                        Agunan</label>
                                                    <input type="text" name="nomor_mesin_agunan" class="form-control"
                                                        value="{{ old('nomor_mesin_agunan', $pengajuan->nomor_mesin_agunan) }}">
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <label for="tahun_pembuatan" class="form-label">Tahun
                                                        Pembuatan</label>
                                                    <input type="text" name="tahun_pembuatan" class="form-control"
                                                        value="{{ old('tahun_pembuatan', $pengajuan->tahun_pembuatan) }}">
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <label for="masa_berlaku" class="form-label">Masa Berlaku</label>
                                                    <input type="text" name="masa_berlaku" class="form-control"
                                                        value="{{ old('masa_berlaku', $pengajuan->masa_berlaku) }}">
                                                </div>

                                            </div>
                                            <div class="d-flex gap-2 justify-content-start mt-3" id="nav-tab"
                                                role="tablist">
                                                <a href="{{ route('murabahah.limac.collateralbermotor.data') }}"
                                                    class="btn btn-secondary">
                                                    ← Kembali
                                                </a>
                                                <button type="submit" class="btn btn-warning">
                                                    <i class="fas fa-save me-2"></i> Simpan Perubahan
                                                    {{ ucwords(str_replace('_', ' ', explode('.', Route::currentRouteName())[2] ?? '')) }}
                                                </button>
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
