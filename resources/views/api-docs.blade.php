@extends('layouts.default', ['nav_api_docs' => 'active'])

@section('content')
    <div class='api-docs'>
        <h1>mapil.co api</h1>
        <p>Below you'll find a list of REST API resources.  All requests should me made to https://mapil.co.</p>
        <p>Authenticate using HTTP basic authentication, with the API token as the username and API secret as the password.
        </p>
        @if(Auth::user())
            <p>If you're 
            not sure what your credentials are, check the <a href='/account'>Account page</a></p>
        @else 
            <p>If you dont' have an account yet, you'll need to <a href='/register'>sign up</a> before you can use the API</p>
        @endif
<h3>Error Example (HTTP status code 400)</h3>
<xmp>
{
    "message": "That email address is already in use"
}
</xmp>          

        <h2>/api/v1/email-addresses</h2>
        <div class='method-container'>
            <div class='badge-container'>
                <span class="badge-get">GET</span> 
            </div>            
            <div class='text-container'>
                List all email addresses on your account. 
<xmp>
{
    "offset": 0,
    "limit": 2,
    "total_records": 12,
    "results": [
        "me@mail.mapil.co",
        "you@mail.mapil.co"
    ]
}
</xmp>
            </div>
        </div>

        <h2>/api/v1/email-addresses/{address}</h2>
        <div class='method-container'>
            <div class='badge-container'>
                <span class="badge-post">POST</span> 
            </div>            
            <div class='text-container'>
                Create this email address. Addresses must be alphanumeric and end with the @mail.mapil.co domain
<xmp>
GET /api/v1/email-addresses/foo@mail.mapil.co

{
    "message": "foo@mail.mapil.co created"
}
</xmp>                
            </div>
        </div>
        <div class='method-container'>
            <div class='badge-container'>
                <span class="badge-delete">DELETE</span> 
            </div>            
            <div class='text-container'>
                Delete this email address
<xmp>
DELETE /api/v1/email-addresses/foo@mail.mapil.co
{
    "message": "foo@mail.mapil.co deleted"
}
</xmp>                  
            </div>
        </div>

        <h2>/api/v1/email-addresses/{address}/messages</h2>
        <div class='method-container'>
            <div class='badge-container'>
                <span class="badge-get">GET</span>
            </div>
            <div class='text-container'>
                List all messages sent to this address. You may specify offset and limit as GET variables
<xmp>
GET /api/v1/email-addresses/bar@mail.mapil.co/messages?offset=23&limit=1

{
  "offset": 23,
  "limit": 1,
  "count": 68,
  "results": [
        {
          "html": "<html><head></head><body>Hello<br>Foo</body>body></html>",
          "text": "Hello\nFoo",
          "headers": {
            "received": {
              "0": "by mail.foo.com with SMTP id gy3so90375699igb.0 for <bar@mail.mapil.co>; Mon, 18 Apr 2016 20:50:17 -0700 (PDT)",
              "1": "from 1058052472880 named unknown by mail.bar.com with HTTPREST; Mon, 18 Apr 2016 16:38:35 -0400"
            },
            "from": "John Doe <foo@gmail.com>",
            "x-mailer": "Mailcilient 1.0",
            "mime-version": "1.0",
            "date": "Mon, 18 Apr 2016 16:38:35 -0400",
            "message-id": "<CADi8pJCZ3=HHLjH+1oC_ZVz1C2BUFj2beGd-5VsQaSK_PEd=vQ@mail.gmail.com>",
            "subject": "QA Test Email Subject",
            "to": "bar@mail.mapil.co",
            "content-type": "multipart/alternative; boundary=001a11c1e7ea47a0140530c858c4"
          },
          "subject": "QA Test Email Subject",
          "messageId": "CADi8pJCZ3=HHLjH+1oC_ZVxoC2BUFj2beGd-5VsQaSK_PEd=vQ@mail.gmail.com",
          "priority": "normal",
          "from": {
            "0": {
              "address": "foo@gmail.com",
              "name": "John Doe"
            }
          },
          "to": {
            "0": {
              "address": "bar@mail.mapil.co",
              "name": "QA Test 1"
            }
          },
          "id": "5715aaf9cfd845e640625158"
        }
    ]
}
</xmp>                  
            </div>
        </div>

        <h2>/api/v1/email-addresses/{address}/messages/{message_id}</h2>
        <div class='method-container'>
            <div class='badge-container'>
                <span class="badge-get">GET</span>
            </div>
            <div class='text-container'>
                Get a single message by address and ID in JSON format
<xmp>
GET /api/v1/email-addresses/bar@mail.mapil.co/messages/5715aaf9cfd845e640625158

{
  "html": "<html><head></head><body>Hello<br>Foo</body>body></html>",
  "text": "Hello\nFoo",
  "headers": {
    "received": {
      "0": "by mail.foo.com with SMTP id gy3so90375699igb.0 for <bar@mail.mapil.co>; Mon, 18 Apr 2016 20:50:17 -0700 (PDT)",
      "1": "from 1058052472880 named unknown by mail.bar.com with HTTPREST; Mon, 18 Apr 2016 16:38:35 -0400"
    },
    "from": "John Doe <foo@gmail.com>",
    "x-mailer": "Mailcilient 1.0",
    "mime-version": "1.0",
    "date": "Mon, 18 Apr 2016 16:38:35 -0400",
    "message-id": "<CADi8pJCZ3=HHLjH+1oC_ZVz1C2BUFj2beGd-5VsQaSK_PEd=vQ@mail.gmail.com>",
    "subject": "QA Test Email Subject",
    "to": "bar@mail.mapil.co",
    "content-type": "multipart/alternative; boundary=001a11c1e7ea47a0140530c858c4"
  },
  "subject": "QA Test Email Subject",
  "messageId": "CADi8pJCZ3=HHLjH+1oC_ZVxoC2BUFj2beGd-5VsQaSK_PEd=vQ@mail.gmail.com",
  "priority": "normal",
  "from": {
    "0": {
      "address": "foo@gmail.com",
      "name": "John Doe"
    }
  },
  "to": {
    "0": {
      "address": "bar@mail.mapil.co",
      "name": "QA Test 1"
    }
  },
  "id": "5715aaf9cfd845e640625158"
}
</xmp>                    
            </div>
        </div>

        <h2>/api/v1/email-addresses/{address}/messages/{message_id}/html</h2>
        <div class='method-container'>
            <div class='badge-container'>
                <span class="badge-get">GET</span>
            </div>
            <div class='text-container'>
                The the HTML part of the message content for the specified message.  Delivered content-type will be text/html.  Should be suitable for browser rendering and visual inspection
            </div>
        </div>

        <h2>/api/v1/email-addresses/{address}/messages/{message_id}/text</h2>
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
