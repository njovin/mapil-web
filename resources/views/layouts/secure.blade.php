<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>mapil.co</title>

    <!-- Styles -->
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script> -->
    
</head>
<body>
    <header class="navigation" role="banner">
      <div class="navigation-wrapper">
        <a href="javascript:void(0)" class="navigation-menu-button" id="js-mobile-menu">MENU</a>
        <img src='header-logo.png'>
        <nav role="navigation">
          <ul id="js-navigation-menu" class="navigation-menu show">
            <li class="nav-link"><a href="/logs">Logs</a></li>
            <li class="nav-link"><a href="/addresses">Email Addresses</a></li>
            <li class="nav-link"><a href="/account">Account</a></li>
            <li class="nav-link"><a href="/api_docs">API Docs</a></li>
            <li class="nav-link"><a href="/logout">Logout</a></li>
          </ul>
        </nav>
      </div>
    </header>
    <div class='container'>
        @yield('content')
    </div>
<script src="{{ elixir('js/all.js') }}"></script>
<script>


    $(document).ready(function() {
        // nav
        var menuToggle = $("#js-mobile-menu").unbind();
        $("#js-navigation-menu").removeClass("show");
        console.log(menuToggle);
        menuToggle.on("click", function(e) {
        console.log('foo1');
        e.preventDefault();
        console.log('foo2');
        $("#js-navigation-menu").slideToggle(function(){
        console.log('foo3');
        if($("#js-navigation-menu").is(":hidden")) {
        $("#js-navigation-menu").removeAttr("style");
        }
        });
        });

        // modals
        $("#modal-1").on("change", function() {
            // if ($(this).is(":checked")) {
                $("body").addClass("modal-open");
            // } else {
                // $("body").removeClass("modal-open");
            // }
        });
                $("body").addClass("modal-open");

        // $(".modal-fade-screen, .modal-close").on("click", function() {
        //     $(".modal-state:checked").prop("checked", false).change();
        // });

        // $(".modal-inner").on("click", function(e) {
        //     e.stopPropagation();
        // });        
    }); 




    </script>    
</body>
</html>
