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
                                            <th rowspan="2" class="align-middle p-2">Aksi</th>
                                            <th rowspan="2" class="align-middle p-2">No</th>
                                            <th rowspan="2" class="align-middle p-2">Kode Pengajuan</th>
                                            <th rowspan="2" class="align-middle p-2">Kode Nasabah</th>
                                            <th rowspan="2" class="align-middle p-2">Nama Nasabah</th>
                                            <th colspan="15" class="align-middle p-2">Legalitas Obyek/ Agunan Pembiayaan
                                            <th colspan="7" class="align-middle bg-white p-2">Keterangan Kondisi Agunan
                                            <th colspan="22" class="align-middle p-2">Bangunan di atas Agunan
                                            <th colspan="13" class="align-middle bg-white p-2">Marketabilitas Agunan
                                            </th>
                                        </tr>
                                        <tr class="text-center border border-dark">
                                            <th class="bg-white text-info">Jenis Sertifikat Hak</th>
                                            <th class="bg-white text-secondary">Nomor Sertifikat</th>
                                            <th class="bg-white text-secondary">Tanggal Penerbitan</th>
                                            <th class="bg-white text-secondary">Instansi yang Menerbitkan</th>
                                            <th class="bg-white text-secondary">Nama Pemegang Hak</th>
                                            <th class="bg-white text-secondary">Lama & Tgl Akhir Hak Berlalu</th>
                                            <th class="bg-white text-secondary">Surat Ukur Nomor</th>
                                            <th class="bg-white text-secondary">Tanggal Ukur</th>
                                            <th class="bg-white text-secondary">Asal Agunan</th>
                                            <th class="bg-white text-secondary">Luas Agunan</th>
                                            <th class="bg-white text-secondary">Letak Agunan</th>
                                            <th class="bg-white text-secondary">Batas Utara Agunan</th>
                                            <th class="bg-white text-secondary">Batas Timur Agunan</th>
                                            <th class="bg-white text-secondary">Batas Selatan Agunan</th>
                                            <th class="bg-white text-secondary">Batas Barat Agunan</th>

                                            <th class="bg-white text-secondary">Aksesibilitas Lokasi Agunan</th>
                                            <th class="bg-white text-secondary">Keterangan Mengenai Keadaan Lingkungan
                                                Agunan (tanah)</th>
                                            <th class="bg-white text-secondary">Keterangan Mengenai Keadaan Lingkungan
                                                Agunan (Terletak di Kawasan)</th>
                                            <th class="bg-white text-secondary">Penggunaan Agunan Saat Ini</th>
                                            <th class="bg-white text-secondary">Harga Sewanya per Tahun</th>
                                            <th class="bg-white text-secondary">Apakah Agunan Mempunyai Jalan Keluar ke
                                                Jalan Besar</th>
                                            <th class="bg-white text-secondary">Apakah Agunan Termasuk Aktiva Warisan yang
                                                Belum Dibagi</th>

                                            <th class="bg-white text-secondary">Izin Mendirikan Bangunan (IMB)</th>
                                            <th class="bg-white text-secondary">Tahun Pembuatan Bangunan</th>
                                            <th class="bg-white text-secondary">Perkiraan Biaya Pembangunan pada Tahun
                                                Tersebut</th>
                                            <th class="bg-white text-secondary">Keterangan Kontruksi Bangunan</th>
                                            <th class="bg-white text-secondary">Luas Efektif</th>
                                            <th class="bg-white text-secondary">Jumlah Lantai</th>
                                            <th class="bg-white text-secondary">Pondasi</th>
                                            <th class="bg-white text-secondary">Lantai</th>
                                            <th class="bg-white text-secondary">Konstruksi</th>
                                            <th class="bg-white text-secondary">Dinding</th>
                                            <th class="bg-white text-secondary">Dinding Pemisah</th>
                                            <th class="bg-white text-secondary">Kusen</th>
                                            <th class="bg-white text-secondary">Pintu</th>
                                            <th class="bg-white text-secondary">Jendela/Ventilasi</th>
                                            <th class="bg-white text-secondary">Plafond</th>
                                            <th class="bg-white text-secondary">Konstruksi Atap</th>
                                            <th class="bg-white text-secondary">Penutup Atap</th>
                                            <th class="bg-white text-secondary">Instalasi Air</th>
                                            <th class="bg-white text-secondary">Instalasi Listrik</th>
                                            <th class="bg-white text-secondary">Perawatan</th>
                                            <th class="bg-white text-secondary">Kondisi Sarana dan Emplasemen Bangunan</th>
                                            <th class="bg-white text-secondary">Informasi Lain tentang Kondisi Bangunan di
                                                Atas Agunan</th>

                                            <th class="bg-white text-info">Lokasi Perumahan</th>
                                            <th class="bg-white text-info">Kenyamanan</th>
                                            <th class="bg-white text-info">Lokasi Agunan</th>
                                            <th class="bg-white text-info">Jarak Fasum Fasos</th>
                                            <th class="bg-white text-info">Fasilitas Perumahan</th>
                                            <th class="bg-white text-info">Jeni Jalan Lingkungan</th>
                                            <th class="bg-white text-info">Jarak ke Jalan Provinsi</th>
                                            <th class="bg-white text-info">Jenis dan Kondisi Jalan</th>
                                            <th class="bg-white text-info">Kondisi Jalan ke Kota</th>
                                            <th class="bg-white text-info">Resiko Bencana Hidup</th>
                                            <th class="bg-white text-info">Kontribusi Pemohon DP</th>
                                            <th class="bg-white text-info">Pertumbuhan Agunan</th>
                                            <th class="bg-white text-info">Kondisi Wilayah Agunan</th>
                                        </tr>

                                    </thead>

                                    <tbody>
                                        @forelse ($murabahah_limac_collateralkpr as $index => $item)
                                            <tr class="text-center">
                                                <td class="text-center align-middle text-wrap p-2">
                                                    <a href="{{ route('murabahah.limac.collateralkpr.edit', $item->kode_pengajuan) }}"
                                                        class="text-warning" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </td>
                                                <td class="text-center align-middle text-wrap p-2">
                                                    {{ $murabahah_limac_collateralkpr->firstItem() + $index }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->kode_pengajuan }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->kode_nasabah }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->nama_nasabah }}</td>

                                                <td class="align-middle text-wrap p-2">{{ $item->jenis_sertifikat_hak }}
                                                </td>
                                                <td class="align-middle text-wrap p-2">{{ $item->nomor_sertifikat }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->tanggal_penerbitan }}</td>
                                                <td class="align-middle text-wrap p-2">
                                                    {{ $item->instansi_yang_menerbitkan }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->nama_pemegang_hak }}</td>
                                                <td class="align-middle text-wrap p-2">
                                                    {{ $item->lama_tgl_akhir_hak_berlaku }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->surat_ukur_nomor }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->tanggal_ukur }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->asal_agunan }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->luas_agunan }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->letak_agunan }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->batas_utara_agunan }}
                                                </td>
                                                <td class="align-middle text-wrap p-2">{{ $item->batas_timur_agunan }}
                                                </td>
                                                <td class="align-middle text-wrap p-2">{{ $item->batas_selatan_agunan }}
                                                </td>
                                                <td class="align-middle text-wrap p-2">{{ $item->batas_barat_agunan }}
                                                </td>

                                                <td class="align-middle text-wrap p-2">
                                                    {{ $item->aksesibilitas_lokasi_agunan }}</td>
                                                <td class="align-middle text-wrap p-2">
                                                    {{ $item->keterangan_lingkungan_agunan_tanah }}</td>
                                                <td class="align-middle text-wrap p-2">
                                                    {{ $item->keterangan_lingkungan_agunan_kawasan }}</td>
                                                <td class="align-middle text-wrap p-2">
                                                    {{ $item->penggunaan_agunan_saat_ini }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->harga_sewa_per_tahun }}
                                                </td>
                                                <td class="align-middle text-wrap p-2">
                                                    {{ $item->agunan_punya_akses_jalan_besar }}</td>
                                                <td class="align-middle text-wrap p-2">
                                                    {{ $item->agunan_aktiva_warisan_belum_dibagi }}</td>

                                                <td class="align-middle text-wrap p-2">{{ $item->memiliki_imb }}</td>
                                                <td class="align-middle text-wrap p-2">
                                                    {{ $item->tahun_pembuatan_bangunan }}</td>
                                                <td class="align-middle text-wrap p-2">
                                                    {{ $item->perkiraan_biaya_pembangunan }}</td>
                                                <td class="align-middle text-wrap p-2">
                                                    {{ $item->keterangan_konstruksi_bangunan }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->luas_efektif }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->jumlah_lantai }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->pondasi }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->lantai }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->konstruksi }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->dinding }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->dinding_pemisah }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->kusen }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->pintu }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->jendela_ventilasi }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->plafond }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->konstruksi_atap }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->penutup_atap }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->instalasi_air }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->instalasi_listrik }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->perawatan }}</td>
                                                <td class="align-middle text-wrap p-2">
                                                    {{ $item->kondisi_sarana_dan_emplasemen }}</td>
                                                <td class="align-middle text-wrap p-2">
                                                    {{ $item->informasi_lain_kondisi_bangunan }}</td>

                                                <td class="align-middle text-wrap p-2">{{ $item->lokasi_perumahan }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->kenyamanan }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->lokasi_agunan }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->jarak_fasum_fasos }}</td>
                                                <td class="align-middle text-wrap p-2">{{ $item->fasilitas_perumahan }}
                                                </td>

                                                <td class="align-middle text-wrap p-2">{{ $item->jenis_jalan_lingkungan }}
                                                </td>
                                                <td class="align-middle text-wrap p-2">
                                                    {{ $item->jarak_ke_jalan_provinsi }}
                                                </td>
                                                <td class="align-middle text-wrap p-2">
                                                    {{ $item->jenis_dan_kondisi_jalan }}
                                                </td>
                                                <td class="align-middle text-wrap p-2">{{ $item->kondisi_jalan_ke_kota }}
                                                </td>
                                                <td class="align-middle text-wrap p-2">{{ $item->resiko_bencana_hidup }}
                                                </td>
                                                <td class="align-middle text-wrap p-2">{{ $item->kontribusi_pemohon_dp }}
                                                </td>
                                                <td class="align-middle text-wrap p-2">{{ $item->pertumbuhan_agunan }}
                                                </td>
                                                <td class="align-middle text-wrap p-2">{{ $item->kondisi_wilayah_agunan }}
                                                </td>

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
                                {{ $murabahah_limac_collateralkpr->links() }}
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
@endsection
