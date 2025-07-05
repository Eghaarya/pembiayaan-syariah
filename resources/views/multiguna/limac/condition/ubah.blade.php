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
                                <form action="{{ route('multiguna.limac.condition.update', $pengajuan->kode_pengajuan) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')

                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-1-tab" data-toggle="tab"
                                                data-target="#nav-1" type="button" role="tab" aria-controls="nav-1"
                                                aria-selected="true">Scooring Condition of Economy</button>
                                        </div>

                                    </nav>

                                    <div class="tab-content p-3" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-1" role="tabpanel"
                                            aria-labelledby="nav-1-tab">
                                            <h6 class="border-bottom pb-2">Scooring Condition of Economy</h6>

                                            <div class="row g-3 mb-3">
                                                @php
                                                    $fields = [
                                                        'ketahanan_usaha_berdiri' => [
                                                            '--',
                                                            '<5th (2)',
                                                            '5-10th (5)',
                                                            '>10th (7)',
                                                            '>20th (8)',
                                                            '>30th (10)',
                                                        ],
                                                        'bidang_usaha_langka' => ['--', 'Ya (1)', 'Tidak (2)'],
                                                        'cakupan_wilayah_skala_usaha' => [
                                                            '--',
                                                            'NASIONAL',
                                                            'INTERNASIONAL/ Perusahaan SWASTA Asing, penanaman modal asing (10)',
                                                            'Perusahaan SWASTA BESAR, Aset min 10M (5)',
                                                            'Perusahaan SWASTA Sedang, Aset >200jt - 10M, omset tidak teratur (4)',
                                                            'Perusahaan SWASTA KECIL, Aset < 200jt, omset 1M/thn (1)',
                                                            'Wiraswasta besar, Aset min 10M (3)',
                                                            'Wiraswasta kecil, Aset min 200jt, omset max 1M (2)',
                                                        ],
                                                    ];

                                                    $labels = [
                                                        'ketahanan_usaha_berdiri' =>
                                                            'Apakah usaha atau perusahaan tempat nasabah mampu bertahan dalam persaingan di Indonesia dilihat dari lamanya perusahaan berdiri?',
                                                        'bidang_usaha_langka' =>
                                                            'Apakah bidang pekerjaan atau bidang usaha nasabah termasuk bidang usaha yang jarang ditemukan di Indonesia?',
                                                        'cakupan_wilayah_skala_usaha' =>
                                                            'Apakah cakupan wilayah perusahaan dan usaha nasabah luas dilihat dari skala usaha semakin besar skala usaha maka semakin mampu bertahan',
                                                    ];
                                                @endphp

                                                @foreach ($fields as $field => $options)
                                                    <div class="col-md-8 mt-2">
                                                        <label class="form-group text-info"
                                                            for="{{ $field }}">{{ $labels[$field] ?? ucwords(str_replace('_', ' ', $field)) }}</label>
                                                        <select name="{{ $field }}" id="{{ $field }}"
                                                            class="form-control">
                                                            @foreach ($options as $option)
                                                                <option value="{{ $option }}"
                                                                    {{ old($field, $pengajuan->$field ?? '') == $option ? 'selected' : '' }}>
                                                                    {{ $option }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                @endforeach

                                            </div>
                                            <div class="d-flex gap-2 justify-content-start mt-3" id="nav-tab"
                                                role="tablist">
                                                <a href="{{ route('multiguna.limac.condition.data') }}"
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
