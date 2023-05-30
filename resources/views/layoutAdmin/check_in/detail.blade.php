@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Detail Check In</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/check_in">Check In</a></li>
                    <li class="breadcrumb-item active">Detail Check In</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Detail Check In</h3>
        </div>

        <div class="card-body">
            <!-- nomor pesanan -->
            <div class="mb-4">
                <div class="row">
                    <div class="col-2">
                        <p>Nomor Tiket</p>
                    </div>
                    <div class="col-10">
                        <p>: {{$checkIn->pemesanan->nomor_pesan}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <p>Tanggal Pesan</p>
                    </div>
                    <div class="col-10">
                        <p>: {{\Carbon\Carbon::parse($checkIn->pemesanan->tanggal_pesan)->format('d-m-Y')}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <p>Tanggal Bayar</p>
                    </div>
                    <div class="col-10">
                        <p>: {{\Carbon\Carbon::parse($checkIn->pemesanan->konfirmasi->tanggal_bayar)->format('d-m-Y')}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <p>Tanggal Input</p>
                    </div>
                    <div class="col-10">
                        <p>: {{\Carbon\Carbon::parse($checkIn->tanggal_input)->format('d-m-Y')}}</p>
                    </div>
                </div>
            </div>

            <!-- tiket masuk -->
            <div class="mb-4">
                <div class="row text-bold">
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
                        <p>: @currency($checkIn->pemesanan->pesanTiket->hargaTiket->harga), {{$checkIn->pemesanan->pesanTiket->hargaTiket->keterangan}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <p>Tanggal Check In</p>
                    </div>
                    <div class="col-10">
                        <p>: {{\Carbon\Carbon::parse($checkIn->pemesanan->pesanTiket->tgl_check_in)->format('d-m-Y')}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <p>Tanggal Check Out</p>
                    </div>
                    <div class="col-10">
                        <p>: {{\Carbon\Carbon::parse($checkIn->pemesanan->pesanTiket->tgl_check_out)->format('d-m-Y')}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <p>Lama Menginap</p>
                    </div>
                    <div class="col-10">
                        <p>: {{$checkIn->pemesanan->pesanTiket->lama_menginap}} hari</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <p>Total Anggota</p>
                    </div>
                    <div class="col-10">
                        <p>: {{$checkIn->pemesanan->pesanTiket->total_anggota}} orang <span class="text-default">(pemesan dan jumlah anggota yang dibawa)</span></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <p>Total Bayar</p>
                    </div>
                    <div class="col-10">
                        <p>: Total Anggota x Lama Menginap x Harga Tiket</p>
                        <p>: {{$checkIn->pemesanan->pesanTiket->total_anggota}} x {{$checkIn->pemesanan->pesanTiket->lama_menginap}} x @currency($checkIn->pemesanan->pesanTiket->hargaTiket->harga)</p>
                        <p>: @currency($checkIn->pemesanan->pesanTiket->total_bayar)</p>
                    </div>
                </div>
            </div>

            <!-- sewa tenda -->
            @if(!empty($sewa_tenda))
            @foreach($sewa_tenda as $sewa_tenda)
            <div class="mb-4">
                <div class="row text-bold">
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


            <!-- total keseluruhan -->
            <div>
                <div class="row">
                    <div class="col-2">
                        <p>Kode Unik</p>
                    </div>
                    <div class="col-10">
                        <p>: {{$checkIn->pemesanan->kode_unik}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <p>Total Keseluruhan</p>
                    </div>
                    <div class="col-10">
                        <p>: @currency($checkIn->pemesanan->total_bayar + $checkIn->pemesanan->kode_unik)</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <a href="{{ url()->previous() }}"><button type="button" class="btn btn-secondary"><i class="fas fa-chevron-left"></i> Kembali</button></a>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection