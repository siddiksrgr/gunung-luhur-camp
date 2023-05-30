<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalPiket;
use App\Models\Pegawai;
use App\Models\ShiftKerja;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class JadwalPiketController extends Controller
{
    public function index()
    {
        $jadwal = JadwalPiket::all();
        return view('layoutAdmin.jadwal_piket.index', compact('jadwal'));
    }

    public function create()
    {
        $pegawai = Pegawai::all();
        $shift = ShiftKerja::all();

        if (count($pegawai) == 0 || count($shift) == 0) {
            return redirect()->back()->with('warning', 'Data Pegawai atau Shift Kerja Belum Ada');
        } else {
            return view('layoutAdmin.jadwal_piket.create', compact('pegawai', 'shift'));
        }
    }

    public function store(Request $request)
    {
        $jadwal = new \App\Models\JadwalPiket;
        $jadwal->tanggal = Carbon::parse($request->tanggal);
        $jadwal->pegawai_id = $request->pegawai;
        $jadwal->shift_kerja_id = $request->shift;
        $jadwal->save();
        return redirect('/jadwal_piket')->with('success', 'Data Berhasil Ditambah');
    }

    public function edit(JadwalPiket $jadwal)
    {
        $pegawai = Pegawai::all();
        $shift = ShiftKerja::all();
        return view('layoutAdmin.jadwal_piket.edit', compact('jadwal', 'pegawai', 'shift'));
    }

    public function update(Request $request, JadwalPiket $jadwal)
    {
        JadwalPiket::where('id', $jadwal->id)
            ->update([
                'tanggal' => Carbon::parse($request->tanggal),
                'pegawai_id' => $request->pegawai,
                'shift_kerja_id' => $request->shift,
            ]);
        return redirect('/jadwal_piket')->with('success', 'Data Berhasil Diedit');
    }

    public function destroy(JadwalPiket $jadwal)
    {
        JadwalPiket::destroy($jadwal->id);
        return redirect('/jadwal_piket')->with('success', 'Data Berhasil Dihapus');
    }

    public function print(Request $request)
    {
        $jadwal = JadwalPiket::all();
        $shift = ShiftKerja::where('nama_shift', '!=', 'Libur')->get();
        $tgl = Carbon::now()->format('d-m-Y');

        $pdf = PDF::loadView('layoutAdmin.jadwal_piket.print', [
            'jadwal' => $jadwal,
            'shift' => $shift,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun
        ]);
        return $pdf->download('Jadwal-Piket-(' . $tgl . ').pdf');
    }

    public function deleteAll()
    {
        $jadwal = DB::table('jadwal_piket')->get();

        if (count($jadwal) == 0) {
            return redirect()->back()->with('warning', 'Tidak Ada Data !');
        } else {
            DB::table('jadwal_piket')->truncate();
            return redirect('/jadwal_piket')->with('success', 'Data Berhasil Dihapus Semua');
        }
    }
}
