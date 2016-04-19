@extends('layouts.default')
@section('content')
    <div class='home'>
        <h1>Welcome to Mapil</h1>
        Mapil is an email testing service for developers and QA teams.  You send us an email, we'll store it and let you query it via API. 
        <div class='text-center'>
            <a href='/register' class='button green'>Sign Up (it's free)</a>
        </div>
        <h2>How's it work?</h2>
        <h3 class='top'>Create an email address</h3>
        Create an mail.mapil.co email address (either using our API or the site)
        <pre>
> curl -XPOST https://mapil.co/api/v1/email-addresses/johnsmith@mail.mapil.co

{ "message": "johnsmith@mail.mapil.co created"}</pre>
        <h3>Send an email</h3>
        Send an email from any client to your Mapil email address.
        <h3>Check the content</h3>
        Using our API, you can query the entire email data structure including all headers, attachment names and sizes, HTML content, text content, etc.
        <pre>
> curl -XGET https://mapil.co/api/v1/email-addresses/johnsmith@mail.mapil.co/messages
    

{
  "results": [
        {
            "id": "5715aaf9cfd845e640625158",
            "html": "...",
            "text": "Hello\nFoo",
            "headers": {
                ...
            },
            "subject": "QA Test Email Subject",
            "priority": "normal",
            "from": {
                "0": {
                  "address": "qajohn@example.com",
                  "name": "John Doe"
                }
            },
            "to": {
                "0": {
                  "address": "bar@mail.mapil.co",
                  "name": ""
                }
            }
            "attachments": {
                "0": {
                    "contentType": "image/png",
                    "transferEncoding": "base64",
                    "fileName": "foo.png",
                    "checksum": "8e706b402ce0e8ee010c59f3187b8f38",
                    "length": 169116
                }
            }            
        }
    ]
}          </pre>
        <h3>How is this better than Mailinator, etc.?</h3>
        <ul>
            <li>Simple, powerful API</li>
            <li>Built with automated testing in mind</li>
            <li>Programatically provision and release email addresses on-the-fly</li>
            <li>Query rendered HTML, plain text, or schematic content via the API</li>
        </ul>
        <h3>Why did you build this?</h3>
        Almost all web systems send emails, whether it be automated reports, transactional emails, or promotional messages. Often times these messages need to be functionally tested as part of the QA process.  We found that it was prohibitively difficult to check the contents of an email, so we built Mapil.

    </div>
@endsection
