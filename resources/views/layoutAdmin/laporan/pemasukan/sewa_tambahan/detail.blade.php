@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Detail Penyewaan Alat</h1>
            </div>
            <div class="col-sm-6">

            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Detail Penyewaan Alat</h3>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-2">
                    <p>Nama Pemesanan</p>
                </div>
                <div class="col-10">
                    <p>: Sewa Alat Tambahan</p>
                </div>
            </div>

            @if($sewaAlatTambah->pemesanan_id == null)
            <div class="row">
                <div class="col-2">
                    <p>Nama Pengunjung</p>
                </div>
                <div class="col-10">
                    <p>: {{$sewaAlatTambah->sewaAlatTambah->checkIn->pemesanan->user->nama}}</p>
                </div>
            </div>
            @else
            <div class="row">
                <div class="col-2">
                    <p>Nama Pengunjung</p>
                </div>
                <div class="col-10">
                    <p>: {{$sewaAlatTambah->pemesanan->user->nama}}</p>
                </div>
            </div>
            @endif

            <div class="row">
                <div class="col-2">
                    <p>Tanggal Pesan</p>
                </div>
                <div class="col-10">
                    <p>: {{\Carbon\Carbon::parse($sewaAlatTambah->tanggal_pesan)->format('d-m-Y')}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Nama Alat</p>
                </div>
                <div class="col-10">
                    <p>: {{$sewaAlatTambah->alatSewa->nama}}</p>
                </div>
            </div>

            @if ($sewaAlatTambah->kapasitas != null)
            <div class="row">
                <div class="col-2">
                    <p>Kapasitas Tenda</p>
                </div>
                <div class="col-10">
                    <p>: {{$sewaAlatTambah->alatSewa->kapasitas}} orang</p>
                </div>
            </div>
            @endif

            <div class="row">
                <div class="col-2">
                    <p>Jumlah</p>
                </div>
                <div class="col-10">
                    <p>: {{$sewaAlatTambah->jumlah}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Tanggal Pinjam</p>
                </div>
                <div class="col-10">
                    <p>: {{\Carbon\Carbon::parse($sewaAlatTambah->tanggal_pinjam)->format('d-m-Y')}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Tanggal Kembali</p>
                </div>
                <div class="col-10">
                    <p>: {{\Carbon\Carbon::parse($sewaAlatTambah->tanggal_kembali)->format('d-m-Y')}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Lama Sewa</p>
                </div>
                <div class="col-10">
                    <p>: {{$sewaAlatTambah->lama_sewa}} hari</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Harga Sewa</p>
                </div>
                <div class="col-10">
                    <p>: @currency($sewaAlatTambah->alatSewa->harga_sewa)/hari</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Total Bayar</p>
                </div>
                <div class="col-10">
                    <p>: Jumlah x Lama Sewa x Harga Alat</p>
                    <p>: {{$sewaAlatTambah->jumlah}} x {{$sewaAlatTambah->lama_sewa}} x @currency($sewaAlatTambah->alatSewa->harga_sewa)</p>
                    <p>: @currency($sewaAlatTambah->jumlah * $sewaAlatTambah->lama_sewa * $sewaAlatTambah->alatSewa->harga_sewa)</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Status Sewa</p>
                </div>
                @php
                $status_kembali = $sewaAlatTambah->status_kembali;
                if ($status_kembali == 0) {
                $status = 'Sedang Disewa';
                } elseif ($status_kembali == 1) {
                $status = 'Sudah Dikembalikan';
                }
                @endphp
                <div class="col-10">
                    @if ($status == 'Sedang Disewa')
                    <h6 class="text-primary text-bold">: {{$status}}</h6>
                    @elseif ($status == 'Sudah Dikembalikan')
                    <h6 class=" text-success text-bold">: {{$status}}</h6>
                    @endif
                </div>
            </div>

            @if(!empty($sewaAlatTambah->pengembalian))
            <div class="row">
                <div class="col-2">
                    <p>Tanggal Pengembalian</p>
                </div>
                <div class="col-10">
                    <p>: {{\Carbon\Carbon::parse($sewaAlatTambah->pengembalian->tanggal_input)->format('d-m-Y')}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Jumlah Dikembalikan</p>
                </div>
                <div class="col-10">
                    <p>: {{$sewaAlatTambah->pengembalian->jumlah_kembali}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Jumlah Alat Bagus</p>
                </div>
                <div class="col-10">
                    <p>: {{$sewaAlatTambah->pengembalian->jumlah_bagus}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Jumlah Alat Rusak/Hilang</p>
                </div>
                <div class="col-10">
                    <p>: {{$sewaAlatTambah->pengembalian->jumlah_rusak}}</p>
                </div>
            </div>
            @endif

        </div>

        <div class="card-footer">
            <button type="button" onclick="history.back();" class="btn btn-secondary mt-3"><i class="fas fa-chevron-left"></i> Kembali</button>
        </div>

    </div>

</section>
<!-- /.content -->
@endsection