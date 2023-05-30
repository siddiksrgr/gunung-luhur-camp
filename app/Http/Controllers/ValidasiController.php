<?php

namespace App\Http\Controllers;

use App\Models\Konfirmasi;

class ValidasiController extends Controller
{
    public function validasi(Konfirmasi $konfirmasi)
    {
        $konfirmasi->pemesanan->update([
            'status_pesan' => 2
        ]);

        return redirect('/konfirmasi_pembayaran')->with('success', 'Pemesanan berhasil divalidasi');
    }
}
