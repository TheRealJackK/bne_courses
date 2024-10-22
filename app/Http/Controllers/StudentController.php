<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // show all assessments
    public function index()
    {
        $assessments = Assessment::all(); // You can filter by enrolled courses later
        return view('student.assessments', compact('assessments'));
    }

    // show the form for submitting a peer review
    public function submitPeerReview($assessmentId)
    {
        $assessment = Assessment::findOrFail($assessmentId);
        return view('student.submit_peer_review', compact('assessment'));
    }

    // store the peer review
    public function storePeerReview(Request $request, $assessmentId)
    {
        $validatedData = $request->validate([
            'review' => 'required|string',
            'score' => 'required|integer|min:1|max:100',
        ]);

        // Store the review in the database (implement your model logic)
        // Example:
        // PeerReview::create([...]);

        return redirect()->route('student.assessments')->with('success', 'Peer review submitted successfully!');
    }

    // View received reviews
    public function viewReceivedReviews($assessmentId)
    {
        $assessment = Assessment::findOrFail($assessmentId);
        $peerReviews = $assessment->peerReviews()->where('reviewed_student_id', auth()->id())->get();

        return view('student.view_received_reviews', compact('assessment', 'peerReviews'));
    }
}