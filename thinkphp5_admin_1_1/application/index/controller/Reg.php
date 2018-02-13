<?php
namespace app\index\controller;

use app\common\controller\HomeBase;
use think\Db;
use think\Session;
use think\Config;
use think\Controller;

class Reg extends Controller
{
    public function index()
    {

        return $this->fetch();
    }

    /**
     * 添加用户
     * @return mixed
     */
    public function add()
    {
        return $this->fetch();
    }
	

	/**
     * 保存用户
     */
    public function save()
    {
		try{
			

			if ($this->request->isPost()) {
				$data            = $this->request->post();
				$validate_result = $this->validate($data, 'Company');

				if ($validate_result !== true) {
					$this->error($validate_result);
				} else {
					$data['password'] = md5($data['password'] . Config::get('salt'));
					unset($data['confirm_password']);
					unset($data['verify']);
					// $company_id = Session::get('admin_id');
					// $num = get_hash_table($company_id);
					// $data['company_id'] = $company_id;
					$data['create_time'] = date("Y-m-d H:i:s");
					if(Db::name('company')->insert($data)){
						$this->success('保存成功','/index');					
					}else{
						$this->error('保存失败');					
					}
					// $userId = Db::name('user')->getLastInsID();			
					// return json_encode(['data' => $userId,'msg' => '成功','status' =>1]);
				}
				
			}
		}catch(Exception $e){
			die($e->getMessage());
			die($e->getCode());
		}
    }

}
