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
                                <form action="{{ route('admin.tempat.store') }}" method="POST">
                                    @csrf
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-1-tab" data-toggle="tab"
                                                data-target="#nav-1" type="button" role="tab" aria-controls="nav-1"
                                                aria-selected="true">Tambah Kode Tempat</button>
                                        </div>
                                    </nav>
                                    <div class="tab-content p-3" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-1" role="tabpanel"
                                            aria-labelledby="nav-1-tab">
                                            <h6 class="border-bottom pb-2">Tambah Kode Tempat
                                            </h6>
                                            <div class="row g-3 mb-3">
                                                <div class="col-md-6 mt-2">
                                                    <label for="kode_tempat" class="form-label fw-bold text-dark">
                                                        Kode Tempat <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="kode_tempat" id="kode_tempat"
                                                        class="form-control @error('kode_tempat') is-invalid @enderror"
                                                        value="{{ old('kode_tempat') }}" required>
                                                    @error('kode_tempat')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row g-3 mb-3">
                                                <div class="col-md-6 mt-2">
                                                    <label for="nama_tempat" class="form-label fw-bold text-dark">
                                                        Nama Tempat <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="nama_tempat" id="nama_tempat"
                                                        class="form-control @error('nama_tempat') is-invalid @enderror"
                                                        value="{{ old('nama_tempat') }}" required>
                                                    @error('nama_tempat')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="d-flex gap-2 justify-content-start" id="nav-tab" role="tablist">

                                                <a href="{{ route('admin.tempat.data') }}" class="btn btn-secondary">←
                                                    Kembali</a>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-save me-2"></i> Simpan Data Kode Tempat
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
    </div>
    <!-- [ Main Content ] end -->
@endsection
