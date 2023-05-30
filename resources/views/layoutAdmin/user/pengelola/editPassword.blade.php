@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Ganti Password Pengelola</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/user/pengelola">Pengelola</a></li>
                    <li class="breadcrumb-item active">Ganti Password Pengelola</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">Ganti Password Pengelola</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="/user/pengelola/{{$user->id}}/updatePasswordPengelola" enctype="multipart/form-data">
            @method('patch')
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <label for="password" class="form-label">Password Baru :</label>
                        <div class="input-group">
                            <input name="password" type="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password Baru" required autofocus>
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label">Ulangi Password :</label>
                        <div class="input-group">
                            <input name="password_confirmation" type="password" id="password_confirmation" class="form-control @error('password') is-invalid @enderror" placeholder="Ulangi Password" required>
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                <a href="/user/pengelola"><button type="button" class="btn btn-secondary"><i class="fas fa-window-close"></i> Cancel</button></a>
            </div>
        </form>
    </div>

</section>
<!-- /.content -->
@endsection