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
                                <table class="table border table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <th class="align-middle p-3" rowspan="3">Aksi</th>
                                            <th class="align-middle p-3" rowspan="3">No</th>
                                            <th class="align-middle p-3" rowspan="3">Kode Pengajuan</th>
                                            <th class="align-middle p-3" rowspan="3">Kode Nasabah</th>
                                            <th class="align-middle p-2" rowspan="3">Nama Nasabah</th>
                                            <th class="align-middle p-3" colspan="5">Reputasi Nasabah dalam Pekerjaan
                                            <th class="align-middle bg-white p-3" colspan="5">Fasilitas Dinas yang
                                                Diterima
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="align-middle bg-white text-info p-3">Memiliki Jabatan Rangkap</th>
                                            <th class="align-middle bg-white text-info p-3">Publik Figur</th>
                                            <th class="align-middle bg-white text-info p-3">Pemegang Jabatan Tertinggi</th>
                                            <th class="align-middle bg-white text-info p-3">Bukan Pemegang Jabatan Tertinggi
                                            </th>
                                            <th class="align-middle bg-white text-info p-3">Non Jabatan</th>

                                            <th class="align-middle bg-white text-info p-3">Mendapat Rumah Dinas</th>
                                            <th class="align-middle bg-white text-info p-3">Mendapat Mobil Dinas</th>
                                            <th class="align-middle bg-white text-info p-3">Mendapat Sepeda Motor Dinas</th>
                                            <th class="align-middle bg-white text-info p-3">Mendapat Fasilitas Pinjaman Uang
                                            </th>
                                            <th class="align-middle bg-white text-info p-3">Belum Mendapat Fasilitas Dinas
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($multiguna_limac_capacity as $index => $murabahah)
                                            <tr>
                                                <td class="align-middle text-center p-1">
                                                    <a href="{{ route('multiguna.limac.capacity.edit', $murabahah->kode_pengajuan) }}"
                                                        class="btn btn-sm btn-link text-warning p-1">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </td>
                                                <td class="align-middle text-center text-wrap p-1">
                                                    {{ $multiguna_limac_capacity->firstItem() + $index }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">{{ $murabahah->kode_pengajuan }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">{{ $murabahah->kode_nasabah }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">{{ $murabahah->nama_nasabah }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $murabahah->memiliki_jabatan_rangkap }}</td>
                                                <td class="align-middle text-wrap p-1">{{ $murabahah->publik_figur }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $murabahah->pemegang_jabatan_tertinggi }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $murabahah->bukan_pemegang_jabatan_tertinggi }}</td>
                                                <td class="align-middle text-wrap p-1">{{ $murabahah->non_jabatan }}</td>

                                                <td class="align-middle text-wrap p-1">
                                                    {{ $murabahah->mendapat_rumah_dinas }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $murabahah->mendapat_mobil_dinas }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $murabahah->mendapat_sepeda_motor_dinas }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $murabahah->mendapat_fasilitas_pinjaman_uang }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $murabahah->belum_mendapat_fasilitas_dinas }}</td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="47" class="text-start">Data nasabah tidak ditemukan.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            {{-- Pagination --}}
                            <div class="d-flex justify-content-start mt-3">
                                {{ $multiguna_limac_capacity->links() }}
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
@endsection
