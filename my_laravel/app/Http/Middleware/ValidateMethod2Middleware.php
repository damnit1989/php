<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;

class ValidateMethod2Middleware
{

    public function handle($request,Closure $next){
        $method = $request->getMethod();
        echo 'this middle is  validateMetdthod2';
        // die($method);
        // if($request->ajax()){
            return $next($request);
        // }
        // throw new \Exception('the request 2 is not ajax');

    }
}
