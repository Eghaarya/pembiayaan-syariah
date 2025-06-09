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
                                            <th colspan="5" class="align-middle p-2">Pembiayaan</th>
                                            <th rowspan="3" class="align-middle text-info p-2">% Besarnya Urbun</th>
                                        </tr>
                                        <tr class="text-center border border-dark">
                                            <th class="bg-white text-secondary">Jenis Akad</th>
                                            <th class="bg-white text-secondary">Tujuan Penggunaan</th>
                                            <th class="bg-white text-secondary">Harga Beli Bank</th>
                                            <th class="bg-white text-secondary">Jangka Waktu Pembiayaan</th>
                                            <th class="bg-white text-secondary">Margin Bank</th>
                                        </tr>

                                    </thead>

                                    <tbody>
                                        @forelse ($multiguna_limac_capital as $index => $item)
                                            <tr>
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

                                                <td class="align-middle text-wrap p-2">{{ $item->jenis_akad }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->tujuan_penggunaan }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->harga_beli_bank }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->jangka_waktu_pembiayaan }}
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
