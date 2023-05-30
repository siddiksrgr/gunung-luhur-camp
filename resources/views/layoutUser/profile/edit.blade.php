@extends('layoutUser/main')

@section('container1')
<div class="container mt-4">
    <div class="card shadow p-3 mb-5 bg-body rounded">
        <h5 class="card-header text-center">Edit Profile</h5>
        <div class="card-body mt-2">

            <form method="post" action="/profile/{{$user->id}}" enctype="multipart/form-data">
                @method('patch')
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama :</label>
                        <input name="nama" type="text" id="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama" required autofocus value="{{$user->nama}}">
                        @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-4 mb-3">
                        <label class="form-label">Jenis Kelamin : </label>
                        <div class="form-check form-check-inline" style="margin-left: 10px;">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin1" value="Laki-laki" @if($user->jenis_kelamin == 'Laki-laki'){ checked }@endif>
                            <label class="form-check-label" for="jenis_kelamin1">
                                Laki-laki
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin2" value="Perempuan" @if($user->jenis_kelamin == 'Perempuan'){ checked }@endif>
                            <label class="form-check-label" for="jenis_kelamin2">
                                Perempuan
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="no_hp" class="form-label">Nomor Handphone :</label>
                        <input name="no_hp" type="number" id="no_hp" class="form-control @error('no_hp') is-invalid @enderror" placeholder="No HP" required value="{{$user->no_hp}}">
                        @error('no_hp')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat :</label>
                        <textarea name="alamat" class="form-control" id="alamat" rows="2" placeholder="Alamat" required>{{ $user->alamat }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label">Username : <span class="form-text">(untuk login)</span></label>
                        <input name="username" type="text" id="username" class="form-control @error('username') is-invalid @enderror" placeholder="Username" required value="{{$user->username}}">
                        @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto : </label>
                        <input name="foto" type="file" id="foto" class="form-control" placeholder="foto">
                    </div>
                </div>
        </div>

        <div class="card-footer">
            <a href="/profile"><button type="button" class="btn btn-secondary rounded-pill mt-3"><i class="bi bi-x-lg"></i> Cancel</button></a>
            <button type="submit" class="btn btn-primary rounded-pill mt-3"><i class="bi bi-save"></i> Simpan</button>
        </div>
        </form>

    </div>
</div>
@endsection