<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $lokasi = Lokasi::all();

        if (!Auth::check() || Auth::user()->level == 'pengunjung') {
            return view('index', [
                'lokasi' => $lokasi,
                'active' => 'home'
            ]);
        } elseif (Auth::user()->level == 'admin') {
            return redirect('/dashboardAdmin');
        } elseif (Auth::user()->level == 'pengelola') {
            return redirect('/dashboardPengelola');
        }
    }
}
