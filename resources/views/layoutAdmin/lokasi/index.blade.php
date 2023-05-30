@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Lokasi</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Lokasi</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

            @if( (count($lokasi) == 0) && (auth()->user()->level == 'pengelola') )
            <a href="/lokasi/create">
                <button type="button" class="btn btn-sm btn-primary mb-3">
                    <i class="fas fa-plus"></i> Tambah
                </button>
            </a>
            @endif
            <a href="/lokasi/download"><button type="button" class="btn btn-sm btn-success mb-3"><i class="fas fa-download"></i> Download</button></a>

            <table class="table table-bordered">
                <thead class="bg-light">
                    <tr>
                        <th scope="col">Alamat</th>
                        <th scope="col">No HP</th>
                        <th scope="col">Tanggal Update</th>

                        @if(auth()->user()->level == 'pengelola')
                        <th scope="col">Aksi</th>
                        @endif

                    </tr>
                </thead>
                <tbody>
                    @foreach($lokasi as $lokasi)
                    <tr>
                        <td>{{$lokasi->alamat}}</td>
                        <td>{{$lokasi->no_hp}}</td>
                        <td>{{\Carbon\Carbon::parse($lokasi->tanggal_update)->format('d-m-Y')}}</td>

                        @if(auth()->user()->level == 'pengelola')
                        <td>
                            <a href="/lokasi/{{$lokasi->id}}/edit" class="btn btn-warning btn-xs">Edit</a>
                        </td>
                        @endif

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</section>
<!-- /.content -->
@endsection