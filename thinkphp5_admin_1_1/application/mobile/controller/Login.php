<?php
namespace app\mobile\controller;

use think\Controller;
use think\Config;
use think\Db;
use think\Session;

/**
 * 登录
 * Class Login
 * @package app\admin\controller
 */
class Login extends Controller{

    /**
     * 登录验证
     * @return string
     */
    public function login(){
		
		// if(!$this->is_mobile()){
			// $this->apiReturnJsonData('','非法请求','99001');			
		// }

        if ($this->request->isPost()) {
            // $data = $this->request->only(['username', 'password', 'verify']);
			$receiveJsonData = file_get_contents("php://input");
			// var_dump($receiveJsonData);die;
			$receiveArr = json_decode($receiveJsonData,true);
			// var_dump($receiveArr);die;
			// $this->writeLog($receiveArr);
			$receiveHead = $receiveArr['head'];
			$receiveBody = $receiveArr['body'];			
            // $validate_result = $this->validate($data, 'Login');
			$where['username'] = $receiveBody['username'];
			$where['password'] = md5($receiveBody['password'] . Config::get('salt'));
			
			// 启动事务
			Db::startTrans();
			try{
				$company_info = Db::name('company')->field('id,username')->where($where)->find();
				if (!empty($company_info)){
					$company_token = Db::name('company_token')->where('company_id',$company_info['id'])->find();
					$data['expired_time'] = time() + 3600;
					$token_str = $company_info['id'].'|'.time().'|'.mt_rand(10000,99999);
					$data['token'] = md5($token_str);
				
					if(!empty($company_token)){
						Db::name('company_token')->where('company_id',$company_info['id'])->update($data);
					}else{
						$data['company_id'] = $company_info['id'];
						Db::name('company_token')->insert($data);
					}
					
					// 提交事务
					Db::commit(); 
					
					return json_encode(['result' => $company_info,'msg' => '登录成功','resultCode' => 1]);
				} else {
					return json_encode(['result' => '','msg' => '用户名或密码错误','resultCode' => '01001']);
				}
			}catch(\Exception $e){
				// 回滚事务
				Db::rollback();
				return json_encode(['result' => '','msg' => '网络异常','resultCode' => '01002']);				
			}
		}
    }

 
	
}
