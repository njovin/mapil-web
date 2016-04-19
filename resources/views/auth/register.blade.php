@extends('layouts.default')

@section('content')
<div class="auth-form-container">
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
