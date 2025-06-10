<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Nasabah\NasabahProfil;
use Illuminate\Database\QueryException;
use App\Models\Murabahah\Limac\MurabahahLimacCapital;
use App\Models\Murabahah\Limac\MurabahahLimacCapacity;
use App\Models\Murabahah\Pengajuan\MurabahahPengajuan;
use App\Models\Murabahah\Limac\MurabahahLimacCharacter;
use App\Models\Murabahah\Limac\MurabahahLimacCondition;
use App\Models\Murabahah\Dokumentasi\MurabahahDokumentasi;
use App\Models\Murabahah\Limac\MurabahahLimacCollateralKpr;
use App\Models\Murabahah\Limac\MurabahahLimacCollateralBermotor;

class MurabahahPengajuanController extends Controller
{

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
            MurabahahPengajuan::create([
                'kode_pengajuan' => $kodePengajuan,
                'kode_nasabah'   => $kodeNasabah,
                'nama_nasabah'   => $namaNasabah,

                'tanggal_pengajuan'  => Carbon::parse($request->tanggal_pengajuan),

                'username'       => $user->username,
                'kode_tempat'    => $user->kode_tempat,
            ]);

            MurabahahLimacCharacter::create([
                'kode_pengajuan' => $kodePengajuan,
                'kode_nasabah'   => $kodeNasabah,
                'nama_nasabah'   => $namaNasabah,

                'username'       => $user->username,
                'kode_tempat'    => $user->kode_tempat,
            ]);

            MurabahahLimacCapacity::create([
                'kode_pengajuan' => $kodePengajuan,
                'kode_nasabah'   => $kodeNasabah,
                'nama_nasabah'   => $namaNasabah,

                'username'       => $user->username,
                'kode_tempat'    => $user->kode_tempat,
            ]);

            MurabahahLimacCapital::create([
                'kode_pengajuan' => $kodePengajuan,
                'kode_nasabah'   => $kodeNasabah,
                'nama_nasabah'   => $namaNasabah,

                'username'       => $user->username,
                'kode_tempat'    => $user->kode_tempat,
            ]);

            MurabahahLimacCollateralKpr::create([
                'kode_pengajuan' => $kodePengajuan,
                'kode_nasabah'   => $kodeNasabah,
                'nama_nasabah'   => $namaNasabah,

                'username'       => $user->username,
                'kode_tempat'    => $user->kode_tempat,
            ]);

            MurabahahLimacCollateralBermotor::create([
                'kode_pengajuan' => $kodePengajuan,
                'kode_nasabah'   => $kodeNasabah,
                'nama_nasabah'   => $namaNasabah,

                'username'       => $user->username,
                'kode_tempat'    => $user->kode_tempat,
            ]);

            MurabahahLimacCondition::create([
                'kode_pengajuan' => $kodePengajuan,
                'kode_nasabah'   => $kodeNasabah,
                'nama_nasabah'   => $namaNasabah,

                'username'       => $user->username,
                'kode_tempat'    => $user->kode_tempat,
            ]);

            MurabahahDokumentasi::create([
                'kode_pengajuan' => $kodePengajuan,
                'kode_nasabah'   => $kodeNasabah,
                'nama_nasabah'   => $namaNasabah,

                'username'       => $user->username,
                'kode_tempat'    => $user->kode_tempat,
            ]);

            return redirect()->route('murabahah.pengajuan.data')->with('success', '✅ Data pengajuan berhasil ditambahkan.');
        } catch (QueryException $e) {
            return redirect()->route('murabahah.pengajuan.data')->with('error', '❌ Gagal menambahkan data pengajuan. Silakan coba lagi.');
        }
    }

    public function editPengajuan($kode_pengajuan)
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

        $pengajuan = MurabahahPengajuan::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        $nasabahs = NasabahProfil::select('kode_nasabah', 'nama_nasabah')->get();

        return view('murabahah.pengajuan.ubah', compact('pengajuan', 'nasabahs'));
    }

    public function updatePengajuan(Request $request, $kode_pengajuan)
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

        $parts = explode('-', $request->nasabah_pengajuan, 2);
        $kodeNasabah = trim($parts[0]);
        $namaNasabah = isset($parts[1]) ? trim($parts[1]) : '';

        try {
            MurabahahPengajuan::where('kode_pengajuan', $kode_pengajuan)->update([
                'kode_nasabah'       => $kodeNasabah,
                'nama_nasabah'       => $namaNasabah,
                'tanggal_pengajuan' => $request->tanggal_pengajuan ? Carbon::parse($request->tanggal_pengajuan) : null,
                'keputusan'       => $request->keputusan,
                'tanggal_pencairan' => $request->tanggal_pencairan ? Carbon::parse($request->tanggal_pencairan) : null,

            ]);

            return redirect()->route('murabahah.pengajuan.data')->with('success', $request->tanggal_pencairan . '✅ Data pengajuan berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('murabahah.pengajuan.data')->with('error', '❌ Gagal memperbarui data pengajuan.');
        }
    }

    public function destroyPengajuan($kode_pengajuan)
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

        $mudharabah_pengajuan = MurabahahPengajuan::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        $mudharabah_pengajuan->delete();

        return redirect()->route('murabahah.pengajuan.data')->with('success', 'Data nasabah berhasil dihapus.');
    }

    public function indexAngsuran($kode_pengajuan)
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

        $pengajuan = MurabahahPengajuan::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        $angsuran = MurabahahLimacCapital::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        return view('murabahah.pengajuan.angsuran', compact('pengajuan', 'angsuran'));
    }
}
