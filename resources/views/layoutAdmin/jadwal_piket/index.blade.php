@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Jadwal Piket Pegawai</h1>
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
                        <h3 class="card-title">Data Jadwal Piket Pegawai</h3>
                    </div>
                    <div class="card-body">

                        @if(auth()->user()->level == 'pengelola')
                        <a href="/jadwal_piket/create"><button type="button" class="btn btn-sm btn-primary mb-3"><i class="fas fa-plus"></i> Tambah</button></a>

                        @if(count($jadwal) > 0)
                        <button type="button" class="btn btn-sm btn-success mb-3" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-print"></i> Print</button>
                        <a href="/jadwal_piket/deleteAll"><button type="button" class="btn btn-sm btn-danger mb-3" onclick="return confirm('Anda yakin akan menghapus semua data?')"><i class="fas fa-trash-alt"></i> Hapus Semua</button></a>
                        @endif

                        @endif

                        <div class="card-body table-responsive p-0">
                            <table class="table table-bordered text-nowrap" id="datatable">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Nama Pegawai</th>
                                        <th scope="col">Shift Kerja</th>

                                        @if(auth()->user()->level == 'pengelola')
                                        <th scope="col">Aksi</th>
                                        @endif

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($jadwal as $jadwal)
                                    <tr>
                                        <td class="text-bold">{{$loop->iteration}}</td>
                                        <td>{{\Carbon\Carbon::parse($jadwal->tanggal)->format('d-m-Y')}}</td>
                                        <td>{{$jadwal->pegawai->nama}}</td>
                                        <td>{{$jadwal->shift->nama_shift}}</td>

                                        @if(auth()->user()->level == 'pengelola')
                                        <td>
                                            <a href="/jadwal_piket/{{$jadwal->id}}/edit" class="btn btn-warning btn-xs">Edit</a>
                                            <a href="/jadwal_piket/{{$jadwal->id}}/destroy" class="btn btn-danger btn-xs" onclick="return confirm('Anda yakin akan menghapus data?')">Delete</a>
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


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="post" action="/jadwal_piket/print">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Input Bulan & Tahun</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="bulan">Bulan :</label>
                                <input type="text" class="form-control" id="bulan" name="bulan" placeholder="Masukkan Bulan.." required>
                            </div>
                            <div class="form-group">
                                <label for="tahun">Tahun :</label>
                                <input type="number" class="form-control" id="tahun" name="tahun" placeholder="Masukkan Tahun.." required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success"><i class="fas fa-print"></i> Print</button>
                        </div>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection