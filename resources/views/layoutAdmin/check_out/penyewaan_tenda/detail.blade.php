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
                    <li class="breadcrumb-item"><a href="/check_out">Check Out</a></li>
                    <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Penyewaan Tenda</a></li>
                    <li class="breadcrumb-item active">Detail Penyewaan Tenda</li>
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
            <div class="mb-4">
                <div class="row">
                    <div class="col-2">
                        <p>Nama User</p>
                    </div>
                    <div class="col-10">
                        <p>: {{$sewa_tenda->pemesanan->user->nama}} </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <p>Nama Alat</p>
                    </div>
                    <div class="col-10">
                        <p>: {{$sewa_tenda->alatSewa->nama}}</p>
                    </div>
                </div>

                @if ($sewa_tenda->alatSewa->kapasitas != null)
                <div class="row">
                    <div class="col-2">
                        <p>Kapasitas Tenda</p>
                    </div>
                    <div class="col-10">
                        <p>: {{$sewa_tenda->alatSewa->kapasitas}} orang</p>
                    </div>
                </div>
                @endif

                <div class="row">
                    <div class="col-2">
                        <p>Jumlah</p>
                    </div>
                    <div class="col-10">
                        <p>: {{$sewa_tenda->jumlah}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <p>Tanggal Pinjam</p>
                    </div>
                    <div class="col-10">
                        <p>: {{\Carbon\Carbon::parse($sewa_tenda->tanggal_pinjam)->format('d-m-Y')}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <p>Tanggal Kembali</p>
                    </div>
                    <div class="col-10">
                        <p>: {{\Carbon\Carbon::parse($sewa_tenda->tanggal_kembali)->format('d-m-Y')}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <p>Lama Sewa</p>
                    </div>
                    <div class="col-10">
                        <p>: {{$sewa_tenda->lama_sewa}} hari</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <p>Harga Sewa</p>
                    </div>
                    <div class="col-10">
                        <p>: @currency($sewa_tenda->alatSewa->harga_sewa)/hari</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <p>Total Bayar</p>
                    </div>
                    <div class="col-10">
                        <p>: Jumlah x Lama Sewa x Harga Alat</p>
                        <p>: {{$sewa_tenda->jumlah}} x {{$sewa_tenda->lama_sewa}} x @currency($sewa_tenda->alatSewa->harga_sewa)</p>
                        <p>: @currency($sewa_tenda->jumlah * $sewa_tenda->lama_sewa * $sewa_tenda->alatSewa->harga_sewa)</p>
                    </div>
                </div>

                @if(!empty($sewa_tenda->pengembalian))
                <div class="row">
                    <div class="col-2">
                        <p>Tanggal Pengembalian</p>
                    </div>
                    <div class="col-10">
                        <p>: {{\Carbon\Carbon::parse($sewa_tenda->pengembalian->tanggal_input)->format('d-m-Y')}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <p>Jumlah Dikembalikan</p>
                    </div>
                    <div class="col-10">
                        <p>: {{$sewa_tenda->pengembalian->jumlah_kembali}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <p>Jumlah Alat Bagus</p>
                    </div>
                    <div class="col-10">
                        <p>: {{$sewa_tenda->pengembalian->jumlah_bagus}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <p>Jumlah Alat Rusak/Hilang</p>
                    </div>
                    <div class="col-10">
                        <p>: {{$sewa_tenda->pengembalian->jumlah_rusak}}</p>
                    </div>
                </div>
                @endif

            </div>
        </div>

        <div class="card-footer">
            <a href="{{ url()->previous() }}"><button type="button" class="btn btn-secondary"><i class="fas fa-chevron-left"></i> Kembali</button></a>
        </div>
    </div>

</section>
<!-- /.content -->
@endsection