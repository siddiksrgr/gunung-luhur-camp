@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Harga Tiket Masuk</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/hargaTiket">Harga Tiket Masuk</a></li>
                    <li class="breadcrumb-item active">Tambah</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">Form Tambah Data Harga Tiket Masuk</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        <form method="post" action="/hargaTiket">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="harga">Harga :</label>
                    <input type="number" class="form-control" id="harga" name="harga" placeholder="Masukkan Harga.." required autofocus>
                </div>

                <div class="form-group">
                    <label for="keterangan">Keterangan :</label>
                    <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Masukkan Keterangan..">
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                <a href="{{ url()->previous() }}"><button type="button" class="btn btn-secondary"><i class="fas fa-window-close"></i> Cancel</button></a>
            </div>
        </form>

    </div>

</section>
<!-- /.content -->
@endsection