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
                                <form action="{{ route('murabahah.pengajuan.store') }}" method="POST">
                                    @csrf
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-1-tab" data-toggle="tab"
                                                data-target="#nav-1" type="button" role="tab" aria-controls="nav-1"
                                                aria-selected="true">Buat Pengajuan</button>
                                        </div>
                                    </nav>
                                    <div class="tab-content p-3" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-1" role="tabpanel"
                                            aria-labelledby="nav-1-tab">
                                            <h6 class="border-bottom pb-2">Buat Pengajuan</h6>
                                            <div class="row g-3 mb-3">
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="tanggal_pengajuan">Tanggal Pengajuan <span
                                                            style="color: red">*</span></label>
                                                    <input type="date" class="form-control" id="tanggal_pengajuan"
                                                        name="tanggal_pengajuan"
                                                        value="{{ old('tanggal_pengajuan', \Carbon\Carbon::now()->format('Y-m-d')) }}"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="row g-3 mb-3">
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="nasabah_pengajuan">Nasabah <span
                                                            style="color: red">*</span></label>
                                                    <select class="form-control" id="nasabah_pengajuan"
                                                        name="nasabah_pengajuan" required>
                                                        <option value="" disabled selected>-- Pilih Nasabah --
                                                        </option>
                                                        @foreach ($nasabahs as $nasabah)
                                                            <option
                                                                value="{{ $nasabah->kode_nasabah }}-{{ $nasabah->nama_nasabah }}">
                                                                {{ $nasabah->kode_nasabah }} - {{ $nasabah->nama_nasabah }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="d-flex gap-2 justify-content-start" id="nav-tab" role="tablist">

                                                <a href="{{ route('murabahah.pengajuan.data') }}"
                                                    class="btn btn-secondary">←
                                                    Kembali</a>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-save me-2"></i> Simpan Data Pengajuan
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
