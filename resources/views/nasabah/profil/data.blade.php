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
                                <a href="{{ route('nasabah.profil.tambah') }}" class="btn btn-primary">Tambah Data Nasabah
                                    +</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table border table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <th class="align-middle p-3" rowspan="2">Aksi</th>
                                            <th class="align-middle p-3" rowspan="2">No</th>
                                            <th class="align-middle p-3" rowspan="2">Kode Nasabah</th>
                                            <th class="p-2 px-3">Nama Lengkap (sesuai KTP)</th>
                                            <th class="p-2 px-3">Tempat, tanggal lahir</th>
                                            <th class="p-2 px-3">Alamat (sesuai KTP)</th>
                                            <th class="p-2 px-3">Kota (sesuai KTP)</th>
                                            <th class="p-2 px-3">Kode POS (sesuai KTP)</th>
                                            <th class="p-2 px-3">Alamat (sekarang)</th>
                                            <th class="p-2 px-3">Kota (sekarang)</th>
                                            <th class="p-2 px-3">Kode POS (sekarang)</th>
                                            <th class="p-2 px-3">No. KTP</th>
                                            <th class="p-2 px-3">Berlaku KTP</th>
                                            <th class="p-2 px-3">No. NPWP</th>
                                            <th class="p-2 px-3">Kepemilikan Rumah</th>
                                            <th class="p-2 px-3">Lama Menetap (tahun)</th>
                                            <th class="p-2 px-3">Lama Menetap (bulan)</th>
                                            <th class="p-2 px-3">No. Telp Rumah</th>
                                            <th class="p-2 px-3">No. Telp HP</th>
                                            <th class="p-2 px-3">Alamat Email</th>
                                            <th class="p-2 px-3">Jenis Kelamin</th>
                                            <th class="p-2 px-3">Status Kawin</th>
                                            <th class="p-2 px-3">Nama Ibu</th>
                                            <th class="p-2 px-3">Nama Organisasi</th>
                                            <th class="p-2 px-3">Jabatan Organisasi</th>
                                            <th class="p-2 px-3">Lama Organisasi</th>
                                            <th class="p-2 px-3">Nama Keluarga</th>
                                            <th class="p-2 px-3">Hubungan Keluarga</th>
                                            <th class="p-2 px-3">Alamat Keluarga</th>
                                            <th class="p-2 px-3">Kota Keluarga</th>
                                            <th class="p-2 px-3">Kode POS Keluarga</th>
                                            <th class="p-2 px-3">No. Telp Keluarga</th>
                                            <th class="p-2 px-3">Pekerjaan Keluarga</th>
                                            <th class="p-2 px-3">Alamat Kantor Keluarga</th>
                                            <th class="p-2 px-3">No. Telp Kantor Keluarga</th>
                                            <th class="p-2 px-3">Nama Pasangan</th>
                                            <th class="p-2 px-3">TTL Pasangan</th>
                                            <th class="p-2 px-3">No. KTP Pasangan</th>
                                            <th class="p-2 px-3">Berlaku KTP Pasangan</th>
                                            <th class="p-2 px-3">Jumlah Anak</th>
                                            <th class="p-2 px-3">No. NPWP Pasangan</th>
                                            <th class="text-info p-2 px-3">Punya Rekening</th>
                                            <th class="text-info p-2 px-3">Tahun Menjadi Nasabah</th>
                                            <th class="p-2 px-3">Jenis Layanan</th>
                                            <th class="text-info p-2 px-3">Mutasi Rekening</th>
                                        </tr>
                                        <tr>
                                            <th class="bg-white text-secondary p-1 pl-2" colspan="32">1.
                                                Identitas Nasabah
                                            </th>
                                            <th class="bg-white text-secondary p-1 pl-2" colspan="6">2. Identitas
                                                Nasabah
                                            </th>
                                            <th class="bg-white text-secondary p-1 pl-2" colspan="4">3. Hubungan Bank
                                                Syariah
                                            </th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        @forelse ($nasabah_profil as $index => $nasabah)
                                            <tr class="text-center">
                                                <td class="align-middle text-center p-1">
                                                    <a href="{{ route('nasabah.profil.edit', $nasabah->kode_nasabah) }}"
                                                        class="btn btn-sm btn-link text-warning p-1">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    @unless (Auth::user()->tipe_akun == 'siswa')
                                                        <form
                                                            action="{{ route('nasabah.profil.hapus', $nasabah->kode_nasabah) }}"
                                                            method="POST" class="d-inline"
                                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-link text-danger p-1">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                    @endunless
                                                </td>
                                                <td class="align-middle text-center text-wrap p-1">
                                                    {{ $nasabah_profil->firstItem() + $index }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">{{ $nasabah->kode_nasabah }}</td>
                                                <td class="align-middle text-wrap p-1">{{ $nasabah->nama_nasabah }}</td>
                                                <td class="align-middle text-wrap p-1">{{ $nasabah->ttl_lahir_nasabah }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">{{ $nasabah->alamat_ktp_nasabah }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">{{ $nasabah->kota_ktp_nasabah }}</td>
                                                <td class="align-middle text-wrap p-1">{{ $nasabah->kodepos_ktp_nasabah }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->alamat_sekarang_nasabah }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->kota_sekarang_nasabah }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->kodepos_sekarang_nasabah }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">{{ $nasabah->no_ktp_nasabah }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->berlaku_ktp_nasabah ? \Carbon\Carbon::parse($nasabah->berlaku_ktp_nasabah)->format('d-m-Y') : '-' }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">{{ $nasabah->no_npwp_nasabah }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->kepemilikan_rumah_nasabah }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->lamamenetap_tahun_nasabah }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->lamamenetap_bulan_nasabah }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">{{ $nasabah->notelp_rumah_nasabah }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">{{ $nasabah->notelp_hp_nasabah }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">{{ $nasabah->email_nasabah }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->jenis_kelamin_nasabah }}</td>
                                                <td class="align-middle text-wrap p-1">{{ $nasabah->status_kawin_nasabah }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">{{ $nasabah->nama_ibu_nasabah }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->nama_organisasi_nasabah }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->jabatan_organisasi_nasabah }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->lama_organisasi_nasabah }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->nama_keluarga_nasabah }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->hubungan_keluarga_nasabah }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->alamat_keluarga_nasabah }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->kota_keluarga_nasabah }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->kodepos_keluarga_nasabah }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->notelp_keluarga_nasabah }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->pekerjaan_keluarga_nasabah }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->alamatkantor_keluarga_nasabah }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->notelpkantor_keluarga_nasabah }}</td>
                                                <td class="align-middle text-wrap p-1">{{ $nasabah->nama_pasangan }}</td>
                                                <td class="align-middle text-wrap p-1">{{ $nasabah->ttl_lahir_pasangan }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">{{ $nasabah->no_ktp_pasangan }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->berlaku_ktp_pasangan ? \Carbon\Carbon::parse($nasabah->berlaku_ktp_pasangan)->format('d-m-Y') : '-' }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->jumlah_anak_pasangan }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">{{ $nasabah->no_npwp_pasangan }}
                                                </td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->punya_rekening_nasabah }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->tahun_menjadi_nasabah }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->jenis_layanan_nasabah }}</td>
                                                <td class="align-middle text-wrap p-1">
                                                    {{ $nasabah->mutasi_rekening_nasabah }}</td>
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
                                {{ $nasabah_profil->links() }}
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
@endsection
