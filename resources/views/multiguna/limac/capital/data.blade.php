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
                                            <th colspan="190" class="align-middle p-2">Data Aset/ Kekayaan</th>
                                        </tr>
                                        <tr class="text-center">
                                            @for ($i = 1; $i <= 10; $i++)
                                                <th class="text-secondary {{ $i % 2 == 0 ? 'bg-white text-secondary' : '' }}"
                                                    colspan="3">Aktiva Lancar {{ $i }}</th>
                                            @endfor
                                            @for ($i = 1; $i <= 10; $i++)
                                                <th class="text-secondary {{ $i % 2 == 0 ? 'bg-white text-secondary' : '' }}"
                                                    colspan="6">Tanah & Bangunan {{ $i }}</th>
                                            @endfor
                                            @for ($i = 1; $i <= 10; $i++)
                                                <th class="text-secondary {{ $i % 2 == 0 ? 'bg-white text-secondary' : '' }}"
                                                    colspan="5">Kendaraan {{ $i }}</th>
                                            @endfor
                                            @for ($i = 1; $i <= 10; $i++)
                                                <th class="text-secondary {{ $i % 2 == 0 ? 'bg-white text-secondary' : '' }}"
                                                    colspan="5">Aset Lain-lain {{ $i }}</th>
                                            @endfor
                                        </tr>
                                        <tr class="text-center">

                                            @for ($i = 1; $i <= 10; $i++)
                                                <th class="bg-white text-secondary">#</th>
                                                <th class="bg-white text-secondary">Keterangan (tabungan/deposito/giro)</th>
                                                <th class="bg-white text-secondary">Nilai</th>
                                            @endfor

                                            @for ($i = 1; $i <= 10; $i++)
                                                <th class="bg-white text-secondary">#</th>
                                                <th class="bg-white text-secondary">Lokasi Tanah</th>
                                                <th class="bg-white text-secondary">Luas T/B</th>
                                                <th class="bg-white text-secondary">Status</th>
                                                <th class="bg-white text-secondary">Atas Nama</th>
                                                <th class="bg-white text-secondary">Nilai</th>
                                            @endfor

                                            @for ($i = 1; $i <= 10; $i++)
                                                <th class="bg-white text-secondary">#</th>
                                                <th class="bg-white text-secondary">Jenis/Merek</th>
                                                <th class="bg-white text-secondary">Tahun Pembuatan</th>
                                                <th class="bg-white text-secondary">Atas Nama</th>
                                                <th class="bg-white text-secondary">Nilai</th>
                                            @endfor

                                            @for ($i = 1; $i <= 10; $i++)
                                                <th class="bg-white text-secondary">#</th>
                                                <th class="bg-white text-secondary">Jenis Aset</th>
                                                <th class="bg-white text-secondary">Lokasi</th>
                                                <th class="bg-white text-secondary">Atas Nama</th>
                                                <th class="bg-white text-secondary">Nilai</th>
                                            @endfor

                                        </tr>

                                    </thead>

                                    <tbody>
                                        @forelse ($multiguna_limac_capital as $index => $item)
                                            <tr class="text-center">
                                                <td class="text-center align-middle text-wrap p-2">
                                                    <a href="{{ route('multiguna.limac.capital.edit', $item->kode_pengajuan) }}"
                                                        class="text-warning" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </td>
                                                <td class="text-center align-middle text-wrap p-2">
                                                    {{ $multiguna_limac_capital->firstItem() + $index }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->kode_pengajuan }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->kode_nasabah }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->nama_nasabah }}</td>

                                                @php
                                                    $AsetAktivalancar =
                                                        $pengajuan_aset_aktivalancar[$item->kode_pengajuan] ??
                                                        collect();
                                                @endphp

                                                @for ($i = 0; $i < 10; $i++)
                                                    @php
                                                        $item_aktivalancar = $AsetAktivalancar[$i] ?? null;
                                                    @endphp

                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $i + 1 }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item_aktivalancar?->aktiva_lancar_keterangan ?? '' }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item_aktivalancar?->aktiva_lancar_nilai ?? '' }}
                                                    </td>
                                                @endfor

                                                @php
                                                    $AsetTanahbangunan =
                                                        $pengajuan_aset_tanahbangunan[$item->kode_pengajuan] ??
                                                        collect();
                                                @endphp

                                                @for ($i = 0; $i < 10; $i++)
                                                    @php
                                                        $item_aktivalancar = $AsetTanahbangunan[$i] ?? null;
                                                    @endphp

                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $i + 1 }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item_aktivalancar?->tanah_lokasi }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item_aktivalancar?->tanah_luas_tanah_bangunan }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item_aktivalancar?->tanah_status }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item_aktivalancar?->tanah_atas_nama }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item_aktivalancar?->tanah_nilai }}
                                                    </td>
                                                @endfor

                                                @php
                                                    $AsetKendaraaan =
                                                        $pengajuan_aset_kendaraan[$item->kode_pengajuan] ?? collect();
                                                @endphp

                                                @for ($i = 0; $i < 10; $i++)
                                                    @php
                                                        $item_kendaraan = $AsetKendaraaan[$i] ?? null;
                                                    @endphp

                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $i + 1 }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item_kendaraan?->kendaraan_jenis_merek }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item_kendaraan?->kendaraan_tahun_pembuatan }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item_kendaraan?->kendaraan_atas_nama }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item_kendaraan?->kendaraan_nilai }}
                                                    </td>
                                                @endfor

                                                @php
                                                    $AsetLainnya =
                                                        $pengajuan_aset_lainnya[$item->kode_pengajuan] ?? collect();
                                                @endphp

                                                @for ($i = 0; $i < 10; $i++)
                                                    @php
                                                        $item_lainnya = $AsetLainnya[$i] ?? null;
                                                    @endphp

                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $i + 1 }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item_lainnya?->lain_jenis }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item_lainnya?->lain_lokasi }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item_lainnya?->lain_atas_nama }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item_lainnya?->lain_nilai }}
                                                    </td>
                                                @endfor

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
                                {{ $multiguna_limac_capital->links() }}
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
@endsection
