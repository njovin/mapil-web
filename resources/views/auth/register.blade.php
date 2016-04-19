@extends('layouts.default', ['nav_signup' => 'active'])

@section('content')
<div class="auth-form-container">
    <div class="flex-boxes" id='intro'>
        <div class="flex-box">
            <h1 class="flex-title">Welcome to Mapil. Signup is free.</h1>
            <p>
                You'll be able to create 20 email addresses and receive 10,000 messages per month.
            </p>
        </div>
    </div>
    <form role="form" method="POST" action="{{ url('/register') }}">
        {!! csrf_field() !!}
        <p>
            <label>E-Mail Address</label>
            <input type="email" name="email" value="{{ old('email') }}">
            @if ($errors->has('email'))
                <div class='flash-error'>
                    {{ $errors->first('email') }}
                </div>
            @endif
        </p>
        <p>
            <label>Password</label>
            <input type="password" name="password">
            @if ($errors->has('password'))
                <div class='flash-error'>
                    {{ $errors->first('password') }}
                </div>
            @endif        
        </p>
        <p>
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation">        
        </p>
        <p>
            <button type="submit">
                Register
            </button>
        </p>
    </form>
</div>
@endsection
