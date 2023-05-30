@extends('layoutUser/main')

@section('container1')
<div class="container">
    <div class="row justify-content-center align-items-center mb-5" style="height:75vh">
        <div class="container mt-4">
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

            @if (session('status_salah'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                    <use xlink:href="#exclamation-triangle-fill" />
                </svg>
                {{ session('status_salah') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
        </div>
        <div class="col-md-4 mt-4">
            <div class="card shadow p-3 bg-body rounded">
                <div class="card-body">
                    <form method="post" action="{{ route('login') }}">
                        @csrf
                        <h3 class="h3 mb-3 fw-normal text-center">Login</h3>
                        <div class="mb-3">
                            <input name="username" type="text" id="inputUsername" class="form-control" placeholder="Username" required autofocus>
                        </div>

                        <div class="input-group mb-3">
                            <input type="password" class="form-control" id="login_password" placeholder="Password" name="password" required>
                            <span class="input-group-text" id="eyeSlash">
                                <button class="btn btn-sm" onclick="visibility3()" type="button"><i class="bi bi-eye-slash-fill" aria-hidden="true"></i></button>
                            </span>
                            <span class="input-group-text" id="eyeShow" style="display: none;">
                                <button class="btn btn-sm" onclick="visibility3()" type="button"><i class="bi bi-eye-fill" aria-hidden="true"></i></button>
                            </span>
                        </div>
                        <button class="w-100 btn btn-lg btn-primary" type="submit"><span class="fw-bold">Login</span></button>
                    </form>

                    <hr>

                    <p class="mt-4 text-center">Belum punya akun ? </p>
                    <p class="text-center"><a href="/daftar">Daftar disini</a></p>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function visibility3() {
        var x = document.getElementById('login_password');
        if (x.type === 'password') {
            x.type = "text";
            $('#eyeShow').show();
            $('#eyeSlash').hide();
        } else {
            x.type = "password";
            $('#eyeShow').hide();
            $('#eyeSlash').show();
        }
    }
</script>
@endsection