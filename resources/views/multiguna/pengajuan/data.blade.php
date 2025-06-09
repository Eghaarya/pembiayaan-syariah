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
                                <a href="{{ route('multiguna.pengajuan.tambah') }}" class="btn btn-primary">Buat Pengajuan
                                    multiguna
                                    +</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table border table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th rowspan="3" class="align-middle p-2">Aksi</th>
                                            <th rowspan="3" class="align-middle p-2">No.</th>
                                            <th rowspan="3" class="align-middle p-2">Kode Pengajuan</th>
                                            <th rowspan="3" class="align-middle p-2">Kode Nasabah</th>
                                            <th rowspan="3" class="align-middle p-2">Nama Nasabah</th>
                                            <th rowspan="3" class="align-middle p-2">Tanggal Pengajuan</th>
                                            <th colspan="7" class="align-middle p-2">Rekomendasi Keputusan</th>
                                            <th rowspan="3" class="align-middle p-2">Keputusan</th>
                                            <th rowspan="3" class="align-middle p-2">Tanggal Pencairan</th>
                                            <th rowspan="3" class="align-middle p-2">Jadwal Angsuran</th>
                                        </tr>
                                        <tr>
                                            <th rowspan="2" class="align-middle bg-white text-secondary p-1">Character
                                            </th>
                                            <th rowspan="2" class="align-middle bg-white text-secondary p-1">Capacity
                                            </th>
                                            <th rowspan="2" class="align-middle bg-white text-secondary p-1">Capital</th>
                                            <th colspan="3" class="align-middle bg-white text-secondary p-1">Collateral
                                            </th>
                                            <th rowspan="2" class="align-middle bg-white text-secondary p-1">Condition
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="align-middle bg-white text-secondary p-1">SK</th>
                                            <th class="align-middle bg-white text-secondary p-1">Properti</th>
                                            <th class="align-middle bg-white text-secondary p-1">Bermotor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($multiguna_pengajuan as $index => $multiguna)
                                            <tr>
                                                <td rowspan="2" class="text-center align-middle p-1">
                                                    <a href="{{ route('multiguna.pengajuan.edit', $multiguna->kode_pengajuan) }}"
                                                        class="btn btn-sm btn-link text-warning p-1" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    @unless (Auth::user()->tipe_akun == 'siswa')
                                                        <form
                                                            action="{{ route('multiguna.pengajuan.hapus', $multiguna->kode_pengajuan) }}"
                                                            method="POST" class="d-inline"
                                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-link text-danger p-1" title="Hapus">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                    @endunless
                                                </td>
                                                <td rowspan="2" class="align-middle">
                                                    {{ $multiguna_pengajuan->firstItem() + $index }}</td>
                                                <td rowspan="2" class="align-middle">{{ $multiguna->kode_pengajuan }}
                                                </td>
                                                <td rowspan="2" class="align-middle">{{ $multiguna->kode_nasabah }}</td>
                                                <td rowspan="2" class="align-middle">{{ $multiguna->nama_nasabah }}</td>
                                                <td rowspan="2" class="align-middle">
                                                    {{ $multiguna->tanggal_pengajuan ? \Carbon\Carbon::parse($multiguna->tanggal_pengajuan)->format('d-m-Y') : '-' }}
                                                </td>


                                                {{-- Nilai --}}
                                                <td>{{ $multiguna->total_character }}</td>
                                                <td>{{ $multiguna->total_capacity }}</td>
                                                <td>{{ $multiguna->total_capital }}</td>
                                                <td>{{ $multiguna->total_collateralsk }}</td>
                                                <td>{{ $multiguna->total_collateralproperti }}</td>
                                                <td>{{ $multiguna->total_collateralbermotor }}</td>
                                                <td>{{ $multiguna->total_condition }}</td>
                                                <td rowspan="2"
                                                    class="align-middle {{ $multiguna->keputusan == 'disetujui' ? 'text-success' : '' }}">
                                                    {{ $multiguna->keputusan ?? '-' }}
                                                </td>
                                                <td rowspan="2" class="align-middle">
                                                    {{ $multiguna->tanggal_pencairan ? \Carbon\Carbon::parse($multiguna->tanggal_pencairan)->format('d-m-Y') : '-' }}
                                                </td>

                                                @unless ($multiguna->keputusan != 'disetujui' || $multiguna->tanggal_pencairan == '')
                                                    <td rowspan="2" class="align-middle">
                                                        <a href="{{ route('multiguna.pengajuan.angsuran', $multiguna->kode_pengajuan) }}"
                                                            class="btn btn-sm btn-link text-info p-1"
                                                            title="Cek Jadwal Angsuran">
                                                            <i class="fas fa-calendar"></i>Cek Jadwal
                                                        </a>
                                                    </td>
                                                @endunless

                                            </tr>
                                            <tr class="text-wrap">
                                                {{-- Keterangan --}}
                                                <td
                                                    class="@if ($multiguna->total_character >= 15) text-success @elseif($multiguna->total_character >= 10) text-warning @else text-danger @endif">
                                                    @if ($multiguna->total_character >= 15)
                                                        Disetujui
                                                    @elseif ($multiguna->total_character >= 10)
                                                        Disetujui Bersyarat
                                                    @else
                                                        Ditolak
                                                    @endif
                                                </td>
                                                <td
                                                    class="@if ($multiguna->total_capacity >= 50) text-success @elseif($multiguna->total_capacity >= 30) text-warning @else text-danger @endif">
                                                    @if ($multiguna->total_capacity >= 50)
                                                        Disetujui
                                                    @elseif ($multiguna->total_capacity >= 30)
                                                        Disetujui Bersyarat
                                                    @else
                                                        Ditolak
                                                    @endif
                                                </td>
                                                <td
                                                    class="@if ($multiguna->total_capital >= 8) text-success @elseif($multiguna->total_capital >= 2) text-warning @else text-danger @endif">
                                                    @if ($multiguna->total_capital >= 8)
                                                        Disetujui
                                                    @elseif ($multiguna->total_capital >= 2)
                                                        Disetujui Bersyarat
                                                    @else
                                                        Ditolak
                                                    @endif
                                                </td>
                                                <td
                                                    class="@if ($multiguna->total_collateralsk >= 2) text-success @elseif($multiguna->total_collateralsk >= 1) text-warning @else text-danger @endif">
                                                    @if ($multiguna->total_collateralsk >= 2)
                                                        Disetujui
                                                    @elseif ($multiguna->total_collateralsk >= 1)
                                                        Disetujui Bersyarat
                                                    @else
                                                        Ditolak
                                                    @endif
                                                </td>
                                                <td
                                                    class="@if ($multiguna->total_collateralproperti >= 31) text-success @elseif($multiguna->total_collateralproperti >= 16) text-warning @else text-danger @endif">
                                                    @if ($multiguna->total_collateralproperti >= 31)
                                                        Disetujui
                                                    @elseif ($multiguna->total_collateralproperti >= 16)
                                                        Disetujui Bersyarat
                                                    @else
                                                        Ditolak
                                                    @endif
                                                </td>
                                                <td
                                                    class="@if ($multiguna->total_collateralbermotor >= 13) text-success @elseif($multiguna->total_collateralbermotor >= 6) text-warning @else text-danger @endif">
                                                    @if ($multiguna->total_collateralbermotor >= 13)
                                                        Disetujui
                                                    @elseif ($multiguna->total_collateralbermotor >= 6)
                                                        Disetujui Bersyarat
                                                    @else
                                                        Ditolak
                                                    @endif
                                                </td>
                                                <td
                                                    class="@if ($multiguna->total_condition >= 13) text-success @elseif($multiguna->total_condition >= 6) text-warning @else text-danger @endif">
                                                    @if ($multiguna->total_condition >= 13)
                                                        Disetujui
                                                    @elseif ($multiguna->total_condition >= 6)
                                                        Disetujui Bersyarat
                                                    @else
                                                        Ditolak
                                                    @endif
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
