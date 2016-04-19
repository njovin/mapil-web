@extends('layouts.default')

@section('content')
<div class="auth-form-container">
    <form role="form" method="POST" action="{{ url('/login') }}">
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
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember"> Remember Me
                </label>
            </div>
        </p>

        <p>
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-btn fa-sign-in"></i>Login
            </button>
            <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
        </p>
    </form>
</div>
@endsection
