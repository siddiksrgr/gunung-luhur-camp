@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Detail Alat Sewa</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/alat_sewa">Alat Sewa</a></li>
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
            <h3 class="card-title">Data Detail Alat Sewa</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-2">
                    <p>Nama Alat</p>
                </div>
                <div class="col-10">
                    <p>: {{$alatsewa->nama}}</p>
                </div>
            </div>
            @if($alatsewa->kapasitas != null)
            <div class="row">
                <div class="col-2">
                    <p>Kapasitas</p>
                </div>
                <div class="col-10">
                    <p>: {{$alatsewa->kapasitas}}</p>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-2">
                    <p>Harga Sewa</p>
                </div>
                <div class="col-10">
                    <p>: @currency($alatsewa->harga_sewa)</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Harga Beli</p>
                </div>
                <div class="col-10">
                    <p>: @currency($alatsewa->harga_beli)</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Foto</p>
                </div>
                <div class="col-10">
                    <span>:</span>
                    <a href="{{ asset('img/alatsewa/' . $alatsewa->foto) }}" data-toggle="lightbox" data-title="{{$alatsewa->nama}}" data-gallery="gallery">
                        <img src="{{ asset('img/alatsewa/' . $alatsewa->foto) }}" style="height: 30px;width: 30px">
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Disewa</p>
                </div>
                <div class="col-10">
                    <p>: {{$alatsewa->sedang_disewa}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Stok</p>
                </div>
                <div class="col-10">
                    <p>: {{$alatsewa->stok}}</p>
                </div>
            </div>
            @if($alatsewa->keterangan != null)
            <div class="row">
                <div class="col-2">
                    <p>Keterangan</p>
                </div>
                <div class="col-10">
                    <p>: {{$alatsewa->keterangan}}</p>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-2">
                    <p>Tanggal Input</p>
                </div>
                <div class="col-10">
                    <p>: {{\Carbon\Carbon::parse($alatsewa->tanggal_input)->format('d-m-Y')}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Tanggal Update</p>
                </div>
                <div class="col-10">
                    <p>: {{\Carbon\Carbon::parse($alatsewa->tanggal_update)->format('d-m-Y')}}</p>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <a href="{{ url()->previous() }}"><button type="button" class="btn btn-secondary mt-3"><i class="fas fa-chevron-left"></i> Kembali</button></a>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection