<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tempat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    // 1.1 User (Akun) methods
    public function indexAkun()
    {
        $user = auth()->user();

        if ($user->tipe_akun == 'pengajar') {
            $akuns = User::where('kode_tempat', $user->kode_tempat)
                ->where('tipe_akun', '!=', 'admin')
                ->orderBy('kode_tempat')
                ->orderBy('tipe_akun')
                ->paginate(10);
        } elseif ($user->tipe_akun == 'admin') {
            $akuns = User::orderBy('kode_tempat')
                ->orderBy('tipe_akun')
                ->paginate(10);
        } else {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.akun.data', compact('akuns'));
    }

    public function createAkun()
    {
        $user = auth()->user();

        if ($user->tipe_akun == 'pengajar') {
            $tipe_akun_options = ['siswa', 'pengajar'];
            $kode_tempat = $user->kode_tempat;
            $tempats = null;
        } elseif ($user->tipe_akun == 'admin') {
            $tipe_akun_options = ['siswa', 'pengajar', 'admin'];
            $tempats = \App\Models\Tempat::all();
            $kode_tempat = null;
        } else {
            abort(403, 'Unauthorized');
        }

        return view('admin.akun.tambah', compact('tipe_akun_options', 'kode_tempat', 'tempats'));
    }

    public function storeAkun(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|min:3',
            'kode_tempat' => 'nullable|exists:tempats,kode_tempat',
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'kode_tempat' => $request->tipe_akun == 'admin' ? null : $request->kode_tempat,
            'tipe_akun' => $request->tipe_akun,
        ]);

        return redirect()->route('admin.akun.data')->with('success', 'Akun berhasil ditambah.');
    }

    public function editAkun($username)
    {
        $user = auth()->user();
        $akun = User::where('username', $username)->firstOrFail();

        if ($user->tipe_akun == 'pengajar') {
            if ($akun->kode_tempat !== $user->kode_tempat) {
                abort(403, 'Unauthorized');
            }
            $tipe_akun_options = ['siswa', 'pengajar'];
            $kode_tempat = $user->kode_tempat;
            $tempats = null;
        } elseif ($user->tipe_akun == 'admin') {
            $tipe_akun_options = ['siswa', 'pengajar', 'admin'];
            $tempats = \App\Models\Tempat::all();
            $kode_tempat = null;
        } else {
            abort(403, 'Unauthorized');
        }

        return view('admin.akun.ubah', compact('akun', 'tipe_akun_options', 'kode_tempat', 'tempats'));
    }

    public function updateAkun(Request $request, $username)
    {
        $user = auth()->user();
        $akun = User::where('username', $username)->firstOrFail();

        if ($user->tipe_akun == 'pengajar' && $akun->kode_tempat !== $user->kode_tempat) {
            abort(403, 'Unauthorized');
        }

        // Set rules tipe_akun sesuai user login
        if ($user->tipe_akun == 'pengajar') {
            $rules = [
                'password' => 'nullable|min:3',
                'kode_tempat' => 'required|exists:tempats,kode_tempat',
                'tipe_akun' => 'required|in:siswa,pengajar',
            ];
        } elseif ($user->tipe_akun == 'admin') {
            $rules = [
                'password' => 'nullable|min:3',
                'kode_tempat' => 'nullable|exists:tempats,kode_tempat',
                'tipe_akun' => 'nullable|in:siswa,pengajar,admin',
            ];
        } else {
            abort(403, 'Unauthorized');
        }

        $request->validate($rules);

        $akun->kode_tempat = $request->kode_tempat;

        if ($request->password) {
            $akun->password = Hash::make($request->password);
        }

        $akun->tipe_akun = $request->tipe_akun;

        $akun->save();

        return redirect()->route('admin.akun.data')->with('success', 'Akun berhasil diupdate.');
    }

    public function destroyAkun($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $user->delete();

        return redirect()->route('admin.akun.data')->with('success', 'Akun berhasil dihapus.');
    }

    // 1.2 Tempat methods
    // Middleware agar hanya admin bisa akses method ini
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (auth()->user()->tipe_akun !== 'admin') {
                abort(403, 'Unauthorized');
            }
            return $next($request);
        })->only(['indexTempat', 'createTempat', 'storeTempat', 'editTempat', 'updateTempat', 'destroyTempat']);
    }

    // Tampil data tempat
    public function indexTempat()
    {
        $tempats = Tempat::orderBy('kode_tempat')->paginate(10);
        return view('admin.tempat.data', compact('tempats'));
    }

    // Form tambah tempat
    public function createTempat()
    {
        return view('admin.tempat.tambah');
    }

    // Simpan tempat baru
    public function storeTempat(Request $request)
    {
        $request->validate([
            'kode_tempat' => 'required|unique:tempats,kode_tempat',
            'nama_tempat' => 'nullable|string|max:255',
        ]);

        Tempat::create([
            'kode_tempat' => $request->kode_tempat,
            'nama_tempat' => $request->nama_tempat,
        ]);

        return redirect()->route('admin.tempat.data')->with('success', 'Tempat berhasil ditambahkan.');
    }

    // Form edit tempat
    public function editTempat($kode_tempat)
    {
        $tempat = Tempat::where('kode_tempat', $kode_tempat)->firstOrFail();
        return view('admin.tempat.ubah', compact('tempat'));
    }

    // Update tempat
    public function updateTempat(Request $request, $kode_tempat)
    {
        $tempat = Tempat::where('kode_tempat', $kode_tempat)->firstOrFail();

        $request->validate([
            'kode_tempat' => 'required|unique:tempats,kode_tempat,' . $tempat->id,
            'nama_tempat' => 'nullable|string|max:255',
        ]);

        $tempat->kode_tempat = $request->kode_tempat;
        $tempat->nama_tempat = $request->nama_tempat;
        $tempat->save();

        return redirect()->route('admin.tempat.data')->with('success', 'Tempat berhasil diupdate.');
    }

    // Hapus tempat
    public function destroyTempat($kode_tempat)
    {
        $tempat = Tempat::where('kode_tempat', $kode_tempat)->firstOrFail();
        $tempat->delete();

        return redirect()->route('admin.tempat.data')->with('success', 'Tempat berhasil dihapus.');
    }
}
