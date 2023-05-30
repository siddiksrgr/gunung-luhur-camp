@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Pembelian Barang Habis Pakai</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Pembelian Barang Habis Pakai</h3>
        </div>
        <!-- /.card-header -->
        <div class="col-lg-12">
            <div class="card-body table-responsive">

                @if(auth()->user()->level == 'pengelola')
                <a href="/beli_barang/create"><button type="button" class="btn btn-sm btn-primary mb-3"><i class="fas fa-plus"></i> Tambah</button></a>
                @endif
                <a href="/beli_barang/download"><button type="button" class="btn btn-sm btn-success mb-3"><i class="fas fa-download"></i> Download</button></a>

                <div class="card-body table-responsive p-0">
                    <table class="table table-bordered text-nowrap" id="datatable">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Pembeli</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Harga Barang</th>
                                <th scope="col">Jumlah Beli</th>
                                <th scope="col">Total Bayar</th>
                                <th scope="col">Tanggal Beli</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($beliBarang as $beliBarang)
                            <tr>
                                <td class="text-bold">{{$loop->iteration}}</td>
                                <td>{{$beliBarang->user->nama}}</td>
                                <td>{{$beliBarang->barang->nama}}</td>
                                <td>@currency($beliBarang->barang->harga) / <span>{{$beliBarang->barang->satuan}}</span></td>
                                <td>{{$beliBarang->jumlah}} <span>{{$beliBarang->barang->satuan}}</span></td>
                                <td>@currency($beliBarang->total_bayar)</td>
                                <td>{{\Carbon\Carbon::parse($beliBarang->tanggal_beli)->format('d-m-Y')}}</td>
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