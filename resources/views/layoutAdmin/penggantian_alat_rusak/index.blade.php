@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Penggantian Alat Rusak</h1>
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
                        <h3 class="card-title">Data Penggantian Alat Rusak</h3>
                    </div>
                    <div class="card-body">

                        <a href="/penggantian_alat/download"><button type="button" class="btn btn-sm btn-success mb-3"><i class="fas fa-download"></i> Download</button></a>

                        <div class="card-body table-responsive p-0">
                            <table class="table table-bordered text-nowrap" id="datatable">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Pengunjung</th>
                                        <th scope="col">Nama Alat</th>
                                        <th scope="col">Harga Beli</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Total Ganti</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($rusak as $rusak)
                                    <tr>
                                        <td class="text-bold">{{$loop->iteration}}</td>

                                        @if($rusak->pengembalian->sewaAlat->pemesanan_id == null)
                                        <td>{{$rusak->pengembalian->sewaAlat->sewaAlatTambah->checkIn->pemesanan->user->nama}}</td>
                                        @else
                                        <td>{{$rusak->pengembalian->sewaAlat->pemesanan->user->nama}}</td>
                                        @endif

                                        <td>{{$rusak->pengembalian->sewaAlat->alatSewa->nama}}</td>
                                        <td>@currency($rusak->pengembalian->sewaAlat->alatSewa->harga_beli)</td>
                                        <td>{{$rusak->pengembalian->jumlah_rusak}}</td>
                                        <td>@currency($rusak->total_ganti)</td>
                                        <td>{{$rusak->status}}</td>
                                        <td>
                                            <a href="/penggantian_alat/{{$rusak->id}}/show" class="btn btn-primary btn-xs">Detail</a>
                                        </td>
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