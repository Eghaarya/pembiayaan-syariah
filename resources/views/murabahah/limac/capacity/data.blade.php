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
                                            <th class="align-middle p-3" colspan="4">Kemauan Membayar</th>
                                        </tr>
                                        <tr>
                                            <th class="align-middle bg-white text-info p-3">Tempat Kerja ke Lokasi
                                                Bank</th>
                                            <th class="align-middle bg-white text-info p-3">Tempat Kerja ke Lokasi
                                                Agunan</th>
                                            <th class="align-middle bg-white text-info p-3">Pembayaran Kolektif</th>
                                            <th class="align-middle bg-white text-info p-3">Pembayaran Non-Kolektif
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($murabahah_limac_capacity as $index => $murabahah)
                                            <tr>
                                                <td class="align-middle text-center p-1">
                                                    <a href="{{ route('murabahah.limac.capacity.edit', $murabahah->kode_pengajuan) }}"
                                                        class="btn btn-sm btn-link text-warning p-1">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </td>
                                                <td class="align-middle text-center text-wrap p-1">
                                                    {{ $murabahah_limac_capacity->firstItem() + $index }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">{{ $murabahah->kode_pengajuan }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">{{ $murabahah->kode_nasabah }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">{{ $murabahah->nama_nasabah }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $murabahah->tempatkerja_kelokasi_bank }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $murabahah->tempatkerja_kelokasi_agunan }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $murabahah->pembayaran_kolektif }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $murabahah->pembayaran_nonkolektif }}</td>
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
                                {{ $murabahah_limac_capacity->links() }}
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
@endsection
