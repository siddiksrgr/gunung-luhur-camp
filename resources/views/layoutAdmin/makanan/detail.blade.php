@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Detail Makanan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/makanan">Makanan</a></li>
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
            <h3 class="card-title">Data Detail Makanan</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-sm-2">
                    <p>Tanggal Input</p>
                </div>
                <div class="col-sm-10">
                    <p>: {{\Carbon\Carbon::parse($makanan->tanggal_input)->format('d-m-Y')}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <p>Tanggal Update</p>
                </div>
                <div class="col-sm-10">
                    <p>: {{\Carbon\Carbon::parse($makanan->tanggal_update)->format('d-m-Y')}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <p>Nama Makanan</p>
                </div>
                <div class="col-sm-10">
                    <p>: {{$makanan->nama}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <p>Harga</p>
                </div>
                <div class="col-sm-10">
                    <p>: @currency($makanan->harga)</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <p>Tersedia</p>
                </div>
                <div class="col-sm-10">
                    <p>: {{$makanan->tersedia}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <p>Keterangan</p>
                </div>
                <div class="col-sm-10">
                    <p>: {{$makanan->keterangan}}</p>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ url()->previous() }}"><button type="button" class="btn btn-secondary"><i class="fas fa-chevron-left"></i> Kembali</button></a>
        </div>

</section>
<!-- /.content -->
@endsection