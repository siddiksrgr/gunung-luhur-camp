@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Pengembalian Tenda</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/check_out">Check Out</a></li>
                    <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Penyewaan Tambahan</a></li>
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
            <h3 class="card-title">Pengembalian Tenda</h3>
        </div>

        <div class="card-body">

            <div class="row">
                <div class="col-2">
                    <p>Nama Pemesanan</p>
                </div>
                <div class="col-10">
                    <p>: Sewa Tenda</p>
                </div>
            </div>

            <div class="row">
                <div class="col-2">
                    <p>Nama User</p>
                </div>
                <div class="col-10">
                    <p>: {{$sewaAlat->pemesanan->user->nama}}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-2">
                    <p>Tanggal Pesan</p>
                </div>
                <div class="col-10">
                    <p>: {{\Carbon\Carbon::parse($sewaAlat->pemesanan->tanggal_pesan)->format('d-m-Y')}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Nama Alat</p>
                </div>
                <div class="col-10">
                    <p>: {{$sewaAlat->alatSewa->nama}}</p>
                </div>
            </div>

            @if ($sewaAlat->alatSewa->kapasitas != null)
            <div class="row">
                <div class="col-2">
                    <p>Kapasitas Tenda</p>
                </div>
                <div class="col-10">
                    <p>: {{$sewaAlat->alatSewa->kapasitas}} orang</p>
                </div>
            </div>
            @endif

            <div class="row">
                <div class="col-2">
                    <p>Jumlah</p>
                </div>
                <div class="col-10">
                    <p>: {{$sewaAlat->jumlah}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Tanggal Pinjam</p>
                </div>
                <div class="col-10">
                    <p>: {{\Carbon\Carbon::parse($sewaAlat->tanggal_pinjam)->format('d-m-Y')}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Tanggal Kembali</p>
                </div>
                <div class="col-10">
                    <p>: {{\Carbon\Carbon::parse($sewaAlat->tanggal_kembali)->format('d-m-Y')}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Lama Sewa</p>
                </div>
                <div class="col-10">
                    <p>: {{$sewaAlat->lama_sewa}} hari</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Harga Sewa</p>
                </div>
                <div class="col-10">
                    <p>: @currency($sewaAlat->alatSewa->harga_sewa)/hari</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Harga Beli</p>
                </div>
                <div class="col-10">
                    <p>: @currency($sewaAlat->alatSewa->harga_beli)</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Total Bayar</p>
                </div>
                <div class="col-10">
                    <p>: Jumlah x Lama Sewa x Harga Alat</p>
                    <p>: {{$sewaAlat->jumlah}} x {{$sewaAlat->lama_sewa}} x @currency($sewaAlat->alatSewa->harga_sewa)</p>
                    <p>: @currency($sewaAlat->jumlah * $sewaAlat->lama_sewa * $sewaAlat->alatSewa->harga_sewa)</p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p class="text-bold">Status Sewa</p>
                </div>
                @php
                $status_kembali = $sewaAlat->status_kembali;
                if ($status_kembali == 0) {
                $status = 'Sedang Disewa';
                } elseif ($status_kembali == 1) {
                $status = 'Sudah Dikembalikan';
                }
                @endphp
                <div class="col-10">
                    @if ($status == 'Sedang Disewa')
                    <h6 class="text-primary text-bold">: {{$status}}</h6>
                    @elseif ($status == 'Sudah Dikembalikan')
                    <h6 class=" text-success text-bold">: {{$status}}</h6>
                    @endif
                </div>
            </div>

            @if( ($sewaAlat->status_kembali == 0) && (auth()->user()->level == 'pengelola') )
            <form method="post" action="/check_out/penyewaan_tenda/{{$sewaAlat->id}}">
                @method('patch')
                @csrf
                <div class="row form-grup mb-3">
                    <div class="col-2">
                        <label>Jumlah Kembali:</label>
                    </div>
                    <div class="col-10">
                        <input type="number" min="{{$sewaAlat->jumlah}}" max="{{$sewaAlat->jumlah}}" class="form-control" name="jmlh_kembali" placeholder="Jumlah Alat Yang Dikembalikan.." required autofocus value="{{old('jmlh_kembali')}}">
                    </div>
                </div>
                <div class="row form-grup mb-3">
                    <div class="col-2">
                        <label>Jumlah Bagus:</label>
                    </div>
                    <div class="col-10">
                        <input type="number" min="0" max="{{$sewaAlat->jumlah}}" class="form-control @error('jmlh_bagus') is-invalid @enderror" name="jmlh_bagus" placeholder="Jumlah Alat Yang Dikembalikan Dalam Kondis Bagus.." required value="{{old('jmlh_bagus')}}">
                    </div>
                    @error('jmlh_bagus')
                    <div class="error invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row form-grup mb-4">
                    <div class="col-2">
                        <label>Jumlah Rusak/Hilang:</label>
                    </div>
                    <div class="col-10">
                        <input type="number" min="0" max="{{$sewaAlat->jumlah}}" class="form-control @error('jmlh_rusak') is-invalid @enderror" name="jmlh_rusak" placeholder="Jumlah Alat Yang Dikembalikan Dalam Kondis Rusak/Hilang.." required value="{{old('jmlh_rusak')}}">
                    </div>
                    @error('jmlh_rusak')
                    <div class="error invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <p class="text-danger mb-2">Jika ada alat yang rusak/hilang, maka harus ganti @currency($sewaAlat->alatSewa->harga_beli) dikali jumlah alat yang rusak/hilang, jangan klik simpan jika belum bayar !</p>
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