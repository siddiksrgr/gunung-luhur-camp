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
        <p style="font-size: 15px;font-weight:bolder;margin-bottom: 20px;">Data Penyewaan Tenda<span style="float: right;font-weight:normal;font-size: 15px">Tanggal : {{\Carbon\Carbon::parse(now())->format('d-m-Y')}}</span></p>
        <hr>
        <table class="table table-bordered text-nowrap">
            <thead class="bg-light">
                <tr>
                    <th scope="col">Nama</th>
                    <th scope="col">Kapasitas Tenda</th>
                    <th scope="col">Lama Sewa</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Status Sewa</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pemesanan as $pemesanan)

                @if(!empty($pemesanan->sewaAlat))

                @php
                $sewa_tenda = $pemesanan->sewaAlat;
                @endphp

                @foreach($sewa_tenda as $sewa_tenda)
                @if($sewa_tenda->alatSewa->kapasitas != null)
                <tr>
                    <td>{{$sewa_tenda->pemesanan->user->nama}}</td>
                    <td>{{$sewa_tenda->alatSewa->kapasitas}} orang</td>
                    <td>{{$sewa_tenda->lama_sewa}} hari</td>
                    <td>{{$sewa_tenda->jumlah}}</td>

                    @php
                    $checkIn = $pemesanan->checkIn;
                    $status_kembali = $sewa_tenda->status_kembali;

                    if (($checkIn == null) && ($pemesanan->status_pesan == 2)) {
                    $status = 'Belum Check In';
                    } elseif ($status_kembali == 0) {
                    $status = 'Sedang Disewa';
                    } elseif ($status_kembali == 1) {
                    $status = 'Sudah Dikembalikan';
                    }
                    @endphp

                    @if ($status == 'Belum Check In')
                    <td><span class="badge rounded-pill bg-danger text-light">{{$status}}</span></td>
                    @elseif ($status == 'Sedang Disewa')
                    <td><span class="badge rounded-pill bg-danger text-light">{{$status}}</span></td>
                    @elseif ($status == 'Sudah Dikembalikan')
                    <td><span class="badge rounded-pill bg-success text-light">{{$status}}</span></td>
                    @endif
                </tr>
                @endif
                @endforeach

                @endif
                @endforeach
            </tbody>
        </table>
    </div>

</body>

</html>