<?php 

//加载公共函数
require_once './common/common.php';


//定义常量
define('APP_PATH',dirname(__FILE__));
define('APP_FOLDER',dirname($_SERVER['SCRIPT_NAME']));
define('APP_URL',remove_unwanted_slashes('http://'.$_SERVER['SERVER_NAME'].APP_FOLDER.'/'));
define('SYS_PATH',APP_PATH.'/system');
define('FORM_ACTION',remove_unwanted_slashes(APP_FOLDER.'process.php'));
define('STATIC_HTML',APP_PATH.'/statichtml');

//开启session
if(!isset($_SESSION)){
	session_start();
}


//加载配置文件
require_once SYS_PATH.'/config/config.inc.php';


//设置错误级别
if(DEBUG === TRUE){
	ini_set('desplay_errors',1);
	error_reporting(E_ALL^E_STRICT);
}else{
	ini_set('display_errors',0);
	error_reporting(0);
}


//设置时区
date_default_timezone_set(APP_TIMEZONE);


//注册自动加载器
spl_autoload_register('class_autoloader');


//解析url路由
$uri_array = parse_uri();


//获取类名和方法名
$class_name = get_controller_classname($uri_array);

$action_name = get_action_name($uri_array);

$options = $uri_array;

if(empty($class_name)){
	$class_name = 'Home';
}


//执行类的方法
try{
	$controller = new $class_name($options);
	call_user_func(array($controller,$action_name));
}catch(Exception $e){
	echo $e->getMessage();
	echo $e->getCode();
}

