@extends('layouts.app')

@section('content')
    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="card card-social">
                    <div class="card-block border-bottom">
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table border table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <th class="align-middle p-3" rowspan="2">Aksi</th>
                                            <th class="align-middle p-3" rowspan="2">No</th>
                                            <th class="align-middle p-3" rowspan="2">Kode Nasabah</th>
                                            <th class="align-middle p-3" rowspan="2">Nama Nasabah</th>
                                            <th class="align-middle p-3" colspan="3">Foto Dokumentasi Nasabah</th>
                                            <th class="align-middle p-3" colspan="3">Foto Dokumentasi Pasangan</th>
                                        </tr>
                                        <tr>
                                            <th class="bg-white text-secondary p-1 pl-2">Foto Nasabah</th>
                                            <th class="bg-white text-secondary p-1 pl-2">Foto Identitas Nasabah</th>
                                            <th class="bg-white text-secondary p-1 pl-2">NPWP Nasabah</th>
                                            <th class="bg-white text-secondary p-1 pl-2">Foto Pasangan</th>
                                            <th class="bg-white text-secondary p-1 pl-2">Foto Identitas Pasangan</th>
                                            <th class="bg-white text-secondary p-1 pl-2">NPWP Pasangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($nasabah_dokumentasi as $index => $nasabah)
                                            <tr class="text-center">
                                                <td class="align-middle text-center p-1">
                                                    <a href="{{ route('nasabah.dokumentasi.upload', $nasabah->kode_nasabah) }}"
                                                        class="btn btn-sm btn-link text-warning p-1">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </td>
                                                <td class="align-middle text-center text-wrap p-1">
                                                    {{ $nasabah_dokumentasi->firstItem() + $index }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">{{ $nasabah->kode_nasabah }}</td>
                                                <td class="align-middle text-wrap p-1">{{ $nasabah->nama_nasabah }}</td>

                                                <td class="align-middle text-center p-1">
                                                    <a href="{{ asset('storage/uploads/nasabah/' . $nasabah->foto_nasabah) }}"
                                                        target="_blank">
                                                        @if ($nasabah->foto_nasabah)
                                                            <img src="{{ asset('storage/uploads/nasabah/' . $nasabah->foto_nasabah) }}"
                                                                alt="Foto Nasabah" class="img-thumbnail"
                                                                style="width: 80px; height: 80px; object-fit: cover;">
                                                        @endif
                                                    </a>
                                                </td>
                                                <td class="align-middle text-center p-1">
                                                    <a href="{{ asset('storage/uploads/nasabah/' . $nasabah->foto_identitas_nasabah) }}"
                                                        target="_blank">
                                                        @if ($nasabah->foto_identitas_nasabah)
                                                            <img src="{{ asset('storage/uploads/nasabah/' . $nasabah->foto_identitas_nasabah) }}"
                                                                alt="Foto Nasabah" class="img-thumbnail"
                                                                style="width: 80px; height: 80px; object-fit: cover;">
                                                        @endif
                                                    </a>
                                                </td>
                                                <td class="align-middle text-center p-1">
                                                    <a href="{{ asset('storage/uploads/nasabah/' . $nasabah->npwp_nasabah) }}"
                                                        target="_blank">
                                                        @if ($nasabah->npwp_nasabah)
                                                            <img src="{{ asset('storage/uploads/nasabah/' . $nasabah->npwp_nasabah) }}"
                                                                alt="Foto Nasabah" class="img-thumbnail"
                                                                style="width: 80px; height: 80px; object-fit: cover;">
                                                        @endif
                                                    </a>
                                                </td>

                                                <td class="align-middle text-center p-1">
                                                    <a href="{{ asset('storage/uploads/nasabah/' . $nasabah->foto_pasangan) }}"
                                                        target="_blank">
                                                        @if ($nasabah->foto_pasangan)
                                                            <img src="{{ asset('storage/uploads/nasabah/' . $nasabah->foto_pasangan) }}"
                                                                alt="Foto Nasabah" class="img-thumbnail"
                                                                style="width: 80px; height: 80px; object-fit: cover;">
                                                        @endif
                                                    </a>
                                                </td>
                                                <td class="align-middle text-center p-1">
                                                    <a href="{{ asset('storage/uploads/nasabah/' . $nasabah->foto_identitas_pasangan) }}"
                                                        target="_blank">
                                                        @if ($nasabah->foto_identitas_pasangan)
                                                            <img src="{{ asset('storage/uploads/nasabah/' . $nasabah->foto_identitas_pasangan) }}"
                                                                alt="Foto Nasabah" class="img-thumbnail"
                                                                style="width: 80px; height: 80px; object-fit: cover;">
                                                        @endif
                                                    </a>
                                                </td>
                                                <td class="align-middle text-center p-1">
                                                    <a href="{{ asset('storage/uploads/nasabah/' . $nasabah->npwp_pasangan) }}"
                                                        target="_blank">
                                                        @if ($nasabah->npwp_pasangan)
                                                            <img src="{{ asset('storage/uploads/nasabah/' . $nasabah->npwp_pasangan) }}"
                                                                alt="Foto Nasabah" class="img-thumbnail"
                                                                style="width: 80px; height: 80px; object-fit: cover;">
                                                        @endif
                                                    </a>
                                                </td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="45" class="text-start">Data nasabah tidak ditemukan.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            {{-- Pagination --}}
                            <div class="d-flex justify-content-start mt-3">
                                {{ $nasabah_dokumentasi->links() }}
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
@endsection
