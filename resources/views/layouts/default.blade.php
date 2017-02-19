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
    
</head>
<body>
    @section('header')
        @if(Auth::user())
            @include('components.secure-header')
        @else 
            @include('components.insecure-header')
        @endif
    @show
    <div class='container'>
        @if($success = Session::get('success'))
            <div class='flash-success'>
                {{ $success }}
            </div>    
        @endif
        @yield('content')
    </div>
    <div class='footer'>
        <a href='/terms'>Terms</a> | <a href="mailto:nathan@mapil.co">Contact</a>
    </div>    
    <script src="{{ elixir('js/all.js') }}"></script>
    @include('components.mixpanel')
</body>
</html>
