<?php 

interface  Notify{
	public function send();
}


class Email implements Notify{
	
	private $name;
	private $age;
	
	public function __construct($name,$age){
		$this->name = $name;
		$this->age = $age;
	}
	public function send(){
		echo 'this is  email function.</br />';
	}
}


class Sms implements Notify{
	public function send(){
		echo 'this is sms function.<br />';
	}
}


class Test{

	private $emailObj;
	
	public function __construct(Notify $email){
		$this->emailObj = $email;
	}
	
	public function handleSend(){
		$this->emailObj->send();
	}
}


//容器类
class Ioc{
	private static $binds = [];
	private static $instances = [];
	
	public static function bind($class,$callback){
		self::$binds[$class] = $callback;
	}
	
	public static function make($class,$param = []){
		self::$instances[$class] = call_user_func_array(self::$binds[$class],$param);
		return call_user_func_array(self::$binds[$class],$param);
	}
	
	public static function getInstance($class){
		return self::$instances[$class];
		// if(!self::$instances[$class]){
			// return  self::$instances[$class];
		// }
	}
}


//绑定Email,Sms类
Ioc::bind(Email::class,function($name,$age){
	return new Email($name,$age);
});
Ioc::bind(Sms::class,function($name,$age){
	return new Sms($name,$age);
});

//生成Email,Sms类实例
Ioc::make(Email::class,['lmm','age']);
Ioc::make(Sms::class,['lmm','age']);

Ioc::bind(Test::class,function(Notify $emailObj){
	return new Test($emailObj);
});


$email = Ioc::getInstance(Email::class);
$email = Ioc::getInstance(Sms::class);

// $Test = Ioc::make(Test::class,[Ioc::make(Email::class,['lmm','age'])]);
$Test = Ioc::make(Test::class,[$email]);

echo '<pre>';
print_R($Test);

$Test->handleSend();
