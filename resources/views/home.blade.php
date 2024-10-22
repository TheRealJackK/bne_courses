<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="https://nceptior.sirv.com/bneparkmanagement/bcmp-logo-64x64.png">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- For star icons -->
    <title>BNE Courses | Home</title>
</head>
<body>
    <!--Header component-->
    @include('header')
    <main>
        <div>
            @if ($user) <!-- Check if user is set -->
            <!--Display name-->
                <h2>Welcome: {{ $user->name }} | <!--Display if student or teacher-->{{$user->user_type}}</h2>
            @else
                <h2>Welcome</h2>
            @endif
        </div>
        <h3>My Courses</h3>
        <div class="card-group">
            <!--If no enrolled courses-->
            @if ($courses->isEmpty())
                @if ($user->user_type == 'student')
                <p style="margin: 2em; font-size: xx-large;">No Enrolled Courses.</p>
                @else
                <p style="margin: 2em; font-size: xx-large;">No Taught Courses.</p>
                @endif
            @else
            <!--Loop through courses-->
                @foreach ($courses as $course)
                    <div class="card">
                        <h3>{{ $course->name }}</h3>
                        <p>Course Code: {{ $course->course_code }}</p>
                        <a href="{{ route('courses.show', ['course' => $course->id]) }}"><p>See Your Course</p></a>
                    </div>
                @endforeach
            @endif
        </div>
        <!--Show all courses if user is student-->
        @if ($user->user_type == 'student')
        <h3>Avaliable Courses</h3>    
        <div class="card-group">
            @foreach ($allCourses as $course)
                <div class="card">
                    <h3>{{ $course->name }}</h3>
                    <p>Course Code: {{ $course->course_code }}</p>
                    <a href="{{ route('courses.show', ['course' => $course->id]) }}"><p>Learn More!</p></a>
                </div>
            @endforeach    
        </div>
        <!--Teacher only stuff-->
        @elseif ($user->user_type == 'teacher')
        <div>
            <form action="{{ route('assignTeacher') }}" method="POST">
                @csrf
                <fieldset>
                    <legend>Assign Course To Me:</legend>

                    <label for="course">Select Course:</label>
                    <select name="course_id" id="course" required>
                        @foreach ($allCourses as $course)
                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                        @endforeach
                    </select>

                    <input type="submit" id="submit" value="Assign">
                </fieldset>
            </form>
        </div>
        <div>
            <form action="{{ route('enrollStudent') }}" method="POST">
                @csrf
                <fieldset>
                    <legend>Enroll A Student:</legend>

                    <label for="student">Select Student:</label>
                    <select name="student_id" id="student" required>
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}">{{ $student->name }}</option>
                        @endforeach
                    </select>

                    <label for="course">Select Course:</label>
                    <select name="course_id" id="course" required>
                        @foreach ($allCourses as $course)
                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                        @endforeach
                    </select>

                    <input type="submit" id="submit" value="Enroll">
                </fieldset>
            </form>
        </div>
        @endif
        <div>
            @include('logout')
        </div>
    </main>
    <!--Footer component-->
    @include('footer')
</body>
</html>