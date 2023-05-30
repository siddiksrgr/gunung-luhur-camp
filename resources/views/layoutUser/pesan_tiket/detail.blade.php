@extends('layoutUser.main')

@section('container1')
<div class="container mb-4"><br>
    <div class="card shadow p-3 mb-3 bg-body rounded">
        <h5 class="card-header mb-3 text-center">Detail Pemesanan Tiket Masuk</h5>
        <div class="card-body">
            <div class="row">
                <div class="col-2">
                    <p>Tanggal Pesan</p>
                </div>
                <div class="col-10">
                    <p>: {{\Carbon\Carbon::parse($pesanTiket->pemesanan->tanggal_pesan)->format('d-m-Y')}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Nama Pemesanan</p>
                </div>
                <div class="col-10">
                    <p>: Tiket Masuk</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Harga Tiket</p>
                </div>
                <div class="col-10">
                    <p>: @currency($pesanTiket->hargaTiket->harga), {{$pesanTiket->hargaTiket->keterangan}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Tanggal Check In</p>
                </div>
                <div class="col-10">
                    <p>: {{\Carbon\Carbon::parse($pesanTiket->tgl_check_in)->format('d-m-Y')}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Tanggal Check Out</p>
                </div>
                <div class="col-10">
                    <p>: {{\Carbon\Carbon::parse($pesanTiket->tgl_check_out)->format('d-m-Y')}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Lama Menginap</p>
                </div>
                <div class="col-10">
                    <p>: {{$pesanTiket->lama_menginap}} hari</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Total Anggota</p>
                </div>
                <div class="col-10">
                    <p>: {{$pesanTiket->total_anggota}} orang</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Total Bayar</p>
                </div>
                <div class="col-10">
                    <p>: Total Anggota x Lama Menginap x Harga Tiket</p>

                    <p>: {{$pesanTiket->total_anggota}} x {{$pesanTiket->lama_menginap}} x @currency($pesanTiket->hargaTiket->harga)</p>

                    <p>: @currency($pesanTiket->total_bayar)</p>
                </div>
            </div>

            @php
            $status_pesan = $pesanTiket->pemesanan->status_pesan;
            if ($status_pesan == 0) {
            $status_bayar = 'Belum Bayar';
            }else
            $status_bayar = 'Sudah Bayar';
            @endphp

            <div class="row">
                <div class="col-2">
                    <p>Status Bayar</p>
                </div>
                <div class="col-10">
                    <p>: {{$status_bayar}}</p>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ url()->previous() }}"><button type="button" class="btn btn-secondary rounded-pill mt-3"><i class="bi bi-chevron-left"></i> Kembali</button></a>
        </div>
    </div>
</div>
@endsection