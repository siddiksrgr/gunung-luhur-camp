@extends('layoutUser/main')

@section('container1')
<div class="container mt-4">
    <div class="card shadow p-3 mb-5 bg-body rounded">
        <h5 class="card-header text-center">Detail Pemesanan Yang Telah Dikonfirmasi</h5>

        <!-- nomor pesanan -->
        <div class="card-body">
            <div class="row">
                <div class="col-2">
                    <p>Nomor Pesanan</p>
                </div>
                <div class="col-10">
                    <p>: {{$pemesanan->nomor_pesan}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Tanggal Pesan</p>
                </div>
                <div class="col-10">
                    <p>: {{\Carbon\Carbon::parse($pemesanan->tanggal_pesan)->format('d-m-Y')}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Tanggal Bayar</p>
                </div>
                <div class="col-10">
                    <p>: {{\Carbon\Carbon::parse($pemesanan->konfirmasi->tanggal_bayar)->format('d-m-Y')}}</p>
                </div>
            </div>
        </div>

        <!-- pesan tiket -->
        <div class="card-body">
            <p class="fw-bold">Detail Pemesanan :</p>
            <div class="row fw-bold">
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
                    <p>: @currency($pemesanan->pesanTiket->hargaTiket->harga), {{$pemesanan->pesanTiket->hargaTiket->keterangan}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Tanggal Check In</p>
                </div>
                <div class="col-10">
                    <p>: {{\Carbon\Carbon::parse($pemesanan->pesanTiket->tgl_check_in)->format('d-m-Y')}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Tanggal Check Out</p>
                </div>
                <div class="col-10">
                    <p>: {{\Carbon\Carbon::parse($pemesanan->pesanTiket->tgl_check_out)->format('d-m-Y')}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Lama Menginap</p>
                </div>
                <div class="col-10">
                    <p>: {{$pemesanan->pesanTiket->lama_menginap}} hari</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Total Anggota</p>
                </div>
                <div class="col-10">
                    <p>: {{$pemesanan->pesanTiket->total_anggota}} orang <span class="text-default">(pemesan dan jumlah anggota yang dibawa)</span></p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Total Bayar</p>
                </div>
                <div class="col-10">
                    <p>: Total Anggota x Lama Menginap x Harga Tiket</p>

                    <p>: {{$pemesanan->pesanTiket->total_anggota}} x {{$pemesanan->pesanTiket->lama_menginap}} x @currency($pemesanan->pesanTiket->hargaTiket->harga)</p>

                    <p>: @currency($pemesanan->pesanTiket->total_bayar)</p>
                </div>
            </div>

            @php
            $status_pesan = $pemesanan->pesanTiket->pemesanan->status_pesan;
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

        <!-- sewa tenda -->
        @if(!empty($sewa_tenda))
        @foreach($sewa_tenda as $sewa_tenda)
        <div class="card-body">
            <div class="row fw-bold">
                <div class="col-2">
                    <p>Nama Pemesanan</p>
                </div>
                <div class="col-10">
                    <p>: Sewa Tenda</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Nama Tenda</p>
                </div>
                <div class="col-10">
                    <p>: {{$sewa_tenda->alatSewa->nama}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Kapasitas Tenda</p>
                </div>
                <div class="col-10">
                    <p>: {{$sewa_tenda->alatSewa->kapasitas}} orang</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Jumlah</p>
                </div>
                <div class="col-10">
                    <p>: {{$sewa_tenda->jumlah}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Tanggal Pinjam</p>
                </div>
                <div class="col-10">
                    <p>: {{\Carbon\Carbon::parse($sewa_tenda->tanggal_pinjam)->format('d-m-Y')}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Tanggal Kembali</p>
                </div>
                <div class="col-10">
                    <p>: {{\Carbon\Carbon::parse($sewa_tenda->tanggal_kembali)->format('d-m-Y')}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Lama Sewa</p>
                </div>
                <div class="col-10">
                    <p>: {{$sewa_tenda->lama_sewa}} hari</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Harga Sewa</p>
                </div>
                <div class="col-10">
                    <p>: @currency($sewa_tenda->alatSewa->harga_sewa)/hari</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Total Bayar</p>
                </div>
                <div class="col-10">
                    <p>: Jumlah x Lama Sewa x Harga Sewa</p>
                    <p>: {{$sewa_tenda->jumlah}} x {{$sewa_tenda->lama_sewa}} x @currency($sewa_tenda->alatSewa->harga_sewa)</p>
                    <p>: @currency($sewa_tenda->jumlah * $sewa_tenda->lama_sewa * $sewa_tenda->alatSewa->harga_sewa)</p>
                </div>
            </div>

            @php
            $status_pesan = $sewa_tenda->pemesanan->status_pesan;
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
        @endforeach
        @endif

        <div class="card-body">
            <p>Kode Unik : {{$pemesanan->kode_unik}}</p>
            <p>Total Keseluruhan : @currency($pemesanan->total_bayar + $pemesanan->kode_unik)</p>
        </div>

        <div class="card-footer">
            <a href="{{ url()->previous() }}"><button type="button" class="btn btn-secondary rounded-pill mt-3"><i class="bi bi-chevron-left"></i> Kembali</button></a>
        </div>
    </div>
</div>
@endsection