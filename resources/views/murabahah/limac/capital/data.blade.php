@extends('layouts.app')

@section('content')
    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="card card-social">
                    <div class="card-block border-bottom">
                        <div class="row">
                            <div class="d-flex justify-content-between mb-3">
                                <h6 class="m-0">
                                    {{ ucwords(str_replace('_', ' ', explode('.', Route::currentRouteName())[2] ?? '')) }}
                                </h6>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr class="text-center">
                                            <th rowspan="3" class="align-middle p-2">Aksi</th>
                                            <th rowspan="3" class="align-middle p-2">No</th>
                                            <th rowspan="3" class="align-middle p-2">Kode Pengajuan</th>
                                            <th rowspan="3" class="align-middle p-2">Kode Nasabah</th>
                                            <th rowspan="3" class="align-middle p-2">Nama Nasabah</th>
                                            <th colspan="45" class="align-middle p-2">Data Aset/ Kekayaan</th>
                                            <th rowspan="2" colspan="8" class="align-middle p-2">Pembiayaan</th>
                                            <th rowspan="3" class="align-middle text-info p-2">% Besarnya Urbun</th>
                                        </tr>
                                        <tr class="text-center">
                                            <th class="text-secondary" colspan="6">Aktiva Lancar</th>
                                            <th class="bg-white text-secondary" colspan="15">Tanah & Bangunan</th>
                                            <th class="text-secondary" colspan="12">Kendaraan</th>
                                            <th class="bg-white text-secondary" colspan="12">Aset Lain-lain</th>
                                        </tr>
                                        <tr class="text-center">

                                            @for ($i = 1; $i <= 3; $i++)
                                                <th class="bg-white text-secondary">Keterangan (tabungan/deposito/giro)</th>
                                                <th class="bg-white text-secondary">Nilai</th>
                                            @endfor

                                            @for ($i = 1; $i <= 3; $i++)
                                                <th class="bg-white text-secondary">Lokasi Tanah</th>
                                                <th class="bg-white text-secondary">Luas T/B</th>
                                                <th class="bg-white text-secondary">Status</th>
                                                <th class="bg-white text-secondary">Atas Nama</th>
                                                <th class="bg-white text-secondary">Nilai</th>
                                            @endfor

                                            @for ($i = 1; $i <= 3; $i++)
                                                <th class="bg-white text-secondary">Jenis/Merek</th>
                                                <th class="bg-white text-secondary">Tahun Pembuatan</th>
                                                <th class="bg-white text-secondary">Atas Nama</th>
                                                <th class="bg-white text-secondary">Nilai</th>
                                            @endfor

                                            @for ($i = 1; $i <= 3; $i++)
                                                <th class="bg-white text-secondary">Jenis Aset</th>
                                                <th class="bg-white text-secondary">Lokasi</th>
                                                <th class="bg-white text-secondary">Atas Nama</th>
                                                <th class="bg-white text-secondary">Nilai</th>
                                            @endfor

                                            <th class="bg-white text-secondary">Jenis Akad</th>
                                            <th class="bg-white text-secondary">Jenis Pembiayaan</th>
                                            <th class="bg-white text-secondary">Tujuan Penggunaan</th>
                                            <th class="bg-white text-secondary">Harga Jual Barang</th>
                                            <th class="bg-white text-secondary">Urbun/ Uang muka</th>
                                            <th class="bg-white text-secondary">Harga Beli Bank</th>
                                            <th class="bg-white text-secondary">Jangka Waktu Pembiayaan</th>
                                            <th class="bg-white text-secondary">Margin Bank</th>
                                        </tr>

                                    </thead>

                                    <tbody>
                                        @forelse ($murabahah_limac_capital as $index => $item)
                                            <tr class="text-center">
                                                <td class="text-center align-middle text-wrap p-2">
                                                    <a href="{{ route('murabahah.limac.capital.edit', $item->kode_pengajuan) }}"
                                                        class="text-warning" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </td>
                                                <td class="text-center align-middle text-wrap p-2">
                                                    {{ $murabahah_limac_capital->firstItem() + $index }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->kode_pengajuan }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->kode_nasabah }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->nama_nasabah }}</td>

                                                @for ($i = 1; $i <= 3; $i++)
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item->{'aktiva_lancar_keterangan_' . $i} }}</td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item->{'aktiva_lancar_nilai_' . $i} }}</td>
                                                @endfor

                                                @for ($i = 1; $i <= 3; $i++)
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item->{'tanah_lokasi_' . $i} }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item->{'tanah_luas_tanah_bangunan_' . $i} }}</td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item->{'tanah_status_' . $i} }}</td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item->{'tanah_atas_nama_' . $i} }}</td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item->{'tanah_nilai_' . $i} }}
                                                    </td>
                                                @endfor

                                                @for ($i = 1; $i <= 3; $i++)
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item->{'kendaraan_jenis_merek_' . $i} }}</td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item->{'kendaraan_tahun_pembuatan_' . $i} }}</td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item->{'kendaraan_atas_nama_' . $i} }}</td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item->{'kendaraan_nilai_' . $i} }}</td>
                                                @endfor

                                                @for ($i = 1; $i <= 3; $i++)
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item->{'lain_jenis_' . $i} }}</td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item->{'lain_lokasi_' . $i} }}</td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item->{'lain_atas_nama_' . $i} }}</td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item->{'lain_nilai_' . $i} }}</td>
                                                @endfor

                                                <td class="align-middle text-wrap p-2">{{ $item->jenis_akad }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->jenis_pembiayaan }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->tujuan_penggunaan }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->harga_jual_barang }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->urbun_uangmuka }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->harga_beli_bank }}</td>
                                                <td class="align-middle text-wrap p-2">
                                                    {{ $item->jangka_waktu_pembiayaan }}
                                                </td>
                                                <td class="align-middle text-wrap p-2">{{ $item->margin_bank }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->besarnya_urbun }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="134" class="text-start">Data tidak ditemukan.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            {{-- Pagination --}}
                            <div class="d-flex justify-content-start mt-3">
                                {{ $murabahah_limac_capital->links() }}
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
@endsection
