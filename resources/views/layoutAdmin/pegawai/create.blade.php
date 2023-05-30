@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Pegawai</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/pegawai">Pegawai</a></li>
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
            <h3 class="card-title">Form Tambah Data Pegawai</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        <form method="post" action="/pegawai">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="nama">Nama Pegawai:</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Pegawai.." required autofocus>
                </div>

                <div class="mt-4 mb-3">
                    <label class="form-label">Jenis Kelamin : </label>
                    <div class="form-check form-check-inline" style="margin-left: 10px;">
                        <input class="form-check-input" type="radio" name="jns_kelamin" id="jns_kelamin1" value="Laki-laki" checked>
                        <label class="form-check-label" for="jns_kelamin1">
                            Laki-laki
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jns_kelamin" id="jns_kelamin2" value="Perempuan">
                        <label class="form-check-label" for="jns_kelamin2">
                            Perempuan
                        </label>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="no_hp" class="form-label">Nomor Handphone :</label>
                    <input name="no_hp" type="number" id="no_hp" class="form-control" placeholder="Nomor Handphone" required>
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat :</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan alamat.." required>
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