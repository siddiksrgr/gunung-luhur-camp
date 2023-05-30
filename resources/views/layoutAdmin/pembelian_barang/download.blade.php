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
        <p style="font-size: 15px;font-weight:bolder;margin-bottom: 20px;">Data Pembelian Barang Habis Pakai<span style="float: right;font-weight:normal;font-size: 15px">Tanggal : {{\Carbon\Carbon::parse(now())->format('d-m-Y')}}</span></p>
        <hr>
        <table class="table table-bordered text-nowrap">
            <thead class="bg-light">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Pembeli</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Harga Barang</th>
                    <th scope="col">Jumlah Beli</th>
                    <th scope="col">Total Bayar</th>
                    <th scope="col">Tgl Beli</th>
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
            </tbody>
        </table>
    </div>

</body>

</html>