@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Data Makanan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/makanan">Makanan</a></li>
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
            <h3 class="card-title">Edit Data Makanan</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="/makanan/{{$makanan->id}}" enctype="multipart/form-data">
            @method('patch')
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="nama">Nama :</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Paket.." value="{{$makanan->nama}}">
                </div>
                <div class="form-group">
                    <label for="harga">Harga :</label>
                    <input type="number" class="form-control " id="harga" name="harga" placeholder="Masukkan Harga Paket.." value="{{$makanan->harga}}">
                </div>
                <div class="form-group">
                    <label for="tersedia">Tersedia :</label>
                    <input type="number" class="form-control " id="tersedia" name="tersedia" placeholder="Masukkan Jumlah Tersedia.." value="{{$makanan->tersedia}}" disabled>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan :</label>
                    <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Masukkan Keterangan.." value="{{$makanan->keterangan}}">
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                <a href="/makanan"><button type="button" class="btn btn-secondary"><i class="fas fa-window-close"></i> Cancel</button></a>
            </div>
        </form>
    </div>

</section>
<!-- /.content -->
@endsection