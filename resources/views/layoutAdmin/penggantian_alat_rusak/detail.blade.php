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
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/penggantian_alat">Penggantian Alat Rusak</a></li>
                    <li class="breadcrumb-item active">Detail</li>
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
            <h3 class="card-title">Data Detail Penggantian Alat Rusak</h3>
        </div>

        <div class="card-body">

            @if($rusak->pengembalian->sewaAlat->sewaAlatTambah == null)
            <div class="row">
                <div class="col-2">
                    <p>Nama Pengunjung</p>
                </div>
                <div class="col-10">
                    <p>: {{$rusak->pengembalian->sewaAlat->pemesanan->user->nama}}</p>
                </div>
            </div>
            @else
            <div class="row">
                <div class="col-2">
                    <p>Nama Pengunjung</p>
                </div>
                <div class="col-10">
                    <p>: {{$rusak->pengembalian->sewaAlat->sewaAlatTambah->checkIn->pemesanan->user->nama}}</p>
                </div>
            </div>
            @endif

            <div class="row">
                <div class="col-2">
                    <p>Nama Alat</p>
                </div>
                <div class="col-10">
                    <p>: {{$rusak->pengembalian->sewaAlat->alatSewa->nama}}</p>
                </div>
            </div>

            @if($rusak->pengembalian->sewaAlat->alatSewa->kapasitas != null)
            <div class="row">
                <div class="col-2">
                    <p>Kapasitas Tenda</p>
                </div>
                <div class="col-10">
                    <p>: {{$rusak->pengembalian->sewaAlat->alatSewa->kapasitas}} orang</p>
                </div>
            </div>
            @endif

            <div class="row">
                <div class="col-2">
                    <p>Jumlah</p>
                </div>
                <div class="col-10">
                    <p>: {{$rusak->pengembalian->jumlah_rusak}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Tanggal Pengembalian</p>
                </div>
                <div class="col-10">
                    <p>: {{\Carbon\Carbon::parse($rusak->pengembalian->tanggal_input)->format('d-m-Y')}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Harga Beli</p>
                </div>
                <div class="col-10">
                    <p>: @currency($rusak->pengembalian->sewaAlat->alatSewa->harga_beli)</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Total Ganti</p>
                </div>
                <div class="col-10">
                    <p>: Harga Beli x Jumlah</p>
                    <p>: @currency($rusak->pengembalian->sewaAlat->alatSewa->harga_beli) x {{$rusak->pengembalian->jumlah_rusak}}</p>
                    <p>: @currency($rusak->pengembalian->sewaAlat->alatSewa->harga_beli * $rusak->pengembalian->jumlah_rusak)</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Status Bayar</p>
                </div>
                <div class="col-10">
                    <p>: {{$rusak->status}}</p>
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