<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AlatSewa;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;

class AlatSewaController extends Controller
{

    public function index()
    {
        $alatsewa = AlatSewa::orderBy('tanggal_update', 'desc')->get();
        return view('layoutAdmin.alat_sewa.index', compact('alatsewa'));
    }

    public function create()
    {
        return view('layoutAdmin.alat_sewa.create');
    }

    public function store(Request $request)
    {
        $alatsewa = new \App\Models\AlatSewa;
        $alatsewa->nama = $request->nama;
        $alatsewa->kapasitas = $request->kapasitas;
        $alatsewa->harga_sewa = $request->harga_sewa;
        $alatsewa->harga_beli = $request->harga_beli;

        if ($request->hasFile('foto')) {
            $imgName = $request->file('foto')->getClientOriginalName() . '-' . time() . '.' . $request->foto->extension();
            $request->file('foto')->move('img\AlatSewa', $imgName);
            $alatsewa->foto = $imgName;
        }

        $alatsewa->sedang_disewa = 0;
        $alatsewa->stok = $request->stok;
        $alatsewa->keterangan = $request->keterangan;
        $alatsewa->tanggal_input = Carbon::now();
        $alatsewa->tanggal_update = Carbon::now();
        $alatsewa->save();
        return redirect('/alat_sewa')->with('success', 'Data Berhasil Ditambahkan');
    }


    public function detail(AlatSewa $alatsewa)
    {
        return view('layoutAdmin.alat_sewa.detail', compact('alatsewa'));
    }


    public function edit(AlatSewa $alatsewa)
    {
        return view('layoutAdmin.alat_sewa.edit', compact('alatsewa'));
    }


    public function update(Request $request, AlatSewa $alatsewa)
    {
        AlatSewa::where('id', $alatsewa->id)
            ->update([
                'nama' => $request->nama,
                'kapasitas' => $request->kapasitas,
                'harga_sewa' => $request->harga_sewa,
                'harga_beli' => $request->harga_beli,
                'keterangan' => $request->keterangan,
                'tanggal_update' => Carbon::now()
            ]);

        if ($request->hasFile('foto')) {
            $imgName = $request->file('foto')->getClientOriginalName() . '-' . time() . '.' . $request->foto->extension();
            $request->file('foto')->move('img\AlatSewa', $imgName);
            $alatsewa->foto = $imgName;
            $alatsewa->save();
        }
        return redirect('/alat_sewa')->with('success', 'Data Berhasil Diedit');
    }


    public function destroy(AlatSewa $alatsewa)
    {
        AlatSewa::destroy($alatsewa->id);
        return redirect('/alat_sewa')->with('success', 'Data Berhasil Dihapus');
    }

    public function masuk()
    {
        $alatSewa = AlatSewa::all();
        return view('layoutAdmin.alat_sewa.masuk', compact('alatSewa'));
    }

    public function tambah_stok(Request $request)
    {
        $alatSewa = AlatSewa::find($request->alat);
        $alatSewa->stok = $alatSewa->stok + $request->tambah_stok;
        $alatSewa->save();
        return redirect('/alat_sewa')->with('success', 'Stok Berhasil Ditambah');
    }

    public function download()
    {
        $alatsewa = AlatSewa::orderBy('tanggal_update', 'desc')->get();

        $pdf = PDF::loadView('layoutAdmin.alat_sewa.download', ['alatsewa' => $alatsewa]);
        return $pdf->download('Alat Sewa.pdf');
    }
}
