<!DOCTYPE html>
<html>

<head>
    <title>Download</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <style type="text/css">
        .page-break {
            page-break-before: always;
        }

        body {
            line-height: 1;
        }

        hr {
            border: 1px solid;
        }

        th,
        td,
        p {
            font-size: 13px;
        }
    </style>
</head>

<body>
    <center>
        <p style="font-size: 30px;font-weight:bolder;">Gunung Luhur Camp</p>
        <p>Gunung Luhur Cikoneng, Tugu Utara, Kec. Cisarua, Bogor, Jawa Barat 16750 (081311156839)</p>
        <hr>
    </center>

    <p style="float: right;">Tanggal : {{\Carbon\Carbon::parse(now())->format('d-m-Y')}}</p>
    <p style="font-size: 30px;font-weight:bolder;">Kwitansi</p>

    <!-- Kwitansi -->
    <div style="margin-bottom: 20px; margin-top:10px">
        <p>Tanggal Pesan : {{\Carbon\Carbon::parse($pemesanan->tanggal_pesan)->format('d-m-Y')}}</p>
        <p>Tanggal Bayar : {{\Carbon\Carbon::parse($pemesanan->konfirmasi->tanggal_bayar)->format('d-m-Y')}}</p>
        <p>Nomor Pemesanan : {{$pemesanan->nomor_pesan}}</p>
        <p>Nama User : {{$pemesanan->user->nama}}</p>
        <p>Alamat : {{$pemesanan->user->alamat}}</p>
        <p>No Hp : {{$pemesanan->user->no_hp}}</p>
    </div>

    <!-- pesan tiket -->
    <p style="font-weight:bolder;">Nama Pemesanan : Tiket Masuk</p>
    <div style="margin-top: 20px;">
        <table class="table table-bordered table-striped">
            <tr>
                <th scope="col">No</th>
                <th>Tgl Check In</th>
                <th>Tgl Check Out</th>
                <th>Total Anggota</th>
                <th>Harga Tiket</th>
                <th>Total Bayar</th>
            </tr>
            <tr>
                <th scope="row">1</th>
                <td>{{\Carbon\Carbon::parse($pemesanan->pesanTiket->tgl_check_in)->format('d-m-Y')}}</td>
                <td>{{\Carbon\Carbon::parse($pemesanan->pesanTiket->tgl_check_out)->format('d-m-Y')}}</td>
                <td>{{$pemesanan->pesanTiket->total_anggota}} orang</td>
                <td>@currency($pemesanan->pesanTiket->hargaTiket->harga)</td>
                <td>@currency($pemesanan->pesanTiket->total_bayar)</td>
            </tr>
        </table>
    </div>

    <div style="font-weight:bolder;margin-top:20px;">
        <p>Kode Unik : <span style="color:blue">{{$pemesanan->kode_unik}}</span></p>
        <p>Total Keseluruhan : <span style="color:blue">@currency($pemesanan->total_bayar + $pemesanan->kode_unik)</span></p>
        @php
        $status_pesan = $pemesanan->status_pesan;
        if ($status_pesan == 0) {
        $status_bayar = 'Belum Bayar';
        }else
        $status_bayar = 'Sudah Bayar';
        @endphp
        <p>Status Bayar : <span style="color:blue">{{$status_bayar}}</span></p>
    </div>

    <img src="img/Lunas/lunas.png" style="height: 80px;width: auto;margin-top: 20px;margin-left:0px">
</body>

</html>