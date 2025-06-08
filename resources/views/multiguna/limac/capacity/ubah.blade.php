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
                                <form action="{{ route('multiguna.limac.capacity.update', $pengajuan->kode_pengajuan) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="kode_nasabah" value="{{ $pengajuan->kode_nasabah }}">

                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-1-tab" data-toggle="tab"
                                                data-target="#nav-1" type="button" role="tab" aria-controls="nav-1"
                                                aria-selected="true">Reputasi Nasabah dalam Pekerjaan</button>
                                            <button class="nav-link" id="nav-2-tab" data-toggle="tab" data-target="#nav-2"
                                                type="button" role="tab" aria-controls="nav-2"
                                                aria-selected="true">Fasilitas Dinas Yang Diterima</button>
                                            <button class="nav-link" id="nav-3-tab" data-toggle="tab" data-target="#nav-3"
                                                type="button" role="tab" aria-controls="nav-3"
                                                aria-selected="true">Perincian Rekening Tabungan</button>
                                            <button class="nav-link" id="nav-4-tab" data-toggle="tab" data-target="#nav-4"
                                                type="button" role="tab" aria-controls="nav-4"
                                                aria-selected="true">Kondisi Keuangan</button>
                                        </div>
                                    </nav>

                                    <div class="tab-content p-3" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-1" role="tabpanel"
                                            aria-labelledby="nav-1-tab">
                                            <h6 class="border-bottom pb-2">Reputasi Nasabah dalam Pekerjaan</h6>

                                            <div class="row g-3 mb-3">
                                                @php
                                                    $options = ['Iya (2)', 'Tidak (1)'];

                                                    $fields = [
                                                        'memiliki_jabatan_rangkap' => 'Memiliki Jabatan Rangkap?',
                                                        'publik_figur' => 'Publik Figur?',
                                                        'pemegang_jabatan_tertinggi' => 'Pemegang Jabatan Tertinggi?',
                                                        'bukan_pemegang_jabatan_tertinggi' =>
                                                            'Bukan Pemegang Jabatan Tertinggi?',
                                                        'non_jabatan' => 'Non Jabatan?',
                                                    ];

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
                                                                <label class="form-check-label" for="{{ $inputId }}">
                                                                    {{ $option }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                            </div>

                                            <div class="d-flex gap-2 justify-content-start mt-3" id="nav-tab"
                                                role="tablist">
                                                <a href="{{ route('multiguna.limac.capacity.data') }}"
                                                    class="btn btn-secondary">
                                                    ← Kembali
                                                </a>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-2" role="tabpanel"
                                            aria-labelledby="nav-2-tab">
                                            <h6 class="border-bottom pb-2">Fasilitas Dinas Yang Diterima</h6>
                                            <div class="row g-3 mb-3">

                                                @php
                                                    $fields = [
                                                        'mendapat_rumah_dinas' => 'Mendapat Rumah Dinas?',
                                                        'mendapat_mobil_dinas' => 'Mendapat Mobil Dinas?',
                                                        'mendapat_sepeda_motor_dinas' => 'Mendapat Sepeda Motor Dinas?',
                                                        'mendapat_fasilitas_pinjaman_uang' =>
                                                            'Mendapat Fasilitas Pinjaman Uang?',
                                                        'belum_mendapat_fasilitas_dinas' =>
                                                            'Belum Mendapat Fasilitas Dinas?',
                                                    ];
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
                                                                <label class="form-check-label" for="{{ $inputId }}">
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
                                            <h6 class="border-bottom pb-2">Perincian Rekening Tabungan</h6>

                                            <div class="row g-3 mb-3">
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-4" role="tabpanel"
                                            aria-labelledby="nav-4-tab">
                                            <h6 class="border-bottom pb-2">Kondisi Keuangan</h6>


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
