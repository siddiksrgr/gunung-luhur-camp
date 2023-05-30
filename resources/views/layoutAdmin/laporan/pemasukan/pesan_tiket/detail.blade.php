@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Detail Pemesanan Tiket</h1>
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
            <h3 class="card-title">Data Detail Pemesanan Tiket</h3>
        </div>

        <div class="card-body">

            <!-- nomor pesanan -->
            <div class="mb-4">
                <div class="row">
                    <div class="col-2">
                        <p>Nama Pengunjung</p>
                    </div>
                    <div class="col-10">
                        <p>: {{$pemesanan_tiket->user->nama}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <p>Nomor Pesanan</p>
                    </div>
                    <div class="col-10">
                        <p>: {{$pemesanan_tiket->nomor_pesan}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <p>Tanggal Pesan</p>
                    </div>
                    <div class="col-10">
                        <p>: {{\Carbon\Carbon::parse($pemesanan_tiket->tanggal_pesan)->format('d-m-Y')}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <p>Tanggal Bayar</p>
                    </div>
                    <div class="col-10">
                        <p>: {{\Carbon\Carbon::parse($pemesanan_tiket->konfirmasi->tanggal_bayar)->format('d-m-Y')}}</p>
                    </div>
                </div>
            </div>

            <!-- tiket masuk -->
            <div class="mb-4">
                <div class="row text-bold">
                    <div class="col-2">
                        <p>Nama Pemesanan</p>
                    </div>
                    <div class="col-10">
                        <p>: Tiket Masuk</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <p>Harga Tiket</p>
                    </div>
                    <div class="col-10">
                        <p>: @currency($pemesanan_tiket->pesanTiket->hargaTiket->harga), {{$pemesanan_tiket->pesanTiket->hargaTiket->keterangan}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <p>Tanggal Check In</p>
                    </div>
                    <div class="col-10">
                        <p>: {{\Carbon\Carbon::parse($pemesanan_tiket->pesanTiket->tgl_check_in)->format('d-m-Y')}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <p>Tanggal Check Out</p>
                    </div>
                    <div class="col-10">
                        <p>: {{\Carbon\Carbon::parse($pemesanan_tiket->pesanTiket->tgl_check_out)->format('d-m-Y')}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <p>Lama Menginap</p>
                    </div>
                    <div class="col-10">
                        <p>: {{$pemesanan_tiket->pesanTiket->lama_menginap}} hari</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <p>Total Anggota</p>
                    </div>
                    <div class="col-10">
                        <p>: {{$pemesanan_tiket->pesanTiket->total_anggota}} orang <span class="text-default">(pemesan dan jumlah anggota yang dibawa)</span></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <p>Total Bayar</p>
                    </div>
                    <div class="col-10">
                        <p>: Total Anggota x Lama Menginap x Harga Tiket</p>

                        <p>: {{$pemesanan_tiket->pesanTiket->total_anggota}} x {{$pemesanan_tiket->pesanTiket->lama_menginap}} x @currency($pemesanan_tiket->pesanTiket->hargaTiket->harga)</p>

                        <p>: @currency($pemesanan_tiket->pesanTiket->total_bayar)</p>
                    </div>
                </div>
            </div>

            <!-- sewa tenda -->
            @if(!empty($sewa_tenda))
            @foreach($sewa_tenda as $sewa_tenda)
            <div class="mb-4">
                <div class="row text-bold">
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
                        <p>: {{$sewa_tenda->alatSewa->nama}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <p>Kapasitas Tenda</p>
                    </div>
                    <div class="col-10">
                        <p>: {{$sewa_tenda->alatSewa->kapasitas}} orang</p>
                    </div>
                </div>
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
            </div>
            @endforeach
            @endif

            <!-- total keseluruhan -->
            <div>
                <div class="row">
                    <div class="col-2">
                        <p>Kode Unik</p>
                    </div>
                    <div class="col-10">
                        <p>: {{$pemesanan_tiket->kode_unik}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <p>Total Keseluruhan</p>
                    </div>
                    <div class="col-10">
                        <p>: @currency($pemesanan_tiket->total_bayar + $pemesanan_tiket->kode_unik)</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <p>Bukti Transfer</p>
                    </div>
                    <div class="col-10">
                        <a href="{{ asset('img/BuktiKonfirmasi/' . $pemesanan_tiket->konfirmasi->bukti) }}" data-toggle="lightbox" data-title="Bukti Transfer" data-gallery="gallery">
                            <p>: {{$pemesanan_tiket->konfirmasi->bukti}}</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="button" onclick="history.back();" class="btn btn-secondary mt-3"><i class="fas fa-chevron-left"></i> Kembali</button>
        </div>

    </div>

</section>
<!-- /.content -->
@endsection