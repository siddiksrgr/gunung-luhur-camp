@extends('layoutUser.main')

@section('container1')
<div class="container mt-4">
    <div class="card shadow p-3 mb-5 bg-body rounded">
        <h5 class="card-header text-center">Pesan Sewa Tenda</h5>
        <div class="card-body">
            <div class="row">

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
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                            <use xlink:href="#info-fill" />
                        </svg>
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                </div>

                @foreach($alatsewa as $alat)
                <div class="col-md-3 p-2">
                    <div class="card shadow-sm p-2 bg-body rounded" style="width: 16rem;">
                        <form method="post" action="/sewa_tenda/{{$alat->id}}">
                            @csrf
                            <img class="img-fluid" src="img/AlatSewa/{{$alat->foto}}" alt="tenda">
                            <div class="card-body">
                                <h6 class="card-title">{{$alat->nama}}<span class="text-secondary"></span></h6>
                                <h5 class="text-danger">@currency($alat->harga_sewa)<span class="text-secondary fw-normal">/hari</span></h5>
                                <p class="lh-base text-secondary" style="font-size: 14px;">
                                    Kapasitas : {{$alat->kapasitas}} orang <br>
                                    Tersedia : {{$alat->stok}} tenda <br>
                                    Keterangan : {{$alat->keterangan}}
                                </p>

                                <div class="input-group input-group-sm mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Jumlah :</span>
                                    <input type="number" min="1" max="{{$alat->stok}}" name="jumlah" class="form-control" placeholder="0" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm rounded-pill w-100">Pesan</button>
                            </div>
                        </form>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</div>

@endsection