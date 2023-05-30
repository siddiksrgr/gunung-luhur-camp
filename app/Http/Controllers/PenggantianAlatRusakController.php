<?php

namespace App\Http\Controllers;

use App\Models\GantiAlatRusak;
use Barryvdh\DomPDF\Facade as PDF;

class PenggantianAlatRusakController extends Controller
{
    public function index()
    {
        $rusak = GantiAlatRusak::orderBy('tanggal_input', 'desc')->get();
        return view('layoutAdmin.penggantian_alat_rusak.index', compact('rusak'));
    }

    public function show(GantiAlatRusak $rusak)
    {
        return view('layoutAdmin.penggantian_alat_rusak.detail', compact('rusak'));
    }

    public function download()
    {
        $rusak = GantiAlatRusak::orderBy('tanggal_input', 'desc')->get();
        $pdf = PDF::loadView('layoutAdmin.penggantian_alat_rusak.download', compact('rusak'));
        return $pdf->download('Penggantian Alat Rusak.pdf');
    }
}
