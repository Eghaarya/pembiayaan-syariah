<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Nasabah\NasabahProfil;
use Illuminate\Database\QueryException;
use App\Models\Nasabah\NasabahPekerjaan;
use App\Models\Murabahah\Limac\MurabahahLimacCapital;
use App\Models\Murabahah\Limac\MurabahahLimacCapacity;
use App\Models\Murabahah\Pengajuan\MurabahahPengajuan;
use App\Models\Murabahah\Limac\MurabahahLimacCharacter;
use App\Models\Murabahah\Limac\MurabahahLimacCondition;
use App\Models\Murabahah\Limac\MurabahahLimacCollateralKpr;
use App\Models\Murabahah\Limac\MurabahahLimacCollateralBermotor;
use App\Models\Murabahah\Limac\MurabahahLimacCapitalTbAsetLainnya;
use App\Models\Murabahah\Limac\MurabahahLimacCapitalTbAsetKendaraan;
use App\Models\Murabahah\Limac\MurabahahLimacCapitalTbAsetAktivalancar;
use App\Models\Murabahah\Limac\MurabahahLimacCapitalTbAsetTanahbangunan;
use App\Models\Murabahah\Limac\MurabahahLimacCharacterTbCheckingNasabah;
use App\Models\Murabahah\Limac\MurabahahLimacCharacterTbCheckingPasangan;

class MurabahahLimacController extends Controller
{

    // otorisasi
    protected function authorizePengajuan($kode_pengajuan)
    {

        $user = Auth::user();

        // Ambil data pengajuan beserta relasi kode_nasabah
        $murabahah_pengajuan = MurabahahPengajuan::select('kode_nasabah', 'username', 'kode_tempat')
            ->where('kode_pengajuan', $kode_pengajuan)
            ->first();

        if (!$murabahah_pengajuan) {
            abort(404, 'Data pengajuan tidak ditemukan.');
        }

        $kode_nasabah = $murabahah_pengajuan->kode_nasabah;
        $nasabah_profil = NasabahProfil::select('username', 'kode_tempat')
            ->where('kode_nasabah', $kode_nasabah)
            ->first();

        if (!$nasabah_profil) {
            abort(404, 'Data nasabah tidak ditemukan.');
        }

        // Cek otorisasi
        if ($user->tipe_akun === 'pengajar') {
            if ($murabahah_pengajuan->kode_tempat !== $user->kode_tempat) {
                abort(403, 'Unauthorized');
            }
        } elseif ($user->tipe_akun === 'siswa') {
            if ($murabahah_pengajuan->username !== $user->username) {
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
            $murabahah_limac_character = MurabahahLimacCharacter::where('username', $user->username)
                ->where('kode_tempat', $user->kode_tempat)
                ->paginate(5);
        } elseif ($user->tipe_akun == 'pengajar') {
            $murabahah_limac_character = MurabahahLimacCharacter::where('kode_tempat', $user->kode_tempat)
                ->paginate(5);
        } elseif ($user->tipe_akun == 'admin') {
            $murabahah_limac_character = MurabahahLimacCharacter::paginate(5);
        } else {
            $murabahah_limac_character = collect();
        }

        // Ambil semua kode pengajuan dari hasil paginasi
        $kodePengajuanList = $murabahah_limac_character->pluck('kode_pengajuan')->all();

        // Ambil semua checking berdasarkan daftar kode_pengajuan
        $pengajuan_checking_nasabah = MurabahahLimacCharacterTbCheckingNasabah::whereIn('kode_pengajuan', $kodePengajuanList)
            ->get()
            ->groupBy('kode_pengajuan');

        $pengajuan_checking_pasangan = MurabahahLimacCharacterTbCheckingPasangan::whereIn('kode_pengajuan', $kodePengajuanList)
            ->get()
            ->groupBy('kode_pengajuan');

        return view('murabahah.limac.character.data', compact(
            'murabahah_limac_character',
            'pengajuan_checking_nasabah',
            'pengajuan_checking_pasangan'
        ));
    }

    public function editCharacter($kode_pengajuan)
    {
        $kode_nasabah = $this->authorizePengajuan($kode_pengajuan);

        // Ambil data untuk view
        $nasabah_profil = NasabahProfil::where('kode_nasabah', $kode_nasabah)->firstOrFail();
        $pengajuan = MurabahahLimacCharacter::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        $pengajuan_checking_nasabah = MurabahahLimacCharacterTbCheckingNasabah::where('kode_pengajuan', $kode_pengajuan)->get();
        $pengajuan_checking_pasangan = MurabahahLimacCharacterTbCheckingPasangan::where('kode_pengajuan', $kode_pengajuan)->get();

        return view('murabahah.limac.character.ubah', compact('nasabah_profil', 'pengajuan', 'pengajuan_checking_nasabah', 'pengajuan_checking_pasangan'));
    }

    public function updateCharacter(Request $request, $kode_pengajuan)
    {

        $this->authorizePengajuan($kode_pengajuan);

        $score = 0;
        $kolektabilitasScore = 0;
        $jumlahPinjaman = 0;

        $checkingConfigs = [
            'nasabah' => [
                'input' => 'id_checking_nasabah',
                'model' => MurabahahLimacCharacterTbCheckingNasabah::class,
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
                'model' => MurabahahLimacCharacterTbCheckingPasangan::class,
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

        MurabahahPengajuan::where('kode_pengajuan', $kode_pengajuan)
            ->update(['total_character' => $score]);

        return redirect()->route('murabahah.limac.character.data')
            ->with('success', '✅ Data berhasil diperbarui dan total score :' . $score . ' disimpan.');
    }

    // 2. Capacity
    public function indexLimacCapacity()
    {
        $user = Auth::user();

        if ($user->tipe_akun == 'siswa') {
            $murabahah_limac_capacity = MurabahahLimacCapacity::where('username', $user->username)
                ->where('kode_tempat', $user->kode_tempat)
                ->paginate(5);
        } elseif ($user->tipe_akun == 'pengajar') {
            $murabahah_limac_capacity = MurabahahLimacCapacity::where('kode_tempat', $user->kode_tempat)
                ->paginate(5);
        } elseif ($user->tipe_akun == 'admin') {
            $murabahah_limac_capacity = MurabahahLimacCapacity::paginate(5);
        } else {
            $murabahah_limac_capacity = collect();
        }

        return view('murabahah.limac.capacity.data', compact('murabahah_limac_capacity'));
    }

    public function editCapacity($kode_pengajuan)
    {

        $kode_nasabah = $this->authorizePengajuan($kode_pengajuan);

        // Ambil data untuk view
        $nasabah_pekerjaan = NasabahPekerjaan::where('kode_nasabah', $kode_nasabah)->firstOrFail();
        $pengajuan_pembiayaan = MurabahahPengajuan::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        $pengajuan = MurabahahLimacCapacity::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        $pengajuan_checking_nasabah = MurabahahLimacCharacterTbCheckingNasabah::where('kode_pengajuan', $kode_pengajuan)->get();
        $pengajuan_checking_pasangan = MurabahahLimacCharacterTbCheckingPasangan::where('kode_pengajuan', $kode_pengajuan)->get();

        return view('murabahah.limac.capacity.ubah', compact('nasabah_pekerjaan', 'pengajuan_pembiayaan', 'pengajuan', 'pengajuan_checking_nasabah', 'pengajuan_checking_pasangan'));
    }


    public function updateCapacity(Request $request, $kode_pengajuan)
    {

        $this->authorizePengajuan($kode_pengajuan);

        $dataUpdate = [
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
            'penghasilan_nasabah' => $request->penghasilan_nasabah,
            'keterangan_penghasilan_nasabah' => $request->keterangan_penghasilan_nasabah,
            'penghasilan_pasangan' => $request->penghasilan_pasangan,
            'keterangan_penghasilan_pasangan' => $request->keterangan_penghasilan_pasangan,
            'sumber_penghasilan_lain' => $request->sumber_penghasilan_lain,
            'keterangan_sumber_penghasilan_lain' => $request->keterangan_sumber_penghasilan_lain,
            'biaya_sewa_rumah' => $request->biaya_sewa_rumah,
            'keterangan_biaya_sewa_rumah' => $request->keterangan_biaya_sewa_rumah,
            'biaya_makan' => $request->biaya_makan,
            'keterangan_biaya_makan' => $request->keterangan_biaya_makan,
            'biaya_transportasi' => $request->biaya_transportasi,
            'keterangan_biaya_transportasi' => $request->keterangan_biaya_transportasi,
            'biaya_pendidikan' => $request->biaya_pendidikan,
            'keterangan_biaya_pendidikan' => $request->keterangan_biaya_pendidikan,
            'biaya_listrik_air_gas' => $request->biaya_listrik_air_gas,
            'keterangan_biaya_listrik_air_gas' => $request->keterangan_biaya_listrik_air_gas,
            'angsuran_pinjaman' => $request->angsuran_pinjaman,
            'keterangan_angsuran_pinjaman' => $request->keterangan_angsuran_pinjaman,
            'premi_asuransi' => $request->premi_asuransi,
            'keterangan_premi_asuransi' => $request->keterangan_premi_asuransi,
            'tabungan_berjangka' => $request->tabungan_berjangka,
            'keterangan_tabungan_berjangka' => $request->keterangan_tabungan_berjangka,
            'pengeluaran_lain' => $request->pengeluaran_lain,
            'keterangan_pengeluaran_lain' => $request->keterangan_pengeluaran_lain,

            'tempatkerja_kelokasi_bank' => $request->tempatkerja_kelokasi_bank,
            'tempatkerja_kelokasi_agunan' => $request->tempatkerja_kelokasi_agunan,
            'pembayaran_kolektif' => $request->pembayaran_kolektif,
            'pembayaran_nonkolektif' => $request->pembayaran_nonkolektif,

            'analis_harga_beli_bank' => $request->analis_harga_beli_bank,
            'analis_margin_bank' => $request->analis_margin_bank,
            'analis_harga_jual_bank' => $request->analis_harga_jual_bank,
            'analis_jangka_waktu_pembiayaan' => $request->analis_jangka_waktu_pembiayaan,
        ]);

        MurabahahLimacCapacity::where('kode_pengajuan', $kode_pengajuan)->update($dataUpdate);

        MurabahahPengajuan::where('kode_pengajuan', $kode_pengajuan)
            ->update([
                'keputusan_harga_beli_bank' => $request->analis_harga_beli_bank,
                'keputusan_margin_bank'     => $request->save_analis_margin_bank_from_db,
                'keputusan_harga_jual_barang' => $request->analis_harga_jual_bank,
                'keputusan_jangka_waktu_pembiayaan' => $request->analis_jangka_waktu_pembiayaan,
            ]);

        $score = 0;
        $scoreCapacity = [
            'tempatkerja_kelokasi_bank',
            'tempatkerja_kelokasi_agunan',
            'pembayaran_kolektif',
            'pembayaran_nonkolektif',
        ];
        foreach ($scoreCapacity as $field) {
            $score += (int) $request->$field;
        }

        $pekerjaan = NasabahPekerjaan::where('kode_nasabah', $request->kode_nasabah)->first();
        $scorePekerjaan = [
            'skala_perusahaan_nasabah',
            'jenis_pekerjaan_nasabah',
            'jabatan_pekerjaan_nasabah',
            'pengalaman_perusahaan_nasabah',
            'pendidikan_terakhir_nasabah',
            'usia_nasabah',
            'sumber_penghasilan_nasabah',
            'tanggungan_nasabah',
        ];

        foreach ($scorePekerjaan as $field) {
            if (preg_match('/\((\d+)\)/', $pekerjaan->$field ?? '', $matches)) {
                $score += (int) $matches[1];
            }
        }

        MurabahahPengajuan::where('kode_pengajuan', $kode_pengajuan)
            ->update(['total_capacity' => $score]);


        return redirect()->route('murabahah.limac.capacity.data')
            ->with('success', '✅ Data berhasil diperbarui dan total score :' . $score . ' disimpan.');
    }

    // 3. Capital
    public function indexLimacCapital()
    {
        $user = Auth::user();

        if ($user->tipe_akun == 'siswa') {
            $murabahah_limac_capital = MurabahahLimacCapital::where('username', $user->username)
                ->where('kode_tempat', $user->kode_tempat)
                ->paginate(5);
        } elseif ($user->tipe_akun == 'pengajar') {
            $murabahah_limac_capital = MurabahahLimacCapital::where('kode_tempat', $user->kode_tempat)
                ->paginate(5);
        } elseif ($user->tipe_akun == 'admin') {
            $murabahah_limac_capital = MurabahahLimacCapital::paginate(5);
        } else {
            $murabahah_limac_capital = collect();
        }

        // Ambil semua kode pengajuan dari hasil paginasi
        $kodePengajuanList = $murabahah_limac_capital->pluck('kode_pengajuan')->all();

        // Ambil semua checking berdasarkan daftar kode_pengajuan
        $pengajuan_aset_aktivalancar = MurabahahLimacCapitalTbAsetAktivalancar::whereIn('kode_pengajuan', $kodePengajuanList)
            ->get()
            ->groupBy('kode_pengajuan');
        $pengajuan_aset_tanahbangunan = MurabahahLimacCapitalTbAsetTanahbangunan::whereIn('kode_pengajuan', $kodePengajuanList)
            ->get()
            ->groupBy('kode_pengajuan');
        $pengajuan_aset_kendaraan = MurabahahLimacCapitalTbAsetKendaraan::whereIn('kode_pengajuan', $kodePengajuanList)
            ->get()
            ->groupBy('kode_pengajuan');
        $pengajuan_aset_lainnya = MurabahahLimacCapitalTbAsetLainnya::whereIn('kode_pengajuan', $kodePengajuanList)
            ->get()
            ->groupBy('kode_pengajuan');

        return view('murabahah.limac.capital.data', compact(
            'murabahah_limac_capital',
            'pengajuan_aset_aktivalancar',
            'pengajuan_aset_tanahbangunan',
            'pengajuan_aset_kendaraan',
            'pengajuan_aset_lainnya'
        ));
    }

    public function editCapital($kode_pengajuan)
    {

        $this->authorizePengajuan($kode_pengajuan);

        $pengajuan_pembiayaan = MurabahahPengajuan::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        $pengajuan = MurabahahLimacCapital::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        $pengajuan_aset_aktivalancar = MurabahahLimacCapitalTbAsetAktivalancar::where('kode_pengajuan', $kode_pengajuan)->get();
        $pengajuan_aset_tanahbangunan = MurabahahLimacCapitalTbAsetTanahbangunan::where('kode_pengajuan', $kode_pengajuan)->get();
        $pengajuan_aset_kendaraan = MurabahahLimacCapitalTbAsetKendaraan::where('kode_pengajuan', $kode_pengajuan)->get();
        $pengajuan_aset_lainnya = MurabahahLimacCapitalTbAsetLainnya::where('kode_pengajuan', $kode_pengajuan)->get();

        return view('murabahah.limac.capital.ubah', compact('pengajuan_pembiayaan', 'pengajuan', 'pengajuan_aset_aktivalancar', 'pengajuan_aset_tanahbangunan', 'pengajuan_aset_kendaraan', 'pengajuan_aset_lainnya'));
    }

    public function updateCapital(Request $request, $kode_pengajuan)
    {

        $this->authorizePengajuan($kode_pengajuan);

        $asetConfigs = [
            'aktivalancar' => [
                'input' => 'id_aset_aktivalancar',
                'model' => MurabahahLimacCapitalTbAsetAktivalancar::class,
                'map' => [
                    'aktiva_lancar_keterangan' => 'keterangan',
                    'aktiva_lancar_nilai' => 'nilai',
                ],
            ],
            'tanahbangunan' => [
                'input' => 'id_aset_tanahbangunan',
                'model' => MurabahahLimacCapitalTbAsetTanahbangunan::class,
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
                'model' => MurabahahLimacCapitalTbAsetKendaraan::class,
                'map' => [
                    'kendaraan_jenis_merek' => 'jenis_merek',
                    'kendaraan_tahun_pembuatan' => 'tahun_pembuatan',
                    'kendaraan_atas_nama' => 'atas_nama',
                    'kendaraan_nilai' => 'nilai',
                ],
            ],
            'lainnya' => [
                'input' => 'id_aset_lainnya',
                'model' => MurabahahLimacCapitalTbAsetLainnya::class,
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

        $dataUpdate = [];
        $dataUpdate['besarnya_urbun'] = $request->besarnya_urbun;

        MurabahahLimacCapital::where('kode_pengajuan', $kode_pengajuan)
            ->update($dataUpdate);

        $score = 0;
        $score += (int) (preg_match('/\((\d+)\)/', $request->besarnya_urbun, $m) ? $m[1] : 0);

        MurabahahPengajuan::where('kode_pengajuan', $kode_pengajuan)
            ->update([
                'total_capital' => $score,
            ]);

        return redirect()->route('murabahah.limac.capital.data')
            ->with('success', '✅ Data berhasil diperbarui dan total score :' . $score . ' disimpan.');
    }

    // 4.1 Collateral Kpr
    public function indexLimacCollateralKpr()
    {
        $user = Auth::user();

        if ($user->tipe_akun == 'siswa') {
            $murabahah_limac_collateralkpr = MurabahahLimacCollateralKpr::where('username', $user->username)
                ->where('kode_tempat', $user->kode_tempat)
                ->paginate(5);
        } elseif ($user->tipe_akun == 'pengajar') {
            $murabahah_limac_collateralkpr = MurabahahLimacCollateralKpr::where('kode_tempat', $user->kode_tempat)
                ->paginate(5);
        } elseif ($user->tipe_akun == 'admin') {
            $murabahah_limac_collateralkpr = MurabahahLimacCollateralKpr::paginate(5);
        } else {
            $murabahah_limac_collateralkpr = collect();
        }

        return view('murabahah.limac.collateralkpr.data', compact('murabahah_limac_collateralkpr'));
    }

    public function editCollateralkpr($kode_pengajuan)
    {

        $this->authorizePengajuan($kode_pengajuan);

        $pengajuan = MurabahahLimacCollateralkpr::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        return view('murabahah.limac.collateralkpr.ubah', compact('pengajuan'));
    }

    public function updateCollateralkpr(Request $request, $kode_pengajuan)
    {

        $this->authorizePengajuan($kode_pengajuan);

        MurabahahLimacCollateralkpr::where('kode_pengajuan', $kode_pengajuan)
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

        MurabahahPengajuan::where('kode_pengajuan', $kode_pengajuan)
            ->update([
                'total_collateralkpr' => $score,
            ]);

        return redirect()->route('murabahah.limac.collateralkpr.data')
            ->with('success', '✅ Data berhasil diperbarui dan total score :' . $score . ' disimpan.');
    }

    // 4.2 Collateral Bermotor
    public function indexLimacCollateralBermotor()
    {
        $user = Auth::user();

        if ($user->tipe_akun == 'siswa') {
            $murabahah_limac_collateralbermotor = MurabahahLimacCollateralBermotor::where('username', $user->username)
                ->where('kode_tempat', $user->kode_tempat)
                ->paginate(5);
        } elseif ($user->tipe_akun == 'pengajar') {
            $murabahah_limac_collateralbermotor = MurabahahLimacCollateralBermotor::where('kode_tempat', $user->kode_tempat)
                ->paginate(5);
        } elseif ($user->tipe_akun == 'admin') {
            $murabahah_limac_collateralbermotor = MurabahahLimacCollateralBermotor::paginate(5);
        } else {
            $murabahah_limac_collateralbermotor = collect();
        }

        return view('murabahah.limac.collateralbermotor.data', compact('murabahah_limac_collateralbermotor'));
    }

    public function editCollateralbermotor($kode_pengajuan)
    {

        $this->authorizePengajuan($kode_pengajuan);

        $pengajuan = MurabahahLimacCollateralbermotor::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        return view('murabahah.limac.collateralbermotor.ubah', compact('pengajuan'));
    }

    public function updateCollateralbermotor(Request $request, $kode_pengajuan)
    {

        $this->authorizePengajuan($kode_pengajuan);

        MurabahahLimacCollateralbermotor::where('kode_pengajuan', $kode_pengajuan)
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

        MurabahahPengajuan::where('kode_pengajuan', $kode_pengajuan)
            ->update([
                'total_collateralbermotor' => $score,
            ]);

        return redirect()->route('murabahah.limac.collateralbermotor.data')
            ->with('success', '✅ Data berhasil diperbarui dan total score :' . $score . ' disimpan.');
    }

    // 5. Condition
    public function indexLimacCondition()
    {
        $user = Auth::user();

        if ($user->tipe_akun == 'siswa') {
            $murabahah_limac_condition = MurabahahLimacCondition::where('username', $user->username)
                ->where('kode_tempat', $user->kode_tempat)
                ->paginate(5);
        } elseif ($user->tipe_akun == 'pengajar') {
            $murabahah_limac_condition = MurabahahLimacCondition::where('kode_tempat', $user->kode_tempat)
                ->paginate(5);
        } elseif ($user->tipe_akun == 'admin') {
            $murabahah_limac_condition = MurabahahLimacCondition::paginate(5);
        } else {
            $murabahah_limac_condition = collect();
        }

        return view('murabahah.limac.condition.data', compact('murabahah_limac_condition'));
    }

    public function editCondition($kode_pengajuan)
    {

        $this->authorizePengajuan($kode_pengajuan);

        $pengajuan = MurabahahLimacCondition::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        return view('murabahah.limac.condition.ubah', compact('pengajuan'));
    }

    public function updateCondition(Request $request, $kode_pengajuan)
    {

        $this->authorizePengajuan($kode_pengajuan);

        MurabahahLimacCondition::where('kode_pengajuan', $kode_pengajuan)
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

        MurabahahPengajuan::where('kode_pengajuan', $kode_pengajuan)
            ->update([
                'total_condition' => $score,
            ]);

        return redirect()->route('murabahah.limac.condition.data')
            ->with('success', '✅ Data berhasil diperbarui dan total score :' . $score . ' disimpan.');
    }
}
