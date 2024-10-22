<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\auth\CustomRegisterController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\ReviewController;

// Note - a lot of these were made incase I used them, not all are in use and I lost track :/

Route::get('/', [HomeController::class, 'index'])->name('home');

// Login routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Register routes
Route::get('/register', [CustomRegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [CustomRegisterController::class, 'register']);

// Logout route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Teacher routes
Route::middleware('auth', 'teacher')->group(function () {
    Route::get('/teacher/courses', [TeacherController::class, 'index'])->name('teacher.courses');
    Route::get('/teacher/courses/create', [TeacherController::class, 'createCourse'])->name('teacher.courses.create');
    Route::post('/teacher/courses', [TeacherController::class, 'storeCourse'])->name('teacher.courses.store');
    Route::get('/teacher/courses/{course}/assessments', [TeacherController::class, 'showAssessments'])->name('teacher.courses.assessments');
    Route::get('/teacher/courses/{course}/assessments/create', [TeacherController::class, 'createAssessment'])->name('teacher.courses.assessments.create');
    Route::post('/teacher/courses/{course}/assessments', [TeacherController::class, 'storeAssessment'])->name('teacher.courses.assessments.store');
});

// Student routes
Route::middleware('auth', 'student')->group(function () {
    Route::get('/student/assessments', [StudentController::class, 'index'])->name('student.assessments');
    Route::get('/student/assessments/{assessment}/submit', [StudentController::class, 'submitPeerReview'])->name('student.assessments.submit');
    Route::post('/student/assessments/{assessment}', [StudentController::class, 'storePeerReview'])->name('student.assessments.store');
    Route::get('/student/assessments/{assessment}/reviews', [StudentController::class, 'viewReceivedReviews'])->name('student.assessments.reviews');
});

// Course routes
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');
// Route::post('/courses/{course}/enroll', [CourseController::class, 'enroll'])->name('courses.enroll');

// Assessment routes
Route::get('/assessments', [AssessmentController::class, 'index'])->name('assessments.index');
Route::get('/assessments/{assessment}', [AssessmentController::class, 'show'])->name('assessments.show');

// Create Assessment
Route::post('courses/{courseId}/assessments', [AssessmentController::class, 'store'])->name('assessments.store');

// Enrollment route
Route::post('/enroll-student', [EnrollmentController::class, 'enrollStudent'])->name('enrollStudent');
Route::post('/enroll/{courseId}', [EnrollmentController::class, 'enroll'])->name('enroll');
Route::post('/courses/{courseId}/enroll', [CourseController::class, 'enroll'])->name('enroll');
// Teacher Assign route
Route::post('/courses/assign-teacher', [CourseController::class, 'assignTeacher'])->name('assignTeacher');
// Withdraw route
Route::post('/courses/{courseId}/withdraw', [EnrollmentController::class, 'withdraw'])->name('withdraw');
// Review route
Route::post('/reviews/submit', [ReviewController::class, 'submit'])->name('reviews.submit');