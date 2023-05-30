@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Form Edit Data Alat Sewa</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/alat_sewa">Alat Sewa</a></li>
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
            <h3 class="card-title">Form Edit Data Alat Sewa</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        <form method="post" action="/alat_sewa/{{$alatsewa->id}}" enctype="multipart/form-data">
            @method('patch') 
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="nama">Nama Alat :</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama.." value="{{$alatsewa->nama}}" required>
                </div>

                @if($alatsewa->kapasitas != null)
                <div class="form-group">
                    <label for="kapasitas">Kapasitas :</label>
                    <input type="number" class="form-control" id="kapasitas" name="kapasitas" placeholder="Masukkan Kapasitas Tenda.." value="{{$alatsewa->kapasitas}}">
                </div>
                @endif

                <div class="form-group">
                    <label for="harga_sewa">Harga Sewa:</label>
                    <input type="number" class="form-control" id="harga_sewa" name="harga_sewa" placeholder="Masukkan Harga Sewa.." value="{{$alatsewa->harga_sewa}}" required>
                </div>

                <div class="form-group">
                    <label for="harga_beli">Harga Beli:</label>
                    <input type="number" class="form-control" id="harga_beli" name="harga_beli" placeholder="Masukkan Harga Beli.." value="{{$alatsewa->harga_beli}}" required>
                </div>

                <div class="form-group">
                    <label for="stok">Stok :</label>
                    <input type="number" class="form-control" id="stok" name="stok" value="{{$alatsewa->stok}}" disabled>
                </div>

                <div class="form-group">
                    <label for="keterangan">Keterangan :</label>
                    <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{$alatsewa->keterangan}}">
                </div>

                <div class="form-group">
                    <label for="foto">Foto :</label><br>
                    <input type="file" id="foto" name="foto" placeholder="Masukkan Foto..">
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