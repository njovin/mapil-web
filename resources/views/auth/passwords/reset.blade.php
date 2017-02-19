@extends('layouts.default', ['nav_login' => 'active'])

@section('content')
<div class="auth-form-container">
    <form role="form" method="POST" action="{{ url('/password/reset') }}">
        {!! csrf_field() !!}

        <input type="hidden" name="token" value="{{ $token }}">

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
            <label>New Password</label>
            <input type="password" name="password">
            @if ($errors->has('password'))
                <div class='flash-error'>
                    {{ $errors->first('password') }}
                </div>
            @endif
        </p>

                <p>
                    <label>Confirm New Password</label>
                    <input type="password" name="password_confirmation">
                    </p>

        <p>
            <button type="submit" class="btn btn-primary">
                Reset Password
            </button>
        </p>

    </form>
</div>
@endsection
