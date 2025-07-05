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

                                            <th colspan="10" class="align-middle p-2">Karakter Nasabah</th>

                                            @for ($i = 1; $i <= 10; $i++)
                                                <th colspan="12"
                                                    class="align-middle p-2 {{ $i % 2 == 1 ? 'bg-white text-secondary' : '' }}">
                                                    Checking Nasabah
                                                    {{ $i }}</th>
                                            @endfor

                                            @for ($i = 1; $i <= 10; $i++)
                                                <th colspan="12"
                                                    class="align-middle p-2 {{ $i % 2 == 1 ? 'bg-white text-secondary' : '' }}">
                                                    Checking Pasangan
                                                    {{ $i }}</th>
                                            @endfor
                                        </tr>

                                        <tr class="text-center border border-dark">

                                            <th class="bg-white text-info">Responsif & Komunikatif</th>
                                            <th class="bg-white text-info">Mudah Dihubungi</th>
                                            <th class="bg-white text-info">Wawasan Luas</th>
                                            <th class="bg-white text-info">Informatif</th>
                                            <th class="bg-white text-info">Terbuka Berkomunikasi</th>
                                            <th class="bg-white text-info">Tidak Blacklist BI</th>
                                            <th class="bg-white text-info">BG/Cek Tidak Ditolak</th>
                                            <th class="bg-white text-info">Tidak Bermasalah di Bank Lain</th>
                                            <th class="bg-white text-info">Fasilitas Sesuai Penggunaan</th>
                                            <th class="bg-white text-info">Mutasi Pinjaman Aktif</th>

                                            @for ($i = 1; $i <= 10; $i++)
                                                <th class="bg-white text-secondary">#</th>
                                                <th class="bg-white text-secondary">No Id Checking</th>
                                                <th class="bg-white text-secondary">Nama Nasabah (Debitur)</th>
                                                <th class="bg-white text-secondary">Fasilitas Pinjaman</th>
                                                <th class="bg-white text-secondary">Bank Pelapor</th>
                                                <th class="bg-white text-secondary">Plafond Pinjaman</th>
                                                <th class="bg-white text-secondary">Outstanding Pinjaman</th>
                                                <th class="bg-white text-secondary">Tanggal Realisasi</th>
                                                <th class="bg-white text-secondary">Tanggal Jatuh Tempo</th>
                                                <th class="bg-white text-info">Kolektabilitas</th>
                                                <th class="bg-white text-secondary">Keterangan</th>
                                                <th class="bg-white text-secondary">Agunan</th>
                                            @endfor

                                            @for ($i = 1; $i <= 10; $i++)
                                                <th class="bg-white text-secondary">#</th>
                                                <th class="bg-white text-secondary">No Id Checking</th>
                                                <th class="bg-white text-secondary">Nama Pasangan (Debitur)</th>
                                                <th class="bg-white text-secondary">Fasilitas Pinjaman</th>
                                                <th class="bg-white text-secondary">Bank Pelapor</th>
                                                <th class="bg-white text-secondary">Plafond Pinjaman</th>
                                                <th class="bg-white text-secondary">Outstanding Pinjaman</th>
                                                <th class="bg-white text-secondary">Tanggal Realisasi</th>
                                                <th class="bg-white text-secondary">Tanggal Jatuh Tempo</th>
                                                <th class="bg-white text-info">Kolektabilitas</th>
                                                <th class="bg-white text-secondary">Keterangan</th>
                                                <th class="bg-white text-secondary">Agunan</th>
                                            @endfor
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($multiguna_limac_character as $index => $item)
                                            <tr class="text-center">
                                                <td class="text-center align-middle text-wrap p-2">
                                                    <a href="{{ route('multiguna.limac.character.edit', $item->kode_pengajuan) }}"
                                                        class="text-warning" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </td>
                                                <td class="text-center align-middle text-wrap p-2">
                                                    {{ $multiguna_limac_character->firstItem() + $index }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->kode_pengajuan }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->kode_nasabah }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->nama_nasabah }}</td>

                                                <td class="align-middle text-wrap p-2">{{ $item->responsif_komunikatif }}
                                                </td>
                                                <td class="align-middle text-wrap p-2">{{ $item->mudah_dihubungi }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->wawasan_luas }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->informatif }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->terbuka_berkomunikasi }}
                                                </td>
                                                <td class="align-middle text-wrap p-2">{{ $item->tidak_blacklist_bi }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->bg_cek_tidak_ditolak }}
                                                </td>
                                                <td class="align-middle text-wrap p-2">
                                                    {{ $item->tidak_bermasalah_bank_lain }}</td>
                                                <td class="align-middle text-wrap p-2">
                                                    {{ $item->fasilitas_sesuai_penggunaan }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->mutasi_pinjaman_aktif }}
                                                </td>

                                                {{-- Nasabah checking --}}
                                                @php
                                                    $checkingNasabah =
                                                        $pengajuan_checking_nasabah[$item->kode_pengajuan] ?? collect();
                                                @endphp

                                                @for ($i = 0; $i < 10; $i++)
                                                    @php
                                                        $item_nasabah = $checkingNasabah[$i] ?? null;
                                                    @endphp

                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $i + 1 }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item_nasabah?->noid_checking_nasabah ?? '' }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item_nasabah?->nama_debitur_nasabah ?? '' }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item_nasabah?->fasilitas_pinjaman_nasabah ?? '' }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item_nasabah?->bank_pelapor_nasabah ?? '' }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item_nasabah ? number_format($item_nasabah->plafond_pinjaman_nasabah, 2) : '' }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item_nasabah ? number_format($item_nasabah->outstanding_pinjaman_nasabah, 2) : '' }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item_nasabah && $item_nasabah->tanggal_realisasi_nasabah ? \Carbon\Carbon::parse($item_nasabah->tanggal_realisasi_nasabah)->format('Y-m-d') : '' }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item_nasabah && $item_nasabah->tanggal_jatuh_tempo_nasabah ? \Carbon\Carbon::parse($item_nasabah->tanggal_jatuh_tempo_nasabah)->format('Y-m-d') : '' }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item_nasabah?->kolektabilitas_nasabah ?? '' }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item_nasabah?->keterangan_nasabah ?? '' }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item_nasabah?->agunan_nasabah ?? '' }}
                                                    </td>
                                                @endfor

                                                {{-- Pasangan checking --}}
                                                @php
                                                    $checkingPasangan =
                                                        $pengajuan_checking_pasangan[$item->kode_pengajuan] ??
                                                        collect();
                                                @endphp

                                                @for ($i = 0; $i < 10; $i++)
                                                    @php
                                                        $item_pasangan = $checkingPasangan[$i] ?? null;
                                                    @endphp

                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $i + 1 }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item_pasangan?->noid_checking_pasangan ?? '' }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item_pasangan?->nama_debitur_pasangan ?? '' }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item_pasangan?->fasilitas_pinjaman_pasangan ?? '' }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item_pasangan?->bank_pelapor_pasangan ?? '' }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item_pasangan ? number_format($item_pasangan->plafond_pinjaman_pasangan, 2) : '' }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item_pasangan ? number_format($item_pasangan->outstanding_pinjaman_pasangan, 2) : '' }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item_pasangan && $item_pasangan->tanggal_realisasi_pasangan ? \Carbon\Carbon::parse($item_pasangan->tanggal_realisasi_pasangan)->format('Y-m-d') : '' }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item_pasangan && $item_pasangan->tanggal_jatuh_tempo_pasangan ? \Carbon\Carbon::parse($item_pasangan->tanggal_jatuh_tempo_pasangan)->format('Y-m-d') : '' }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item_pasangan?->kolektabilitas_pasangan ?? '' }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-2">
                                                        {{ $item_pasangan?->keterangan_pasangan ?? '' }}
                                                    </td>
                                                    <td class="align-middle text-wrap sp-2">
                                                        {{ $item_pasangan?->agunan_pasangan ?? '' }}
                                                    </td>
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
                                {{ $multiguna_limac_character->links() }}
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
@endsection
