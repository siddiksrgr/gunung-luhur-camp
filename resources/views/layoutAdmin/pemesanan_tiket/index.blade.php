@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Pemesanan Tiket</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Pemesanan Tiket</h3>
        </div>
        <!-- /.card-header -->
        <div class="col-lg-12">
            <div class="card-body table-responsive">

                <a href="/pemesanan_tiket/downloadAdmin"><button type="button" class="btn btn-sm btn-success mb-3"><i class="fas fa-download"></i> Download</button></a>

                <div class="card-body table-responsive p-0">
                    <table class="table table-bordered text-nowrap" id="datatable">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Nomor Tiket</th>
                                <th scope="col">Check In</th>
                                <th scope="col">Check Out</th>
                                <th scope="col">Kode Unik</th>
                                <th scope="col">Total Bayar</th>
                                <th scope="col">Tanggal Pesan</th>
                                <th scope="col">Status Bayar</th>
                                <th scope="col">Status Pesan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pemesanan as $pemesanan)
                            <tr>
                                <td class="text-bold">{{$loop->iteration}}</td>
                                <td>{{$pemesanan->user->nama}}</td>
                                <td>{{$pemesanan->nomor_pesan}}</td>
                                <td>{{\Carbon\Carbon::parse($pemesanan->pesanTiket->tgl_check_in)->format('d-m-Y')}}</td>
                                <td>{{\Carbon\Carbon::parse($pemesanan->pesanTiket->tgl_check_out)->format('d-m-Y')}}</td>
                                <td>{{$pemesanan->kode_unik}}</td>
                                <td>@currency($pemesanan->total_bayar + $pemesanan->kode_unik)</td>
                                <td>{{\Carbon\Carbon::parse($pemesanan->tanggal_pesan)->format('d-m-Y')}}</td>

                                @php
                                $status = $pemesanan->status_pesan;
                                if ($status == 0) {
                                $status = 'Belum Bayar';
                                }elseif ($status == 1) {
                                $status = 'Sudah Bayar';
                                } elseif ($status == 2) {
                                $status = 'Sudah Divalidasi';
                                }
                                @endphp

                                @if ($status == 'Belum Bayar')
                                <td><span class="badge rounded-pill bg-danger">{{$status}}</span></td>
                                @elseif ($status == 'Sudah Bayar')
                                <td><span class="badge rounded-pill bg-primary">{{$status}}</span></td>
                                @elseif ($status == 'Sudah Divalidasi')
                                <td><span class="badge rounded-pill bg-success">{{$status}}</span></td>
                                @endif

                                @if ($pemesanan->batalTiket == null)
                                <td><span class="badge rounded-pill bg-success">Diproses</span></td>
                                @elseif ($pemesanan->batalTiket !== null)
                                <td><span class="badge rounded-pill bg-danger">Dibatalkan</span></td>
                                @endif

                                <td>
                                    <a href="/pemesanan_tiket/{{$pemesanan->id}}/showAdmin" class="btn btn-primary btn-xs">Detail</a>
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