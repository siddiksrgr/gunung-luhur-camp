<?php

namespace App\Http\Controllers;

use App\Models\HargaTiket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class HargaTiketController extends Controller
{

    public function index()
    {
        $hargaTiket = HargaTiket::all();
        return view('layoutAdmin.harga_tiket.index', compact('hargaTiket'));
    }

    public function create()
    {
        $hargaTiket = HargaTiket::all();
        if (count($hargaTiket) == 0) {
            return view('layoutAdmin.harga_tiket.create');
        } else {
            return redirect()->back()->with('warning', 'Data Harga Tiket Masuk Sudah Ada');
        }
    }

    public function store(Request $request)
    {
        $hargaTiket = new \App\Models\HargaTiket;
        $hargaTiket->harga = $request->harga;
        $hargaTiket->keterangan = $request->keterangan;
        $hargaTiket->tanggal_update = Carbon::now();
        $hargaTiket->save();
        return redirect('/hargaTiket')->with('success', 'Data berhasil ditambah');
    }

    public function edit(HargaTiket $hargaTiket)
    {
        return view('layoutAdmin.harga_tiket.edit', compact('hargaTiket'));
    }

    public function update(Request $request, HargaTiket $hargaTiket)
    {
        HargaTiket::where('id', $hargaTiket->id)
            ->update([
                'harga' => $request->harga,
                'keterangan' => $request->keterangan,
                'tanggal_update' => Carbon::now(),
            ]);
        return redirect('/hargaTiket')->with('success', 'Data berhasil diedit');
    }

    public function download()
    {
        $hargaTiket = HargaTiket::orderBy('tanggal_update', 'desc')->get();

        $pdf = PDF::loadView('layoutAdmin.harga_tiket.download', ['hargaTiket' => $hargaTiket]);
        return $pdf->download('Harga Tiket.pdf');
    }
}
