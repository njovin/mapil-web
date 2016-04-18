@extends('layouts.secure')

@section('content')
    <div class='api-docs'>
        <h1>API</h1>
        <p>Below you'll find a list of REST API resources.  All requests should me made to https://mapil.co.</p>
        <p>Authenticate using HTTP basic authentication, with the API token as the username and API secret as the password.  If you're 
        not sure what your credentials are, check the <a href='/account'>Account page</a></p>
<h3>Error Example (HTTP status code 400)</h3>
<pre>
{
    "message": "That email address is already in use"
}
</pre>          

        <h2>/api/v1/email-addresses</h2>
        <div class='method-container'>
            <div class='badge-container'>
                <span class="badge-get">GET</span> 
            </div>            
            <div class='text-container'>
                List all email addresses on your account. 
<h3>Sample Response</h3>
<pre>
{
    "page": 1,
    "count": 12,
    "page_size": 2,
    "results": [
        "me@mail.mapil.co",
        "you@mail.mapil.co"
    ]
}
</pre>
            </div>
        </div>

        <h2>/api/v1/email-addresses/{address}</h2>
        <div class='method-container'>
            <div class='badge-container'>
                <span class="badge-post">POST</span> 
            </div>            
            <div class='text-container'>
                Create this email address. Addresses must be alphanumeric and end with the @mail.mapil.co domain
<h3>Sample Response</h3>
<pre>
{
    "message": "Address created"
}
</pre>                
            </div>
        </div>
        <div class='method-container'>
            <div class='badge-container'>
                <span class="badge-delete">DELETE</span> 
            </div>            
            <div class='text-container'>
                Delete this email address
<h3>Sample Response</h3>
<pre>
{
    "message": "Address deleted"
}
</pre>                  
            </div>
        </div>

        <h2>/api/v1/email-addresses/{address}/messages</h2>
        <div class='method-container'>
            <div class='badge-container'>
                <span class="badge-get">GET</span>
            </div>
            <div class='text-container'>
                List all messages sent to this address
<h3>Sample Response</h3>
<pre>
{
    "message": "Address deleted"
}
</pre>                  
            </div>
        </div>

        <h2>/api/v1/email-addresses/{address}/messages{message_id}</h2>
        <div class='method-container'>
            <div class='badge-container'>
                <span class="badge-get">GET</span>
            </div>
            <div class='text-container'>
                Get a single message by address and ID
<h3>Sample Response</h3>
<pre>
{
    "message": "Address deleted"
}
</pre>                    
            </div>
        </div>

        <h2>/api/v1/email-addresses/{address}/messages{message_id}/html</h2>
        <div class='method-container'>
            <div class='badge-container'>
                <span class="badge-get">GET</span>
            </div>
            <div class='text-container'>
                The the HTML part of the message content for the specified message.  Delivered content-type will be text/html.  Should be suitable for browser rendering and visual inspection
            </div>
        </div>

        <h2>/api/v1/email-addresses/{address}/messages{message_id}/text</h2>
        <div class='method-container'>
            <div class='badge-container'>
                <span class="badge-get">GET</span>
            </div>
            <div class='text-container'>
                The the plain text part of the message content for the specified message.  Delivered content-type will be text/plain.  Should be suitable for easily validating message content.
            </div>
        </div>

    </div>
<script>
 

</script> 

@endsection
