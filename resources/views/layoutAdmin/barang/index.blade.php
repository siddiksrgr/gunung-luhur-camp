@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Barang Habis Pakai</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Barang Habis Pakai</h3>
        </div>
        <!-- /.card-header -->
        <div class="col-lg-12">
            <div class="card-body">

                @if(auth()->user()->level == 'pengelola')
                <a href="/brg_hbs_pakai/create"><button type="button" class="btn btn-sm btn-primary float-left mb-3 mr-1"><i class="fas fa-plus"></i> Tambah Baru</button></a>
                <a href="/brg_hbs_pakai/masuk"><button type="button" class="btn btn-sm btn-warning mb-3"><i class="fas fa-plus"></i> Tambah Stok</button></a>
                @endif
                <a href="/brg_hbs_pakai/download"><button type="button" class="btn btn-sm btn-success mb-3"><i class="fas fa-download"></i> Download</button></a>

                <div class="card-body table-responsive p-0">
                    <table class="table table-bordered text-nowrap" id="datatable">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Stok</th>
                                <th scope="col">Tanggal Input</th>
                                <th scope="col">Tanggal Update</th>

                                @if(auth()->user()->level == 'pengelola')
                                <th scope="col">Aksi</th>
                                @endif

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($barang as $barang)
                            <tr>
                                <td class="text-bold">{{$loop->iteration}}</td>
                                <td>{{$barang->nama}}</td>
                                <td>@currency($barang->harga) / <span>{{$barang->satuan}}</span></td>
                                <td>{{$barang->stok}} <span>{{$barang->satuan}}</span></td>
                                <td>{{\Carbon\Carbon::parse($barang->tanggal_input)->format('d-m-Y')}}</td>
                                <td>{{\Carbon\Carbon::parse($barang->tanggal_update)->format('d-m-Y')}}</td>

                                @if(auth()->user()->level == 'pengelola')
                                <td>
                                    <a href="/brg_hbs_pakai/{{$barang->id}}/edit" class="btn btn-warning btn-xs">Edit</a>
                                    <a href="/brg_hbs_pakai/{{$barang->id}}/destroy" class="btn btn-danger btn-xs" onclick="return confirm('Anda yakin akan menghapus data?')">Delete</a>
                                </td>
                                @endif

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