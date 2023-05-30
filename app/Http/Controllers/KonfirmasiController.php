<?php

namespace App\Http\Controllers;

use App\Models\Konfirmasi;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;

class KonfirmasiController extends Controller
{
    public function indexAdmin()
    {
        $konfirmasi = Konfirmasi::orderBy('tanggal_bayar', 'desc')->get();
        return view('layoutAdmin.konfirmasi_bayar.index', compact('konfirmasi'));
    }

    public function indexUser()
    {
        $pemesanan = Pemesanan::where('user_id', auth()->user()->id)->where('status_pesan', 1)->orderBy('tanggal_pesan', 'desc')->get();

        if (count($pemesanan) == 0) {
            return view('layoutUser.konfirmasi.kosong');
        } else
            return view('layoutUser.konfirmasi.index', [
                'pemesanan' => $pemesanan
            ]);
    }

    public function create()
    {
        $pemesanan = Pemesanan::where('user_id', auth()->user()->id)->where('status_pesan', 0)->first();
        $total = $pemesanan->total_bayar;

        if ($total == 0) {
            return redirect()->back();
        } else
            return view('layoutUser.konfirmasi.create')
                ->with('pemesanan', $pemesanan)
                ->with('total', $total)
                ->with('active', 'konfirmasi');
    }

    public function store(Request $request)
    {
        $pemesanan = Pemesanan::where('user_id', auth()->user()->id)->where('status_pesan', 0)->first();

        $konfirmasi = new \App\Models\Konfirmasi;
        $konfirmasi->pemesanan_id = $pemesanan->id;

        // time() digunakan untuk menghindari nama file yang sama.
        if ($request->hasFile('bukti')) {
            $imgName = $request->file('bukti')->getClientOriginalName() . '-' . time() . '.' . $request->bukti->extension();
            $request->file('bukti')->move('img\BuktiKonfirmasi', $imgName);
            $konfirmasi->bukti = $imgName;
        }
        $konfirmasi->tanggal_bayar = Carbon::now();
        $konfirmasi->save();

        //update status pesan di tabel pemesanan
        $pemesanan->status_pesan = 1;
        $pemesanan->save();

        return redirect('/konfirmasi/user')->with('status', 'Bukti konfirmasi telah terkirim, silahkan menunggu untuk divalidasi oleh admin camp !');
    }

    public function showUser(Pemesanan $pemesanan)
    {
        $sewa_tenda = $pemesanan->sewaAlat;
        return view('layoutUser.konfirmasi.detail', [
            'pemesanan' => $pemesanan,
            'sewa_tenda' => $sewa_tenda
        ]);
    }

    public function showAdmin(Konfirmasi $konfirmasi)
    {
        return view('layoutAdmin.konfirmasi_bayar.detail', [
            'konfirmasi' => $konfirmasi
        ]);
    }

    public function download(Pemesanan $pemesanan)
    {
        $sewa_tenda = $pemesanan->sewaAlat;
        $tgl = Carbon::now()->format('d-m-Y');

        if (empty($pemesanan->sewaAlat)) {
            $pdf = PDF::loadView('layoutUser.kwitansi.tiket_masuk', [
                'pemesanan' => $pemesanan,
                'sewa_tenda' => $sewa_tenda
            ]);
            return $pdf->download('Kwitansi (' . $tgl . ').pdf');
        } else {
            $pdf = PDF::loadView('layoutUser.kwitansi.semuanya', [
                'pemesanan' => $pemesanan,
                'sewa_tenda' => $sewa_tenda
            ]);
            return $pdf->download('Kwitansi (' . $tgl . ').pdf');
        }
    }

    public function downloadAdmin()
    {
        $konfirmasi = Konfirmasi::orderBy('tanggal_bayar', 'desc')->get();
        $pdf = PDF::loadView('layoutAdmin.konfirmasi_bayar.download', compact('konfirmasi'));
        return $pdf->download('Konfirmasi Pembayaran.pdf');
    }
}
