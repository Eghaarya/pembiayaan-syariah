<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Nasabah\NasabahProfil;
use Illuminate\Database\QueryException;
use App\Models\Nasabah\NasabahPekerjaan;
use App\Models\Murabahah\Limac\MurabahahLimacCapital;
use App\Models\Murabahah\Limac\MurabahahLimacCapacity;
use App\Models\Murabahah\Pengajuan\MurabahahPengajuan;
use App\Models\Murabahah\Limac\MurabahahLimacCharacter;
use App\Models\Murabahah\Limac\MurabahahLimacCondition;
use App\Models\Murabahah\Dokumentasi\MurabahahDokumentasi;
use App\Models\Murabahah\Limac\MurabahahLimacCollateralKpr;
use App\Models\Murabahah\Limac\MurabahahLimacCollateralBermotor;
use App\Models\Murabahah\Limac\MurabahahLimacCapitalTbAsetLainnya;
use App\Models\Murabahah\Limac\MurabahahLimacCapitalTbAsetKendaraan;
use App\Models\Murabahah\Limac\MurabahahLimacCapitalTbAsetAktivalancar;
use App\Models\Murabahah\Limac\MurabahahLimacCapitalTbAsetTanahbangunan;
use App\Models\Murabahah\Limac\MurabahahLimacCharacterTbCheckingNasabah;
use App\Models\Murabahah\Limac\MurabahahLimacCharacterTbCheckingPasangan;

class MurabahahPengajuanController extends Controller
{

    // otorisasi
    protected function authorizePengajuan($kode_pengajuan)
    {
        // autentikasi
        $user = Auth::user();

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

    // 1. Pengajuan
    public function indexPengajuan()
    {
        $user = Auth::user();

        if ($user->tipe_akun == 'siswa') {
            $murabahah_pengajuan = MurabahahPengajuan::where('username', $user->username)
                ->where('kode_tempat', $user->kode_tempat)
                ->paginate(5);
        } elseif ($user->tipe_akun == 'pengajar') {
            $murabahah_pengajuan = MurabahahPengajuan::where('kode_tempat', $user->kode_tempat)
                ->paginate(5);
        } elseif ($user->tipe_akun == 'admin') {
            $murabahah_pengajuan = MurabahahPengajuan::paginate(5);
        } else {
            $murabahah_pengajuan = collect();
        }

        return view('murabahah.pengajuan.data', compact('murabahah_pengajuan'));
    }

    public function createPengajuan()
    {
        $user = Auth::user();

        if ($user->tipe_akun == 'siswa') {
            $nasabahs = NasabahProfil::select('kode_nasabah', 'nama_nasabah')
                ->where('username', $user->username)
                ->get();
        } elseif ($user->tipe_akun == 'pengajar') {
            $nasabahs = NasabahProfil::select('kode_nasabah', 'nama_nasabah')
                ->where('kode_tempat', $user->kode_tempat)
                ->get();
        } elseif ($user->tipe_akun == 'admin') {
            $nasabahs = NasabahProfil::select('kode_nasabah', 'nama_nasabah')->get();
        } else {
            $nasabahs = collect();
        }

        return view('murabahah.pengajuan.tambah', compact('nasabahs'));
    }

    public function storePengajuan(Request $request)
    {

        $parts = explode('-', $request->nasabah_pengajuan, 2);
        $kodeNasabah = trim($parts[0]);
        $namaNasabah = isset($parts[1]) ? trim($parts[1]) : '';

        $user = Auth::user();
        $lastPengajuan = MurabahahPengajuan::where('username', $user->username)
            ->orderBy('id', 'desc')
            ->first();

        if ($lastPengajuan) {
            $kode = $lastPengajuan->kode_pengajuan;
            $parts = explode('_', $kode);
            $lastNumber = intval(end($parts));

            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        $kodePengajuan = strtolower($user->username) . 'murabahah_' . $nextNumber;

        try {
            $dataCreatePengajuan = [
                'kode_pengajuan'     => $kodePengajuan,
                'kode_nasabah'       => $kodeNasabah,
                'nama_nasabah'       => $namaNasabah,
                'tanggal_pengajuan'  => Carbon::parse($request->tanggal_pengajuan),
                'username'           => $user->username,
                'kode_tempat'        => $user->kode_tempat,
            ];

            $fields = [
                'jenis_akad',
                'jenis_pembiayaan',
                'tujuan_penggunaan',
                'harga_jual_barang',
                'urbun_uangmuka',
                'harga_beli_bank',
                'jangka_waktu_pembiayaan',
                'margin_bank',
            ];

            $excludeKeputusan = ['harga_jual_barang', 'urbun_uangmuka', 'harga_beli_bank', 'margin_bank', 'jangka_waktu_pembiayaan']; // dikecualikan dari keputusan_

            foreach ($fields as $field) {
                $dataCreatePengajuan["permohonan_$field"] = $request->input("permohonan_$field");
                if (!in_array($field, $excludeKeputusan)) {
                    $dataCreatePengajuan["keputusan_$field"]  = $request->input("permohonan_$field");
                }
            }

            MurabahahPengajuan::create($dataCreatePengajuan);

            $dataCreateLimac = [
                'kode_pengajuan' => $kodePengajuan,
                'kode_nasabah'   => $kodeNasabah,
                'nama_nasabah'   => $namaNasabah,
                'username'       => $user->username,
                'kode_tempat'    => $user->kode_tempat,
            ];

            $models = [
                MurabahahLimacCharacter::class,
                MurabahahLimacCapacity::class,
                MurabahahLimacCapital::class,
                MurabahahLimacCollateralKpr::class,
                MurabahahLimacCollateralBermotor::class,
                MurabahahLimacCondition::class,
                MurabahahDokumentasi::class,
            ];

            foreach ($models as $model) {
                $model::create($dataCreateLimac);
            }

            return redirect()->route('murabahah.pengajuan.data')->with('success', '✅ Data pengajuan berhasil ditambahkan.');
        } catch (QueryException $e) {
            return redirect()->route('murabahah.pengajuan.data')->with('error', '❌ Gagal menambahkan data pengajuan. Silakan coba lagi.');
        }
    }

    public function editPengajuan($kode_pengajuan)
    {
        // panggil method otorisasi
        $this->authorizePengajuan($kode_pengajuan);

        $pengajuan = MurabahahPengajuan::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        $nasabahs = NasabahProfil::select('kode_nasabah', 'nama_nasabah')->get();

        return view('murabahah.pengajuan.ubah', compact('pengajuan', 'nasabahs'));
    }

    public function updatePengajuan(Request $request, $kode_pengajuan)
    {
        // panggil method otorisasi
        $this->authorizePengajuan($kode_pengajuan);

        $parts = explode('-', $request->nasabah_pengajuan, 2);
        $kodeNasabah = trim($parts[0]);
        $namaNasabah = isset($parts[1]) ? trim($parts[1]) : '';

        try {
            $dataUpdatePengajuan = [
                'kode_nasabah'       => $kodeNasabah,
                'nama_nasabah'       => $namaNasabah,
                'tanggal_pengajuan'  => $request->tanggal_pengajuan ? Carbon::parse($request->tanggal_pengajuan) : null,
                'keputusan'          => $request->keputusan,
                'tanggal_pencairan'  => $request->tanggal_pencairan ? Carbon::parse($request->tanggal_pencairan) : null,
            ];

            // Daftar field yang sama untuk permohonan dan keputusan
            $fields = [
                'jenis_akad',
                'jenis_pembiayaan',
                'tujuan_penggunaan',
                'harga_jual_barang',
                'urbun_uangmuka',
                'harga_beli_bank',
                'jangka_waktu_pembiayaan',
                'margin_bank',
            ];

            foreach ($fields as $field) {
                $dataUpdatePengajuan['permohonan_' . $field] = $request->input('permohonan_' . $field);
                $dataUpdatePengajuan['keputusan_' . $field]  = $request->input('keputusan_' . $field);
            }

            MurabahahPengajuan::where('kode_pengajuan', $kode_pengajuan)->update($dataUpdatePengajuan);

            $dataUpdateLimac = [
                'kode_nasabah' => $kodeNasabah,
                'nama_nasabah' => $namaNasabah,
            ];

            $models = [
                MurabahahLimacCharacter::class,
                MurabahahLimacCapacity::class,
                MurabahahLimacCapital::class,
                MurabahahLimacCollateralKpr::class,
                MurabahahLimacCollateralBermotor::class,
                MurabahahLimacCondition::class,
                MurabahahDokumentasi::class,
            ];

            foreach ($models as $model) {
                $model::where('kode_pengajuan', $kode_pengajuan)->update($dataUpdateLimac);
            }

            return redirect()->route('murabahah.pengajuan.data')->with('success', '✅ Data pengajuan berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('murabahah.pengajuan.data')->with('error', '❌ Gagal memperbarui data pengajuan.');
        }
    }

    public function destroyPengajuan($kode_pengajuan)
    {
        // panggil method otorisasi
        $this->authorizePengajuan($kode_pengajuan);

        $mudharabah_pengajuan = MurabahahPengajuan::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        $mudharabah_pengajuan->delete();

        return redirect()->route('murabahah.pengajuan.data')->with('success', 'Data nasabah berhasil dihapus.');
    }

    // 2. Angsuran
    public function indexAngsuran($kode_pengajuan)
    {
        // panggil method otorisasi
        $this->authorizePengajuan($kode_pengajuan);

        $pengajuan = MurabahahPengajuan::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        return view('murabahah.pengajuan.angsuran', compact('pengajuan'));
    }

    // 3. Cetak
    public function indexCetak()
    {
        $user = Auth::user();

        if ($user->tipe_akun == 'siswa') {
            $murabahah_pengajuan = MurabahahPengajuan::where('username', $user->username)
                ->where('kode_tempat', $user->kode_tempat)
                ->paginate(5);
        } elseif ($user->tipe_akun == 'pengajar') {
            $murabahah_pengajuan = MurabahahPengajuan::where('kode_tempat', $user->kode_tempat)
                ->paginate(5);
        } elseif ($user->tipe_akun == 'admin') {
            $murabahah_pengajuan = MurabahahPengajuan::paginate(5);
        } else {
            $murabahah_pengajuan = collect();
        }

        return view('murabahah.cetak.data', compact('murabahah_pengajuan'));
    }

    public function cetakLaporanHasil($kode_pengajuan)
    {
        // panggil method otorisasi
        $kode_nasabah = $this->authorizePengajuan($kode_pengajuan);

        $nasabah_profil = NasabahProfil::where('kode_nasabah', $kode_nasabah)->firstOrFail();
        $nasabah_pekerjaan = NasabahPekerjaan::where('kode_nasabah', $kode_nasabah)->firstOrFail();
        $pengajuan = MurabahahPengajuan::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();

        $pengajuan_character = MurabahahLimacCharacter::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        $pengajuan_checking_nasabah = MurabahahLimacCharacterTbCheckingNasabah::where('kode_pengajuan', $kode_pengajuan)->get();
        $pengajuan_checking_pasangan = MurabahahLimacCharacterTbCheckingPasangan::where('kode_pengajuan', $kode_pengajuan)->get();

        $pengajuan_capacity = MurabahahLimacCapacity::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();

        $pengajuan_capital = MurabahahLimacCapital::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        $pengajuan_aset_aktivalancar = MurabahahLimacCapitalTbAsetAktivalancar::where('kode_pengajuan', $kode_pengajuan)->get();
        $pengajuan_aset_tanahbangunan = MurabahahLimacCapitalTbAsetTanahbangunan::where('kode_pengajuan', $kode_pengajuan)->get();
        $pengajuan_aset_kendaraan = MurabahahLimacCapitalTbAsetKendaraan::where('kode_pengajuan', $kode_pengajuan)->get();
        $pengajuan_aset_lainnya = MurabahahLimacCapitalTbAsetLainnya::where('kode_pengajuan', $kode_pengajuan)->get();

        $pengajuan_collateralkpr = MurabahahLimacCollateralKpr::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        $pengajuan_collateralbermotor = MurabahahLimacCollateralBermotor::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();

        $pengajuan_condition = MurabahahLimacCondition::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();

        $pengajuan_dokumentasi = MurabahahDokumentasi::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();

        return view('murabahah.cetak.laporan_hasil', compact(
            'pengajuan',
            'nasabah_profil',
            'nasabah_pekerjaan',

            'pengajuan_character',
            'pengajuan_checking_nasabah',
            'pengajuan_checking_pasangan',

            'pengajuan_capacity',

            'pengajuan_capital',
            'pengajuan_aset_aktivalancar',
            'pengajuan_aset_tanahbangunan',
            'pengajuan_aset_kendaraan',
            'pengajuan_aset_lainnya',

            'pengajuan_collateralkpr',
            'pengajuan_collateralbermotor',

            'pengajuan_condition',

            'pengajuan_dokumentasi'
        ));
    }

    public function cetakSuratPersetujuan($kode_pengajuan)
    {
        // panggil method otorisasi
        $kode_nasabah = $this->authorizePengajuan($kode_pengajuan);

        $nasabah_profil = NasabahProfil::where('kode_nasabah', $kode_nasabah)->firstOrFail();
        $nasabah_pekerjaan = NasabahPekerjaan::where('kode_nasabah', $kode_nasabah)->firstOrFail();
        $pengajuan = MurabahahPengajuan::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();

        $pengajuan_collateralkpr = MurabahahLimacCollateralKpr::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        $pengajuan_collateralbermotor = MurabahahLimacCollateralBermotor::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();

        return view('murabahah.cetak.surat_persetujuan', compact('pengajuan', 'nasabah_profil', 'nasabah_pekerjaan', 'pengajuan_collateralkpr', 'pengajuan_collateralbermotor'));
    }
    public function cetakDokumenAkad($kode_pengajuan)
    {
        // panggil method otorisasi
        $kode_nasabah = $this->authorizePengajuan($kode_pengajuan);

        $nasabah_profil = NasabahProfil::where('kode_nasabah', $kode_nasabah)->firstOrFail();
        $nasabah_pekerjaan = NasabahPekerjaan::where('kode_nasabah', $kode_nasabah)->firstOrFail();
        $pengajuan = MurabahahPengajuan::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();

        $pengajuan_collateralkpr = MurabahahLimacCollateralKpr::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        $pengajuan_collateralbermotor = MurabahahLimacCollateralBermotor::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();

        return view('murabahah.cetak.dokumen_akad', compact('pengajuan', 'nasabah_profil', 'nasabah_pekerjaan', 'pengajuan_collateralkpr', 'pengajuan_collateralbermotor'));
    }
    public function cetakSuratPencairan($kode_pengajuan)
    {
        // panggil method otorisasi
        $kode_nasabah = $this->authorizePengajuan($kode_pengajuan);

        $nasabah_profil = NasabahProfil::where('kode_nasabah', $kode_nasabah)->firstOrFail();
        $nasabah_pekerjaan = NasabahPekerjaan::where('kode_nasabah', $kode_nasabah)->firstOrFail();
        $pengajuan = MurabahahPengajuan::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();

        $pengajuan_collateralkpr = MurabahahLimacCollateralKpr::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        $pengajuan_collateralbermotor = MurabahahLimacCollateralBermotor::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();

        return view('murabahah.cetak.surat_pencairan', compact('pengajuan', 'nasabah_profil', 'nasabah_pekerjaan', 'pengajuan_collateralkpr', 'pengajuan_collateralbermotor'));
    }
}
