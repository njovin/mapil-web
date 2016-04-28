@extends('layouts.default')

<!-- Main Content -->
@section('content')

<div class="auth-form-container">
    <form role="form" method="POST" action="{{ url('/password/email') }}">
        {!! csrf_field() !!}

        @if (@$status)
            <div class='flash-success'>
                {{ $status }}
            </div>
        @endif        

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
            <button type="submit" class="btn btn-primary">
                Send Password Reset Link
            </button>
        </p>
    </form>
</div>
@endsection
