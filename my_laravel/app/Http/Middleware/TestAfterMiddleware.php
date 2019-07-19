<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;

class TestAfterMiddleware
{

    public function handle($request,Closure $next){

        $response = $next($request);
        echo 'Response middleware';
        $response->setStatusCode(500);

        return $response;        
    }
}
