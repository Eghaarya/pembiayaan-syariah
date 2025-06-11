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
use App\Models\Multiguna\Limac\MultigunaLimacCollateralProperti;
use App\Models\Multiguna\Limac\MultigunaLimacCollateralBermotor;

class MultigunaLimacController extends Controller
{

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

        return view('multiguna.limac.character.data', compact('multiguna_limac_character'));
    }

    public function editCharacter($kode_pengajuan)
    {
        // autentikasi
        $user = Auth::user();

        $multiguna_pengajuan = MultigunaPengajuan::select('username', 'kode_tempat')
            ->where('kode_pengajuan', $kode_pengajuan)
            ->first();

        if (!$multiguna_pengajuan) {
            abort(404, 'Data pengajuan tidak ditemukan.');
        }

        if ($user->tipe_akun === 'pengajar') {
            if ($multiguna_pengajuan->kode_tempat !== $user->kode_tempat) {
                abort(403, 'Unauthorized');
            }
        } elseif ($user->tipe_akun === 'siswa') {
            if ($multiguna_pengajuan->username !== $user->username) {
                abort(403, 'Unauthorized');
            }
        }

        $pengajuan = MultigunaLimacCharacter::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        return view('multiguna.limac.character.ubah', compact('pengajuan'));
    }

    public function updateCharacter(Request $request, $kode_pengajuan)
    {
        // autentikasi
        $user = Auth::user();

        $multiguna_pengajuan = MultigunaPengajuan::select('username', 'kode_tempat')
            ->where('kode_pengajuan', $kode_pengajuan)
            ->first();

        if (!$multiguna_pengajuan) {
            abort(404, 'Data pengajuan tidak ditemukan.');
        }

        if ($user->tipe_akun === 'pengajar') {
            if ($multiguna_pengajuan->kode_tempat !== $user->kode_tempat) {
                abort(403, 'Unauthorized');
            }
        } elseif ($user->tipe_akun === 'siswa') {
            if ($multiguna_pengajuan->username !== $user->username) {
                abort(403, 'Unauthorized');
            }
        }

        $pengajuan = MultigunaLimacCharacter::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();

        $score = 0;
        $kolektabilitasScore = 0;
        $jumlahPinjaman = 0;

        // Daftar field yang ingin diambil dari form nasabah
        $fields = [
            'punya_rekening_nasabah',
            'tahun_menjadi_nasabah',
            'jenis_layanan_nasabah',
            'mutasi_rekening_nasabah',
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

        $score += $kolektabilitasScore + $pinjamanScore;

        $pengajuan->update($data);

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
        // autentikasi
        $user = Auth::user();

        $multiguna_pengajuan = MultigunaPengajuan::select('username', 'kode_tempat')
            ->where('kode_pengajuan', $kode_pengajuan)
            ->first();

        if (!$multiguna_pengajuan) {
            abort(404, 'Data pengajuan tidak ditemukan.');
        }

        if ($user->tipe_akun === 'pengajar') {
            if ($multiguna_pengajuan->kode_tempat !== $user->kode_tempat) {
                abort(403, 'Unauthorized');
            }
        } elseif ($user->tipe_akun === 'siswa') {
            if ($multiguna_pengajuan->username !== $user->username) {
                abort(403, 'Unauthorized');
            }
        }

        $pengajuan = MultigunaLimacCapacity::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        return view('multiguna.limac.capacity.ubah', compact('pengajuan'));
    }

    public function updateCapacity(Request $request, $kode_pengajuan)
    {
        // autentikasi
        $user = Auth::user();

        $multiguna_pengajuan = MultigunaPengajuan::select('username', 'kode_tempat')
            ->where('kode_pengajuan', $kode_pengajuan)
            ->first();

        if (!$multiguna_pengajuan) {
            abort(404, 'Data pengajuan tidak ditemukan.');
        }

        if ($user->tipe_akun === 'pengajar') {
            if ($multiguna_pengajuan->kode_tempat !== $user->kode_tempat) {
                abort(403, 'Unauthorized');
            }
        } elseif ($user->tipe_akun === 'siswa') {
            if ($multiguna_pengajuan->username !== $user->username) {
                abort(403, 'Unauthorized');
            }
        }

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

        ]);

        MultigunaLimacCapacity::where('kode_pengajuan', $kode_pengajuan)->update($dataUpdate);

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

        return view('multiguna.limac.capital.data', compact('multiguna_limac_capital'));
    }

    public function editCapital($kode_pengajuan)
    {
        // autentikasi
        $user = Auth::user();

        $multiguna_pengajuan = MultigunaPengajuan::select('username', 'kode_tempat')
            ->where('kode_pengajuan', $kode_pengajuan)
            ->first();

        if (!$multiguna_pengajuan) {
            abort(404, 'Data pengajuan tidak ditemukan.');
        }

        if ($user->tipe_akun === 'pengajar') {
            if ($multiguna_pengajuan->kode_tempat !== $user->kode_tempat) {
                abort(403, 'Unauthorized');
            }
        } elseif ($user->tipe_akun === 'siswa') {
            if ($multiguna_pengajuan->username !== $user->username) {
                abort(403, 'Unauthorized');
            }
        }

        $pengajuan = MultigunaLimacCapital::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        return view('multiguna.limac.capital.ubah', compact('pengajuan'));
    }

    public function updateCapital(Request $request, $kode_pengajuan)
    {
        // autentikasi
        $user = Auth::user();

        $multiguna_pengajuan = MultigunaPengajuan::select('username', 'kode_tempat')
            ->where('kode_pengajuan', $kode_pengajuan)
            ->first();

        if (!$multiguna_pengajuan) {
            abort(404, 'Data pengajuan tidak ditemukan.');
        }

        if ($user->tipe_akun === 'pengajar') {
            if ($multiguna_pengajuan->kode_tempat !== $user->kode_tempat) {
                abort(403, 'Unauthorized');
            }
        } elseif ($user->tipe_akun === 'siswa') {
            if ($multiguna_pengajuan->username !== $user->username) {
                abort(403, 'Unauthorized');
            }
        }

        // Update data di MultigunaLimacCapital
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
        $dataUpdate['harga_beli_bank'] = $request->harga_beli_bank;
        $dataUpdate['jangka_waktu_pembiayaan'] = $request->jangka_waktu_pembiayaan;
        $dataUpdate['margin_bank'] = $request->margin_bank;
        $dataUpdate['besarnya_urbun'] = $request->besarnya_urbun;

        MultigunaLimacCapital::where('kode_pengajuan', $kode_pengajuan)
            ->update($dataUpdate);

        $score = 0;
        $score += (int) (preg_match('/\((\d+)\)/', $request->besarnya_urbun, $m) ? $m[1] : 0);

        MultigunaPengajuan::where('kode_pengajuan', $kode_pengajuan)
            ->update([
                'total_capital' => $score,
            ]);

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
        // autentikasi
        $user = Auth::user();

        $multiguna_pengajuan = MultigunaPengajuan::select('username', 'kode_tempat')
            ->where('kode_pengajuan', $kode_pengajuan)
            ->first();

        if (!$multiguna_pengajuan) {
            abort(404, 'Data pengajuan tidak ditemukan.');
        }

        if ($user->tipe_akun === 'pengajar') {
            if ($multiguna_pengajuan->kode_tempat !== $user->kode_tempat) {
                abort(403, 'Unauthorized');
            }
        } elseif ($user->tipe_akun === 'siswa') {
            if ($multiguna_pengajuan->username !== $user->username) {
                abort(403, 'Unauthorized');
            }
        }

        $pengajuan = MultigunaLimacCollateralSk::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        return view('multiguna.limac.collateralsk.ubah', compact('pengajuan'));
    }

    public function updateCollateralSk(Request $request, $kode_pengajuan)
    {
        // autentikasi
        $user = Auth::user();

        $multiguna_pengajuan = MultigunaPengajuan::select('username', 'kode_tempat')
            ->where('kode_pengajuan', $kode_pengajuan)
            ->first();

        if (!$multiguna_pengajuan) {
            abort(404, 'Data pengajuan tidak ditemukan.');
        }

        if ($user->tipe_akun === 'pengajar') {
            if ($multiguna_pengajuan->kode_tempat !== $user->kode_tempat) {
                abort(403, 'Unauthorized');
            }
        } elseif ($user->tipe_akun === 'siswa') {
            if ($multiguna_pengajuan->username !== $user->username) {
                abort(403, 'Unauthorized');
            }
        }

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
        // autentikasi
        $user = Auth::user();

        $multiguna_pengajuan = MultigunaPengajuan::select('username', 'kode_tempat')
            ->where('kode_pengajuan', $kode_pengajuan)
            ->first();

        if (!$multiguna_pengajuan) {
            abort(404, 'Data pengajuan tidak ditemukan.');
        }

        if ($user->tipe_akun === 'pengajar') {
            if ($multiguna_pengajuan->kode_tempat !== $user->kode_tempat) {
                abort(403, 'Unauthorized');
            }
        } elseif ($user->tipe_akun === 'siswa') {
            if ($multiguna_pengajuan->username !== $user->username) {
                abort(403, 'Unauthorized');
            }
        }

        $pengajuan = MultigunaLimacCollateralProperti::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        return view('multiguna.limac.collateralproperti.ubah', compact('pengajuan'));
    }

    public function updateCollateralProperti(Request $request, $kode_pengajuan)
    {
        // autentikasi
        $user = Auth::user();

        $multiguna_pengajuan = MultigunaPengajuan::select('username', 'kode_tempat')
            ->where('kode_pengajuan', $kode_pengajuan)
            ->first();

        if (!$multiguna_pengajuan) {
            abort(404, 'Data pengajuan tidak ditemukan.');
        }

        if ($user->tipe_akun === 'pengajar') {
            if ($multiguna_pengajuan->kode_tempat !== $user->kode_tempat) {
                abort(403, 'Unauthorized');
            }
        } elseif ($user->tipe_akun === 'siswa') {
            if ($multiguna_pengajuan->username !== $user->username) {
                abort(403, 'Unauthorized');
            }
        }

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
        // autentikasi
        $user = Auth::user();

        $multiguna_pengajuan = MultigunaPengajuan::select('username', 'kode_tempat')
            ->where('kode_pengajuan', $kode_pengajuan)
            ->first();

        if (!$multiguna_pengajuan) {
            abort(404, 'Data pengajuan tidak ditemukan.');
        }

        if ($user->tipe_akun === 'pengajar') {
            if ($multiguna_pengajuan->kode_tempat !== $user->kode_tempat) {
                abort(403, 'Unauthorized');
            }
        } elseif ($user->tipe_akun === 'siswa') {
            if ($multiguna_pengajuan->username !== $user->username) {
                abort(403, 'Unauthorized');
            }
        }

        $pengajuan = MultigunaLimacCollateralbermotor::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        return view('multiguna.limac.collateralbermotor.ubah', compact('pengajuan'));
    }

    public function updateCollateralbermotor(Request $request, $kode_pengajuan)
    {
        // autentikasi
        $user = Auth::user();

        $multiguna_pengajuan = MultigunaPengajuan::select('username', 'kode_tempat')
            ->where('kode_pengajuan', $kode_pengajuan)
            ->first();

        if (!$multiguna_pengajuan) {
            abort(404, 'Data pengajuan tidak ditemukan.');
        }

        if ($user->tipe_akun === 'pengajar') {
            if ($multiguna_pengajuan->kode_tempat !== $user->kode_tempat) {
                abort(403, 'Unauthorized');
            }
        } elseif ($user->tipe_akun === 'siswa') {
            if ($multiguna_pengajuan->username !== $user->username) {
                abort(403, 'Unauthorized');
            }
        }

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
        // autentikasi
        $user = Auth::user();

        $multiguna_pengajuan = MultigunaPengajuan::select('username', 'kode_tempat')
            ->where('kode_pengajuan', $kode_pengajuan)
            ->first();

        if (!$multiguna_pengajuan) {
            abort(404, 'Data pengajuan tidak ditemukan.');
        }

        if ($user->tipe_akun === 'pengajar') {
            if ($multiguna_pengajuan->kode_tempat !== $user->kode_tempat) {
                abort(403, 'Unauthorized');
            }
        } elseif ($user->tipe_akun === 'siswa') {
            if ($multiguna_pengajuan->username !== $user->username) {
                abort(403, 'Unauthorized');
            }
        }

        $pengajuan = MultigunaLimacCondition::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        return view('multiguna.limac.condition.ubah', compact('pengajuan'));
    }

    public function updateCondition(Request $request, $kode_pengajuan)
    {
        // autentikasi
        $user = Auth::user();

        $multiguna_pengajuan = MultigunaPengajuan::select('username', 'kode_tempat')
            ->where('kode_pengajuan', $kode_pengajuan)
            ->first();

        if (!$multiguna_pengajuan) {
            abort(404, 'Data pengajuan tidak ditemukan.');
        }

        if ($user->tipe_akun === 'pengajar') {
            if ($multiguna_pengajuan->kode_tempat !== $user->kode_tempat) {
                abort(403, 'Unauthorized');
            }
        } elseif ($user->tipe_akun === 'siswa') {
            if ($multiguna_pengajuan->username !== $user->username) {
                abort(403, 'Unauthorized');
            }
        }

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
