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
use App\Models\Multiguna\Limac\MultigunaLimacCollateral;

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
                abort(404);
            }
        } elseif ($user->tipe_akun === 'siswa') {
            if ($multiguna_pengajuan->username !== $user->username) {
                abort(404);
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
                abort(404);
            }
        } elseif ($user->tipe_akun === 'siswa') {
            if ($multiguna_pengajuan->username !== $user->username) {
                abort(404);
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
                abort(404);
            }
        } elseif ($user->tipe_akun === 'siswa') {
            if ($multiguna_pengajuan->username !== $user->username) {
                abort(404);
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
                abort(404);
            }
        } elseif ($user->tipe_akun === 'siswa') {
            if ($multiguna_pengajuan->username !== $user->username) {
                abort(404);
            }
        }

        MultigunaLimacCapacity::where('kode_pengajuan', $kode_pengajuan)
            ->update([
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
            ]);

        $scoreCapacity = [
            'tempatkerja_kelokasi_bank',
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
            $score += (int) $request->$field;
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
                abort(404);
            }
        } elseif ($user->tipe_akun === 'siswa') {
            if ($multiguna_pengajuan->username !== $user->username) {
                abort(404);
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
                abort(404);
            }
        } elseif ($user->tipe_akun === 'siswa') {
            if ($multiguna_pengajuan->username !== $user->username) {
                abort(404);
            }
        }

        // Update data di MultigunaLimacCapital
        MultigunaLimacCapital::where('kode_pengajuan', $kode_pengajuan)
            ->update([
                'jenis_akad' => $request->jenis_akad,
                'jenis_pembiayaan' => $request->jenis_pembiayaan,
                'tujuan_penggunaan' => $request->tujuan_penggunaan,
                'harga_beli_bank' => $request->harga_beli_bank,
                'jangka_waktu_pembiayaan' => $request->jangka_waktu_pembiayaan,
                'margin_bank' => $request->margin_bank,
            ]);

        $score = 0;
        // $score += (int) (preg_match('/\((\d+)\)/', $request->besarnya_urbun, $m) ? $m[1] : 0);

        // MultigunaPengajuan::where('kode_pengajuan', $kode_pengajuan)
        //     ->update([
        //         'total_capital' => $score,
        //     ]);

        return redirect()->route('multiguna.limac.capital.data')
            ->with('success', '✅ Data berhasil diperbarui dan total score :' . $score . ' disimpan.');
    }

    // 4.1 Collateral
    public function indexLimacCollateral()
    {
        $user = Auth::user();

        if ($user->tipe_akun == 'siswa') {
            $multiguna_limac_collateral = MultigunaLimacCollateral::where('username', $user->username)
                ->where('kode_tempat', $user->kode_tempat)
                ->paginate(5);
        } elseif ($user->tipe_akun == 'pengajar') {
            $multiguna_limac_collateral = MultigunaLimacCollateral::where('kode_tempat', $user->kode_tempat)
                ->paginate(5);
        } elseif ($user->tipe_akun == 'admin') {
            $multiguna_limac_collateral = MultigunaLimacCollateral::paginate(5);
        } else {
            $multiguna_limac_collateral = collect();
        }

        return view('multiguna.limac.collateral.data', compact('multiguna_limac_collateral'));
    }

    public function editCollateral($kode_pengajuan)
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
                abort(404);
            }
        } elseif ($user->tipe_akun === 'siswa') {
            if ($multiguna_pengajuan->username !== $user->username) {
                abort(404);
            }
        }

        $pengajuan = MultigunaLimacCollateral::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        return view('multiguna.limac.collateral.ubah', compact('pengajuan'));
    }

    public function updateCollateral(Request $request, $kode_pengajuan)
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
                abort(404);
            }
        } elseif ($user->tipe_akun === 'siswa') {
            if ($multiguna_pengajuan->username !== $user->username) {
                abort(404);
            }
        }

        MultigunaLimacCollateral::where('kode_pengajuan', $kode_pengajuan)
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
                'total_collateral' => $score,
            ]);

        return redirect()->route('multiguna.limac.collateral.data')
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
                abort(404);
            }
        } elseif ($user->tipe_akun === 'siswa') {
            if ($multiguna_pengajuan->username !== $user->username) {
                abort(404);
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
                abort(404);
            }
        } elseif ($user->tipe_akun === 'siswa') {
            if ($multiguna_pengajuan->username !== $user->username) {
                abort(404);
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
