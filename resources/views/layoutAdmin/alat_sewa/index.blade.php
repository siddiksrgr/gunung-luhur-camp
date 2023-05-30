@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Alat Sewa</h1>
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
                        <h3 class="card-title">Data Alat Sewa</h3>
                    </div>
                    <div class="card-body">

                        @if(auth()->user()->level == 'pengelola')
                        <a href="/alat_sewa/create"><button type="button" class="btn btn-sm btn-primary mb-3"><i class="fas fa-plus"></i> Tambah Baru</button></a>
                        <a href="/alat_sewa/masuk"><button type="button" class="btn btn-sm btn-warning mb-3"><i class="fas fa-plus"></i> Tambah Stok</button></a>
                        @endif
                        <a href="/alat_sewa/download"><button type="button" class="btn btn-sm btn-success mb-3"><i class="fas fa-download"></i> Download</button></a>

                        <div class="card-body table-responsive p-0">
                            <table class="table table-bordered text-nowrap" id="datatable">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Kapasitas</th>
                                        <th scope="col">Harga Sewa</th>
                                        <th scope="col">Harga Beli</th>
                                        <th scope="col">Disewa</th>
                                        <th scope="col">Stok</th>
                                        <th scope="col">Foto</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($alatsewa as $alat)
                                    <tr>
                                        <td class="text-bold">{{$loop->iteration}}</td>
                                        <td>{{$alat->nama}}</td>

                                        @if($alat->kapasitas !== null)
                                        <td>{{$alat->kapasitas}} orang</td>
                                        @elseif($alat->kapasitas == null)
                                        <td> - </td>
                                        @endif

                                        <td>@currency($alat->harga_sewa)</td>
                                        <td>@currency($alat->harga_beli)</td>
                                        <td>{{$alat->sedang_disewa}}</td>
                                        <td>{{$alat->stok}}</td>
                                        <td>
                                            <a href="{{ asset('img/AlatSewa/' . $alat->foto) }}" data-toggle="lightbox" data-title="{{$alat->nama}}" data-gallery="gallery">
                                                <img src="{{ asset('img/AlatSewa/' . $alat->foto) }}" style="height: 30px;width: 30px">
                                            </a>
                                        </td>

                                        <td>
                                            <a href="/alat_sewa/{{$alat->id}}/detail" class="btn btn-primary btn-xs">Detail</a>
                                            @if(auth()->user()->level == 'pengelola')
                                            <a href="/alat_sewa/{{$alat->id}}/edit" class="btn btn-warning btn-xs">Edit</a>
                                            <a href="/alat_sewa/{{$alat->id}}/destroy" class="btn btn-danger btn-xs" onclick="return confirm('Anda yakin akan menghapus data?')">Delete</a>
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
        </div>
</section>
@endsection