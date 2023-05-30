@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Kunjungan</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!--  -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Kunjungan Dari Tanggal
                <span class="text-bold">{{\Carbon\Carbon::parse($tgl_awal)->format('d-m-Y')}}</span> s/d
                <span class="text-bold">{{\Carbon\Carbon::parse($tgl_akhir)->format('d-m-Y')}}</span>
            </h3>
        </div>
        <!-- /.card-header -->
        <div class="col-lg-7">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="bg-light">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Tanggal Input</th>
                            <th scope="col">Nama Pengunjung</th>
                            <th scope="col">Nomor Tiket</th>
                            <th scope="col">Anggota</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($checkIn as $checkIn)
                        <tr>
                            <td class="text-bold">{{$loop->iteration}}</td>
                            <td>{{\Carbon\Carbon::parse($checkIn->tanggal_input)->format('d-m-Y')}}</td>
                            <td>{{$checkIn->pemesanan->user->nama}}</td>
                            <td>{{$checkIn->pemesanan->nomor_pesan}}</td>
                            <td>{{$checkIn->pemesanan->pesanTiket->total_anggota}}</td>
                        </tr>
                        @endforeach
                        <td colspan="4">
                            <div class="float-right text-bold">Total</div>
                        </td>
                        <td class="text-bold">{{$total}}</td>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <a href="/kunjungan"><button type="button" class="no-print btn btn-secondary"><i class="fas fa-chevron-left"></i> Kembali</button></a>
                <button type="button" onClick="window.print();" class="no-print btn btn-success"><i class="fas fa-print"></i> Print</button>
            </div>
        </div>
        <!-- /.card-body -->
    </div>

</section>
<!-- /.content -->
@endsection