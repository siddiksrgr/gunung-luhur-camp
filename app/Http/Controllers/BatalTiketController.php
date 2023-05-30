<?php

namespace App\Http\Controllers;

use App\Models\BatalTiket;
use App\Models\AlatSewa;
use App\Models\Pemesanan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class BatalTiketController extends Controller
{
    public function indexUser()
    {
        $pemesanan = Pemesanan::where('user_id', auth()->user()->id)->where('status_pesan', 3)->get();

        if (count($pemesanan) == 0) {
            return view('layoutUser.batal_tiket.kosong');
        } else
            return view('layoutUser.batal_tiket.index', [
                'pemesanan' => $pemesanan
            ]);
    }

    public function indexAdmin()
    {
        $batalTiket = BatalTiket::orderBy('tanggal_input', 'desc')->get();
        return view('layoutAdmin.batal_tiket.index', [
            'batalTiket' => $batalTiket
        ]);
    }

    public function create(Pemesanan $pemesanan)
    {
        if ($pemesanan->checkIn == null) {
            return view('layoutUser.batal_tiket.create', [
                'pemesanan' => $pemesanan
            ]);
        } else {
            return redirect()->back();
        }
    }

    public function store(Request $request, Pemesanan $pemesanan)
    {
        $batalTiket = new \App\Models\BatalTiket;
        $batalTiket->pemesanan_id = $pemesanan->id;
        $batalTiket->no_rekening = $request->no_rek;
        $batalTiket->atas_nama = $request->atas_nama;
        $batalTiket->alasan = $request->alasan;
        $batalTiket->status_refund = 0;
        $batalTiket->tanggal_input = Carbon::now();
        $batalTiket->save();

        $pemesanan->update([
            'status_pesan' => 3
        ]);

        //kembalikan alat sewa yang dibatalkan
        if (!empty($pemesanan->sewaAlat)) {
            $sewa_tenda = $pemesanan->sewaAlat;

            foreach ($sewa_tenda as $sewa_tenda) {
                $sewa_tenda->update([
                    'status_kembali' => 1
                ]);

                AlatSewa::where('id', $sewa_tenda->alat_sewa_id)
                    ->update([
                        'sedang_disewa' => $sewa_tenda->alatSewa->sedang_disewa - $sewa_tenda->jumlah,
                        'stok' => $sewa_tenda->alatSewa->stok + $sewa_tenda->jumlah,
                    ]);
            };
        }
        return redirect('/batal_tiket')->with('status', 'Pembatalan tiket berhasil diproses, admin akan melakukan proses refund secepatnya.');
    }

    public function showUser(Pemesanan $pemesanan)
    {
        $sewa_tenda = $pemesanan->sewaAlat;
        return view('layoutUser.batal_tiket.detail', [
            'pemesanan' => $pemesanan,
            'sewa_tenda' => $sewa_tenda
        ]);
    }

    public function showAdmin(BatalTiket $batalTiket)
    {
        $sewa_tenda = $batalTiket->pemesanan->sewaAlat;
        return view('layoutAdmin.batal_tiket.detail', compact('batalTiket', 'sewa_tenda'));
    }

    public function refund(Request $request, BatalTiket $batalTiket)
    {
        // time() digunakan untuk menghindari nama file yang sama.
        if ($request->hasFile('foto')) {
            $imgName = $request->file('foto')->getClientOriginalName() . '-' . time() . '.' . $request->foto->extension();
            $request->file('foto')->move('img\BuktiRefund', $imgName);
        }

        $batalTiket->update([
            'bukti_refund' => $imgName,
            'status_refund' => 1
        ]);

        return redirect('/pembatalan_tiket')->with('success', 'Tiket berhasil direfund');
    }

    public function download()
    {
        $batalTiket = BatalTiket::orderBy('tanggal_input', 'desc')->get();
        $pdf = PDF::loadView('layoutAdmin.batal_tiket.download', compact('batalTiket'));
        return $pdf->download('Pembatalan Tiket.pdf');
    }
}
