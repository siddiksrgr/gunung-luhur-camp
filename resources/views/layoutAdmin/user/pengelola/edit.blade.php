@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit User Pengelola</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/user/pengelola">Pengelola</a></li>
                    <li class="breadcrumb-item active">Edit User Pengelola</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">Edit User Pengelola</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="/user/pengelola/{{$user->id}}/updatePengelola" enctype="multipart/form-data">
            @method('patch')
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="nama">Nama :</label>
                    <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama" value="{{$user->nama}}">
                </div>
                <div class="form-group">
                    <label for="jns_klmn">Jenis Kelamin :</label>
                    <div class="form-check form-check-inline" style="margin-left: 10px;">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin1" value="Laki-laki" @if($user->jenis_kelamin == 'Laki-laki'){ checked }@endif>
                        <label class="form-check-label" for="jenis_kelamin1">
                            Laki-laki
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin2" value="Perempuan" @if($user->jenis_kelamin == 'Perempuan'){ checked }@endif>
                        <label class="form-check-label" for="jenis_kelamin2">
                            Perempuan
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="no_hp">Nomor Handphone :</label>
                    <input name="no_hp" type="number" class="form-control" id="no_hp" placeholder="Nomor Handphone" value="{{$user->no_hp}}">
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat :</label>
                    <textarea name="alamat" type="text" class="form-control" id="alamat" rows="2" placeholder="Alamat">{{$user->alamat}}</textarea>
                </div>
                <div class="form-group">
                    <label for="username">Username :</label>
                    <input name="username" type="text" class="form-control" id="username" placeholder="Username" value="{{$user->username}}">
                </div>
                <div class="form-group">
                    <label for="foto" class="form-label">Foto : </label>
                    <input name="foto" type="file" id="foto" class="form-control" placeholder="foto">
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