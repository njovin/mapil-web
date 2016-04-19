    <header class="centered-navigation" role="banner">
        <div class="centered-navigation-wrapper">
            <a href="javascript:void(0)" class="mobile-logo">
                <img src="/header-logo.png" alt="mapil.co">
            </a>
            <a href="javascript:void(0)" id="js-centered-navigation-mobile-menu" class="centered-navigation-mobile-menu">MENU</a>
            <nav role="navigation">
                <ul id="js-centered-navigation-menu" class="centered-navigation-menu show">
                    <li class="nav-link"><a href="/">Home</a></li>
                    <li class="nav-link {{@$nav_signup}}"><a href="/register">Sign Up</a></li>
                    <li class="nav-link logo">
                        <a href="/" class="logo">
                            <img src="/header-logo.png" alt="mapil.co">
                        </a>
                    </li>
                    @if(Auth::user())
                        <li class="nav-link"><a href="/email-addresses">My Account</a></li>
                    @else 
                        <li class="nav-link {{@$nav_login}}">
                            <a href="/login">Log In</a>
                            </li>
                    @endif
                    <li class="nav-link {{@$nav_api_docs}}">
                        <a href="/api-docs">API Docs</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>