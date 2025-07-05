<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Nasabah\NasabahProfil;
use Illuminate\Database\QueryException;
use App\Models\Nasabah\NasabahPekerjaan;
use App\Models\Multiguna\Limac\MultigunaLimacCapital;
use App\Models\Multiguna\Limac\MultigunaLimacCapacity;
use App\Models\Multiguna\Pengajuan\MultigunaPengajuan;
use App\Models\Multiguna\Limac\MultigunaLimacCharacter;
use App\Models\Multiguna\Limac\MultigunaLimacCondition;
use App\Models\Multiguna\Limac\MultigunaLimacCollateralSk;
use App\Models\Multiguna\Limac\MultigunaLimacCollateralBermotor;
use App\Models\Multiguna\Limac\MultigunaLimacCollateralProperti;
use App\Models\Multiguna\Limac\MultigunaLimacCapitalTbAsetLainnya;
use App\Models\Multiguna\Limac\MultigunaLimacCapitalTbAsetKendaraan;
use App\Models\Multiguna\Limac\MultigunaLimacCapitalTbAsetAktivalancar;
use App\Models\Multiguna\Limac\MultigunaLimacCapitalTbAsetTanahbangunan;
use App\Models\Multiguna\Limac\MultigunaLimacCharacterTbCheckingNasabah;
use App\Models\Multiguna\Limac\MultigunaLimacCharacterTbCheckingPasangan;

class MultigunaLimacController extends Controller
{

    // otorisasi
    protected function authorizePengajuan($kode_pengajuan)
    {

        // autentikasi
        $user = Auth::user();

        // Ambil data pengajuan beserta relasi kode_nasabah
        $multiguna_pengajuan = MultigunaPengajuan::select('kode_nasabah', 'username', 'kode_tempat')
            ->where('kode_pengajuan', $kode_pengajuan)
            ->first();

        if (!$multiguna_pengajuan) {
            abort(404, 'Data pengajuan tidak ditemukan.');
        }

        $kode_nasabah = $multiguna_pengajuan->kode_nasabah;
        $nasabah_profil = NasabahProfil::select('username', 'kode_tempat')
            ->where('kode_nasabah', $kode_nasabah)
            ->first();

        if (!$nasabah_profil) {
            abort(404, 'Data nasabah tidak ditemukan.');
        }

        // Cek otorisasi
        if ($user->tipe_akun === 'pengajar') {
            if ($multiguna_pengajuan->kode_tempat !== $user->kode_tempat) {
                abort(403, 'Unauthorized');
            }
        } elseif ($user->tipe_akun === 'siswa') {
            if ($multiguna_pengajuan->username !== $user->username) {
                abort(403, 'Unauthorized');
            }
        }

        return $kode_nasabah;
    }

    // 1. Character
    public function indexLimacCharacter()
    {
        $user = Auth::user();

        if ($user->tipe_akun == 'siswa') {
            $multiguna_limac_character = MultigunaLimacCharacter::where('username', $user->username)
                ->where('kode_tempat', $user->kode_tempat)
                ->paginate(5);
        } elseif ($user->tipe_akun == 'pengajar') {
            $multiguna_limac_character = MultigunaLimacCharacter::where('kode_tempat', $user->kode_tempat)
                ->paginate(5);
        } elseif ($user->tipe_akun == 'admin') {
            $multiguna_limac_character = MultigunaLimacCharacter::paginate(5);
        } else {
            $multiguna_limac_character = collect();
        }

        // Ambil semua kode pengajuan dari hasil paginasi
        $kodePengajuanList = $multiguna_limac_character->pluck('kode_pengajuan')->all();

        // Ambil semua checking berdasarkan daftar kode_pengajuan
        $pengajuan_checking_nasabah = MultigunaLimacCharacterTbCheckingNasabah::whereIn('kode_pengajuan', $kodePengajuanList)
            ->get()
            ->groupBy('kode_pengajuan');

        $pengajuan_checking_pasangan = MultigunaLimacCharacterTbCheckingPasangan::whereIn('kode_pengajuan', $kodePengajuanList)
            ->get()
            ->groupBy('kode_pengajuan');

        return view('multiguna.limac.character.data', compact(
            'multiguna_limac_character',
            'pengajuan_checking_nasabah',
            'pengajuan_checking_pasangan'
        ));
    }

    public function editCharacter($kode_pengajuan)
    {
        $kode_nasabah = $this->authorizePengajuan($kode_pengajuan);

        // Ambil data untuk view
        $nasabah_profil = NasabahProfil::where('kode_nasabah', $kode_nasabah)->firstOrFail();
        $pengajuan = MultigunaLimacCharacter::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        $pengajuan_checking_nasabah = MultigunaLimacCharacterTbCheckingNasabah::where('kode_pengajuan', $kode_pengajuan)->get();
        $pengajuan_checking_pasangan = MultigunaLimacCharacterTbCheckingPasangan::where('kode_pengajuan', $kode_pengajuan)->get();

        return view('multiguna.limac.character.ubah', compact('nasabah_profil', 'pengajuan', 'pengajuan_checking_nasabah', 'pengajuan_checking_pasangan'));
    }

    public function updateCharacter(Request $request, $kode_pengajuan)
    {
        $this->authorizePengajuan($kode_pengajuan);

        $pengajuan = MultigunaLimacCharacter::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();

        $score = 0;
        $kolektabilitasScore = 0;
        $jumlahPinjaman = 0;

        // Daftar field yang ingin diambil dari form nasabah
        $fields = [
            'responsif_komunikatif',
            'mudah_dihubungi',
            'wawasan_luas',
            'informatif',
            'terbuka_berkomunikasi',
            'tidak_blacklist_bi',
            'bg_cek_tidak_ditolak',
            'tidak_bermasalah_bank_lain',
            'fasilitas_sesuai_penggunaan',
            'mutasi_pinjaman_aktif',
        ];

        // Ambil semua inputan nasabah & hitung skor dari nilai dalam tanda kurung
        foreach ($fields as $field) {
            $value = $request->input($field);
            $data[$field] = $value;

            if (preg_match('/\((\d+)\)/', $value, $matches)) {
                $score += (int) $matches[1];
            }
        }

        $pengajuan->update($data);

        $checkingConfigs = [
            'nasabah' => [
                'input' => 'id_checking_nasabah',
                'model' => MultigunaLimacCharacterTbCheckingNasabah::class,
                'map' => [
                    'noid_checking_nasabah' => 'noid_checking',
                    'nama_debitur_nasabah' => 'nama_debitur',
                    'fasilitas_pinjaman_nasabah' => 'fasilitas_pinjaman',
                    'bank_pelapor_nasabah' => 'bank_pelapor',
                    'plafond_pinjaman_nasabah' => 'plafond_pinjaman',
                    'outstanding_pinjaman_nasabah' => 'outstanding_pinjaman',
                    'tanggal_realisasi_nasabah' => 'tanggal_realisasi',
                    'tanggal_jatuh_tempo_nasabah' => 'tanggal_jatuh_tempo',
                    'kolektabilitas_nasabah' => 'kolektabilitas',
                    'keterangan_nasabah' => 'keterangan',
                    'agunan_nasabah' => 'agunan',
                ],
            ],
            'pasangan' => [
                'input' => 'id_checking_pasangan',
                'model' => MultigunaLimacCharacterTbCheckingPasangan::class,
                'map' => [
                    'noid_checking_pasangan' => 'noid_checking',
                    'nama_debitur_pasangan' => 'nama_debitur',
                    'fasilitas_pinjaman_pasangan' => 'fasilitas_pinjaman',
                    'bank_pelapor_pasangan' => 'bank_pelapor',
                    'plafond_pinjaman_pasangan' => 'plafond_pinjaman',
                    'outstanding_pinjaman_pasangan' => 'outstanding_pinjaman',
                    'tanggal_realisasi_pasangan' => 'tanggal_realisasi',
                    'tanggal_jatuh_tempo_pasangan' => 'tanggal_jatuh_tempo',
                    'kolektabilitas_pasangan' => 'kolektabilitas',
                    'keterangan_pasangan' => 'keterangan',
                    'agunan_pasangan' => 'agunan',
                ],
            ],
        ];

        // Data umum (reused)
        $common = [
            'kode_pengajuan' => $kode_pengajuan,
            'kode_nasabah' => $request->kode_nasabah,
            'nama_nasabah' => $request->nama_nasabah,
            'username' => $request->username,
            'kode_tempat' => $request->kode_tempat,
        ];

        // Helper function untuk konversi item input ke DB column
        function mapCheckingData(array $item, array $map): array
        {
            return collect($map)->mapWithKeys(fn($inputKey, $dbKey) => [
                $dbKey => $item[$inputKey] ?? null
            ])->all();
        }

        // Helper untuk cek baris kosong
        function isCheckingRowEmpty(array $item, array $map): bool
        {
            return collect($map)->values()->every(
                fn($inputKey) => empty($item[$inputKey]) || $item[$inputKey] === '--'
            );
        }

        // Loop semua aset
        foreach ($checkingConfigs as $config) {
            $dataArray = $request->input($config['input'], []);
            $model = $config['model'];
            $map = $config['map'];

            foreach ($dataArray as $item) {
                $isEmpty = isCheckingRowEmpty($item, $map);

                if (!empty($item['id'])) {
                    if ($isEmpty) {
                        $model::where('id', $item['id'])->delete();
                    } else {
                        $model::where('id', $item['id'])->update(mapCheckingData($item, $map));
                    }
                } elseif (!$isEmpty) {
                    $model::create(array_merge($common, mapCheckingData($item, $map)));
                }

                // Ambil skor kolektabilitas
                if (!empty($item['kolektabilitas'])) {
                    if (preg_match('/\((\d+)\)/', $item['kolektabilitas'], $matches)) {
                        $kolektabilitasScore += (int) $matches[1];
                    }
                }
            }

            $jumlahPinjaman += collect($dataArray)
                ->reject(fn($item) => isCheckingRowEmpty($item, $map))
                ->count();
        }

        if ($jumlahPinjaman === 0) {
            $pinjamanScore = 4;
        } elseif ($jumlahPinjaman <= 3) {
            $pinjamanScore = 3;
        } elseif ($jumlahPinjaman <= 6) {
            $pinjamanScore = 2;
        } else {
            $pinjamanScore = 1;
        }

        // Total score akhir
        $score += $kolektabilitasScore + $pinjamanScore;

        $profil = NasabahProfil::where('kode_nasabah', $request->kode_nasabah)->first();
        $scoreProfil = [
            'punya_rekening_nasabah',
            'tahun_menjadi_nasabah',
            'jenis_layanan_nasabah',
            'mutasi_rekening_nasabah',
        ];

        foreach ($scoreProfil as $field) {
            if (preg_match('/\((\d+)\)/', $profil->$field ?? '', $matches)) {
                $score += (int) $matches[1];
            }
        }

        MultigunaPengajuan::where('kode_pengajuan', $kode_pengajuan)
            ->update(['total_character' => $score]);

        return redirect()->route('multiguna.limac.character.data')
            ->with('success', '✅ Data berhasil diperbarui dan total score :' . $score . ' disimpan.');
    }

    // 2. Capacity
    public function indexLimacCapacity()
    {
        $user = Auth::user();

        if ($user->tipe_akun == 'siswa') {
            $multiguna_limac_capacity = MultigunaLimacCapacity::where('username', $user->username)
                ->where('kode_tempat', $user->kode_tempat)
                ->paginate(5);
        } elseif ($user->tipe_akun == 'pengajar') {
            $multiguna_limac_capacity = MultigunaLimacCapacity::where('kode_tempat', $user->kode_tempat)
                ->paginate(5);
        } elseif ($user->tipe_akun == 'admin') {
            $multiguna_limac_capacity = MultigunaLimacCapacity::paginate(5);
        } else {
            $multiguna_limac_capacity = collect();
        }

        return view('multiguna.limac.capacity.data', compact('multiguna_limac_capacity'));
    }

    public function editCapacity($kode_pengajuan)
    {
        $kode_nasabah = $this->authorizePengajuan($kode_pengajuan);

        // Ambil data untuk view
        $nasabah_pekerjaan = NasabahPekerjaan::where('kode_nasabah', $kode_nasabah)->firstOrFail();
        $pengajuan_pembiayaan = MultigunaPengajuan::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        $pengajuan = MultigunaLimacCapacity::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        $pengajuan_checking_nasabah = MultigunaLimacCharacterTbCheckingNasabah::where('kode_pengajuan', $kode_pengajuan)->get();
        $pengajuan_checking_pasangan = MultigunaLimacCharacterTbCheckingPasangan::where('kode_pengajuan', $kode_pengajuan)->get();

        return view('multiguna.limac.capacity.ubah', compact('nasabah_pekerjaan', 'pengajuan_pembiayaan', 'pengajuan', 'pengajuan_checking_nasabah', 'pengajuan_checking_pasangan'));
    }

    public function updateCapacity(Request $request, $kode_pengajuan)
    {
        $this->authorizePengajuan($kode_pengajuan);

        $dataUpdate = [
            'memiliki_jabatan_rangkap' => $request->memiliki_jabatan_rangkap,
            'publik_figur' => $request->publik_figur,
            'pemegang_jabatan_tertinggi' => $request->pemegang_jabatan_tertinggi,
            'bukan_pemegang_jabatan_tertinggi' => $request->bukan_pemegang_jabatan_tertinggi,
            'non_jabatan' => $request->non_jabatan,

            'mendapat_rumah_dinas' => $request->mendapat_rumah_dinas,
            'mendapat_mobil_dinas' => $request->mendapat_mobil_dinas,
            'mendapat_sepeda_motor_dinas' => $request->mendapat_sepeda_motor_dinas,
            'mendapat_fasilitas_pinjaman_uang' => $request->mendapat_fasilitas_pinjaman_uang,
            'belum_mendapat_fasilitas_dinas' => $request->belum_mendapat_fasilitas_dinas,

            'nama_bank_nasabah' => $request->nama_bank_nasabah,
            'no_bank_account_nasabah' => $request->no_bank_account_nasabah,
            'nama_bank_pasangan' => $request->nama_bank_pasangan,
            'no_bank_account_pasangan' => $request->no_bank_account_pasangan,
        ];

        for ($i = 1; $i <= 3; $i++) {
            // perincian rekening tabungan
            $dataUpdate["tanggal_nasabah_bulan_{$i}"] = $request->input("tanggal_nasabah_bulan_{$i}");
            $dataUpdate["saldo_awal_nasabah_bulan_{$i}"] = $request->input("saldo_awal_nasabah_bulan_{$i}");
            $dataUpdate["total_debet_nasabah_bulan_{$i}"] = $request->input("total_debet_nasabah_bulan_{$i}");
            $dataUpdate["total_kredit_nasabah_bulan_{$i}"] = $request->input("total_kredit_nasabah_bulan_{$i}");
            $dataUpdate["saldo_akhir_nasabah_bulan_{$i}"] = $request->input("saldo_akhir_nasabah_bulan_{$i}");

            $dataUpdate["tanggal_pasangan_bulan_{$i}"] = $request->input("tanggal_pasangan_bulan_{$i}");
            $dataUpdate["saldo_awal_pasangan_bulan_{$i}"] = $request->input("saldo_awal_pasangan_bulan_{$i}");
            $dataUpdate["total_debet_pasangan_bulan_{$i}"] = $request->input("total_debet_pasangan_bulan_{$i}");
            $dataUpdate["total_kredit_pasangan_bulan_{$i}"] = $request->input("total_kredit_pasangan_bulan_{$i}");
            $dataUpdate["saldo_akhir_pasangan_bulan_{$i}"] = $request->input("saldo_akhir_pasangan_bulan_{$i}");
        }

        $dataUpdate = array_merge($dataUpdate, [
            'gaji_pokok' => $request->gaji_pokok,
            'tunjangan_penghasilan' => $request->tunjangan_penghasilan,
            'tunjangan_kesejahteraan' => $request->tunjangan_kesejahteraan,
            'tunjangan_struktural' => $request->tunjangan_struktural,
            'tunjangan_fungsional' => $request->tunjangan_fungsional,
            'tunjangan_suami_istri' => $request->tunjangan_suami_istri,
            'tunjangan_anak' => $request->tunjangan_anak,
            'tunjangan_beras' => $request->tunjangan_beras,
            'tunjangan_lain_lain' => $request->tunjangan_lain_lain,
            'tunjangan_pengobatan' => $request->tunjangan_pengobatan,
            'penerimaan_lain_lain' => $request->penerimaan_lain_lain,
            'simpanan_wajib' => $request->simpanan_wajib,
            'iuran_koperasi' => $request->iuran_koperasi,
            'iuran_bpjs' => $request->iuran_bpjs,
            'potongan_lain_lain' => $request->potongan_lain_lain,
            'pajak_penghasilan_pph21' => $request->pajak_penghasilan_pph21,
            'angsuran_pinjaman_lain' => $request->angsuran_pinjaman_lain,

            'analis_harga_beli_bank' => $request->analis_harga_beli_bank,
            'analis_margin_bank' => $request->analis_margin_bank,
            'analis_jangka_waktu_pembiayaan' => $request->analis_jangka_waktu_pembiayaan,

        ]);

        MultigunaLimacCapacity::where('kode_pengajuan', $kode_pengajuan)->update($dataUpdate);

        MultigunaPengajuan::where('kode_pengajuan', $kode_pengajuan)
            ->update([
                'keputusan_harga_beli_bank' => $request->analis_harga_beli_bank,
                'keputusan_margin_bank'     => $request->save_analis_margin_bank_from_db,
                'keputusan_jangka_waktu_pembiayaan' => $request->analis_jangka_waktu_pembiayaan,
            ]);

        $scoreCapacity = [
            'memiliki_jabatan_rangkap',
            'publik_figur',
            'pemegang_jabatan_tertinggi',
            'bukan_pemegang_jabatan_tertinggi',
            'non_jabatan',

            'mendapat_rumah_dinas',
            'mendapat_mobil_dinas',
            'mendapat_sepeda_motor_dinas',
            'mendapat_fasilitas_pinjaman_uang',
            'belum_mendapat_fasilitas_dinas',
        ];

        $score = 0;
        foreach ($scoreCapacity as $field) {
            $value = $request->$field;

            if (preg_match('/\((\d+)\)/', $value, $matches)) {
                $score += (int) $matches[1];
            }
        }

        $pekerjaan = NasabahPekerjaan::where('kode_nasabah', $request->kode_nasabah)->first();
        $scorePekerjaan = [
            'bidang_perusahaan_nasabah',
            'skala_perusahaan_nasabah',
            'jenis_pekerjaan_nasabah',
            'jabatan_pekerjaan_nasabah',
            'pengalaman_perusahaan_nasabah',
            'pendidikan_terakhir_nasabah',
            'usia_nasabah',
            'sisa_pensiun_nasabah',
            'perjanjian_kerjasama_nasabah',
        ];

        foreach ($scorePekerjaan as $field) {
            if (preg_match('/\((\d+)\)/', $pekerjaan->$field ?? '', $matches)) {
                $score += (int) $matches[1];
            }
        }

        MultigunaPengajuan::where('kode_pengajuan', $kode_pengajuan)
            ->update(['total_capacity' => $score]);


        return redirect()->route('multiguna.limac.capacity.data')
            ->with('success', '✅ Data berhasil diperbarui dan total score :' . $score . ' disimpan.');
    }

    // 3. Capital
    public function indexLimacCapital()
    {
        $user = Auth::user();

        if ($user->tipe_akun == 'siswa') {
            $multiguna_limac_capital = MultigunaLimacCapital::where('username', $user->username)
                ->where('kode_tempat', $user->kode_tempat)
                ->paginate(5);
        } elseif ($user->tipe_akun == 'pengajar') {
            $multiguna_limac_capital = MultigunaLimacCapital::where('kode_tempat', $user->kode_tempat)
                ->paginate(5);
        } elseif ($user->tipe_akun == 'admin') {
            $multiguna_limac_capital = MultigunaLimacCapital::paginate(5);
        } else {
            $multiguna_limac_capital = collect();
        }

        // Ambil semua kode pengajuan dari hasil paginasi
        $kodePengajuanList = $multiguna_limac_capital->pluck('kode_pengajuan')->all();

        // Ambil semua checking berdasarkan daftar kode_pengajuan
        $pengajuan_aset_aktivalancar = MultigunaLimacCapitalTbAsetAktivalancar::whereIn('kode_pengajuan', $kodePengajuanList)
            ->get()
            ->groupBy('kode_pengajuan');
        $pengajuan_aset_tanahbangunan = MultigunaLimacCapitalTbAsetTanahbangunan::whereIn('kode_pengajuan', $kodePengajuanList)
            ->get()
            ->groupBy('kode_pengajuan');
        $pengajuan_aset_kendaraan = MultigunaLimacCapitalTbAsetKendaraan::whereIn('kode_pengajuan', $kodePengajuanList)
            ->get()
            ->groupBy('kode_pengajuan');
        $pengajuan_aset_lainnya = MultigunaLimacCapitalTbAsetLainnya::whereIn('kode_pengajuan', $kodePengajuanList)
            ->get()
            ->groupBy('kode_pengajuan');

        return view('multiguna.limac.capital.data', compact(
            'multiguna_limac_capital',
            'pengajuan_aset_aktivalancar',
            'pengajuan_aset_tanahbangunan',
            'pengajuan_aset_kendaraan',
            'pengajuan_aset_lainnya'
        ));
    }

    public function editCapital($kode_pengajuan)
    {
        $this->authorizePengajuan($kode_pengajuan);

        $pengajuan_pembiayaan = MultigunaPengajuan::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        $pengajuan = MultigunaLimacCapital::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        $pengajuan_aset_aktivalancar = MultigunaLimacCapitalTbAsetAktivalancar::where('kode_pengajuan', $kode_pengajuan)->get();
        $pengajuan_aset_tanahbangunan = MultigunaLimacCapitalTbAsetTanahbangunan::where('kode_pengajuan', $kode_pengajuan)->get();
        $pengajuan_aset_kendaraan = MultigunaLimacCapitalTbAsetKendaraan::where('kode_pengajuan', $kode_pengajuan)->get();
        $pengajuan_aset_lainnya = MultigunaLimacCapitalTbAsetLainnya::where('kode_pengajuan', $kode_pengajuan)->get();

        return view('multiguna.limac.capital.ubah', compact('pengajuan_pembiayaan', 'pengajuan', 'pengajuan_aset_aktivalancar', 'pengajuan_aset_tanahbangunan', 'pengajuan_aset_kendaraan', 'pengajuan_aset_lainnya'));
    }

    public function updateCapital(Request $request, $kode_pengajuan)
    {
        $this->authorizePengajuan($kode_pengajuan);

        $asetConfigs = [
            'aktivalancar' => [
                'input' => 'id_aset_aktivalancar',
                'model' => MultigunaLimacCapitalTbAsetAktivalancar::class,
                'map' => [
                    'aktiva_lancar_keterangan' => 'keterangan',
                    'aktiva_lancar_nilai' => 'nilai',
                ],
            ],
            'tanahbangunan' => [
                'input' => 'id_aset_tanahbangunan',
                'model' => MultigunaLimacCapitalTbAsetTanahbangunan::class,
                'map' => [
                    'tanah_lokasi' => 'lokasi',
                    'tanah_luas_tanah_bangunan' => 'luas_tanah_bangunan',
                    'tanah_status' => 'status',
                    'tanah_atas_nama' => 'atas_nama',
                    'tanah_nilai' => 'nilai',
                ],
            ],
            'kendaraan' => [
                'input' => 'id_aset_kendaraan',
                'model' => MultigunaLimacCapitalTbAsetKendaraan::class,
                'map' => [
                    'kendaraan_jenis_merek' => 'jenis_merek',
                    'kendaraan_tahun_pembuatan' => 'tahun_pembuatan',
                    'kendaraan_atas_nama' => 'atas_nama',
                    'kendaraan_nilai' => 'nilai',
                ],
            ],
            'lainnya' => [
                'input' => 'id_aset_lainnya',
                'model' => MultigunaLimacCapitalTbAsetLainnya::class,
                'map' => [
                    'lain_jenis' => 'jenis',
                    'lain_lokasi' => 'lokasi',
                    'lain_atas_nama' => 'atas_nama',
                    'lain_nilai' => 'nilai',
                ],
            ],
        ];

        // Data umum (reused)
        $common = [
            'kode_pengajuan' => $kode_pengajuan,
            'kode_nasabah' => $request->kode_nasabah,
            'nama_nasabah' => $request->nama_nasabah,
            'username' => $request->username,
            'kode_tempat' => $request->kode_tempat,
        ];

        // Helper function untuk konversi item input ke DB column
        function mapAsetData(array $item, array $map): array
        {
            return collect($map)->mapWithKeys(fn($inputKey, $dbKey) => [
                $dbKey => $item[$inputKey] ?? null
            ])->all();
        }

        // Helper untuk cek baris kosong
        function isAsetRowEmpty(array $item, array $map): bool
        {
            return collect($map)->values()->every(
                fn($inputKey) => empty($item[$inputKey]) || $item[$inputKey] === '--'
            );
        }

        // Loop semua aset
        foreach ($asetConfigs as $config) {
            $dataArray = $request->input($config['input'], []);
            $model = $config['model'];
            $map = $config['map'];

            foreach ($dataArray as $item) {
                if (!empty($item['id'])) {
                    if (isAsetRowEmpty($item, $map)) {
                        $model::where('id', $item['id'])->delete();
                    } else {
                        $model::where('id', $item['id'])->update(mapAsetData($item, $map));
                    }
                } elseif (!isAsetRowEmpty($item, $map)) {
                    $model::create(array_merge($common, mapAsetData($item, $map)));
                }
            }
        }

        $score = 0;
        // $score += (int) (preg_match('/\((\d+)\)/', $request->besarnya_urbun, $m) ? $m[1] : 0);

        // MultigunaPengajuan::where('kode_pengajuan', $kode_pengajuan)
        //     ->update([
        //         'total_capital' => $score,
        //     ]);

        return redirect()->route('multiguna.limac.capital.data')
            ->with('success', '✅ Data berhasil diperbarui dan total score :' . $score . ' disimpan.');
    }

    // 4.1 CollateralSk
    public function indexLimacCollateralSk()
    {
        $user = Auth::user();

        if ($user->tipe_akun == 'siswa') {
            $multiguna_limac_collateralsk = MultigunaLimacCollateralSk::where('username', $user->username)
                ->where('kode_tempat', $user->kode_tempat)
                ->paginate(5);
        } elseif ($user->tipe_akun == 'pengajar') {
            $multiguna_limac_collateralsk = MultigunaLimacCollateralSk::where('kode_tempat', $user->kode_tempat)
                ->paginate(5);
        } elseif ($user->tipe_akun == 'admin') {
            $multiguna_limac_collateralsk = MultigunaLimacCollateralSk::paginate(5);
        } else {
            $multiguna_limac_collateralsk = collect();
        }

        return view('multiguna.limac.collateralsk.data', compact('multiguna_limac_collateralsk'));
    }

    public function editCollateralSk($kode_pengajuan)
    {
        $kode_nasabah = $this->authorizePengajuan($kode_pengajuan);

        // Ambil data untuk view
        $nasabah_pekerjaan = NasabahPekerjaan::where('kode_nasabah', $kode_nasabah)->firstOrFail();
        $pengajuan = MultigunaLimacCollateralSk::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        return view('multiguna.limac.collateralsk.ubah', compact('nasabah_pekerjaan', 'pengajuan'));
    }

    public function updateCollateralSk(Request $request, $kode_pengajuan)
    {
        $this->authorizePengajuan($kode_pengajuan);

        MultigunaLimacCollateralSk::where('kode_pengajuan', $kode_pengajuan)
            ->update([
                'sk_pengangkatan_pegawai_tetap' => $request->sk_pengangkatan_pegawai_tetap,
                'sk_jabatan_terakhir_terkini'   => $request->sk_jabatan_terakhir_terkini,

            ]);

        $points = [
            'sk_pengangkatan_pegawai_tetap',
            'sk_jabatan_terakhir_terkini',
        ];

        $score = 0;
        foreach ($points as $point) {
            if (preg_match('/\((\d+)\)/', $request->$point, $matches)) {
                $score += (int) $matches[1];
            }
        }

        $pekerjaan = NasabahPekerjaan::where('kode_nasabah', $request->kode_nasabah)->first();
        $scorePekerjaan = [
            'perjanjian_kerjasama_nasabah',
        ];

        foreach ($scorePekerjaan as $field) {
            if (preg_match('/\((\d+)\)/', $pekerjaan->$field ?? '', $matches)) {
                $score += (int) $matches[1];
            }
        }

        MultigunaPengajuan::where('kode_pengajuan', $kode_pengajuan)
            ->update([
                'total_collateralsk' => $score,
            ]);

        return redirect()->route('multiguna.limac.collateralsk.data')
            ->with('success', '✅ Data berhasil diperbarui dan total score :' . $score . ' disimpan.');
    }

    // 4.2 Collateral Properti
    public function indexLimacCollateralProperti()
    {
        $user = Auth::user();

        if ($user->tipe_akun == 'siswa') {
            $multiguna_limac_collateralproperti = MultigunaLimacCollateralProperti::where('username', $user->username)
                ->where('kode_tempat', $user->kode_tempat)
                ->paginate(5);
        } elseif ($user->tipe_akun == 'pengajar') {
            $multiguna_limac_collateralproperti = MultigunaLimacCollateralProperti::where('kode_tempat', $user->kode_tempat)
                ->paginate(5);
        } elseif ($user->tipe_akun == 'admin') {
            $multiguna_limac_collateralproperti = MultigunaLimacCollateralProperti::paginate(5);
        } else {
            $multiguna_limac_collateralproperti = collect();
        }

        return view('multiguna.limac.collateralproperti.data', compact('multiguna_limac_collateralproperti'));
    }

    public function editCollateralProperti($kode_pengajuan)
    {
        $this->authorizePengajuan($kode_pengajuan);

        $pengajuan = MultigunaLimacCollateralProperti::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        return view('multiguna.limac.collateralproperti.ubah', compact('pengajuan'));
    }

    public function updateCollateralProperti(Request $request, $kode_pengajuan)
    {
        $this->authorizePengajuan($kode_pengajuan);

        MultigunaLimacCollateralProperti::where('kode_pengajuan', $kode_pengajuan)
            ->update([
                'jenis_sertifikat_hak'       => $request->jenis_sertifikat_hak,
                'nomor_sertifikat'           => $request->nomor_sertifikat,
                'tanggal_penerbitan'         => $request->tanggal_penerbitan,
                'instansi_yang_menerbitkan'  => $request->instansi_yang_menerbitkan,
                'nama_pemegang_hak'          => $request->nama_pemegang_hak,
                'lama_tgl_akhir_hak_berlaku' => $request->lama_tgl_akhir_hak_berlaku,
                'surat_ukur_nomor'           => $request->surat_ukur_nomor,
                'tanggal_ukur'               => $request->tanggal_ukur,
                'asal_agunan'                => $request->asal_agunan,
                'luas_agunan'                => $request->luas_agunan,
                'letak_agunan'               => $request->letak_agunan,
                'batas_utara_agunan'         => $request->batas_utara_agunan,
                'batas_timur_agunan'         => $request->batas_timur_agunan,
                'batas_selatan_agunan'       => $request->batas_selatan_agunan,
                'batas_barat_agunan'         => $request->batas_barat_agunan,

                'aksesibilitas_lokasi_agunan' => $request->aksesibilitas_lokasi_agunan,
                'keterangan_lingkungan_agunan_tanah' => $request->keterangan_lingkungan_agunan_tanah,
                'keterangan_lingkungan_agunan_kawasan' => $request->keterangan_lingkungan_agunan_kawasan,
                'penggunaan_agunan_saat_ini' => $request->penggunaan_agunan_saat_ini,
                'harga_sewa_per_tahun' => $request->harga_sewa_per_tahun,
                'agunan_punya_akses_jalan_besar' => $request->agunan_punya_akses_jalan_besar,
                'agunan_aktiva_warisan_belum_dibagi' => $request->agunan_aktiva_warisan_belum_dibagi,

                'memiliki_imb' => $request->memiliki_imb,
                'tahun_pembuatan_bangunan' => $request->tahun_pembuatan_bangunan,
                'perkiraan_biaya_pembangunan' => $request->perkiraan_biaya_pembangunan,
                'keterangan_konstruksi_bangunan' => $request->keterangan_konstruksi_bangunan,
                'luas_efektif' => $request->luas_efektif,
                'jumlah_lantai' => $request->jumlah_lantai,
                'pondasi' => $request->pondasi,
                'lantai' => $request->lantai,
                'konstruksi' => $request->konstruksi,
                'dinding' => $request->dinding,
                'dinding_pemisah' => $request->dinding_pemisah,
                'kusen' => $request->kusen,
                'pintu' => $request->pintu,
                'jendela_ventilasi' => $request->jendela_ventilasi,
                'plafond' => $request->plafond,
                'konstruksi_atap' => $request->konstruksi_atap,
                'penutup_atap' => $request->penutup_atap,
                'instalasi_air' => $request->instalasi_air,
                'instalasi_listrik' => $request->instalasi_listrik,
                'perawatan' => $request->perawatan,
                'kondisi_sarana_dan_emplasemen' => $request->kondisi_sarana_dan_emplasemen,
                'informasi_lain_kondisi_bangunan' => $request->informasi_lain_kondisi_bangunan,

                'lokasi_perumahan'           => $request->lokasi_perumahan,
                'kenyamanan'                 => $request->kenyamanan,
                'lokasi_agunan'              => $request->lokasi_agunan,
                'jarak_fasum_fasos'          => $request->jarak_fasum_fasos,
                'fasilitas_perumahan'        => $request->fasilitas_perumahan,
                'jenis_jalan_lingkungan'     => $request->jenis_jalan_lingkungan,
                'jarak_ke_jalan_provinsi'    => $request->jarak_ke_jalan_provinsi,
                'jenis_dan_kondisi_jalan'    => $request->jenis_dan_kondisi_jalan,
                'kondisi_jalan_ke_kota'      => $request->kondisi_jalan_ke_kota,
                'resiko_bencana_hidup'       => $request->resiko_bencana_hidup,
                'kontribusi_pemohon_dp'      => $request->kontribusi_pemohon_dp,
                'pertumbuhan_agunan'          => $request->pertumbuhan_agunan,
                'kondisi_wilayah_agunan'     => $request->kondisi_wilayah_agunan,
            ]);

        $points = [
            'jenis_sertifikat_hak',

            'lokasi_perumahan',
            'kenyamanan',
            'lokasi_agunan',
            'jarak_fasum_fasos',
            'fasilitas_perumahan',
            'jenis_jalan_lingkungan',
            'jarak_ke_jalan_provinsi',
            'jenis_dan_kondisi_jalan',
            'kondisi_jalan_ke_kota',
            'resiko_bencana_hidup',
            'kontribusi_pemohon_dp',
            'pertumbuhan_agunan',
            'kondisi_wilayah_agunan',
        ];

        $score = 0;
        foreach ($points as $point) {
            if (preg_match('/\((\d+)\)/', $request->$point, $matches)) {
                $score += (int) $matches[1];
            }
        }

        MultigunaPengajuan::where('kode_pengajuan', $kode_pengajuan)
            ->update([
                'total_collateralproperti' => $score,
            ]);

        return redirect()->route('multiguna.limac.collateralproperti.data')
            ->with('success', '✅ Data berhasil diperbarui dan total score :' . $score . ' disimpan.');
    }

    // 4.3 Collateral Bermotor
    public function indexLimacCollateralBermotor()
    {
        $user = Auth::user();

        if ($user->tipe_akun == 'siswa') {
            $multiguna_limac_collateralbermotor = MultigunaLimacCollateralBermotor::where('username', $user->username)
                ->where('kode_tempat', $user->kode_tempat)
                ->paginate(5);
        } elseif ($user->tipe_akun == 'pengajar') {
            $multiguna_limac_collateralbermotor = MultigunaLimacCollateralBermotor::where('kode_tempat', $user->kode_tempat)
                ->paginate(5);
        } elseif ($user->tipe_akun == 'admin') {
            $multiguna_limac_collateralbermotor = MultigunaLimacCollateralBermotor::paginate(5);
        } else {
            $multiguna_limac_collateralbermotor = collect();
        }

        return view('multiguna.limac.collateralbermotor.data', compact('multiguna_limac_collateralbermotor'));
    }

    public function editCollateralbermotor($kode_pengajuan)
    {
        $this->authorizePengajuan($kode_pengajuan);

        $pengajuan = MultigunaLimacCollateralbermotor::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        return view('multiguna.limac.collateralbermotor.ubah', compact('pengajuan'));
    }

    public function updateCollateralbermotor(Request $request, $kode_pengajuan)
    {
        $this->authorizePengajuan($kode_pengajuan);

        MultigunaLimacCollateralbermotor::where('kode_pengajuan', $kode_pengajuan)
            ->update([
                'tujuan_penggunaan' => $request->tujuan_penggunaan,
                'jenis_kendaraan' => $request->jenis_kendaraan,
                'status_agunan_kendaraan' => $request->status_agunan_kendaraan,
                'nomor_stnk_agunan' => $request->nomor_stnk_agunan,
                'nama_pemilik_agunan' => $request->nama_pemilik_agunan,
                'alamat_pemilik_agunan' => $request->alamat_pemilik_agunan,
                'merk_agunan' => $request->merk_agunan,
                'tipe_agunan' => $request->tipe_agunan,
                'teknologi' => $request->teknologi,
                'bahan_bakar' => $request->bahan_bakar,
                'warna_agunan' => $request->warna_agunan,
                'isi_silinder' => $request->isi_silinder,
                'nomor_rangka_agunan' => $request->nomor_rangka_agunan,
                'nomor_mesin_agunan' => $request->nomor_mesin_agunan,
                'tahun_pembuatan' => $request->tahun_pembuatan,
                'masa_berlaku' => $request->masa_berlaku,
            ]);

        $points = [
            'tujuan_penggunaan',
            'jenis_kendaraan',
            'status_agunan_kendaraan',
            'tipe_agunan',
            'teknologi',
            'bahan_bakar',
        ];

        $score = 0;
        foreach ($points as $point) {
            if (preg_match('/\((\d+)\)/', $request->$point, $matches)) {
                $score += (int) $matches[1];
            }
        }

        MultigunaPengajuan::where('kode_pengajuan', $kode_pengajuan)
            ->update([
                'total_collateralbermotor' => $score,
            ]);

        return redirect()->route('multiguna.limac.collateralbermotor.data')
            ->with('success', '✅ Data berhasil diperbarui dan total score :' . $score . ' disimpan.');
    }

    // 5. Condition
    public function indexLimacCondition()
    {
        $user = Auth::user();

        if ($user->tipe_akun == 'siswa') {
            $multiguna_limac_condition = MultigunaLimacCondition::where('username', $user->username)
                ->where('kode_tempat', $user->kode_tempat)
                ->paginate(5);
        } elseif ($user->tipe_akun == 'pengajar') {
            $multiguna_limac_condition = MultigunaLimacCondition::where('kode_tempat', $user->kode_tempat)
                ->paginate(5);
        } elseif ($user->tipe_akun == 'admin') {
            $multiguna_limac_condition = MultigunaLimacCondition::paginate(5);
        } else {
            $multiguna_limac_condition = collect();
        }

        return view('multiguna.limac.condition.data', compact('multiguna_limac_condition'));
    }

    public function editCondition($kode_pengajuan)
    {
        $this->authorizePengajuan($kode_pengajuan);

        $pengajuan = MultigunaLimacCondition::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        return view('multiguna.limac.condition.ubah', compact('pengajuan'));
    }

    public function updateCondition(Request $request, $kode_pengajuan)
    {
        $this->authorizePengajuan($kode_pengajuan);

        MultigunaLimacCondition::where('kode_pengajuan', $kode_pengajuan)
            ->update([
                'ketahanan_usaha_berdiri' => $request->ketahanan_usaha_berdiri,
                'bidang_usaha_langka' => $request->bidang_usaha_langka,
                'cakupan_wilayah_skala_usaha' => $request->cakupan_wilayah_skala_usaha,
            ]);

        $points = [
            'ketahanan_usaha_berdiri',
            'bidang_usaha_langka',
            'cakupan_wilayah_skala_usaha',
        ];

        $score = 0;
        foreach ($points as $point) {
            if (preg_match('/\((\d+)\)/', $request->$point, $matches)) {
                $score += (int) $matches[1];
            }
        }

        MultigunaPengajuan::where('kode_pengajuan', $kode_pengajuan)
            ->update([
                'total_condition' => $score,
            ]);

        return redirect()->route('multiguna.limac.condition.data')
            ->with('success', '✅ Data berhasil diperbarui dan total score :' . $score . ' disimpan.');
    }
}
