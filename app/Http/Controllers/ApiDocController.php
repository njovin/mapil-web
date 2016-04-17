<?php

namespace Mapil\Http\Controllers;

use Mapil\Http\Requests;
use Illuminate\Http\Request;

class ApiDocController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('api-docs');
    }
}
