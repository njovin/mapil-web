<?php

namespace Mapil\Http\Controllers;

use Mapil\Models\EmailAddress;
use Mapil\Http\Requests;
use Illuminate\Http\Request;
use MongoDB\Client;
use MongoDB\BSON\ObjectID;
use Auth;

class ApiAddressController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $emails = Auth::user()->user->email_addresses()->get()->lists('email');

        return response()->json($emails);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($email)
    {
        $email = new EmailAddress();
        $email->email = $email;
        $email->user_id = Auth::user()->user_id;
        $email->save();

        return $this->index();
    }    
  
}
