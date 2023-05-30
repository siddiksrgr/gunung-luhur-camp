@extends('layoutUser/main')


@section('container1')
<div class="container mt-4 mb-4">
    <div class="card shadow p-3 bg-body rounded">
        <h5 class="card-header text-center">Konfirmasi</h5>
        <div class="card-body">

            <div class="container mt-2">
                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                    </symbol>
                    <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                    </symbol>
                    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                    </symbol>
                </svg>

                @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                        <use xlink:href="#check-circle-fill" />
                    </svg>
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if (session('status_hapus'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                        <use xlink:href="#check-circle-fill" />
                    </svg>
                    {{ session('status_hapus') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if (session('status_pesan_lagi'))
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                        <use xlink:href="#info-fill" />
                    </svg>
                    {{ session('status_pesan_lagi') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
            </div>

            <div class="container mt-3 mb-4">
                <table class="table table-bordered text-center">
                    <thead class="bg-light">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nomor Pemesanan</th>
                            <th scope="col">Total Bayar</th>
                            <th scope="col">Status Bayar</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pemesanan as $pemesanan)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$pemesanan->nomor_pesan}}</td>
                            <td>@currency($pemesanan->total_bayar + $pemesanan->kode_unik)</td>

                            @php
                            $status_pesan = $pemesanan->status_pesan;
                            if ($status_pesan == 1) {
                            $status_bayar = 'Sudah bayar, menunggu validasi.';
                            } elseif ($status_pesan == 2) {
                            $status_bayar = 'Sudah bayar, sudah divalidasi.';
                            }
                            @endphp

                            <td>{{$status_bayar}}</td>
                            <td>
                                <a href="/konfirmasi/{{$pemesanan->id}}/showUser"><span class="badge rounded-pill bg-primary">Detail</span></a>
                                <a href="/konfirmasi/{{$pemesanan->id}}/download" rel="noopener" target="_blank"><span class="badge rounded-pill bg-success">Download Kwitansi</span></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection