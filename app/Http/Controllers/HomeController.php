<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // ensure user is loggedin
        if (!$user) {
            // Redirect if user is not logged in
            return redirect()->route('login')->with('error', 'Please log in to access this page.');
        }
    
        // Fetch courses based on user type
        if ($user->user_type == 'student') {
            $courses = $user->enrolledCourses; // Fetch enrolled courses for students
            $students = null;
        } elseif ($user->user_type == 'teacher') {
            $courses = $user->taughtCourses; // Fetch taught courses for teachers
            $students = User::where('user_type', 'student')->get();
        } else {
            $courses = collect(); // Empty collection if no courses found
            $students = null;
        }

        // Fetch all courses (for both students and teachers)
        $allCourses = Course::all();
    
        return view('home', compact('courses', 'allCourses', 'user', 'students')); // Pass courses to the view
    }
}