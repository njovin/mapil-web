<?php

namespace Mapil\Http\Controllers;

use Mapil\Http\Requests;
use Illuminate\Http\Request;
use MongoDB\Client;
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
        $options = ['limit' => $page_size, 'skip' => $offset];

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
}
