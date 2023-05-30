@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Stok Makanan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/brg_hbs_pakai">Makanan</a></li>
                    <li class="breadcrumb-item active">Tambah Stok</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">Form Tambah Data Stok Makanan</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        <form method="post" action="/makananStok">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="nama">Nama Makanan:</label>
                    <select class="form-control" aria-label="Default select example" name="makanan" required>
                        @foreach ($makanan as $makanan)
                        <option value="{{$makanan->id}}">
                            <span>{{$makanan->nama}} (Stok = {{$makanan->tersedia}})</span>
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="tambah_stok">Stok :</label>
                    <input type="number" class="form-control" id="tambah_stok" name="tambah_stok" placeholder="Masukkan Stok.." required>
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