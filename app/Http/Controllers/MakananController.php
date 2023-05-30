<?php

namespace App\Http\Controllers;

use App\Models\Makanan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class MakananController extends Controller
{
    public function index()
    {
        $makanan = Makanan::orderBy('tanggal_update', 'desc')->get();
        return view('layoutAdmin.makanan.index', compact('makanan'));
    }

    public function create()
    {
        return view('layoutAdmin.makanan.create');
    }

    public function store(Request $request)
    {
        $makanan = new \App\Models\Makanan;
        $makanan->nama = $request->nama;
        $makanan->harga = $request->harga;
        $makanan->tersedia = $request->tersedia;
        $makanan->keterangan = $request->keterangan;
        $makanan->tanggal_input = Carbon::now();
        $makanan->tanggal_update = Carbon::now();
        $makanan->save();
        return redirect('/makanan')->with('success', 'Data berhasil ditambah');
    }

    public function show(Makanan $makanan)
    {
        return view('layoutAdmin.makanan.detail', compact('makanan'));
    }

    public function edit(Makanan $makanan)
    {
        return view('layoutAdmin.makanan.edit', compact('makanan'));
    }

    public function update(Request $request, Makanan $makanan)
    {
        Makanan::where('id', $makanan->id)
            ->update([
                'nama' => $request->nama,
                'harga' => $request->harga,
                'tersedia' => $request->tersedia,
                'keterangan' => $request->keterangan,
                'tanggal_update' => Carbon::now()
            ]);
        return redirect('/makanan')->with('success', 'Data berhasil diedit');
    }

    public function destroy(Makanan $makanan)
    {
        Makanan::destroy($makanan->id);
        return redirect('/makanan')->with('success', 'Data berhasil dihapus');
    }

    public function masuk()
    {
        $makanan = Makanan::all();
        return view('layoutAdmin.makanan.masuk', compact('makanan'));
    }

    public function tambah_stok(Request $request)
    {
        $makanan = Makanan::find($request->makanan);
        $makanan->tersedia = $makanan->tersedia + $request->tambah_stok;
        $makanan->save();
        return redirect('/makanan')->with('success', 'Stok Berhasil Ditambah');
    }


    public function download()
    {
        $makanan = Makanan::orderBy('tanggal_update', 'desc')->get();

        $pdf = PDF::loadView('layoutAdmin.makanan.download', ['makanan' => $makanan]);
        return $pdf->download('Makanan.pdf');
    }
}
