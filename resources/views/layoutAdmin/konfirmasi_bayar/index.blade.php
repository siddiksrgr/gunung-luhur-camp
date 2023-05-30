@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Konfirmasi Pembayaran</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Konfirmasi Pembayaran</h3>
        </div>
        <!-- /.card-header -->
        <div class="col-lg-12">
            <div class="card-body table-responsive">

                <a href="/konfirmasi_pembayaran/downloadAdmin"><button type="button" class="btn btn-sm btn-success mb-3"><i class="fas fa-download"></i> Download</button></a>

                <div class="card-body table-responsive p-0">
                    <table class="table table-bordered text-nowrap" id="datatable">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Nomor Tiket</th>
                                <th scope="col">Total Bayar</th>
                                <th scope="col">Bukti Transfer</th>
                                <th scope="col">Tanggal Bayar</th>
                                <th scope="col">Status Bayar</th>
                                <th scope="col">Status Pesan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($konfirmasi as $konfirmasi)
                            <tr>
                                <td class="text-bold">{{$loop->iteration}}</td>
                                <td>{{$konfirmasi->pemesanan->user->nama}}</td>
                                <td>{{$konfirmasi->pemesanan->nomor_pesan}}</td>
                                <td>@currency($konfirmasi->pemesanan->total_bayar + $konfirmasi->pemesanan->kode_unik)</td>
                                <td>
                                    <a href="{{ asset('img/BuktiKonfirmasi/' . $konfirmasi->bukti) }}" data-toggle="lightbox" data-title="Bukti Transfer" data-gallery="gallery">
                                        <img src="{{ asset('img/BuktiKonfirmasi/' . $konfirmasi->bukti) }}" style="height: 30px;width: 30px">
                                    </a>
                                </td>
                                <td>{{\Carbon\Carbon::parse($konfirmasi->tanggal_bayar)->format('d-m-Y')}}</td>

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

                                @if ($status == 'Menunggu Validasi')
                                <td><span class="badge rounded-pill bg-danger">{{$status}}</span></td>
                                @elseif ($status == 'Sudah Divalidasi')
                                <td><span class="badge rounded-pill bg-success">{{$status}}</span></td>
                                @endif 

                                @if ($konfirmasi->pemesanan->batalTiket == null)
                                <td><span class="badge rounded-pill bg-success">Diproses</span></td>
                                @elseif ($konfirmasi->pemesanan->batalTiket !== null)
                                <td><span class="badge rounded-pill bg-danger">Dibatalkan</span></td>
                                @endif

                                <td>
                                    <a href="/konfirmasi_pembayaran/{{$konfirmasi->id}}/showAdmin" class="btn btn-primary btn-xs">Detail</a>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>

</section>
<!-- /.content -->
@endsection