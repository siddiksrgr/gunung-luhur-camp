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
        <p style="font-size: 15px;font-weight:bolder;margin-bottom: 20px;">Data Check Out<span style="float: right;font-weight:normal;font-size: 15px">Tanggal : {{\Carbon\Carbon::parse(now())->format('d-m-Y')}}</span></p>
        <hr>
        <table class="table table-bordered text-nowrap">
            <thead class="bg-light">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nomor Tiket</th>
                    <th scope="col">Nama Pengunjung</th>
                    <th scope="col">Tanggal Check In</th>
                    <th scope="col">Tanggal Check Out</th>
                    <th scope="col">Tanggal Input</th>
                </tr>
            </thead>
            <tbody>
                @foreach($checkOut as $checkOut)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$checkOut->checkIn->pemesanan->nomor_pesan}}</td>
                    <td>{{$checkOut->checkIn->pemesanan->user->nama}}</td>
                    <td>{{\Carbon\Carbon::parse($checkOut->checkIn->pemesanan->pesanTiket->tgl_check_in)->format('d-m-Y')}}</td>
                    <td>{{\Carbon\Carbon::parse($checkOut->checkIn->pemesanan->pesanTiket->tgl_check_out)->format('d-m-Y')}}</td>
                    <td>{{\Carbon\Carbon::parse($checkOut->tanggal_input)->format('d-m-Y')}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>