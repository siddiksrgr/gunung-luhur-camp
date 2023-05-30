@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Penyewaan Tambahan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/check_out">Check Out</a></li>
                    <li class="breadcrumb-item active">Penyewaan Tambahan</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Penyewaan Tambahan</h3>
        </div>
        <!-- /.card-header -->
        <div class="col-lg-12">
            <div class="card-body table-responsive">
                <div class="card-body table-responsive p-0">
                    <table class="table table-bordered text-nowrap" id="datatable">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama User</th>
                                <th scope="col">Nama Alat</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Status Sewa</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sewa_alat_tambah as $sewa_alat_tambah)
                            <tr>
                                <td class="text-bold">{{$loop->iteration}}</td>

                                <td>{{$sewa_alat_tambah->checkIn->pemesanan->user->nama}}</td>

                                <td>{{$sewa_alat_tambah->sewaAlat->alatSewa->nama}}</td>
                                <td>{{$sewa_alat_tambah->sewaAlat->jumlah}}</td>

                                @php
                                $status_kembali = $sewa_alat_tambah->sewaAlat->status_kembali;
                                if ($status_kembali == 0) {
                                $status = 'Belum Dikembalikan';
                                } elseif ($status_kembali == 1) {
                                $status = 'Sudah Dikembalikan';
                                }
                                @endphp

                                @if ($status == 'Belum Dikembalikan')
                                <td><span class="badge rounded-pill bg-danger">{{$status}}</span></td>
                                @elseif ($status == 'Sudah Dikembalikan')
                                <td><span class="badge rounded-pill bg-success">{{$status}}</span></td>
                                @endif

                                <td>
                                    <a href="/check_out/penyewaan_tambahan/{{$sewa_alat_tambah->sewaAlat->id}}/detail" class="btn btn-primary btn-xs">Detail</a>
                                    @if($status_kembali == 0)
                                    <a href="/check_out/penyewaan_tambahan/{{$sewa_alat_tambah->sewaAlat->id}}/kembali" class="btn btn-warning btn-xs">Pengembalian</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <a href="/check_out"><button type="button" class="btn btn-secondary"><i class="fas fa-chevron-left"></i> Kembali</button></a>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection