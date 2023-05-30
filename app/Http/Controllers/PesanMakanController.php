<?php

namespace App\Http\Controllers;

use App\Models\Makanan;
use App\Models\CheckIn;
use App\Models\PesanMakan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class PesanMakanController extends Controller
{
    public function index()
    {
        $pesan_makan = PesanMakan::orderBy('tanggal_pesan', 'desc')->get();
        return view('layoutAdmin.pemesanan_makan.index', compact('pesan_makan'));
    }

    public function create()
    {
        $checkIn = CheckIn::where('status', 0)->get();

        if (count($checkIn) != null) {
            $makanan = Makanan::all();
            return view('layoutAdmin.pemesanan_makan.create', [
                'makanan' => $makanan,
                'checkIn' => $checkIn
            ]);
        } else {
            return redirect()->back()->with('warning', 'Tiket User Belum Ada Yang Check In');
        }
    }

    public function store(Request $request)
    {
        $makanan = Makanan::find($request->makanan);
        //insert ke tabel pesan_makan
        $pesanMakan = new \App\Models\PesanMakan;
        $pesanMakan->user_id = $request->user;
        $pesanMakan->makanan_id = $makanan->id;
        $pesanMakan->jumlah = $request->jumlah;
        $pesanMakan->total_bayar = $request->jumlah * $makanan->harga;
        $pesanMakan->tanggal_pesan = Carbon::now();
        $pesanMakan->save();

        $makanan->tersedia = $makanan->tersedia - $request->jumlah;
        $makanan->save();

        return redirect('/pemesanan_makan')->with('success', 'Pemesanan makanan berhasil dibuat');
    }

    public function download()
    {
        $pesan_makan = PesanMakan::orderBy('tanggal_pesan', 'desc')->get();
        $pdf = PDF::loadView('layoutAdmin.pemesanan_makan.download', compact('pesan_makan'));
        return $pdf->download('Pemesanan Makan.pdf');
    }
}
