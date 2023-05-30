@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Penyewaan Tenda</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Penyewaan Tenda</h3>
        </div>

        <!-- /.card-body -->
        <div class="col-lg-12">
            <div class="card-body table-responsive">

                <a href="/sewa_tenda/download"><button type="button" class="btn btn-sm btn-success mb-3"><i class="fas fa-download"></i> Download</button></a>

                <div class="card-body table-responsive p-0">
                    <table class="table table-bordered text-nowrap" id="datatable">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Pengunjung</th>
                                <th scope="col">Kapasitas Tenda</th>
                                <th scope="col">Lama Sewa</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Status Sewa</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($sewa_tenda as $sewa_tenda)
                            @if($sewa_tenda->alatSewa->kapasitas != null)
                            <tr>
                                <td class="text-bold">{{$loop->iteration}}</td>

                                @if($sewa_tenda->pemesanan_id == null)
                                <td>{{$sewa_tenda->sewaAlatTambah->checkIn->pemesanan->user->nama}}</td>
                                @else
                                <td>{{$sewa_tenda->pemesanan->user->nama}}</td>
                                @endif

                                <td>{{$sewa_tenda->alatSewa->kapasitas}} orang</td>
                                <td>{{$sewa_tenda->lama_sewa}} hari</td>
                                <td>{{$sewa_tenda->jumlah}}</td>

                                @php
                                if(!empty($sewa_tenda->pemesanan_id)){
                                $checkIn = $sewa_tenda->pemesanan->checkIn;

                                if (($checkIn == null) && ($sewa_tenda->pemesanan->status_pesan == 2)) {
                                $status = 'Belum Check In';
                                }elseif ($sewa_tenda->status_kembali == 0) {
                                $status = 'Sedang Disewa';
                                } elseif ($sewa_tenda->status_kembali == 1) {
                                $status = 'Sudah Dikembalikan';
                                }

                                } elseif ($sewa_tenda->status_kembali == 0) {
                                $status = 'Sedang Disewa';
                                } elseif ($sewa_tenda->status_kembali == 1) {
                                $status = 'Sudah Dikembalikan';
                                }
                                @endphp

                                @if ($status == 'Belum Check In')
                                <td><span class="badge rounded-pill bg-danger">{{$status}}</span></td>
                                @elseif ($status == 'Sedang Disewa')
                                <td><span class="badge rounded-pill bg-danger">{{$status}}</span></td>
                                @elseif ($status == 'Sudah Dikembalikan')
                                <td><span class="badge rounded-pill bg-success">{{$status}}</span></td>
                                @endif

                                <td>
                                    <a href="/penyewaan_tenda/{{$sewa_tenda->id}}" class="btn btn-primary btn-xs">Detail</a>
                                </td>
                            </tr>
                            @endif
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection