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
        <p style="font-size: 15px;font-weight:bolder;margin-bottom: 20px;">Data Pembatalan Tiket<span style="float: right;font-weight:normal;font-size: 15px">Tanggal : {{\Carbon\Carbon::parse(now())->format('d-m-Y')}}</span></p>
        <hr>
        <table class="table table-bordered text-nowrap">
            <thead class="bg-light">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nomor Rekening</th>
                    <th scope="col">Atas Nama</th>
                    <th scope="col">Jumlah Refund</th>
                    <th scope="col">Alasan Batal</th>
                    <th scope="col">Status Refund</th>
                </tr>
            </thead>
            <tbody>
                @foreach($batalTiket as $batalTiket)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$batalTiket->no_rekening}}</td>
                    <td>{{$batalTiket->atas_nama}}</td>
                    <td>@currency($batalTiket->pemesanan->total_bayar + $batalTiket->pemesanan->kode_unik)</td>
                    <td>{{$batalTiket->alasan}}</td>

                    @php
                    $status_refund= $batalTiket->status_refund;
                    if ($status_refund == 0) {
                    $status = 'Diajukan refund, menunggu proses refund';
                    } elseif ($status_refund == 1) {
                    $status = 'Sudah direfund';
                    }
                    @endphp

                    @if ($status == 'Diajukan refund, menunggu proses refund')
                    <td><span class="badge bg-danger text-light">{{$status}}</span></td>
                    @elseif ($status == 'Sudah direfund')
                    <td><span class="badge badge-success text-light">{{$status}}</span></td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>

</html>