<!DOCTYPE html>
<html>

<head>
    <title>Download</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <style type="text/css">
        .page-break {
            page-break-before: always;
        }

        hr {
            border: 1px solid;
        }

        th,
        td,
        span,
        p {
            font-size: 13px;
        }
    </style>
</head>

<body>
    <center>
        <p style="font-size: 20px;font-weight:bolder;margin-bottom:0px;margin-top:0px">Jadwal Piket Pegawai</p>
        <p style="font-size: 15px;">Periode {{$bulan}} {{$tahun}}</p>
        <hr>
    </center>

    @foreach($shift as $shift)
    <span>{{$shift->nama_shift}} : {{$shift->jam_masuk}} - {{$shift->jam_pulang}}, &nbsp; </span>
    @endforeach

    <div class="row">
        <div class="col-8">
            <table class="table table-bordered table-striped table-sm" style="margin-top: 20px;">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Nama Pegawai</th>
                        <th scope="col">Shift Kerja</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jadwal as $jadwal)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{\Carbon\Carbon::parse($jadwal->tanggal)->format('d-m-Y')}}</td>
                        <td>{{$jadwal->pegawai->nama}}</td>
                        <td>{{$jadwal->shift->nama_shift}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>