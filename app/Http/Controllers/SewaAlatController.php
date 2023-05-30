<?php

namespace App\Http\Controllers;

use App\Models\AlatSewa;
use App\Models\SewaAlat;
use App\Models\Pemesanan;
use App\Models\PesanTiket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;


class SewaAlatController extends Controller
{
    public function index()
    {
        $pemesanan = Pemesanan::where('status_pesan', '=', 2)
            ->orderBy('tanggal_pesan', 'desc')
            ->get();

        $sewa_tenda = SewaAlat::whereIn('pemesanan_id', $pemesanan->pluck('id'))
            ->orWhere('pemesanan_id', null)
            ->orderBy('tanggal_pesan', 'desc')
            ->get();

        return view('layoutAdmin.penyewaan_tenda.index', compact('sewa_tenda', 'pemesanan'));
    }

    public function create()
    {
        //cek tabel pemesanan
        $pemesanan = Pemesanan::where('user_id', auth()->user()->id)->where('status_pesan', 0)->first();
        if (empty($pemesanan)) {
            return redirect('/pesan_tiket')->with('status', 'Anda harus memesan tiket masuk terlebih dahulu !');
        }

        $alatsewa = AlatSewa::where('kapasitas', '!=', null)->where('stok', '!=', 0)->get();
        return view('layoutUser.sewa_tenda.index', [
            'alatsewa' => $alatsewa
        ]);
    }

    public function store(Request $request, AlatSewa $alatsewa)
    {
        $pemesanan = Pemesanan::where('user_id', auth()->user()->id)->where('status_pesan', 0)->first();
        $pesan_tiket = PesanTiket::where('pemesanan_id', $pemesanan->id)->first();

        //insert ke tabel sewa_alat 
        $sewaAlat = new \App\Models\SewaAlat;
        $sewaAlat->pemesanan_id = $pemesanan->id;
        $sewaAlat->alat_sewa_id = $alatsewa->id;
        $sewaAlat->tanggal_pinjam = $pesan_tiket->tgl_check_in;
        $sewaAlat->tanggal_kembali = $pesan_tiket->tgl_check_out;
        $sewaAlat->lama_sewa = $pesan_tiket->lama_menginap;
        $sewaAlat->jumlah = $request->jumlah;
        $sewaAlat->total_bayar = $request->jumlah * $sewaAlat->lama_sewa * $alatsewa->harga_sewa;
        $sewaAlat->tanggal_pesan = Carbon::now();
        $sewaAlat->status_kembali = 0;
        $sewaAlat->save();

        //update tabel alat sewa
        AlatSewa::where('id', $alatsewa->id)
            ->update([
                'sedang_disewa' => $sewaAlat->alatSewa->sedang_disewa + $request->jumlah,
                'stok' => $sewaAlat->alatSewa->stok - $request->jumlah
            ]);

        //update total_bayar di tabel Pemesanan
        $pemesanan->total_bayar = $pemesanan->total_bayar + $sewaAlat->total_bayar;
        $pemesanan->save();

        return redirect('/pemesanan_user')->with('status', 'Pesanan sewa tenda berhasil dibuat');
    }

    public function show(SewaAlat $sewaTenda)
    {
        return view('layoutUser.sewa_tenda.detail', [
            'sewaTenda' => $sewaTenda
        ]);
    }

    public function showAdmin(SewaAlat $sewaAlat)
    {
        return view('layoutAdmin.penyewaan_tenda.detail', compact('sewaAlat'));
    }

    public function destroy(SewaAlat $sewaTenda)
    {
        //update total_bayar di tabel Pemesanan
        $pemesanan = Pemesanan::where('user_id', auth()->user()->id)->where('status_pesan', 0)->first();
        $pemesanan->total_bayar = $pemesanan->total_bayar - $sewaTenda->total_bayar;
        $pemesanan->save();

        //hapus dari tabel sewa_alat
        SewaAlat::destroy($sewaTenda->id);

        //update tabel alat_sewa
        AlatSewa::where('id', $sewaTenda->alatSewa->id)
            ->update([
                'sedang_disewa' => $sewaTenda->alatSewa->sedang_disewa - $sewaTenda->jumlah,
                'stok' => $sewaTenda->alatSewa->stok + $sewaTenda->jumlah,
            ]);

        return redirect('/pemesanan_user')->with('status_hapus', 'Data pemesanan sewa tenda berhasil dihapus');
    }

    public function download()
    {
        $pemesanan = Pemesanan::where('status_pesan', '=', 2)
            ->orWhere('status_pesan', '=', 4)
            ->orderBy('tanggal_pesan', 'desc')
            ->get();
        $pdf = PDF::loadView('layoutAdmin.penyewaan_tenda.download', compact('pemesanan'));
        return $pdf->download('Penyewaan Tenda.pdf');
    }
}
