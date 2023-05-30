<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use \App\Models\BeliBarang;
use App\Models\CheckIn;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;

class BeliBarangController extends Controller
{

    public function index()
    {
        $beliBarang = BeliBarang::orderBy('tanggal_beli', 'desc')->get();
        return view('layoutAdmin.pembelian_barang.index', compact('beliBarang'));
    }


    public function create()
    {
        $checkIn = CheckIn::where('status', 0)->get();

        if (count($checkIn) != null) {
            $barang = Barang::all();
            return view('layoutAdmin.pembelian_barang.create', [
                'barang' => $barang,
                'checkIn' => $checkIn
            ]);
        } else {
            return redirect()->back()->with('warning', 'Tiket User Belum Ada Yang Check In');
        }
    }


    public function store(Request $request)
    {
        $barang = Barang::where('id', $request->barang)->first();
        $request->validate([
            'jumlah' => 'numeric|max:' . $barang->stok . ''
        ]);

        $beliBarang = new \App\Models\BeliBarang;
        $beliBarang->user_id = $request->user;
        $beliBarang->barang_id = $request->barang;
        $harga = Barang::find($request->barang)->harga;
        $beliBarang->jumlah = $request->jumlah;
        $beliBarang->total_bayar = $harga * $request->jumlah;
        $beliBarang->tanggal_beli = Carbon::now();
        $beliBarang->save();

        $barang = Barang::find($request->barang);
        $barang->stok = $barang->stok - $request->jumlah;
        $barang->save();

        return redirect('/beli_barang')->with('success', 'Data berhasil ditambahkan');
    }

    public function download()
    {
        $beliBarang = BeliBarang::orderBy('tanggal_beli', 'desc')->get();
        $pdf = PDF::loadView('layoutAdmin.pembelian_barang.download', compact('beliBarang'));
        return $pdf->download('Pembelian Barang Habis Pakai.pdf');
    }
}
