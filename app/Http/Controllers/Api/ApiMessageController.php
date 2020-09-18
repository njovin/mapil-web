<?php

namespace Mapil\Http\Controllers\Api;

use DateTime;
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

        if ($request->get('before')) {
            $filter['received_at'] = ['$lt' => $this->dateToBson($request->get('before'))];
        }

        if ($request->get('after')) {
            if (!isset($filter['received_at'])) {
                $filter['received_at'] = [];
            }
            $filter['received_at']['$gt'] = $this->dateToBson($request->get('after'));
        }

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
        $collection = $client->selectDatabase('mapil')->selectCollection('emails');

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

    public function deleteMessage($email_address, $message_id) {
        $this->trackEvent("api_message_deleted");
        $client = new Client(env('MONGO_URL'));
        $collection = $client->selectDatabase('mapil')->selectCollection('emails');

        // catch BSON validation errors
        try {
            $collection->deleteOne( [ 'mapil_email' => $email_address,'user_id' => Auth::user()->user_id, '_id' => new ObjectID($message_id) ]);
            return $this->messageResponse("Message Deleted", 200);
        } catch(InvalidArgumentException $e) {
            return $this->messageResponse("Invalid message ID", 400);
        }
    }

    public function deleteMessages(Request $request, $email_address) {
        $this->trackEvent("api_message_deleted");
        $client = new Client(env('MONGO_URL'));
        $collection = $client->selectDatabase('mapil')->selectCollection('emails');
        $filter = [ 'mapil_email' => $email_address,'user_id' => Auth::user()->user_id ];

        if ($request->get('before')) {
            $filter['received_at'] = ['$lt' => $this->dateToBson($request->get('before'))];
        }

        if ($request->get('after')) {
            if (!isset($filter['received_at'])) {
                $filter['received_at'] = [];
            }
            $filter['received_at']['$gt'] = $this->dateToBson($request->get('after'));
        }

        // catch BSON validation errors
        try {
            $count = $collection->count($filter);
            $collection->deleteMany($filter);

            return $this->messageResponse($count . " messages deleted", 200);
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

    private function dateToBson($date)
    {
        $date = new DateTime($date);
        $date = $date->format('U') * 1000;
        return new \MongoDB\BSON\UTCDateTime($date);
    }

}
