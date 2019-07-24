<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;

class ChangeheaderMiddleware
{

    public function handle($request,Closure $next){
        $response = $next($request);
        $response->setContent('change the content');
        return $response;
    }
}
