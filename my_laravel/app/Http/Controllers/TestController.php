<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
// use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Users\Repository as UserRepository;
use Illuminate\Container\Container;
use App\Events\Event;
use App\User;

class TestController extends Controller
{

    public function __construct()
    {
        // 自定义两个中间件
        // $this->middleware('App\Http\Middleware\TestBeforeMiddleware');
        // $this->middleware('App\Http\Middleware\TestAfterMiddleware');        
        $this->middleware('test.before');
        $this->middleware('test.after');
        $this->middleware('auth');
    }

    public function index(){
        $ret = json_encode([
            'code' => 200,
            'msg' => 'success',
        ]);

        return $ret;
    }

    public function info(){

        echo '<pre>';
        $userInfo = User::find(1);
        print_R([
            'code' => 200,
            'id' => $userInfo->id,
            'name' => $userInfo->name,
            'email' => $userInfo->email,
        ]);
    }

    public function event(){

        echo '<pre>';  

        $ret = event(new Event('ding',$this,['id' => 1,'email' => '44855829']));

        print_r($ret);
    }

    

}
