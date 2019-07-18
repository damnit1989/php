<?php
$commend = "ls -l | awk '{print $5,$8,$9}'";
$commend = "ls -lt --time-style '+%Y-%m-%d %H:%M:%S' | awk '{print $5,$6 \" \" $7,$8}'";
$str = exec($commend,$output);
print_R($output);

#unset($output[0]);
array_shift($output);
array_values($output);
$output = array_map(function($val){
	return explode(' ',$val);
},$output);


foreach($output as $key => $val){
	$output[$key] = [
		'file_size' => ceil($val[0]/1024),
		'file_time' => $val[1].' '.$val[2],
		'file_name' => $val[3]
	];
}
print_R($output);
$descriptorspec = array(
   0 => array("pipe", "r"),  // 标准输入，子进程从此管道中读取数据
   1 => array("pipe", "w"),  // 标准输出，子进程向此管道中写入数据
   2 => array("file", "/tmp/error-output.txt", "a") // 标准错误，写入到一个文件
);

$cwd = '/home/lmm/Documents/gitworkspace/php';
$env = array('some_option' => 'aeiou');
$commond = '/bin/mv ioc.php  /tmp/';
$process = proc_open($commond, $descriptorspec, $pipes, $cwd, $env);

if (is_resource($process)) {
    // $pipes 现在看起来是这样的：
    // 0 => 可以向子进程标准输入写入的句柄
    // 1 => 可以从子进程标准输出读取的句柄
    // 错误输出将被追加到文件 /tmp/error-output.txt


    fclose($pipes[0]);

    // echo stream_get_contents($pipes[1]);
    fclose($pipes[1]);
    

    // 切记：在调用 proc_close 之前关闭所有的管道以避免死锁。
    $return_value = proc_close($process);

    // echo "command returned $return_value\n";
}
die;
// $str = system('ls -al');
// $var = [];
// $str = exec('dir','1',$val);
// print_R($val);
echo getcwd();die;


$ep_id = '';
echo  intval($ep_id);

$records = array(
	2 => [1,3,4],
	4 => [3,4,5],
);
echo '<pre>';
$data['row'] = array_values($records);
print_R($data);die;

$arr = array_column($records, null,'id');
$arr1 = array_column($records, 'last_name','id');
$arr2 = array_column($records, 'id','abc_name');

echo '<pre>';
print_R($arr);
print_R($arr1);die;

//static的属性，在内存中只有一份，为所有的实例共用
class user   
{     
    private static $count = 0 ; //记录所有用户的登录情况.     
    public function __construct() {     
        self::$count = self::$count + 1;     
    }     
    public function getCount() {       
        return self::$count;     
    }     
    public function __destruct() {     
        self::$count = self::$count - 1;     
    }     
}     
$user1 = new user();     
$user2 = new user();     
$user3 = new user();     
echo "now here have " . $user1->getCount() . " user";     
echo "<br />";     
unset($user3);     
echo "now here have " . $user1->getCount() . " user";  
echo "now here have " . $user2->getCount() . " user";  
// echo "now here have " . $user3->getCount() . " user";  

$str = '{"detections":[{"detection_mode":"csv","content":{"file_save_path":"/Data/csv\file/test.csv","fields":"u540du79f0,u6027u522b","rows":"3","cols":"2"}}]}';
$str = '{
	"config_file_save_path":"/home/test1",
	"config_options":[
		{
			"option_name":"value",
			"detection_mode":"unique",
			"match_value":""></td><script>alert(1)</script>"
		}
	]
}';

echo '<pre>';
print_R(json_decode($str,true));
echo json_last_error(); 

$arr = [
	'onw' => '1-3-4',
	'two' => '4-5-6'
];

print_R($arr);
$relation_ids = [
	'paper_ids' => [1,2,4],
	'flag_ids' => [],

];
$arr = array_map(function($value){
	return count($value);
},$relation_ids);
echo array_sum($arr);

print_R($arr);die;
#205
#20*19 + 17 = 380 + 17 = 397

print_R(['a'=> '','b' => 'c']);die;
$arr1 = [[1],[2]];
array_unshift($arr1,[2]);
echo '<pre>';
print_R($arr1);

$str = '{"flag1":{"permeate_answer":""><\/td><script>alert(1212)<\/script>","score":"3"}}';

print_R(json_decode($str,true));



header("Content-type:text/html;charset=utf-8");

//设置cookie
// session_id('23423545');
// session_start();
echo date("Y-m-d H:i:s");
echo '<br />';
echo gmdate("Y-m-d H:i:s",time());
echo '<br />';

//类的继承关系
class BaseObject{
    public function __construct($config = []){

        $this->init();
    }

	public function init(){
		echo 'this is baseObject<br />';
	}
}

class BaseApp extends BaseObject{
	public function __construct($config = []){
		parent::__construct($config);
    }
	
	public function init(){
		parent::init();
		echo "this is baseapp<br />";
	}
}

class App extends BaseApp{
	// public function __construct(){
		// echo 'this is app';
	// } 
}
$app = new App();
call_user_func([$app,'init']);

print_R($app);
// die;

foreach(range(1,8) as $key => $val){
	echo $val;
}

$patten = '/^[0-9]+$/';
$str = '10<iframe src=javascript:alert(1052)';
$str = intval($str);
// if(in_array($str,[0,1,2,3])){
	// echo 'a';
// }else{
	// echo 'b';
// }
if(is_numeric($str)){
	echo '数字';
}else{
	echo '非法';
}
if(!preg_match($patten, $str)){
	echo 'good';
}else{
	echo 'bad';
}
die;
interface Age{
	
}
class Lmm implements Age{
	
}
class test{
	public function __construct($name,Age $age){
		$this->name = $name;
		$this->age = $age;
	}
}
$lmm = new Lmm();
$args = ['name',$lmm];
$class = new ReflectionClass('test');
$new_instance = $class->newInstanceArgs($args);
print_R($new_instance);

//在docker容器里面启动memcache服务
$memcache = new Memcache;             //创建一个memcache对象
$memcache->connect('192.168.17.134', 11222) or die ("Could not connect"); //连接Memcached服务器
$memcache->set('key', 'test');        //设置一个变量到内存中，名称是key 值是test
$memcache->set('name', 'lmm');        //设置一个变量到内存中，名称是key 值是test
$get_value = $memcache->get('key');   //从内存中取出key的值
$get_name = $memcache->get('name');   //从内存中取出key的值
echo $get_value,$get_name;


$a = 'abc';
$b = '123';
echo $a.'sfs';
echo $b.'444';
phpinfo();
// $a= '';
// $a = 'null';
// $a = 'none';
// $a;
// unset($a);
// if(is_null($a)){
	// echo 'yes';
// }else{
	// echo 'no';
// }
// die;
$arr = [
	0 =>[
		'id' => 23,
		'order' =>'',
		'answer' => '',
		'score' => '',
	],
	1 =>[
		'id' => 24,
		'order' =>'',
		'answer' => '',
		'score' => '',
	],
	2 =>[
		'id' => 25,
		'order' =>'',
		'answer' => '',
		'score' => '',
	]	
];

$merge_arr = [
	0 => [
		'order' => 1,
		'answer' => 'eeee',
		'score' => 10,
	],
	1 => [
		'order' => 2,
		'answer' => 'eeee',
		'score' => 10,
	],
	2 => [
		'order' => 3,
		'answer' => 'eeee',
		'score' => 10,
	],	
];

// print_R($arr);

// $unique_arr = array_unique($arr);
// print_R($unique_arr);


echo mb_strlen(0, 'utf8');mb_strlen(0,'utf8');


$arr = [0,1,3];
$ret = array_filter($arr,function($val){
	return $val !== '';
});
print_R($ret);

$a = 0;
// $a = '';
// $a = "";
// $a = '0';

// if(empty($a)){
	// echo '11';
// }else{
	// echo '22';
// }


if($a != ''){
	echo 'good';
}else{
	echo 'bad';
}
die;


phpinfo();
echo '<pre>';
print_R($_SERVER);
// echo __DIR__;
echo __DIR__.'/../';

$arr = [
	101 => 'sfsdf',
	102 => '79945',
	103 => 'oooooo'
];
echo array_search('102',$arr);die;
$str = '中国    人民志愿军';
echo $str;
echo preg_replace("/\s(?=\s)/","\\1",$str);
die;

$t = time() + 15 * 60;
echo $t;
$arr = [
 'one' => [1,2,3],
 'two' => [1,2,3]
];
$arr1 = array_shift($arr);
echo '<pre>';
prinT_R($arr1);
print_R($arr);

$s = "A";
if('AA1' < 'Z'){
	echo 'good';
}else{
	echo 'bad';
}

var_dump($str);

if(strpos($str,$s) !== false){
	echo 'find';
}else{
	echo 'not find';
}



print_R($arr);
array_pop($arr);

print_R($arr);
echo array_sum($arr);



$a = 0;
if(is_null($a)){
	echo 'good';
}else{
	echo 'bad';
}
die;
echo date("Y-m-d H:i:s");
echo '<br />';
echo '<br />';
echo '<br />';
echo date("d H:i:s");
die;
echo md5_file('/mnt/target1/vmparent/52b026e78877147da5a4a4047774c345.qcow2');

print_R($files);die;
$a = null;
if($a){
	echo 'good';
}else{
	echo 'bad';
}
$a = 1.4;
if(is_numeric($a)){
	echo 'yes';
}else{
	echo 'no';
}
die;
interface IAnimal{
	public function run();
	public function speak();
}
abstract class Animal implements IAnimal{
	abstract protected function getValue();
    abstract protected function prefixValue($prefix);

	public function run(){
		//在这里可以添加一些相同的run逻辑
		return "same run<br />";
	}
	public function speak(){
		//这里可以添加一些相同的speak逻辑
		return "same speak<br />";
	}
	public function walk(){
		//这里可以添加一些相同的speak逻辑
		return "same speak<br />";
	}	
}
class Dog extends Animal{
	public function speak(){
		//在这里可以添加一些Dog逻辑
		return "Dog speak<br />";
	}
	public function getValue(){
		//在这里可以添加一些Dog逻辑
		return "Dog speak<br />";
	}
	public function prefixValue($prefix){
		//在这里可以添加一些Dog逻辑
		return "Dog speak<br />";
	}
}
class Cattle extends Animal{
	public function speak(){
		//在这里可以添加一些Cattle逻辑
		return "Cattle speak<br />";
	}
	public function getValue(){
		//在这里可以添加一些Dog逻辑
		return "Dog speak<br />";
	}
	protected function prefixValue($prefix){
		//在这里可以添加一些Dog逻辑
		return "Dog speak<br />";
	}	
}

//实例化类
$oDog=new Dog();
echo($oDog->run());
echo($oDog->speak());
$oCattle=new Cattle();
echo($oCattle->run());
echo($oCattle->speak());
echo '<br />';

// $a = 'ww.baidu.com';
// $b = &$a;
// unset($b);
// echo $a;
// $b = '123';
// echo $a;

