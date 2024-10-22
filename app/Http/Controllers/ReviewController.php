<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{   
    // function for submiutting review
    public function submit(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'reviewee_id' => 'required|exists:users,id', // Assuming reviewee is a user
            'review_text' => 'required|min:5',
            'rating' => 'required|integer|min:1|max:5',
            'score' => 'required|integer|min:1|max:100',
            'assessment_id' => 'required|exists:assessments,id',
        ]);
    
        // create a new review
        $review = new Review();
        $review->reviewer_id = auth()->id(); // Assuming the logged-in user is the reviewer
        $review->reviewee_id = $request->input('reviewee_id');
        $review->review_text = $request->input('review_text');
        $review->rating = $request->input('rating');
        $review->score = $request->input('score');
        $review->assessment_id = $request->input('assessment_id');
        $review->save();
    
        // redirect or return a response
        return redirect()->back()->with('success', 'Peer review submitted successfully.');
    }
}