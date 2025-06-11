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
                                <a href="{{ route('murabahah.pengajuan.tambah') }}" class="btn btn-primary">Buat Pengajuan
                                    Murabahah
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
                                            <th colspan="6" class="align-middle p-2">Rekomendasi Keputusan</th>
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
                                            <th colspan="2" class="align-middle bg-white text-secondary p-1">Collateral
                                            </th>
                                            <th rowspan="2" class="align-middle bg-white text-secondary p-1">Condition
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="align-middle bg-white text-secondary p-1">KPR</th>
                                            <th class="align-middle bg-white text-secondary p-1">Bermotor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($murabahah_pengajuan as $index => $murabahah)
                                            <tr>
                                                <td rowspan="2" class="text-center align-middle p-1">
                                                    <a href="{{ route('murabahah.pengajuan.edit', $murabahah->kode_pengajuan) }}"
                                                        class="btn btn-sm btn-link text-warning p-1" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    @unless (Auth::user()->tipe_akun == 'siswa')
                                                        <form
                                                            action="{{ route('murabahah.pengajuan.hapus', $murabahah->kode_pengajuan) }}"
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
                                                    {{ $murabahah_pengajuan->firstItem() + $index }}</td>
                                                <td rowspan="2" class="align-middle">{{ $murabahah->kode_pengajuan }}
                                                </td>
                                                <td rowspan="2" class="align-middle">{{ $murabahah->kode_nasabah }}</td>
                                                <td rowspan="2" class="align-middle">{{ $murabahah->nama_nasabah }}</td>
                                                <td rowspan="2" class="align-middle">
                                                    {{ $murabahah->tanggal_pengajuan ? \Carbon\Carbon::parse($murabahah->tanggal_pengajuan)->format('d-m-Y') : '-' }}
                                                </td>


                                                {{-- Nilai --}}
                                                <td>{{ $murabahah->total_character }}</td>
                                                <td>{{ $murabahah->total_capacity }}</td>
                                                <td>{{ $murabahah->total_capital }}</td>
                                                <td>{{ $murabahah->total_collateralkpr }}</td>
                                                <td>{{ $murabahah->total_collateralbermotor }}</td>
                                                <td>{{ $murabahah->total_condition }}</td>
                                                <td rowspan="2"
                                                    class="align-middle {{ $murabahah->keputusan == 'disetujui' ? 'text-success' : '' }}">
                                                    {{ $murabahah->keputusan ?? '-' }}
                                                </td>
                                                <td rowspan="2" class="align-middle">
                                                    {{ $murabahah->tanggal_pencairan ? \Carbon\Carbon::parse($murabahah->tanggal_pencairan)->format('d-m-Y') : '-' }}
                                                </td>

                                                @unless ($murabahah->keputusan != 'disetujui' || $murabahah->tanggal_pencairan == '')
                                                    <td rowspan="2" class="align-middle">
                                                        <a href="{{ route('murabahah.pengajuan.angsuran', $murabahah->kode_pengajuan) }}"
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
                                                    class="@if ($murabahah->total_character >= 7) text-success @elseif($murabahah->total_character >= 4) text-warning @else text-danger @endif">
                                                    @if ($murabahah->total_character >= 7)
                                                        Disetujui
                                                    @elseif ($murabahah->total_character >= 4)
                                                        Disetujui Bersyarat
                                                    @else
                                                        Ditolak
                                                    @endif
                                                </td>
                                                <td
                                                    class="@if ($murabahah->total_capacity >= 85) text-success @elseif($murabahah->total_capacity >= 70) text-warning @else text-danger @endif">
                                                    @if ($murabahah->total_capacity >= 85)
                                                        Disetujui
                                                    @elseif ($murabahah->total_capacity >= 70)
                                                        Disetujui Bersyarat
                                                    @else
                                                        Ditolak
                                                    @endif
                                                </td>
                                                <td
                                                    class="@if ($murabahah->total_capital >= 8) text-success @elseif($murabahah->total_capital >= 2) text-warning @else text-danger @endif">
                                                    @if ($murabahah->total_capital >= 8)
                                                        Disetujui
                                                    @elseif ($murabahah->total_capital >= 2)
                                                        Disetujui Bersyarat
                                                    @else
                                                        Ditolak
                                                    @endif
                                                </td>
                                                <td
                                                    class="@if ($murabahah->total_collateralkpr >= 31) text-success @elseif($murabahah->total_collateralkpr >= 16) text-warning @else text-danger @endif">
                                                    @if ($murabahah->total_collateralkpr >= 31)
                                                        Disetujui
                                                    @elseif ($murabahah->total_collateralkpr >= 16)
                                                        Disetujui Bersyarat
                                                    @else
                                                        Ditolak
                                                    @endif
                                                </td>
                                                <td
                                                    class="@if ($murabahah->total_collateralbermotor >= 13) text-success @elseif($murabahah->total_collateralbermotor >= 6) text-warning @else text-danger @endif">
                                                    @if ($murabahah->total_collateralbermotor >= 13)
                                                        Disetujui
                                                    @elseif ($murabahah->total_collateralbermotor >= 6)
                                                        Disetujui Bersyarat
                                                    @else
                                                        Ditolak
                                                    @endif
                                                </td>
                                                <td
                                                    class="@if ($murabahah->total_condition >= 13) text-success @elseif($murabahah->total_condition >= 6) text-warning @else text-danger @endif">
                                                    @if ($murabahah->total_condition >= 13)
                                                        Disetujui
                                                    @elseif ($murabahah->total_condition >= 6)
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
                                {{ $murabahah_pengajuan->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
@endsection
