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
                                <form action="{{ route('murabahah.limac.capacity.update', $pengajuan->kode_pengajuan) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="kode_nasabah" value="{{ $pengajuan->kode_nasabah }}">

                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-1-tab" data-toggle="tab"
                                                data-target="#nav-1" type="button" role="tab" aria-controls="nav-1"
                                                aria-selected="true">Perincian Rekening Tabungan</button>
                                            <button class="nav-link" id="nav-2-tab" data-toggle="tab" data-target="#nav-2"
                                                type="button" role="tab" aria-controls="nav-2"
                                                aria-selected="true">Kondisi Keuangan</button>
                                            <button class="nav-link" id="nav-3-tab" data-toggle="tab" data-target="#nav-3"
                                                type="button" role="tab" aria-controls="nav-3"
                                                aria-selected="true">Kemauan Membayar</button>
                                            <button class="nav-link" id="nav-4-tab" data-toggle="tab" data-target="#nav-4"
                                                type="button" role="tab" aria-controls="nav-4"
                                                aria-selected="true">Perhitungan Nilai Pembiayaan</button>
                                        </div>
                                    </nav>

                                    <div class="tab-content p-3" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-1" role="tabpanel"
                                            aria-labelledby="nav-1-tab">
                                            <h6 class="border-bottom pb-2">Perincian Rekening Tabungan</h6>

                                            <div class="d-flex gap-2 justify-content-start mt-3" id="nav-tab"
                                                role="tablist">
                                                <a href="{{ route('murabahah.limac.capacity.data') }}"
                                                    class="btn btn-secondary">
                                                    ← Kembali
                                                </a>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-2" role="tabpanel"
                                            aria-labelledby="nav-2-tab">
                                            <h6 class="border-bottom pb-2">Kondisi Keuangan</h6>

                                        </div>
                                        <div class="tab-pane fade" id="nav-3" role="tabpanel"
                                            aria-labelledby="nav-3-tab">
                                            <h6 class="border-bottom pb-2">Kemauan Membayar</h6>

                                            <div class="row g-3 mb-3">
                                                <div class="col-md-6 mt-2">
                                                    <label for="tempatkerja_kelokasi_bank"
                                                        class="form-label fw-bold text-info">
                                                        Tempat Kerja Thd Lokasi Bank
                                                    </label>
                                                    @php
                                                        $tempatKerjaBankOptions = [
                                                            '--',
                                                            '<10km (5)',
                                                            '10-30km (4)',
                                                            '30-60km (3)',
                                                            'Luar negeri (1)',
                                                            'Luar pulau (2)',
                                                        ];
                                                        $selectedBank = old(
                                                            'tempatkerja_kelokasi_bank',
                                                            $pengajuan->tempatkerja_kelokasi_bank,
                                                        );
                                                    @endphp
                                                    <select class="form-control" id="tempatkerja_kelokasi_bank"
                                                        name="tempatkerja_kelokasi_bank">
                                                        @foreach ($tempatKerjaBankOptions as $label)
                                                            <option value="{{ $label }}"
                                                                {{ $selectedBank === $label ? 'selected' : '' }}>
                                                                {{ $label }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="tempatkerja_kelokasi_agunan"
                                                        class="form-label fw-bold text-info">
                                                        Tempat Kerja Thd Lokasi Agunan
                                                    </label>
                                                    @php
                                                        $tempatKerjaAgunanOptions = [
                                                            '--',
                                                            '<10km (5)',
                                                            '10-30km (4)',
                                                            '30-60km (3)',
                                                            'Luar negeri (2)',
                                                            'Luar pulau (1)',
                                                        ];
                                                        $selectedAgunan = old(
                                                            'tempatkerja_kelokasi_agunan',
                                                            $pengajuan->tempatkerja_kelokasi_agunan,
                                                        );
                                                    @endphp
                                                    <select class="form-control" id="tempatkerja_kelokasi_agunan"
                                                        name="tempatkerja_kelokasi_agunan">
                                                        @foreach ($tempatKerjaAgunanOptions as $label)
                                                            <option value="{{ $label }}"
                                                                {{ $selectedAgunan === $label ? 'selected' : '' }}>
                                                                {{ $label }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="pembayaran_kolektif" class="form-label fw-bold text-info">
                                                        Pembayaran Kolektif
                                                    </label>
                                                    @php
                                                        $pembayaranKolektifOptions = [
                                                            '--',
                                                            'Ada payroll & bersedia potong gaji (3)',
                                                            'Ada perjanjian kerjasama & Debitur bersedia (2)',
                                                            'Tidak ada perjanjian kerjasama & debitur berswdia (1)',
                                                        ];
                                                        $selectedKolektif = old(
                                                            'pembayaran_kolektif',
                                                            $pengajuan->pembayaran_kolektif,
                                                        );
                                                    @endphp
                                                    <select class="form-control" id="pembayaran_kolektif"
                                                        name="pembayaran_kolektif">
                                                        @foreach ($pembayaranKolektifOptions as $label)
                                                            <option value="{{ $label }}"
                                                                {{ $selectedKolektif === $label ? 'selected' : '' }}>
                                                                {{ $label }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="pembayaran_nonkolektif"
                                                        class="form-label fw-bold text-info">
                                                        Pembayaran Non Kolektif
                                                    </label>
                                                    @php
                                                        $pembayaranNonKolektifOptions = [
                                                            '--',
                                                            'Bersedia debit rekening (2)',
                                                            'Lainnya (1)',
                                                        ];
                                                        $selectedNonKolektif = old(
                                                            'pembayaran_nonkolektif',
                                                            $pengajuan->pembayaran_nonkolektif,
                                                        );
                                                    @endphp
                                                    <select class="form-control" id="pembayaran_nonkolektif"
                                                        name="pembayaran_nonkolektif">
                                                        @foreach ($pembayaranNonKolektifOptions as $label)
                                                            <option value="{{ $label }}"
                                                                {{ $selectedNonKolektif === $label ? 'selected' : '' }}>
                                                                {{ $label }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-4" role="tabpanel"
                                            aria-labelledby="nav-4-tab">
                                            <h6 class="border-bottom pb-2">Perhitungan Nilai Pembiayaan</h6>


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
