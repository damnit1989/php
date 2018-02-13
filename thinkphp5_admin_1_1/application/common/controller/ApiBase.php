<?php 

namespace app\common\controller;

use org\Auth;
use think\Controller;
use think\Db;
use org\Mobile_Detect;


/**
 * Ipad接口基础控制器
 * Class ApiBase
 * @package app\common\controller
 */
class ApiBase extends Controller {

	protected  $secretKey = 'appKey';
	protected  $interfere = "@~@###%%";
	protected  $receiveHead = '';
	protected  $receiveBody = '';

	
    /**
     * 类初始化
     */
    public function __construct(){
        parent::__construct();
		// $this->checkPostData();
    }
	
	
	/**
	* 生成签名字符串
	* 字符串格式:将company_id,时间戳,密钥,干扰字符串这四个参数用"|"拼接起来,取md5值
	*/
	private function createSign($param){
		$fommatStr = $param['company_id'].'|'.$param['timestamp'].'|'.$this->secretKey.'|'.$this->interfere;
		return md5($fommatStr);
	}
	
	
	/**
	* 验证签名字符串
	*/
	private function verifySign($param){
		return  $this->createSign($param) == $param['sign'] ? true : false;
	}


	/**
	* 验证请求数据
	*/	
	private function checkPostData(){

		if(!$this->is_mobile()){
			$this->apiReturnJsonData('','非法请求','99001');			
		}
		// $receiveJsonData = $GLOBALS["HTTP_RAW_POST_DATA"];		
		$receiveJsonData = file_get_contents("php://input");
		$receiveArr = json_decode($receiveJsonData,true);

		//请求数据存入日志文件
		// $this->writeLog($receiveArr);
		
		//分离请求数据
		$receiveHead = $receiveArr['head'];
		$receiveBody = $receiveArr['body'];
		
		//生成签名字符串
		// echo $this->createSign($receiveHead);die;

		//company_id不能为空
		if(empty($receiveHead['company_id'])){
			$this->apiReturnJsonData('','非法请求','01001');
		}
		
		//token不能为空		
		if(empty($receiveHead['token'])){
			$this->apiReturnJsonData('','非法请求','01002');
		}

		//验证签名串
		if(!$this->verifySign($receiveHead)){
			$this->apiReturnJsonData('','非法请求','01003');		
		}

		//判断企业是否存在
		$company_info = Db::name('company')->find($receiveHead['company_id']);if(empty($company_info)){
			$this->apiReturnJsonData('','非法请求','01004');			
		}
		
		//验证token是否过期
		$where = ['company_id' => $receiveHead['company_id'],'token' => $receiveHead['token']];
		$company_token = Db::name('company_token')->where($where)->find();
		if(empty($company_token)){
			$this->apiReturnJsonData('','非法请求','04001');			
		}
		if($company_token['expired_time'] < time()){
			$this->apiReturnJsonData('','token过期请重新登录','04002');
		}		
		
		//保存请求数据
		$this->receiveHead = $receiveHead;
		$this->receiveBody = $receiveBody;
	}

	
	/**
	* 记录日志
	*/	
	private function writeLog($receiveJsonData){
		$logDir =  $this->config->item('log_path');
		$logFile = $_SERVER['DOCUMENT_ROOT'].''.$logDir.__CLASS__.'_'.__FUNCTION__.'.php';
		file_put_contents($logFile,$receiveJsonData,FILE_APPEND | LOCK_EX);	
	}

	
	/**
	* json数据返回函数
	* @return  json
	*/
	protected function apiReturnJsonData($result = '',$msg = '',$resultCode = ''){
		die(json_encode(array('result' => $result,'msg' => $msg,'resultCode' =>$resultCode)));
	}	
    

	
	/**
	* 模拟GET请求
	*/
    public function testApiGet(){
        
		$url = "http://www.qh.com/api/api/listTask?type=0&uid=admin";
        //初始化
        $curl = curl_init();
        //设置抓取的url
        curl_setopt($curl, CURLOPT_URL, $url);
        //设置头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_HEADER, 0);
        //设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //执行命令
        $data = curl_exec($curl);
        //关闭URL请求
        curl_close($curl);
        //显示获得的数据
        print_r($data);
    }

	
	/**
	* 模拟POST请求
	*/	
	public function testApiPost(){
		
		$url = "http://www.qh.com/api/api/listTask";
		
		//设置post数据
		// $post_data = array(
			// "userId" => "50000146",
			// 'signString' => '205e2bf2f22c80d7a02b626242c49c34',
			// 'timestamp' => '1464244890',
		// );
		$post_data = array(
			'head'=> array(
				'uid' =>'50000146',
				'sign' => '205e2bf2f22c80d7a02b626242c49c34',
				'timestamp' =>'1464244890',
			),
			'body' => array(
				'taskType' => '2',
				'currPageNum' => '0',
				'numPerPage' => '10'
			)
		);
		$post_data = json_encode($post_data);
		//初始化
		$curl = curl_init();
		//设置抓取的url
		curl_setopt($curl, CURLOPT_URL, $url);
		//设置头文件的信息作为数据流输出
		curl_setopt($curl, CURLOPT_HEADER, 0);
		//设置获取的信息以文件流的形式返回，而不是直接输出。
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		//设置post方式提交
		curl_setopt($curl, CURLOPT_POST, 1);

		curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
		// curl_setopt($curl, CURLOPT_HTTPHEADER, array(  
            // 'Content-Type: application/json; charset=utf-8',  
            // 'Content-Length: ' . strlen($post_data))  
        // ); 
		//执行命令
		$data = curl_exec($curl);
		//关闭URL请求
		curl_close($curl);
		//显示获得的数据
		print_r($data);
	}
	
	
	/**
	* 判断请求是否来自手机端
	*/
	protected function is_mobile(){
		$detect = new Mobile_Detect;		
		return $detect->isMobile();
	}
}
