<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|min:3',
            'kode_tempat' => 'required|exists:tempats,kode_tempat'
        ], [
            'username.unique' => 'Username sudah digunakan, pake username lain.',
            'password.min' => 'Password minimal harus terdiri dari 3 karakter.',
            'kode_tempat.exists' => 'Kode tempat tidak ditemukan. Pastikan memilih tempat yang valid.',
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'kode_tempat' => $request->kode_tempat,
            'tipe_akun' => 'siswa',
        ]);

        return redirect()->route('login')->with('success', 'Register berhasil!');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        $user = User::where('username', $credentials['username'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);
            return redirect()->route('nasabah.profil.data')->with('success', ucwords('Selamat datang ' . $credentials['username'] . '. Aplikasi Pembiayaan Syariah'));
        }

        return back()->withErrors(['login' => 'Username atau password salah']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
