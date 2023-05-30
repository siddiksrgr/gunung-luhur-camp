@extends('layoutUser/main')

@section('container1')
<div class="container mt-4">
    <div class="card shadow p-3 mb-5 bg-body rounded">
        <h5 class="card-header text-center">Ganti Password</h5>
        <div class="card-body mt-2">
            <form method="post" action="/profile/editPassword/{{$user->id}}">
                @method('patch')
                @csrf
                <div class="mb-3">
                    <label for="password" class="form-label">Password Baru :</label>
                    <div class="input-group">
                        <input name="password" type="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password Baru" required autofocus>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Ulangi Password :</label>
                    <div class="input-group">
                        <input name="password_confirmation" type="password" id="password_confirmation" class="form-control @error('password') is-invalid @enderror" placeholder="Ulangi Password" required>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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