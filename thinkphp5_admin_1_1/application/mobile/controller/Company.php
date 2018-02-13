<?php
namespace app\mobile\controller;

use app\common\controller\ApiBase;
use think\Config;
use think\Db;
use think\Session;

/**
 * 企业信息
 * Class Company
 * @package app\mobile\controller
 */
class Company extends ApiBase{

    /**
     * 查询企业信息
	 *
	 * @request method get
     * @return json
     */
    public function info(){
		if ($this->request->isGet()) {
			//查询company表
			// $company_id = $this->receiveHead['company_id'];
			// $company_info = Db::name('company')->field('id,username,telphone')->find($company_id);
			
			//查company_info表
			$company_id = $this->receiveHead['company_id'];
			$company_info = Db::name('company_info')->field('id,company_name,logo_url,welcome_word')->find($company_id);
			
			$this->apiReturnJsonData($company_info,'查询成功','1');
        }
    }

   /**
     * 退出登录
     */
    public function logout(){
		if ($this->request->isPost()) {
			$company_id = $this->receiveHead['company_id'];
			$data['expired_time'] = time() - 3600;
			if (Db::name('company_token')->where('company_id',$company_id)->update($data) !== false) {
				$this->apiReturnJsonData('','退出成功','1');
			} else {
				$this->apiReturnJsonData('','退出失败','01001');
			}
		}
    }


	/**
	* 获取访客类型
	*/
	public function visitList(){
		if ($this->request->isGet()) {
			$where = [];
			$where['company_id'] = $this->receiveHead['company_id'];
			// $where['company_id'] = 1;
			$where['is_open'] = 1;
			$company_info = Db::name('company_visit')->field('id,visit_name')->where($where)->select();
			$this->apiReturnJsonData($company_info,'查询成功','1');
		}		
	}

}
