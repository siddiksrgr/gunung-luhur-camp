<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;

class TiketSayaController extends Controller
{
    public function index()
    {
        $pemesanan = Pemesanan::where('user_id', auth()->user()->id)->where('status_pesan', 2)->orderBy('tanggal_pesan', 'desc')->get();

        if (count($pemesanan) == 0) {
            return view('layoutUser.tiket.kosong');
        } else
            return view('layoutUser.tiket.index', [
                'pemesanan' => $pemesanan
            ]);
    }

    public function download(Pemesanan $pemesanan)
    {
        $sewa_tenda = $pemesanan->sewaAlat;
        $tgl = Carbon::now()->format('d-m-Y');

        if (empty($pemesanan->sewaAlat)) {
            $pdf = PDF::loadView('layoutUser.tiket.download.tiket_masuk', [
                'pemesanan' => $pemesanan,
            ]);
            return $pdf->download('Tiket (' . $tgl . ').pdf');
        } else {
            $pdf = PDF::loadView('layoutUser.tiket.download.semuanya', [
                'pemesanan' => $pemesanan,
                'sewa_tenda' => $sewa_tenda
            ]);
            return $pdf->download('Tiket (' . $tgl . ').pdf');
        }
    }
}
