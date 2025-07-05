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
                                            <th class="align-middle p-2" rowspan="3">Aksi</th>
                                            <th class="align-middle p-2" rowspan="3">No</th>
                                            <th class="align-middle p-2" rowspan="3">Kode Pengajuan</th>
                                            <th class="align-middle p-2" rowspan="3">Kode Nasabah</th>
                                            <th class="align-middle p-2" rowspan="3">Nama Nasabah</th>
                                            <th class="align-middle p-2" colspan="34">Perincian Tabungan</th>
                                            <th class="align-middle p-2" colspan="24">Kondisi Keuangan</th>
                                            <th class="align-middle p-2" rowspan="2" colspan="4">Kemauan Membayar</th>
                                            <th class="align-middle p-2" rowspan="2" colspan="4">Nilai Pembiayaan</th>
                                        </tr>
                                        <tr class="text-center">
                                            <th class="align-middle bg-white p-2" rowspan="2">Nama</th>
                                            <th class="align-middle bg-white p-2" rowspan="2">No Account Bank</th>
                                            <th class="align-middle p-2" colspan="5">Rekening Nasabah Bulan ke-1</th>
                                            <th class="align-middle bg-white p-2" colspan="5">Rekening Nasabah Bulan ke-2
                                            </th>
                                            <th class="align-middle p-2" colspan="5">Rekening Nasabah Bulan ke-3</th>
                                            <th class="align-middle bg-white p-2" rowspan="2">Nama</th>
                                            <th class="align-middle bg-white p-2" rowspan="2">No Account Bank</th>
                                            <th class="align-middle p-2" colspan="5">Rekening Pasangan Bulan ke-1</th>
                                            <th class="align-middle bg-white p-2" colspan="5">Rekening Pasangan Bulan
                                                ke-2</th>
                                            <th class="align-middle p-2" colspan="5">Rekening Pasangan Bulan ke-3</th>

                                            <th class="align-middle bg-white p-2" colspan="6">Penghasilan</th>
                                            <th class="align-middle p-2" colspan="18">Pengeluaran</th>

                                        </tr>
                                        <tr class="text-center">
                                            @for ($i = 1; $i <= 3; $i++)
                                                <th class="align-middle bg-white p-2">Tanggal</th>
                                                <th class="align-middle bg-white p-2">Saldo Awal</th>
                                                <th class="align-middle bg-white p-2">Total Debet</th>
                                                <th class="align-middle bg-white p-2">Total Kredit</th>
                                                <th class="align-middle bg-white p-2">Saldo Akhir</th>
                                            @endfor

                                            @for ($i = 1; $i <= 3; $i++)
                                                <th class="align-middle bg-white p-2">Tanggal</th>
                                                <th class="align-middle bg-white p-2">Saldo Awal</th>
                                                <th class="align-middle bg-white p-2">Total Debet</th>
                                                <th class="align-middle bg-white p-2">Total Kredit</th>
                                                <th class="align-middle bg-white p-2">Saldo Akhir</th>
                                            @endfor

                                            <th class="align-middle bg-white p-2">Penghasilan Nasabah</th>
                                            <th class="align-middle bg-white p-2">Keterangan</th>
                                            <th class="align-middle bg-white p-2">Penghasilan Pasangan</th>
                                            <th class="align-middle bg-white p-2">Keterangan</th>
                                            <th class="align-middle bg-white p-2">Sumber Penghasilan Lain</th>
                                            <th class="align-middle bg-white p-2">Keterangan</th>
                                            <th class="align-middle bg-white p-2">Sewa/Pemeliharaan Rumah</th>
                                            <th class="align-middle bg-white p-2">Keterangan</th>
                                            <th class="align-middle bg-white p-2">Biaya Makan</th>
                                            <th class="align-middle bg-white p-2">Keterangan</th>
                                            <th class="align-middle bg-white p-2">Biaya Transportasi</th>
                                            <th class="align-middle bg-white p-2">Keterangan</th>
                                            <th class="align-middle bg-white p-2">Biaya Pendidikan</th>
                                            <th class="align-middle bg-white p-2">Keterangan</th>
                                            <th class="align-middle bg-white p-2">Biaya Listrik, Air, Gas</th>
                                            <th class="align-middle bg-white p-2">Keterangan</th>
                                            <th class="align-middle bg-white p-2">Angsuran Pinjaman</th>
                                            <th class="align-middle bg-white p-2">Keterangan</th>
                                            <th class="align-middle bg-white p-2">Premi Asuransi</th>
                                            <th class="align-middle bg-white p-2">Keterangan</th>
                                            <th class="align-middle bg-white p-2">Tabungan Berjangka</th>
                                            <th class="align-middle bg-white p-2">Keterangan</th>
                                            <th class="align-middle bg-white p-2">Pengeluaran Lain</th>
                                            <th class="align-middle bg-white p-2">Keterangan</th>

                                            <th class="align-middle bg-white text-info p-2">Tempat Kerja ke
                                                Lokasi
                                                Bank</th>
                                            <th class="align-middle bg-white text-info p-2">Tempat Kerja ke
                                                Lokasi
                                                Agunan</th>
                                            <th class="align-middle bg-white text-info p-2">Pembayaran
                                                Kolektif</th>
                                            <th class="align-middle bg-white text-info p-2">Pembayaran
                                                Non-Kolektif
                                            </th>

                                            <th class="align-middle bg-white p-2">Analis Harga Beli Bank</th>
                                            <th class="align-middle bg-white p-2">Analis Margin Bank</th>
                                            <th class="align-middle bg-white p-2">Analis Harga Jual Bank</th>
                                            <th class="align-middle bg-white p-2">Analis Jangka Waktu (tahun)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($murabahah_limac_capacity as $index => $murabahah)
                                            <tr class="text-center">
                                                <td class="align-middle text-wrap p-1">
                                                    <a href="{{ route('murabahah.limac.capacity.edit', $murabahah->kode_pengajuan) }}"
                                                        class="text-warning" title="Edit">
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

                                                @for ($i = 1; $i <= 3; $i++)
                                                    @if ($i == 1)
                                                        <td class="align-middle text-wrap p-1">
                                                            {{ $murabahah->nama_bank_nasabah }}
                                                        </td>
                                                        <td class="align-middle text-wrap p-1">
                                                            {{ $murabahah->no_bank_account_nasabah }}</td>
                                                    @endif

                                                    <td class="align-middle text-wrap p-1">
                                                        {{ $murabahah->{"tanggal_nasabah_bulan_{$i}"}
                                                            ? \Carbon\Carbon::parse($murabahah->{"tanggal_nasabah_bulan_{$i}"})->format('d/m/Y')
                                                            : '-' }}
                                                    </td>

                                                    <td class="align-middle text-wrap p-1">
                                                        {{ number_format($murabahah->{"saldo_awal_nasabah_bulan_{$i}"}, 2, ',', '.') }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-1">
                                                        {{ number_format($murabahah->{"total_debet_nasabah_bulan_{$i}"}, 2, ',', '.') }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-1">
                                                        {{ number_format($murabahah->{"total_kredit_nasabah_bulan_{$i}"}, 2, ',', '.') }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-1">
                                                        {{ number_format($murabahah->{"saldo_akhir_nasabah_bulan_{$i}"}, 2, ',', '.') }}
                                                    </td>
                                                @endfor


                                                @for ($i = 1; $i <= 3; $i++)
                                                    @if ($i == 1)
                                                        <td class="align-middle text-wrap p-1">
                                                            {{ $murabahah->nama_bank_pasangan }}
                                                        </td>
                                                        <td class="align-middle text-wrap p-1">
                                                            {{ $murabahah->no_bank_account_pasangan }}</td>
                                                    @endif

                                                    <td class="align-middle text-wrap p-1">
                                                        {{ $murabahah->{"tanggal_pasangan_bulan_{$i}"}
                                                            ? \Carbon\Carbon::parse($murabahah->{"tanggal_pasangan_bulan_{$i}"})->format('d/m/Y')
                                                            : '-' }}
                                                    </td>

                                                    <td class="align-middle text-wrap p-1">
                                                        {{ number_format($murabahah->{"saldo_awal_pasangan_bulan_{$i}"}, 2, ',', '.') }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-1">
                                                        {{ number_format($murabahah->{"total_debet_pasangan_bulan_{$i}"}, 2, ',', '.') }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-1">
                                                        {{ number_format($murabahah->{"total_kredit_pasangan_bulan_{$i}"}, 2, ',', '.') }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-1">
                                                        {{ number_format($murabahah->{"saldo_akhir_pasangan_bulan_{$i}"}, 2, ',', '.') }}
                                                    </td>
                                                @endfor

                                                <td class="align-middle text-wrap p-1">
                                                    {{ $murabahah->penghasilan_nasabah }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $murabahah->keterangan_penghasilan_nasabah }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $murabahah->penghasilan_pasangan }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $murabahah->keterangan_penghasilan_pasangan }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $murabahah->sumber_penghasilan_lain }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $murabahah->keterangan_sumber_penghasilan_lain }}</td>
                                                <td class="align-middle text-wrap p-1">{{ $murabahah->biaya_sewa_rumah }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $murabahah->keterangan_biaya_sewa_rumah }}</td>
                                                <td class="align-middle text-wrap p-1">{{ $murabahah->biaya_makan }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $murabahah->keterangan_biaya_makan }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $murabahah->biaya_transportasi }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $murabahah->keterangan_biaya_transportasi }}</td>
                                                <td class="align-middle text-wrap p-1">{{ $murabahah->biaya_pendidikan }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $murabahah->keterangan_biaya_pendidikan }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $murabahah->biaya_listrik_air_gas }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $murabahah->keterangan_biaya_listrik_air_gas }}</td>
                                                <td class="align-middle text-wrap p-1">{{ $murabahah->angsuran_pinjaman }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $murabahah->keterangan_angsuran_pinjaman }}</td>
                                                <td class="align-middle text-wrap p-1">{{ $murabahah->premi_asuransi }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $murabahah->keterangan_premi_asuransi }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $murabahah->tabungan_berjangka }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $murabahah->keterangan_tabungan_berjangka }}</td>
                                                <td class="align-middle text-wrap p-1">{{ $murabahah->pengeluaran_lain }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $murabahah->keterangan_pengeluaran_lain }}</td>

                                                <td class="align-middle text-wrap p-1">
                                                    {{ $murabahah->tempatkerja_kelokasi_bank }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $murabahah->tempatkerja_kelokasi_agunan }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $murabahah->pembayaran_kolektif }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $murabahah->pembayaran_nonkolektif }}</td>

                                                <td class="align-middle text-wrap p-1">
                                                    {{ $murabahah->analis_harga_beli_bank }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $murabahah->analis_margin_bank }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $murabahah->analis_harga_jual_bank }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $murabahah->analis_jangka_waktu_pembiayaan }}</td>

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
