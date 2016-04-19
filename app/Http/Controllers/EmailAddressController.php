<?php

namespace Mapil\Http\Controllers;

use Mapil\Http\Requests;
use Illuminate\Http\Request;
use \Auth;
use Mapil\Models\EmailAddress;

class EmailAddressController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('email_addresses')->with('email_addresses',Auth::user()->email_addresses);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        $email = new EmailAddress();
        $email->email = $request->input('email') . '@mail.mapil.co';
        $email->user_id = Auth::user()->id;
        $email->save();

        return response()->json(['new_token' => csrf_token(),'id' => $email->uuid,'email' => $email->email]);        
    }    
    public function delete(Request $request)
    {
        $email = EmailAddress::whereUuid($request->input('id'))->whereUserId(Auth::user()->id)->first();
        if($email) {
            $email->delete();
        }
        return response()->json(['new_token' => csrf_token()]);        
    }
}
