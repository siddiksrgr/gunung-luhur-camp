<!DOCTYPE html>
<html>

<head>
    <title>Download</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <style type="text/css">
        .page-break {
            page-break-before: always;
        }

        body {
            line-height: 1;
        }

        th,
        td {
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div>
        <p style="font-size: 15px;font-weight:bolder;margin-bottom: 20px;">Data Rating & Feedback<span style="float: right;font-weight:normal;font-size: 15px">Tanggal : {{\Carbon\Carbon::parse(now())->format('d-m-Y')}}</span></p>
        <hr>
        <p class="text-bold mb-3">Total Rating : {{$total_rating}} <span class="font-weight-normal text-secondary">({{count(DB::table('rating_feedback')->get())}} review)</span></p>
        <table class="table table-bordered text-nowrap">
            <thead class="bg-light">
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
                    <th scope="row">{{$loop->iteration}}</th>
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

</body>

</html>