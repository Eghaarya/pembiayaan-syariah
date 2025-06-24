<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use App\Models\Murabahah\Pengajuan\MurabahahPengajuan;
use App\Models\Murabahah\Dokumentasi\MurabahahDokumentasi;

class MurabahahDokumentasiController extends Controller
{
    // Dokumentasi Murabahah
    public function indexDokumentasi()
    {
        $user = Auth::user();

        if ($user->tipe_akun == 'siswa') {
            $murabahah_dokumentasi = MurabahahDokumentasi::where('username', $user->username)
                ->where('kode_tempat', $user->kode_tempat)
                ->paginate(5);
        } elseif ($user->tipe_akun == 'pengajar') {
            $murabahah_dokumentasi = MurabahahDokumentasi::where('kode_tempat', $user->kode_tempat)
                ->paginate(5);
        } elseif ($user->tipe_akun == 'admin') {
            $murabahah_dokumentasi = MurabahahDokumentasi::paginate(5);
        } else {
            $murabahah_dokumentasi = collect();
        }

        return view('murabahah.dokumentasi.data', compact('murabahah_dokumentasi'));
    }

    public function uploadDokumentasi($kode_pengajuan)
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
                abort(403, 'Unauthorized');
            }
        } elseif ($user->tipe_akun === 'siswa') {
            if ($murabahah_pengajuan->username !== $user->username) {
                abort(403, 'Unauthorized');
            }
        }

        $pengajuan = MurabahahDokumentasi::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        return view('murabahah.dokumentasi.ubah', compact('pengajuan'));
    }

    public function updateDokumentasi(Request $request, $kode_pengajuan)
    {
        try {
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
                    abort(403, 'Unauthorized');
                }
            } elseif ($user->tipe_akun === 'siswa') {
                if ($murabahah_pengajuan->username !== $user->username) {
                    abort(403, 'Unauthorized');
                }
            }

            $murabahah_dokumentasi = MurabahahDokumentasi::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
            $rules = [
                'foto_nasabah' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'foto_identitas_nasabah' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'npwp_nasabah' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'foto_pasangan' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'foto_identitas_pasangan' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'npwp_pasangan' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

                'slip_gaji_nasabah' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'rekening_gaji_nasabah' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'tempat_kerja_usaha_nasabah' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'foto_surat_pegawai_tetap_nasabah' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'foto_tabungan_nasabah_3_bln_terakhir' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'slip_gaji_pasangan' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'rekening_gaji_pasangan' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'tempat_kerja_usaha_pasangan' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'foto_surat_pegawai_tetap_pasangan' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'foto_tabungan_pasangan_3_bln_terakhir' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

                'foto_depan_agunan' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'foto_dalam_agunan' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'foto_barat_agunan' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'foto_utara_agunan' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'foto_timur_agunan' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'foto_selatan_agunan' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'foto_jaminan_depan_kpm' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'foto_jaminan_atas_kpm' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'foto_jaminan_samping_kpm' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'foto_jaminan_rangka_mesin_kpm' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ];

            $request->validate($rules);
            $imageFields = [
                'foto_nasabah',
                'foto_identitas_nasabah',
                'npwp_nasabah',
                'foto_pasangan',
                'foto_identitas_pasangan',
                'npwp_pasangan',

                'slip_gaji_nasabah',
                'rekening_gaji_nasabah',
                'tempat_kerja_usaha_nasabah',
                'foto_surat_pegawai_tetap_nasabah',
                'foto_tabungan_nasabah_3_bln_terakhir',
                'slip_gaji_pasangan',
                'rekening_gaji_pasangan',
                'tempat_kerja_usaha_pasangan',
                'foto_surat_pegawai_tetap_pasangan',
                'foto_tabungan_pasangan_3_bln_terakhir',

                'foto_depan_agunan',
                'foto_dalam_agunan',
                'foto_barat_agunan',
                'foto_utara_agunan',
                'foto_timur_agunan',
                'foto_selatan_agunan',
                'foto_jaminan_depan_kpm',
                'foto_jaminan_atas_kpm',
                'foto_jaminan_samping_kpm',
                'foto_jaminan_rangka_mesin_kpm',
            ];

            foreach ($imageFields as $field) {
                if ($request->hasFile($field)) {
                    $file = $request->file($field);
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '_' . $kode_pengajuan . '_' . $field . '.' . $extension;

                    // Hapus file lama jika ada
                    if ($murabahah_dokumentasi->$field && Storage::disk('public')->exists('uploads/murabahah/' . $murabahah_dokumentasi->$field)) {
                        Storage::disk('public')->delete('uploads/murabahah/' . $murabahah_dokumentasi->$field);
                    }
                    $file->storeAs('uploads/murabahah', $filename, 'public');
                    $murabahah_dokumentasi->$field = $filename;
                }
            }

            $murabahah_dokumentasi->save();

            return redirect()->route('murabahah.dokumentasi.data')->with('success', '✅ Data berhasil diperbarui.');
        } catch (QueryException $e) {
            return redirect()->route('murabahah.dokumentasi.data')->with('error', '❌ Gagal menyimpan perubahan. Silakan coba lagi.');
        }
    }
}
