<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/favicon.ico?v=2" />
    <title>mapil.co</title>

    <!-- Styles -->
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script> -->
    
</head>
<body>
        @if(Auth::user())
        <header class="navigation" role="banner">
          <div class="navigation-wrapper">
            <a href="javascript:void(0)" class="navigation-menu-button" id="js-mobile-menu">MENU</a>
            <a href='/'><img src='header-logo.png'></a>
            <nav role="navigation">
              <ul id="js-navigation-menu" class="navigation-menu show">
                <li class="nav-link"><a href="/email-addresses">Email Addresses</a></li>
                <li class="nav-link"><a href="/messages">Messages</a></li>
                <li class="nav-link"><a href="/account">Account</a></li>
                <li class="nav-link"><a href="/api-docs">API Docs</a></li>
                <li class="nav-link"><a href="/logout">Logout</a></li>
              </ul>
            </nav>
          </div>
        </header>
    @endif
    <div class='container'>
        @yield('content')
    </div>
<script src="{{ elixir('js/all.js') }}"></script>
</body>
</html>
