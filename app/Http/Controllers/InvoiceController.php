<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\PesanTiket;
use App\Models\SewaAlat;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    public function download(Pemesanan $pemesanan)
    {
        $pemesanan = Pemesanan::where('user_id', auth()->user()->id)->where('status_pesan', 0)->first();

        $pesan_tiket = PesanTiket::where('pemesanan_id', $pemesanan->id)->first();
        $sewa_tenda = SewaAlat::where('pemesanan_id', $pemesanan->id)->get();
        $tgl = Carbon::now()->format('d-m-Y');

        if (count($sewa_tenda) == 0) {
            $pdf = PDF::loadView('layoutUser.invoice.tiket_masuk', [
                'pemesanan' => $pemesanan,
                'pesan_tiket' => $pesan_tiket,
            ]);
            return $pdf->download('Invoice (' . $tgl . ').pdf');
        } else {
            $pdf = PDF::loadView('layoutUser.invoice.semuanya', [
                'pemesanan' => $pemesanan,
                'pesan_tiket' => $pesan_tiket,
                'sewa_tenda' => $sewa_tenda
            ]);
            return $pdf->download('Invoice (' . $tgl . ').pdf');
        }
    }
}
