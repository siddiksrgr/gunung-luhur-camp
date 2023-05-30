@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Pembatalan Tiket</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Pembatalan Tiket</h3>
        </div>
        <!-- /.card-header -->
        <div class="col-lg-12">
            <div class="card-body table-responsive">

                <a href="/pembatalan_tiket/download"><button type="button" class="btn btn-sm btn-success mb-3"><i class="fas fa-download"></i> Download</button></a>

                <div class="card-body table-responsive p-0">
                    <table class="table table-bordered text-nowrap" id="datatable">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nomor Rekening</th>
                                <th scope="col">Atas Nama</th>
                                <th scope="col">Jumlah Refund</th>
                                <th scope="col">Alasan Batal</th>
                                <th scope="col">Status Refund</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($batalTiket as $batalTiket)
                            <tr>
                                <td class="text-bold">{{$loop->iteration}}</td>
                                <td>{{$batalTiket->no_rekening}}</td>
                                <td>{{$batalTiket->atas_nama}}</td>
                                <td>@currency($batalTiket->pemesanan->total_bayar + $batalTiket->pemesanan->kode_unik)</td>
                                <td>{{$batalTiket->alasan}}</td>

                                @php
                                $status_refund= $batalTiket->status_refund;
                                if ($status_refund == 0) {
                                $status = 'Diajukan refund, menunggu proses refund';
                                } elseif ($status_refund == 1) {
                                $status = 'Sudah direfund';
                                }
                                @endphp

                                @if ($status == 'Diajukan refund, menunggu proses refund')
                                <td><span class="badge rounded-pill bg-danger">{{$status}}</span></td>
                                @elseif ($status == 'Sudah direfund')
                                <td><span class="badge rounded-pill bg-success">{{$status}}</span></td>
                                @endif

                                <td>
                                    <a href="/pembatalan_tiket/{{$batalTiket->id}}/show" class="btn btn-primary btn-xs">Detail</a>
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