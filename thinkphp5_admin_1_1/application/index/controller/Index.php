<?php
namespace app\index\controller;

use app\common\controller\HomeBase;
use think\Db;
use think\Session;
use org\Email_Notify;
use org\Sms_Notify;
use org\Notify_Factory;

class Index extends HomeBase
{
    public function index()
    {
		$list = Db::name('visitor')->paginate(10);
		$company_id = Session::get('admin_id');

		$num = get_hash_table($company_id);

		$list = Db::name('visitor')->field('v.id,v.visitor_name,v.visitor_phone,v.visitor_email,v.visitor_type,v.create_time,cm.name,cm.phone')
		->alias('v')
		->join('company_member_'.$num.' cm','v.member_id = cm.id')
		->paginate(10);		
		
		$page = $list->render();
		$this->assign('list', $list);
		$this->assign('page', $page);		

		// $this->view->engine->layout(true);
        return $this->fetch();
    }
	
	
	/**
	* 测试发送邮件
	*
	*/
	public function email(){
		if ($this->request->isPost()) {
			
			try{
				$email = input('post.email');
				
				$title = '这是一封测试邮件';
				$content = '这是一封测试内容';
				
				$notify_factory = new Notify_Factory;			
				$emailObj = new Email_Notify($email,$title,$content);		
				$notify_factory->addNotifyObj($emailObj);
				
				// $smsObj = new Sms_Notify();				
				// $notify_factory->addNotifyObj($smsObj);
				
				$notify_factory->doSend();
				
				die(json_encode(['data'=>'','msg' => '发送成功','status' =>1]));
				// $this->success('发送成功','/index/index/index');
			}catch(\Exception $e){
				die(json_encode(['data'=>'','msg' => '发送失败','status' =>'000']));// $this->error('发送失败','/index');					
			}
		}else{
			return $this->fetch();			
		}

	}
	
	
	/**
	* 测试发短信
	*
	*/
	public function phone(){
		if($this->request->isPost()){
			try{
				$phone = input('post.phone');

				
				// $notify_factory = new Notify_Factory;			
				// $smsObj = new Sms_Notify();				
				// $notify_factory->addNotifyObj($smsObj);
				// $notify_factory->doSend();
				
				die(json_encode(['data'=>'','msg' => '奋力开发中。。。','status' =>1]));
				// $this->success('发送成功','/index/index/index');
			}catch(\Exception $e){
				die(json_encode(['data'=>'','msg' => '奋力开发中。。。','status' =>'000']));// $this->error('发送失败','/index');					
			}			
		}else{
			return $this->fetch();
		}
	}
	

}
