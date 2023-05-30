<!DOCTYPE html>
<html>

<head>
    <title>Download</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <style type="text/css">
        .page-break {
            page-break-before: always;
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
    <!-- E-Tiket -->
    <center>
        <p style="font-size: 30px;font-weight:bolder;margin-bottom:0%">Gunung Luhur Camp</p>
        <p>Gunung Luhur Cikoneng, Tugu Utara, Kec. Cisarua, Bogor, Jawa Barat 16750 (081311156839)</p>
        <hr>
    </center>

    @if(empty($pemesanan->checkIn))
    <p style="float: right;" class="badge badge-success">Tiket Diproses</p>
    @else
    <p style="float: right;" class="badge badge-danger">Tiket Expired</p>
    @endif

    <p style="font-size: 30px;font-weight:bolder;">Tiket</p>

    <div style="margin-bottom: 20px; margin-top:10px;line-height:1">
        <p>Tanggal Pesan : {{\Carbon\Carbon::parse($pemesanan->tanggal_pesan)->format('d-m-Y')}}</p>
        <p>Tanggal Bayar : {{\Carbon\Carbon::parse($pemesanan->konfirmasi->tanggal_bayar)->format('d-m-Y')}}</p>
        <p>Nomor Tiket : {{$pemesanan->nomor_pesan}}</p>
        <p>Nama User : {{$pemesanan->user->nama}}</p>
        <p>Alamat : {{$pemesanan->user->alamat}}</p>
        <p>No Hp : {{$pemesanan->user->no_hp}}</p>
    </div>

    <!-- pesan tiket -->
    <p style="font-weight:bolder;">Nama Pemesanan 1 : Tiket Masuk</p>
    <div style="margin-top: 20px;">
        <table class="table table-bordered table-striped">
            <tr>
                <th scope="col">No</th>
                <th>Tgl Check In</th>
                <th>Tgl Check Out</th>
                <th>Total Anggota</th>
            </tr>
            <tr>
                <th scope="row">1</th>
                <td>{{\Carbon\Carbon::parse($pemesanan->pesanTiket->tgl_check_in)->format('d-m-Y')}}</td>
                <td>{{\Carbon\Carbon::parse($pemesanan->pesanTiket->tgl_check_out)->format('d-m-Y')}}</td>
                <td>{{$pemesanan->pesanTiket->total_anggota}} orang</td>
            </tr>
        </table>
    </div>

    <div class="mt-4">
        <p class="font-weight-bold">Keterangan : <br>
            <span class="font-weight-normal">- Simpan Tiket ini untuk Check In dan Check Out di lokasi kemah !</span>
        </p>
    </div>
</body>

</html>