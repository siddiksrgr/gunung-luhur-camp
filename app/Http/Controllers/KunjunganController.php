<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CheckIn;
use App\Models\PesanTiket;
use Carbon\Carbon;


class KunjunganController extends Controller
{
    public function index()
    {
        return view('layoutAdmin.laporan.kunjungan.index');
    }

    public function today()
    {
        $hari_ini = CheckIn::whereDate('tanggal_input', Carbon::now())->get('pemesanan_id');
        $tiket = PesanTiket::whereIn('pemesanan_id', $hari_ini->toArray())->get();
        $total_hari_ini = $tiket->sum('total_anggota');

        $checkIn = CheckIn::whereDate('tanggal_input', Carbon::now())->get();
        return view('layoutAdmin.laporan.kunjungan.today', compact('checkIn', 'total_hari_ini'));
    }

    public function total()
    {
        $total = CheckIn::get('pemesanan_id');
        $tiket = PesanTiket::whereIn('pemesanan_id', $total->toArray())->get();
        $total_keseluruhan = $tiket->sum('total_anggota');

        $checkIn = CheckIn::orderBy('tanggal_input', 'desc')->get(); 
        return view('layoutAdmin.laporan.kunjungan.total', compact('checkIn', 'total_keseluruhan'));
    }

    public function get(Request $request)
    {
        $request->validate(
            [
                'tgl_awal' => 'required',
                'tgl_akhir' => 'required|after_or_equal:tgl_awal'
            ]
        );

        $tgl_awal = Carbon::parse($request->tgl_awal)->format('Y-m-d');
        $tgl_akhir = Carbon::parse($request->tgl_akhir)->format('Y-m-d');

        $rentang = CheckIn::whereDate('tanggal_input', '>=', $tgl_awal)
            ->whereDate('tanggal_input', '<=', $tgl_akhir)
            ->get('pemesanan_id');
        $tiket = PesanTiket::whereIn('pemesanan_id', $rentang->toArray())->get();
        $total = $tiket->sum('total_anggota');

        $checkIn = CheckIn::whereDate('tanggal_input', '>=', $tgl_awal)
            ->whereDate('tanggal_input', '<=', $tgl_akhir)
            ->get();

        return view('layoutAdmin.laporan.kunjungan.rentang_tanggal', compact(
            'checkIn',
            'tgl_awal',
            'tgl_akhir',
            'total'
        ));
    }
}
