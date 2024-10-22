<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="https://nceptior.sirv.com/bneparkmanagement/bcmp-logo-64x64.png">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>BNE Courses | {{ $course->name }}</title>
</head>
<body>
    <!--Header component-->
    @include('header')
    <main>
        <!--Detailed course page-->
        <div>
            <h2>Course: {{ $course->name }} - Code: {{ $course->course_code }}</h2>
        </div>
        @if ($course->teacher_id != NULL)
            <p>Course Taught By: {{ $course->teacher->name }}</p>
        @else 
            <p>No Teacher Yet</p>
        @endif
        <h3>Assessments</h3>
        <div class="card-group">
            <!--Loop through assessments-->
            @foreach ($course->assessments as $assessment)
                <div class="card">
                    <h3>{{ $assessment->title }}</h3>
                    <p>{{ $assessment->instruction }}</p>
                    <p>Due Date: {{ $assessment->due_date }}</p>
                    <a href="{{ route('assessments.show', ['assessment' => $assessment->id]) }}"><p>See Peer Reviews</p></a>
                </div>
            @endforeach    
        </div>
        <!--Only show if teacher-->
        @if (Auth::check() && Auth::user()->user_type == 'teacher')
        <div>
            <!--Create assessment form-->
            <form action="{{ route('assessments.store', ['courseId' => $course->id]) }}" method="POST">
                @csrf
                <fieldset>
                    <legend>Create Assessment: </legend>

                    <label for="title">Assessment Title:</label>
                    <input type="text" name="title" id="title" maxlength="20" required>

                    <label for="instruction">Instruction:</label>
                    <textarea name="instruction" id="instruction" required></textarea>

                    <label for="num_reviews_required">Number of Reviews Required:</label>
                    <input type="number" name="num_reviews_required" id="num_reviews_required" min="1" required>

                    <label for="max_score">Max Score:</label>
                    <input type="number" name="max_score" id="max_score" min="1" max="100" required>

                    <label for="due_date">Due Date:</label>
                    <input type="datetime-local" name="due_date" id="due_date" required>

                    <label for="type">Type of Peer Review:</label>
                    <select name="type" id="type" required>
                        <option value="student-select">Student Select</option>
                        <option value="teacher-assign">Teacher Assign</option>
                    </select>

                    <!-- Hidden input for course_id -->
                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                    
                    <input type="submit" id="submit" value="Create Assessment">
                </fieldset>
            </form>
        </div>
        <!--Error display-->
        @if ($errors->any())
        <div>
            @foreach ($errors->all() as $error)
            <p>{{$error}}</p>
            @endforeach
        </div>
        @else
        @endif
        <div style="display: none;"></div> 
        @else 
        <div style="display: none;"></div>
        @endif
        <div>
            <!--Only show if user is student-->
            @if (Auth::check() && Auth::user()->user_type == 'student')
                <!-- Check if the student is already enrolled -->
                @if (!Auth::user()->enrolledCourses->contains($course))
                    <form action="{{ route('enroll', ['courseId' => $course->id]) }}" method="POST">
                        @csrf
                        <fieldset>
                            <legend>Enroll In Course:</legend>
                            <input type="submit" id="submit" value="Enroll">
                        </fieldset>
                    </form>
                @else
                    <!--Withdraw form-->
                    <form action="{{ route('withdraw', ['courseId' => $course->id]) }}" method="POST">
                        @csrf
                        <fieldset>
                            <legend>Withdraw From Course:</legend>
                            <input type="submit" id="submit" value="Withdraw">
                        </fieldset>
                    </form>
                @endif
            @else
                <p>Only students can enroll in courses.</p>
            @endif
        </div>
        <div>
            @include('logout')
        </div>
    </main>
    <!--Footer component-->
    @include('footer')
</body>
</html>