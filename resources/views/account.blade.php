@extends('layouts.default', ['nav_email_addresses' => 'active'])

@section('content')
<div class='account'>
    <h1>Limits</h1>
    <div class="stats">
        <ul>
            <li>{{$email_address_count}}/20<span>Email Addresses Used</span></li>
            <li>{{$message_count}}/10,000<span>Messages Used</span></li>
        </ul>
    </div>
    <h1>Change Password</h1>
    <form role="form" method="POST" action="/account">
        {!! csrf_field() !!}  
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
                Save
            </button>
        </p>
    </form>          

</div>




@endsection
