@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Check Out</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/check_out">Check Out</a></li>
                    <li class="breadcrumb-item active">Tambah Check Out</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">Form Tambah Data Check Out</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        <form method="post" action="/check_out">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="nomor">Nomor Tiket:</label>
                    <input type="text" class="form-control" id="nomor" name="nomor" placeholder="Masukkan Nomor Tiket.." required autofocus>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Check</button>
                <a href="/check_out"><button type="button" class="btn btn-secondary"><i class="fas fa-window-close"></i> Cancel</button></a>
            </div>
        </form>
    </div>

</section>
<!-- /.content -->
@endsection