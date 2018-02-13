<?php
namespace app\mobile\controller;

use app\common\controller\ApiBase;
use think\Loader;
use think\Hook;

use org\Mobile_Detect;
use phpmailer\PHPMailer;
use org\Email_Notify;
use org\Sms_Notify;
use org\Notify_Factory;

class Index extends ApiBase
{
    public function index()
    {

		// Loader::import('extend.org.Mobile_Detect');
		// $detect = new \org\Mobile_Detect();
		$detect = new  Mobile_Detect();
		if($detect->isMobile()){
			echo 'this is mobile';
		}else{
			echo 'this is web';
		}
		var_dump($detect->isTablet());		
		// var_dump($detect);die;
		// $detect = new Mobile_Detect;
		// var_dump($mobile_detect->isiOS());die;
		$user_agent = $detect->getUserAgent();
		if(strpos($user_agent, 'Chrome') !== false ){
			echo 'google';
		}
		if(strpos($user_agent, 'Firefox') !== false ){
			echo 'Firefox';
		}		
		
		// var_dump($detect->getUserAgent());
		// var_dump($detect->is('Firefox'));

		// var_dump($detect->is('iOS'));
		// var_dump($detect->is('UCBrowser'));
		// var_dump($detect->is('Opera'));die;	
		// if(request()->isMobile()){
			return json_encode(['data' => '','msg' => '成功','status' =>1]);
		// }else{
			// die('sdfsdfsdf');
		// }
	}

	public function testSendEmail(){
		$notify_factory = new Notify_Factory;
		$to = '448559829@qq.com';
		$title = '测试';
		$content = '这是测试内容';
		$emailObj = new Email_Notify($to,$title,$content);		
		// $smsObj = new Sms_Notify();			
		$notify_factory->addNotifyObj($emailObj);
		// $notify_factory->addNotifyObj($smsObj);
		$notify_factory->doSend();
		echo '<pre>';
		print_R($notify_factory);
		die;
		// print_R($smsObj);die;
	}

}
