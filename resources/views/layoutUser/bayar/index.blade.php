@extends('layoutUser/main')

@section('container1')
<div class="container">
    <div class="card shadow p-3 mt-3 mb-4 bg-body rounded">
        <h5 class="card-header text-center">Cara Melakukan Pembayaran</h5>
        <div class="card-body">
            <div class="row">
                <p>Pembayaran dilakukan dengan cara transfer ke nomor rekening berikut :</p>
                <div class="font-success mt-3 mb-3">
                    <p>Nomor Rekening : <span class="fw-bold">1111-2222-3333-4444</span></p>
                    <p>Atas Nama : <span class="fw-bold">Mulyono</span></p>
                    <p>Bank : <span class="fw-bold">BRI</span></p>
                </div>
                <p>Kode Unik : <span class="fw-bold text-danger">{{$kode_unik}}</span></p>
                <p>Anda diwajibkan membayar sebesar : <span class="fw-bold text-danger">@currency($total + $kode_unik)</span></p>
                <p>Setelah melakukan pembayaran, silahkan klik tombol konfirmasi pembayaran dibawah ini :</p>
            </div>
        </div>
        <div class="card-footer">
            <a href="/pemesanan_user"><button type="button" class="btn btn-secondary rounded-pill mt-3"><i class="bi bi-chevron-left"></i> Kembali</button></a>
            <a href="/konfirmasi/create"><button type="button" class="btn btn-primary rounded-pill mt-3">Konfirmasi Pembayaran <i class="bi bi-chevron-right"></i></button></a>
        </div>

    </div>
</div>
@endsection