<?php

namespace App\Http\Controllers;

use App\Models\BeliBarang;
use App\Models\GantiAlatRusak;
use App\Models\Pemesanan;
use App\Models\PesanMakan;
use App\Models\SewaAlat;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PemasukanController extends Controller
{
    public function index()
    {
        return view('layoutAdmin.laporan.pemasukan.index');
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

        $pemesanan_tiket = Pemesanan::whereDate('tanggal_pesan', '>=', $tgl_awal)
            ->whereDate('tanggal_pesan', '<=', $tgl_akhir)
            ->whereIn('status_pesan', [2])
            ->orderBy('tanggal_pesan', 'desc')
            ->get();

        $sewa_alat_tambah = SewaAlat::whereDate('tanggal_pesan', '>=', $tgl_awal)
            ->whereDate('tanggal_pesan', '<=', $tgl_akhir)
            ->where('pemesanan_id', null)
            ->orderBy('tanggal_pesan', 'desc')
            ->get();

        $ganti_alat = GantiAlatRusak::whereDate('tanggal_input', '>=', $tgl_awal)
            ->whereDate('tanggal_input', '<=', $tgl_akhir)
            ->orderBy('tanggal_input', 'desc')
            ->get();

        $beliBarang = BeliBarang::whereDate('tanggal_beli', '>=', $tgl_awal)
            ->whereDate('tanggal_beli', '<=', $tgl_akhir)
            ->orderBy('tanggal_beli', 'desc')
            ->get();

        $pesan_makan = PesanMakan::whereDate('tanggal_pesan', '>=', $tgl_awal)
            ->whereDate('tanggal_pesan', '<=', $tgl_akhir)
            ->orderBy('tanggal_pesan', 'desc')
            ->get();

        $pesan_tiket = $pemesanan_tiket->sum('total_bayar');
        $kode_unik = $pemesanan_tiket->sum('kode_unik');
        $total_pesan_tiket = $pesan_tiket + $kode_unik;

        $total_sewa_tambahan = $sewa_alat_tambah->sum('total_bayar');
        $total_beli_barang = $beliBarang->sum('total_bayar');
        $total_ganti_alat = $ganti_alat->sum('total_ganti');
        $total_pesan_makan = $pesan_makan->sum('total_bayar');

        $total = $total_pesan_tiket + $total_sewa_tambahan + $total_beli_barang + $total_ganti_alat + $total_pesan_makan;

        return view('layoutAdmin.laporan.pemasukan.total', [
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir,
            'total' => $total,
            'pemesanan_tiket' => $pemesanan_tiket,
            'total_pesan_tiket' => $total_pesan_tiket,
            'sewa_alat_tambah' => $sewa_alat_tambah,
            'total_sewa_tambahan' => $total_sewa_tambahan,
            'ganti_alat' => $ganti_alat,
            'total_ganti_alat' => $total_ganti_alat,
            'beliBarang' => $beliBarang,
            'total_beli_barang' => $total_beli_barang,
            'pesan_makan' => $pesan_makan,
            'total_pesan_makan' => $total_pesan_makan
        ]);
    }

    public function totalKeseluruhan()
    {
        // pemesanan tiket
        $pemesanan_tiket = Pemesanan::where('status_pesan', 2)
            ->orderBy('tanggal_pesan', 'desc')
            ->get();

        // sewa alat tambahan
        $sewa_alat_tambah = SewaAlat::where('pemesanan_id', null)
            ->orderBy('tanggal_pesan', 'desc')
            ->get();

        $ganti_alat = GantiAlatRusak::orderBy('tanggal_input', 'desc')
            ->get();

        $beliBarang = BeliBarang::orderBy('tanggal_beli', 'desc')->get();

        $pesan_makan = PesanMakan::orderBy('tanggal_pesan', 'desc')->get();

        $pesan_tiket = $pemesanan_tiket->sum('total_bayar');
        $kode_unik = $pemesanan_tiket->sum('kode_unik');
        $total_pesan_tiket = $pesan_tiket + $kode_unik;

        $total_sewa_tambahan = $sewa_alat_tambah->sum('total_bayar');
        $total_beli_barang = $beliBarang->sum('total_bayar');
        $total_ganti_alat = $ganti_alat->sum('total_ganti');
        $total_pesan_makan = $pesan_makan->sum('total_bayar');

        $total = $total_pesan_tiket + $total_sewa_tambahan + $total_beli_barang + $total_ganti_alat + $total_pesan_makan;

        $tgl_awal = 0;

        return view('layoutAdmin.laporan.pemasukan.total', [
            'tgl_awal' => $tgl_awal,
            'total' => $total,
            'pemesanan_tiket' => $pemesanan_tiket,
            'total_pesan_tiket' => $total_pesan_tiket,
            'sewa_alat_tambah' => $sewa_alat_tambah,
            'total_sewa_tambahan' => $total_sewa_tambahan,
            'ganti_alat' => $ganti_alat,
            'total_ganti_alat' => $total_ganti_alat,
            'beliBarang' => $beliBarang,
            'total_beli_barang' => $total_beli_barang,
            'pesan_makan' => $pesan_makan,
            'total_pesan_makan' => $total_pesan_makan
        ]);
    }

    public function showTiket(Pemesanan $pemesanan_tiket)
    {
        $sewa_tenda = $pemesanan_tiket->sewaAlat;
        return view('layoutAdmin.laporan.pemasukan.pesan_tiket.detail', [
            'pemesanan_tiket' => $pemesanan_tiket,
            'sewa_tenda' => $sewa_tenda
        ]);
    }

    public function showSewa(SewaAlat $sewaAlatTambah)
    {
        return view('layoutAdmin.laporan.pemasukan.sewa_tambahan.detail', compact('sewaAlatTambah'));
    }

    public function showGanti(GantiAlatRusak $ganti)
    {
        return view('layoutAdmin.laporan.pemasukan.ganti_alat.detail', compact('ganti'));
    }
}
