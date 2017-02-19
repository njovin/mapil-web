<?php

namespace Mapil\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Auth;
use Mixpanel;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    public function trackEvent($eventName) {
        $mp = Mixpanel::getInstance(env("MIXPANEL_TOKEN"));
        $mp->people->set(Auth::user()->id, array(
            '$email'            => Auth::user()->email
        ));
        $mp->track($eventName);
    }
}
