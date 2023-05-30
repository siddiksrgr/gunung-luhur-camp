@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>User Admin</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data User Admin</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body mt-2">
            <div class="row">
                <div class="col-md-3 mt-3">
                    @if($admin->foto == null)
                    <a href="{{ asset('img/User/default.png') }}" data-toggle="lightbox" data-title="{{$admin->nama}}" data-gallery="gallery">
                        <img src="{{ asset('img/User/default.png') }}" class="ml-4 rounded" style="height: 200px;width: 200px">
                    </a>
                    @else
                    <a href="{{  asset('img/User/' . $admin->foto) }}" data-toggle="lightbox" data-title="{{$admin->nama}}" data-gallery="gallery">
                        <img src="{{ asset('img/User/' . $admin->foto) }}" class="ml-4 rounded" style="height: 200px;width: 200px">
                    </a>
                    @endif
                </div>
                <div class="col-md-9">
                    <table class="table mt-2">
                        <tbody>
                            <tr>
                                <td class="col-2">Nama</td>
                                <td class="col-1 text-center">:</td>
                                <td>{{$admin->nama}}</td>
                            </tr>
                            <tr>
                                <td class="col-2">Jenis Kelamin</td>
                                <td class="col-1 text-center">:</td>
                                <td>{{$admin->jenis_kelamin}}</td>
                            </tr>
                            <tr>
                                <td class="col-2">No HP</td>
                                <td class="col-1 text-center">:</td>
                                <td>{{$admin->no_hp}}</td>
                            </tr>
                            <tr>
                                <td class="col-2">Tanggal Daftar</td>
                                <td class="col-1 text-center">:</td>
                                <td>{{\Carbon\Carbon::parse($admin->tanggal_daftar)->format('d-m-Y')}}</td>
                            </tr>
                            <tr>
                                <td class="col-2">Alamat</td>
                                <td class="col-1 text-center">:</td>
                                <td>{{$admin->alamat}}</td>
                            </tr>
                            <tr>
                                <td class="col-2">Username</td>
                                <td class="col-1 text-center">:</td>
                                <td>{{$admin->username}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer">
            @if(auth()->user()->level == 'admin')
            <a href="/user/admin/{{$admin->id}}/edit"><button type="button" class="btn btn-primary"><i class="fas fa-edit"></i> Edit Profile</button></a>
            <a href="/user/admin/{{$admin->id}}/editPasswordAdmin"><button type="button" class="btn btn-success"><i class="fas fa-key"></i> Ganti Password</button></a>
            @endif
        </div>
        <!-- /.card-body -->
    </div>

</section>
<!-- /.content -->
@endsection