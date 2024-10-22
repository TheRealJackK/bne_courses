<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="https://nceptior.sirv.com/bneparkmanagement/bcmp-logo-64x64.png">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- For star icons -->
    <title>BNE Courses | {{ $assessment->title }}</title>
</head>
<body>
    <!--Header component-->
    @include('header')
    <main>
        <div>
            <h2>{{$assessment->title}}</h2>
        </div>
        <div class="card-group">
        @foreach ($assessment->reviews as $review)
            <div class="card">
                <h3>Reviewer: {{ $review->reviewer->name }}</h3>
                <p>Review: {{ $review->review_text }}</p>
                <p>Rating: {{ $review->rating }}</p>
            </div>
        @endforeach
        </div>
        <div>
            @include('logout')
        </div>
    </main>
    <!--Footer component-->
    @include('footer')
</body>
</html>