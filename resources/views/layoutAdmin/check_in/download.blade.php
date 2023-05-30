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
            font-size: 11px;
        }
    </style>
</head>

<body>
    <div>
        <p style="font-size: 15px;font-weight:bolder;margin-bottom: 20px;">Data Check In<span style="float: right;font-weight:normal;font-size: 15px">Tanggal : {{\Carbon\Carbon::parse(now())->format('d-m-Y')}}</span></p>
        <hr>
        <table class="table table-bordered text-nowrap">
            <thead class="bg-light">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nomor Tiket</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Tanggal Check In</th>
                    <th scope="col">Tanggal Check Out</th>
                    <th scope="col">Status</th>
                    <th scope="col">Anggota</th>
                    <th scope="col">Tanggal Input</th>
                </tr>
            </thead>
            <tbody>
                @foreach($checkIn as $checkIn)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$checkIn->pemesanan->nomor_pesan}}</td>
                    <td>{{$checkIn->pemesanan->user->nama}}</td>
                    <td>{{\Carbon\Carbon::parse($checkIn->pemesanan->pesanTiket->tgl_check_in)->format('d-m-Y')}}</td>
                    <td>{{\Carbon\Carbon::parse($checkIn->pemesanan->pesanTiket->tgl_check_out)->format('d-m-Y')}}</td>

                    @php
                    $status = $checkIn->status;
                    if ($status == 0) {
                    $status = 'Sudah Check In';
                    }
                    if ($status == 1) {
                    $status = 'Sudah Check Out';
                    }
                    @endphp

                    @if ($status == 'Sudah Check In')
                    <td><span class="badge bg-success text-light">Sudah Check In</span></td>
                    @elseif ($status == 'Sudah Check Out')
                    <td><span class="badge bg-danger text-light">Sudah Check Out</span></td>
                    @endif

                    <td>{{$checkIn->pemesanan->pesanTiket->total_anggota}} orang</td>
                    <td>{{\Carbon\Carbon::parse($checkIn->tanggal_input)->format('d-m-Y')}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>

</html>