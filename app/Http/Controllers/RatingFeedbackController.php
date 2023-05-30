<?php

namespace App\Http\Controllers;

use App\Models\RatingFeedback;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;


class RatingFeedbackController extends Controller
{
    public function index()
    {
        $rating = RatingFeedback::orderBy('tanggal_update', 'desc')->get();

        if (count($rating) == 0) {
            return view('layoutUser.rating.kosong');
        } else {
            $jumlah = $rating->sum('rating');
            $total = $rating->count();
            $total_rating = $jumlah / $total;

            return view('layoutUser.rating.index', [
                'rating' => $rating,
                'total_rating' => $total_rating
            ]);
        }
    }

    public function indexAdmin()
    {
        $rating = RatingFeedback::orderBy('tanggal_update', 'desc')->get();

        if (count($rating) > 0) {
            $jumlah = $rating->sum('rating');
            $total = $rating->count();
            $total_rating = $jumlah / $total;

            return view('layoutAdmin.rating.index', [
                'rating' => $rating,
                'total_rating' => $total_rating
            ]);
        } else
            return view('layoutAdmin.rating.kosong');
    }

    public function create()
    {
        // jika user sudah pernah check out dan belum input rating
        if (!empty(auth()->user()->pemesanan->first()->checkIn->checkOut) && empty(auth()->user()->rating)) {
            return view('layoutUser.rating.create');
        } else {
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        if (empty(auth()->user()->rating)) {
            $rating_feedback = new \App\Models\RatingFeedback;
            $rating_feedback->user_id = auth()->user()->id;
            $rating_feedback->rating = $request->rating;
            $rating_feedback->feedback = $request->komentar;
            $rating_feedback->tanggal_input = Carbon::now();
            $rating_feedback->tanggal_update = Carbon::now();
            $rating_feedback->save();
            return redirect('/rating')->with('status', 'Rating & Feedback berhasil dibuat');
        }
    }

    public function edit()
    {
        $rating = auth()->user()->rating;
        return view('layoutUser.rating.edit', compact('rating'));
    }

    public function update(Request $request, RatingFeedback $rating)
    {
        RatingFeedback::where('id', $rating->id)
            ->update([
                'rating' => $request->rating,
                'feedback' => $request->komentar,
                'tanggal_update' => Carbon::now()
            ]);
        return redirect('/rating')->with('status', 'Rating & Feedback berhasil diedit');
    }

    public function delete()
    {
        $rating = RatingFeedback::find(auth()->user()->rating->id);
        $rating->delete();
        return redirect('/rating')->with('status_hapus', 'Data Rating & Feedbcak berhasil dihapus');
    }

    public function download()
    {
        $rating = RatingFeedback::orderBy('tanggal_update', 'desc')->get();
        $jumlah = $rating->sum('rating');
        $total = $rating->count();
        $total_rating = $jumlah / $total;

        $pdf = PDF::loadView('layoutAdmin.rating.download', [
            'rating' => $rating,
            'total_rating' => $total_rating
        ]);
        return $pdf->download('Rating & Feedback.pdf');
    }
}
