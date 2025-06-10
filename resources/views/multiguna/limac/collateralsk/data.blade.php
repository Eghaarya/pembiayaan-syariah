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
                                            <th colspan="2" class="align-middle p-2">Scooring Collateral SK
                                            </th>
                                        </tr>
                                        <tr class="text-center border border-dark">
                                            <th class="bg-white text-info">SK Pengangkatan Pegawai Tetap</th>
                                            <th class="bg-white text-info">SK Jabatan Terakhir/Terkini</th>
                                        </tr>

                                    </thead>

                                    <tbody>
                                        @forelse ($multiguna_limac_collateralsk as $index => $item)
                                            <tr class="text-center">
                                                <td class="text-center align-middle text-wrap p-2">
                                                    <a href="{{ route('multiguna.limac.collateralsk.edit', $item->kode_pengajuan) }}"
                                                        class="text-warning" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </td>
                                                <td class="text-center align-middle text-wrap p-2">
                                                    {{ $multiguna_limac_collateralsk->firstItem() + $index }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->kode_pengajuan }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->kode_nasabah }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->nama_nasabah }}</td>

                                                <td class="align-middle text-wrap p-2">
                                                    {{ $item->sk_pengangkatan_pegawai_tetap }}</td>
                                                <td class="align-middle text-wrap p-2">
                                                    {{ $item->sk_jabatan_terakhir_terkini }}</td>

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
                                {{ $multiguna_limac_collateralsk->links() }}
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
@endsection
