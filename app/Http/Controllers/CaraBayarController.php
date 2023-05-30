<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;

class CaraBayarController extends Controller
{
    public function index()
    {
        $pemesanan = Pemesanan::where('user_id', auth()->user()->id)->where('status_pesan', 0)->first();

        $kode_unik = $pemesanan->kode_unik;
        $total = $pemesanan->total_bayar;

        if ($total == 0) {
            return redirect()->back();
        } else
            return view('layoutUser.bayar.index', [
                'kode_unik' => $kode_unik,
                'total' => $total,
                'active' => 'bayar'
            ]);
    }
}
