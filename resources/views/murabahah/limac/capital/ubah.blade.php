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
                                <form action="{{ route('murabahah.limac.capital.update', $pengajuan->kode_pengajuan) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')

                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-1-tab" data-toggle="tab"
                                                data-target="#nav-1" type="button" role="tab" aria-controls="nav-1"
                                                aria-selected="true">Data Aset/ Kekayaan</button>
                                            <button class="nav-link" id="nav-2-tab" data-toggle="tab" data-target="#nav-2"
                                                type="button" role="tab" aria-controls="nav-2"
                                                aria-selected="true">Urbun Pembiayaan</button>
                                        </div>
                                    </nav>

                                    <div class="tab-content p-3" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-1" role="tabpanel"
                                            aria-labelledby="nav-1-tab">
                                            <h6 class="border-bottom pb-2">Data Aset/ Kekayaan</h6>

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
                                            <h6 class="border-bottom pb-2">Urbun Pembiayaan</h6>

                                            <div class="row g-3 mb-3">

                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark" for="jenis_akad">
                                                        Jenis Akad
                                                    </label>
                                                    <input type="text" class="form-control" id="jenis_akad"
                                                        name="jenis_akad"
                                                        value="{{ old('jenis_akad', $pengajuan->jenis_akad ?? '') }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark" for="jenis_pembiayaan">
                                                        Tujuan Penggunaan
                                                    </label>
                                                    <select class="form-control" id="jenis_pembiayaan"
                                                        name="jenis_pembiayaan">
                                                        @php
                                                            $options = [
                                                                '--',
                                                                'Pembiayaan rumah (KPR)',
                                                                'Pembiayaan Kendaraan Bermotor (PKB)',
                                                            ];
                                                            $selected = old(
                                                                'jenis_pembiayaan',
                                                                $pengajuan->jenis_pembiayaan ?? '',
                                                            );
                                                        @endphp

                                                        @foreach ($options as $option)
                                                            <option value="{{ $option }}"
                                                                {{ $selected == $option ? 'selected' : '' }}>
                                                                {{ $option }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark" for="tujuan_penggunaan">
                                                        Tujuan Penggunaan
                                                    </label>
                                                    <select class="form-control" id="tujuan_penggunaan"
                                                        name="tujuan_penggunaan">
                                                        @php
                                                            $options = [
                                                                '--',
                                                                'Pembelian rumah baru',
                                                                'Pembelian Rumah lama',
                                                                'Pembelian Kendaraan Baru',
                                                                'Pembelian Kendaraan lama',
                                                                'Take over KPR',
                                                                'Take Over KKB',
                                                            ];
                                                            $selected = old(
                                                                'tujuan_penggunaan',
                                                                $pengajuan->tujuan_penggunaan ?? '',
                                                            );
                                                        @endphp

                                                        @foreach ($options as $option)
                                                            <option value="{{ $option }}"
                                                                {{ $selected == $option ? 'selected' : '' }}>
                                                                {{ $option }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark" for="harga_jual_barang">
                                                        Harga Jual Barang
                                                    </label>
                                                    <input type="number" class="form-control" id="harga_jual_barang"
                                                        name="harga_jual_barang"
                                                        value="{{ old('harga_jual_barang', $pengajuan->harga_jual_barang ?? '') }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark" for="urbun_uangmuka">
                                                        Urbun / Uang Muka
                                                    </label>
                                                    <input type="number" class="form-control" id="urbun_uangmuka"
                                                        name="urbun_uangmuka"
                                                        value="{{ old('urbun_uangmuka', $pengajuan->urbun_uangmuka ?? '') }}">
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark" for="harga_beli_bank">
                                                        Harga Beli Bank
                                                    </label>
                                                    <input type="number" class="form-control" id="harga_beli_bank"
                                                        name="harga_beli_bank"
                                                        value="{{ old('harga_beli_bank', $pengajuan->harga_beli_bank ?? '') }}">
                                                </div>

                                                <!-- Jangka Waktu Pembiayaan (tahun) -->
                                                <div class="col-md-3 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="jangka_waktu_pembiayaan">
                                                        Jangka Waktu Pembiayaan (tahun)
                                                    </label>
                                                    <input type="number" class="form-control" id="jangka_waktu_pembiayaan"
                                                        name="jangka_waktu_pembiayaan"
                                                        value="{{ old('jangka_waktu_pembiayaan', $pengajuan->jangka_waktu_pembiayaan ?? '') }}">
                                                </div>

                                                <!-- Output bulan -->
                                                <div class="col-md-3 mt-2">
                                                    <label class="form-label fw-bold text-dark">Jangka Waktu
                                                        (bulan)</label>
                                                    <div id="jangka_waktu_bulan" class="mt-1">—</div>
                                                </div>

                                                <!-- Margin Bank -->
                                                <div class="col-md-3 mt-2">
                                                    <label class="form-label fw-bold text-dark" for="margin_bank">
                                                        Margin Bank (% per bulan)
                                                    </label>
                                                    <input type="number" class="form-control" id="margin_bank"
                                                        name="margin_bank"
                                                        value="{{ old('margin_bank', $pengajuan->margin_bank ?? '') }}">
                                                </div>

                                                <div class="col-md-3 mt-2">
                                                    <label class="form-label fw-bold text-dark">Margin Bank per
                                                        Tahun</label>
                                                    <div id="margin_tahun_output" class="mt-1">—</div>
                                                </div>

                                                <div class="col-md-3 mt-2">
                                                    <label class="form-label fw-bold text-dark">Nominal Margin Bank</label>
                                                    <div id="margin_nominal_output" class="mt-1">—</div>
                                                </div>

                                                <div class="col-md-3 mt-2">
                                                    <label class="form-label fw-bold text-dark">Harga Jual Bank</label>
                                                    <div id="harga_jual_output" class="mt-1">—</div>
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-info" for="besarnya_urbun">
                                                        Besarnya Urbun
                                                    </label>
                                                    <select class="form-control" id="besarnya_urbun"
                                                        name="besarnya_urbun">
                                                        @php
                                                            $urbunOptions = [
                                                                '--',
                                                                '0% dari harga agunan (1)',
                                                                '0-30% dari harga agunan (7)',
                                                                '30%-50% dari harga agunan (8)',
                                                                '50%-99% dari harga agunan (10)',
                                                            ];
                                                            $selectedUrbun = old(
                                                                'besarnya_urbun',
                                                                $pengajuan->besarnya_urbun ?? '',
                                                            );
                                                        @endphp

                                                        <option value="" disabled
                                                            {{ $selectedUrbun == '' ? 'selected' : '' }}>-- Pilih Besarnya
                                                            Urbun --</option>
                                                        @foreach ($urbunOptions as $option)
                                                            <option value="{{ $option }}"
                                                                {{ $selectedUrbun == $option ? 'selected' : '' }}>
                                                                {{ $option }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>

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

    <script>
        // Menghitung jangka waktu dalam bulan
        function updateBulan() {
            const tahunInput = document.getElementById('jangka_waktu_pembiayaan').value;
            const bulanOutput = document.getElementById('jangka_waktu_bulan');

            if (tahunInput !== '' && !isNaN(tahunInput)) {
                const bulan = parseInt(tahunInput) * 12;
                bulanOutput.innerText = bulan + ' bulan';
            } else {
                bulanOutput.innerText = '—';
            }
        }

        // Menghitung margin bank per tahun dan nominal margin
        function updateMarginOutput() {
            const marginInput = document.getElementById('margin_bank');
            const waktuInput = document.getElementById('jangka_waktu_pembiayaan');
            const hargaInput = document.getElementById('harga_beli_bank');

            const marginTahunOutput = document.getElementById('margin_tahun_output');
            const nominalOutput = document.getElementById('margin_nominal_output');
            const hargaJualOutput = document.getElementById('harga_jual_output');

            const marginPerBulan = parseFloat(marginInput?.value) || 0;
            const jangkaTahun = parseFloat(waktuInput?.value) || 0;
            const hargaBeli = parseFloat(hargaInput?.value) || 0;

            // Hitung margin per tahun
            const marginTahun = marginPerBulan * jangkaTahun;
            marginTahunOutput.innerText = jangkaTahun > 0 ? `${marginTahun.toFixed(2)}%` : '—';

            // Hitung nominal margin dan harga jual jika semua valid
            if (marginPerBulan > 0 && jangkaTahun > 0 && hargaBeli > 0) {
                const nominalMargin = (marginTahun / 100) * hargaBeli;
                const hargaJual = hargaBeli + nominalMargin;

                nominalOutput.innerText = `Rp ${nominalMargin.toLocaleString('id-ID')}`;
                hargaJualOutput.innerText = `Rp ${hargaJual.toLocaleString('id-ID')}`;
            } else {
                nominalOutput.innerText = '—';
                hargaJualOutput.innerText = '—';
            }
        }

        // Inisialisasi saat halaman dimuat dan setiap input berubah
        document.addEventListener('DOMContentLoaded', function() {
            updateBulan();
            updateMarginOutput();

            document.getElementById('jangka_waktu_pembiayaan').addEventListener('input', () => {
                updateBulan();
                updateMarginOutput();
            });

            document.getElementById('margin_bank').addEventListener('input', updateMarginOutput);
            document.getElementById('harga_beli_bank').addEventListener('input', updateMarginOutput);
        });
    </script>
@endsection
