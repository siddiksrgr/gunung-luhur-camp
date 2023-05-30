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
        <p style="font-size: 15px;font-weight:bolder;margin-bottom: 20px;">Data Makanan<span style="float: right;font-weight:normal;font-size: 15px">Tanggal : {{\Carbon\Carbon::parse(now())->format('d-m-Y')}}</span></p>
        <hr>
        <table class="table table-bordered text-nowrap">
            <thead class="bg-light">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Tersedia</th>
                    <th scope="col">Tanggal Input</th>
                    <th scope="col">Tanggal Update</th>
                </tr>
            </thead>
            <tbody>
                @foreach($makanan as $makanan)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$makanan->nama}}</td>
                    <td>@currency($makanan->harga)</td>
                    <td>{{$makanan->tersedia}}</td>
                    <td>{{\Carbon\Carbon::parse($makanan->tanggal_input)->format('d-m-Y')}}</td>
                    <td>{{\Carbon\Carbon::parse($makanan->tanggal_update)->format('d-m-Y')}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>

</html>