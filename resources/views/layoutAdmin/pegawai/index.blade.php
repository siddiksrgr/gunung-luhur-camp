@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Pegawai</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Pegawai</h3>
                    </div>
                    <div class="card-body">

                        @if(auth()->user()->level == 'pengelola')
                        <a href="/pegawai/create"><button type="button" class="btn btn-sm btn-primary mb-3"><i class="fas fa-plus"></i> Tambah</button></a>
                        @endif
                        <a href="/pegawai/download"><button type="button" class="btn btn-sm btn-success mb-3"><i class="fas fa-download"></i> Download</button></a>

                        <div class="card-body table-responsive p-0">
                            <table class="table table-bordered text-nowrap" id="datatable">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Jenis Kelamin</th>
                                        <th scope="col">Nomor HP</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col">Tanggal Input</th>
                                        <th scope="col">Tanggal Update</th>

                                        @if(auth()->user()->level == 'pengelola')
                                        <th scope="col">Aksi</th>
                                        @endif

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pegawai as $pegawai)
                                    <tr>
                                        <td class="text-bold">{{$loop->iteration}}</td>
                                        <td>{{$pegawai->nama}}</td>
                                        <td>{{$pegawai->jns_kelamin}}</td>
                                        <td>{{$pegawai->no_hp}}</td>
                                        <td>{{$pegawai->alamat}}</td>
                                        <td>{{\Carbon\Carbon::parse($pegawai->tanggal_input)->format('d-m-Y')}}</td>
                                        <td>{{\Carbon\Carbon::parse($pegawai->tanggal_update)->format('d-m-Y')}}</td>

                                        @if(auth()->user()->level == 'pengelola')
                                        <td>
                                            <a href="/pegawai/{{$pegawai->id}}/edit" class="btn btn-warning btn-xs">Edit</a>
                                            <a href="/pegawai/{{$pegawai->id}}/destroy" class="btn btn-danger btn-xs" onclick="return confirm('Anda yakin akan menghapus data?')">Delete</a>
                                        </td>
                                        @endif

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection