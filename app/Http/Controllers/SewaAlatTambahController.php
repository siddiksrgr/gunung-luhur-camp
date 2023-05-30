<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AlatSewa;
use App\Models\CheckIn;
use App\Models\Pemesanan;
use App\Models\SewaAlat;
use App\Models\SewaAlatTambah;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;

class SewaAlatTambahController extends Controller
{
    public function index()
    {
        $sewa_tambah = SewaAlatTambah::orderBy('id', 'desc')->get();
        return view('layoutAdmin.penyewaan_tambahan.index', compact('sewa_tambah'));
    }

    public function create()
    {
        $checkIn = CheckIn::where('status', 0)->get();

        if (count($checkIn) != null) {
            $alatsewa = AlatSewa::all();
            $user = User::where('nama', '!=', 'Admin')->get();

            return view('layoutAdmin.penyewaan_tambahan.create', [
                'alatsewa' => $alatsewa,
                'user' => $user,
                'checkIn' => $checkIn
            ]);
        } else {
            return redirect()->back()->with('warning', 'Tiket User Belum Ada Yang Check In');
        }
    }

    public function store(Request $request)
    {
        $alatsewa = AlatSewa::where('id', $request->barang)->first();
        $checkIn = CheckIn::where('id', $request->checkIn_id)->first();

        $tgl_check_in = $checkIn->pemesanan->pesanTiket->tgl_check_in;
        $tgl_check_out = $checkIn->pemesanan->pesanTiket->tgl_check_out;

        $request->validate([
            'jumlah' => 'numeric|max:' . $alatsewa->stok . '',
            'tgl_kembali' => 'date|before_or_equal: ' . $tgl_check_out . '|after_or_equal: ' . $tgl_check_in . ''
        ]);

        $tanggal_pinjam = Carbon::now()->format('Y-m-d');
        $lama_sewa = Carbon::parse($tanggal_pinjam)->diffInDays(Carbon::parse($request->tgl_kembali));
        $total_bayar = $request->jumlah * $lama_sewa * $alatsewa->harga_sewa;

        //update alat sewa
        $alatsewa->sedang_disewa =  $alatsewa->sedang_disewa + $request->jumlah;
        $alatsewa->stok = $alatsewa->stok - $request->jumlah;
        $alatsewa->save();

        //insert ke tabel sewa alat
        $sewaAlat = new \App\Models\SewaAlat;
        $sewaAlat->alat_sewa_id = $alatsewa->id;
        $sewaAlat->tanggal_pinjam = $tanggal_pinjam;
        $sewaAlat->tanggal_kembali = Carbon::parse($request->tgl_kembali);
        $sewaAlat->lama_sewa = $lama_sewa;
        $sewaAlat->jumlah = $request->jumlah;
        $sewaAlat->total_bayar = $total_bayar;
        $sewaAlat->tanggal_pesan = Carbon::now();
        $sewaAlat->status_kembali = 0;
        $sewaAlat->save();

        //insert ke tabel sewa_alat_tambah
        $sewa_tambah = new \App\Models\SewaAlatTambah;
        $sewa_tambah->check_in_id = $request->checkIn_id;
        $sewa_tambah->sewa_alat_id = $sewaAlat->id;
        $sewa_tambah->save();

        return redirect('/penyewaan_tambahan')->with('success', 'Sewa Alat Berhasil Ditambah');
    }

    public function show(SewaAlatTambah $sewaAlatTambah)
    {
        return view('layoutAdmin.penyewaan_tambahan.detail', compact('sewaAlatTambah'));
    }

    public function kembali(SewaAlatTambah $sewaAlatTambah)
    {
        if ($sewaAlatTambah->sewaAlat->status_kembali == 0) {
            return view('layoutAdmin.penyewaan_tambahan.kembali', compact('sewaAlatTambah'));
        } else {
            return redirect()->back();
        }
    }

    public function dikembalikan(Request $request, SewaAlat $sewaAlat)
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

            return redirect('/penyewaan_tambahan')->with('success', 'Alat Berhasil Dikembalikan');
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

            return redirect('/penyewaan_tambahan')->with('success', 'Alat Berhasil Dikembalikan');
        }
    }

    public function download()
    {
        $pemesanan = Pemesanan::where('status_pesan', '=', 4)
            ->orderBy('tanggal_pesan', 'desc')
            ->get();
        $pdf = PDF::loadView('layoutAdmin.penyewaan_tambahan.download', compact('pemesanan'));
        return $pdf->download('Sewa Tambahan.pdf');
    }
}
