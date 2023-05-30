@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Detail Penggantian Alat Rusak</h1>
            </div>
            <div class="col-sm-6">
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Detail Penggantian Alat Rusak</h3>
        </div>

        <div class="card-body">

            @if($ganti->pengembalian->sewaAlat->sewaAlatTambah == null)
            <div class="row">
                <div class="col-2">
                    <p>Nama Pengunjung</p>
                </div>
                <div class="col-10">
                    <p>: {{$ganti->pengembalian->sewaAlat->pemesanan->user->nama}}</p>
                </div>
            </div>
            @else
            <div class="row">
                <div class="col-2">
                    <p>Nama Pengunjung</p>
                </div>
                <div class="col-10">
                    <p>: {{$ganti->pengembalian->sewaAlat->sewaAlatTambah->checkIn->pemesanan->user->nama}}</p>
                </div>
            </div>
            @endif

            <div class="row">
                <div class="col-2">
                    <p>Nama Alat</p>
                </div>
                <div class="col-10">
                    <p>: {{$ganti->pengembalian->sewaAlat->alatSewa->nama}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Jumlah</p>
                </div>
                <div class="col-10">
                    <p>: {{$ganti->pengembalian->jumlah_rusak}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Tanggal Pengembalian</p>
                </div>
                <div class="col-10">
                    <p>: {{\Carbon\Carbon::parse($ganti->pengembalian->tanggal_input)->format('d-m-Y')}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Harga Beli</p>
                </div>
                <div class="col-10">
                    <p>: @currency($ganti->pengembalian->sewaAlat->alatSewa->harga_beli)</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Total Ganti</p>
                </div>
                <div class="col-10">
                    <p>: Harga Beli x Jumlah</p>
                    <p>: @currency($ganti->pengembalian->sewaAlat->alatSewa->harga_beli) x {{$ganti->pengembalian->jumlah_rusak}}</p>
                    <p>: @currency($ganti->pengembalian->sewaAlat->alatSewa->harga_beli * $ganti->pengembalian->jumlah_rusak)</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Status Bayar</p>
                </div>
                <div class="col-10">
                    <p>: {{$ganti->status}}</p>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="button" onclick="history.back();" class="btn btn-secondary"><i class="fas fa-chevron-left"></i> Kembali</button>
        </div>

    </div>

</section>
<!-- /.content -->
@endsection