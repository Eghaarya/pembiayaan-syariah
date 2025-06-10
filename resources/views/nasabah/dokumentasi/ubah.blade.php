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
                                <form action="{{ route('nasabah.dokumentasi.update', $nasabah_dokumentasi->kode_nasabah) }} "
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-1-tab" data-toggle="tab"
                                                data-target="#nav-1" type="button" role="tab" aria-controls="nav-1"
                                                aria-selected="true">Dokumentasi Nasabah</button>
                                        </div>
                                    </nav>
                                    <div class="tab-content p-3" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-1" role="tabpanel"
                                            aria-labelledby="nav-1-tab">
                                            <h6 class="border-bottom pb-2">Dokumentasi Nasabah</h6>
                                            <div class="row g-3 mb-3">

                                                @php
                                                    $imageFields = [
                                                        'foto_nasabah' => 'Foto Nasabah',
                                                        'foto_pasangan' => 'Foto Pasangan (Jika Ada)',
                                                        'foto_identitas_nasabah' => 'Foto Identitas Nasabah (KTP/SIM)',
                                                        'foto_identitas_pasangan' =>
                                                            'Foto Identitas Pasangan (KTP/SIM)',
                                                        'npwp_nasabah' => 'NPWP Nasabah',
                                                        'npwp_pasangan' => 'NPWP Pasangan',
                                                    ];
                                                @endphp

                                                @foreach ($imageFields as $field => $label)
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="{{ $field }}">{{ $label }}</label>
                                                            <input type="file"
                                                                class="form-control-file @error($field) is-invalid @enderror"
                                                                id="{{ $field }}" name="{{ $field }}">
                                                            @error($field)
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                            @if ($nasabah_dokumentasi->$field)
                                                                <small class="form-text text-muted">
                                                                    File saat ini:
                                                                    <a href="{{ asset('storage/uploads/nasabah/' . $nasabah_dokumentasi->$field) }}"
                                                                        download="{{ $nasabah_dokumentasi->$field }}"
                                                                        class="btn btn-sm btn-outline-primary py-0 px-1">
                                                                        <i class="fas fa-download"></i> Unduh
                                                                        {{ $nasabah_dokumentasi->$field }}
                                                                    </a>
                                                                </small>
                                                                <a href="{{ asset('storage/uploads/nasabah/' . $nasabah_dokumentasi->$field) }}"
                                                                    target="_blank">
                                                                    <img src="{{ asset('storage/uploads/nasabah/' . $nasabah_dokumentasi->$field) }}"
                                                                        alt="{{ $label }} Preview"
                                                                        class="img-thumbnail" width="75%">
                                                                </a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <div class="d-flex gap-2 justify-content-start" id="nav-tab" role="tablist">

                                                <a href="{{ route('nasabah.dokumentasi.data') }}"
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
