@extends('layouts.auth')

@section('content')
<form class="auth-form" role="form" method="POST" action="{{ url('/register') }}">
    {!! csrf_field() !!}
<!--     if errors
        each error in errors
            div.error= error -->
    <label>E-Mail Address</label>
    <input type="email" name="email" value="{{ old('email') }}">
    <label>Password</label>
    <input type="password" name="password">
    <label>Confirm Password</label>
    <input type="password" name="password_confirmation">        
    <div class='text-center'>
        <button type="submit">
            Register
        </button>
    </div>
</form>
@endsection
