<?php

namespace Mapil\Http\Controllers;

use Mapil\Http\Requests;
use Illuminate\Http\Request;
use \Auth;
use Mapil\Models\EmailAddress;
use Hash;

class AccountController extends Controller
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
        // TODO: get count of mongo documents
        $message_count = 0;
        // TODO: count emails
        $email_address_count = Auth::user()->email_addresses()->count();

        return view('account')->with('message_count',$message_count)->with('email_address_count',$email_address_count);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|min:6|confirmed',
        ]);       
        
        Auth::user()->password = Hash::make($request->input('password'));
        Auth::user()->save();

        $request->session()->flash('success', 'Password updated');

        return redirect('account');
    }    
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }
}
