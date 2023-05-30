@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tambah Jadwal Piket Pegawai</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Data Jadwal Piket Pegawai</h3>
                    </div>
                    <form method="post" action="/jadwal_piket">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="tanggal">Tanggal :</label>
                                <div class="input-group">
                                    <input type="text" id="tanggal" name="tanggal" class="form-control" placeholder="Tanggal-Bulan-Tahun" required>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pegawai">Nama Pegawai :</label>
                                <select class="form-control" aria-label="Default select example" name="pegawai" required>
                                    @foreach ($pegawai as $pegawai)
                                    <option value="{{$pegawai->id}}"><span>{{$pegawai->nama}}</span></option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="shift">Shift Kerja :</label>
                                <select class="form-control" aria-label="Default select example" name="shift" required>
                                    @foreach ($shift as $shift)
                                    <option value="{{$shift->id}}"><span>{{$shift->nama_shift}}</span></option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                            <a href="{{ url()->previous() }}"><button type="button" class="btn btn-secondary"><i class="fas fa-window-close"></i> Cancel</button></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</section>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function() {
        $('#tanggal').datepicker({
            dateFormat: "dd-mm-yy"
        });
    })
</script>
@endsection