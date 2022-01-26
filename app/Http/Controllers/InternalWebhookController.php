<?php

namespace Mapil\Http\Controllers;

use Mapil\Http\Requests;
use Illuminate\Http\Request;
use MongoDB\Client;
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
        \Log::info($request->all());
        return response()->json([]);
    }
}
