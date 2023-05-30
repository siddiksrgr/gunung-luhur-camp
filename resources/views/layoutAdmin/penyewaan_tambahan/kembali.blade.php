@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Pengembalian Alat Sewa</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/penyewaan_alat">Penyewaan Alat</a></li>
                    <li class="breadcrumb-item active">Pengembalian</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Pengembalian Alat Sewa</h3>
        </div>

        <div class="card-body">

            <div class="row">
                <div class="col-2">
                    <p>Nama Pemesanan</p>
                </div>
                <div class="col-10">
                    <p>: Sewa Alat Tambahan</p>
                </div>
            </div>

            <div class="row">
                <div class="col-2">
                    <p>Nama User</p>
                </div>
                <div class="col-10">
                    <p>: {{$sewaAlatTambah->checkIn->pemesanan->user->nama}}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-2">
                    <p>Tanggal Pesan</p>
                </div>
                <div class="col-10">
                    <p>: {{\Carbon\Carbon::parse($sewaAlatTambah->tanggal_pesan)->format('d-m-Y')}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Nama Alat</p>
                </div>
                <div class="col-10">
                    <p>: {{$sewaAlatTambah->sewaAlat->alatSewa->nama}}</p>
                </div>
            </div>

            @if ($sewaAlatTambah->sewaAlat->alatSewa->kapasitas != null)
            <div class="row">
                <div class="col-2">
                    <p>Kapasitas Tenda</p>
                </div>
                <div class="col-10">
                    <p>: {{$sewaAlatTambah->sewaAlat->alatSewa->kapasitas}} orang</p>
                </div>
            </div>
            @endif

            <div class="row">
                <div class="col-2">
                    <p>Jumlah</p>
                </div>
                <div class="col-10">
                    <p>: {{$sewaAlatTambah->sewaAlat->jumlah}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Tanggal Pinjam</p>
                </div>
                <div class="col-10">
                    <p>: {{\Carbon\Carbon::parse($sewaAlatTambah->sewaAlat->tanggal_pinjam)->format('d-m-Y')}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Tanggal Kembali</p>
                </div>
                <div class="col-10">
                    <p>: {{\Carbon\Carbon::parse($sewaAlatTambah->sewaAlat->tanggal_kembali)->format('d-m-Y')}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Lama Sewa</p>
                </div>
                <div class="col-10">
                    <p>: {{$sewaAlatTambah->sewaAlat->lama_sewa}} hari</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Harga Sewa</p>
                </div>
                <div class="col-10">
                    <p>: @currency($sewaAlatTambah->sewaAlat->alatSewa->harga_sewa)/hari</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Total Bayar</p>
                </div>
                <div class="col-10">
                    <p>: Jumlah x Lama Sewa x Harga Alat</p>
                    <p>: {{$sewaAlatTambah->sewaAlat->jumlah}} x {{$sewaAlatTambah->sewaAlat->lama_sewa}} x @currency($sewaAlatTambah->sewaAlat->alatSewa->harga_sewa)</p>
                    <p>: @currency($sewaAlatTambah->sewaAlat->jumlah * $sewaAlatTambah->sewaAlat->lama_sewa * $sewaAlatTambah->sewaAlat->alatSewa->harga_sewa)</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Status Sewa</p>
                </div>
                @php
                $status_kembali = $sewaAlatTambah->sewaAlat->status_kembali;
                if ($status_kembali == 0) {
                $status = 'Sedang Disewa';
                } elseif ($status_kembali == 1) {
                $status = 'Sudah Dikembalikan';
                }
                @endphp
                <div class="col-10">
                    @if ($status == 'Sedang Disewa')
                    <h6 class="text-danger text-bold">: {{$status}}</h6>
                    @elseif ($status == 'Sudah Dikembalikan')
                    <h6 class=" text-success text-bold">: {{$status}}</h6>
                    @endif
                </div>
            </div>

            @if( ($sewaAlatTambah->sewaAlat->status_kembali == 0) && (auth()->user()->level == 'pengelola') )
            <form method="post" action="/penyewaan_tambahan/{{$sewaAlatTambah->sewaAlat->id}}">
                @method('patch')
                @csrf
                <div class="row form-grup mb-3">
                    <div class="col-2">
                        <label>Jumlah Pengembalian</label>
                    </div>
                    <div class="col-10">
                        <input type="number" min="1" max="{{$sewaAlatTambah->sewaAlat->jumlah}}" class="form-control" name="jmlh_kembali" placeholder="Jumlah Alat Yang Dikembalikan.." required autofocus>
                    </div>
                </div>
                <div class="row form-grup mb-3">
                    <div class="col-2">
                        <label>Jumlah Bagus</label>
                    </div>
                    <div class="col-10">
                        <input type="number" min="0" max="{{$sewaAlatTambah->sewaAlat->jumlah}}" class="form-control" name="jmlh_bagus" placeholder="Jumlah Alat Yang Dikembalikan Dalam Kondis Bagus.." required>
                    </div>
                </div>
                <div class="row form-grup mb-3">
                    <div class="col-2">
                        <label>Jumlah Rusak/Hilang </label>
                    </div>
                    <div class="col-10">
                        <input type="number" min="0" max="{{$sewaAlatTambah->sewaAlat->jumlah}}" class="form-control" name="jmlh_rusak" placeholder="Jumlah Alat Yang Dikembalikan Dalam Kondis Rusak/Hilang.." required>
                        <p class="text-danger">Jika ada alat yang rusak/hilang, maka harus ganti @currency($sewaAlatTambah->sewaAlat->alatSewa->harga_beli) dikali jumlah alat yang rusak/hilang, jangan klik simpan jika belum bayar !</p>
                    </div>
                </div>
        </div>

        <div class="card-footer">
            <a href="{{ url()->previous() }}"><button type="button" class="btn btn-secondary mt-3"><i class="fas fa-chevron-left"></i> Kembali</button></a>
            <button type="submit" class="btn btn-primary mt-3"><i class="fas fa-save"></i> Simpan</button>
        </div>

        </form>
        @else
        <div class="card-footer">
            <a href="{{ url()->previous() }}"><button type="button" class="btn btn-secondary mt-3"><i class="fas fa-chevron-left"></i> Kembali</button></a>
        </div>
        @endif
    </div>

</section>
<!-- /.content -->
@endsection