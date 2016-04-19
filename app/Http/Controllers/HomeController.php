<?php

namespace Mapil\Http\Controllers;

use Mapil\Http\Requests;
use Illuminate\Http\Request;
use MongoDB\Client;
use MongoDB\BSON\ObjectID;
use Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return 'ok';
    }
    public function terms() 
    {
        return view('terms');
    }
}
