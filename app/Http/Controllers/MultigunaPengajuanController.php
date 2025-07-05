<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Nasabah\NasabahProfil;
use Illuminate\Database\QueryException;
use App\Models\Nasabah\NasabahPekerjaan;
use App\Models\Multiguna\Limac\MultigunaLimacCapital;
use App\Models\Multiguna\Limac\MultigunaLimacCapacity;
use App\Models\Multiguna\Pengajuan\MultigunaPengajuan;
use App\Models\Multiguna\Limac\MultigunaLimacCharacter;
use App\Models\Multiguna\Limac\MultigunaLimacCondition;
use App\Models\Multiguna\Dokumentasi\MultigunaDokumentasi;
use App\Models\Multiguna\Limac\MultigunaLimacCollateralSk;
use App\Models\Multiguna\Limac\MultigunaLimacCollateralBermotor;
use App\Models\Multiguna\Limac\MultigunaLimacCollateralProperti;
use App\Models\Multiguna\Limac\MultigunaLimacCapitalTbAsetLainnya;
use App\Models\Multiguna\Limac\MultigunaLimacCapitalTbAsetKendaraan;
use App\Models\Multiguna\Limac\MultigunaLimacCapitalTbAsetAktivalancar;
use App\Models\Multiguna\Limac\MultigunaLimacCapitalTbAsetTanahbangunan;
use App\Models\Multiguna\Limac\MultigunaLimacCharacterTbCheckingNasabah;
use App\Models\Multiguna\Limac\MultigunaLimacCharacterTbCheckingPasangan;

class MultigunaPengajuanController extends Controller
{

    // otorisasi
    protected function authorizePengajuan($kode_pengajuan)
    {
        // autentikasi
        $user = Auth::user();

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

    // 1. Pengajuan
    public function indexPengajuan()
    {
        $user = Auth::user();

        if ($user->tipe_akun == 'siswa') {
            $multiguna_pengajuan = MultigunaPengajuan::where('username', $user->username)
                ->where('kode_tempat', $user->kode_tempat)
                ->paginate(5);
        } elseif ($user->tipe_akun == 'pengajar') {
            $multiguna_pengajuan = MultigunaPengajuan::where('kode_tempat', $user->kode_tempat)
                ->paginate(5);
        } elseif ($user->tipe_akun == 'admin') {
            $multiguna_pengajuan = MultigunaPengajuan::paginate(5);
        } else {
            $multiguna_pengajuan = collect();
        }

        return view('multiguna.pengajuan.data', compact('multiguna_pengajuan'));
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

        return view('multiguna.pengajuan.tambah', compact('nasabahs'));
    }

    public function storePengajuan(Request $request)
    {

        $parts = explode('-', $request->nasabah_pengajuan, 2);
        $kodeNasabah = trim($parts[0]);
        $namaNasabah = isset($parts[1]) ? trim($parts[1]) : '';

        $user = Auth::user();
        $lastPengajuan = MultigunaPengajuan::where('username', $user->username)
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

        $kodePengajuan = strtolower($user->username) . 'multiguna_' . $nextNumber;

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
                'harga_beli_bank',
                'jangka_waktu_pembiayaan',
                'margin_bank',
            ];

            $excludeKeputusan = ['harga_beli_bank', 'margin_bank', 'jangka_waktu_pembiayaan']; // dikecualikan dari keputusan_

            foreach ($fields as $field) {
                $dataCreatePengajuan["permohonan_$field"] = $request->input("permohonan_$field");
                if (!in_array($field, $excludeKeputusan)) {
                    $dataCreatePengajuan["keputusan_$field"]  = $request->input("permohonan_$field");
                }
            }

            MultigunaPengajuan::create($dataCreatePengajuan);

            $dataCreateLimac = [
                'kode_pengajuan' => $kodePengajuan,
                'kode_nasabah'   => $kodeNasabah,
                'nama_nasabah'   => $namaNasabah,
                'username'       => $user->username,
                'kode_tempat'    => $user->kode_tempat,
            ];

            $models = [
                MultigunaLimacCharacter::class,
                MultigunaLimacCapacity::class,
                MultigunaLimacCapital::class,
                MultigunaLimacCollateralSk::class,
                MultigunaLimacCollateralProperti::class,
                MultigunaLimacCollateralBermotor::class,
                MultigunaLimacCondition::class,
                MultigunaDokumentasi::class,
            ];

            foreach ($models as $model) {
                $model::create($dataCreateLimac);
            }

            return redirect()->route('multiguna.pengajuan.data')->with('success', '✅ Data pengajuan berhasil ditambahkan.');
        } catch (QueryException $e) {
            return redirect()->route('multiguna.pengajuan.data')->with('error', '❌ Gagal menambahkan data pengajuan. Silakan coba lagi.');
        }
    }

    public function editPengajuan($kode_pengajuan)
    {
        $this->authorizePengajuan($kode_pengajuan);

        $pengajuan = MultigunaPengajuan::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        $nasabahs = NasabahProfil::select('kode_nasabah', 'nama_nasabah')->get();

        return view('multiguna.pengajuan.ubah', compact('pengajuan', 'nasabahs'));
    }

    public function updatePengajuan(Request $request, $kode_pengajuan)
    {
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
                'harga_beli_bank',
                'jangka_waktu_pembiayaan',
                'margin_bank',
            ];

            foreach ($fields as $field) {
                $dataUpdatePengajuan['permohonan_' . $field] = $request->input('permohonan_' . $field);
                $dataUpdatePengajuan['keputusan_' . $field]  = $request->input('keputusan_' . $field);
            }

            MultigunaPengajuan::where('kode_pengajuan', $kode_pengajuan)->update($dataUpdatePengajuan);

            $dataUpdateLimac = [
                'kode_nasabah' => $kodeNasabah,
                'nama_nasabah' => $namaNasabah,
            ];

            $models = [
                MultigunaLimacCharacter::class,
                MultigunaLimacCapacity::class,
                MultigunaLimacCapital::class,
                MultigunaLimacCollateralSk::class,
                MultigunaLimacCollateralProperti::class,
                MultigunaLimacCollateralBermotor::class,
                MultigunaLimacCondition::class,
                MultigunaDokumentasi::class,
            ];

            foreach ($models as $model) {
                $model::where('kode_pengajuan', $kode_pengajuan)->update($dataUpdateLimac);
            }

            return redirect()->route('multiguna.pengajuan.data')->with('success', '✅ Data pengajuan berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('multiguna.pengajuan.data')->with('error', '❌ Gagal memperbarui data pengajuan.');
        }
    }

    public function destroyPengajuan($kode_pengajuan)
    {
        $this->authorizePengajuan($kode_pengajuan);

        $multiguna_pengajuan = MultigunaPengajuan::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        $multiguna_pengajuan->delete();

        return redirect()->route('multiguna.pengajuan.data')->with('success', 'Data nasabah berhasil dihapus.');
    }

    // 2. Angsuran
    public function indexAngsuran($kode_pengajuan)
    {
        $this->authorizePengajuan($kode_pengajuan);

        $pengajuan = MultigunaPengajuan::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        $angsuran = MultigunaLimacCapital::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        return view('multiguna.pengajuan.angsuran', compact('pengajuan', 'angsuran'));
    }

    // 3. Cetak
    public function indexCetak()
    {
        $user = Auth::user();

        if ($user->tipe_akun == 'siswa') {
            $multiguna_pengajuan = MultigunaPengajuan::where('username', $user->username)
                ->where('kode_tempat', $user->kode_tempat)
                ->paginate(5);
        } elseif ($user->tipe_akun == 'pengajar') {
            $multiguna_pengajuan = MultigunaPengajuan::where('kode_tempat', $user->kode_tempat)
                ->paginate(5);
        } elseif ($user->tipe_akun == 'admin') {
            $multiguna_pengajuan = MultigunaPengajuan::paginate(5);
        } else {
            $multiguna_pengajuan = collect();
        }

        return view('multiguna.cetak.data', compact('multiguna_pengajuan'));
    }

    public function cetakLaporanHasil($kode_pengajuan)
    {
        // panggil method otorisasi
        $kode_nasabah = $this->authorizePengajuan($kode_pengajuan);

        $nasabah_profil = NasabahProfil::where('kode_nasabah', $kode_nasabah)->firstOrFail();
        $nasabah_pekerjaan = NasabahPekerjaan::where('kode_nasabah', $kode_nasabah)->firstOrFail();
        $pengajuan = MultigunaPengajuan::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();

        $pengajuan_character = MultigunaLimacCharacter::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        $pengajuan_checking_nasabah = MultigunaLimacCharacterTbCheckingNasabah::where('kode_pengajuan', $kode_pengajuan)->get();
        $pengajuan_checking_pasangan = MultigunaLimacCharacterTbCheckingPasangan::where('kode_pengajuan', $kode_pengajuan)->get();

        $pengajuan_capacity = MultigunaLimacCapacity::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();

        $pengajuan_capital = MultigunaLimacCapital::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        $pengajuan_aset_aktivalancar = MultigunaLimacCapitalTbAsetAktivalancar::where('kode_pengajuan', $kode_pengajuan)->get();
        $pengajuan_aset_tanahbangunan = MultigunaLimacCapitalTbAsetTanahbangunan::where('kode_pengajuan', $kode_pengajuan)->get();
        $pengajuan_aset_kendaraan = MultigunaLimacCapitalTbAsetKendaraan::where('kode_pengajuan', $kode_pengajuan)->get();
        $pengajuan_aset_lainnya = MultigunaLimacCapitalTbAsetLainnya::where('kode_pengajuan', $kode_pengajuan)->get();

        $pengajuan_collateralsk = MultigunaLimacCollateralSk::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        $pengajuan_collateralproperti = MultigunaLimacCollateralProperti::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        $pengajuan_collateralbermotor = MultigunaLimacCollateralBermotor::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();

        $pengajuan_condition = MultigunaLimacCondition::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();

        $pengajuan_dokumentasi = MultigunaDokumentasi::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();

        return view('multiguna.cetak.laporan_hasil', compact(
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

            'pengajuan_collateralsk',
            'pengajuan_collateralproperti',
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
        $pengajuan = MultigunaPengajuan::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();

        $pengajuan_collateralsk = MultigunaLimacCollateralSk::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();

        return view('multiguna.cetak.surat_persetujuan', compact('pengajuan', 'nasabah_profil', 'nasabah_pekerjaan', 'pengajuan_collateralsk'));
    }
    public function cetakDokumenAkad($kode_pengajuan)
    {
        // panggil method otorisasi
        $kode_nasabah = $this->authorizePengajuan($kode_pengajuan);

        $nasabah_profil = NasabahProfil::where('kode_nasabah', $kode_nasabah)->firstOrFail();
        $nasabah_pekerjaan = NasabahPekerjaan::where('kode_nasabah', $kode_nasabah)->firstOrFail();
        $pengajuan = MultigunaPengajuan::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();

        $pengajuan_collateralsk = MultigunaLimacCollateralSk::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();

        return view('multiguna.cetak.dokumen_akad', compact('pengajuan', 'nasabah_profil', 'nasabah_pekerjaan', 'pengajuan_collateralsk'));
    }
    public function cetakSuratPencairan($kode_pengajuan)
    {
        // panggil method otorisasi
        $kode_nasabah = $this->authorizePengajuan($kode_pengajuan);

        $nasabah_profil = NasabahProfil::where('kode_nasabah', $kode_nasabah)->firstOrFail();
        $nasabah_pekerjaan = NasabahPekerjaan::where('kode_nasabah', $kode_nasabah)->firstOrFail();
        $pengajuan = MultigunaPengajuan::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();

        $pengajuan_collateralsk = MultigunaLimacCollateralSk::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();

        return view('multiguna.cetak.surat_pencairan', compact('pengajuan', 'nasabah_profil', 'nasabah_pekerjaan', 'pengajuan_collateralsk'));
    }
}
