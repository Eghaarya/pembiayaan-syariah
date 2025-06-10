<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use App\Models\Murabahah\Limac\MurabahahLimacCondition;
use App\Models\Murabahah\Limac\MurabahahLimacCapital;
use App\Models\Murabahah\Limac\MurabahahLimacCapacity;
use App\Models\Murabahah\Limac\MurabahahLimacCharacter;
use App\Models\Murabahah\Limac\MurabahahLimacCollateralKpr;
use App\Models\Murabahah\Limac\MurabahahLimacCollateralBermotor;
use App\Models\Murabahah\Pengajuan\MurabahahPengajuan;
use App\Models\Nasabah\NasabahPekerjaan;

class MurabahahLimacController extends Controller
{

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

        return view('murabahah.limac.character.data', compact('murabahah_limac_character'));
    }

    public function editCharacter($kode_pengajuan)
    {
        // autentikasi
        $user = Auth::user();

        $murabahah_pengajuan = MurabahahPengajuan::select('username', 'kode_tempat')
            ->where('kode_pengajuan', $kode_pengajuan)
            ->first();

        if (!$murabahah_pengajuan) {
            abort(404, 'Data pengajuan tidak ditemukan.');
        }

        if ($user->tipe_akun === 'pengajar') {
            if ($murabahah_pengajuan->kode_tempat !== $user->kode_tempat) {
                abort(404);
            }
        } elseif ($user->tipe_akun === 'siswa') {
            if ($murabahah_pengajuan->username !== $user->username) {
                abort(404);
            }
        }

        $pengajuan = MurabahahLimacCharacter::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        return view('murabahah.limac.character.ubah', compact('pengajuan'));
    }

    public function updateCharacter(Request $request, $kode_pengajuan)
    {
        // autentikasi
        $user = Auth::user();

        $murabahah_pengajuan = MurabahahPengajuan::select('username', 'kode_tempat')
            ->where('kode_pengajuan', $kode_pengajuan)
            ->first();

        if (!$murabahah_pengajuan) {
            abort(404, 'Data pengajuan tidak ditemukan.');
        }

        if ($user->tipe_akun === 'pengajar') {
            if ($murabahah_pengajuan->kode_tempat !== $user->kode_tempat) {
                abort(404);
            }
        } elseif ($user->tipe_akun === 'siswa') {
            if ($murabahah_pengajuan->username !== $user->username) {
                abort(404);
            }
        }

        $pengajuan = MurabahahLimacCharacter::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();

        $kolektabilitasScore = 0;
        $jumlahPinjaman = 0;

        for ($i = 1; $i <= 6; $i++) {
            $nasabah = $request->input("id_checking_nasabah.$i");
            if ($nasabah) {
                $data["noid_checking{$i}_nasabah"] = $nasabah['noid_checking'] ?? null;
                $data["fasilitas_pinjaman{$i}_nasabah"] = $nasabah['fasilitas_pinjaman'] ?? null;
                $data["bank_pelapor{$i}_nasabah"] = $nasabah['bank_pelapor'] ?? null;
                $data["plafond_pinjaman{$i}_nasabah"] = $nasabah['plafond_pinjaman'] ?? null;
                $data["outstanding_pinjaman{$i}_nasabah"] = $nasabah['outstanding_pinjaman'] ?? null;
                $data["tanggal_realisasi{$i}_nasabah"] = $nasabah['tanggal_realisasi'] ?? null;
                $data["tanggal_jatuh_tempo{$i}_nasabah"] = $nasabah['tanggal_jatuh_tempo'] ?? null;
                $data["kolektabilitas{$i}_nasabah"] = $nasabah['kolektabilitas'] ?? null;
                $data["keterangan{$i}_nasabah"] = $nasabah['keterangan'] ?? null;

                if (!empty($nasabah['kolektabilitas'])) {
                    $kolektabilitasScore += (int) (preg_match('/\((\d+)\)/', $nasabah['kolektabilitas'], $m) ? $m[1] : 0);
                }
                if (!empty($nasabah['noid_checking'])) {
                    $jumlahPinjaman++;
                }
            }

            $pasangan = $request->input("id_checking_pasangan.$i");
            if ($pasangan) {
                $data["noid_checking{$i}_pasangan"] = $pasangan['noid_checking'] ?? null;
                $data["fasilitas_pinjaman{$i}_pasangan"] = $pasangan['fasilitas_pinjaman'] ?? null;
                $data["bank_pelapor{$i}_pasangan"] = $pasangan['bank_pelapor'] ?? null;
                $data["plafond_pinjaman{$i}_pasangan"] = $pasangan['plafond_pinjaman'] ?? null;
                $data["outstanding_pinjaman{$i}_pasangan"] = $pasangan['outstanding_pinjaman'] ?? null;
                $data["tanggal_realisasi{$i}_pasangan"] = $pasangan['tanggal_realisasi'] ?? null;
                $data["tanggal_jatuh_tempo{$i}_pasangan"] = $pasangan['tanggal_jatuh_tempo'] ?? null;
                $data["kolektabilitas{$i}_pasangan"] = $pasangan['kolektabilitas'] ?? null;
                $data["keterangan{$i}_pasangan"] = $pasangan['keterangan'] ?? null;

                if (!empty($pasangan['kolektabilitas'])) {
                    $kolektabilitasScore += (int) (preg_match('/\((\d+)\)/', $pasangan['kolektabilitas'], $m) ? $m[1] : 0);
                }

                if (!empty($pasangan['noid_checking'])) {
                    $jumlahPinjaman++;
                }
            }
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

        $score = $kolektabilitasScore + $pinjamanScore;

        $pengajuan->update($data);

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
        // autentikasi
        $user = Auth::user();

        $murabahah_pengajuan = MurabahahPengajuan::select('username', 'kode_tempat')
            ->where('kode_pengajuan', $kode_pengajuan)
            ->first();

        if (!$murabahah_pengajuan) {
            abort(404, 'Data pengajuan tidak ditemukan.');
        }

        if ($user->tipe_akun === 'pengajar') {
            if ($murabahah_pengajuan->kode_tempat !== $user->kode_tempat) {
                abort(404);
            }
        } elseif ($user->tipe_akun === 'siswa') {
            if ($murabahah_pengajuan->username !== $user->username) {
                abort(404);
            }
        }

        $pengajuan = MurabahahLimacCapacity::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        return view('murabahah.limac.capacity.ubah', compact('pengajuan'));
    }

    public function updateCapacity(Request $request, $kode_pengajuan)
    {
        // autentikasi
        $user = Auth::user();

        $murabahah_pengajuan = MurabahahPengajuan::select('username', 'kode_tempat')
            ->where('kode_pengajuan', $kode_pengajuan)
            ->first();

        if (!$murabahah_pengajuan) {
            abort(404, 'Data pengajuan tidak ditemukan.');
        }

        if ($user->tipe_akun === 'pengajar') {
            if ($murabahah_pengajuan->kode_tempat !== $user->kode_tempat) {
                abort(404);
            }
        } elseif ($user->tipe_akun === 'siswa') {
            if ($murabahah_pengajuan->username !== $user->username) {
                abort(404);
            }
        }

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

            // Kondisi keuangan
            $dataUpdate["jenis_pinjaman_nasabah_{$i}"] = $request->input("jenis_pinjaman_nasabah_{$i}");
            $dataUpdate["limit_nasabah_{$i}"] = $request->input("limit_nasabah_{$i}");
            $dataUpdate["jangka_waktu_nasabah_{$i}"] = $request->input("jangka_waktu_nasabah_{$i}");
            $dataUpdate["sisa_hutang_nasabah_{$i}"] = $request->input("sisa_hutang_nasabah_{$i}");
            $dataUpdate["kreditur_nasabah_{$i}"] = $request->input("kreditur_nasabah_{$i}");
            $dataUpdate["agunan_nasabah_{$i}"] = $request->input("agunan_nasabah_{$i}");

            $dataUpdate["jenis_pinjaman_pasangan_{$i}"] = $request->input("jenis_pinjaman_pasangan_{$i}");
            $dataUpdate["limit_pasangan_{$i}"] = $request->input("limit_pasangan_{$i}");
            $dataUpdate["jangka_waktu_pasangan_{$i}"] = $request->input("jangka_waktu_pasangan_{$i}");
            $dataUpdate["sisa_hutang_pasangan_{$i}"] = $request->input("sisa_hutang_pasangan_{$i}");
            $dataUpdate["kreditur_pasangan_{$i}"] = $request->input("kreditur_pasangan_{$i}");
            $dataUpdate["agunan_pasangan_{$i}"] = $request->input("agunan_pasangan_{$i}");
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

            'jangka_waktu_pembiayaan' => $request->jangka_waktu_pembiayaan,

            'tempatkerja_kelokasi_bank' => $request->tempatkerja_kelokasi_bank,
            'tempatkerja_kelokasi_agunan' => $request->tempatkerja_kelokasi_agunan,
            'pembayaran_kolektif' => $request->pembayaran_kolektif,
            'pembayaran_nonkolektif' => $request->pembayaran_nonkolektif,
        ]);

        MurabahahLimacCapacity::where('kode_pengajuan', $kode_pengajuan)->update($dataUpdate);

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

        return view('murabahah.limac.capital.data', compact('murabahah_limac_capital'));
    }

    public function editCapital($kode_pengajuan)
    {
        // autentikasi
        $user = Auth::user();

        $murabahah_pengajuan = MurabahahPengajuan::select('username', 'kode_tempat')
            ->where('kode_pengajuan', $kode_pengajuan)
            ->first();

        if (!$murabahah_pengajuan) {
            abort(404, 'Data pengajuan tidak ditemukan.');
        }

        if ($user->tipe_akun === 'pengajar') {
            if ($murabahah_pengajuan->kode_tempat !== $user->kode_tempat) {
                abort(404);
            }
        } elseif ($user->tipe_akun === 'siswa') {
            if ($murabahah_pengajuan->username !== $user->username) {
                abort(404);
            }
        }

        $pengajuan = MurabahahLimacCapital::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        return view('murabahah.limac.capital.ubah', compact('pengajuan'));
    }

    public function updateCapital(Request $request, $kode_pengajuan)
    {
        // autentikasi
        $user = Auth::user();

        $murabahah_pengajuan = MurabahahPengajuan::select('username', 'kode_tempat')
            ->where('kode_pengajuan', $kode_pengajuan)
            ->first();

        if (!$murabahah_pengajuan) {
            abort(404, 'Data pengajuan tidak ditemukan.');
        }

        if ($user->tipe_akun === 'pengajar') {
            if ($murabahah_pengajuan->kode_tempat !== $user->kode_tempat) {
                abort(404);
            }
        } elseif ($user->tipe_akun === 'siswa') {
            if ($murabahah_pengajuan->username !== $user->username) {
                abort(404);
            }
        }

        // Update data di MurabahahLimacCapital
        $dataUpdate = [];

        for ($i = 1; $i <= 3; $i++) {
            $dataUpdate['aktiva_lancar_keterangan_' . $i] = $request->input('aktiva_lancar_keterangan_' . $i);
            $dataUpdate['aktiva_lancar_nilai_' . $i] = $request->input('aktiva_lancar_nilai_' . $i);
        }

        for ($i = 1; $i <= 3; $i++) {
            $dataUpdate['tanah_lokasi_' . $i] = $request->input('tanah_lokasi_' . $i);
            $dataUpdate['tanah_luas_tanah_bangunan_' . $i] = $request->input('tanah_luas_tanah_bangunan_' . $i);
            $dataUpdate['tanah_status_' . $i] = $request->input('tanah_status_' . $i);
            $dataUpdate['tanah_atas_nama_' . $i] = $request->input('tanah_atas_nama_' . $i);
            $dataUpdate['tanah_nilai_' . $i] = $request->input('tanah_nilai_' . $i);
        }

        for ($i = 1; $i <= 3; $i++) {
            $dataUpdate['kendaraan_jenis_merek_' . $i] = $request->input('kendaraan_jenis_merek_' . $i);
            $dataUpdate['kendaraan_tahun_pembuatan_' . $i] = $request->input('kendaraan_tahun_pembuatan_' . $i);
            $dataUpdate['kendaraan_atas_nama_' . $i] = $request->input('kendaraan_atas_nama_' . $i);
            $dataUpdate['kendaraan_nilai_' . $i] = $request->input('kendaraan_nilai_' . $i);
        }

        for ($i = 1; $i <= 3; $i++) {
            $dataUpdate['lain_jenis_' . $i] = $request->input('lain_jenis_' . $i);
            $dataUpdate['lain_lokasi_' . $i] = $request->input('lain_lokasi_' . $i);
            $dataUpdate['lain_atas_nama_' . $i] = $request->input('lain_atas_nama_' . $i);
            $dataUpdate['lain_nilai_' . $i] = $request->input('lain_nilai_' . $i);
        }

        $dataUpdate['jenis_akad'] = $request->jenis_akad;
        $dataUpdate['jenis_pembiayaan'] = $request->jenis_pembiayaan;
        $dataUpdate['tujuan_penggunaan'] = $request->tujuan_penggunaan;
        $dataUpdate['harga_jual_barang'] = $request->harga_jual_barang;
        $dataUpdate['urbun_uangmuka'] = $request->urbun_uangmuka;
        $dataUpdate['harga_beli_bank'] = $request->harga_beli_bank;
        $dataUpdate['jangka_waktu_pembiayaan'] = $request->jangka_waktu_pembiayaan;
        $dataUpdate['margin_bank'] = $request->margin_bank;
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
        // autentikasi
        $user = Auth::user();

        $murabahah_pengajuan = MurabahahPengajuan::select('username', 'kode_tempat')
            ->where('kode_pengajuan', $kode_pengajuan)
            ->first();

        if (!$murabahah_pengajuan) {
            abort(404, 'Data pengajuan tidak ditemukan.');
        }

        if ($user->tipe_akun === 'pengajar') {
            if ($murabahah_pengajuan->kode_tempat !== $user->kode_tempat) {
                abort(404);
            }
        } elseif ($user->tipe_akun === 'siswa') {
            if ($murabahah_pengajuan->username !== $user->username) {
                abort(404);
            }
        }

        $pengajuan = MurabahahLimacCollateralkpr::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        return view('murabahah.limac.collateralkpr.ubah', compact('pengajuan'));
    }

    public function updateCollateralkpr(Request $request, $kode_pengajuan)
    {
        // autentikasi
        $user = Auth::user();

        $murabahah_pengajuan = MurabahahPengajuan::select('username', 'kode_tempat')
            ->where('kode_pengajuan', $kode_pengajuan)
            ->first();

        if (!$murabahah_pengajuan) {
            abort(404, 'Data pengajuan tidak ditemukan.');
        }

        if ($user->tipe_akun === 'pengajar') {
            if ($murabahah_pengajuan->kode_tempat !== $user->kode_tempat) {
                abort(404);
            }
        } elseif ($user->tipe_akun === 'siswa') {
            if ($murabahah_pengajuan->username !== $user->username) {
                abort(404);
            }
        }

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
        // autentikasi
        $user = Auth::user();

        $murabahah_pengajuan = MurabahahPengajuan::select('username', 'kode_tempat')
            ->where('kode_pengajuan', $kode_pengajuan)
            ->first();

        if (!$murabahah_pengajuan) {
            abort(404, 'Data pengajuan tidak ditemukan.');
        }

        if ($user->tipe_akun === 'pengajar') {
            if ($murabahah_pengajuan->kode_tempat !== $user->kode_tempat) {
                abort(404);
            }
        } elseif ($user->tipe_akun === 'siswa') {
            if ($murabahah_pengajuan->username !== $user->username) {
                abort(404);
            }
        }

        $pengajuan = MurabahahLimacCollateralbermotor::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        return view('murabahah.limac.collateralbermotor.ubah', compact('pengajuan'));
    }

    public function updateCollateralbermotor(Request $request, $kode_pengajuan)
    {
        // autentikasi
        $user = Auth::user();

        $murabahah_pengajuan = MurabahahPengajuan::select('username', 'kode_tempat')
            ->where('kode_pengajuan', $kode_pengajuan)
            ->first();

        if (!$murabahah_pengajuan) {
            abort(404, 'Data pengajuan tidak ditemukan.');
        }

        if ($user->tipe_akun === 'pengajar') {
            if ($murabahah_pengajuan->kode_tempat !== $user->kode_tempat) {
                abort(404);
            }
        } elseif ($user->tipe_akun === 'siswa') {
            if ($murabahah_pengajuan->username !== $user->username) {
                abort(404);
            }
        }

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
        // autentikasi
        $user = Auth::user();

        $murabahah_pengajuan = MurabahahPengajuan::select('username', 'kode_tempat')
            ->where('kode_pengajuan', $kode_pengajuan)
            ->first();

        if (!$murabahah_pengajuan) {
            abort(404, 'Data pengajuan tidak ditemukan.');
        }

        if ($user->tipe_akun === 'pengajar') {
            if ($murabahah_pengajuan->kode_tempat !== $user->kode_tempat) {
                abort(404);
            }
        } elseif ($user->tipe_akun === 'siswa') {
            if ($murabahah_pengajuan->username !== $user->username) {
                abort(404);
            }
        }

        $pengajuan = MurabahahLimacCondition::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        return view('murabahah.limac.condition.ubah', compact('pengajuan'));
    }

    public function updateCondition(Request $request, $kode_pengajuan)
    {
        // autentikasi
        $user = Auth::user();

        $murabahah_pengajuan = MurabahahPengajuan::select('username', 'kode_tempat')
            ->where('kode_pengajuan', $kode_pengajuan)
            ->first();

        if (!$murabahah_pengajuan) {
            abort(404, 'Data pengajuan tidak ditemukan.');
        }

        if ($user->tipe_akun === 'pengajar') {
            if ($murabahah_pengajuan->kode_tempat !== $user->kode_tempat) {
                abort(404);
            }
        } elseif ($user->tipe_akun === 'siswa') {
            if ($murabahah_pengajuan->username !== $user->username) {
                abort(404);
            }
        }

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
