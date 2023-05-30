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
        <p style="font-size: 15px;font-weight:bolder;margin-bottom: 20px;">Data User Pengunjung<span style="float: right;font-weight:normal;font-size: 15px">Tanggal : {{\Carbon\Carbon::parse(now())->format('d-m-Y')}}</span></p>
        <hr>
        <table class="table table-bordered text-nowrap">
            <thead class="bg-light">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">No HP</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Username</th>
                    <th scope="col">Tanggal Daftar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pengunjung as $pengunjung)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$pengunjung->nama}}</td>
                    <td>{{$pengunjung->jenis_kelamin}}</td>
                    <td>{{$pengunjung->no_hp}}</td>
                    <td>{{$pengunjung->alamat}}</td>
                    <td>{{$pengunjung->username}}</td>
                    <td>{{\Carbon\Carbon::parse($pengunjung->tanggal_daftar)->format('d-m-Y')}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>

</html>