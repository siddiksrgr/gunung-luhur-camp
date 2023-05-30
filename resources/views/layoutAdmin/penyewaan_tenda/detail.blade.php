@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Detail Penyewaan Tenda</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/penyewaan_tenda">Penyewaan Tenda</a></li>
                    <li class="breadcrumb-item active">Detail</li>
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
            <h3 class="card-title">Data Detail Penyewaan Tenda</h3>
        </div>

        <div class="card-body">

            <div class="row">
                <div class="col-2">
                    <p>Nama Pemesanan</p>
                </div>
                <div class="col-10">
                    <p>: Sewa Tenda</p>
                </div>
            </div>

            <div class="row">
                <div class="col-2">
                    <p>Tanggal Pesan</p>
                </div>
                <div class="col-10">
                    <p>: {{\Carbon\Carbon::parse($sewaAlat->tanggal_pesan)->format('d-m-Y')}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Nama Alat</p>
                </div>
                <div class="col-10">
                    <p>: {{$sewaAlat->alatSewa->nama}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Kapasitas</p>
                </div>
                <div class="col-10">
                    <p>: {{$sewaAlat->alatSewa->kapasitas}} orang</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Jumlah</p>
                </div>
                <div class="col-10">
                    <p>: {{$sewaAlat->jumlah}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Tanggal Pinjam</p>
                </div>
                <div class="col-10">
                    <p>: {{\Carbon\Carbon::parse($sewaAlat->tanggal_pinjam)->format('d-m-Y')}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Tanggal Kembali</p>
                </div>
                <div class="col-10">
                    <p>: {{\Carbon\Carbon::parse($sewaAlat->tanggal_kembali)->format('d-m-Y')}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Lama Sewa</p>
                </div>
                <div class="col-10">
                    <p>: {{$sewaAlat->lama_sewa}} hari</p>
                </div>
            </div>

            @php
            if(!empty($sewa_tenda->pemesanan_id)){
            $checkIn = $sewaAlat->pemesanan->checkIn;
            if (($checkIn == null) && ($sewaAlat->pemesanan->status_pesan == 2)) {
            $status = 'Belum Check In';
            }
            }
            $status_kembali = $sewaAlat->status_kembali;

            if ($status_kembali == 0) {
            $status = 'Sedang Disewa';
            } elseif ($status_kembali == 1) {
            $status = 'Sudah Dikembalikan';
            }
            @endphp

            <div class="row">
                <div class="col-2">
                    <p>Status Sewa</p>
                </div>
                <div class="col-10">
                    @if ($status == 'Belum Check In')
                    <p class="text-danger">: {{$status}}</p>
                    @elseif ($status == 'Sedang Disewa')
                    <p class="text-danger">: {{$status}}</p>
                    @elseif ($status == 'Sudah Dikembalikan')
                    <p class="text-success">: {{$status}}</p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Keterangan</p>
                </div>
                <div class="col-10">
                    @if($sewaAlat->pemesanan_id == null)
                    <p>: Sewa Alat Tambahan Di Lokasi</p>
                    @else
                    <p>: Sewa Tenda Di Web User</p>
                    @endif
                </div>
            </div>

            @if(!empty($sewaAlat->pengembalian))
            <div class="row">
                <div class="col-2">
                    <p>Tanggal Pengembalian</p>
                </div>
                <div class="col-10">
                    <p>: {{\Carbon\Carbon::parse($sewaAlat->pengembalian->tanggal_input)->format('d-m-Y')}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Jumlah Dikembalikan</p>
                </div>
                <div class="col-10">
                    <p>: {{$sewaAlat->pengembalian->jumlah_kembali}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Jumlah Alat Bagus</p>
                </div>
                <div class="col-10">
                    <p>: {{$sewaAlat->pengembalian->jumlah_bagus}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Jumlah Alat Rusak/Hilang</p>
                </div>
                <div class="col-10">
                    <p>: {{$sewaAlat->pengembalian->jumlah_rusak}}</p>
                </div>
            </div>
            @endif


        </div>

        <div class="card-footer">
            <a href="{{ url()->previous() }}"><button type="button" class="btn btn-secondary mt-3"><i class="fas fa-chevron-left"></i> Kembali</button></a>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection