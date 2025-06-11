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
                                <form action="{{ route('admin.akun.store') }}" method="POST">
                                    @csrf
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-1-tab" data-toggle="tab"
                                                data-target="#nav-1" type="button" role="tab" aria-controls="nav-1"
                                                aria-selected="true">Tambah Akun</button>
                                        </div>
                                    </nav>
                                    <div class="tab-content p-3" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-1" role="tabpanel"
                                            aria-labelledby="nav-1-tab">
                                            <h6 class="border-bottom pb-2">Tambah Akun
                                            </h6>
                                            <div class="row g-3 mb-3">

                                                <div class="col-md-6 mt-2">
                                                    <label for="username" class="form-label fw-bold text-dark">
                                                        Username <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="username" id="username"
                                                        class="form-control @error('username') is-invalid @enderror"
                                                        value="{{ old('username') }}" required>
                                                    @error('username')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="password" class="form-label fw-bold text-dark">
                                                        Password <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="password" name="password" id="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        required>
                                                    @error('password')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="tipe_akun" class="form-label fw-bold text-dark">
                                                        Tipe Akun <span class="text-danger">*</span>
                                                    </label>
                                                    <select name="tipe_akun" id="tipe_akun"
                                                        class="form-control @error('tipe_akun') is-invalid @enderror"
                                                        required>
                                                        <option value="">-- Pilih Tipe Akun --</option>
                                                        @foreach ($tipe_akun_options as $option)
                                                            <option value="{{ $option }}"
                                                                {{ old('tipe_akun') == $option ? 'selected' : '' }}>
                                                                {{ ucfirst($option) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('tipe_akun')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                @if ($tempats === null)
                                                    <!-- Pengajar: kode_tempat fixed readonly -->
                                                    <div class="col-md-6 mt-2">
                                                        <label for="kode_tempat" class="form-label fw-bold text-dark">
                                                            Kode Tempat <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" id="kode_tempat" name="kode_tempat"
                                                            class="form-control" value="{{ $kode_tempat }}" readonly>
                                                    </div>
                                                @else
                                                    <!-- Admin: dropdown pilih kode_tempat -->
                                                    <div class="col-md-6 mt-2" id="kode_tempat_container">
                                                        <label for="kode_tempat" class="form-label fw-bold text-dark">
                                                            Kode Tempat <span class="text-danger">*</span>
                                                        </label>
                                                        <select name="kode_tempat" id="kode_tempat"
                                                            class="form-control @error('kode_tempat') is-invalid @enderror"
                                                            required>
                                                            <option value="">-- Pilih Kode Tempat --</option>
                                                            @foreach ($tempats as $tempat)
                                                                <option value="{{ $tempat->kode_tempat }}"
                                                                    {{ old('kode_tempat') == $tempat->kode_tempat ? 'selected' : '' }}>
                                                                    {{ $tempat->kode_tempat }} -
                                                                    {{ $tempat->nama_tempat }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('kode_tempat')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="d-flex gap-2 justify-content-start" id="nav-tab" role="tablist">

                                                <a href="{{ route('admin.akun.data') }}" class="btn btn-secondary">←
                                                    Kembali</a>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-save me-2"></i> Simpan Data Akun
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tipeAkunSelect = document.getElementById('tipe_akun');
            const kodeTempatSelect = document.getElementById('kode_tempat');
            const kodeTempatContainer = document.getElementById('kode_tempat_container');

            function toggleKodeTempat() {
                if (tipeAkunSelect.value === 'admin') {
                    kodeTempatSelect.disabled = true;
                    kodeTempatContainer.style.display = 'none';
                } else {
                    kodeTempatSelect.disabled = false;
                    kodeTempatContainer.style.display = 'block';
                }
            }

            // Jalankan saat load pertama (untuk old value)
            toggleKodeTempat();

            // Jalankan saat user mengubah tipe akun
            tipeAkunSelect.addEventListener('change', toggleKodeTempat);
        });
    </script>
@endsection
