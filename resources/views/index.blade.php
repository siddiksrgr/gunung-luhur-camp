@extends('layoutUser/main')

@section('style')
<!-- Style Lighbox -->
<style>
    .photo-gallery {
        color: #313437;
        background-color: #fff;
    }

    .photo-gallery p {
        color: #7d8285;
    }

    .photo-gallery h2 {
        font-weight: bold;
        margin-bottom: 40px;
        padding-top: 40px;
        color: inherit;
    }

    @media (max-width:767px) {
        .photo-gallery h2 {
            margin-bottom: 25px;
            padding-top: 25px;
            font-size: 24px;
        }
    }

    .photo-gallery .intro {
        font-size: 16px;
        max-width: 500px;
        margin: 0 auto 40px;
    }

    .photo-gallery .intro p {
        margin-bottom: 0;
    }

    .photo-gallery .photos {
        padding-bottom: 20px;
    }

    .photo-gallery .item {
        padding-bottom: 30px;
    }
</style>
@endsection

<!-- welcome -->
@section('container1')
<div class="container-fluid bg-white" style="height: 450px;">
    <div class="container">
        <div class="row p-4">
            <div class="col-md-6" style="margin-top: 100px;">
                <p style="font-size:20px">Selamat Datang di,</p>
                <p style="font-size:45px" class="fw-bold">GUNUNG LUHUR CAMP</p>

                <div class="col-md-12">
                    <p>Web yang dapat melakukan
                        <a href="/pesan_tiket" class="text-decoration-none"><span class="fw-bold text-dark">pesan tiket masuk</span></a>,
                        <a href="/sewa_tenda" class="text-decoration-none"><span class="fw-bold text-dark">pesan sewa tenda</span></a>
                        untuk berkemah di perkemahan Gunung Luhur Camp.
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <img src="img/Slider/camping.png" class="img-fluid">
            </div>
        </div>
    </div>
</div>
@endsection

<!-- about -->
@section('container2')
<div class="continer mt-5">
    <div class="container justify-content-center">
        <div class="row p-5">
            <div class="col-md-6 float-end">
                <img src="img/Slider/what.png" class="img-fluid" style="height: 300px;">
            </div>
            <div class="col-md-6 float-start">
                <h4 class="text-center">ABOUT</h4>
                <p class="mt-4 mb-4 lh-lg">Website ini adalah web yang dapat melakukan
                    <span class="fw-bold">pesan tiket masuk,</span>
                    <span class="fw-bold">dan pesan sewa tenda</span> untuk berkemah di Gunung Luhur Camp.
                    Pengunjung yang ingin melakukan kemah di bumi perkemahan Gunung Luhur Camp dapat melakukan pemesanan melalui web ini.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- fasilitas -->
<div class="continer mt-5 bg-white">
    <div class="container justify-content-center">
        <div class="row p-5">
            <div class="col-md-6">
                <h4 class="text-center">FASILITAS</h4>

                <div style="margin-left: 90px;" class="mt-4 lh-lg">
                    <li>
                        Musholla
                    </li>
                    <li>
                        Toilet
                    </li>
                    <li>
                        Keamanan 24 Jam
                    </li>
                    <li>
                        Sewa Alat Kemah Di Lokasi (Tenda, Alat Masak)
                    </li>
                    <li>
                        Pesan Makan Di Lokasi
                    </li>
                </div>

            </div>
            <div class="col-md-6 float-start">
                <img src="img/Slider/list.png" class="img-fluid" style="height: 300px;">
            </div>
        </div>
    </div>
</div>

@php
$sum = DB::table('rating_feedback')->sum('rating');
$count = DB::table('rating_feedback')->count('rating');
if (!empty($count)) {
$rating = $sum / $count;
} else {
$rating = 0;
}
@endphp

<!-- rating -->
<div class="continer mt-5">
    <div class="container mt-5 mb-5 text-center">
        <div class="row p-5">
            <div class="col-md-6">
                <img src="img/Slider/feedback.png" class="img-fluid" style="height: 300px;">
            </div>
            <div class="col-md-6">
                <h4>RATING & FEEDBACK</h4>
                @if($rating !== 0)
                <div class="row justify-content-center">
                    <div class="col-3 mt-4">
                        <p style="font-size: 60px;margin-bottom:0px" class="text-success">{{ number_format($rating, 2) }}</p>
                        <p class="text-center">({{$count}} review)</p>
                    </div>
                    <div class="col-3 mt-4">
                        <i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i> ({{ count( DB::table('rating_feedback')->where('rating', '=', 5)->get() ) }}) <br>
                        <i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star text-warning"></i> ({{ count( DB::table('rating_feedback')->where('rating', '=', 4)->get() ) }}) <br>
                        <i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star text-warning"></i><i class="bi bi-star text-warning"></i> ({{ count( DB::table('rating_feedback')->where('rating', '=', 3)->get() ) }}) <br>
                        <i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star text-warning"></i><i class="bi bi-star text-warning"></i><i class="bi bi-star text-warning"></i> ({{ count( DB::table('rating_feedback')->where('rating', '=', 2)->get() ) }}) <br>
                        <i class="bi bi-star-fill text-warning"></i><i class="bi bi-star text-warning"></i><i class="bi bi-star text-warning"></i><i class="bi bi-star text-warning"></i><i class="bi bi-star text-warning"></i> ({{ count( DB::table('rating_feedback')->where('rating', '=', 1)->get() ) }}) <br>
                    </div>
                </div>
                <a href="/rating">
                    <button class="btn btn-primary rounded-pill btn-sm mt-5"> Detail Rating & Feedback</button>
                </a>
                <br>
                @elseif ($rating == 0)
                <p class="text-secondary mt-5">Belum Ada Data Rating & Feedback</p><br><br>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- gallery -->
<div class="continer mt-5 bg-white">
    <div class="container mt-5 mb-5 bg-white" id="gallery">
        <div class="p-5">
            <h4 class="text-center mb-5">GALLERY</h4>
            <div>
                <div class="row photos mt-3 mb-4">
                    <div class="col-sm-6 col-md-4 col-lg-3 item"><a href="img/FotoLokasi/18.jpg" data-lightbox="photos"><img class="img-fluid img-thumbnail" src="img/FotoLokasi/18.jpg"></a></div>
                    <div class="col-sm-6 col-md-4 col-lg-3 item"><a href="img/FotoLokasi/7.jpg" data-lightbox="photos"><img class="img-fluid img-thumbnail" src="img/FotoLokasi/7.jpg"></a></div>
                    <div class="col-sm-6 col-md-4 col-lg-3 item"><a href="img/FotoLokasi/9.jpg" data-lightbox="photos"><img class="img-fluid img-thumbnail" src="img/FotoLokasi/9.jpg"></a></div>
                    <div class="col-sm-6 col-md-4 col-lg-3 item"><a href="img/FotoLokasi/14.jpg" data-lightbox="photos"><img class="img-fluid img-thumbnail" src="img/FotoLokasi/14.jpg"></a></div>
                </div>
            </div>
        </div>
        <br>
    </div>
</div>

<!-- lokasi -->
<div class="card bg-dark mt-5" id="lokasi">
    <div class="container">
        <div class="row">
            <div class="col-4">
                <div class="card-body">
                    <h4 class="card-header text-center text-light">LOKASI</h4><br>
                    @foreach($lokasi as $lokasi)
                    <p class="text-light"><i class="bi bi-telephone"></i> {{$lokasi->no_hp}}</p>
                    <p class="text-light"><i class="bi bi-geo-alt"></i> {{$lokasi->alamat}}</p>
                    @endforeach
                </div>
            </div>
            <div class="col-8">
                <div class="card-body">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3962.788398953547!2d106.98597841449761!3d-6.673120267092399!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69b7045b75f41b%3A0xc6a5c767ec68699d!2sBumi%20Perkemahan%20Gunung%20Luhur!5e0!3m2!1sid!2sid!4v1623929695421!5m2!1sid!2sid" width="700" height="450" style="border: 0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection