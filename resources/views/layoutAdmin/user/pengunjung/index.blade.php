@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>User Pengunjung</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data User Pengunjung</h3>
        </div>
        <!-- /.card-header -->
        <div class="col-lg-12">
            <div class="card-body table-responsive">

                <a href="/user/pengunjung/download"><button type="button" class="btn btn-sm btn-success mb-3"><i class="fas fa-download"></i> Download</button></a>

                <div class="card-body table-responsive p-0">
                    <table class="table table-bordered text-nowrap" id="datatable">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Jenis Kelamin</th>
                                <th scope="col">No HP</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Username</th>
                                <th scope="col">Foto</th>
                                <th scope="col">Tanggal Daftar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pengunjung as $pengunjung)
                            <tr>
                                <td class="text-bold">{{$loop->iteration}}</td>
                                <td>{{$pengunjung->nama}}</td>
                                <td>{{$pengunjung->jenis_kelamin}}</td>
                                <td>{{$pengunjung->no_hp}}</td>
                                <td>{{$pengunjung->alamat}}</td>
                                <td>{{$pengunjung->username}}</td>

                                @if($pengunjung->foto == null)
                                <td>
                                    <a href="{{ asset('img/User/default.png') }}" data-toggle="lightbox" data-title="{{$pengunjung->nama}}" data-gallery="gallery">
                                        <img src="{{ asset('img/User/default.png') }}" class="rounded" style="height: 30px;width: 30px">
                                    </a>
                                </td>
                                @else
                                <td>
                                    <a href="{{  asset('img/User/' . $pengunjung->foto) }}" data-toggle="lightbox" data-title="{{$pengunjung->nama}}" data-gallery="gallery">
                                        <img src="{{ asset('img/User/' . $pengunjung->foto) }}" class="ml-4 rounded" style="height: 30px;width: 30px">
                                    </a>
                                </td>
                                @endif

                                <td>{{\Carbon\Carbon::parse($pengunjung->tanggal_daftar)->format('d-m-Y')}}</td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>

</section>
<!-- /.content -->
@endsection