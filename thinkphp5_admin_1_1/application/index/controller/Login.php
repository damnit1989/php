<?php
namespace app\index\controller;

use think\Config;
use think\Controller;
use think\Db;
use think\Session;

/**
 * 登录
 * Class Login
 * @package app\admin\controller
 */
class Login extends Controller
{
    /**
     * 登录
     * @return mixed
     */
    public function index()
    {
        return $this->fetch();
    }

    /**
     * 登录验证
     * @return string
     */
    public function login()
    {
        if ($this->request->isPost()) {
            $data            = $this->request->only(['username', 'password', 'verify']);
            $validate_result = $this->validate($data, 'Login');

            if ($validate_result !== true) {
                $this->error($validate_result);
            } else {
                $where['username'] = $data['username'];
                $where['password'] = md5($data['password'] . Config::get('salt'));
				
				//管理员登录验证
                $admin_user = Db::name('admin_user')->field('id,username,status')->where($where)->find();

                if (!empty($admin_user)) {
                    if ($admin_user['status'] != 1) {
                        $this->error('当前用户已禁用');
                    } else {
                        Session::set('admin_id', $admin_user['id']);
                        Session::set('admin_name', $admin_user['username']);
                        Db::name('admin_user')->update(
                            [
                                'last_login_time' => date('Y-m-d H:i:s', time()),
                                'last_login_ip'   => $this->request->ip(),
                                'id'              => $admin_user['id']
                            ]
                        );
                        $this->success('登录成功', 'index/index/index');
                    }
                } else {
					$this->checkCompany($where);
				//管理员登录验证
				
                    $this->error('用户名或密码错误');
                }
            }
        }
    }

    /**
     * 退出登录
     */
    public function logout()
    {
        Session::delete('admin_id');
        Session::delete('admin_name');
        $this->success('退出成功', 'index/login/index');
    }
	
	
    /**
     * 验证账号
     * @return string
     */
	 
	private function checkCompany($where){
		$company_user = Db::name('company')->field('id,username')->where($where)->find();
		if (!empty($company_user)) {

			Session::set('admin_id', $company_user['id']);
			Session::set('admin_name', $company_user['username']);
			// Db::name('admin_user')->update(
				// [
					// 'last_login_time' => date('Y-m-d H:i:s', time()),
					// 'last_login_ip'   => $this->request->ip(),
					// 'id'              => $company_user['id']
				// ]
			// );
			$this->success('登录成功', 'index/index/index');
		} else {
			
		//管理员登录验证
		
			$this->error('用户名或密码错误');
		}	
	}
}
