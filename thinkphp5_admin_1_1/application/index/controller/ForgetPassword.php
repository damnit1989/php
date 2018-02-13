<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Hook;
use think\Config;

class ForgetPassword extends Controller
{
    public function index($keyword = '', $page = 1){

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
				$validate_result = $this->validate($data, 'ForgetPassword');

				if ($validate_result !== true) {
					$this->error($validate_result);
				} else {

				    $company_info = Db::name('company')->where('telphone',$data['telphone'])->find();
					if(!$company_info){
                        $this->error('该手机号不存在');
                    }
                    $data['password'] = md5($data['password'] . Config::get('salt'));
					//echo '<pre>';
					//print_r($data);die;
                    $telphone = $data['telphone'];
                    unset($data['confirm_password']);
                    unset($data['telphone']);
                    //update 方法返回影响数据的条数，没修改任何数据返回 0，所以必须用false判断
                    if (Db::name('company')->where('telphone',$telphone)->update($data) !== false) {
                        //echo Db::name('company')->getLastInsID();die;

                        //记录日志
                        // $param = [
                            // 'company_id' => $company_info['id'],
                            // 'username' => $company_info['username'],
                            // 'ip' => $this->request->ip(),
                            // 'content' => '重新设置密码',
                            // 'create_time' => date("Y-m-d H:i:s")
                        // ];
                        // $content = '重新设置密码';
                        // Hook::listen('record_log',$param);

                        $this->success('密码重置成功','/index');
                    } else {
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

	
    /**
     * 编辑用户
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
		$company_id = Session::get('admin_id');
		$num = get_hash_table($company_id);

        $user = Db::name('company_member_'.$num)->find($id);

        return $this->fetch('edit', ['user' => $user]);
    }

    /**
     * 更新用户
     * @param $id
     */
    public function update($id)
    {
        if ($this->request->isPost()) {
            $data            = $this->request->post();
            $validate_result = $this->validate($data, 'User');

            if ($validate_result !== true) {
                $this->error($validate_result);
            } else {

				$company_id = Session::get('admin_id');
				$num = get_hash_table($company_id);
				// $user = Db::name('company_member_'.$num)->find($id);
				// Db::table('think_user')->where('id', 1)->update(['name' => 'thinkphp']);
				// Db::table('think_user')->update($data);


                if (Db::name('company_member_'.$num)->update($data) !== false) {
                    $this->success('更新成功','/index/member/index');
                } else {
                    $this->error('更新失败');
                }
            }
        }
    }


    /**
     * 导出用户
     *
     */
    public function export(){

        $company_id = Session::get('admin_id');
        $where['company_id'] = $company_id;

        $num = get_hash_table($company_id);
        $list = Db::name('company_member_'.$num)->where($where)->select();

        $filename = 'test.xls';
        $titlename = 'test';
        $str = "<html xmlns:o=\"urn:schemas-microsoft-com:office:office\"\r\nxmlns:x=\"urn:schemas-microsoft-com:office:excel\"\r\nxmlns=\"http://www.w3.org/TR/REC-html40\">\r\n<head>\r\n<meta http-equiv=Content-Type content=\"text/html; charset=utf-8\">\r\n</head>\r\n<body>";
        $str .="<table border=1><head>".$titlename."</head>";
        $str .='<tr><td>用户名</td><td>手机</td><td>邮箱</td></tr>';
        foreach($list as $key => $val){
            $str .="<tr><td>{$val['name']}</td><td>{$val['phone']}</td><td>{$val['email']}</td></tr>";
        }
        $str .= "</table></body></html>";
        header( "Content-Type: application/vnd.ms-excel; name='excel'" );
        header( "Content-type: application/octet-stream" );
        header( "Content-Disposition: attachment; filename=".$filename );
        header( "Cache-Control: must-revalidate, post-check=0, pre-check=0" );
        header( "Pragma: no-cache" );
        header( "Expires: 0" );
        exit( $str );
    }
}
