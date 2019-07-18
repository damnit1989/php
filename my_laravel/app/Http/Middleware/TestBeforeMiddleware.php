<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;

class TestBeforeMiddleware
{

    public function handle($request,Closure $next){
        echo 'Request middleware';
        return $next($request);
    }
}
