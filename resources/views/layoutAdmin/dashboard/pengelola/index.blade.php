@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Dasboard</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        @php $pemesanan = DB::table('pemesanan')->where('status_pesan', 1)->get() @endphp
                        <h3>{{count( $pemesanan )}}</h3>
                        <p>Konfirmasi Pembayaran</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="/konfirmasi_pembayaran" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        @php $check_in = DB::table('check_in')->where('status', 0)->get() @endphp
                        <h3>{{count( $check_in )}}</h3>
                        <p>Check In</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-log-in"></i>
                    </div>
                    <a href="/check_in" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        @php $check_out = DB::table('check_out')->get() @endphp
                        <h3>{{count( $check_out )}}</h3>
                        <p>Check Out</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-log-out"></i>
                    </div>
                    <a href="/check_out" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        @php $batal_tiket = DB::table('batal_tiket')->get() @endphp
                        <h3>{{count( $batal_tiket )}}</h3>
                        <p>Pembatalan Tiket</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-close"></i>
                    </div>
                    <a href="/pembatalan_tiket" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
    </div>
</section>
<!-- /.content -->
@endsection