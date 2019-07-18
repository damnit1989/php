<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;

class TestAfterMiddleware
{

    public function handle($request,Closure $next){

        // return $next($request);
        $response = $next($request);
        print_R($response->getContent());
        echo 'Response middleware';
        $response->setStatusCode(500);

        return $response;        
    }
}
