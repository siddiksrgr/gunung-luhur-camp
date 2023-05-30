@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Check In</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Check In</h3>
        </div>
        <!-- /.card-header -->
        <div class="col-lg-12">
            <div class="card-body table-responsive">

                @if(auth()->user()->level == 'pengelola')
                <a href="/check_in/create"><button type="button" class="btn btn-sm btn-primary mb-3"><i class="fas fa-plus"></i> Tambah Check In</button></a>
                @endif
                <a href="/check_in/download"><button type="button" class="btn btn-sm btn-success mb-3"><i class="fas fa-download"></i> Download</button></a>

                <div class="card-body table-responsive p-0">
                    <table class="table table-bordered text-nowrap" id="datatable">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nomor Tiket</th>
                                <th scope="col">Nama Pengunjung</th>
                                <th scope="col">Tanggal Check In</th>
                                <th scope="col">Tanggal Check Out</th>
                                <th scope="col">Status</th>
                                <th scope="col">Tanggal Input</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($checkIn as $checkIn)
                            <tr>
                                <td class="text-bold">{{$loop->iteration}}</td>
                                <td>{{$checkIn->pemesanan->nomor_pesan}}</td>
                                <td>{{$checkIn->pemesanan->user->nama}}</td>
                                <td>{{\Carbon\Carbon::parse($checkIn->pemesanan->pesanTiket->tgl_check_in)->format('d-m-Y')}}</td>
                                <td>{{\Carbon\Carbon::parse($checkIn->pemesanan->pesanTiket->tgl_check_out)->format('d-m-Y')}}</td>

                                @php
                                $status = $checkIn->status;
                                if ($status == 0) {
                                $status = 'Sudah Check In';
                                }
                                if ($status == 1) {
                                $status = 'Sudah Check Out';
                                }
                                @endphp

                                @if ($status == 'Sudah Check In')
                                <td><span class="badge rounded-pill bg-success">Sudah Check In</span></td>
                                @elseif ($status == 'Sudah Check Out')
                                <td><span class="badge rounded-pill bg-danger">Sudah Check Out</span></td>
                                @endif

                                <td>{{\Carbon\Carbon::parse($checkIn->tanggal_input)->format('d-m-Y')}}</td>
                                <td>
                                    <a href="/check_in/{{$checkIn->id}}/show" class="btn btn-primary btn-xs">Detail</a>
                                </td>
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