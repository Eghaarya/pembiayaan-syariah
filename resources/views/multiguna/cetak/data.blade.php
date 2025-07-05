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
                                <table class="table border table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th class="align-middle p-2" rowspan="2">No.</th>
                                            <th class="align-middle p-2" rowspan="2">Kode Pengajuan</th>
                                            <th class="align-middle p-2" rowspan="2">Kode Nasabah</th>
                                            <th class="align-middle p-2" rowspan="2">Nama Nasabah</th>
                                            <th class="align-middle bg-white p-2" rowspan="2">Laporan Hasil Analisis</th>
                                            <th class="align-middle bg-white p-2" colspan="3">Pembiayaan</th>
                                        </tr>
                                        <tr>
                                            <th class="align-middle bg-white p-2">Surat Persetujuan</th>
                                            <th class="align-middle bg-white p-2">Dokumen Akad</th>
                                            <th class="align-middle bg-white p-2">Surat Pencairan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($multiguna_pengajuan as $index => $multiguna)
                                            <tr>
                                                <td class="align-middle">
                                                    {{ $multiguna_pengajuan->firstItem() + $index }}</td>
                                                <td class="align-middle">{{ $multiguna->kode_pengajuan }}
                                                </td>
                                                <td class="align-middle">{{ $multiguna->kode_nasabah }}</td>
                                                <td class="align-middle">{{ $multiguna->nama_nasabah }}</td>
                                                <td class="align-middle">
                                                    <a href="{{ route('multiguna.cetak.laporan_hasil', $multiguna->kode_pengajuan) }}"
                                                        class="btn btn-sm btn-link text-primary p-1"
                                                        title="Cetak Laporan Hasil" target="_blank">
                                                        <i class="fas fa-file-alt"></i> Laporan Hasil
                                                    </a>
                                                </td>
                                                <td class="align-middle">
                                                    <a href="{{ route('multiguna.cetak.surat_persetujuan', $multiguna->kode_pengajuan) }}"
                                                        class="btn btn-sm btn-link text-info p-1"
                                                        title="Cetak Surat Persetujuan" target="_blank">
                                                        <i class="fas fa-file-contract"></i> Surat Persetujuan
                                                    </a>
                                                </td>
                                                <td class="align-middle">
                                                    <a href="{{ route('multiguna.cetak.dokumen_akad', $multiguna->kode_pengajuan) }}"
                                                        class="btn btn-sm btn-link text-success p-1"
                                                        title="Cetak Dokumen Akad" target="_blank">
                                                        <i class="fas fa-file-signature"></i> Dokumen Akad
                                                    </a>
                                                </td>
                                                <td class="align-middle">
                                                    <a href="{{ route('multiguna.cetak.surat_pencairan', $multiguna->kode_pengajuan) }}"
                                                        class="btn btn-sm btn-link text-warning p-1"
                                                        title="Cetak Surat Pencairan" target="_blank">
                                                        <i class="fas fa-file-invoice-dollar"></i> Surat Pencairan
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="50" class="text-center">Data nasabah tidak ditemukan.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                            </div>

                            {{-- Pagination --}}
                            <div class="d-flex justify-content-start mt-3">
                                {{ $multiguna_pengajuan->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
@endsection
