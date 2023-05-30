<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class BarangController extends Controller
{

    public function index()
    {
        $barang = Barang::orderBy('tanggal_update', 'desc')->get();
        return view('layoutAdmin.barang.index', compact('barang'));
    }


    public function create()
    {
        return view('layoutAdmin.barang.create');
    }


    public function store(Request $request)
    {
        $barang = new \App\Models\Barang;
        $barang->nama = $request->nama;
        $barang->harga = $request->harga;
        $barang->stok = $request->stok;
        $barang->satuan = $request->satuan;
        $barang->tanggal_input = Carbon::now();
        $barang->tanggal_update = Carbon::now();
        $barang->save();
        return redirect('/brg_hbs_pakai')->with('success', 'Data Berhasil Ditambahkan');
    }


    public function edit(Barang $barang)
    {
        return view('layoutAdmin.barang.edit', compact('barang'));
    }


    public function update(Request $request, Barang $barang)
    {
        Barang::where('id', $barang->id)
            ->update([
                'nama' => $request->nama,
                'harga' => $request->harga,
                'satuan' => $request->satuan,
                'tanggal_update' => Carbon::now()
            ]);
        return redirect('/brg_hbs_pakai')->with('success', 'Data Berhasil Diedit');
    }


    public function destroy(Barang $barang)
    {
        Barang::destroy($barang->id);
        return redirect('/brg_hbs_pakai')->with('success', 'Data Berhasil Dihapus');
    }

    public function masuk()
    {
        $barang = Barang::all();
        return view('layoutAdmin.barang.masuk', compact('barang'));
    }

    public function tambah_stok(Request $request)
    {
        $barang = Barang::find($request->barang);
        $barang->stok = $barang->stok + $request->tambah_stok;
        $barang->save();
        return redirect('/brg_hbs_pakai')->with('success', 'Stok Berhasil Ditambah');
    }

    public function download()
    {
        $barang = Barang::orderBy('tanggal_update', 'desc')->get();

        $pdf = PDF::loadView('layoutAdmin.barang.download', ['barang' => $barang]);
        return $pdf->download('Barang Habis Pakai.pdf');
    }
}
