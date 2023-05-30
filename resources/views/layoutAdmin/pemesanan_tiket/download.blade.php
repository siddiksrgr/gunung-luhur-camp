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
        <p style="font-size: 15px;font-weight:bolder;margin-bottom: 20px;">Data Pemesanan Tiket<span style="float: right;font-weight:normal;font-size: 15px">Tanggal : {{\Carbon\Carbon::parse(now())->format('d-m-Y')}}</span></p>
        <hr>
        <table class="table table-bordered text-nowrap">
            <thead class="bg-light">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Nomor Tiket</th>
                    <th scope="col">Check In</th>
                    <th scope="col">Check Out</th>
                    <th scope="col">Anggota</th>
                    <th scope="col">Sewa Tenda</th>
                    <th scope="col">Kode Unik</th>
                    <th scope="col">Total Bayar</th>
                    <th scope="col">Status Bayar</th>
                    <th scope="col">Status Pesan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pemesanan as $pemesanan)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$pemesanan->user->nama}}</td>
                    <td>{{$pemesanan->nomor_pesan}}</td>
                    <td>{{\Carbon\Carbon::parse($pemesanan->pesanTiket->tgl_check_in)->format('d-m-Y')}}</td>
                    <td>{{\Carbon\Carbon::parse($pemesanan->pesanTiket->tgl_check_out)->format('d-m-Y')}}</td>
                    <td>{{$pemesanan->pesanTiket->total_anggota}}</td>

                    @if($pemesanan->sewaAlat != null)

                    @php
                    $sewa_tenda = $pemesanan->sewaAlat;
                    @endphp

                    <td>
                        @foreach($sewa_tenda as $sewa_tenda)
                        Kapasitas {{$sewa_tenda->alatSewa->kapasitas}} org - {{$sewa_tenda->jumlah}} pcs <br>
                        @endforeach
                    </td>

                    @else
                    <td> - </td>
                    @endif

                    <td>{{$pemesanan->kode_unik}}</td>
                    <td>@currency($pemesanan->total_bayar + $pemesanan->kode_unik)</td>

                    @php
                    $status = $pemesanan->status_pesan;
                    if ($status == 0) {
                    $status = 'Belum Bayar';
                    } elseif ($status == 1) {
                    $status = 'Sudah Bayar';
                    }elseif ($status == 2) {
                    $status = 'Sudah Divalidasi';
                    } elseif ($status == 3) {
                    $status = 'Sudah Divalidasi';
                    }
                    @endphp

                    @if ($status == 'Belum Bayar')
                    <td>
                        <span class="badge badge-danger text-light">{{$status}}</span>
                    </td>
                    @elseif ($status == 'Sudah Bayar')
                    <td>
                        <span class="badge badge-primary text-light">{{$status}}</span>
                    </td>
                    @elseif ($status == 'Sudah Divalidasi')
                    <td>
                        <span class="badge badge-success">{{$status}}</span>
                    </td>
                    @endif

                    @if ($pemesanan->batalTiket == null)
                    <td>
                        <span class="badge badge-success text-light">Diproses</span>
                    </td>
                    @elseif ($pemesanan->batalTiket !== null)
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