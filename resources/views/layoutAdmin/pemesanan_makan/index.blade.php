@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Pemesanan Makanan</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Pemesanan Makanan</h3>
        </div>
        <!-- /.card-header -->
        <div class="col-lg-12">
            <div class="card-body table-responsive">

                @if(auth()->user()->level == 'pengelola')
                <a href="/pemesanan_makan/create"><button type="button" class="btn btn-sm btn-primary mb-3"><i class="fas fa-plus"></i> Tambah</button></a>
                @endif
                <a href="/pemesanan_makan/download"><button type="button" class="btn btn-sm btn-success mb-3"><i class="fas fa-download"></i> Download</button></a>

                <div class="card-body table-responsive p-0">
                    <table class="table table-bordered text-nowrap" id="datatable">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Pengunjung</th>
                                <th scope="col">Nama Makanan</th>
                                <th scope="col">Harga Makanan</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Total Bayar</th>
                                <th scope="col">Tanggal Pesan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pesan_makan as $pesan)
                            <tr>
                                <td class="text-bold">{{$loop->iteration}}</td>
                                <td>{{$pesan->user->nama}}</td>
                                <td>{{$pesan->makanan->nama}}</td>
                                <td>@currency($pesan->makanan->harga)</td>
                                <td>{{$pesan->jumlah}}</td>
                                <td>@currency($pesan->total_bayar)</td>
                                <td>{{\Carbon\Carbon::parse($pesan->tanggal_pesan)->format('d-m-Y')}}</td>
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