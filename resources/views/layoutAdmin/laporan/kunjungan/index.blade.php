@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Kunjungan</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Kunjungan Hari Ini</h3>
        </div>
        <div class="card-body">
            <a href="/kunjunganToday"><button type="button" class="btn btn-primary"><i class="fas fa-eye"></i> Hari Ini</button></a>
        </div>
        <div class="card-footer">
        </div>
    </div>

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Total Kunjungan Keseluruhan</h3>
        </div>
        <div class="card-body">
            <a href="/kunjunganTotal"><button type="button" class="btn btn-primary"><i class="fas fa-eye"></i> Keseluruhan</button></a>
        </div>
        <div class="card-footer">
        </div>
    </div>

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lihat Berdasarkan Rentang Tanggal</h3>
        </div>
        <!-- /.card-header -->
        <form method="post" action="/kunjungan">
            @csrf
            <div class="card-body table-responsive">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Tanggal Awal :</label>
                            <div class="input-group">
                                <input type="text" id="tgl_awal" name="tgl_awal" class="form-control @error('tgl_awal') is-invalid @enderror" value="{{old('tgl_awal')}}" placeholder="Tanggal-Bulan-Tahun" required>
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                @error('tgl_awal')
                                <span id="tgl_awal" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Tanggal Akhir :</label>
                            <div class="input-group">
                                <input type="text" id="tgl_akhir" name="tgl_akhir" class="form-control @error('tgl_akhir') is-invalid @enderror" value="{{old('tgl_akhir')}}" placeholder="Tanggal-Bulan-Tahun" required>
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                @error('tgl_akhir')
                                <span id="tgl_akhir" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary"><i class="fas fa-eye"></i> Lihat</button>
            </div>
        </form>
    </div>

</section>
<!-- /.content -->
@endsection


@section('scripts')
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function() {
        $('#tgl_awal').datepicker({
            dateFormat: "dd-mm-yy"
        });
        $('#tgl_akhir').datepicker({
            dateFormat: "dd-mm-yy"
        });
    })
</script>
@endsection