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

        th,
        td {
            font-size: 13px;
        }
    </style>
</head>

<body>
    <div>
        <p style="font-size: 15px;font-weight:bolder;margin-bottom: 20px;">Data Pemesanan Makan<span style="float: right;font-weight:normal;font-size: 15px">Tanggal : {{\Carbon\Carbon::parse(now())->format('d-m-Y')}}</span></p>
        <hr>
        <table class="table table-bordered text-nowrap">
            <thead class="bg-light">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Pengunjung</th>
                    <th scope="col">Nama Makanan</th>
                    <th scope="col">Harga Makanan</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Total Bayar</th>
                    <th scope="col">Tanggal Pesan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pesan_makan as $pesan)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$pesan->user->nama}}</td>
                    <td>{{$pesan->makanan->nama}}</td>
                    <td>@currency($pesan->makanan->harga)</td>
                    <td>{{$pesan->jumlah}}</td>
                    <td>@currency($pesan->total_bayar)</td>
                    <td>{{\Carbon\Carbon::parse($pesan->tanggal_pesan)->format('d-m-Y')}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>

</html>