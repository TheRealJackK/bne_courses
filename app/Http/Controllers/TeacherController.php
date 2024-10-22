<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Assessment;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    // Show all courses the teacher is teaching
    public function index()
    {
        $courses = Course::all();
        return view('teacher.courses', compact('courses'));
    }

    // // show the create a new course
    // public function createCourse()
    // {
    //     return view('teacher.create_course');
    // }

    // Store a new course
    // public function storeCourse(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'course_code' => 'required|unique:courses',
    //         'name' => 'required|string|max:255',
    //     ]);

    //     Course::create($validatedData);

    //     return redirect()->route('teacher.courses')->with('success', 'Course created successfully!');
    // }

    // Show the form to create a new assessment for a course
    // public function createAssessment($courseId)
    // {
    //     $course = Course::findOrFail($courseId);
    //     return view('teacher.create_assessment', compact('course'));
    // }

    // Store a new assessment
    // public function storeAssessment(Request $request, $courseId)
    // {
    //     $validatedData = $request->validate([
    //         'title' => 'required|string|max:255',
    //         'instruction' => 'required|string',
    //         'num_reviews_required' => 'required|integer|min:1',
    //         'max_score' => 'required|integer|min:1',
    //         'due_date' => 'required|date',
    //         'type' => 'required|in:student-select,teacher-assign',
    //     ]);

    //     $course = Course::findOrFail($courseId);
    //     $course->assessments()->create($validatedData);

    //     return redirect()->route('teacher.courses')->with('success', 'Assessment created successfully!');
    // }

    // // View all assessments for a course
    // public function showAssessments($courseId)
    // {
    //     $course = Course::findOrFail($courseId);
    //     $assessments = $course->assessments;
    //     return view('teacher.assessments', compact('course', 'assessments'));
    // }
}
