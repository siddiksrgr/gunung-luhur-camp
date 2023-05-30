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
        <p style="font-size: 15px;font-weight:bolder;margin-bottom: 20px;">Data Harga Tiket Masuk<span style="float: right;font-weight:normal;font-size: 15px">Tanggal : {{\Carbon\Carbon::parse(now())->format('d-m-Y')}}</span></p>
        <hr>
        <table class="table table-bordered">
            <thead class="bg-light">
                <tr>
                    <th scope="col">Harga</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Tanggal Update</th>
                </tr>
            </thead>
            <tbody>
                @foreach($hargaTiket as $harga)
                <tr>
                    <td>@currency($harga->harga)</td>
                    <td>{{$harga->keterangan}}</td>
                    <td>{{\Carbon\Carbon::parse($harga->tanggal_update)->format('d-m-Y')}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>

</html>