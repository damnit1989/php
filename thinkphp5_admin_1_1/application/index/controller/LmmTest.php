<?php
namespace app\index\controller;

use app\common\controller\HomeBase;
use think\Db;
use think\Session;
use org\Email_Notify;
use org\Sms_Notify;
use org\Notify_Factory;

/**
* lmm测试类 
*
*/
class LmmTest extends HomeBase{
	
	public function test(){
		$this->assign('name','thnkphp');
		$this->view->engine->layout(true);
	
		return $this->fetch('test');
		// return view('test',['name'=>'thinkphp']);
	}
	
	public function testJson(){
		return json_encode(['data' => '','msg' => '成功','status' =>1]);
	}
	
	public function testPost(){
		try{
			if(request()->isAjax()){
				$data = [
					'name' =>  input('post.username'),
					'desc' => input('post.password'),	
				];
			
				DB::name('test')->insert($data);
				$userId = Db::name('user')->getLastInsID();			
				return json_encode(['data' => $userId,'msg' => '成功','status' =>1]);			
			}			
		}catch(\Exception $e){
			die($e->getMessage());
		}

		if(request()->isPost()){
			var_dump(request()->method());
			echo request()->isAjax();
			echo request()->ip();
			echo request()->type();
			var_dump(request()->route());
			var_dump(request()->param());
			
		
		}else{
			return $this->fetch('test_post');			
		}
	}
	
	public function testList(){
		$user_list = Db::name('test')->paginate(10);
		// dump($user_list);
		$this->assign('list',$user_list);
		return $this->fetch();
	}
	
	public function testNotify(){
		$notify_factory = new Notify_Factory;
		$emailObj = new Email_Notify();		
		$smsObj = new Sms_Notify();			
		$notify_factory->addNotifyObj($emailObj);
		// $notify_factory->addNotifyObj($smsObj);
		$notify_factory->doSend();
		echo '<pre>';
		print_R($notify_factory);
		die;
	}


}
