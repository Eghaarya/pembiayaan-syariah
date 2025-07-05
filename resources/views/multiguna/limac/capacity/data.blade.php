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
                                            <th class="align-middle p-3" rowspan="2" colspan="5">Reputasi Nasabah
                                                dalam Pekerjaan
                                            <th class="align-middle p-3" rowspan="2" colspan="5">Fasilitas
                                                Dinas yang
                                                Diterima
                                            </th>
                                            <th class="align-middle p-2" colspan="34">Perincian Tabungan</th>
                                            <th class="align-middle p-2" colspan="17">Kondisi Keuangan</th>
                                            <th class="align-middle p-2" rowspan="2" colspan="3">Nilai Pembiayaan</th>

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

                                            <th class="align-middle bg-white p-2" colspan="11">Penghasilan</th>
                                            <th class="align-middle p-2" colspan="6">Pengeluaran</th>

                                        </tr>

                                        <tr class="text-center">
                                            <th class="align-middle bg-white text-info p-3">Memiliki Jabatan
                                                Rangkap</th>
                                            <th class="align-middle bg-white text-info p-3">Publik Figur</th>
                                            <th class="align-middle bg-white text-info p-3">Pemegang Jabatan
                                                Tertinggi</th>
                                            <th class="align-middle bg-white text-info p-3">Bukan Pemegang
                                                Jabatan Tertinggi
                                            </th>
                                            <th class="align-middle bg-white text-info p-3">Non Jabatan</th>

                                            <th class="align-middle bg-white text-info p-3">Mendapat Rumah
                                                Dinas</th>
                                            <th class="align-middle bg-white text-info p-3">Mendapat Mobil
                                                Dinas</th>
                                            <th class="align-middle bg-white text-info p-3">Mendapat Sepeda
                                                Motor Dinas</th>
                                            <th class="align-middle bg-white text-info p-3">Mendapat
                                                Fasilitas Pinjaman Uang
                                            </th>
                                            <th class="align-middle bg-white text-info p-3">Belum Mendapat
                                                Fasilitas Dinas
                                            </th>

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

                                            <th class="align-middle bg-white p-2">Gaji Pokok</th>
                                            <th class="align-middle bg-white p-2">Tunjangan Penghasilan</th>
                                            <th class="align-middle bg-white p-2">Tunjangan Kesejahteraan</th>
                                            <th class="align-middle bg-white p-2">Tunjangan Struktural</th>
                                            <th class="align-middle bg-white p-2">Tunjangan Fungsional</th>
                                            <th class="align-middle bg-white p-2">Tunjangan Suami/Istri</th>
                                            <th class="align-middle bg-white p-2">Tunjangan Anak</th>
                                            <th class="align-middle bg-white p-2">Tunjangan Beras</th>
                                            <th class="align-middle bg-white p-2">Tunjangan Lain-lain</th>
                                            <th class="align-middle bg-white p-2">Tunjangan Pengobatan</th>
                                            <th class="align-middle bg-white p-2">Penerimaan Lain-lain</th>
                                            <th class="align-middle bg-white p-2">Simpanan Wajib</th>
                                            <th class="align-middle bg-white p-2">Iuran Koperasi</th>
                                            <th class="align-middle bg-white p-2">Iuran BPJS</th>
                                            <th class="align-middle bg-white p-2">Potongan Lain-lain</th>
                                            <th class="align-middle bg-white p-2">Pajak Penghasilan (PPH 21)</th>
                                            <th class="align-middle bg-white p-2">Angsuran Pinjaman di Tempat Lain</th>

                                            <th class="align-middle bg-white p-2">Analis Harga Beli Bank</th>
                                            <th class="align-middle bg-white p-2">Analis Margin Bank</th>
                                            <th class="align-middle bg-white p-2">Analis Jangka Waktu (tahun)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($multiguna_limac_capacity as $index => $multiguna)
                                            <tr class="text-center">
                                                <td class="align-middle text-wrap p-1">
                                                    <a href="{{ route('multiguna.limac.capacity.edit', $multiguna->kode_pengajuan) }}"
                                                        class="text-warning" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </td>
                                                <td class="align-middle text-center text-wrap p-1">
                                                    {{ $multiguna_limac_capacity->firstItem() + $index }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">{{ $multiguna->kode_pengajuan }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">{{ $multiguna->kode_nasabah }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">{{ $multiguna->nama_nasabah }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $multiguna->memiliki_jabatan_rangkap }}</td>
                                                <td class="align-middle text-wrap p-1">{{ $multiguna->publik_figur }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $multiguna->pemegang_jabatan_tertinggi }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $multiguna->bukan_pemegang_jabatan_tertinggi }}</td>
                                                <td class="align-middle text-wrap p-1">{{ $multiguna->non_jabatan }}</td>

                                                <td class="align-middle text-wrap p-1">
                                                    {{ $multiguna->mendapat_rumah_dinas }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $multiguna->mendapat_mobil_dinas }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $multiguna->mendapat_sepeda_motor_dinas }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $multiguna->mendapat_fasilitas_pinjaman_uang }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $multiguna->belum_mendapat_fasilitas_dinas }}</td>

                                                @for ($i = 1; $i <= 3; $i++)
                                                    @if ($i == 1)
                                                        <td class="align-middle text-wrap p-1">
                                                            {{ $multiguna->nama_bank_nasabah }}
                                                        </td>
                                                        <td class="align-middle text-wrap p-1">
                                                            {{ $multiguna->no_bank_account_nasabah }}</td>
                                                    @endif

                                                    <td class="align-middle text-wrap p-1">
                                                        {{ $multiguna->{"tanggal_nasabah_bulan_{$i}"}
                                                            ? \Carbon\Carbon::parse($multiguna->{"tanggal_nasabah_bulan_{$i}"})->format('d/m/Y')
                                                            : '-' }}
                                                    </td>

                                                    <td class="align-middle text-wrap p-1">
                                                        {{ number_format($multiguna->{"saldo_awal_nasabah_bulan_{$i}"}, 2, ',', '.') }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-1">
                                                        {{ number_format($multiguna->{"total_debet_nasabah_bulan_{$i}"}, 2, ',', '.') }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-1">
                                                        {{ number_format($multiguna->{"total_kredit_nasabah_bulan_{$i}"}, 2, ',', '.') }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-1">
                                                        {{ number_format($multiguna->{"saldo_akhir_nasabah_bulan_{$i}"}, 2, ',', '.') }}
                                                    </td>
                                                @endfor


                                                @for ($i = 1; $i <= 3; $i++)
                                                    @if ($i == 1)
                                                        <td class="align-middle text-wrap p-1">
                                                            {{ $multiguna->nama_bank_pasangan }}
                                                        </td>
                                                        <td class="align-middle text-wrap p-1">
                                                            {{ $multiguna->no_bank_account_pasangan }}</td>
                                                    @endif

                                                    <td class="align-middle text-wrap p-1">
                                                        {{ $multiguna->{"tanggal_pasangan_bulan_{$i}"}
                                                            ? \Carbon\Carbon::parse($multiguna->{"tanggal_pasangan_bulan_{$i}"})->format('d/m/Y')
                                                            : '-' }}
                                                    </td>

                                                    <td class="align-middle text-wrap p-1">
                                                        {{ number_format($multiguna->{"saldo_awal_pasangan_bulan_{$i}"}, 2, ',', '.') }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-1">
                                                        {{ number_format($multiguna->{"total_debet_pasangan_bulan_{$i}"}, 2, ',', '.') }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-1">
                                                        {{ number_format($multiguna->{"total_kredit_pasangan_bulan_{$i}"}, 2, ',', '.') }}
                                                    </td>
                                                    <td class="align-middle text-wrap p-1">
                                                        {{ number_format($multiguna->{"saldo_akhir_pasangan_bulan_{$i}"}, 2, ',', '.') }}
                                                    </td>
                                                @endfor

                                                <td class="align-middle text-wrap p-1">{{ $multiguna->gaji_pokok }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $multiguna->tunjangan_penghasilan }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $multiguna->tunjangan_kesejahteraan }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $multiguna->tunjangan_struktural }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $multiguna->tunjangan_fungsional }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $multiguna->tunjangan_suami_istri }}</td>
                                                <td class="align-middle text-wrap p-1">{{ $multiguna->tunjangan_anak }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">{{ $multiguna->tunjangan_beras }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $multiguna->tunjangan_lain_lain }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $multiguna->tunjangan_pengobatan }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $multiguna->penerimaan_lain_lain }}</td>
                                                <td class="align-middle text-wrap p-1">{{ $multiguna->simpanan_wajib }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">{{ $multiguna->iuran_koperasi }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">{{ $multiguna->iuran_bpjs }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $multiguna->potongan_lain_lain }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $multiguna->pajak_penghasilan_pph21 }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $multiguna->angsuran_pinjaman_lain }}</td>

                                                <td class="align-middle text-wrap p-1">
                                                    {{ $multiguna->analis_harga_beli_bank }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $multiguna->analis_margin_bank }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $multiguna->analis_jangka_waktu_pembiayaan }}</td>

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
