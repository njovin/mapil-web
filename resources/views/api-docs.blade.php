@extends('layouts.secure')

@section('content')
    <div class='api-docs'>
        <h1>API Docs</h1>
        <p>These are arranged in some logical order</p>

        <h2>/v1/addresses</h2>
        <div class='method-container'>
            <div class='badge-container'>
                <span class="badge-get">GET</span> 
            </div>            
            <div class='text-container'>
                List all email addresses on your accountaklsndaskl dlkasj dlk asjdlk asdkl askl dklas dklajs d asdj klasdj klas djlk asdkl asjd aklsdkjaslkd 
            </div>
        </div>

        <h2>/v1/addresses/{address}</h2>
        <div class='method-container'>
            <div class='badge-container'>
                <span class="badge-post">POST</span> 
            </div>            
            <div class='text-container'>
                Create this email address. Addresses must be alphanumeric and end with the @email.mapil.co domain
            </div>
        </div>
        <div class='method-container'>
            <div class='badge-container'>
                <span class="badge-delete">DELETE</span> 
            </div>            
            <div class='text-container'>
                Delete this email address
            </div>
        </div>

        <h2>/v1/addresses/{address}</h2>
        <div class='method-container'>
            <div class='badge-container'>
                <span class="badge-post">POST</span>
            </div>
            <div class='text-container'>
                Create this email address. Addresses must be alphanumeric and end with the @email.mapil.co domain
            </div>
        </div>
        <div class='method-container'>
            <div class='badge-container'>
                <span class="badge-delete">DELETE</span>
            </div>
            <div class='text-container'>
                Delete this email address
            </div>
        </div>

        <h2>/v1/addresses/{address}/messages</h2>
        <div class='method-container'>
            <div class='badge-container'>
                <span class="badge-get">GET</span>
            </div>
            <div class='text-container'>
                List all messages sent to this address
            </div>
        </div>

        <h2>/v1/addresses/{address}/messages{message_id}</h2>
        <div class='method-container'>
            <div class='badge-container'>
                <span class="badge-get">GET</span>
            </div>
            <div class='text-container'>
                <div>Get a single message by address and ID</div>        
            </div>
        </div>

        <h2>/v1/addresses/{address}/messages{message_id}/html</h2>
        <div class='method-container'>
            <div class='badge-container'>
                <span class="badge-get">GET</span>
            </div>
            <div class='text-container'>
                The the HTML part of the message content for the specified message.  Delivered content-type will be text/html.  Should be suitable for browser rendering and visual inspection
            </div>
        </div>

        <h2>/v1/addresses/{address}/messages{message_id}/text</h2>
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
