<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::orderBy('tanggal_update', 'desc')->get();
        return view('layoutAdmin.pegawai.index', compact('pegawai'));
    }

    public function create()
    {
        return view('layoutAdmin.pegawai.create');
    }

    public function store(Request $request)
    {
        $pegawai = new \App\Models\Pegawai;
        $pegawai->nama = $request->nama;
        $pegawai->jns_kelamin = $request->jns_kelamin;
        $pegawai->no_hp = $request->no_hp;
        $pegawai->alamat = $request->alamat;
        $pegawai->tanggal_input = Carbon::now();
        $pegawai->tanggal_update = Carbon::now();
        $pegawai->save();
        return redirect('/pegawai')->with('success', 'Data Pegawai Berhasil Ditambahkan');
    }

    public function edit(Pegawai $pegawai)
    {
        return view('layoutAdmin.pegawai.edit', compact('pegawai'));
    }

    public function update(Request $request, Pegawai $pegawai)
    {
        Pegawai::where('id', $pegawai->id)
            ->update([
                'nama' => $request->nama,
                'jns_kelamin' => $request->jns_kelamin,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'tanggal_update' => Carbon::now()
            ]);
        return redirect('/pegawai')->with('success', 'Data Pegawai Berhasil Diedit');
    }

    public function destroy(Pegawai $pegawai)
    {
        Pegawai::destroy($pegawai->id);
        return redirect('/pegawai')->with('success', 'Data Pegawai Berhasil Dihapus');
    }

    public function download()
    {
        $pegawai = Pegawai::orderBy('tanggal_update', 'desc')->get();
        $pdf = PDF::loadView('layoutAdmin.pegawai.download', compact('pegawai'));
        return $pdf->download('Pegawai.pdf');
    }
}
