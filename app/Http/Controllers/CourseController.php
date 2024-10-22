<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // Show all courses
    public function index()
    {
        $courses = Course::all();
        return view('courses.index', compact('courses'));
    }

    // Show a single course
    public function show($id)
    {
        $course = Course::with('teacher', 'assessments')->findOrFail($id);
        $teacher = $course->teacher;
        return view('course', compact('course'));
    }

    // Enroll a student in a course
    public function enroll(Request $request, $courseId)
    {
        $course = Course::findOrFail($courseId);
        $course->students()->attach(auth()->user()->id); // Assuming there's a many-to-many relationship
        return redirect()->route('courses.show', $courseId)->with('success', 'Enrolled successfully!');
    }

    // Assign teacher to course
    public function assignTeacher(Request $request)
    {
        // Validate the request to make sure course_id is provided
        $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);
    
        $courseId = $request->input('course_id');
        $teacherId = Auth::user()->id; // if the teacher is the logged-in user
    
        $course = Course::find($courseId);
        $course->teacher_id = $teacherId;
        $course->save();
    
        return redirect()->back()->with('success', 'Course assigned successfully!');
    }
    
}
