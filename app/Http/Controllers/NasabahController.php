<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Nasabah\NasabahProfil;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use App\Models\Nasabah\NasabahPekerjaan;
use App\Models\Multiguna\Limac\MultigunaLimacCapital;
use App\Models\Murabahah\Limac\MurabahahLimacCapital;
use App\Models\Multiguna\Limac\MultigunaLimacCapacity;
use App\Models\Multiguna\Pengajuan\MultigunaPengajuan;
use App\Models\Murabahah\Limac\MurabahahLimacCapacity;
use App\Models\Murabahah\Pengajuan\MurabahahPengajuan;
use App\Models\Multiguna\Limac\MultigunaLimacCharacter;
use App\Models\Multiguna\Limac\MultigunaLimacCondition;
use App\Models\Murabahah\Limac\MurabahahLimacCharacter;
use App\Models\Murabahah\Limac\MurabahahLimacCondition;
use App\Models\Multiguna\Dokumentasi\MultigunaDokumentasi;
use App\Models\Multiguna\Limac\MultigunaLimacCollateralSk;
use App\Models\Murabahah\Dokumentasi\MurabahahDokumentasi;
use App\Models\Murabahah\Limac\MurabahahLimacCollateralKpr;
use App\Models\Multiguna\Limac\MultigunaLimacCollateralBermotor;
use App\Models\Multiguna\Limac\MultigunaLimacCollateralProperti;
use App\Models\Murabahah\Limac\MurabahahLimacCollateralBermotor;

class NasabahController extends Controller
{

    // otorisasi
    protected function authorizeNasabah($kode_nasabah): void
    {

        // autentikasi
        $user = Auth::user();

        $nasabah_auth = NasabahProfil::select('username', 'kode_tempat')
            ->where('kode_nasabah', $kode_nasabah)
            ->first();

        if (!$nasabah_auth) {
            abort(404, 'Data nasabah tidak ditemukan.');
        }

        if ($user->tipe_akun === 'pengajar') {
            if ($nasabah_auth->kode_tempat !== $user->kode_tempat) {
                abort(403, 'Unauthorized');
            }
        } elseif ($user->tipe_akun === 'siswa') {
            if ($nasabah_auth->username !== $user->username) {
                abort(403, 'Unauthorized');
            }
        }
    }

    // 1. Profil Nasabah
    public function indexNasabahProfil()
    {
        $user = Auth::user();

        if ($user->tipe_akun == 'siswa') {
            $nasabah_profil = NasabahProfil::where('username', $user->username)
                ->where('kode_tempat', $user->kode_tempat)
                ->paginate(5);
        } elseif ($user->tipe_akun == 'pengajar') {
            $nasabah_profil = NasabahProfil::where('kode_tempat', $user->kode_tempat)
                ->paginate(5);
        } elseif ($user->tipe_akun == 'admin') {
            $nasabah_profil = NasabahProfil::paginate(5);
        } else {
            $nasabah_profil = collect();
        }

        return view('nasabah.profil.data', compact('nasabah_profil'));
    }

    public function createNasabahProfil()
    {
        return view('nasabah.profil.tambah');
    }

    public function storeNasabahProfil(Request $request)
    {

        $user = Auth::user();
        $lastNasabah = NasabahProfil::where('username', $user->username)
            ->orderBy('id', 'desc')
            ->first();

        if ($lastNasabah) {
            $kode = $lastNasabah->kode_nasabah;
            $parts = explode('_', $kode);
            $lastNumber = intval(end($parts));

            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        $kodeNasabah = $user->username . '_' . $nextNumber;

        try {
            NasabahProfil::create([
                'kode_nasabah'               => $kodeNasabah,

                // 1.1 identitas nasabah
                'nama_nasabah'               => $request->nama_nasabah,
                'ttl_lahir_nasabah'          => $request->ttl_lahir_nasabah ?? null,
                'alamat_ktp_nasabah'         => $request->alamat_ktp_nasabah ?? null,
                'kota_ktp_nasabah'           => $request->kota_ktp_nasabah ?? null,
                'kodepos_ktp_nasabah'        => $request->kodepos_ktp_nasabah ?? null,
                'alamat_sekarang_nasabah'    => $request->alamat_sekarang_nasabah ?? null,
                'kota_sekarang_nasabah'      => $request->kota_sekarang_nasabah ?? null,
                'kodepos_sekarang_nasabah'   => $request->kodepos_sekarang_nasabah ?? null,
                'no_ktp_nasabah'             => $request->no_ktp_nasabah ?? null,
                'berlaku_ktp_nasabah'        => $request->berlaku_ktp_nasabah ?? null,
                'no_npwp_nasabah'            => $request->no_npwp_nasabah ?? null,
                'kepemilikan_rumah_nasabah'  => $request->kepemilikan_rumah_nasabah ?? null,
                'lamamenetap_tahun_nasabah'  => $request->lamamenetap_tahun_nasabah ?? null,
                'lamamenetap_bulan_nasabah'  => $request->lamamenetap_bulan_nasabah ?? null,
                'notelp_rumah_nasabah'       => $request->notelp_rumah_nasabah ?? null,
                'notelp_hp_nasabah'           => $request->notelp_hp_nasabah ?? null,
                'email_nasabah'              => $request->email_nasabah ?? null,
                'jenis_kelamin_nasabah'      => $request->jenis_kelamin_nasabah ?? null,
                'status_kawin_nasabah'       => $request->status_kawin_nasabah ?? null,
                'nama_ibu_nasabah'           => $request->nama_ibu_nasabah ?? null,
                'nama_organisasi_nasabah'    => $request->nama_organisasi_nasabah ?? null,
                'jabatan_organisasi_nasabah' => $request->jabatan_organisasi_nasabah ?? null,
                'lama_organisasi_nasabah'    => $request->lama_organisasi_nasabah ?? null,

                'nama_keluarga_nasabah'      => $request->nama_keluarga_nasabah ?? null,
                'hubungan_keluarga_nasabah'  => $request->hubungan_keluarga_nasabah ?? null,
                'alamat_keluarga_nasabah'    => $request->alamat_keluarga_nasabah ?? null,
                'kota_keluarga_nasabah'      => $request->kota_keluarga_nasabah ?? null,
                'kodepos_keluarga_nasabah'   => $request->kodepos_keluarga_nasabah ?? null,
                'notelp_keluarga_nasabah'    => $request->notelp_keluarga_nasabah ?? null,
                'pekerjaan_keluarga_nasabah' => $request->pekerjaan_keluarga_nasabah ?? null,
                'alamatkantor_keluarga_nasabah' => $request->alamatkantor_keluarga_nasabah ?? null,
                'notelpkantor_keluarga_nasabah' => $request->notelpkantor_keluarga_nasabah ?? null,

                // 1.2 identitas pasangan
                'nama_pasangan'              => $request->nama_pasangan ?? null,
                'ttl_lahir_pasangan'         => $request->ttl_lahir_pasangan ?? null,
                'no_ktp_pasangan'            => $request->no_ktp_pasangan ?? null,
                'berlaku_ktp_pasangan'       => $request->berlaku_ktp_pasangan ?? null,
                'jumlah_anak_pasangan'       => $request->jumlah_anak_pasangan ?? null,
                'no_npwp_pasangan'           => $request->no_npwp_pasangan ?? null,

                // 1.3 Hubungan bank syariah
                'punya_rekening_nasabah'      => $request->punya_rekening_nasabah ?? null,
                'tahun_menjadi_nasabah'      => $request->tahun_menjadi_nasabah ?? null,
                'jenis_layanan_nasabah'      => $request->jenis_layanan_nasabah ?? null,
                'mutasi_rekening_nasabah'      => $request->mutasi_rekening_nasabah ?? null,

                'username'                   => $user->username,
                'kode_tempat'                => $user->kode_tempat,
            ]);

            NasabahPekerjaan::create([
                'kode_nasabah' => $kodeNasabah,
                'nama_nasabah' => $request->nama_nasabah,
                'username'     => $user->username,
                'kode_tempat'  => $user->kode_tempat,
            ]);

            return redirect()->route('nasabah.profil.data')->with('success', '✅ Data nasabah berhasil ditambahkan.');
        } catch (QueryException $e) {
            // Redirect balik dengan pesan error
            return redirect()->route('nasabah.profil.data')->with('error',  $nextNumber . '❌ Gagal menambahkan data nasabah. Silakan coba lagi.');
        }
    }

    public function editNasabahProfil($kode_nasabah)
    {
        // panggil method otorisasi
        $this->authorizeNasabah($kode_nasabah);

        $nasabah_profil = NasabahProfil::where('kode_nasabah', $kode_nasabah)->firstOrFail();
        return view('nasabah.profil.ubah', compact('nasabah_profil'));
    }

    public function updateNasabahProfil(Request $request, $kode_nasabah)
    {
        try {

            // panggil method otorisasi
            $this->authorizeNasabah($kode_nasabah);

            $nasabah_profil = NasabahProfil::where('kode_nasabah', $kode_nasabah)->firstOrFail();
            $nasabah_profil->update([
                'nama_nasabah' => $request->nama_nasabah,
                'ttl_lahir_nasabah' => $request->ttl_lahir_nasabah,
                'alamat_ktp_nasabah' => $request->alamat_ktp_nasabah,
                'kota_ktp_nasabah' => $request->kota_ktp_nasabah,
                'kodepos_ktp_nasabah' => $request->kodepos_ktp_nasabah,
                'alamat_sekarang_nasabah' => $request->alamat_sekarang_nasabah,
                'kota_sekarang_nasabah' => $request->kota_sekarang_nasabah,
                'kodepos_sekarang_nasabah' => $request->kodepos_sekarang_nasabah,
                'no_ktp_nasabah' => $request->no_ktp_nasabah,
                'berlaku_ktp_nasabah' => $request->berlaku_ktp_nasabah,
                'no_npwp_nasabah' => $request->no_npwp_nasabah,
                'kepemilikan_rumah_nasabah' => $request->kepemilikan_rumah_nasabah,
                'lamamenetap_tahun_nasabah' => $request->lamamenetap_tahun_nasabah,
                'lamamenetap_bulan_nasabah' => $request->lamamenetap_bulan_nasabah,
                'notelp_rumah_nasabah' => $request->notelp_rumah_nasabah,
                'notelp_hp_nasabah' => $request->notelp_hp_nasabah,
                'email_nasabah' => $request->email_nasabah,
                'jenis_kelamin_nasabah' => $request->jenis_kelamin_nasabah,
                'status_kawin_nasabah' => $request->status_kawin_nasabah,
                'nama_ibu_nasabah' => $request->nama_ibu_nasabah,
                'nama_organisasi_nasabah' => $request->nama_organisasi_nasabah,
                'jabatan_organisasi_nasabah' => $request->jabatan_organisasi_nasabah,
                'lama_organisasi_nasabah' => $request->lama_organisasi_nasabah,

                'nama_keluarga_nasabah' => $request->nama_keluarga_nasabah,
                'hubungan_keluarga_nasabah' => $request->hubungan_keluarga_nasabah,
                'alamat_keluarga_nasabah' => $request->alamat_keluarga_nasabah,
                'kota_keluarga_nasabah' => $request->kota_keluarga_nasabah,
                'kodepos_keluarga_nasabah' => $request->kodepos_keluarga_nasabah,
                'notelp_keluarga_nasabah' => $request->notelp_keluarga_nasabah,
                'pekerjaan_keluarga_nasabah' => $request->pekerjaan_keluarga_nasabah,
                'alamatkantor_keluarga_nasabah' => $request->alamatkantor_keluarga_nasabah,
                'notelpkantor_keluarga_nasabah' => $request->notelpkantor_keluarga_nasabah,

                'nama_pasangan' => $request->nama_pasangan,
                'ttl_lahir_pasangan' => $request->ttl_lahir_pasangan,
                'no_ktp_pasangan' => $request->no_ktp_pasangan,
                'berlaku_ktp_pasangan' => $request->berlaku_ktp_pasangan,
                'jumlah_anak_pasangan' => $request->jumlah_anak_pasangan,
                'no_npwp_pasangan' => $request->no_npwp_pasangan,

                'punya_rekening_nasabah'      => $request->punya_rekening_nasabah,
                'tahun_menjadi_nasabah'      => $request->tahun_menjadi_nasabah,
                'jenis_layanan_nasabah'      => $request->jenis_layanan_nasabah,
                'mutasi_rekening_nasabah'      => $request->mutasi_rekening_nasabah,
            ]);

            NasabahPekerjaan::where('kode_nasabah', $kode_nasabah)->update([
                'nama_nasabah' => $request->nama_nasabah,
            ]);

            // update nama nasabah pada pembiayaan
            $models = [
                MurabahahPengajuan::class,
                MurabahahLimacCharacter::class,
                MurabahahLimacCapacity::class,
                MurabahahLimacCapital::class,
                MurabahahLimacCollateralKpr::class,
                MurabahahLimacCollateralBermotor::class,
                MurabahahLimacCondition::class,
                MurabahahDokumentasi::class,

                MultigunaPengajuan::class,
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
                $model::where('kode_nasabah', $kode_nasabah)->update([
                    'nama_nasabah' => $request->nama_nasabah,
                ]);
            }

            return redirect()->route('nasabah.profil.data')->with('success', '✅ Data nasabah berhasil diperbarui.');
        } catch (QueryException $e) {
            // Redirect balik dengan pesan error
            return redirect()->route('nasabah.profil.data')->with('error', '❌ Gagal menyimpan perubahan. Silakan coba lagi.');
        }
    }
    public function destroyNasabahProfil($kode_nasabah)
    {
        // panggil method otorisasi
        $this->authorizeNasabah($kode_nasabah);

        $nasabah_profil = NasabahProfil::where('kode_nasabah', $kode_nasabah)->firstOrFail();
        $nasabah_profil->delete();

        return redirect()->route('nasabah.profil.data')->with('success', 'Data nasabah berhasil dihapus.');
    }

    // 2. Pekerjaan Nasabah
    public function indexNasabahPekerjaan()
    {
        $user = Auth::user();

        if ($user->tipe_akun == 'siswa') {
            $nasabah_pekerjaan = NasabahPekerjaan::where('username', $user->username)
                ->where('kode_tempat', $user->kode_tempat)
                ->paginate(5);
        } elseif ($user->tipe_akun == 'pengajar') {
            $nasabah_pekerjaan = NasabahPekerjaan::where('kode_tempat', $user->kode_tempat)
                ->paginate(5);
        } elseif ($user->tipe_akun == 'admin') {
            $nasabah_pekerjaan = NasabahPekerjaan::paginate(5);
        } else {
            $nasabah_pekerjaan = collect();
        }

        return view('nasabah.pekerjaan.data', compact('nasabah_pekerjaan'));
    }

    public function editNasabahPekerjaan($kode_nasabah)
    {
        // panggil method otorisasi
        $this->authorizeNasabah($kode_nasabah);

        $nasabah_pekerjaan = NasabahPekerjaan::where('kode_nasabah', $kode_nasabah)->firstOrFail();
        return view('nasabah.pekerjaan.ubah', compact('nasabah_pekerjaan'));
    }

    public function updateNasabahPekerjaan(Request $request, $kode_nasabah)
    {
        try {
            // panggil method otorisasi
            $this->authorizeNasabah($kode_nasabah);

            $nasabah_pekerjaan = NasabahPekerjaan::where('kode_nasabah', $kode_nasabah)->firstOrFail();
            $nasabah_pekerjaan->update([
                // 1.1 Pekerjaan nasabah
                'nama_perusahaan_nasabah' => $request->nama_perusahaan_nasabah,
                'bidang_perusahaan_nasabah' => $request->bidang_perusahaan_nasabah,
                'skala_perusahaan_nasabah' => $request->skala_perusahaan_nasabah,
                'jenis_pekerjaan_nasabah' => $request->jenis_pekerjaan_nasabah,
                'jabatan_pekerjaan_nasabah' => $request->jabatan_pekerjaan_nasabah,
                'dept_perusahaan_nasabah' => $request->dept_perusahaan_nasabah,
                'mulai_bekerja_nasabah' => $request->mulai_bekerja_nasabah,
                'lamabekerja_tahun_nasabah' => $request->lamabekerja_tahun_nasabah,
                'lamabekerja_bulan_nasabah' => $request->lamabekerja_bulan_nasabah,
                'pengalaman_perusahaan_nasabah' => $request->pengalaman_perusahaan_nasabah,
                'totalbekerja_tahun_nasabah' => $request->totalbekerja_tahun_nasabah,
                'totalbekerja_bulan_nasabah' => $request->totalbekerja_bulan_nasabah,
                'pendidikan_terakhir_nasabah' => $request->pendidikan_terakhir_nasabah,
                'usia_nasabah' => $request->usia_nasabah,
                'usia_prapensiun_nasabah' => $request->usia_prapensiun_nasabah,
                'usia_pensiun_nasabah' => $request->usia_pensiun_nasabah,
                'sisa_pensiun_nasabah' => $request->sisa_pensiun_nasabah,
                'nama_atasan_nasabah' => $request->nama_atasan_nasabah,
                'notelp_atasan_nasabah' => $request->notelp_atasan_nasabah,
                'jenispekerjaan_atasan_nasabah' => $request->jenispekerjaan_atasan_nasabah,
                'alamat_perusahaan_nasabah' => $request->alamat_perusahaan_nasabah,
                'notelp_perusahaan_nasabah' => $request->notelp_perusahaan_nasabah,
                'penggajian_satu_nasabah' => $request->penggajian_satu_nasabah,
                'penggajian_dua_nasabah' => $request->penggajian_dua_nasabah,
                'perjanjian_kerjasama_nasabah' => $request->perjanjian_kerjasama_nasabah,
                'pengalaman_perusahaanlain_nasabah' => $request->pengalaman_perusahaanlain_nasabah,
                'sumber_penghasilan_nasabah' => $request->sumber_penghasilan_nasabah,
                'tanggungan_nasabah' => $request->tanggungan_nasabah,

                // 1.2 Pekerjaan pasangan
                'nama_perusahaan_pasangan' => $request->nama_perusahaan_pasangan,
                'bidang_perusahaan_pasangan' => $request->bidang_perusahaan_pasangan,
                'skala_perusahaan_pasangan' => $request->skala_perusahaan_pasangan,
                'jenis_pekerjaan_pasangan' => $request->jenis_pekerjaan_pasangan,
                'jabatan_pekerjaan_pasangan' => $request->jabatan_pekerjaan_pasangan,
                'dept_perusahaan_pasangan' => $request->dept_perusahaan_pasangan,
                'mulai_bekerja_pasangan' => $request->mulai_bekerja_pasangan,
                'lamabekerja_tahun_pasangan' => $request->lamabekerja_tahun_pasangan,
                'lamabekerja_bulan_pasangan' => $request->lamabekerja_bulan_pasangan,
                'pengalaman_perusahaan_pasangan' => $request->pengalaman_perusahaan_pasangan,
                'totalbekerja_tahun_pasangan' => $request->totalbekerja_tahun_pasangan,
                'totalbekerja_bulan_pasangan' => $request->totalbekerja_bulan_pasangan,
                'pendidikan_terakhir_pasangan' => $request->pendidikan_terakhir_pasangan,
                'usia_pasangan' => $request->usia_pasangan,
                'usia_prapensiun_pasangan' => $request->usia_prapensiun_pasangan,
                'usia_pensiun_pasangan' => $request->usia_pensiun_pasangan,
                'nama_atasan_pasangan' => $request->nama_atasan_pasangan,
                'notelp_atasan_pasangan' => $request->notelp_atasan_pasangan,
                'jenispekerjaan_atasan_pasangan' => $request->jenispekerjaan_atasan_pasangan,
                'alamat_perusahaan_pasangan' => $request->alamat_perusahaan_pasangan,
                'notelp_perusahaan_pasangan' => $request->notelp_perusahaan_pasangan,
                'penggajian_satu_pasangan' => $request->penggajian_satu_pasangan,
                'penggajian_dua_pasangan' => $request->penggajian_dua_pasangan,
                'pengalaman_perusahaanlain_pasangan' => $request->pengalaman_perusahaanlain_pasangan,

                // 1.3 Usaha nasabah/ pasangan
                'nama_perusahaan_usaha' => $request->nama_perusahaan_usaha,
                'bidang_perusahaan_usaha' => $request->bidang_perusahaan_usaha,
                'jabatan_usaha' => $request->jabatan_usaha,
                'mulai_usaha' => $request->mulai_usaha,
                'lama_usaha' => $request->lama_usaha,
                'total_lama_usaha' => $request->total_lama_usaha,
                'jumlah_karyawan_usaha' => $request->jumlah_karyawan_usaha,
                'keterangan_tambahan_usaha' => $request->keterangan_tambahan_usaha,
                'usaha_pensiun_usaha' => $request->usaha_pensiun_usaha,
                'nama_suppliersatu_usaha' => $request->nama_suppliersatu_usaha,
                'alamat_suppliersatu_usaha' => $request->alamat_suppliersatu_usaha,
                'notelp_suppliersatu_usaha' => $request->notelp_suppliersatu_usaha,
                'nama_supplierdua_usaha' => $request->nama_supplierdua_usaha,
                'alamat_supplierdua_usaha' => $request->alamat_supplierdua_usaha,
                'notelp_supplierdua_usaha' => $request->notelp_supplierdua_usaha,
                'nama_suppliertiga_usaha' => $request->nama_suppliertiga_usaha,
                'alamat_suppliertiga_usaha' => $request->alamat_suppliertiga_usaha,
                'notelp_suppliertiga_usaha' => $request->notelp_suppliertiga_usaha,
            ]);

            return redirect()->route('nasabah.pekerjaan.data')->with('success', '✅ Data nasabah berhasil diperbarui.');
        } catch (QueryException $e) {
            // Redirect balik dengan pesan error
            return redirect()->route('nasabah.pekerjaan.data')->with('error', '❌ Gagal menyimpan perubahan. Silakan coba lagi.');
        }
    }
}
