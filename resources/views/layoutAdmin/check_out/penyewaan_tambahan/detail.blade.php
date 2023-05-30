@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Detail Penyewaan Tambahan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/check_out">Check Out</a></li>
                    <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Penyewaan Tambahan</a></li>
                    <li class="breadcrumb-item active">Detail Penyewaan Tambahan</li>
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
            <h3 class="card-title">Data Detail Penyewaan Tambahan</h3>
        </div>

        <div class="card-body">
            <div class="mb-4">
                <div class="row">
                    <div class="col-2">
                        <p>Nama User</p>
                    </div>
                    <div class="col-10">
                        <p>: {{$sewaAlat->sewaAlatTambah->checkIn->pemesanan->user->nama}} </p>
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

                @if ($sewaAlat->alatSewa->kapasitas != null)
                <div class="row">
                    <div class="col-2">
                        <p>Kapasitas Tenda</p>
                    </div>
                    <div class="col-10">
                        <p>: {{$sewaAlat->alatSewa->kapasitas}} orang</p>
                    </div>
                </div>
                @endif

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
                <div class="row">
                    <div class="col-2">
                        <p>Harga Sewa</p>
                    </div>
                    <div class="col-10">
                        <p>: @currency($sewaAlat->alatSewa->harga_sewa)/hari</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <p>Total Bayar</p>
                    </div>
                    <div class="col-10">
                        <p>: Jumlah x Lama Sewa x Harga Alat</p>
                        <p>: {{$sewaAlat->jumlah}} x {{$sewaAlat->lama_sewa}} x @currency($sewaAlat->alatSewa->harga_sewa)</p>
                        <p>: @currency($sewaAlat->jumlah * $sewaAlat->lama_sewa * $sewaAlat->alatSewa->harga_sewa)</p>
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
        </div>

        <div class="card-footer">
            <a href="{{ url()->previous() }}"><button type="button" class="btn btn-secondary"><i class="fas fa-chevron-left"></i> Kembali</button></a>
        </div>
    </div>

</section>
<!-- /.content -->
@endsection