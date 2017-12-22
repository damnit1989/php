<?php

/********************配置文件*******************/

$_C = array();


//市区配置
$_C['APP_TIMEZONE'] = 'US/Pacific';


//数据库配置
$_C['DB_HOST'] = 'localhost';
$_C['DB_NAME'] = 'lmm';
$_C['DB_USER'] = 'root';
$_C['DB_PASS'] = '123456';


//调试配置
$_C['DEBUG'] = False;



foreach($_C as $key => $value){
	define($key,$value);
}




