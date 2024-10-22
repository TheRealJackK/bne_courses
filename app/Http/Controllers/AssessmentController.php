<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Assessment;
use App\Models\Review;
use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    // Show all assessments
    public function index()
    {
        $assessments = Assessment::all();
        return view('assessments.index', compact('assessments'));
    }

    // Show a single assessment
    public function show($id)
    {
        $assessment = Assessment::findOrFail($id);
        $students = User::where('user_type', 'student')->get(); // Or filter by course
        return view('assessment', compact('assessment', 'students'));
    }

    // Create peer review
    public function submitReview(Request $request, $assessmentId)
    {
        $request->validate([
            'reviewee_id' => 'required|exists:users,id',
            'review_text' => 'required|min:5',
            'rating' => 'required|integer|between:1,5',
        ]);

        Review::create([
            'assessment_id' => $assessmentId,
            'reviewer_id' => Auth::id(),
            'reviewee_id' => $request->reviewee_id,
            'review_text' => $request->review_text,
            'rating' => $request->rating,
            'score' => $this->calculateScore($request), // Implement scoring logic as needed
        ]);

        return redirect()->back()->with('success', 'Review submitted successfully.');
    }

    // Create and store assessment
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:20',
            'instruction' => 'required|string',
            'num_reviews_required' => 'required|integer|min:1',
            'max_score' => 'required|integer|min:1|max:100',
            'due_date' => 'required|date',
            'type' => 'required|string|in:student-select,teacher-assign',
            'course_id' => 'required|exists:courses,id',
        ]);
    
        // Create a new assessment
        Assessment::create($validatedData);
    
        // Redirect to the course page with the correct course_id
        return redirect()->route('courses.show', ['course' => $validatedData['course_id']])
                         ->with('success', 'Assessment created successfully');
    }
}