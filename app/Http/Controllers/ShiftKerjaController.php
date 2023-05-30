<?php

namespace App\Http\Controllers;

use App\Models\ShiftKerja;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;

class ShiftKerjaController extends Controller
{
    public function index()
    {
        $shift = ShiftKerja::orderBy('tanggal_update', 'desc')->get();
        return view('layoutAdmin.shift_kerja.index', compact('shift'));
    }

    public function create()
    {
        return view('layoutAdmin.shift_kerja.create');
    }

    public function store(Request $request)
    {
        $shift = new \App\Models\ShiftKerja;
        $shift->nama_shift = $request->nama;
        $shift->jam_masuk = $request->jam_masuk;
        $shift->jam_pulang = $request->jam_pulang;
        $shift->tanggal_input = Carbon::now();
        $shift->tanggal_update = Carbon::now();
        $shift->save();
        return redirect('/shift_kerja')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit(ShiftKerja $shift)
    {
        return view('layoutAdmin.shift_kerja.edit', compact('shift'));
    }

    public function update(Request $request, ShiftKerja $shift)
    {
        ShiftKerja::where('id', $shift->id)
            ->update([
                'nama_shift' => $request->nama,
                'jam_masuk' => $request->jam_masuk,
                'jam_pulang' => $request->jam_pulang,
                'tanggal_update' => Carbon::now()
            ]);
        return redirect('/shift_kerja')->with('success', 'Data Berhasil Diedit');
    }

    public function destroy(ShiftKerja $shift)
    {
        ShiftKerja::destroy($shift->id);
        return redirect('/shift_kerja')->with('success', 'Data Berhasil Dihapus');
    }

    public function download()
    {
        $shift = ShiftKerja::orderBy('tanggal_update', 'desc')->get();
        $pdf = PDF::loadView('layoutAdmin.shift_kerja.download', compact('shift'));
        return $pdf->download('Shift Kerja Pegawai.pdf');
    }
}
