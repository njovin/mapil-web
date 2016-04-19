<?php

namespace Mapil\Http\Controllers\Api;

use Mapil\Models\EmailAddress;
use Mapil\Http\Requests;
use Illuminate\Http\Request;
use MongoDB\Client;
use MongoDB\BSON\ObjectID;
use Auth;
use Mapil\Exceptions\SafeException;

class ApiEmailAddressController extends ApiController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $count = Auth::user()->user->email_addresses()->count();
        $emails = Auth::user()->user
            ->email_addresses()
            ->skip($this->offset)
            ->take($this->page_size)
            ->orderBy('email')
            ->get()
            ->lists('email');

        return $this->recordsetResponse($emails, $count);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($email_address)
    {
        try {
            $email = new EmailAddress();
            $email->email = $email_address;
            $email->user_id = Auth::user()->user_id;
            $email->save();            
        } catch(SafeException $e) {
            return $this->messageResponse($e->getMessage(),400);
        }

        return $this->messageResponse($email->email . " created");
    }    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($email_address)
    {
        $email = EmailAddress::whereEmail(strtolower($email_address))->whereuserId(Auth::user()->user_id)->first();
        if($email) {
            $email->delete();
            return $this->messageResponse(strtolower($email_address) . " deleted");
        } else {
            return $this->messageResponse(strtolower($email_address) . " not found",404);
        }
        try {
            $email = new EmailAddress();
            $email->email = $email_address;
            $email->user_id = Auth::user()->user_id;
            $email->save();            
        } catch(SafeException $e) {
            return $this->messageResponse($e->getMessage(),400);
        }

        return $this->messageResponse($email->email . " created");
    }        
  
}
