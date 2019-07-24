<?php
/*
 * @Description: 自定义服务提供者
 * @Author: your name
 * @Date: 2019-07-24 14:37:25
 * @LastEditTime: 2019-07-24 15:33:16
 */

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Components\Dag;

class DagServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // 绑定服务
        $this->app->singleton('dag',function($app){

            // 获取配置信息
            $dagParamm = $app['config']->get('params.dag');
                        
            extract($dagParamm);

            // 实例化对象
            return new Dag($url,$port);
        });        
    }
}
