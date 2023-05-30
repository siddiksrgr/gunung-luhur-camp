@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Detail Pembatalan Tiket</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/pembatalan_tiket">Pembatalan Tiket</a></li>
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
            <h3 class="card-title">Data Detail Pembatalan Tiket</h3>
        </div>

        <!-- nomor tiket -->
        <div class="card-body">
            <div class="row">
                <div class="col-sm-2">
                    <p>Nama User</p>
                </div>
                <div class="col-sm-10">
                    <p>: {{$batalTiket->pemesanan->user->nama}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Nomor Tiket</p>
                </div>
                <div class="col-10">
                    <p>: {{$batalTiket->pemesanan->nomor_pesan}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Tanggal Pesan</p>
                </div>
                <div class="col-10">
                    <p>: {{\Carbon\Carbon::parse($batalTiket->pemesanan->tanggal_pesan)->format('d-m-Y')}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Status Pemesanan</p>
                </div>
                @php
                $status_pesan = $batalTiket->pemesanan->status_pesan;
                if ($status_pesan == 3) {
                $status_pesan = 'Dibatalkan';
                }
                @endphp
                <div class="col-10">
                    <p>: {{$status_pesan}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Jumlah Refund</p>
                </div>
                <div class="col-10">
                    <p>: @currency($batalTiket->pemesanan->total_bayar + $batalTiket->pemesanan->kode_unik)</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Nomor Rekening</p>
                </div>
                <div class="col-10">
                    <p>: {{$batalTiket->no_rekening}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Atas Nama</p>
                </div>
                <div class="col-10">
                    <p>: {{$batalTiket->atas_nama}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Alasan Batal</p>
                </div>
                <div class="col-10">
                    <p>: {{$batalTiket->alasan}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Status Refund</p>
                </div>
                @php
                $status_refund = $batalTiket->status_refund;
                if ($status_refund == 0) {
                $status_refund = 'Diajukan refund, menunggu proses refund';
                }elseif ($status_refund == 1) {
                $status_refund = 'Sudah direfund';
                }
                @endphp
                <div class="col-10">
                    <p>: {{$status_refund}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Bukti Refund</p>
                </div>
                <div class="col-10">
                    @if($batalTiket->bukti_refund !== null)
                    <a href="{{ asset('img/BuktiRefund/' . $batalTiket->bukti_refund) }}" class="text-primary fw-bold text-decoration-none" data-toggle="lightbox" data-title="Bukti Refund" data-gallery="gallery">
                        <p>: {{$batalTiket->bukti_refund}}</p>
                    </a>
                    @elseif ($batalTiket->bukti_refund == null )
                    <p>: Belum ada</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="card-body text-secondary">

            <p class="text-bold">Detail Pemesanan Yang Dibatalkan :</p>

            <!-- pesan tiket -->
            <div>
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
                        <p>: @currency($batalTiket->pemesanan->pesanTiket->hargaTiket->harga), {{$batalTiket->pemesanan->pesanTiket->hargaTiket->keterangan}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <p>Tanggal Check In</p>
                    </div>
                    <div class="col-10">
                        <p>: {{\Carbon\Carbon::parse($batalTiket->pemesanan->pesanTiket->tgl_check_in)->format('d-m-Y')}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <p>Tanggal Check Out</p>
                    </div>
                    <div class="col-10">
                        <p>: {{\Carbon\Carbon::parse($batalTiket->pemesanan->pesanTiket->tgl_check_out)->format('d-m-Y')}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <p>Lama Menginap</p>
                    </div>
                    <div class="col-10">
                        <p>: {{$batalTiket->pemesanan->pesanTiket->lama_menginap}} hari</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <p>Total Anggota</p>
                    </div>
                    <div class="col-10">
                        <p>: {{$batalTiket->pemesanan->pesanTiket->total_anggota}} orang <span class="text-default">(pemesan dan jumlah anggota yang dibawa)</span></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <p>Total Bayar</p>
                    </div>
                    <div class="col-10">
                        <p>: Total Anggota x Lama Menginap x Harga Tiket</p>

                        <p>: {{$batalTiket->pemesanan->pesanTiket->total_anggota}} x {{$batalTiket->pemesanan->pesanTiket->lama_menginap}} x @currency($batalTiket->pemesanan->pesanTiket->hargaTiket->harga)</p>

                        <p>: @currency($batalTiket->pemesanan->pesanTiket->total_bayar)</p>
                    </div>
                </div>
            </div>

            <!-- sewa tenda -->
            @if(!empty($sewa_tenda))
            @foreach($sewa_tenda as $sewa_tenda)
            <div class="text-secondary mb-2 mt-2">
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
                        <p>: Jumlah x Lama Sewa x Harga Sewa</p>
                        <p>: {{$sewa_tenda->jumlah}} x {{$sewa_tenda->lama_sewa}} x @currency($sewa_tenda->alatSewa->harga_sewa)</p>
                        <p>: @currency($sewa_tenda->jumlah * $sewa_tenda->lama_sewa * $sewa_tenda->alatSewa->harga_sewa)</p>
                    </div>
                </div>

                @php
                $status_pesan = $sewa_tenda->pemesanan->status_pesan;
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
            @endforeach
            @endif

            <div class="row">
                <div class="col-2">
                    <p>Kode Unik</p>
                </div>
                <div class="col-10">
                    <p>: {{$batalTiket->pemesanan->kode_unik}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Total Keseluruhan</p>
                </div>
                <div class="col-10">
                    <p>: @currency($batalTiket->pemesanan->total_bayar + $batalTiket->pemesanan->kode_unik)</p>
                </div>
            </div>
        </div>

        <div class="card-body">
            @if ($batalTiket->status_refund == 0)
            <div class="row">
                <div class="col-sm-2">
                    <p>Bukti Refund</p>
                </div>
                <div class="col-sm-10">
                    <form method="post" action="/pembatalan_tiket/{{$batalTiket->id}}/refund" enctype="multipart/form-data">
                        @csrf
                        <span>: </span><input type="file" class="form-control-md" id="foto" name="foto" required>
                </div>
            </div>
        </div>

        <div class="card-footer mt-3">
            <a href="{{ url()->previous() }}"><button type="button" class="btn btn-secondary"><i class="fas fa-chevron-left"></i> Kembali</button></a>

            @if(auth()->user()->level == 'pengelola')
            <button type="submit" class="btn btn-primary"><i class="far fa-check-circle"></i> Refund</button>
            @endif

        </div>

        </form>

        @elseif ($batalTiket->status_refund == 1)
        <div class="card-footer">
            <a href="{{ url()->previous() }}"><button type="button" class="btn btn-secondary"><i class="fas fa-chevron-left"></i> Kembali</button></a>
        </div>
        @endif

        <!-- /.card-body -->
    </div>

</section>
<!-- /.content -->
@endsection