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
                                            <th colspan="15" class="align-middle p-2">Scooring Condition of Economy
                                            </th>
                                        </tr>
                                        <tr class="text-center border border-dark">
                                            <th class="bg-white text-info">Apakah usaha atau perusahaan tempat nasabah
                                                mampu bertahan dalam persaingan di Indonesia dilihat dari lamanya perusahaan
                                                berdiri?</th>
                                            <th class="bg-white text-info">Apakah bidang pekerjaan atau bidang uaha
                                                nasabah termasuk bidang usaha yang jarang ditemukan di Indonesia?</th>
                                            <th class="bg-white text-info">Apakah cakupan wilayah perusahaan dan usaha
                                                nasabah luas dilihat dari skala usaha semakin besar skala usaha maka semakin
                                                mampu bertahan </th>
                                        </tr>

                                    </thead>

                                    <tbody>
                                        @forelse ($multiguna_limac_condition as $index => $item)
                                            <tr class="text-center">
                                                <td class="text-center align-middle text-wrap p-2">
                                                    <a href="{{ route('multiguna.limac.condition.edit', $item->kode_pengajuan) }}"
                                                        class="text-warning" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </td>
                                                <td class="text-center align-middle text-wrap p-2">
                                                    {{ $multiguna_limac_condition->firstItem() + $index }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->kode_pengajuan }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->kode_nasabah }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->nama_nasabah }}</td>

                                                <td class="align-middle text-wrap p-2">{{ $item->ketahanan_usaha_berdiri }}
                                                </td>
                                                <td class="align-middle text-wrap p-2">{{ $item->bidang_usaha_langka }}</td>
                                                <td class="align-middle text-wrap p-2">
                                                    {{ $item->cakupan_wilayah_skala_usaha }}</td>


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
                                {{ $multiguna_limac_condition->links() }}
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
@endsection
