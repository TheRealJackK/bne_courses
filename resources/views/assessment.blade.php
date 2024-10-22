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
            <h2>Assessment: {{$assessment->title}}</h2>
        </div>
            <p>Instructions: {{$assessment->instruction}}</p>
        @if ($assessment->reviews->isNotEmpty())    
            <h3>Reviews</h3>
            <div class="card-group">
                <!--loop through reviews-->
                @foreach ($assessment->reviews as $review)
                    <div class="card">
                        <h3>Reviewer ID: {{ $review->reviewer_id }}</h3>
                        <h3>Reviewee ID: {{ $review->reviewee_id }}</h3>
                        <p>Review Text: {{ $review->review_text }}</p>
                        <p>Rating: {{ $review->rating }}</p>
                        <p>Score: {{ $review->score }} / 5</p>
                        <p>Date: {{ $review->created_at->format('d M Y') }}</p>
                    </div>
                @endforeach    
            </div>
        @else
            <p>No Peer Reviews Yet.</p>
        @endif
        <div>
            <!--Review form-->
            <form action="{{ route('reviews.submit') }}" method="POST">
                @csrf
                <fieldset>
                    <legend>Submit Peer Review:</legend>

                    <label for="reviewee">Select Reviewee:</label>
                    <select name="reviewee_id" id="reviewee" required>
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}">{{ $student->name }}</option>
                        @endforeach
                    </select>

                    <label for="review_text">Review Text:</label>
                    <textarea name="review_text" id="review_text" required></textarea>

                    <label for="rating">Rating:</label>
                    <select name="rating" id="rating">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>

                    <label for="score">Score:</label>
                    <input type="number" name="score" id="score" min="1" max="100" required>

                    <input type="hidden" name="assessment_id" value="{{ $assessment->id }}">
                    
                    <label>Submit Review:</label>
                    <input type="submit" id="submit" value="Submit Review">
                </fieldset>
            </form>
        </div>
        <!--Error div-->
        @if ($errors->any())
        <div>
            @foreach ($errors->all() as $error)
            <p>{{$error}}</p>
            @endforeach
        </div>
        @else 
        <div style="display: none;"></div>
        @endif
        <div>
            @include('logout')
        </div>
    </main>
    <!--Footer component-->
    @include('footer')
</body>
</html>