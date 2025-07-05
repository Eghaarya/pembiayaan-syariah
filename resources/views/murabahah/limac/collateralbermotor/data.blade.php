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
                                            <th rowspan="2" class="align-middle p-2">Aksi</th>
                                            <th rowspan="2" class="align-middle p-2">No</th>
                                            <th rowspan="2" class="align-middle p-2">Kode Pengajuan</th>
                                            <th rowspan="2" class="align-middle p-2">Kode Nasabah</th>
                                            <th rowspan="2" class="align-middle p-2">Nama Nasabah</th>
                                            <th colspan="16" class="align-middle p-2">Scooring Collateral Bermotor
                                            </th>
                                        </tr>
                                        <tr class="text-center border border-dark">
                                            <th class="bg-white text-info">Tujuan Penggunaan</th>
                                            <th class="bg-white text-info">Jenis Kendaraan</th>
                                            <th class="bg-white text-info">Status Agunan Kendaraan</th>
                                            <th class="bg-white text-secondary">Nomor STNK Agunan</th>
                                            <th class="bg-white text-secondary">Nama Pemilik Agunan</th>
                                            <th class="bg-white text-secondary">Alamat Pemilik Agunan</th>
                                            <th class="bg-white text-secondary">Merk Agunan</th>
                                            <th class="bg-white text-info">Tipe Agunan</th>
                                            <th class="bg-white text-info">Teknologi</th>
                                            <th class="bg-white text-info">Bahan Bakar</th>
                                            <th class="bg-white text-secondary">Warna Agunan</th>
                                            <th class="bg-white text-secondary">Isi Silinder</th>
                                            <th class="bg-white text-secondary">Nomor Rangka Agunan</th>
                                            <th class="bg-white text-secondary">Nomor Mesin Agunan</th>
                                            <th class="bg-white text-secondary">Tahun Pembuatan</th>
                                            <th class="bg-white text-secondary">Masa Berlaku</th>
                                        </tr>

                                    </thead>

                                    <tbody>
                                        @forelse ($murabahah_limac_collateralbermotor as $index => $item)
                                            <tr class="text-center">
                                                <td class="text-center align-middle text-wrap p-2">
                                                    <a href="{{ route('murabahah.limac.collateralbermotor.edit', $item->kode_pengajuan) }}"
                                                        class="text-warning" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </td>
                                                <td class="text-center align-middle text-wrap p-2">
                                                    {{ $murabahah_limac_collateralbermotor->firstItem() + $index }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->kode_pengajuan }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->kode_nasabah }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->nama_nasabah }}</td>

                                                <td class="align-middle text-wrap p-2">{{ $item->tujuan_penggunaan }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->jenis_kendaraan }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->status_agunan_kendaraan }}
                                                </td>
                                                <td class="align-middle text-wrap p-2">{{ $item->nomor_stnk_agunan }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->nama_pemilik_agunan }}
                                                </td>
                                                <td class="align-middle text-wrap p-2">{{ $item->alamat_pemilik_agunan }}
                                                </td>
                                                <td class="align-middle text-wrap p-2">{{ $item->merk_agunan }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->tipe_agunan }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->teknologi }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->bahan_bakar }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->warna_agunan }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->isi_silinder }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->nomor_rangka_agunan }}
                                                </td>
                                                <td class="align-middle text-wrap p-2">{{ $item->nomor_mesin_agunan }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->tahun_pembuatan }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->masa_berlaku }}</td>

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
                                {{ $murabahah_limac_collateralbermotor->links() }}
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
@endsection
