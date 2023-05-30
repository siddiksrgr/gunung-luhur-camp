@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Harga Tiket Masuk</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Harga Tiket Masuk</h3>
        </div>
        <!-- /.card-header -->
        <div class="col-lg-7">
            <div class="card-body">

                @if( (count($hargaTiket) == 0) && (auth()->user()->level == 'pengelola') )
                <a href="/hargaTiket/create">
                    <button type="button" class="btn btn-sm btn-primary mb-3">
                        <i class="fas fa-plus"></i> Tambah
                    </button>
                </a>
                @endif
                <a href="/hargaTiket/download"><button type="button" class="btn btn-sm btn-success mb-3 ml-1"><i class="fas fa-download"></i> Download</button></a>

                <table class="table table-bordered">
                    <thead class="bg-light">
                        <tr>
                            <th scope="col">Harga</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Tanggal Update</th>

                            @if(auth()->user()->level == 'pengelola')
                            <th scope="col">Aksi</th>
                            @endif

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($hargaTiket as $harga)
                        <tr>
                            <td>@currency($harga->harga)</td>
                            <td>{{$harga->keterangan}}</td>
                            <td>{{\Carbon\Carbon::parse($harga->tanggal_update)->format('d-m-Y')}}</td>

                            @if(auth()->user()->level == 'pengelola')
                            <td>
                                <a href="/hargaTiket/{{$harga->id}}/edit" class="btn btn-warning btn-xs">Edit</a>
                            </td>
                            @endif

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card-body -->
    </div>

</section>
<!-- /.content -->
@endsection