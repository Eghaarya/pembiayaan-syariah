@extends('layouts.app')

@section('content')

    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">

        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="card card-social">
                    <div class="card-block border-bottom p-3">
                        <div class="row mb-2">
                            <div class="col-12">
                                <form action="{{ route('multiguna.limac.character.update', $pengajuan->kode_pengajuan) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="kode_nasabah" value="{{ $pengajuan->kode_nasabah }}">

                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-1-tab" data-toggle="tab"
                                                data-target="#nav-1" type="button" role="tab" aria-controls="nav-1"
                                                aria-selected="true">Karakter Nasabah</button>
                                            <button class="nav-link" id="nav-2-tab" data-toggle="tab" data-target="#nav-2"
                                                type="button" role="tab" aria-controls="nav-2"
                                                aria-selected="true">Data Checking Nasabah</button>
                                        </div>
                                    </nav>

                                    <div class="tab-content p-3" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-1" role="tabpanel"
                                            aria-labelledby="nav-1-tab">
                                            <h6>Personality/ Kepribadian</h6>
                                            <div class="row g-3 mb-3">
                                                @php
                                                    $fields = [
                                                        'responsif_komunikatif' => 'Responsif Komunikatif',
                                                        'mudah_dihubungi' => 'Mudah Dihubungi',
                                                        'wawasan_luas' => 'Wawasan Luas',
                                                        'informatif' => 'Informatif',
                                                        'terbuka_berkomunikasi' => 'Terbuka Berkomunikasi',
                                                    ];

                                                    $options = ['Tidak (0)', 'Iya (1)'];
                                                @endphp

                                                @foreach ($fields as $field => $label)
                                                    @php
                                                        $selected = old($field, $pengajuan->$field ?? '');
                                                        $firstOptionId =
                                                            $field . preg_replace('/[^a-zA-Z0-9]/', '', $options[0]);
                                                    @endphp

                                                    <div class="col-md-4 mt-2">
                                                        <label for="{{ $firstOptionId }}"
                                                            class="form-label fw-bold text-info d-block">{{ $label }}</label>

                                                        @foreach ($options as $option)
                                                            @php
                                                                $inputId =
                                                                    $field .
                                                                    preg_replace('/[^a-zA-Z0-9]/', '', $option);
                                                            @endphp
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="{{ $field }}" id="{{ $inputId }}"
                                                                    value="{{ $option }}"
                                                                    {{ $selected == $option ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="{{ $inputId }}">
                                                                    {{ $option }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                            </div>
                                            <h6>Account Behaviour</h6>
                                            <div class="row g-3 mb-3">
                                                @php
                                                    $fields = [
                                                        'tidak_blacklist_bi' => 'Tidak Blacklist BI',
                                                        'bg_cek_tidak_ditolak' => 'BG Cek Tidak Ditolak',
                                                        'tidak_bermasalah_bank_lain' => 'Tidak Bermasalah Bank Lain',
                                                        'fasilitas_sesuai_penggunaan' => 'Fasilitas Sesuai Penggunaan',
                                                        'mutasi_pinjaman_aktif' => 'Mutasi Pinjaman Aktif',
                                                    ];

                                                    $options = ['Tidak (0)', 'Iya (1)'];
                                                @endphp

                                                @foreach ($fields as $field => $label)
                                                    @php
                                                        $selected = old($field, $pengajuan->$field ?? '');
                                                        $firstOptionId =
                                                            $field . preg_replace('/[^a-zA-Z0-9]/', '', $options[0]);
                                                    @endphp

                                                    <div class="col-md-4 mt-2">
                                                        <label for="{{ $firstOptionId }}"
                                                            class="form-label fw-bold text-info d-block">{{ $label }}</label>

                                                        @foreach ($options as $option)
                                                            @php
                                                                $inputId =
                                                                    $field .
                                                                    preg_replace('/[^a-zA-Z0-9]/', '', $option);
                                                            @endphp
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="{{ $field }}" id="{{ $inputId }}"
                                                                    value="{{ $option }}"
                                                                    {{ $selected == $option ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="{{ $inputId }}">
                                                                    {{ $option }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endforeach

                                            </div>
                                            <div class="d-flex gap-2 justify-content-start mt-3" id="nav-tab"
                                                role="tablist">
                                                <a href="{{ route('multiguna.limac.character.data') }}"
                                                    class="btn btn-secondary">
                                                    ← Kembali
                                                </a>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="nav-2" role="tabpanel"
                                            aria-labelledby="nav-2-tab">
                                            <h6 class="border-bottom pb-2">Data Checking Nasabah</h6>

                                            {{-- Tabel Data Checking Nasabah --}}
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-sm">
                                                    <thead class="table-light text-center align-middle">
                                                        <tr>
                                                            <th>No</th>
                                                            <th>No Id Checking</th>
                                                            <th>Fasilitas Pinjaman</th>
                                                            <th>Bank Pelapor</th>
                                                            <th>Plafond Pinjaman</th>
                                                            <th>Outstanding Pinjaman</th>
                                                            <th>Tanggal Realisasi</th>
                                                            <th>Tanggal Jatuh Tempo</th>
                                                            <th class="text-info">Kolektabilitas</th>
                                                            <th>Keterangan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @for ($i = 1; $i <= 6; $i++)
                                                            <tr>
                                                                <td class="text-center align-middle">
                                                                    {{ $i }}
                                                                </td>
                                                                <td class="p-1"><input type="text"
                                                                        class="form-control form-control-sm"
                                                                        name="id_checking_nasabah[{{ $i }}][noid_checking]"
                                                                        value="{{ old("id_checking_nasabah.$i.noid_checking", $pengajuan->{"noid_checking{$i}_nasabah"}) }}">
                                                                </td>
                                                                <td class="p-1"><input type="text"
                                                                        class="form-control form-control-sm"
                                                                        name="id_checking_nasabah[{{ $i }}][fasilitas_pinjaman]"
                                                                        value="{{ old("id_checking_nasabah.$i.fasilitas_pinjaman", $pengajuan->{"fasilitas_pinjaman{$i}_nasabah"}) }}">
                                                                </td>
                                                                <td class="p-1"><input type="text"
                                                                        class="form-control form-control-sm"
                                                                        name="id_checking_nasabah[{{ $i }}][bank_pelapor]"
                                                                        value="{{ old("id_checking_nasabah.$i.bank_pelapor", $pengajuan->{"bank_pelapor{$i}_nasabah"}) }}">
                                                                </td>
                                                                <td class="p-1"><input type="number" step="0.01"
                                                                        class="form-control form-control-sm"
                                                                        name="id_checking_nasabah[{{ $i }}][plafond_pinjaman]"
                                                                        value="{{ old("id_checking_nasabah.$i.plafond_pinjaman", $pengajuan->{"plafond_pinjaman{$i}_nasabah"}) }}">
                                                                </td>
                                                                <td class="p-1"><input type="number" step="0.01"
                                                                        class="form-control form-control-sm"
                                                                        name="id_checking_nasabah[{{ $i }}][outstanding_pinjaman]"
                                                                        value="{{ old("id_checking_nasabah.$i.outstanding_pinjaman", $pengajuan->{"outstanding_pinjaman{$i}_nasabah"}) }}">
                                                                </td>
                                                                <td class="p-1"><input type="date"
                                                                        class="form-control form-control-sm"
                                                                        name="id_checking_nasabah[{{ $i }}][tanggal_realisasi]"
                                                                        value="{{ old("id_checking_nasabah.$i.tanggal_realisasi", $pengajuan->{"tanggal_realisasi{$i}_nasabah"} ? \Carbon\Carbon::parse($pengajuan->{"tanggal_realisasi{$i}_nasabah"})->format('Y-m-d') : '') }}">
                                                                </td>
                                                                <td class="p-1"><input type="date"
                                                                        class="form-control form-control-sm"
                                                                        name="id_checking_nasabah[{{ $i }}][tanggal_jatuh_tempo]"
                                                                        value="{{ old("id_checking_nasabah.$i.tanggal_jatuh_tempo", $pengajuan->{"tanggal_jatuh_tempo{$i}_nasabah"} ? \Carbon\Carbon::parse($pengajuan->{"tanggal_jatuh_tempo{$i}_nasabah"})->format('Y-m-d') : '') }}">
                                                                </td>
                                                                <td class="p-1">
                                                                    <select
                                                                        name="id_checking_nasabah[{{ $i }}][kolektabilitas]"
                                                                        class="form-select form-control form-select-sm">
                                                                        @php
                                                                            $options = [
                                                                                '--',
                                                                                'LANCAR/TIDAK MENUNGGAK (5)',
                                                                                'MENUNGGAK 1 - 2 (4)',
                                                                                'MENUNGGAK 3 - 6 (3)',
                                                                                'MENUNGGAK 7 - 10 (2)',
                                                                                'MENUNGGAK >10 (1)',
                                                                            ];

                                                                            $currentKolekbilitas = old(
                                                                                "id_checking_nasabah.$i.kolektabilitas",
                                                                                $pengajuan->{"kolektabilitas{$i}_nasabah"},
                                                                            );
                                                                        @endphp

                                                                        @foreach ($options as $label)
                                                                            <option value="{{ $label }}"
                                                                                {{ $currentKolekbilitas === $label ? 'selected' : '' }}>
                                                                                {{ $label }}
                                                                            </option>
                                                                        @endforeach

                                                                    </select>
                                                                </td>

                                                                <td class="p-1"><input type="text"
                                                                        class="form-control form-control-sm"
                                                                        name="id_checking_nasabah[{{ $i }}][keterangan]"
                                                                        value="{{ old("id_checking_nasabah.$i.keterangan", $pengajuan->{"keterangan{$i}_nasabah"}) }}">
                                                                </td>
                                                            </tr>
                                                        @endfor
                                                    </tbody>
                                                </table>
                                            </div>

                                            {{-- Tabel Data Checking Pasangan --}}
                                            <h6 class="mt-4 mb-2 fw-bold">Data Checking Pasangan</h6>
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-sm">
                                                    <thead class="table-light text-center align-middle">
                                                        <tr>
                                                            <th>No</th>
                                                            <th>No Id Checking</th>
                                                            <th>Fasilitas Pinjaman</th>
                                                            <th>Bank Pelapor</th>
                                                            <th>Plafond Pinjaman</th>
                                                            <th>Outstanding Pinjaman</th>
                                                            <th>Tanggal Realisasi</th>
                                                            <th>Tanggal Jatuh Tempo</th>
                                                            <th class="text-info">Kolektabilitas</th>
                                                            <th>Keterangan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @for ($i = 1; $i <= 6; $i++)
                                                            <tr>
                                                                <td class="text-center align-middle">
                                                                    {{ $i }}
                                                                </td>
                                                                <td class="p-1"><input type="text"
                                                                        class="form-control form-control-sm"
                                                                        name="id_checking_pasangan[{{ $i }}][noid_checking]"
                                                                        value="{{ old("id_checking_pasangan.$i.noid_checking", $pengajuan->{"noid_checking{$i}_pasangan"}) }}">
                                                                </td>
                                                                <td class="p-1"><input type="text"
                                                                        class="form-control form-control-sm"
                                                                        name="id_checking_pasangan[{{ $i }}][fasilitas_pinjaman]"
                                                                        value="{{ old("id_checking_pasangan.$i.fasilitas_pinjaman", $pengajuan->{"fasilitas_pinjaman{$i}_pasangan"}) }}">
                                                                </td>
                                                                <td class="p-1"><input type="text"
                                                                        class="form-control form-control-sm"
                                                                        name="id_checking_pasangan[{{ $i }}][bank_pelapor]"
                                                                        value="{{ old("id_checking_pasangan.$i.bank_pelapor", $pengajuan->{"bank_pelapor{$i}_pasangan"}) }}">
                                                                </td>
                                                                <td class="p-1"><input type="number" step="0.01"
                                                                        class="form-control form-control-sm"
                                                                        name="id_checking_pasangan[{{ $i }}][plafond_pinjaman]"
                                                                        value="{{ old("id_checking_pasangan.$i.plafond_pinjaman", $pengajuan->{"plafond_pinjaman{$i}_pasangan"}) }}">
                                                                </td>
                                                                <td class="p-1"><input type="number" step="0.01"
                                                                        class="form-control form-control-sm"
                                                                        name="id_checking_pasangan[{{ $i }}][outstanding_pinjaman]"
                                                                        value="{{ old("id_checking_pasangan.$i.outstanding_pinjaman", $pengajuan->{"outstanding_pinjaman{$i}_pasangan"}) }}">
                                                                </td>
                                                                <td class="p-1"><input type="date"
                                                                        class="form-control form-control-sm"
                                                                        name="id_checking_pasangan[{{ $i }}][tanggal_realisasi]"
                                                                        value="{{ old("id_checking_pasangan.$i.tanggal_realisasi", $pengajuan->{"tanggal_realisasi{$i}_pasangan"} ? \Carbon\Carbon::parse($pengajuan->{"tanggal_realisasi{$i}_pasangan"})->format('Y-m-d') : '') }}">
                                                                </td>
                                                                <td class="p-1"><input type="date"
                                                                        class="form-control form-control-sm"
                                                                        name="id_checking_pasangan[{{ $i }}][tanggal_jatuh_tempo]"
                                                                        value="{{ old("id_checking_pasangan.$i.tanggal_jatuh_tempo", $pengajuan->{"tanggal_jatuh_tempo{$i}_pasangan"} ? \Carbon\Carbon::parse($pengajuan->{"tanggal_jatuh_tempo{$i}_pasangan"})->format('Y-m-d') : '') }}">
                                                                </td>
                                                                <td class="p-1">
                                                                    <select
                                                                        name="id_checking_pasangan[{{ $i }}][kolektabilitas]"
                                                                        class="form-select form-control form-select-sm">
                                                                        @php
                                                                            $currentValue = old(
                                                                                "id_checking_pasangan.$i.kolektabilitas",
                                                                                $pengajuan->{"kolektabilitas{$i}_pasangan"},
                                                                            );
                                                                        @endphp

                                                                        @foreach ($options as $label)
                                                                            <option value="{{ $label }}"
                                                                                {{ (int) $currentKolekbilitas === $label ? 'selected' : '' }}>
                                                                                {{ $label }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>

                                                                <td class="p-1"><input type="text"
                                                                        class="form-control form-control-sm"
                                                                        name="id_checking_pasangan[{{ $i }}][keterangan]"
                                                                        value="{{ old("id_checking_pasangan.$i.keterangan", $pengajuan->{"keterangan{$i}_pasangan"}) }}">
                                                                </td>
                                                            </tr>
                                                        @endfor
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="d-flex gap-2 justify-content-start mt-3" id="nav-tab"
                                                role="tablist">
                                                <button type="submit" class="btn btn-warning">
                                                    <i class="fas fa-save me-2"></i> Simpan Perubahan
                                                    {{ ucwords(str_replace('_', ' ', explode('.', Route::currentRouteName())[2] ?? '')) }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
@endsection
