<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;

class UserController extends Controller
{
    //--- Admin ----//
    public function admin()
    {
        $admin = DB::table('users')->where('level', '=', "admin")->first();
        return view('layoutAdmin.user.admin.index', compact('admin'));
    }

    public function pengunjung()
    {
        $pengunjung = DB::table('users')->where('level', '=', "pengunjung")->orderBy('tanggal_daftar', 'desc')->get();
        return view('layoutAdmin.user.pengunjung.index', compact('pengunjung'));
    }

    public function editAdmin(User $user)
    {
        return view('layoutAdmin.user.admin.edit', compact('user'));
    }

    public function updateAdmin(Request $request, User $user)
    {
        $request->validate([
            'nama' => 'required|alpha|min:4',
            'jenis_kelamin' => 'required',
            'no_hp' => 'required|min:11|max:12',
            'alamat' => 'required',
            'username' => 'required',
        ]);

        User::where('id', $user->id)
            ->update([
                'nama' => $request->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'username' => $request->username,
            ]);

        if ($request->hasFile('foto')) {
            $imgName = $request->file('foto')->getClientOriginalName() . '-' . time() . '.' . $request->foto->extension();
            $request->file('foto')->move('img\User', $imgName);
            $user->foto = $imgName;
            $user->save();
        }
        return redirect('/user/admin')->with('success', 'Data Berhasil Diedit');
    }

    public function editPasswordAdmin(User $user)
    {
        return view('layoutAdmin.user.admin.editPassword', compact('user'));
    }

    public function updatePasswordAdmin(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        User::where('id', $user->id)
            ->update([
                'password' => bcrypt($request->password)
            ]);

        return redirect('/user/admin')->with('success', 'Password berhasil diganti');
    }
    //--- Admin ----//

    // -- Pengelola -- //
    public function pengelola()
    {
        $pengelola = DB::table('users')->where('level', '=', "pengelola")->first();
        return view('layoutAdmin.user.pengelola.index', compact('pengelola'));
    }

    public function createPengelola()
    {
        $pengelola = User::where('level', '=', 'pengelola')->first();
        if (empty($pengelola)) {
            return view('layoutAdmin.user.pengelola.create');
        } else {
            return redirect()->back()->with('warning', 'Data User Pengelola Sudah Ada');
        }
    }

    public function storePengelola(Request $request)
    {
        $request->validate([
            'nama' => 'required|alpha|min:2',
            'jenis_kelamin' => 'required',
            'no_hp' => 'required|max:12',
            'alamat' => 'required',
            'username' => 'required|unique:users|min:5',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = new \App\Models\User;
        $user->nama = $request->nama;
        $user->jenis_kelamin = $request->jenis_kelamin;
        $user->no_hp = $request->no_hp;
        $user->alamat = $request->alamat;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->level = 'pengelola';
        $user->tanggal_daftar = Carbon::now();
        $user->save();

        if ($request->hasFile('foto')) {
            $imgName = $request->file('foto')->getClientOriginalName() . '-' . time() . '.' . $request->foto->extension();
            $request->file('foto')->move('img\User', $imgName);
            $user->foto = $imgName;
            $user->save();
        }
        return redirect('/user/pengelola')->with('success', 'Pengelola berhasil ditambah');
    }

    public function editPengelola(User $user)
    {
        return view('layoutAdmin.user.pengelola.edit', compact('user'));
    }

    public function updatePengelola(Request $request, User $user)
    {
        $request->validate([
            'nama' => 'required|alpha|min:4',
            'jenis_kelamin' => 'required',
            'no_hp' => 'required|min:11|max:12',
            'alamat' => 'required',
            'username' => 'required',
        ]);

        User::where('id', $user->id)
            ->update([
                'nama' => $request->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'username' => $request->username,
            ]);

        if ($request->hasFile('foto')) {
            $imgName = $request->file('foto')->getClientOriginalName() . '-' . time() . '.' . $request->foto->extension();
            $request->file('foto')->move('img\User', $imgName);
            $user->foto = $imgName;
            $user->save();
        }
        return redirect('/user/pengelola')->with('success', 'Data Berhasil Diedit');
    }

    public function editPasswordPengelola(User $user)
    {
        return view('layoutAdmin.user.pengelola.editPassword', compact('user'));
    }

    public function updatePasswordPengelola(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        User::where('id', $user->id)
            ->update([
                'password' => bcrypt($request->password)
            ]);

        return redirect('/user/pengelola')->with('success', 'Password berhasil diganti');
    }

    public function destroyPengelola(User $pengelola)
    {
        User::destroy($pengelola->id);
        return redirect('/user/pengelola')->with('success', 'Data berhasil dihapus');
    }
    // -- Pengelola -- //


    //--- Pengunjung ---//
    public function profile()
    {
        $user = User::where('id', auth()->user()->id)->first();
        return view('layoutUser.profile.index', compact('user'));
    }

    public function editPengunjung()
    {
        $user = User::where('id', auth()->user()->id)->first();
        return view('layoutUser.profile.edit', compact('user'));
    }

    public function updatePengunjung(Request $request, User $user)
    {
        $request->validate([
            'nama' => 'required|alpha|min:2',
            'no_hp' => 'required|min:11|max:12',
            'username' => 'required|min:5',
        ]);

        User::where('id', $user->id)
            ->update([
                'nama' => $request->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'username' => $request->username,
            ]);

        if ($request->hasFile('foto')) {
            $imgName = $request->file('foto')->getClientOriginalName() . '-' . time() . '.' . $request->foto->extension();
            $request->file('foto')->move('img\User', $imgName);
            $user->foto = $imgName;
            $user->save();
        }
        return redirect('/profile')->with('status', 'Profile berhasil diedit');
    }

    public function editPassword(User $user)
    {
        return view('layoutUser.profile.gantiPassword', compact('user'));
    }

    public function updatePasswordPengunjung(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        User::where('id', $user->id)
            ->update([
                'password' => bcrypt($request->password)
            ]);

        return redirect('/profile')->with('status', 'Password berhasil diganti');
    }

    public function downloadPengunjung()
    {
        $pengunjung = User::where('level', '=', "pengunjung")->orderBy('tanggal_daftar', 'desc')->get();

        $pdf = PDF::loadView('layoutAdmin.user.pengunjung.download', ['pengunjung' => $pengunjung]);
        return $pdf->download('Pengunjung.pdf');
    }
    //--- Pengunjung ---//
}
