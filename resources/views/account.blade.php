@extends('layouts.default', ['nav_account' => 'active'])

@section('content')
<div class='account'>
    <h1>Limits</h1>
    <div class="stats">
        <ul>
            <li>{{$email_address_count}}/20<span>Email Addresses Used</span></li>
            <li>{{$message_count}}/10,000<span>Messages Used</span></li>
        </ul>
    </div>

    <h1>API Credentials</h1>
    @foreach($api_credentials as $credentials)
    <p>
        <strong>Token:</strong> {{$credentials->token}}
        <strong>Secret:</strong>
        <span id='api-secret-group' class='api-secret-group'>
            <span class='api-secret'>
                {{$credentials->secret}}
            </span>
            <span class='toggle-show' onclick="toggleApiSecret()">
                Show
            </span>
            <span class='toggle-hide' onclick="toggleApiSecret()">
                Hide
            </span>                            
        </span>

    </p>
    @endforeach
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


<script>
    mixpanel.track('account_page_viewed');
</script>

@endsection
