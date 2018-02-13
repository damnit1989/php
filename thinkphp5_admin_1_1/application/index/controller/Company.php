<?php
namespace app\index\controller;

use app\common\controller\HomeBase;
use think\Db;
use think\Session;
use think\Hook;

class Company extends HomeBase{


    public function index(){


        $company_id = Session::get('admin_id');
        $company_info = Db::name('company_info')->find($company_id);

        return $this->fetch('add',['data' => $company_info]);
    }

	
	/**
	* 企业信息设置
	* @return json
	*/
	public function save(){
		try{
			if ($this->request->isPost()) {
				$data            = $this->request->post();
				$validate_result = $this->validate($data, 'CompanyInfo');
				
				// 启动事务
				Db::startTrans();
				
				if ($validate_result !== true) {
					$this->error($validate_result);
				} else {
					// $data['password'] = md5($data['password'] . Config::get('salt'));
					$company_id = Session::get('admin_id');
					// $num = get_hash_table($company_id);
					$data['company_id'] = $company_id;
					$data['create_time'] = date("Y-m-d H:i:s");

					if(Db::name('company_info')->find($company_id)){
						Db::name('company_info')->delete($company_id);
					}
					
					if(Db::name('company_info')->insert($data)){

						$content = '设置企业信息';
						Hook::listen('record_log',$content);
						
						// 提交事务
						Db::commit();						
						$this->success('保存成功','/index/member/index');					
					}else{
						
						// 回滚事务
						Db::rollback();		
						
						$this->error('保存失败');					
					}

				}
				
			}
		}catch(Exception $e){
			// 回滚事务
			Db::rollback();				
			die($e->getMessage());
			die($e->getCode());
		}		
	}

    /**
     * 拍照设置
     *
     */
    public function camera(){
		
		//默认页面按钮显示开启
		$data = ['is_camera' => 1,'wait_time' => 3];
		
        $company_id = Session::get('admin_id');
        $camera_set = Db::name('company_camera_set')->find($company_id);
		if($camera_set){
			$data['is_camera'] = $camera_set['is_camera'];
			$data['wait_time'] = $camera_set['wait_time'];
		}

        return $this->fetch('camera',['data' => $data]);		

    }


    /**
     * 通知设置
     *
     */
    public function notice(){
		
		//默认页面按钮显示开启
		$data = ['is_send_msg' => 1,'is_send_email' => 1];
		
        $company_id = Session::get('admin_id');
        $notice_set = Db::name('company_notice_set')->find($company_id);
		if($notice_set){
			$data['is_send_msg'] = $notice_set['is_send_msg'];
			$data['is_send_email'] = $notice_set['is_send_email'];
		}

        return $this->fetch('notice',['data' => $data]);
    }


    /**
     * 访客类型设置
     *
     */	
	public function visit(){
		//默认页面按钮显示开启
		$data = ['is_send_msg' => 1,'is_send_email' => 1];
		
        $company_id = Session::get('admin_id');
        $visit_list = Db::name('company_visit')->where('company_id',$company_id)->select();
	
        return $this->fetch('visit',['visit_list' => $visit_list]);		
	}

	
    /**
     * 访客类型设置
     *
     */	
	public function visitField(){
        $company_id = Session::get('admin_id');
        $visit_list = Db::name('company_visit')->where('company_id',$company_id)->select();
		// echo '<pre>';
		// print_R($visit_list);die;
        $visit_field_list = Db::name('company_visit_field')->where('company_id',$company_id)->select();		
        return $this->fetch('visit_field',['visit_list' => $visit_list,'visit_field_list' => $visit_field_list]);	

	}	
	
	
    /**
     * 保存设置
     *
     */
    public function saveSet(){
        try{
            if ($this->request->isPost()) {
				$data            = $this->request->post();				
                //$validate_result = $this->validate($data, 'User');

                //if ($validate_result !== true) {
                //  $this->error($validate_result);
                //} else {
                    // $data['password'] = md5($data['password'] . Config::get('salt'));
				$set_info = [];
				$company_id = Session::get('admin_id');
				$set_info['company_id'] = $company_id;
				
				switch ($data['set_type']){
					case 'notice':
						if(!isset($data['is_send_msg'])){
							$set_info['is_send_msg'] = 0;
						}
						if(!isset($data['is_send_email'])){
							$set_info['is_send_email'] = 0;
						}

						if(Db::name('company_notice_set')->find($company_id)){
							Db::name('company_notice_set')->delete($company_id);
						}

						Db::name('company_notice_set')->insert($set_info);
					
						die(json_encode(['data' => $set_info,'msg' => '设置成功','status' => 1]));
						
						break;
					case 'camera':
						if(!isset($data['is_camera'])){
							$set_info['is_camera'] = 0;
						}
						$set_info['wait_time'] = $data['wait_time'];
						if(Db::name('company_camera_set')->find($company_id)){
							Db::name('company_camera_set')->delete($company_id);
						}

						Db::name('company_camera_set')->insert($set_info);
					
						die(json_encode(['data' => $set_info,'msg' => '设置成功','status' => 1]));
						
						break;
					case 'visit':
						
						$visit_data = [];
						Db::name('company_visit')->where('company_id',$company_id)->delete();
						foreach($data['type_name'] as $key => $val){
							$visit_data[$key]['company_id'] = $company_id; 
							$visit_data[$key]['visit_name'] = $val; 
							if(!isset($data[$val])){
								$visit_data[$key]['is_open'] = 0;
							}else{
								$visit_data[$key]['is_open'] = 1;
							}
						}
						$count = Db::name('company_visit')->insertAll($visit_data);
						
						die(json_encode(['data' => $count,'msg' => '设置成功','status' => 1]));
						break;
					case 'visit_field':
						// echo '<pre>';
						// print_R($data);die;
						$visit_data = [];
						// $where['visit_id'] = $visit_id;
						$where['visit_id'] = 186;
						$where['company_id'] = $company_id;
						Db::name('company_visit_field')->where($where)->delete();
						foreach($data['type_name'] as $key => $val){
							$visit_data[$key]['company_id'] = $company_id; 
							// $visit_data[$key]['visit_id'] = $visit_id; 
							$visit_data[$key]['visit_id'] = 186; 
							$visit_data[$key]['field_name'] = $val; 
							if(!isset($data[$val])){
								$visit_data[$key]['is_open'] = 0;
							}else{
								$visit_data[$key]['is_open'] = 1;
							}
						}
						$count = Db::name('company_visit_field')->insertAll($visit_data);
						
						die(json_encode(['data' => $count,'msg' => '设置成功','status' => 1]));
						break;						
						break;
						
				}
				//}
			}
        }catch(Exception $e){
			die(json_encode(['data' => '','msg' => '设置失败','status' => '010001']));
            // die($e->getMessage());
            // die($e->getCode());
        }
    }

}
