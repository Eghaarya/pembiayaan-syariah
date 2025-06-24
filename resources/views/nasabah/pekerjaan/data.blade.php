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
                                            <!-- 1.1 Pekerjaan Nasabah -->
                                            <th class="p-2 px-3">Nama Perusahaan Nasabah</th>
                                            <th class="text-info p-2 px-3">Bidang Perusahaan Nasabah</th>
                                            <th class="text-info p-2 px-3">Skala Perusahaan Nasabah</th>
                                            <th class="text-info p-2 px-3">Jenis Pekerjaan Nasabah</th>
                                            <th class="text-info p-2 px-3">Jabatan Pekerjaan Nasabah</th>
                                            <th class="p-2 px-3">Dept Perusahaan Nasabah</th>
                                            <th class="p-2 px-3">Mulai Bekerja Nasabah</th>
                                            <th class="p-2 px-3">Lama Bekerja Tahun Nasabah</th>
                                            <th class="p-2 px-3">Lama Bekerja Bulan Nasabah</th>
                                            <th class="text-info p-2 px-3">Pengalaman Perusahaan Nasabah</th>
                                            <th class="p-2 px-3">Total Bekerja Tahun Nasabah</th>
                                            <th class="p-2 px-3">Total Bekerja Bulan Nasabah</th>
                                            <th class="text-info p-2 px-3">Pendidikan Terakhir Nasabah</th>
                                            <th class="text-info p-2 px-3">Usia Nasabah</th>
                                            <th class="p-2 px-3">Usia Prapensiun Nasabah</th>
                                            <th class="p-2 px-3">Usia Pensiun Nasabah</th>
                                            <th class="text-info p-2 px-3">Sisa Pensiun Nasabah</th>
                                            <th class="p-2 px-3">Nama Atasan Nasabah</th>
                                            <th class="p-2 px-3">No Telp Atasan Nasabah</th>
                                            <th class="p-2 px-3">Jenis Pekerjaan Atasan Nasabah</th>
                                            <th class="p-2 px-3">Alamat Perusahaan Nasabah</th>
                                            <th class="p-2 px-3">No Telp Perusahaan Nasabah</th>
                                            <th class="p-2 px-3">Penggajian Satu Nasabah</th>
                                            <th class="p-2 px-3">Penggajian Dua Nasabah</th>
                                            <th class="p-2 px-3">Perjanjian Kerjasama</th>
                                            <th class="p-2 px-3">Pengalaman Perusahaan Lain Nasabah</th>
                                            <th class="text-info p-2 px-3">Sumber Penghasilan Nasabah</th>
                                            <th class="text-info p-2 px-3">Tanggungan Nasabah</th>

                                            <!-- 1.2 Pekerjaan Pasangan -->
                                            <th class="p-2 px-3">Nama Perusahaan Pasangan</th>
                                            <th class="p-2 px-3">Bidang Perusahaan Pasangan</th>
                                            <th class="p-2 px-3">Skala Perusahaan Pasangan</th>
                                            <th class="p-2 px-3">Jenis Pekerjaan Pasangan</th>
                                            <th class="p-2 px-3">Jabatan Pekerjaan Pasangan</th>
                                            <th class="p-2 px-3">Dept Perusahaan Pasangan</th>
                                            <th class="p-2 px-3">Mulai Bekerja Pasangan</th>
                                            <th class="p-2 px-3">Lama Bekerja Tahun Pasangan</th>
                                            <th class="p-2 px-3">Lama Bekerja Bulan Pasangan</th>
                                            <th class="p-2 px-3">Pengalaman Perusahaan Pasangan</th>
                                            <th class="p-2 px-3">Total Bekerja Tahun Pasangan</th>
                                            <th class="p-2 px-3">Total Bekerja Bulan Pasangan</th>
                                            <th class="p-2 px-3">Pendidikan Terakhir Pasangan</th>
                                            <th class="p-2 px-3">Usia Pasangan</th>
                                            <th class="p-2 px-3">Usia Prapensiun Pasangan</th>
                                            <th class="p-2 px-3">Usia Pensiun Pasangan</th>
                                            <th class="p-2 px-3">Nama Atasan Pasangan</th>
                                            <th class="p-2 px-3">No Telp Atasan Pasangan</th>
                                            <th class="p-2 px-3">Jenis Pekerjaan Atasan Pasangan</th>
                                            <th class="p-2 px-3">Alamat Perusahaan Pasangan</th>
                                            <th class="p-2 px-3">No Telp Perusahaan Pasangan</th>
                                            <th class="p-2 px-3">Penggajian Satu Pasangan</th>
                                            <th class="p-2 px-3">Penggajian Dua Pasangan</th>
                                            <th class="p-2 px-3">Pengalaman Perusahaan Lain Pasangan</th>

                                            <!-- 1.3 Usaha Nasabah/ Pasangan -->
                                            <th class="p-2 px-3">Nama Perusahaan Usaha</th>
                                            <th class="p-2 px-3">Bidang Perusahaan Usaha</th>
                                            <th class="p-2 px-3">Jabatan Usaha</th>
                                            <th class="p-2 px-3">Mulai Usaha</th>
                                            <th class="p-2 px-3">Lama Usaha</th>
                                            <th class="p-2 px-3">Total Lama Usaha</th>
                                            <th class="p-2 px-3">Jumlah Karyawan Usaha</th>
                                            <th class="p-2 px-3">Keterangan Tambahan Usaha</th>
                                            <th class="p-2 px-3">Usaha Pensiun Usaha</th>
                                            <th class="p-2 px-3">Nama Supplier Satu Usaha</th>
                                            <th class="p-2 px-3">Alamat Supplier Satu Usaha</th>
                                            <th class="p-2 px-3">No Telp Supplier Satu Usaha</th>
                                            <th class="p-2 px-3">Nama Supplier Dua Usaha</th>
                                            <th class="p-2 px-3">Alamat Supplier Dua Usaha</th>
                                            <th class="p-2 px-3">No Telp Supplier Dua Usaha</th>
                                            <th class="p-2 px-3">Nama Supplier Tiga Usaha</th>
                                            <th class="p-2 px-3">Alamat Supplier Tiga Usaha</th>
                                            <th class="p-2 px-3">No Telp Supplier Tiga Usaha</th>
                                        </tr>
                                        <tr>
                                            <th class="bg-white text-secondary p-1 pl-2" colspan="28">1.
                                                Pekerjaan Nasabah
                                            </th>
                                            <th class="bg-white text-secondary p-1 pl-2" colspan="24">2. Pekerjaan
                                                Pasangan
                                            </th>
                                            <th class="bg-white text-secondary p-1 pl-2" colspan="18">3. Usaha Nasabah/
                                                Pasangan
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($nasabah_pekerjaan as $index => $nasabah)
                                            <tr class="text-center">
                                                <td class="align-middle text-center p-1">
                                                    <a href="{{ route('nasabah.pekerjaan.edit', $nasabah->kode_nasabah) }}"
                                                        class="btn btn-sm btn-link text-warning p-1">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </td>
                                                <td class="align-middle text-center text-wrap p-1">
                                                    {{ $nasabah_pekerjaan->firstItem() + $index }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">{{ $nasabah->kode_nasabah }}</td>
                                                <td class="align-middle text-wrap p-1">{{ $nasabah->nama_nasabah }}</td>

                                                <!-- 1.1 Pekerjaan Nasabah -->
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->nama_perusahaan_nasabah }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->bidang_perusahaan_nasabah }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->skala_perusahaan_nasabah }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->jenis_pekerjaan_nasabah }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->jabatan_pekerjaan_nasabah }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->dept_perusahaan_nasabah }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->mulai_bekerja_nasabah }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->lamabekerja_tahun_nasabah }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->lamabekerja_bulan_nasabah }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->pengalaman_perusahaan_nasabah }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->totalbekerja_tahun_nasabah }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->totalbekerja_bulan_nasabah }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->pendidikan_terakhir_nasabah }}</td>
                                                <td class="align-middle text-wrap p-1">{{ $nasabah->usia_nasabah }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->usia_prapensiun_nasabah }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->usia_pensiun_nasabah }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->sisa_pensiun_nasabah }}</td>
                                                <td class="align-middle text-wrap p-1">{{ $nasabah->nama_atasan_nasabah }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->notelp_atasan_nasabah }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->jenispekerjaan_atasan_nasabah }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->alamat_perusahaan_nasabah }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->notelp_perusahaan_nasabah }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->penggajian_satu_nasabah }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->penggajian_dua_nasabah }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->perjanjian_kerjasama_nasabah }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->pengalaman_perusahaanlain_nasabah }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->sumber_penghasilan_nasabah }}</td>
                                                <td class="align-middle text-wrap p-1">{{ $nasabah->tanggungan_nasabah }}
                                                </td>

                                                <!-- 1.2 Pekerjaan Pasangan -->
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->nama_perusahaan_pasangan }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->bidang_perusahaan_pasangan }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->skala_perusahaan_pasangan }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->jenis_pekerjaan_pasangan }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->jabatan_pekerjaan_pasangan }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->dept_perusahaan_pasangan }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->mulai_bekerja_pasangan }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->lamabekerja_tahun_pasangan }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->lamabekerja_bulan_pasangan }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->pengalaman_perusahaan_pasangan }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->totalbekerja_tahun_pasangan }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->totalbekerja_bulan_pasangan }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->pendidikan_terakhir_pasangan }}</td>
                                                <td class="align-middle text-wrap p-1">{{ $nasabah->usia_pasangan }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->usia_prapensiun_pasangan }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->usia_pensiun_pasangan }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->nama_atasan_pasangan }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->notelp_atasan_pasangan }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->jenispekerjaan_atasan_pasangan }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->alamat_perusahaan_pasangan }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->notelp_perusahaan_pasangan }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->penggajian_satu_pasangan }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->penggajian_dua_pasangan }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->pengalaman_perusahaanlain_pasangan }}</td>

                                                <!-- 1.3 Usaha Nasabah / Pasangan -->
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->nama_perusahaan_usaha }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->bidang_perusahaan_usaha }}</td>
                                                <td class="align-middle text-wrap p-1">{{ $nasabah->jabatan_usaha }}</td>
                                                <td class="align-middle text-wrap p-1">{{ $nasabah->mulai_usaha }}</td>
                                                <td class="align-middle text-wrap p-1">{{ $nasabah->lama_usaha }}</td>
                                                <td class="align-middle text-wrap p-1">{{ $nasabah->total_lama_usaha }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->jumlah_karyawan_usaha }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->keterangan_tambahan_usaha }}</td>
                                                <td class="align-middle text-wrap p-1">{{ $nasabah->usaha_pensiun_usaha }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->nama_suppliersatu_usaha }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->alamat_suppliersatu_usaha }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->notelp_suppliersatu_usaha }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->nama_supplierdua_usaha }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->alamat_supplierdua_usaha }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->notelp_supplierdua_usaha }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->nama_suppliertiga_usaha }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->alamat_suppliertiga_usaha }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->notelp_suppliertiga_usaha }}</td>
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
                                {{ $nasabah_pekerjaan->links() }}
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
@endsection
