<?php
/*
 * @Description: 响应宏定义
 * @Author: lmm
 * @Date: 2019-07-30 13:57:46
 * @LastEditTime: 2019-07-30 14:42:57
 */

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 对异常统一处理
        Response::macro('caps',function($e){
            $value = [
                'msg' => $e->getMessage(),
                'code' => $e->getCode(),
            ];
            return Response::make($value);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
