@extends('layoutUser/main')

@section('container1')
<script>
    $(function() {
        $("#awal").datepicker({
            dateFormat: "dd-mm-yy"
        });
        $("#akhir").datepicker({
            dateFormat: "dd-mm-yy"
        });
    });
</script>

<div class="container">
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
    <div class="alert alert-primary alert-dismissible fade show mt-4" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
            <use xlink:href="#info-fill" />
        </svg>
        {{ session('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
</div>

<div class="container mt-4">
    <div class="card shadow p-3 mb-5 bg-body rounded">
        <h5 class="card-header text-center">Pesan Tiket Masuk</h5>
        <div class="card-body mt-2">

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#Modal1">Cara Pesan</button>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#Modal2">Harga Tiket Masuk</button>

            <!-- Modal1 Cara Pesan-->
            <div>
                <div class="modal fade" id="Modal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Cara Pesan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><i class="bi bi-dot"></i> Tanggal check in minimal hari ini atau melebihi dari tanggal sekarang.</p>
                                <p><i class="bi bi-dot"></i> Tanggal check out wajib melebihi dari tanggal check in.</p>
                                <p><i class="bi bi-dot"></i> Pemesan wajib mengisi jumlah anggota minimal 1.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal2 Daftar Harga-->
            <div>
                <div class="modal fade" id="Modal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Harga Tiket Masuk</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mt-2">
                                    @foreach($hargatiket as $hargatiket)
                                    <p><span class="text-decoration-underline">Harga Tiket Masuk :</span><span class="text-danger fw-bold"> @currency($hargatiket->harga),</span> {{$hargatiket->keterangan}}</p>
                                    @endforeach
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form method="post" class="mt-4" action="/pesan_tiket/{{$hargatiket->id}}">
                @csrf
                <div class="row mb-4">
                    <label for="awal" class="col-sm-2 col-form-label">&nbsp&nbsp Tanggal Check In :</label>
                    <div class="col-sm-10">
                        <input type="text" name="awal" class="form-control @error('awal') is-invalid @enderror" id="awal" placeholder="Tanggal-Bulan-Tahun" value="{{old('awal')}}" required>
                        @error('awal')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <label for="akhir" class="col-sm-2 col-form-label">&nbsp&nbsp Tanggal Check Out :</label>
                    <div class="col-sm-10">
                        <input type="text" name="akhir" class="form-control @error('akhir') is-invalid @enderror" id="akhir" placeholder="Tanggal-Bulan-Tahun" value="{{old('akhir')}}" required>
                        @error('akhir')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <label for="jmlh_anggota" class="col-sm-2 col-form-label">&nbsp&nbsp Jumlah Anggota :</label>
                    <div class="col-sm-10">
                        <input type="number" min="1" name="jmlh_anggota" class="form-control @error('jmlh_anggota') is-invalid @enderror" id="jmlh_anggota" placeholder="Jumlah anggota yang dibawa (minimal 1)" value="{{old('jmlh_anggota')}}" required>
                        @error('jmlh_anggota')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
        </div>
        <div class="card-footer">
            <div class="mt-3">
                <button type="submit" class="btn btn-primary rounded-pill">&nbsp&nbsp Pesan &nbsp&nbsp</button>
            </div>
        </div>
        </form>

    </div>
</div>
@endsection