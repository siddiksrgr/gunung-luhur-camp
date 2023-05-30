<?php

namespace App\Http\Controllers;

use App\Models\HargaTiket;
use App\Models\Pemesanan;
use App\Models\PesanTiket;
use App\Models\SewaAlat;
use App\Models\AlatSewa;
use Illuminate\Http\Request;
use Carbon\Carbon;


class PesanTiketController extends Controller
{
    public function create()
    {
        $hargatiket = HargaTiket::all();

        $pemesanan = Pemesanan::where('user_id', auth()->user()->id)->where('status_pesan', 0)->first();

        if (empty($pemesanan)) {
            return view('layoutUser.pesan_tiket.index', [
                'hargatiket' => $hargatiket
            ]);
        } else
            return redirect('/pemesanan_user')->with('status_pesan_lagi', 'Anda sudah memesan tiket masuk, tiket masuk hanya bisa dipesan 1x transaksi !');
    }

    public function store(Request $request, HargaTiket $hargatiket)
    {
        $request->validate(
            [
                'awal' => 'required|date|after_or_equal:today',
                'akhir' => 'required|date|after:awal',
                'jmlh_anggota' => 'required|integer|min:1'
            ]
        );

        $diff = Carbon::parse($request->awal)->diffInDays($request->akhir);
        $total_anggota = $request->jmlh_anggota;

        //nomor pesan
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $pin = mt_rand(1000000, 9999999) . $characters[rand(0, strlen($characters) - 1)];
        $string = str_shuffle($pin);

        //kode unik
        $pemesanan = Pemesanan::where('status_pesan', '!=', 4)->get();
        $tanggal_pesan = $pemesanan->pluck('tanggal_pesan')->all();
        $kode_unik = $pemesanan->pluck('kode_unik')->all();
        $last = Carbon::parse(last($tanggal_pesan))->format('Y-m-d');
        $hari_ini = Carbon::now()->toDateString();
        if (count($pemesanan) == 0 || $hari_ini > $last) {
            $kode = 1;
        } else {
            foreach ($kode_unik as $kode_unik) {
                $kode = $kode_unik + 1;
            }
        }

        //cek tabel pemesanan
        $cek_pesanan = Pemesanan::where('user_id', auth()->user()->id)->where('status_pesan', 0)->first();
        if (empty($cek_pesanan)) {
            //insert ke tabel pemesanan
            $pesanan = new \App\Models\Pemesanan;
            $pesanan->user_id = auth()->user()->id;
            $pesanan->nomor_pesan = $string;
            $pesanan->tanggal_pesan = Carbon::now();
            $pesanan->kode_unik = $kode;
            $pesanan->total_bayar = $total_anggota * $diff * $hargatiket->harga;
            $pesanan->status_pesan = 0;
            $pesanan->save();
        }

        //insert ke table pesan_tiket
        $pesanan_baru = Pemesanan::where('user_id', auth()->user()->id)->where('status_pesan', 0)->first();
        $pesanTiket = new \App\Models\PesanTiket;
        $pesanTiket->pemesanan_id = $pesanan_baru->id;
        $pesanTiket->harga_tiket_id = $hargatiket->id;
        $pesanTiket->tgl_check_in = Carbon::parse($request->awal)->format('Y-m-d');
        $pesanTiket->tgl_check_out = Carbon::parse($request->akhir)->format('Y-m-d');
        $pesanTiket->lama_menginap = $diff;
        $pesanTiket->total_anggota = $total_anggota;
        $pesanTiket->total_bayar =  $total_anggota * $diff * $hargatiket->harga;
        $pesanTiket->tanggal_pesan = Carbon::now();
        $pesanTiket->save();

        return redirect('/pemesanan_user')->with('status', 'Pesanan tiket masuk berhasil dibuat');
    }

    public function showUser(PesanTiket $pesanTiket)
    {
        return view('layoutUser.pesan_tiket.detail', [
            'pesanTiket' => $pesanTiket
        ]);
    }

    public function destroy(PesanTiket $pesanTiket)
    {
        $pemesanan = Pemesanan::where('user_id', auth()->user()->id)->where('status_pesan', 0)->first();
        $sewaTenda = $pemesanan->sewaAlat;

        if (empty($sewaTenda)) {
            //hapus pesan_tiket dan tabel pemesanan
            PesanTiket::destroy($pesanTiket->id);
            Pemesanan::destroy($pemesanan->id);
            return redirect('/pemesanan_user')->with('status_hapus', 'Data pemesanan tiket masuk berhasil dihapus');
        } elseif (!empty($sewaTenda)) {

            //update tabel alat_sewa
            foreach ($sewaTenda as $sewaTenda) {
                AlatSewa::where('id', $sewaTenda->alat_sewa_id)
                    ->update([
                        'sedang_disewa' => $sewaTenda->alatSewa->sedang_disewa - $sewaTenda->jumlah,
                        'stok' => $sewaTenda->alatSewa->stok + $sewaTenda->jumlah,
                    ]);
            };

            //hapus sewa_tenda, pesan_tiket, dan tabel pemesanan
            SewaAlat::where('pemesanan_id', $pemesanan->id)->delete();
            PesanTiket::destroy($pesanTiket->id);
            Pemesanan::destroy($pemesanan->id);
            return redirect('/pemesanan_user')->with('status_hapus', 'Data pemesanan tiket masuk dan sewa tenda berhasil dihapus');
        }
    }
}
