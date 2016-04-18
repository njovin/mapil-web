<?php

namespace Mapil\Http\Controllers;

use Mapil\Http\Requests;
use Illuminate\Http\Request;
use MongoDB\Client;
use MongoDB\BSON\ObjectID;
use Auth;

class LogController extends Controller
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
    public function index(Request $request)
    {
        $page_size = 50;
        $page = $request->input('page',1);

        $client = new Client(env('MONGO_URL'));
        $collection = $client->mapil->emails;
        $count = $collection->count( [ 'user_id' => Auth::user()->id ]);

        $offset = ($page-1) * $page_size;
        $options = ['limit' => $page_size, 'skip' => $offset, 'sort' => ['received_at' => -1]];

        $emailCursor = $collection->find( [ 'user_id' => Auth::user()->id ], 
            $options
         );

        // this is incredibly dumb, but there's an issue with garbage collection and the mongodb collection - you need 
        // to unset the cursor or you'll get a 502
        $emails = $emailCursor;
        unset($emailCursor);
        return view('logs')
            ->with('emails',$emails)
            ->with('count',$count)
            ->with('page',$page)
            ->with('offset',$offset)
            ->with('page_size',$page_size);
    }
    private function getEmail($id) {
        $client = new Client(env('MONGO_URL'));
        $collection = $client->mapil->emails;
        
        // exclude these columns from the JSON response
        $options = ['projection' => [
            '_id' => 0,
            'user_id' => 0,
            'date' => 0,
            'receivedDate' => 0,
            'mapil_email' => 0,
            'received_at' => 0]];

        return $collection->findOne( [ '_id' => new ObjectID($id) ], $options);
    }
    public function viewHtml($id) 
    {
        $email = $this->getEmail($id);
        return response()->make(@$email->html, $status = 200, $headers = ['Content-Type: text/html']);
    }
    public function viewText($id) 
    {
        $email = $this->getEmail($id);
        return response()->make(@$email->text, $status = 200, $headers = ['Content-Type: text/plain']);
    }
    public function viewJson($id) {
        $email = $this->getEmail($id);

        return response()->make(@$email, $status = 200, $headers = ['Content-Type: application/json']);
    }
}
