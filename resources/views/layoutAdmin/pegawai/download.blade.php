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
        <p style="font-size: 15px;font-weight:bolder;margin-bottom: 20px;">Data Pegawai<span style="float: right;font-weight:normal;font-size: 15px">Tanggal : {{\Carbon\Carbon::parse(now())->format('d-m-Y')}}</span></p>
        <hr>
        <table class="table table-bordered text-nowrap">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Jenis Kelamin</th>
                                        <th scope="col">Nomor HP</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col">Tanggal Input</th>
                                        <th scope="col">Tanggal Update</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pegawai as $pegawai)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{$pegawai->nama}}</td>
                                        <td>{{$pegawai->jns_kelamin}}</td>
                                        <td>{{$pegawai->no_hp}}</td>
                                        <td>{{$pegawai->alamat}}</td>
                                        <td>{{\Carbon\Carbon::parse($pegawai->tanggal_input)->format('d-m-Y')}}</td>
                                        <td>{{\Carbon\Carbon::parse($pegawai->tanggal_update)->format('d-m-Y')}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
    </div>

</body>

</html>