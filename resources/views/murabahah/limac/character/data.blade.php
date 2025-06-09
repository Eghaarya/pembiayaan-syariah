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

                                            <th colspan="9" class="align-middle p-2">Checking Nasabah 1</th>
                                            <th colspan="9" class="align-middle p-2 bg-white">Checking Nasabah 2</th>
                                            <th colspan="9" class="align-middle p-2">Checking Nasabah 3</th>
                                            <th colspan="9" class="align-middle p-2 bg-white">Checking Nasabah 4</th>
                                            <th colspan="9" class="align-middle p-2">Checking Nasabah 5</th>
                                            <th colspan="9" class="align-middle p-2 bg-white">Checking Nasabah 6</th>

                                            <th colspan="9" class="align-middle p-2">Checking Pasangan 1</th>
                                            <th colspan="9" class="align-middle p-2 bg-white">Checking Pasangan 2</th>
                                            <th colspan="9" class="align-middle p-2">Checking Pasangan 3</th>
                                            <th colspan="9" class="align-middle p-2 bg-white">Checking Pasangan 4</th>
                                            <th colspan="9" class="align-middle p-2">Checking Pasangan 5</th>
                                            <th colspan="9" class="align-middle p-2 bg-white">Checking Pasangan 6</th>
                                        </tr>

                                        <tr class="text-center border border-dark">
                                            @for ($i = 1; $i <= 12; $i++)
                                                <th class="bg-white text-secondary">No Id Checking</th>
                                                <th class="bg-white text-secondary">Fasilitas Pinjaman</th>
                                                <th class="bg-white text-secondary">Bank Pelapor</th>
                                                <th class="bg-white text-secondary">Plafond Pinjaman</th>
                                                <th class="bg-white text-secondary">Outstanding Pinjaman</th>
                                                <th class="bg-white text-secondary">Tanggal Realisasi</th>
                                                <th class="bg-white text-secondary">Tanggal Jatuh Tempo</th>
                                                <th class="bg-white text-info">Kolektabilitas</th>
                                                <th class="bg-white text-secondary">Keterangan</th>
                                            @endfor
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($murabahah_limac_character as $index => $item)
                                            <tr class="text-center">
                                                <td class="align-middle text-wrap p-2">
                                                    <a href="{{ route('murabahah.limac.character.edit', $item->kode_pengajuan) }}"
                                                        class="text-warning" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </td>
                                                <td class="align-middle text-wrap p-2">
                                                    {{ $murabahah_limac_character->firstItem() + $index }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->kode_pengajuan }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->kode_nasabah }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->nama_nasabah }}</td>

                                                {{-- Nasabah checking 1 s/d 6 --}}
                                                @for ($i = 1; $i <= 6; $i++)
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item->{"noid_checking{$i}_nasabah"} }}</td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item->{"fasilitas_pinjaman{$i}_nasabah"} }}</td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item->{"bank_pelapor{$i}_nasabah"} }}</td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ number_format($item->{"plafond_pinjaman{$i}_nasabah"}, 2) }}</td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ number_format($item->{"outstanding_pinjaman{$i}_nasabah"}, 2) }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ optional($item->{"tanggal_realisasi{$i}_nasabah"})->format('Y-m-d') }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ optional($item->{"tanggal_jatuh_tempo{$i}_nasabah"})->format('Y-m-d') }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item->{"kolektabilitas{$i}_nasabah"} }}</td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item->{"keterangan{$i}_nasabah"} }}</td>
                                                @endfor

                                                {{-- Pasangan checking 1 s/d 6 --}}
                                                @for ($i = 1; $i <= 6; $i++)
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item->{"noid_checking{$i}_pasangan"} }}</td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item->{"fasilitas_pinjaman{$i}_pasangan"} }}</td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item->{"bank_pelapor{$i}_pasangan"} }}</td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ number_format($item->{"plafond_pinjaman{$i}_pasangan"}, 2) }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ number_format($item->{"outstanding_pinjaman{$i}_pasangan"}, 2) }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ optional($item->{"tanggal_realisasi{$i}_pasangan"})->format('Y-m-d') }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ optional($item->{"tanggal_jatuh_tempo{$i}_pasangan"})->format('Y-m-d') }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item->{"kolektabilitas{$i}_pasangan"} }}</td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item->{"keterangan{$i}_pasangan"} }}</td>
                                                @endfor
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
                                {{ $murabahah_limac_character->links() }}
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
@endsection
