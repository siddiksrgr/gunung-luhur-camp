@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Sewa Alat Tambahan</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Sewa Alat Tambahan</h3>
        </div>

        <!-- /.card-body -->
        <div class="col-lg-12">
            <div class="card-body table-responsive">

                @if(auth()->user()->level == 'pengelola')
                <a href="/penyewaan_tambahan/create"><button type="button" class="btn btn-sm btn-primary mb-3"><i class="fas fa-plus"></i> Tambah</button></a>
                @endif
                <a href="/penyewaan_tambahan/download"><button type="button" class="btn btn-sm btn-success mb-3"><i class="fas fa-download"></i> Download</button></a>

                <div class="card-body table-responsive p-0">
                    <table class="table table-bordered text-nowrap" id="datatable">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Pengunjung</th>
                                <th scope="col">Nama Alat</th>
                                <th scope="col">Harga Sewa</th>
                                <th scope="col">Lama Sewa</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Total Bayar</th>
                                <th scope="col">Status Sewa</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach($sewa_tambah as $sewa_tambah)
                                <td class="text-bold">{{$loop->iteration}}</td>
                                <td>{{$sewa_tambah->checkIn->pemesanan->user->nama}}</td>
                                <td>{{$sewa_tambah->sewaAlat->alatSewa->nama}}</td>
                                <td>@currency($sewa_tambah->sewaAlat->alatSewa->harga_sewa)/hari</td>
                                <td>{{$sewa_tambah->sewaAlat->lama_sewa}} hari</td>
                                <td>{{$sewa_tambah->sewaAlat->jumlah}}</td>
                                <td>@currency($sewa_tambah->sewaAlat->total_bayar)</td>

                                @php
                                $status_kembali = $sewa_tambah->sewaAlat->status_kembali;
                                if ($status_kembali == 0) {
                                $status = 'Sedang Disewa';
                                } elseif ($status_kembali == 1) {
                                $status = 'Sudah Dikembalikan';
                                }
                                @endphp

                                @if ($status == 'Sedang Disewa')
                                <td><span class="badge rounded-pill bg-danger">{{$status}}</span></td>
                                @elseif ($status == 'Sudah Dikembalikan')
                                <td><span class="badge rounded-pill bg-success">{{$status}}</span></td>
                                @endif

                                <td>
                                    <a href="/penyewaan_tambahan/{{$sewa_tambah->id}}/show" class="btn btn-primary btn-xs">Detail</a>
                                    @if($status_kembali == 0)
                                    <a href="/penyewaan_tambahan/{{$sewa_tambah->id}}/kembali" class="btn btn-warning btn-xs">Pengembalian</a>
                                    @endif
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