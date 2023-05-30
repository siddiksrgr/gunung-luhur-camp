<?php

namespace App\Http\Controllers;

use App\Models\AlatSewa;
use Illuminate\Http\Request;
use App\Models\CheckOut;
use App\Models\CheckIn;
use App\Models\Pemesanan;
use App\Models\SewaAlat;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;


class CheckOutController extends Controller
{
    public function index()
    {
        $checkOut = CheckOut::orderBy('tanggal_input', 'desc')->get();
        return view('layoutAdmin.check_out.index', compact('checkOut'));
    }

    public function create()
    {
        return view('layoutAdmin.check_out.create');
    }

    public function check(Request $request)
    {
        $pemesanan = Pemesanan::where('nomor_pesan', '=', $request->nomor)->first();

        if (!empty($pemesanan->checkIn->id) && empty($pemesanan->checkIn->checkOut->id)) {
            $checkIn = CheckIn::where('id', '=', $pemesanan->checkIn->id)->first();

            // isi tabel checkout
            $checkOut = new \App\Models\CheckOut;
            $checkOut->check_in_id = $checkIn->id;
            $checkOut->tanggal_input = Carbon::now();
            $checkOut->save();

            // update status di tabel check_in
            $checkIn->status = 1;
            $checkIn->save();
            return redirect('/check_out')->with('success', 'Data Check Out Berhasil Ditambah');
        } else {
            return redirect('/check_out/create')->with('warning', 'Nomor Tiket Tidak Valid');
        }
    }

    public function penyewaan_tambahan_index(CheckOut $checkOut)
    {
        $sewa_alat_tambah = $checkOut->checkIn->sewaTambah->sortByDesc('id');
        return view('layoutAdmin.check_out.penyewaan_tambahan.index', compact('sewa_alat_tambah'));
    }

    public function penyewaan_tambahan_detail(SewaAlat $sewaAlat)
    {
        return view('layoutAdmin.check_out.penyewaan_tambahan.detail', compact('sewaAlat'));
    }

    public function penyewaan_tambahan_kembali(SewaAlat $sewaAlat)
    {
        if ($sewaAlat->status_kembali == 0) {
            return view('layoutAdmin.check_out.penyewaan_tambahan.kembali', compact('sewaAlat'));
        } else {
            return redirect()->back();
        }
    }

    public function penyewaan_tambahan_dikembalikan(Request $request, SewaAlat $sewaAlat)
    {
        if ((($request->jmlh_bagus + $request->jmlh_rusak) != $request->jmlh_kembali)) {
            return redirect()->back()->with('warning', 'Jumlah kembali harus sama dengan jumlah bagus ditambah jumlah rusak !');
        }

        $pengembalian = new \App\Models\PengembalianAlat;
        $pengembalian->sewa_alat_id = $sewaAlat->id;
        $pengembalian->jumlah_kembali = $request->jmlh_kembali;
        $pengembalian->jumlah_bagus = $request->jmlh_bagus;
        $pengembalian->jumlah_rusak = $request->jmlh_rusak;
        $pengembalian->tanggal_input = Carbon::now();
        $pengembalian->save();

        // update status_kembali sewa alat
        $sewaAlat->status_kembali = 1;
        $sewaAlat->save();

        if (($request->jmlh_rusak == 0) && ($request->jmlh_bagus == $request->jmlh_kembali)) {

            // update stok & sedang disewa pada tabel alat sewa 
            $alatsewa = AlatSewa::where('id', $sewaAlat->alat_sewa_id)->first();
            $alatsewa->sedang_disewa = $alatsewa->sedang_disewa - $request->jmlh_kembali;
            $alatsewa->stok =  $alatsewa->stok + $request->jmlh_bagus;
            $alatsewa->save();

            return redirect('/check_out')->with('success', 'Alat Berhasil Dikembalikan');
        } elseif ($request->jmlh_rusak > 0) {

            $rusak = new \App\Models\GantiAlatRusak;
            $rusak->pengembalian_alat_id = $pengembalian->id;
            $rusak->total_ganti = $sewaAlat->alatSewa->harga_beli * $request->jmlh_rusak;
            $rusak->status = 'Sudah Bayar';
            $rusak->tanggal_input = Carbon::now();
            $rusak->save();

            // update sedang disewa pada tabel alat sewa 
            $alatsewa = AlatSewa::where('id', $sewaAlat->alat_sewa_id)->first();
            $alatsewa->sedang_disewa = $alatsewa->sedang_disewa - $request->jmlh_kembali;
            $alatsewa->stok =  $alatsewa->stok + $request->jmlh_bagus;
            $alatsewa->save();

            return redirect('/check_out')->with('success', 'Alat Berhasil Dikembalikan');
        }
    }

    public function penyewaan_tenda_index(CheckOut $checkOut)
    {
        $sewa_tenda = $checkOut->checkIn->pemesanan->sewaAlat->sortByDesc('tanggal_pesan');
        return view('layoutAdmin.check_out.penyewaan_tenda.index', compact('sewa_tenda'));
    }

    public function penyewaan_tenda_detail(SewaAlat $sewaAlat)
    {
        $sewa_tenda = $sewaAlat;
        return view('layoutAdmin.check_out.penyewaan_tenda.detail', compact('sewa_tenda'));
    }

    public function penyewaan_tenda_kembali(SewaAlat $sewaAlat)
    {
        if ($sewaAlat->status_kembali == 0) {
            return view('layoutAdmin.check_out.penyewaan_tenda.kembali', compact('sewaAlat'));
        } else {
            return redirect()->back();
        }
    }

    public function penyewaan_tenda_dikembalikan(Request $request, SewaAlat $sewaAlat)
    {
        if ((($request->jmlh_bagus + $request->jmlh_rusak) != $request->jmlh_kembali)) {
            return redirect()->back()->with('warning', 'Jumlah kembali harus sama dengan jumlah bagus ditambah jumlah rusak !');
        }

        $pengembalian = new \App\Models\PengembalianAlat;
        $pengembalian->sewa_alat_id = $sewaAlat->id;
        $pengembalian->jumlah_kembali = $request->jmlh_kembali;
        $pengembalian->jumlah_bagus = $request->jmlh_bagus;
        $pengembalian->jumlah_rusak = $request->jmlh_rusak;
        $pengembalian->tanggal_input = Carbon::now();
        $pengembalian->save();

        // update status_kembali sewa alat
        $sewaAlat->status_kembali = 1;
        $sewaAlat->save();

        if (($request->jmlh_rusak == 0) && ($request->jmlh_bagus == $request->jmlh_kembali)) {

            // update stok & sedang disewa pada tabel alat sewa 
            $alatsewa = AlatSewa::where('id', $sewaAlat->alat_sewa_id)->first();
            $alatsewa->sedang_disewa = $alatsewa->sedang_disewa - $request->jmlh_kembali;
            $alatsewa->stok =  $alatsewa->stok + $request->jmlh_bagus;
            $alatsewa->save();

            return redirect('/check_out')->with('success', 'Alat Berhasil Dikembalikan');
        } elseif ($request->jmlh_rusak > 0) {

            $rusak = new \App\Models\GantiAlatRusak;
            $rusak->pengembalian_alat_id = $pengembalian->id;
            $rusak->total_ganti = $sewaAlat->alatSewa->harga_beli * $request->jmlh_rusak;
            $rusak->status = 'Sudah Bayar';
            $rusak->tanggal_input = Carbon::now();
            $rusak->save();

            // update sedang disewa pada tabel alat sewa 
            $alatsewa = AlatSewa::where('id', $sewaAlat->alat_sewa_id)->first();
            $alatsewa->sedang_disewa = $alatsewa->sedang_disewa - $request->jmlh_kembali;
            $alatsewa->stok =  $alatsewa->stok + $request->jmlh_bagus;
            $alatsewa->save();

            return redirect('/check_out')->with('success', 'Alat Berhasil Dikembalikan');
        }
    }

    public function show(CheckOut $checkOut)
    {
        $sewa_tenda = $checkOut->checkIn->pemesanan->sewaAlat->sortByDesc('tanggal_pesan');
        return view('layoutAdmin.check_out.detail', compact('checkOut', 'sewa_tenda'));
    }

    public function download()
    {
        $checkOut = CheckOut::orderBy('tanggal_input', 'desc')->get();
        $pdf = PDF::loadView('layoutAdmin.check_out.download', compact('checkOut'));
        return $pdf->download('Check Out.pdf');
    }
}
