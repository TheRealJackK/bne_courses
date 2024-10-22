<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="https://nceptior.sirv.com/bneparkmanagement/bcmp-logo-64x64.png">
    <link rel="stylesheet" href="/css/app.css">
    <title>BNE Courses | Login</title>
</head>
<body>
    <!--Header component-->
    @include('header')
    <main>
        <!--Login form-->
        <h2>Login</h2>
        <div>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <fieldset>
                    <legend>Login To Your Account:</legend>
                    <label>Email</label>
                    <input type="email" name="email" id="email" placeholder="myemail@example.com" required></input>

                    <label>Password</label>
                    <input type="password" name="password" id="password" required></input>

                    <input type="submit" id="submit" value="Login"></input>
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