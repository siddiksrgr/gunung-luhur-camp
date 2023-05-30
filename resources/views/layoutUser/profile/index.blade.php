@extends('layoutUser/main')

@section('container1')
<div class="container mt-3">
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
</div>

<div class="container mt-4">
    <div class="card shadow p-3 mb-5 bg-body rounded">
        <h5 class="card-header text-center">Profile</h5>
        <div class="card-body mt-2">
            <div class="row">
                <div class="col-md-3 mt-3">
                    @if($user->foto == null)
                    <a href="{{ asset('img/User/default.png') }}" data-lightbox="photos">
                        <img src="{{ asset('img/User/default.png') }}" class="ms-3 rounded" style="height: 200px;width: 200px">
                    </a>
                    @else
                    <a href="{{  asset('img/User/' . $user->foto) }}" data-lightbox="photos">
                        <img src="{{ asset('img/User/' . $user->foto) }}" class="ms-3 rounded" style="height: 200px;width: 200px">
                    </a>
                    @endif
                </div>
                <div class="col-md-9">
                    <table class="table mt-2">
                        <tbody>
                            <tr>
                                <td class="col-2">Nama</td>
                                <td class="col-1 text-center">:</td>
                                <td>{{$user->nama}}</td>
                            </tr>
                            <tr>
                                <td class="col-2">Jenis Kelamin</td>
                                <td class="col-1 text-center">:</td>
                                <td>{{$user->jenis_kelamin}}</td>
                            </tr>
                            <tr>
                                <td class="col-2">No HP</td>
                                <td class="col-1 text-center">:</td>
                                <td>{{$user->no_hp}}</td>
                            </tr>
                            <tr>
                                <td class="col-2">Tanggal Daftar</td>
                                <td class="col-1 text-center">:</td>
                                <td>{{\Carbon\Carbon::parse($user->tanggal_daftar)->format('d-m-Y')}}</td>
                            </tr>
                            <tr>
                                <td class="col-2">Alamat</td>
                                <td class="col-1 text-center">:</td>
                                <td>{{$user->alamat}}</td>
                            </tr>
                            <tr>
                                <td class="col-2">Username</td>
                                <td class="col-1 text-center">:</td>
                                <td>{{$user->username}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer mt-3">
            <a href="/profile/edit"><button type="button" class="btn btn-primary rounded-pill mt-3"><i class="bi bi-pencil-square"></i> Edit Profile</button></a>
            <a href="/profile/editPassword/{{$user->id}}"><button type="button" class="btn btn-success rounded-pill mt-3"><i class="bi bi-key-fill"></i> Ganti Password</button></a>
        </div>
    </div>
</div>
@endsection