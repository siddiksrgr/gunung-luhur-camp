@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Pemesanan Makanan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/pemesanan_makan">Pemesanan Makanan</a></li>
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
            <h3 class="card-title">Tambah Data Pemesanan Makanan</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="/pemesanan_makan">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Nama Pembeli :</label>
                    <select class="form-control" aria-label="Default select example" name="user" required>
                        @foreach ($checkIn as $checkIn)
                        <option value="{{$checkIn->pemesanan->user->id}}"><span>{{$checkIn->pemesanan->user->nama}}</span></option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Nama Makanan :</label>
                    <select class="form-control" aria-label="Default select example" name="makanan" required>
                        @foreach ($makanan as $makanan)
                        @if($makanan->tersedia == !null)
                        <option value="{{$makanan->id}}"><span>{{$makanan->nama}} - @currency($makanan->harga) - {{$makanan->keterangan}} - Tersedia {{$makanan->tersedia}}</span></option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Jumlah Beli :</label>
                    <input type="number" min="1" max="{{$makanan->tersedia}}" class="form-control" id="jumlah" name="jumlah" placeholder="Masukkan Jumlah Beli.." required>
                </div>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                <a href="/pemesanan_makan"><button type="button" class="btn btn-secondary"><i class="fas fa-window-close"></i> Cancel</button></a>
            </div>
        </form>
    </div>

</section>
<!-- /.content -->
@endsection