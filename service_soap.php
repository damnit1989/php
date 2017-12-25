<?php 

//接口类
class Api{
	
	public function test(){
		$arr = array(
			'status' => 1,
			'message' => '请求成功',
			'data' => array(
				'name' => 'lmm',
				'age' => 28,
				'sex' => 2
			)
		);
		// system('dir');
		
		//为什么方法里面有输出就不行呢，只能是返回数据
		// die(json_encode($arr));
		
		return json_encode($arr);
	}

	
	public function get_title(){
		return 'this is a good';
	}
	public function output_view(){}

}


//服务端

$parameter=array(
    'uri'=>'http://localhost/',
    // 'location'=>'http://localhost/lmm/service_soap.php'
    );
	
$soapServer=new SoapServer(null,$parameter);
$soapServer->setClass('Api');
$soapServer->handle();