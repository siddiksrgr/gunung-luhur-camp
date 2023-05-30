@extends('layoutUser.main')

@section('container1')
<div class="container mt-4">
    <div class="card shadow p-3 mb-4 bg-body rounded">
        <h5 class="card-header text-center">Konfirmasi Pembayaran</h5>
        <div class="card-body">

            <div class="mb-2 mt-2 row">
                <p class="col-sm-2">Total Bayar :</p>
                <div class=" col-sm-10">
                    <span class="fw-bold text-danger">@currency($total + $pemesanan->kode_unik)</span>
                </div>
            </div>

            <form method="post" action="/konfirmasi/{{$pemesanan}}" enctype="multipart/form-data">
                @csrf
                <div class="mb-4 row">
                    <label for="bukti" class="col-sm-2 col-form-label">Bukti Transfer :</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="file" id="bukti" name="bukti" required>
                        <div id="bukti" class="form-text">Bukti transfer berupa gambar hasil transfer sesuai total bayar.</div>
                    </div>
                </div>
        </div>
        <div class="card-footer">
            <a href="/bayar"><button type="button" class="btn btn-secondary rounded-pill mt-3"><i class="bi bi-chevron-left"></i> Kembali</button></a>
            <button type="submit" class="btn btn-primary rounded-pill mt-3">Konfirmasi <i class="bi bi-chevron-right"></i></button>
            </form>
        </div>
    </div>
</div>
@endsection