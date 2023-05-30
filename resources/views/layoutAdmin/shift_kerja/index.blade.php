@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Shift Kerja Pegawai</h1>
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
                        <h3 class="card-title">Data Shift Kerja Pegawai</h3>
                    </div>
                    <div class="card-body">

                        @if(auth()->user()->level == 'pengelola')
                        <a href="/shift_kerja/create"><button type="button" class="btn btn-sm btn-primary mb-3"><i class="fas fa-plus"></i> Tambah</button></a>
                        @endif
                        <a href="/shift_kerja/download"><button type="button" class="btn btn-sm btn-success mb-3"><i class="fas fa-download"></i> Download</button></a>

                        <div class="card-body table-responsive p-0">
                            <table class="table table-bordered text-nowrap" id="datatable">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Shift</th>
                                        <th scope="col">Jam Masuk</th>
                                        <th scope="col">Jam Pulang</th>
                                        <th scope="col">Tanggal Input</th>
                                        <th scope="col">Tanggal Update</th>

                                        @if(auth()->user()->level == 'pengelola')
                                        <th scope="col">Aksi</th>
                                        @endif

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($shift as $shift)
                                    <tr>
                                        <td class="text-bold">{{$loop->iteration}}</td>
                                        <td>{{$shift->nama_shift}}</td>
                                        <td>{{$shift->jam_masuk}}</td>
                                        <td>{{$shift->jam_pulang}}</td>
                                        <td>{{\Carbon\Carbon::parse($shift->tanggal_input)->format('d-m-Y')}}</td>
                                        <td>{{\Carbon\Carbon::parse($shift->tanggal_update)->format('d-m-Y')}}</td>

                                        @if(auth()->user()->level == 'pengelola')
                                        <td>
                                            <a href="/shift_kerja/{{$shift->id}}/edit" class="btn btn-warning btn-xs">Edit</a>
                                            <a href="/shift_kerja/{{$shift->id}}/destroy" class="btn btn-danger btn-xs" onclick="return confirm('Anda yakin akan menghapus data?')">Delete</a>
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