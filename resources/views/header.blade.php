<header>
        <div>
            <img src="https://nceptior.sirv.com/bneparkmanagement/bcmp-logo-128x128.png" alt="logo">
            <h1>Brisbane City Courses</h1>
        </div>
        <nav>
            @auth
            <a href="/"><p>Home</p></a>
            @else
            <a href="/"><p>Home</p></a> 
            <a href="/login"><p>Login</p></a>
            <a href="/register"><p>Register</p></a>
            @endauth
        </nav>
        <div id="hamburger-container">
            <img id="hamburger-icon" src="https://nceptior.sirv.com/bneparkmanagement/hamburger.svg" alt="hamburger" />
            <ul id="hamburger-links">
                @auth
                <li><a href="/"><p>Home</p></a></li>
                @else
                <li><a href="/"><p>Home</p></a></li>
                <li><a href="/login"><p>Login</p></a></li>
                <li><a href="/register"><p>Login</p></a></li>
                @endauth
            </ul>
        </div>
</header>