@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Shift Kerja Pegawai</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/shift_kerja">Shift Kerja Pegawai</a></li>
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
            <h3 class="card-title">Form Tambah Data Shift Kerja</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        <form method="post" action="/shift_kerja">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="nama">Nama Shift:</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Shift.." required autofocus>
                </div>

                <div class="mb-3">
                    <label for="jam_masuk" class="form-label">Jam Masuk :</label>
                    <input name="jam_masuk" type="text" id="jam_masuk" class="form-control" placeholder="Masukkan Jam Masuk.." required>
                </div>

                <div class="mb-3">
                    <label for="jam_pulang" class="form-label">Jam Pulang :</label>
                    <input name="jam_pulang" type="text" id="jam_pulang" class="form-control" placeholder="Masukkan Jam Pulang.." required>
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