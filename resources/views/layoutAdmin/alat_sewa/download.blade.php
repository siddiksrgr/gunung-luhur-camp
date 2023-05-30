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
        <p style="font-size: 15px;font-weight:bolder;margin-bottom: 20px;">Data Alat Sewa <span style="float: right;font-weight:normal;font-size: 15px">Tanggal : {{\Carbon\Carbon::parse(now())->format('d-m-Y')}}</span></p>
        <hr>
        <table class="table table-bordered text-nowrap">
            <thead class="bg-light">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Kapasitas</th>
                    <th scope="col">Harga Sewa</th>
                    <th scope="col">Harga Beli</th>
                    <th scope="col">Disewa</th>
                    <th scope="col">Stok</th>
                </tr>
            </thead>
            <tbody>
                @foreach($alatsewa as $alat)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$alat->nama}}</td>

                    @if($alat->kapasitas !== null)
                    <td>{{$alat->kapasitas}} orang</td>
                    @elseif($alat->kapasitas == null)
                    <td> - </td>
                    @endif

                    <td>@currency($alat->harga_sewa)</td>
                    <td>@currency($alat->harga_beli)</td>
                    <td>{{$alat->sedang_disewa}}</td>
                    <td>{{$alat->stok}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>

</html>