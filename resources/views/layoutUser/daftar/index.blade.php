@extends('layoutUser/main')

@section('container1')
<div class="container mb-4"><br>
    <div class="row justify-content-center align-items-center">
        <div class="col-md-10">
            <div class="card shadow p-3 bg-body rounded">
                <h5 class="card-header text-center">Daftar</h5>

                <form method="post" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama :</label>
                            <input name="nama" type="text" id="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama" required autofocus value="{{old('nama')}}">
                            @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-4 mb-3">
                            <label class="form-label">Jenis Kelamin : </label>
                            <div class="form-check form-check-inline" style="margin-left: 10px;">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin1" value="Laki-laki" checked>
                                <label class="form-check-label" for="jenis_kelamin1">
                                    Laki-laki
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin2" value="Perempuan">
                                <label class="form-check-label" for="jenis_kelamin2">
                                    Perempuan
                                </label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="no_hp" class="form-label">Nomor Handphone :</label>
                            <input name="no_hp" type="number" id="no_hp" class="form-control @error('no_hp') is-invalid @enderror" placeholder="Nomor Handphone" required autofocus value="{{old('no_hp')}}">
                            @error('no_hp')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat :</label>
                            <textarea name="alamat" class="form-control" id="alamat" rows="2" placeholder="Alamat" required autofocus>{{ Request::old('alamat') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label">Username : <span class="form-text">(untuk login)</span></label>
                            <input name="username" type="text" id="username" class="form-control @error('username') is-invalid @enderror" placeholder="Username" required value="{{old('username')}}">
                            @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="login_password" class="form-label">Password : <span class="form-text">(untuk login)</span> </label>
                            <div class="input-group">
                                <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="login_password" placeholder="Password" required>
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Ulangi Password : <span class="form-text">(untuk login)</span> </label>
                            <div class="input-group">
                                <input name="password_confirmation" type="password" class="form-control @error('password') is-invalid @enderror" id="password_confirmation" placeholder="Ulangi Password" required>
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto : </label>
                            <input name="foto" type="file" id="foto" class="form-control" placeholder="foto">
                        </div>

                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary rounded-pill mt-3" type="submit">&nbsp&nbsp Daftar &nbsp&nbsp</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <br>
</div>
@endsection