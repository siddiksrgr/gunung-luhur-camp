@extends('layoutUser/main')

@section('container1')
<div class="container mt-4">
    <div class="card shadow p-3 mb-5 bg-body rounded">
        <h5 class="card-header text-center">Edit Rating & Feedback</h5>
        <div class="card-body mt-2">

            <p class="text-primary"><i class="bi bi-info-circle-fill"></i> Silahkan input rating & feedback/komentar anda berdasarkan pengelaman anda berkemah di Gunung Luhur Camp !</p>

            <form action="/rating/{{$rating->id}}" method="post">
                @method('patch')
                @csrf
                <div class="col-md-3 mb-4">
                    <label for="rating" class="form-label">Rating : <span class="text-secondary"> (pilih antara 1 sampai 5)</span></label>
                    <select class="form-select" name="rating" id="rating" aria-label="Default select example" required autofocus>

                        <option value="5" {{ $rating->rating == 5 ? 'selected' : '' }}>5</option>
                        <option value="4" {{ $rating->rating == 4 ? 'selected' : '' }}>4</option>
                        <option value="3" {{ $rating->rating == 3 ? 'selected' : '' }}>3</option>
                        <option value="2" {{ $rating->rating == 2 ? 'selected' : '' }}>2</option>
                        <option value="1" {{ $rating->rating == 1 ? 'selected' : '' }}>1</option>

                    </select>
                </div>

                <div class="mb-4">
                    <label for="komentar" class="form-label">Feedback :</label>
                    <textarea name="komentar" class="form-control" id="komentar" rows="2" placeholder="Feedback/Komentar" required>{{$rating->feedback}}</textarea>
                </div>
        </div>

        <div class="card-footer">
            <a href="{{ url()->previous() }}"><button type="button" class="btn btn-secondary rounded-pill mt-3">Cancel</button></a>
            <button type="submit" class="btn btn-primary rounded-pill mt-3">Simpan</button>
        </div>
        </form>


    </div>
    @endsection