<?php

namespace Mapil\Http\Controllers;

use GuzzleHttp\Client;
use Mapil\Http\Requests;
use Illuminate\Http\Request;
use Mapil\Models\EmailAddress;
use MongoDB\BSON\ObjectID;
use Auth;

class InternalWebhookController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function receive(Request $request)
    {
        return response()->json([]);

        // All of this is disabled because I'm too lazy to upgrade PHP
        $address = EmailAddress::whereEmail($request->get('mapil_email'))->first();
        if ($address) {
            if ($address->user && $address->user->webhook_url) {
                $client = new Client([
                                         // You can set any number of default request options.
                                         'timeout'  => 2.0,
                                         'connect_timeout'  => 2.0,
                                     ]);
                $client->request('POST', $address->user->webhook_url, [
                    'json' => $request->all()
                ]);
            }
        }
        return response()->json([]);
    }
}
