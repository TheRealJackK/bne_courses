<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="https://nceptior.sirv.com/bneparkmanagement/bcmp-logo-64x64.png">
    <link rel="stylesheet" href="/css/app.css">
    <title>BNE Courses | Register</title>
</head>
<body>
    <!--Header component-->
    @include('header')
    <main>
        <h2>Register</h2>
        <div>
            <!--Registration form-->
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <fieldset>
                    <legend>Register An Account:</legend>
                    <label for="name">Full Name:</label>
                    <input type="text" name="name" id="name" placeholder="John Smith" required>

                    <label for="name">Account Type</label>
                    <select name="user_type" id="user_type" required>
                        <option value="student">Student</option>
                        <option value="teacher">Teacher</option>
                    </select>

                    <label>Email:</label>
                    <input type="email" name="email" id="username" placeholder="myemail@domain.com" required></input>

                    <label>Password:</label>
                    <input type="password" name="password" id="password" required></input>

                    <label for="password_confirmation">Confirm Password:</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required>

                    <input type="submit" id="submit" value="Register"></input>
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
        <div style="display: none;"></div>
        @endif
    </main>
    <!--Footer component-->
    @include('footer')
</body>
</html>