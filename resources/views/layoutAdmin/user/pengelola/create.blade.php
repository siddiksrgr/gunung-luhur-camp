@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Pengelola</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/user/pengelola">Pengelola</a></li>
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
            <h3 class="card-title">Form Tambah Data Pengelola</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        <form method="post" action="/user/pengelola" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="mb-3">
                    <label for="inputName" class="form-label">Nama :</label>
                    <input name="nama" type="text" id="inputName" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama" required autofocus value="{{old('nama')}}">
                    @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-4 mb-3">
                    <label class="form-label">Jenis Kelamin : </label>
                    <div class="form-check form-check-inline" style="margin-left: 10px;">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin1" value="Laki-laki" checked>
                        <label class="form-check-label" for="jenis_kelamin1">
                            Laki-laki
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin2" value="Perempuan">
                        <label class="form-check-label" for="jenis_kelamin2">
                            Perempuan
                        </label>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="no_hp" class="form-label">Nomor Handphone :</label>
                    <input name="no_hp" type="number" id="no_hp" class="form-control @error('no_hp') is-invalid @enderror" placeholder="Nomor Handphone" required autofocus value="{{old('no_hp')}}">
                    @error('no_hp')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat :</label>
                    <textarea name="alamat" class="form-control" id="alamat" rows="2" placeholder="Alamat" required autofocus>{{ Request::old('alamat') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label">Username : <span class="text-muted">(untuk login)</span></label>
                    <input name="username" type="text" id="username" class="form-control @error('username') is-invalid @enderror" placeholder="Username" required value="{{old('username')}}">
                    @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="login_password" class="form-label">Password : <span class="text-muted">(untuk login)</span> </label>
                    <div class="input-group">
                        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="login_password" placeholder="Password" required>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Ulangi Password : <span class="text-muted">(untuk login)</span> </label>
                    <div class="input-group">
                        <input name="password_confirmation" type="password" class="form-control @error('password') is-invalid @enderror" id="password_confirmation" placeholder="Ulangi Password" required>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="foto" class="form-label">Foto : </label> <br>
                    <input name="foto" type="file" id="foto" placeholder="foto">
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