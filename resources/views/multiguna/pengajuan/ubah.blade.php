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
                                <form action="{{ route('multiguna.pengajuan.update', $pengajuan->kode_pengajuan) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-1-tab" data-toggle="tab"
                                                data-target="#nav-1" type="button" role="tab" aria-controls="nav-1"
                                                aria-selected="true">
                                                Edit Pengajuan
                                            </button>
                                        </div>
                                    </nav>
                                    <div class="tab-content p-3" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-1" role="tabpanel"
                                            aria-labelledby="nav-1-tab">
                                            <h6 class="border-bottom pb-2">Edit Pengajuan</h6>

                                            <div class="row g-3 mb-3">
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark" for="tanggal_pengajuan">
                                                        Tanggal Pengajuan <span style="color: red">*</span>
                                                    </label>
                                                    <input type="date" class="form-control" id="tanggal_pengajuan"
                                                        name="tanggal_pengajuan"
                                                        value="{{ old('tanggal_pengajuan', \Carbon\Carbon::parse($pengajuan->tanggal_pengajuan)->format('Y-m-d')) }}"
                                                        required>
                                                </div>
                                            </div>

                                            <div class="row g-3 mb-3">
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark" for="nasabah_pengajuan">
                                                        Nasabah <span style="color: red">*</span>
                                                    </label>
                                                    <select class="form-control" id="nasabah_pengajuan"
                                                        name="nasabah_pengajuan" required>
                                                        <option value="" disabled>-- Pilih Nasabah --</option>
                                                        @foreach ($nasabahs as $nasabah)
                                                            <option
                                                                value="{{ $nasabah->kode_nasabah }}-{{ $nasabah->nama_nasabah }}"
                                                                {{ $pengajuan->kode_nasabah == $nasabah->kode_nasabah ? 'selected' : '' }}>
                                                                {{ $nasabah->kode_nasabah }} - {{ $nasabah->nama_nasabah }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row g-3 mb-3">
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark" for="keputusan">
                                                        Keputusan
                                                    </label>
                                                    <select class="form-control" id="keputusan" name="keputusan">
                                                        <option value="">--</option>
                                                        <option value="disetujui"
                                                            {{ old('keputusan', $pengajuan->keputusan) == 'disetujui' ? 'selected' : '' }}>
                                                            Setujui Pengajuan
                                                        </option>
                                                        <option value="ditolak"
                                                            {{ old('keputusan', $pengajuan->keputusan) == 'ditolak' ? 'selected' : '' }}>
                                                            Tolak Pengajuan
                                                        </option>
                                                    </select>
                                                </div>

                                                <div class="col-md-6 mt-2" id="tanggalPencairanWrapper">
                                                    <label class="form-label fw-bold text-dark" for="tanggal_pencairan">
                                                        Tanggal Pencairan
                                                    </label>
                                                    <input type="date" class="form-control" id="tanggal_pencairan"
                                                        name="tanggal_pencairan"
                                                        value="{{ old('tanggal_pencairan', $pengajuan->tanggal_pencairan ? \Carbon\Carbon::parse($pengajuan->tanggal_pencairan)->format('Y-m-d') : '') }}">
                                                </div>
                                            </div>

                                            <div class="d-flex gap-2 justify-content-start" id="nav-tab" role="tablist">
                                                <a href="{{ route('multiguna.pengajuan.data') }}"
                                                    class="btn btn-secondary">← Kembali</a>
                                                <button type="submit" class="btn btn-warning">
                                                    <i class="fas fa-save me-2"></i> Simpan Perubahan Pengajuan
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
        function toggleTanggalPencairan() {
            const keputusan = document.getElementById('keputusan').value;
            const wrapper = document.getElementById('tanggalPencairanWrapper');

            if (keputusan === 'disetujui') {
                wrapper.style.display = 'block';
            } else {
                wrapper.style.display = 'none';
            }
        }

        // Jalankan saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            toggleTanggalPencairan(); // Untuk handle kondisi default saat edit

            document.getElementById('keputusan').addEventListener('change', function() {
                toggleTanggalPencairan();
            });
        });
    </script>
@endsection
