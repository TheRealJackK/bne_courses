<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User; // Make sure to include the User model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    // fucntion for students enrolling themselves
    public function enroll(Request $request, $courseId)
    {
        $user = Auth::user();

        // Check if the user is a student
        if ($user->user_type !== 'student') {
            return redirect()->back()->with('error', 'Only students can enroll in courses.');
        }

        // Check if the course exists
        $course = Course::findOrFail($courseId);

        // Validate the input
        $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);

        // Check if the student is already enrolled
        if (Enrollment::where('user_id', $user->id)->where('course_id', $courseId)->exists()) {
            return redirect()->back()->with('error', 'You are already enrolled in this course.');
        }

        // Create the enrollment record
        Enrollment::create([
            'user_id' => $user->id,
            'course_id' => $courseId,
        ]);

        return redirect()->back()->with('success', 'You have successfully enrolled in the course.');
    }

    // Method for teachers enrolling students
    public function enrollStudent(Request $request)
    {
        $teacher = Auth::user();

        // Check if the user is a teacher
        if ($teacher->user_type !== 'teacher') {
            return redirect()->back()->with('error', 'Only teachers can enroll students.');
        }

        // Validate the input
        $request->validate([
            'student_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
        ]);

        // Check if the student is already enrolled
        $alreadyEnrolled = Enrollment::where('user_id', $request->student_id)
                                     ->where('course_id', $request->course_id)
                                     ->exists();

        if ($alreadyEnrolled) {
            return redirect()->back()->with('error', 'Student is already enrolled in this course.');
        }

        // Create the enrollment record
        Enrollment::create([
            'user_id' => $request->student_id,
            'course_id' => $request->course_id,
        ]);

        return redirect()->back()->with('success', 'Student enrolled successfully.');
    }

    // function for student withdrawing from course
    public function withdraw(Request $request, $courseId)
    {
        $user = Auth::user();

        // Check if the user is a student
        if ($user->user_type !== 'student') {
            return redirect()->back()->with('error', 'Only students can withdraw from courses.');
        }

        // Check if the course exists
        $course = Course::findOrFail($courseId);

        // Check if the student is enrolled in the course
        $enrollment = Enrollment::where('user_id', $user->id)->where('course_id', $courseId)->first();

        if (!$enrollment) {
            return redirect()->back()->with('error', 'You are not enrolled in this course.');
        }

        // Delete the enrollment record
        $enrollment->delete();

        return redirect()->route('home', $courseId)->with('success', 'You have successfully withdrawn from the course.');
    }
}