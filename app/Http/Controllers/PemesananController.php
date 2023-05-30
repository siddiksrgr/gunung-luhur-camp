<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\PesanTiket;
use App\Models\SewaAlat;
use Barryvdh\DomPDF\Facade as PDF;

class PemesananController extends Controller
{
    public function index()
    {
        $pemesanan = Pemesanan::where('user_id', auth()->user()->id)->where('status_pesan', 0)->first();

        if (empty($pemesanan)) {
            return view('layoutUser.pemesanan.kosong', ['active' => 'pemesanan']);
        } else {
            $pesan_tiket = PesanTiket::where('pemesanan_id', $pemesanan->id)->first();
            $sewa_tenda = SewaAlat::where('pemesanan_id', $pemesanan->id)->get();
        }

        return view('layoutUser.pemesanan.index', [
            'pemesanan' => $pemesanan,
            'pesan_tiket' => $pesan_tiket,
            'sewa_tenda' => $sewa_tenda,
        ]);
    }

    public function indexAdmin()
    {
        $pemesanan = Pemesanan::where('status_pesan', 0)
            ->orWhere('status_pesan', 1)
            ->orWhere('status_pesan', 2)
            ->orderBy('tanggal_pesan', 'desc')
            ->get();

        return view('layoutAdmin.pemesanan_tiket.index', [
            'pemesanan' => $pemesanan
        ]);
    }

    public function showAdmin(Pemesanan $pemesanan)
    {
        $sewa_tenda = $pemesanan->sewaAlat;
        return view('layoutAdmin.pemesanan_tiket.detail', [
            'pemesanan' => $pemesanan,
            'sewa_tenda' => $sewa_tenda
        ]);
    }

    public function download()
    {
        $pemesanan = Pemesanan::where('status_pesan', 0)
            ->orWhere('status_pesan', 1)
            ->orWhere('status_pesan', 2)
            ->orderBy('tanggal_pesan', 'desc')
            ->get();

        $pdf = PDF::loadView('layoutAdmin.pemesanan_tiket.download', compact('pemesanan'))->setPaper('a4', 'landscape');
        return $pdf->download('Pemesanan Tiket.pdf');
    }
}
