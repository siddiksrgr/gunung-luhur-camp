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
            font-size: 13px;
        }
    </style>
</head>

<body>
    <div>
        <p style="font-size: 15px;font-weight:bolder;margin-bottom: 20px;">Data Konfirmasi Pembayaran<span style="float: right;font-weight:normal;font-size: 15px">Tanggal : {{\Carbon\Carbon::parse(now())->format('d-m-Y')}}</span></p>
        <hr>
        <table class="table table-bordered text-nowrap">
            <thead class="bg-light">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Nomor Tiket</th>
                    <th scope="col">Total Bayar</th>
                    <th scope="col">Status Bayar</th>
                    <th scope="col">Status Pesan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($konfirmasi as $konfirmasi)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$konfirmasi->pemesanan->user->nama}}</td>
                    <td>{{$konfirmasi->pemesanan->nomor_pesan}}</td>
                    <td>@currency($konfirmasi->pemesanan->total_bayar + $konfirmasi->pemesanan->kode_unik)</td>

                    @php
                    $status = $konfirmasi->pemesanan->status_pesan;
                    if ($status == 1) {
                    $status = 'Menunggu Validasi';
                    }elseif ($status == 2) {
                    $status = 'Sudah Divalidasi';
                    } elseif ($status == 3) {
                    $status = 'Sudah Divalidasi';
                    }
                    @endphp

                    @if ($status == 'Menunggu Validasi')
                    <td>
                        <span class="badge badge-danger text-light">{{$status}}</span>
                    </td>
                    @elseif ($status == 'Sudah Divalidasi')
                    <td>
                        <span class="badge badge-success">{{$status}}</span>
                    </td>
                    @endif

                    @if ($konfirmasi->pemesanan->batalTiket == null)
                    <td>
                        <span class="badge badge-success text-light">Diproses</span>
                    </td>
                    @elseif ($konfirmasi->pemesanan->batalTiket !== null)
                    <td>
                        <span class="badge badge-danger text-light">Dibatalkan</span>
                    </td>
                    @endif

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>

</html>