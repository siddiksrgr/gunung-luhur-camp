@extends('layoutUser.main')

@section('container1')
<div class="container mt-4 mb-4">
    <div class="card shadow p-3 bg-body rounded">
        <h5 class="card-header mb-3 text-center">Detail Pemesanan Sewa Tenda</h5>

        <div class="card-body">
            <div class="row">
                <div class="col-2">
                    <p>Tanggal Pesan</p>
                </div>
                <div class="col-10">
                    <p>: {{\Carbon\Carbon::parse($sewaTenda->pemesanan->tanggal_pesan)->format('d-m-Y')}}</p>
                </div>
            </div>
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
                    <p>Nama Tenda</p>
                </div>
                <div class="col-10">
                    <p>: {{$sewaTenda->alatSewa->nama}} ({{$sewaTenda->alatSewa->keterangan}})</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Kapasitas Tenda</p>
                </div>
                <div class="col-10">
                    <p>: {{$sewaTenda->alatSewa->kapasitas}} orang</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Jumlah</p>
                </div>
                <div class="col-10">
                    <p>: {{$sewaTenda->jumlah}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Tanggal Pinjam</p>
                </div>
                <div class="col-10">
                    <p>: {{\Carbon\Carbon::parse($sewaTenda->tanggal_pinjam)->format('d-m-Y')}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Tanggal Kembali</p>
                </div>
                <div class="col-10">
                    <p>: {{\Carbon\Carbon::parse($sewaTenda->tanggal_kembali)->format('d-m-Y')}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Lama Sewa</p>
                </div>
                <div class="col-10">
                    <p>: {{$sewaTenda->lama_sewa}} hari</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Harga Sewa</p>
                </div>
                <div class="col-10">
                    <p>: @currency($sewaTenda->alatSewa->harga_sewa)/hari</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Total Bayar</p>
                </div>
                <div class="col-10">
                    <p>: Jumlah x Lama Sewa x Harga Sewa</p>
                    <p>: {{$sewaTenda->jumlah}} x {{$sewaTenda->lama_sewa}} x @currency($sewaTenda->alatSewa->harga_sewa)</p>
                    <p>: @currency($sewaTenda->jumlah * $sewaTenda->lama_sewa * $sewaTenda->alatSewa->harga_sewa)</p>
                </div>
            </div>

            @php
            $status_pesan = $sewaTenda->pemesanan->status_pesan;
            if ($status_pesan == 0) {
            $status_bayar = 'Belum Bayar';
            }else
            $status_bayar = 'Sudah Bayar';
            @endphp

            <div class="row">
                <div class="col-2">
                    <p>Status Bayar</p>
                </div>
                <div class="col-10">
                    <p>: {{$status_bayar}}</p>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <a href="{{ url()->previous() }}"><button type="button" class="btn btn-secondary rounded-pill mt-3"><i class="bi bi-chevron-left"></i> Kembali</button></a>
        </div>
    </div>
</div>
@endsection