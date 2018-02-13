<?php 

namespace app\index\controller;

use app\common\controller\HomeBase;
use think\Controller;
use think\Db;

/**
 * app接口类
 */
class Api extends Controller {

	
	private  $secretKey = 'appKey';
	private  $interfere = "@@###%%";
	
    /**
     * 类初始化
     */
    // public function __construct(){
        // parent::__construct();
        // $this->load->model('task_manage_model');
        // $this->load->model('collector_model');
		// $this->load->library('mobile_detect');
    // }
	
	public function index(){
		$this->assign('name','这是api的首页');
		return $this->fetch();
	}


	
	public function testApi(){
		
		//判断客户端设备
		// if(request()->isMobile()){
			$user_list = Db::name('test')->select();
			$user_info = Db::name('test')->where('id',1)->find();
			// Db::table('think_user')->where('status',1)->select();			
			return json_encode(['data' => $user_info,'msg' => '接受成功','status' => 1]);
		// }
		// abort(404,'页面不存在');

	}
	
    //历史任务列表
    public function listTask(){
		
		if(!$this->is_mobile()){
			$this->apiReturnJsonData('','非法请求','99001');			
		}
		$logDir =  $this->config->item('log_path');
		$logFile = $_SERVER['DOCUMENT_ROOT'].''.$logDir.__CLASS__.'_'.__FUNCTION__.'.php';
		// $receiveJsonData = $GLOBALS["HTTP_RAW_POST_DATA"];
		$receiveJsonData = file_get_contents("php://input");
		$receiveArr = json_decode($receiveJsonData,true);

		file_put_contents($logFile,$receiveJsonData,FILE_APPEND | LOCK_EX);
		$receiveHead = $receiveArr['head'];
		$receiveBody = $receiveArr['body'];
		$userId = $receiveHead['uid'];
		$signString = $receiveHead['sign'];
		$timestamp = $receiveHead['timestamp'];
		$page = $receiveBody['currPageNum'];
		$size = $receiveBody['numPerPage'];
		$type = $receiveBody['taskType'];
		
		// $userId = $this->input('userId','');
		// $signString = $this->input('signString','');
		// $timestamp = $this->input('timestamp','');
        $type   = $this->input('type', '');
        $taskName = $this->input('taskName','');
		$collectorId = $this->input('collectorId','');		
		// $page = $this->input('page', 0);
        // $size = $this->input('size', 10);
		
		$param = array('userId' => $userId,'timestamp' => $timestamp);
		if(!$signString){
			$this->apiReturnJsonData('','签名字符串不能为空','01001');
		}
		if(!$this->verifySign($signString,$param)){
			$this->apiReturnJsonData('','签名字符串不匹配','01002');			
		}
		if($userId == ''){
			$this->apiReturnJsonData('','userid不能为空','01003');				
		}

		$userInfo = $this->collector_model->getInfoByUsreId($userId);
		if(empty($userInfo)){
			$this->apiReturnJsonData('','用户不存在','04001');			
		}
		if(strtotime($userInfo['FTokenExpire']) < time()){
			$this->apiReturnJsonData('','token已经过期','04002');						
		}

        $result = $this->task_manage_model->query_task_list($page,$size,$type,$userId,$userInfo['FUserType']);
		$result['currPageNum'] = $page;
		$result['numPerPage'] = $size;

		// $timeArr = array();
		// foreach($result['data'] as $key => $value){
			// array_push($timeArr,$value['time']);
		// }
		// $timeArr = array_unique($timeArr);
		// $resultData = array();
		// foreach($result['data'] as $key => $value){
			// if(in_array($value['time'],$timeArr)){
				// $result[$value['time']][] = $result['data'][$key];
				// $resultData[$value['time']][] = $result['data'][$key];
			// }
		// }
		
		$this->apiReturnJsonData($result,'','1');		
        // $this->output($result);
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
	// private function is_mobile(){
		// $detect = new Mobile_Detect;		
		// return $detect->isMobile();
	// }
	
	/**
	* 生成签名字符串
	* 字符串格式:将userId,时间戳,密钥,干扰字符串这四个参数用"|"拼接起来
	*/
	private function createSign($param){
		$fommatStr = $param['userId'].'|'.$param['timestamp'].'|'.$this->secretKey.'|'.$this->interfere;
		return md5($fommatStr);
	}
	
	
	/**
	* 验证签名字符串
	*/
	private function verifySign($signString,$param){
		return  $this->createSign($param) == $signString ? true : false;
	}	
}
