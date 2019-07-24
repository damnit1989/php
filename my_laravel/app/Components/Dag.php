<?php
/*
 * @Description: 自定义组件
 * @Author: your name
 * @Date: 2019-07-24 14:54:11
 * @LastEditTime: 2019-07-24 15:30:08
 * @LastEditors: Please set LastEditors
 */

namespace App\Components;


class Dag
{

    protected $url;

    protected $port;

    public function __construct($url, $port)
    {
        $this->url = $url;
        $this->port = $port;
    }


    public function getUrl(){
        return $this->url;
    }

    public function getPort(){
        return $this->port;
    }
}
