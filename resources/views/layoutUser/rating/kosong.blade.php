@extends('layoutUser/main')

@section('container1')
<div class="container mt-4">
    <div class="card shadow p-3 mb-5 bg-body rounded">
        <h5 class="card-header text-center">Rating & Feedback</h5>
        <div class="card-body">
            <!-- jika user sudah pernah check out dan belum input rating -->
            @if ( Auth::check() && !empty(auth()->user()->pemesanan->first()->checkIn->checkOut) && empty(auth()->user()->rating) )
            <a href="/rating/create"><button type="button" class="btn btn-sm btn-primary rounded-pill float-left"><i class="bi bi-plus-lg"></i> Input Rating & Feedback</button></a>
            @endif
            <h2 class="text-center text-secondary fw-normal"><i>Belum Ada Data Rating & Feedback</i></h2>
        </div>
    </div>
</div>
@endsection