@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Detail Konfirmasi Pembayaran</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/konfirmasi_pembayaran">Konfirmasi Pembayaran</a></li>
                    <li class="breadcrumb-item active">Detail Konfirmasi Pembayaran</li>
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
            <h3 class="card-title">Data Detail Konfirmasi Pembayaran</h3>
        </div>

        <div class="card-body">

            <!-- nomor pesanan -->
            <div class="mb-1">
                <div class="row">
                    <div class="col-2">
                        <p>Nama</p>
                    </div>
                    <div class="col-10">
                        <p>: {{$konfirmasi->pemesanan->user->nama}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <p>Nomor Tiket</p>
                    </div>
                    <div class="col-10">
                        <p>: {{$konfirmasi->pemesanan->nomor_pesan}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <p>Tanggal Pesan</p>
                    </div>
                    <div class="col-10">
                        <p>: {{\Carbon\Carbon::parse($konfirmasi->pemesanan->tanggal_pesan)->format('d-m-Y')}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <p>Tanggal Bayar</p>
                    </div>
                    <div class="col-10">
                        <p>: {{\Carbon\Carbon::parse($konfirmasi->tanggal_bayar)->format('d-m-Y')}}</p>
                    </div>
                </div>
            </div>

            <!-- total keseluruhan -->
            <div>
                <div class="row">
                    <div class="col-2">
                        <p>Kode Unik</p>
                    </div>
                    <div class="col-10">
                        <p>: {{$konfirmasi->pemesanan->kode_unik}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <p>Total Keseluruhan</p>
                    </div>
                    <div class="col-10">
                        <p>: @currency($konfirmasi->pemesanan->total_bayar + $konfirmasi->pemesanan->kode_unik)</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <p>Bukti Transfer</p>
                    </div>
                    <div class="col-10">
                        <a href="{{ asset('img/BuktiKonfirmasi/' . $konfirmasi->bukti) }}" data-toggle="lightbox" data-title="Bukti Transfer" data-gallery="gallery">
                            <p>: {{$konfirmasi->bukti}}</p>
                        </a>
                    </div>
                </div>
                @php
                $status = $konfirmasi->pemesanan->status_pesan;
                if ($status == 1) {
                $status = 'Menunggu Validasi';
                }elseif ($status == 2) {
                $status = 'Sudah Divalidasi';
                } elseif ($status == 3) {
                $status = 'Sudah Divalidasi';
                }
                @endphp
                <div class="row">
                    <div class="col-2">
                        <p>Status Bayar</p>
                    </div>
                    <div class="col-10">
                        @if ($status == 'Menunggu Validasi')
                        <p>: <span class="badge rounded-pill bg-danger">{{$status}}</span></p>
                        @elseif ($status == 'Sudah Divalidasi')
                        <p>: <span class="badge rounded-pill bg-success">{{$status}}</span></p>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <p>Status Pesan</p>
                    </div>
                    <div class="col-10">
                        @if ($konfirmasi->pemesanan->batalTiket == null)
                        <p>: <span class="badge rounded-pill bg-success">Diproses</span></p>
                        @elseif ($konfirmasi->pemesanan->batalTiket !== null)
                        <p>: <span class="badge rounded-pill bg-danger">Dibatalkan</span></p>
                        @endif
                    </div>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <form method="post" action="/validasi/{{$konfirmasi->id}}">
                @csrf
                <a href="{{ url()->previous() }}"><button type="button" class="btn btn-secondary"><i class="fas fa-chevron-left"></i> Kembali</button></a>

                @if( ($konfirmasi->pemesanan->status_pesan == 1) && (auth()->user()->level == 'pengelola') )
                <button type="submit" class="btn btn-primary"><i class="far fa-check-circle"></i> Validasi</button>
                @endif
            </form>
        </div>

    </div>

</section>
<!-- /.content -->
@endsection