@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>User Pengelola</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data User Pengelola</h3>
        </div>
        <!-- /.card-header -->
        @if($pengelola == null)
        <div class="p-3">
            <a href="/user/pengelola/create"><button type="button" class="btn btn-sm btn-primary mb-3"><i class="fas fa-plus"></i> Tambah</button></a>
            <p>Tidak Ada Data</p>
        </div>
        @else
        <div class="card-body mt-2">
            <div class="row">
                <div class="col-md-3 mt-3">
                    @if($pengelola->foto == null)
                    <a href="{{ asset('img/User/default.png') }}" data-toggle="lightbox" data-title="{{$pengelola->nama}}" data-gallery="gallery">
                        <img src="{{ asset('img/User/default.png') }}" class="ml-4 rounded" style="height: 200px;width: 200px">
                    </a>
                    @else
                    <a href="{{  asset('img/User/' . $pengelola->foto) }}" data-toggle="lightbox" data-title="{{$pengelola->nama}}" data-gallery="gallery">
                        <img src="{{ asset('img/User/' . $pengelola->foto) }}" class="ml-4 rounded" style="height: 200px;width: 200px">
                    </a>
                    @endif
                </div>
                <div class="col-md-9">
                    <table class="table mt-2">
                        <tbody>
                            <tr>
                                <td class="col-2">Nama</td>
                                <td class="col-1 text-center">:</td>
                                <td>{{$pengelola->nama}}</td>
                            </tr>
                            <tr>
                                <td class="col-2">Jenis Kelamin</td>
                                <td class="col-1 text-center">:</td>
                                <td>{{$pengelola->jenis_kelamin}}</td>
                            </tr>
                            <tr>
                                <td class="col-2">No HP</td>
                                <td class="col-1 text-center">:</td>
                                <td>{{$pengelola->no_hp}}</td>
                            </tr>
                            <tr>
                                <td class="col-2">Tanggal Daftar</td>
                                <td class="col-1 text-center">:</td>
                                <td>{{\Carbon\Carbon::parse($pengelola->tanggal_daftar)->format('d-m-Y')}}</td>
                            </tr>
                            <tr>
                                <td class="col-2">Alamat</td>
                                <td class="col-1 text-center">:</td>
                                <td>{{$pengelola->alamat}}</td>
                            </tr>
                            <tr>
                                <td class="col-2">Username</td>
                                <td class="col-1 text-center">:</td>
                                <td>{{$pengelola->username}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="/user/pengelola/{{$pengelola->id}}/edit"><button type="button" class="btn btn-primary"><i class="fas fa-edit"></i> Edit Profile</button></a>
            <a href="/user/pengelola/{{$pengelola->id}}/editPasswordPengelola"><button type="button" class="btn btn-success"><i class="fas fa-key"></i> Ganti Password</button></a>

            @if(auth()->user()->level == 'admin')
            <a href="/user/pengelola/{{$pengelola->id}}/destroy"><button type="button" onclick="return confirm('Anda yakin akan menghapus data user pengelola?')" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete Pengelola</button></a>
            @endif

        </div>
        @endif
    </div>

</section>
<!-- /.content -->
@endsection