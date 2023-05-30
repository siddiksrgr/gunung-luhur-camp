@extends('layoutAdmin.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Rating & Feedback</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Rating & Feedback</h3>
        </div>

        <!-- /.card-body -->
        <div class="col-lg-12">
            <div class="card-body table-responsive">

                <button type="button" onClick="window.print();" class="no-print btn btn-success mb-3"><i class="fas fa-print"></i> Print</button>

                <p class="text-bold mb-3">Total Rating : {{ number_format($total_rating, 2) }} <span class="font-weight-normal text-secondary">({{count(DB::table('rating_feedback')->get())}} review)</span></p>

                <i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i> <span class="mr-3">({{ count( DB::table('rating_feedback')->where('rating', '=', 5)->get() ) }})</span>
                <i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i class="far fa-star text-warning"></i> <span class="mr-3">({{ count( DB::table('rating_feedback')->where('rating', '=', 4)->get() ) }})</span>
                <i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i class="far fa-star text-warning"></i><i class="far fa-star text-warning"></i> <span class="mr-3">({{ count( DB::table('rating_feedback')->where('rating', '=', 3)->get() ) }})</span>
                <i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i class="far fa-star text-warning"></i><i class="far fa-star text-warning"></i><i class="far fa-star text-warning"></i> <span class="mr-3">({{ count( DB::table('rating_feedback')->where('rating', '=', 2)->get() ) }})</span>
                <i class="fas fa-star text-warning"></i><i class="far fa-star text-warning"></i><i class="far fa-star text-warning"></i><i class="far fa-star text-warning"></i><i class="far fa-star text-warning"></i> <span class="mr-3">({{ count( DB::table('rating_feedback')->where('rating', '=', 1)->get() ) }})</span>

                <div class="card-body table-responsive mt-3 p-0">
                    <table class="table table-bordered text-nowrap" id="datatable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Rating</th>
                                <th scope="col">Feedback</th>
                                <th scope="col">Tanggal Input</th>
                                <th scope="col">Tanggal Update</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rating as $rating)
                            <tr>
                                <td class="text-bold">{{$loop->iteration}}</td>
                                <td>{{$rating->user->nama}}</td>

                                @if($rating->rating == 1)
                                <td><i class="fas fa-star text-warning"></i><i class="far fa-star text-warning"></i><i class="far fa-star text-warning"></i><i class="far fa-star text-warning"></i><i class="far fa-star text-warning"></i></td>
                                @elseif($rating->rating == 2)
                                <td><i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i class="far fa-star text-warning"></i><i class="far fa-star text-warning"></i><i class="far fa-star text-warning"></i></td>
                                @elseif($rating->rating == 3)
                                <td><i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i class="far fa-star text-warning"></i><i class="far fa-star text-warning"></i></td>
                                @elseif($rating->rating == 4)
                                <td><i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i class="far fa-star text-warning"></i></td>
                                @elseif($rating->rating == 5)
                                <td><i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i></td>
                                @endif

                                <td>{{$rating->feedback}}</td>
                                <td>{{\Carbon\Carbon::parse($rating->tanggal_input)->format('d-m-Y')}}</td>
                                <td>{{\Carbon\Carbon::parse($rating->tanggal_update)->format('d-m-Y')}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- /.content -->
@endsection