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
                                <form action="{{ route('multiguna.limac.collateral.update', $pengajuan->kode_pengajuan) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="kode_nasabah" value="{{ $pengajuan->kode_nasabah }}">

                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-1-tab" data-toggle="tab"
                                                data-target="#nav-1" type="button" role="tab" aria-controls="nav-1"
                                                aria-selected="true">Scooring Collateral</button>
                                        </div>

                                    </nav>

                                    <div class="tab-content p-3" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-1" role="tabpanel"
                                            aria-labelledby="nav-1-tab">
                                            <h6 class="border-bottom pb-2">Scooring Condition</h6>

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
                                                <a href="{{ route('multiguna.limac.capacity.data') }}"
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
