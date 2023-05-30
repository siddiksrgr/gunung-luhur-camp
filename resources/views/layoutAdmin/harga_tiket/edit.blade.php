@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Data Lokasi</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/hargaTiket">Harga Tiket</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">Edit Data Lokasi</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="/hargaTiket/{{$hargaTiket->id}}" enctype="multipart/form-data">
            @method('patch')
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="harga">Harga Tiket :</label>
                    <input type="text" class="form-control " id="harga" name="harga" placeholder="Masukkan Harga.." value="{{$hargaTiket->harga}}">
                </div>

                <div class="form-group">
                    <label for="ket">Keterangan :</label>
                    <input type="text" class="form-control" id="ket" name="keterangan" placeholder="Masukkan Keterangan.." value="{{$hargaTiket->keterangan}}">
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                <a href="/hargaTiket"><button type="button" class="btn btn-secondary"><i class="fas fa-window-close"></i> Cancel</button></a>
            </div>
        </form>
    </div>

</section>
<!-- /.content -->
@endsection