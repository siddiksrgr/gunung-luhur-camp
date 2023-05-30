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
    </style>
</head>

<body>
    <div>
        <p style="font-size: 15px;font-weight:bolder;margin-bottom: 20px;">Data Barang Habis Pakai <span style="float: right;font-weight:normal;font-size: 15px">Tanggal : {{\Carbon\Carbon::parse(now())->format('d-m-Y')}}</span></p>
        <hr>
        <table class="table table-bordered text-nowrap">
            <thead class="bg-light">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Stok</th>
                    <th scope="col">Tanggal Input</th>
                    <th scope="col">Tanggal Update</th>
                </tr>
            </thead>
            <tbody>
                @foreach($barang as $barang)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$barang->nama}}</td>
                    <td>@currency($barang->harga) / <span>{{$barang->satuan}}</span></td>
                    <td>{{$barang->stok}} <span>{{$barang->satuan}}</span></td>
                    <td>{{\Carbon\Carbon::parse($barang->tanggal_input)->format('d-m-Y')}}</td>
                    <td>{{\Carbon\Carbon::parse($barang->tanggal_update)->format('d-m-Y')}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>

</html>