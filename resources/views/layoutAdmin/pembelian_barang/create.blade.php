@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Pembelian Barang Habis Pakai</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/beli_barang">Pembelian Barang Habis Pakai</a></li>
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
            <h3 class="card-title">Tambah Pembelian Barang Habis Pakai</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="/beli_barang">
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
                    <label>Nama Barang :</label>
                    <select class="form-control" aria-label="Default select example" name="barang" required>
                        @foreach ($barang as $barang)
                        @if ($barang->stok == !null)
                        <option value="{{$barang->id}}"><span>{{$barang->nama}} - @currency($barang->harga)/{{$barang->satuan}} (Sisa = {{$barang->stok}} {{$barang->satuan}})</span></option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Jumlah Beli :</label>
                    <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" placeholder="Masukkan Jumlah Beli.." required>
                    @error('jumlah')
                    <div class="error invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                <a href="/beli_barang"><button type="button" class="btn btn-secondary"><i class="fas fa-window-close"></i> Cancel</button></a>
            </div>
        </form>
    </div>

</section>
<!-- /.content -->
@endsection