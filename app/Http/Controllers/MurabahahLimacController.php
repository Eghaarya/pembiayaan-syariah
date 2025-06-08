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

        MurabahahLimacCapacity::where('kode_pengajuan', $kode_pengajuan)
            ->update([
                'tempatkerja_kelokasi_bank' => $request->tempatkerja_kelokasi_bank,
                'tempatkerja_kelokasi_agunan' => $request->tempatkerja_kelokasi_agunan,
                'pembayaran_kolektif' => $request->pembayaran_kolektif,
                'pembayaran_nonkolektif' => $request->pembayaran_nonkolektif,
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
        MurabahahLimacCapital::where('kode_pengajuan', $kode_pengajuan)
            ->update([
                'jenis_akad' => $request->jenis_akad,
                'jenis_pembiayaan' => $request->jenis_pembiayaan,
                'tujuan_penggunaan' => $request->tujuan_penggunaan,
                'harga_jual_barang' => $request->harga_jual_barang,
                'urbun_uangmuka' => $request->urbun_uangmuka,
                'harga_beli_bank' => $request->harga_beli_bank,
                'jangka_waktu_pembiayaan' => $request->jangka_waktu_pembiayaan,
                'margin_bank' => $request->margin_bank,
                'besarnya_urbun' => $request->besarnya_urbun,

            ]);

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
