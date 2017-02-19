<?php

namespace Mapil\Http\Controllers\Api;

use Mapil\Models\EmailAddress;
use Mapil\Http\Requests;
use Illuminate\Http\Request;
use MongoDB\Client;
use MongoDB\BSON\ObjectID;
use MongoDB\Model\BSONDocument;
use Auth;
use Mapil\Exceptions\SafeException;
use InvalidArgumentException;

class ApiMessageController extends ApiController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $email_address, $message_id = null)
    {
        $this->trackEvent("api_messages_listed");
        $filter = [
            'user_id' => Auth::user()->user_id,
            'mapil_email' => $email_address
            ];

        $client = new Client(env('MONGO_URL'));
        $collection = $client->mapil->emails;
        $count = $collection->count($filter);

        $options = [
            'limit' => $this->limit, 
            'skip' => $this->offset, 
            'sort' => ['received_at' => -1],
            'projection' => [
                        'user_id' => 0,
                        'date' => 0,
                        'receivedDate' => 0,
                        'mapil_email' => 0,
                        'received_at' => 0]
            ];

        $emailCursor = $collection->find($filter,$options);

        // this is incredibly dumb, but there's an issue with garbage collection and the mongodb collection - you need 
        // to unset the cursor or you'll get a 502
        $emails = [];
        foreach($emailCursor as $object) {
            $object_id = $object->_id->__toString();
            unset($object->_id);
            $object->id = $object_id;
            $emails[] = $object;
        }
        unset($emailCursor);
        
        return $this->recordsetResponse($emails, $count);
    }

    private function getMessage($email_address, $message_id) {
        $this->trackEvent("api_message_fetched");
        $client = new Client(env('MONGO_URL'));
        $collection = $client->mapil->emails;
        
        // exclude these columns from the JSON response
        $options = ['projection' => [
            'user_id' => 0,
            'date' => 0,
            'receivedDate' => 0,
            'mapil_email' => 0,
            'received_at' => 0]];

        // catch BSON validation errors
        try {
            $message = $collection->findOne( [ 'mapil_email' => $email_address,'user_id' => Auth::user()->user_id, '_id' => new ObjectID($message_id) ], $options);
            return $message;
        } catch(InvalidArgumentException $e) {
            return $this->messageResponse("Invalid message ID", 400);
        }
    }
    public function html($email_address, $message_id) 
    {
        $message = $this->getMessage($email_address, $message_id);
        if(get_class($message) != BSONDocument::class) {
            return $this->messageResponse("Message ID not found for the address " . $email_address, 404);
        }        
        return response()->make(@$message->html, $status = 200, $headers = ['Content-Type: text/html']);
    }
    public function text($email_address, $message_id) 
    {
        $message = $this->getMessage($email_address, $message_id);
        if(get_class($message) != BSONDocument::class) {
            return $this->messageResponse("Message ID not found for the address " . $email_address, 404);
        }         
        return response()->make(@$message->text, $status = 200, $headers = ['Content-Type: text/plain']);
    }
    public function json($email_address, $message_id) 
    {
        $message = $this->getMessage($email_address, $message_id);
        if(get_class($message) != BSONDocument::class) {
            return $this->messageResponse("Message ID not found for the address " . $email_address, 404);
        }         
        return response()->make(@$message, $status = 200, $headers = ['Content-Type: application/json']);
    }    
  
}
