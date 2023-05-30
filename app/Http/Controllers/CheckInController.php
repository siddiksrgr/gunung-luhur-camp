<?php

namespace App\Http\Controllers;

use App\Models\CheckIn;
use Illuminate\Http\Request;
use App\Models\Pemesanan;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;

class CheckInController extends Controller
{
    public function index()
    {
        $checkIn = CheckIn::orderBy('tanggal_input', 'desc')->get();
        return view('layoutAdmin.check_in.index', compact('checkIn'));
    }

    public function create()
    {
        return view('layoutAdmin.check_in.create');
    }

    public function check(Request $request)
    {
        $pemesanan = Pemesanan::where('status_pesan', 2)->where('nomor_pesan', '=', $request->nomor)->first();

        if (empty($pemesanan)) {
            return redirect('/check_in/create')->with('warning', 'Nomor Tiket Tidak Valid');
        } elseif (!empty($pemesanan->checkIn->id) && empty($pemesanan->checkIn->checkOut->id)) {
            return redirect('/check_in/create')->with('warning', 'Nomor Tiket Sudah Check In dan Belum Check Out');
        } elseif (!empty($pemesanan->checkIn->id) && !empty($pemesanan->checkIn->checkOut->id)) {
            return redirect('/check_in/create')->with('warning', 'Nomor Tiket Sudah Pernah Check In dan Sudah Pernah Check Out');
        } elseif (empty($pemesanan->checkIn->id) && empty($pemesanan->checkIn->checkOut->id)) {
            $checkIn = new \App\Models\CheckIn;
            $checkIn->pemesanan_id = $pemesanan->id;
            $checkIn->status = 0;
            $checkIn->tanggal_input = Carbon::now();
            $checkIn->save();
            return redirect('/check_in')->with('success', 'Tiket Berhasil Check In');
        }
    }

    public function show(CheckIn $checkIn)
    {
        $sewa_tenda = $checkIn->pemesanan->sewaAlat;
        return view('layoutAdmin.check_in.detail', compact('checkIn', 'sewa_tenda'));
    }

    public function download()
    {
        $checkIn = CheckIn::orderBy('tanggal_input', 'desc')->get();
        $pdf = PDF::loadView('layoutAdmin.check_in.download', compact('checkIn'));
        return $pdf->download('Check In.pdf');
    }
}
