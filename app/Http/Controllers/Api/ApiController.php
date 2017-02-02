<?php

namespace Mapil\Http\Controllers\Api;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class ApiController extends BaseController
{
    protected $offset;
    protected $page_size;

    public function __construct(Request $request) 
    {
        $this->offset = (int) $request->input('offset',0);
        $this->limit = (int) $request->input('limit',50);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function messageResponse($message, $code = 200)
    {
        $json = [
            'message' => $message
        ];
        return response()->json($json, $code);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function recordsetResponse($results, $count)
    {
        $json = [
            'offset' => $this->offset,
            'limit' => $this->limit,
            'count' => $count,
            'results' => $results
        ];

        return response()->json($json);
    }    
  
}
