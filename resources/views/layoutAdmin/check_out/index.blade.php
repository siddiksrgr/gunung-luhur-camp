@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Check Out</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Check Out</h3>
        </div>
        <!-- /.card-header -->
        <div class="col-lg-12">
            <div class="card-body table-responsive">

                @if(auth()->user()->level == 'pengelola')
                <a href="/check_out/create"><button type="button" class="btn btn-sm btn-primary mb-3"><i class="fas fa-plus"></i> Tambah Check Out</button></a>
                @endif

                <a href="/check_out/download"><button type="button" class="btn btn-sm btn-success mb-3"><i class="fas fa-download"></i> Download</button></a>

                <div class="card-body table-responsive p-0">
                    <table class="table table-bordered text-nowrap" id="datatable">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nomor Tiket</th>
                                <th scope="col">Nama Pengunjung</th>
                                <th scope="col">Tanggal Check In</th>
                                <th scope="col">Tanggal Check Out</th>
                                <th scope="col">Tanggal Input</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($checkOut as $checkOut)
                            <tr>
                                <td class="text-bold">{{$loop->iteration}}</td>
                                <td>{{$checkOut->checkIn->pemesanan->nomor_pesan}}</td>
                                <td>{{$checkOut->checkIn->pemesanan->user->nama}}</td>
                                <td>{{\Carbon\Carbon::parse($checkOut->checkIn->pemesanan->pesanTiket->tgl_check_in)->format('d-m-Y')}}</td>
                                <td>{{\Carbon\Carbon::parse($checkOut->checkIn->pemesanan->pesanTiket->tgl_check_out)->format('d-m-Y')}}</td>
                                <td>{{\Carbon\Carbon::parse($checkOut->tanggal_input)->format('d-m-Y')}}</td>
                                <td>
                                    <a href="/check_out/{{$checkOut->id}}/show" class="btn btn-primary btn-xs">Detail</a>
                                    <a href="/check_out/penyewaan_tenda/{{$checkOut->id}}" class="btn btn-success btn-xs">Penyewaan Tenda</a>
                                    <a href="/check_out/penyewaan_tambahan/{{$checkOut->id}}" class="btn btn-warning btn-xs">Penyewaan Tambahan</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection