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
                                <form action="{{ route('admin.tempat.update', $tempat->kode_tempat) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6 mt-2">
                                            <label for="kode_tempat" class="form-label fw-bold text-dark">
                                                Kode Tempat <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="kode_tempat" id="kode_tempat"
                                                class="form-control @error('kode_tempat') is-invalid @enderror"
                                                value="{{ old('kode_tempat', $tempat->kode_tempat) }}" readonly>
                                            {{-- Biasanya primary key tidak bisa diubah, jadi readonly --}}
                                            @error('kode_tempat')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6 mt-2">
                                            <label for="nama_tempat" class="form-label fw-bold text-dark">
                                                Nama Tempat
                                            </label>
                                            <input type="text" name="nama_tempat" id="nama_tempat"
                                                class="form-control @error('nama_tempat') is-invalid @enderror"
                                                value="{{ old('nama_tempat', $tempat->nama_tempat) }}">
                                            @error('nama_tempat')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="d-flex gap-2 justify-content-start" id="nav-tab" role="tablist">

                                        <a href="{{ route('admin.tempat.data') }}" class="btn btn-secondary">←
                                            Kembali</a>
                                        <button type="submit" class="btn btn-warning">
                                            <i class="fas fa-save me-2"></i> Simpan Perubahan Kode Tempat
                                        </button>
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
