@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Sewa Alat</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/penyewaan_tambahan">Sewa Alat Tambahan</a></li>
                    <li class="breadcrumb-item active">Tambah</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="bootstrap-iso">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Tambah Data Sewa Alat</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="post" action="/penyewaan_tambahan">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama User :</label>
                        <select class="form-control" aria-label="Default select example" name="checkIn_id" required>
                            @foreach ($checkIn as $checkIn)
                            <option value="{{$checkIn->id}}"><span>{{$checkIn->pemesanan->user->nama}}</span></option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Alat :</label>
                        <select class="form-control" aria-label="Default select example" name="barang" required>
                            @foreach ($alatsewa as $alatsewa)
                            @if ($alatsewa->stok == !null)
                            <option value="{{$alatsewa->id}}"><span>{{$alatsewa->nama}}
                                    @if($alatsewa->keterangan == !null)({{$alatsewa->keterangan}})@endif
                                    @if($alatsewa->kapasitas == !null)(Kapasitas {{$alatsewa->kapasitas}} orang)@endif
                                    - @currency($alatsewa->harga_sewa)/hari (Sisa = {{$alatsewa->stok}})</span></option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jumlah :</label>
                        <input type="number" min="1" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" placeholder="Masukkan Jumlah Sewa.." required value="{{old('jumlah')}}">
                        @error('jumlah')
                        <div class="error invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Tanggal Kembali :</label>
                        <div class="input-group">
                            <input type="text" id="tgl_kembali" name="tgl_kembali" class="form-control @error('tgl_kembali') is-invalid @enderror" placeholder="Tanggal-Bulan-Tahun" required value="{{old('tgl_kembali')}}">>
                            @error('tgl_kembali')
                            <div class="error invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                    <a href="{{ url()->previous() }}"><button type="button" class="btn btn-secondary"><i class="fas fa-window-close"></i> Cancel</button></a>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection


@section('scripts')
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function() {
        $('#tgl_kembali').datepicker({
            dateFormat: "yy-mm-dd"
        });
    })
</script>
@endsection