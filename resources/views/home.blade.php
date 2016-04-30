@extends('layouts.default')
@section('content')
    <a href="https://github.com/njovin/mapil-web" class='github-ribbon'><img style="position: absolute; top: 0; right: 0; border: 0;z-index: 999" src="https://camo.githubusercontent.com/38ef81f8aca64bb9a64448d0d70f1308ef5341ab/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f6461726b626c75655f3132313632312e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_right_darkblue_121621.png"></a>
    <div class='home'>
        <h1>Welcome to Mapil</h1>
        Mapil is an email testing service for developers and QA teams.  You send us an email, we'll store it and let you query it using our API. 
        <div class='text-center'>
            <a href='/register' class='button green'>Sign Up (it's free)</a>
        </div>
        <h2>How's it work?</h2>
        <h3 class='top'>Create an email address</h3>
        Create a mail.mapil.co email address (either using our API or the site)
        <pre>
> curl -XPOST -u YOURTOKEN:YOURSECRET https://mapil.co/api/v1/email-addresses/johnsmith@mail.mapil.co

{ "message": "johnsmith@mail.mapil.co created"}</pre>

        <h3>Send an email</h3>
        Send an email from any client to your Mapil email address.

        <h3>Check the content</h3>
        Using our API, you can query the entire email data structure including all headers, attachment names and sizes, HTML content, text content, etc.
        <pre>
> curl -XGET -u YOURTOKEN:YOURSECRET https://mapil.co/api/v1/email-addresses/johnsmith@mail.mapil.co/messages
    

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
            <li>Secure - only you have access to your messages</li>
            <li>Simple, powerful API</li>
            <li>Built with automated testing in mind</li>
            <li>Programatically provision and release email addresses on-the-fly</li>
            <li>Query rendered HTML, plain text, or schematic content via the API</li>
        </ul>

        <h3>Why did you build this?</h3>
        Almost all web systems send emails, whether it be automated reports, transactional emails, or promotional messages. Often times these messages need to be functionally tested as part of the QA process.  We found that it was prohibitively difficult to check the contents of an email, so we built Mapil.

    </div>
@endsection
