<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <h5 class="ml-3">ADMINISTRATOR</h5>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if(auth()->user()->foto == null)
                <img src="{{ asset('img/User/default.png') }}" class="img-circle elevation-2" alt="User Image">
                @else
                <img src="{{ asset('img/User/' . auth()->user()->foto) }}" class="img-circle elevation-2" alt="User Image">
                @endif
            </div>
            <div class="info">
                @if(auth()->user()->level == "admin")
                <a href="/user/admin" class="d-block">{{auth()->user()->nama}} <span>({{auth()->user()->level}})</span> </a>
                @elseif(auth()->user()->level == "pengelola")
                <a href="/user/pengelola" class="d-block">{{auth()->user()->nama}} <span>({{auth()->user()->level}})</span> </a>
                @endif
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->

                <!-- Dashboard -->
                @if(auth()->user()->level == 'pengelola')
                <li class="nav-item">
                    <a href="/dashboardPengelola" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @elseif (auth()->user()->level == 'admin')
                <li class="nav-item">
                    <a href="/dashboardAdmin" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @endif

                <!-- Data Master -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-database"></i>
                        <p>Data Master</p>
                        <i class="right fas fa-angle-left"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/alat_sewa" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Alat Sewa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/brg_hbs_pakai" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Barang Habis Pakai</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/makanan" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Makanan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/hargaTiket" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Harga Tiket Masuk</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/lokasi" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Lokasi
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- User -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>User</p>
                        <i class="right fas fa-angle-left"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/user/admin" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Admin</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/user/pengelola" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pengelola</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/user/pengunjung" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pengunjung</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Pemesanan Tiket-->
                <li class="nav-item">
                    <a href="/pemesanan_tiket" class="nav-link">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Pemesanan Tiket
                        </p>
                    </a>
                </li>

                <!-- Konfirmasi Pembayaran-->
                <li class="nav-item">
                    <a href="/konfirmasi_pembayaran" class="nav-link">
                        <i class="nav-icon fas  fa-money-bill"></i>
                        <p>
                            Konfirmasi Pembayaran
                        </p>
                    </a>
                </li>

                <!-- Pembatalan Tiket -->
                <li class="nav-item">
                    <a href="/pembatalan_tiket" class="nav-link">
                        <i class="fas fa-times nav-icon"></i>
                        <p>Pembatalan Tiket</p>
                    </a>
                </li>

                <!-- Check In -->
                <li class="nav-item">
                    <a href="/check_in" class="nav-link">
                        <i class="fas fa-sign-in-alt nav-icon"></i>
                        <p>Check In</p>
                    </a>
                </li>

                <!-- Penyewaan Tenda -->
                <li class="nav-item">
                    <a href="/penyewaan_tenda" class="nav-link">
                        <i class="fas fa-campground nav-icon"></i>
                        <p> Penyewaan Tenda</p>
                    </a>
                </li>

                <!-- Pemesanan Makan -->
                <li class="nav-item">
                    <a href="/pemesanan_makan" class="nav-link">
                        <i class="nav-icon fas fa-utensils"></i>
                        <p>Pemesanan Makanan</p>
                    </a>
                </li>

                <!--Penyewaan Alat Tambahan -->
                <li class="nav-item">
                    <a href="/penyewaan_tambahan" class="nav-link">
                        <i class="fas fa-plus nav-icon"></i>
                        <p>Sewa Alat Tambahan</p>
                    </a>
                </li>

                <!-- Penggantian Alat Rusak -->
                <li class="nav-item">
                    <a href="/penggantian_alat" class="nav-link">
                        <i class="fas fa-exchange-alt nav-icon"></i>
                        <p>Penggantian Alat Rusak</p>
                    </a>
                </li>

                <!-- Beli Barang Habis Pakai -->
                <li class="nav-item">
                    <a href="/beli_barang" class="nav-link">
                        <i class="nav-icon fas fa-burn"></i>
                        <p>
                            Pembelian Barang
                        </p>
                    </a>
                </li>

                <!-- check out -->
                <li class="nav-item">
                    <a href="/check_out" class="nav-link">
                        <i class="fas fa-sign-out-alt nav-icon"></i>
                        <p>Check Out</p>
                    </a>
                </li>

                <!-- Jadwal Piket -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>Jadwal Piket Pegawai</p>
                        <i class="right fas fa-angle-left"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/pegawai" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pegawai</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/shift_kerja" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Shift Kerja Pegawai</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/jadwal_piket" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Jadwal Piket Pegawai</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Rating & Feedback -->
                <li class="nav-item">
                    <a href="/rating_feedback" class="nav-link">
                        <i class="nav-icon fas fa-star-half-alt"></i>
                        <p>
                            Rating & Feedback
                        </p>
                    </a>
                </li>

                <li class="nav-header mt-3">LAPORAN</li>
                <!-- kunjungan -->
                <li class="nav-item">
                    <a href="/kunjungan" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Kunjungan
                        </p>
                    </a>
                </li>

                <!-- pemasukan -->
                <li class="nav-item">
                    <a href="/pemasukan" class="nav-link">
                        <i class="nav-icon fas fa-money-bill-wave"></i>
                        <p>
                            Pemasukan
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>