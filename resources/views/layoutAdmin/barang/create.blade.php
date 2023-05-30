@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Barang Habis Pakai</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/brg_hbs_pakai">Barang Habis Pakai</a></li>
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
            <h3 class="card-title">Tambah Data Barang Habis Pakai</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="/brg_hbs_pakai" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="nama">Nama :</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Barang.." required>
                </div>
                <div class="form-group">
                    <label for="harga">Harga :</label>
                    <input type="number" class="form-control " id="harga" name="harga" placeholder="Masukkan Harga Barang.." required>
                </div>
                <div class="form-group">
                    <label for="satuan">Satuan :</label>
                    <input type="text" class="form-control" id="satuan" name="satuan" placeholder="Masukkan Satuan.." required>
                </div>
                <div class="form-group">
                    <label for="stok">Stok :</label>
                    <input type="number" class="form-control" id="stok" name="stok" placeholder="Masukkan Stok.." required>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                <a href="/brg_hbs_pakai"><button type="button" class="btn btn-secondary"><i class="fas fa-window-close"></i> Cancel</button></a>
            </div>
        </form>
    </div>

</section>
<!-- /.content -->
@endsection