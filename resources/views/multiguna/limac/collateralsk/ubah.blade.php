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
                                <form action="{{ route('multiguna.limac.collateralsk.update', $pengajuan->kode_pengajuan) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="kode_nasabah" value="{{ $pengajuan->kode_nasabah }}">

                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-1-tab" data-toggle="tab"
                                                data-target="#nav-1" type="button" role="tab" aria-controls="nav-1"
                                                aria-selected="true">Scooring Collateral SK</button>
                                        </div>

                                    </nav>

                                    <div class="tab-content p-3" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-1" role="tabpanel"
                                            aria-labelledby="nav-1-tab">
                                            <div
                                                class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2">
                                                <h6 class="mb-0">Scooring Collateral SK</h6>
                                                <a href="{{ route('nasabah.pekerjaan.edit', $nasabah_pekerjaan->kode_nasabah) }}"
                                                    class="btn btn-sm btn-link text-warning p-1" id="target-shake">
                                                    Ubah data Pekerjaan di sini ... <i class="fas fa-edit"></i>
                                                </a>
                                            </div>

                                            <div class="row g-3 mb-3">
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
                                            </div>

                                            @php
                                                $options = [
                                                    'sk_pengangkatan_pegawai_tetap' => [
                                                        '--',
                                                        'ADA (1)',
                                                        'TIDAK ADA (0)',
                                                    ],
                                                    'sk_jabatan_terakhir_terkini' => ['--', 'ADA (1)', 'TIDAK ADA (0)'],
                                                ];

                                            @endphp

                                            @foreach ($options as $field => $values)
                                                <div class="row g-3 mb-3">
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
                                                </div>
                                            @endforeach

                                            <div class="d-flex gap-2 justify-content-start mt-3" id="nav-tab"
                                                role="tablist">
                                                <a href="{{ route('multiguna.limac.collateralsk.data') }}"
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
