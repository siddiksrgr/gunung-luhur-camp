@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Lokasi</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/lokasi">Lokasi</a></li>
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
            <h3 class="card-title">Tambah Data Lokasi</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="/lokasi">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="alamat">Alamat :</label>
                    <input type="textarea" class="form-control" id="alamat" name="alamat" placeholder="Masukkan alamat.." required autofocus>
                </div>
                <div class="form-group">
                    <label for="no_hp">Nomor Handphone :</label>
                    <input type="number" class="form-control " id="no_hp" name="no_hp" placeholder="Masukkan No HP.." required>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                <a href="/lokasi"><button type="button" class="btn btn-secondary"><i class="fas fa-window-close"></i> Cancel</button></a>
            </div>
        </form>
    </div>

</section>
<!-- /.content -->
@endsection