<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Events\Event;
use App\User;
use App\model\visitor;

class VisitorController extends Controller
{

    public function __construct()
    {
    }


    public function index(){
        echo '<pre>';
        $visitorInfo = visitor::getVisitorById(2);
        
        return ([
            'code' => 200,
            'id' => $visitorInfo->id,
            'name' => $visitorInfo->visitor_name,
            'type' => $visitorInfo->visitor_type,
            'phone' => $visitorInfo->visitor_phone,
        ]);
    }

}
