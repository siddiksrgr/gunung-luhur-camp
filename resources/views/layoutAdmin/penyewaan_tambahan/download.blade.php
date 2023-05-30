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
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div>
        <p style="font-size: 15px;font-weight:bolder;margin-bottom: 20px;">Data Penyewaan Tambahan<span style="float: right;font-weight:normal;font-size: 15px">Tanggal : {{\Carbon\Carbon::parse(now())->format('d-m-Y')}}</span></p>
        <hr>
        <table class="table table-bordered text-nowrap">
            <thead class="bg-light">
                <tr>
                    <th scope="col">Nama</th>
                    <th scope="col">Alat</th>
                    <th scope="col">Harga Sewa</th>
                    <th scope="col">Lama Sewa</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Total Bayar</th>
                    <th scope="col">Status Sewa</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pemesanan as $pemesanan)

                @php
                $sewa_alat = $pemesanan->sewaAlat;
                @endphp

                @foreach($sewa_alat as $sewa_alat)
                <tr>
                    <td>{{$sewa_alat->pemesanan->user->nama}}</td>
                    <td>{{$sewa_alat->alatSewa->nama}}</td>
                    <td>@currency($sewa_alat->alatSewa->harga_sewa)/hari</td>
                    <td>{{$sewa_alat->lama_sewa}} hari</td>
                    <td>{{$sewa_alat->jumlah}}</td>
                    <td>@currency($sewa_alat->total_bayar)</td>

                    @php
                    $status_kembali = $sewa_alat->status_kembali;
                    if ($status_kembali == 0) {
                    $status = 'Sedang Disewa';
                    } elseif ($status_kembali == 1) {
                    $status = 'Sudah Dikembalikan';
                    }
                    @endphp

                    @if ($status == 'Sedang Disewa')
                    <td><span class="badge rounded-pill bg-danger text-light">{{$status}}</span></td>
                    @elseif ($status == 'Sudah Dikembalikan')
                    <td><span class="badge rounded-pill bg-success text-light">{{$status}}</span></td>
                    @endif
                </tr>
                @endforeach

                @endforeach
            </tbody>
        </table>
    </div>

</body>

</html>