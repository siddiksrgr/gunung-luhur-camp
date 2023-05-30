<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top  shadow">
    <div class="container-fluid ms-4">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('img/Logo/logo.png') }}" style="height: 50px;width: auto">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('rating') ? 'active' : '' }}" href="/rating">Rating & Feedback</a>
                </li>
                @if(Auth::check())
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('pesan_tiket') ? 'active' : '' }}" href=" /pesan_tiket">Pesan Tiket Masuk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('sewa_tenda') ? 'active' : '' }}" href=" /sewa_tenda">Pesan Sewa Tenda</a>
                </li>
                @endif
            </ul>

            @if(Auth::check())
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Riwayat Pemesanan
                    </a>
                    <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarDropdownMenuLink">
                        <li class="nav-item">
                            <a class="dropdown-item {{ Request::is('pemesanan_user') ? 'active' : '' }}" href="/pemesanan_user" aria-current="page">Pemesanan
                                <span class="badge rounded-pill bg-danger">
                                    @php
                                    $pemesanan = DB::table('pemesanan')->where('user_id', auth()->user()->id)->where('status_pesan', 0)->first();
                                    if ($pemesanan == null) {
                                    $jumlah = 0;
                                    } else {
                                    $pesan_tiket = DB::table('pesan_tiket')->where('pemesanan_id', $pemesanan->id)->count();
                                    $sewa_tenda = DB::table('sewa_alat')->where('pemesanan_id', $pemesanan->id)->count();
                                    $jumlah = $pesan_tiket + $sewa_tenda;
                                    }
                                    @endphp
                                    {{$jumlah}}
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="dropdown-item {{ Request::is('konfirmasi/user') ? 'active' : '' }}" href="/konfirmasi/user" aria-current="page">Konfirmasi
                                <span class="badge rounded-pill bg-danger">
                                    @php
                                    $pemesanan = DB::table('pemesanan')->where('user_id', auth()->user()->id)->where('status_pesan', 1)->get();
                                    @endphp
                                    {{count( $pemesanan )}}
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="dropdown-item {{ Request::is('tiket_saya') ? 'active' : '' }}" href="/tiket_saya" aria-current="page">Tiket
                                <span class="badge rounded-pill bg-danger">
                                    @php
                                    $pemesanan = DB::table('pemesanan')->where('user_id', auth()->user()->id)->where('status_pesan', 2)->get();
                                    @endphp
                                    {{count( $pemesanan )}}
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="dropdown-item {{ Request::is('batal_tiket') ? 'active' : '' }}" href="/batal_tiket" aria-current="page">Batal Tiket
                                <span class="badge rounded-pill bg-danger">
                                    @php
                                    $pemesanan = DB::table('pemesanan')->where('user_id', auth()->user()->id)->where('status_pesan', 3)->get();
                                    @endphp
                                    {{count( $pemesanan )}}
                                </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown me-4">
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @if(auth()->user()->foto == null)
                        <img src="{{ asset('img/User/default.png') }}" class="rounded-circle" style="height: 30px;width: 30px">
                        @else
                        <img src="{{ asset('img/User/' . auth()->user()->foto) }}" class="rounded-circle" style="height: 30px;width: 30px">
                        @endif

                        {{auth()->user()->nama}}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarDropdownMenuLink">
                        <li class="nav-item">
                            <a class="dropdown-item {{ Request::is('profile') ? 'active' : '' }}" href="/profile">&nbspProfile</a>
                        </li>
                        <li class="nav-item">
                            <form action="/logout" method="post" class="nav-link">
                                @csrf
                                <button type="submit" class="btn btn-light">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
            @else
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('daftar') ? 'active' : '' }}" href="/daftar">Daftar</a>
                </li>
                <li class="nav-item me-4">
                    <a class="nav-link {{ Request::is('login') ? 'active' : '' }}" href="/login">Login</a>
                </li>
            </ul>
            @endif

        </div>
    </div>
</nav>