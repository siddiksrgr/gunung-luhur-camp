@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Pemasukan</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        @if($tgl_awal != 0)
        <div class="card-header">
            <h3 class="card-title">Total pemasukan dari tanggal <span class="text-bold">{{\Carbon\Carbon::parse($tgl_awal)->format('d-m-Y')}}</span> s/d
                <span class="text-bold">{{\Carbon\Carbon::parse($tgl_akhir)->format('d-m-Y')}}</span>
            </h3>
        </div>
        @else
        <div class="card-header">
            <h3 class="card-title">Total Keseluruhan Pemasukan</h3>
        </div>
        @endif

        <div class="card-body">
            <h3 class="mb-4 text-success text-bold">@currency($total)</h3>

            <!-- pemesanan tiket-->
            @if(count($pemesanan_tiket) > 0)
            <p class="text-bold mb-2">- Pemesanan Tiket</p>
            <table class="table table-bordered mb-5">
                <thead class="bg-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Pengunjung</th>
                        <th>Nomor Tiket</th>
                        <th>Tanggal Pesan</th>
                        <th>Total Bayar</th>
                        <th class="no-print">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pemesanan_tiket as $pemesanan_tiket)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$pemesanan_tiket->user->nama}}</td>
                        <td>{{$pemesanan_tiket->nomor_pesan}}</td>
                        <td>{{\Carbon\Carbon::parse($pemesanan_tiket->tanggal_pesan)->format('d-m-Y')}}</td>
                        <td>@currency($pemesanan_tiket->total_bayar + $pemesanan_tiket->kode_unik)</td>
                        <td class="no-print">
                            <a href="/pemasukan/{{$pemesanan_tiket->id}}/showTiket" class="btn btn-primary btn-xs">Detail</a>
                        </td>
                    </tr>
                    @endforeach

                    <td colspan="4">
                        <div class="float-right text-bold">Total</div>
                    </td>
                    <td colspan="2" class="text-bold">@currency($total_pesan_tiket)</td>

                </tbody>
            </table>
            @endif

            <!-- sewa alat tambahan -->
            @if(count($sewa_alat_tambah) > 0)
            <p class="text-bold mb-2">- Sewa Alat Tambahan</p>
            <table class="table table-bordered mb-5">
                <thead class="bg-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Pengunjung</th>
                        <th>Nama Alat</th>
                        <th>Harga Sewa</th>
                        <th>Lama Sewa</th>
                        <th>Jumlah</th>
                        <th>Total Bayar</th>
                        <th>Status Sewa</th>
                        <th class="no-print">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sewa_alat_tambah as $sewa_alat_tambah)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$sewa_alat_tambah->sewaAlatTambah->checkIn->pemesanan->user->nama}}</td>
                        <td>{{$sewa_alat_tambah->alatSewa->nama}}</td>
                        <td>@currency($sewa_alat_tambah->alatSewa->harga_sewa)/hari</td>
                        <td>{{$sewa_alat_tambah->lama_sewa}} hari</td>
                        <td>{{$sewa_alat_tambah->jumlah}}</td>
                        <td>@currency($sewa_alat_tambah->total_bayar)</td>

                        @php
                        $status_kembali = $sewa_alat_tambah->status_kembali;
                        if ($status_kembali == 0) {
                        $status = 'Sedang Disewa';
                        } elseif ($status_kembali == 1) {
                        $status = 'Sudah Dikembalikan';
                        }
                        @endphp

                        @if ($status == 'Sedang Disewa')
                        <td><span class="text-danger">{{$status}}</span></td>
                        @elseif ($status == 'Sudah Dikembalikan')
                        <td><span class="text-success">{{$status}}</span></td>
                        @endif

                        <td class="no-print">
                            <a href="pemasukan/penyewaan_tambahan/{{$sewa_alat_tambah->id}}/showSewa" class="btn btn-primary btn-xs">Detail</a>
                        </td>
                    </tr>
                    @endforeach

                    <td colspan="6">
                        <div class="float-right text-bold">Total</div>
                    </td>
                    <td colspan="3" class="text-bold">@currency($total_sewa_tambahan)</td>
                </tbody>
            </table>
            @endif

            <!-- ganti alat sewa yg rusak -->
            @if(count($ganti_alat) > 0)
            <p class="text-bold mb-2">- Penggantian Alat Rusak</p>
            <table class="table table-bordered mb-5">
                <thead class="bg-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Pengunjung</th>
                        <th>Nama Alat</th>
                        <th>Harga Beli</th>
                        <th>Jumlah</th>
                        <th>Total Ganti</th>
                        <th>Status</th>
                        <th class="no-print">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ganti_alat as $ganti)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>

                        @if($ganti->pengembalian->sewaAlat->pemesanan_id == null)
                        <td>{{$ganti->pengembalian->sewaAlat->sewaAlatTambah->checkIn->pemesanan->user->nama}}</td>
                        @else
                        <td>{{$ganti->pengembalian->sewaAlat->pemesanan->user->nama}}</td>
                        @endif

                        <td>{{$ganti->pengembalian->sewaAlat->alatSewa->nama}}</td>
                        <td>@currency($ganti->pengembalian->sewaAlat->alatSewa->harga_beli)</td>
                        <td>{{$ganti->pengembalian->jumlah_rusak}}</td>
                        <td>@currency($ganti->total_ganti)</td>
                        <td>{{$ganti->status}}</td>
                        <td class="no-print">
                            <a href="/pemasukan/penggantian_alat/{{$ganti->id}}/showGanti" class="btn btn-primary btn-xs">Detail</a>
                        </td>
                    </tr>
                    @endforeach
                    <td colspan="5">
                        <div class="float-right text-bold">Total</div>
                    </td>
                    <td colspan="3" class="text-bold">@currency($total_ganti_alat)</td>
                </tbody>
            </table>
            @endif

            <!-- beli barang -->
            @if(count($beliBarang) > 0)
            <p class="text-bold mb-2">- Pembelian Barang Habis Pakai</p>
            <table class="table table-bordered mb-5">
                <thead class="bg-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Pengunjung</th>
                        <th>Nama Barang</th>
                        <th>Harga Barang</th>
                        <th>Jumlah Beli</th>
                        <th>Total Bayar</th>
                        <th>Tgl Beli</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($beliBarang as $beliBarang)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$beliBarang->user->nama}}</td>
                        <td>{{$beliBarang->barang->nama}}</td>
                        <td>@currency($beliBarang->barang->harga) / <span>{{$beliBarang->barang->satuan}}</span></td>
                        <td>{{$beliBarang->jumlah}} <span>{{$beliBarang->barang->satuan}}</span></td>
                        <td>@currency($beliBarang->total_bayar)</td>
                        <td>{{\Carbon\Carbon::parse($beliBarang->tgl_beli)->format('d-m-Y')}}</td>
                    </tr>
                    @endforeach
                    <td colspan="5">
                        <div class="float-right text-bold">Total</div>
                    </td>
                    <td colspan="2" class="text-bold">@currency($total_beli_barang)</td>
                </tbody>
            </table>
            @endif

            <!-- pesan makan -->
            @if(count($pesan_makan) > 0)
            <p class="text-bold mb-2">- Pemesanan Makanan</p>
            <table class="table table-bordered mb-5">
                <thead class="bg-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Pengunjung</th>
                        <th>Nama Makanan</th>
                        <th>Harga</th>
                        <th>Jumlah Beli</th>
                        <th>Total Bayar</th>
                        <th>Tgl Beli</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pesan_makan as $pesan_makan)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$pesan_makan->user->nama}}</td>
                        <td>{{$pesan_makan->makanan->nama}}</td>
                        <td>@currency($pesan_makan->makanan->harga)</td>
                        <td>{{$pesan_makan->jumlah}}</td>
                        <td>@currency($pesan_makan->total_bayar)</td>
                        <td>{{\Carbon\Carbon::parse($pesan_makan->tanggal_pesan)->format('d-m-Y')}}</td>
                    </tr>
                    @endforeach
                    <td colspan="5">
                        <div class="float-right text-bold">Total</div>
                    </td>
                    <td colspan="2" class="text-bold">@currency($total_pesan_makan)</td>
                </tbody>
            </table>
            @endif
        </div>

        <div class="card-footer">
            <a href="/pemasukan"><button type="button" class="no-print btn btn-secondary"><i class="fas fa-chevron-left"></i> Kembali</button></a>
            @if($total !== 0)
            <a href=""><button onClick="window.print();" class="no-print btn btn-success"><i class="fas fa-print"></i> Print</button></a>
            @endif
        </div>

    </div>
</section>
<!-- /.content -->
@endsection