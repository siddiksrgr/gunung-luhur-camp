<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function getLogin()
    {
        return view('layoutUser.login.index', ['active' => 'login']);
    }

    public function postLogin(Request $request)
    {
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/');
        }
        return back()->with('status_salah', 'Username atau password salah, silahkan masukkan username dan password yang benar !');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function getRegister()
    {
        return view('layoutUser.daftar.index', ['active' => 'daftar']);
    }

    public function postRegister(Request $request)
    {
        $request->validate([
            'nama' => 'required|alpha|min:1',
            'jenis_kelamin' => 'required',
            'no_hp' => 'required|max:12|min:11',
            'alamat' => 'required',
            'username' => 'required|unique:users|min:1',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = new \App\Models\User;
        $user->nama = $request->nama;
        $user->jenis_kelamin = $request->jenis_kelamin;
        $user->no_hp = $request->no_hp;
        $user->alamat = $request->alamat;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->level = 'pengunjung';
        $user->tanggal_daftar = Carbon::now();
        $user->save();

        if ($request->hasFile('foto')) {
            $imgName = $request->file('foto')->getClientOriginalName() . '-' . time() . '.' . $request->foto->extension();
            $request->file('foto')->move('img\User', $imgName);
            $user->foto = $imgName;
            $user->save();
        }
        return redirect('login')->with('status', 'Akun berhasil terdaftar, silahkan login !');
    }
}
