<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Events\Event;
use App\User;

class TestController extends Controller
{

    public function __construct()
    {
        // 自定义两个中间件
        // $this->middleware('App\Http\Middleware\TestBeforeMiddleware');
        // $this->middleware('App\Http\Middleware\TestAfterMiddleware'); 

        // $this->middleware('test.before');
        // $this->middleware('test.after');
        
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


    /**
     * 解析markdown文件
     */
    public function mk(){

        // 文件地址
        // $fileName = base_path('resources/mkdown/event.md');
        $fileName = resource_path('mkdown/event.md');

        // 读取markdown文件
        $content = file_get_contents($fileName);

        // 解析
        $Parsedown = new \Parsedown();
        // echo $Parsedown->text($content); # prints: <p>Hello <em>Parsedown</em>!</p>

        // 输出
        return view('home/mkdown',['content' => $Parsedown->text($content)]);
    }


    public function redis(){
        $redis = app()->make('redis');
        echo '<pre>';
        $age = $redis->get('age');
        $laravel = $redis->get('laravel');
        // $redis->set('laravel','laravel');
        var_dump($age,$laravel);
        // print_R($redis);die;
    }

}
