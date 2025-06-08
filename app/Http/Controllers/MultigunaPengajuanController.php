<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Nasabah\NasabahProfil;
use Illuminate\Database\QueryException;
use App\Models\Multiguna\Limac\MultigunaLimacCapital;
use App\Models\Multiguna\Limac\MultigunaLimacCapacity;
use App\Models\Multiguna\Pengajuan\MultigunaPengajuan;
use App\Models\Multiguna\Limac\MultigunaLimacCharacter;
use App\Models\Multiguna\Limac\MultigunaLimacCondition;
use App\Models\Multiguna\Limac\MultigunaLimacCollateral;

class MultigunaPengajuanController extends Controller
{

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
            MultigunaPengajuan::create([
                'kode_pengajuan' => $kodePengajuan,
                'kode_nasabah'   => $kodeNasabah,
                'nama_nasabah'   => $namaNasabah,

                'tanggal_pengajuan'  => Carbon::parse($request->tanggal_pengajuan),

                'username'       => $user->username,
                'kode_tempat'    => $user->kode_tempat,
            ]);

            MultigunaLimacCharacter::create([
                'kode_pengajuan' => $kodePengajuan,
                'kode_nasabah'   => $kodeNasabah,
                'nama_nasabah'   => $namaNasabah,

                'username'       => $user->username,
                'kode_tempat'    => $user->kode_tempat,
            ]);

            MultigunaLimacCapacity::create([
                'kode_pengajuan' => $kodePengajuan,
                'kode_nasabah'   => $kodeNasabah,
                'nama_nasabah'   => $namaNasabah,

                'username'       => $user->username,
                'kode_tempat'    => $user->kode_tempat,
            ]);

            MultigunaLimacCapital::create([
                'kode_pengajuan' => $kodePengajuan,
                'kode_nasabah'   => $kodeNasabah,
                'nama_nasabah'   => $namaNasabah,

                'username'       => $user->username,
                'kode_tempat'    => $user->kode_tempat,
            ]);

            MultigunaLimacCollateral::create([
                'kode_pengajuan' => $kodePengajuan,
                'kode_nasabah'   => $kodeNasabah,
                'nama_nasabah'   => $namaNasabah,

                'username'       => $user->username,
                'kode_tempat'    => $user->kode_tempat,
            ]);

            MultigunaLimacCondition::create([
                'kode_pengajuan' => $kodePengajuan,
                'kode_nasabah'   => $kodeNasabah,
                'nama_nasabah'   => $namaNasabah,

                'username'       => $user->username,
                'kode_tempat'    => $user->kode_tempat,
            ]);

            return redirect()->route('multiguna.pengajuan.data')->with('success', '✅ Data pengajuan berhasil ditambahkan.');
        } catch (QueryException $e) {
            return redirect()->route('multiguna.pengajuan.data')->with('error', $kodePengajuan . '❌ Gagal menambahkan data pengajuan. Silakan coba lagi.');
        }
    }

    public function editPengajuan($kode_pengajuan)
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

        $pengajuan = MultigunaPengajuan::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        $nasabahs = NasabahProfil::select('kode_nasabah', 'nama_nasabah')->get();

        return view('multiguna.pengajuan.ubah', compact('pengajuan', 'nasabahs'));
    }

    public function updatePengajuan(Request $request, $kode_pengajuan)
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

        $parts = explode('-', $request->nasabah_pengajuan, 2);
        $kodeNasabah = trim($parts[0]);
        $namaNasabah = isset($parts[1]) ? trim($parts[1]) : '';

        try {
            MultigunaPengajuan::where('kode_pengajuan', $kode_pengajuan)->update([
                'kode_nasabah'       => $kodeNasabah,
                'nama_nasabah'       => $namaNasabah,
                'tanggal_pengajuan' => $request->tanggal_pengajuan ? Carbon::parse($request->tanggal_pengajuan) : null,
                'keputusan'       => $request->keputusan,
                'tanggal_pencairan' => $request->tanggal_pencairan ? Carbon::parse($request->tanggal_pencairan) : null,

            ]);

            return redirect()->route('multiguna.pengajuan.data')->with('success', $request->tanggal_pencairan . '✅ Data pengajuan berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('multiguna.pengajuan.data')->with('error', '❌ Gagal memperbarui data pengajuan.');
        }
    }

    public function destroyPengajuan($kode_pengajuan)
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

        $multiguna_pengajuan = MultigunaPengajuan::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        $multiguna_pengajuan->delete();

        return redirect()->route('multiguna.pengajuan.data')->with('success', 'Data nasabah berhasil dihapus.');
    }

    public function indexAngsuran($kode_pengajuan)
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

        $pengajuan = MultigunaPengajuan::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        $angsuran = MultigunaLimacCapital::where('kode_pengajuan', $kode_pengajuan)->firstOrFail();
        return view('multiguna.pengajuan.angsuran', compact('pengajuan', 'angsuran'));
    }
}
