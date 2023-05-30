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
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div>
        <p style="font-size: 15px;font-weight:bolder;margin-bottom: 20px;">Data Penggantian Alat Rusak<span style="float: right;font-weight:normal;font-size: 15px">Tanggal : {{\Carbon\Carbon::parse(now())->format('d-m-Y')}}</span></p>
        <hr>
        <table class="table table-bordered text-nowrap">
            <thead class="bg-light">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Pengunjung</th>
                    <th scope="col">Nama Alat</th>
                    <th scope="col">Harga Beli</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Total Ganti</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rusak as $rusak)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$rusak->pengembalian->sewaAlat->pemesanan->user->nama}}</td>

                    <td>{{$rusak->pengembalian->sewaAlat->alatSewa->nama}}</td>
                    <td>@currency($rusak->pengembalian->sewaAlat->alatSewa->harga_beli)</td>
                    <td>{{$rusak->pengembalian->jumlah_rusak}}</td>
                    <td>@currency($rusak->total_ganti)</td>
                    <td>{{$rusak->status}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>

</html>