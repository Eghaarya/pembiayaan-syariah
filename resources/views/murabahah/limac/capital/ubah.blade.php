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
                                                aria-selected="true">Pembiayaan</button>
                                            <button class="nav-link" id="nav-3-tab" data-toggle="tab" data-target="#nav-3"
                                                type="button" role="tab" aria-controls="nav-3"
                                                aria-selected="true">Besarnya Urbun</button>
                                        </div>
                                    </nav>

                                    <div class="tab-content p-3" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-1" role="tabpanel"
                                            aria-labelledby="nav-1-tab">
                                            <input type="hidden" name="kode_nasabah"
                                                value="{{ $pengajuan->kode_nasabah }}">
                                            <input type="hidden" name="nama_nasabah"
                                                value="{{ $pengajuan->nama_nasabah }}">
                                            <input type="hidden" name="username" value="{{ $pengajuan->username }}">
                                            <input type="hidden" name="kode_tempat" value="{{ $pengajuan->kode_tempat }}">

                                            <h6 class="border-bottom pb-2">Aktiva Lancar</h6>

                                            <div class="row g-3 p-1">
                                                <div class="table-responsive">
                                                    <table id="table-aset-aktivalancar" class="table table-bordered">
                                                        <thead class="thead-light">
                                                            <tr class="text-center">
                                                                <th class="p-1 bg-white text-center">#</th>
                                                                <th class="p-1 bg-white text-center">Keterangan</th>
                                                                <th class="p-1 bg-white text-center">Nilai (Rp.)</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($pengajuan_aset_aktivalancar as $i => $item)
                                                                <tr>
                                                                    <input type="hidden"
                                                                        name="id_aset_aktivalancar[{{ $i }}][id]"
                                                                        value="{{ $item->id }}">
                                                                    <td class="p-1 text-center align-middle">
                                                                        {{ $i + 1 }}</td>
                                                                    <td class="p-1">
                                                                        <input type="text"
                                                                            name="id_aset_aktivalancar[{{ $i }}][keterangan]"
                                                                            class="form-control form-control-sm text-center"
                                                                            value="{{ $item->aktiva_lancar_keterangan }}">
                                                                    </td>
                                                                    <td class="p-1">
                                                                        <input type="number"
                                                                            name="id_aset_aktivalancar[{{ $i }}][nilai]"
                                                                            class="form-control form-control-sm text-center"
                                                                            value="{{ $item->aktiva_lancar_nilai }}"
                                                                            step="0.01">
                                                                    </td>
                                                                </tr>
                                                            @endforeach

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-end gap-2 mt-3">
                                                <button type="button" id="btn-add-row-aset-aktivalancar"
                                                    class="btn btn-sm btn-info">+
                                                    Tambah baris table</button>
                                                <button type="button" id="btn-remove-row-aset-aktivalancar"
                                                    class="btn btn-sm btn-danger">− Hapus baris table</button>
                                            </div>

                                            <h6 class="border-bottom pb-2">Tanah dan Bangunan</h6>

                                            <div class="row g-3 p-1">
                                                <div class="table-responsive">
                                                    <table id="table-aset-tanahbangunan" class="table table-bordered">
                                                        <thead class="thead-light">
                                                            <tr class="text-center">
                                                                <th class="p-1 bg-white text-center">#</th>
                                                                <th class="p-1 bg-white text-center">Lokasi</th>
                                                                <th class="p-1 bg-white text-center">Luas T/B</th>
                                                                <th class="p-1 bg-white text-center">Status</th>
                                                                <th class="p-1 bg-white text-center">Atas Nama</th>
                                                                <th class="p-1 bg-white text-center">Nilai (Rp.)</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($pengajuan_aset_tanahbangunan as $i => $item)
                                                                <tr>
                                                                    <input type="hidden"
                                                                        name="id_aset_tanahbangunan[{{ $i }}][id]"
                                                                        value="{{ $item->id }}">
                                                                    <td class="p-1 text-center align-middle">
                                                                        {{ $i + 1 }}</td>
                                                                    <td class="p-1">
                                                                        <input type="text"
                                                                            name="id_aset_tanahbangunan[{{ $i }}][lokasi]"
                                                                            class="form-control form-control-sm text-center"
                                                                            value="{{ $item->tanah_lokasi }}">
                                                                    </td>
                                                                    <td class="p-1">
                                                                        <input type="text"
                                                                            name="id_aset_tanahbangunan[{{ $i }}][luas_tanah_bangunan]"
                                                                            class="form-control form-control-sm text-center"
                                                                            value="{{ $item->tanah_luas_tanah_bangunan }}">
                                                                    </td>
                                                                    <td class="p-1">
                                                                        <input type="text"
                                                                            name="id_aset_tanahbangunan[{{ $i }}][status]"
                                                                            class="form-control form-control-sm text-center"
                                                                            value="{{ $item->tanah_status }}">
                                                                    </td>
                                                                    <td class="p-1">
                                                                        <input type="text"
                                                                            name="id_aset_tanahbangunan[{{ $i }}][atas_nama]"
                                                                            class="form-control form-control-sm text-center"
                                                                            value="{{ $item->tanah_atas_nama }}">
                                                                    </td>
                                                                    <td class="p-1">
                                                                        <input type="number"
                                                                            name="id_aset_tanahbangunan[{{ $i }}][nilai]"
                                                                            class="form-control form-control-sm text-center"
                                                                            step="0.01"
                                                                            value="{{ $item->tanah_nilai }}">
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-end gap-2 mt-3">
                                                <button type="button" id="btn-add-row-aset-tanahbangunan"
                                                    class="btn btn-sm btn-info">+
                                                    Tambah baris table</button>
                                                <button type="button" id="btn-remove-row-aset-tanahbangunan"
                                                    class="btn btn-sm btn-danger">− Hapus baris table</button>
                                            </div>


                                            <h6 class="border-bottom pb-2">Kendaraan</h6>

                                            <div class="row g-3 p-1">
                                                <div class="table-responsive">
                                                    <table id="table-aset-kendaraan" class="table table-bordered">
                                                        <thead class="thead-light">
                                                            <tr class="text-center">
                                                                <th class="p-1 bg-white">#</th>
                                                                <th class="p-1 bg-white">Jenis/Merek</th>
                                                                <th class="p-1 bg-white">Tahun Pembuatan</th>
                                                                <th class="p-1 bg-white">Atas Nama</th>
                                                                <th class="p-1 bg-white">Nilai (Rp.)</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($pengajuan_aset_kendaraan as $i => $item)
                                                                <tr>
                                                                    <input type="hidden"
                                                                        name="id_aset_kendaraan[{{ $i }}][id]"
                                                                        value="{{ $item->id }}">
                                                                    <td class="p-1 text-center align-middle">
                                                                        {{ $i + 1 }}</td>
                                                                    <td class="p-1">
                                                                        <input type="text"
                                                                            name="id_aset_kendaraan[{{ $i }}][jenis_merek]"
                                                                            class="form-control form-control-sm text-center"
                                                                            value="{{ $item->kendaraan_jenis_merek }}">
                                                                    </td>
                                                                    <td class="p-1">
                                                                        <input type="text"
                                                                            name="id_aset_kendaraan[{{ $i }}][tahun_pembuatan]"
                                                                            class="form-control form-control-sm text-center"
                                                                            value="{{ $item->kendaraan_tahun_pembuatan }}">
                                                                    </td>
                                                                    <td class="p-1">
                                                                        <input type="text"
                                                                            name="id_aset_kendaraan[{{ $i }}][atas_nama]"
                                                                            class="form-control form-control-sm text-center"
                                                                            value="{{ $item->kendaraan_atas_nama }}">
                                                                    </td>
                                                                    <td class="p-1">
                                                                        <input type="number"
                                                                            name="id_aset_kendaraan[{{ $i }}][nilai]"
                                                                            class="form-control form-control-sm text-center"
                                                                            step="0.01"
                                                                            value="{{ $item->kendaraan_nilai }}">
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-end gap-2 mt-3">
                                                <button type="button" id="btn-add-row-aset-kendaraan"
                                                    class="btn btn-sm btn-info">+
                                                    Tambah baris table</button>
                                                <button type="button" id="btn-remove-row-aset-kendaraan"
                                                    class="btn btn-sm btn-danger">− Hapus baris table</button>
                                            </div>

                                            <h6 class="border-bottom pb-2">Lain - lain (Emas,Saham, Obligasi, dll)</h6>

                                            <div class="row g-3 p-1">
                                                <div class="table-responsive">
                                                    <table id="table-aset-lainnya" class="table table-bordered">
                                                        <thead class="thead-light">
                                                            <tr class="text-center">
                                                                <th class="p-1 bg-white">#</th>
                                                                <th class="p-1 bg-white">Jenis</th>
                                                                <th class="p-1 bg-white">Lokasi</th>
                                                                <th class="p-1 bg-white">Atas Nama</th>
                                                                <th class="p-1 bg-white">Nilai (Rp.)</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($pengajuan_aset_lainnya as $i => $item)
                                                                <tr>
                                                                    <input type="hidden"
                                                                        name="id_aset_lainnya[{{ $i }}][id]"
                                                                        value="{{ $item->id }}">
                                                                    <td class="p-1 text-center align-middle">
                                                                        {{ $i + 1 }}</td>
                                                                    <td class="p-1">
                                                                        <input type="text"
                                                                            name="id_aset_lainnya[{{ $i }}][jenis]"
                                                                            class="form-control form-control-sm text-center"
                                                                            value="{{ $item->lain_jenis }}">
                                                                    </td>
                                                                    <td class="p-1">
                                                                        <input type="text"
                                                                            name="id_aset_lainnya[{{ $i }}][lokasi]"
                                                                            class="form-control form-control-sm text-center"
                                                                            value="{{ $item->lain_lokasi }}">
                                                                    </td>
                                                                    <td class="p-1">
                                                                        <input type="text"
                                                                            name="id_aset_lainnya[{{ $i }}][atas_nama]"
                                                                            class="form-control form-control-sm text-center"
                                                                            value="{{ $item->lain_atas_nama }}">
                                                                    </td>
                                                                    <td class="p-1">
                                                                        <input type="number"
                                                                            name="id_aset_lainnya[{{ $i }}][nilai]"
                                                                            class="form-control form-control-sm text-center"
                                                                            step="0.01"
                                                                            value="{{ $item->lain_nilai }}">
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-end gap-2 mt-3">
                                                <button type="button" id="btn-add-row-aset-lainnya"
                                                    class="btn btn-sm btn-info">+
                                                    Tambah baris table</button>
                                                <button type="button" id="btn-remove-row-aset-lainnya"
                                                    class="btn btn-sm btn-danger">− Hapus baris table</button>
                                            </div>


                                            <div class="d-flex gap-2 justify-content-start mt-3" id="nav-tab"
                                                role="tablist">
                                                <a href="{{ route('murabahah.limac.capital.data') }}"
                                                    class="btn btn-secondary">
                                                    ← Kembali
                                                </a>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="nav-2" role="tabpanel"
                                            aria-labelledby="nav-2-tab">
                                            <div
                                                class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2">
                                                <h6 class="mb-0">Permohonan Pembiayaan</h6>
                                                <a href="{{ route('murabahah.pengajuan.edit', $pengajuan_pembiayaan->kode_pengajuan) }}"
                                                    class="btn btn-sm btn-link text-warning p-1" id="target-shake">
                                                    Ubah data Permohonan Pembiayaan di sini ... <i class="fas fa-edit"></i>
                                                </a>
                                            </div>

                                            <div class="row g-3 mb-3">

                                                <div class="col-md-12 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="permohonan_jenis_akad">
                                                        Jenis Akad
                                                    </label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="permohonan_jenis_akad" name="permohonan_jenis_akad"
                                                        value="{{ old('permohonan_jenis_akad', $pengajuan_pembiayaan->permohonan_jenis_akad ?? '--') }}">
                                                </div>

                                                <div class="col-md-12 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="permohonan_jenis_pembiayaan">
                                                        Jenis Pembiayaan
                                                    </label>
                                                    <select disabled class="form-control border-0 bg-white text-dark"
                                                        id="permohonan_jenis_pembiayaan"
                                                        name="permohonan_jenis_pembiayaan">
                                                        @php
                                                            $options = [
                                                                '--',
                                                                'Pembiayaan rumah (KPR)',
                                                                'Pembiayaan Kendaraan Bermotor (PKB)',
                                                            ];
                                                            $selected = old(
                                                                'permohonan_jenis_pembiayaan',
                                                                $pengajuan_pembiayaan->permohonan_jenis_pembiayaan ??
                                                                    '',
                                                            );
                                                        @endphp

                                                        @foreach ($options as $option)
                                                            <option value="{{ $option }}"
                                                                {{ $selected == $option ? 'selected' : '' }}>
                                                                {{ $option }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-12 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="permohonan_tujuan_penggunaan">
                                                        Tujuan Penggunaan
                                                    </label>
                                                    <select disabled class="form-control border-0 bg-white text-dark"
                                                        id="permohonan_tujuan_penggunaan"
                                                        name="permohonan_tujuan_penggunaan">
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
                                                                'permohonan_tujuan_penggunaan',
                                                                $pengajuan_pembiayaan->permohonan_tujuan_penggunaan ??
                                                                    '',
                                                            );
                                                        @endphp

                                                        @foreach ($options as $option)
                                                            <option value="{{ $option }}"
                                                                {{ $selected == $option ? 'selected' : '' }}>
                                                                {{ $option }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-12 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="permohonan_harga_jual_barang">
                                                        Harga Jual Barang
                                                    </label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="permohonan_harga_jual_barang"
                                                        name="permohonan_harga_jual_barang"
                                                        value="{{ old('permohonan_harga_jual_barang', $pengajuan_pembiayaan->permohonan_harga_jual_barang ?? '--') }}">
                                                </div>

                                                <div class="col-md-12 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="permohonan_urbun_uangmuka">
                                                        Urbun / Uang Muka
                                                    </label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="permohonan_urbun_uangmuka" name="permohonan_urbun_uangmuka"
                                                        value="{{ old('permohonan_urbun_uangmuka', $pengajuan_pembiayaan->permohonan_urbun_uangmuka ?? '--') }}">
                                                </div>

                                                <div class="col-md-12 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="permohonan_harga_beli_bank">
                                                        Harga Beli Bank
                                                    </label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="permohonan_harga_beli_bank" name="permohonan_harga_beli_bank"
                                                        value="{{ old('permohonan_harga_beli_bank', $pengajuan_pembiayaan->permohonan_harga_beli_bank ?? '--') }}">
                                                </div>

                                                <!-- Jangka Waktu Pembiayaan (tahun) -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="permohonan_jangka_waktu_pembiayaan">
                                                        Jangka Waktu Pembiayaan (tahun)
                                                    </label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="permohonan_jangka_waktu_pembiayaan"
                                                        name="permohonan_jangka_waktu_pembiayaan"
                                                        value="{{ old('permohonan_jangka_waktu_pembiayaan', $pengajuan_pembiayaan->permohonan_jangka_waktu_pembiayaan ?? '--') }}">
                                                </div>

                                                <!-- Output bulan -->
                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark">Jangka Waktu
                                                        (bulan)</label>
                                                    <div id="permohonan_jangka_waktu_bulan" class="mt-1">—</div>
                                                </div>

                                                <!-- Margin Bank -->
                                                <div class="col-md-3 mt-2">
                                                    <label class="form-label fw-bold text-dark"
                                                        for="permohonan_margin_bank">
                                                        Margin Bank (% per bulan)
                                                    </label>
                                                    <input disabled type="text"
                                                        class="form-control border-0 bg-white text-dark"
                                                        id="permohonan_margin_bank" name="permohonan_margin_bank"
                                                        value="{{ old('permohonan_margin_bank', $pengajuan_pembiayaan->permohonan_margin_bank ?? '--') }}">
                                                </div>

                                                <div class="col-md-3 mt-2">
                                                    <label class="form-label fw-bold text-dark">Margin Bank per
                                                        Tahun</label>
                                                    <div id="permohonan_margin_tahun_output" class="mt-1">—</div>
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label class="form-label fw-bold text-dark">Nominal Margin Bank</label>
                                                    <div id="permohonan_margin_nominal_output" class="mt-1">—</div>
                                                </div>

                                                <div class="col-md-12 mt-2">
                                                    <label class="form-label fw-bold text-dark">Harga Jual Bank</label>
                                                    <div id="permohonan_harga_jual_output" class="mt-1">—</div>
                                                </div>

                                                <div class="col-md-12 mt-2">
                                                    <label class="form-label fw-bold text-dark">Angsuran Bank</label>
                                                    <div id="permohonan_angsuran_bank_output" class="mt-1">—</div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="nav-3" role="tabpanel"
                                            aria-labelledby="nav-3-tab">

                                            <div class="row g-3 mb-3">
                                                <div class="col-md-12 mt-2">
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
@endsection
