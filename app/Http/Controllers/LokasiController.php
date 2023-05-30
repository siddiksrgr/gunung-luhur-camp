<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class LokasiController extends Controller
{
    public function index()
    {
        $lokasi = Lokasi::all();
        return view('layoutAdmin.lokasi.index', compact('lokasi'));
    }

    public function create()
    {
        $lokasi = Lokasi::all();
        if (count($lokasi) == 0) {
            return view('layoutAdmin.lokasi.create');
        } else {
            return redirect()->back()->with('warning', 'Data Lokasi Sudah Ada');
        }
    }

    public function store(Request $request)
    {
        $lokasi = new \App\Models\Lokasi;
        $lokasi->alamat = $request->alamat;
        $lokasi->no_hp = $request->no_hp;
        $lokasi->tanggal_update = Carbon::now();
        $lokasi->save();
        return redirect('/lokasi')->with('success', 'Data berhasil ditambah');
    }


    public function edit(Lokasi $lokasi)
    {
        return view('layoutAdmin.lokasi.edit', compact('lokasi'));
    }


    public function update(Request $request, Lokasi $lokasi)
    {
        Lokasi::where('id', $lokasi->id)
            ->update([
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                'tanggal_update' => Carbon::now()
            ]);
        return redirect('/lokasi')->with('success', 'Data berhasil diedit');
    }

    public function download()
    {
        $lokasi = Lokasi::orderBy('tanggal_update', 'desc')->get();

        $pdf = PDF::loadView('layoutAdmin.lokasi.download', ['lokasi' => $lokasi]);
        return $pdf->download('Lokasi.pdf');
    }
}
