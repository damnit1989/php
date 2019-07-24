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
        
        // $this->middleware('auth');
    }


    public function index(){
        $ret = json_encode([
            'code' => 200,
            'msg' => 'success',
        ]);

        return $ret;
    }


    public function info(){
      
        $userInfo = User::find(1);
        print_R([
            'code' => 200,
            'id' => $userInfo->id,
            'name' => $userInfo->name,
            'email' => $userInfo->email,
        ]);
    }


    /**
     * laravel触发事件执行监听器
     */
    public function event(){
        echo '<pre>';  
        $ret = event(new Event('ding',$this,['id' => 1,'email' => '44855829']));
        print_r($ret);
    }


    /**
     * Laravel的Facades使用方式(eg `db`)
     */
    public function  face(){
        $conns = \DB::getConnections();
        print_R($conns);

        $userInfo = User::find(1);
        echo '<pre>';        
        $conns = \DB::supportedDrivers();
        print_R($conns);
        // $conns = \DB::getConnections();
        // print_R($conns);  
    }
    

    /**
     * 解析自定义服务
     */
    public function getComponent(){
        $dagComponent = app()->make('dag');
        $dagComponent = app('dag');
        print_R($dagComponent);
    }

}
