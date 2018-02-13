<?php
namespace app\index\controller;

use app\common\controller\HomeBase;
use think\Db;
use think\Config;
use think\Session;

class Visitor extends HomeBase
{
    public function index($keyword = '', $page = 1)
    {
		// dump(Config::get('database'));


        $where = [];

        if ($keyword) {
            $where['name|phone|email'] = ['like', "%{$keyword}%"];
        }

		$company_id = Session::get('admin_id');
		$where['v.company_id'] = $company_id;
		$num = get_hash_table($company_id);
		
		// $list = Db::name('visitor')->paginate(10);
		// Db::field('user.name,role.title')
		// ->table('think_user user,think_role role')
		// ->limit(10)->select();
		// 方式三

		$list = Db::name('visitor')->field('v.id,v.visitor_name,v.visitor_phone,v.visitor_email,v.visitor_type,v.create_time,cm.name,cm.phone')
		->alias('v')
		->join('company_member_'.$num.' cm','v.member_id = cm.id')
        ->where($where)
		->paginate(10);

		//打印执行的sql
		//echo Db::table('visitor')->getLastSql();die;

		$page = $list->render();
		$this->assign('list', $list);
		$this->assign('page', $page);		
        $this->assign('keyword',$keyword);
        return $this->fetch();
    }

	
    /**
     * 添加访客记录
     * @return mixed
     */
    public function add(){

		$company_id = Session::get('admin_id');
		$where['company_id'] = $company_id;
		$num = get_hash_table($company_id);
		$member_list = Db::name('company_member_'.$num)->where($where)->paginate(10);
		$visit_type_list = ['面试','客户','亲友','其他'];
        return $this->fetch('add', ['member_list' => $member_list,'visit_type_list' => $visit_type_list]);
    }	
	public function visitorlist(){
		return json_encode(['data' => '','msg' => '成功','status' =>1]);
	}

	
    /**
     * 保存访客记录
     * 
     */
    public function save()
    {
        if ($this->request->isPost()) {
            $data            = $this->request->post();
            $validate_result = $this->validate($data, 'Visitor');
			// echo '<pre>';
			// print_R($data);die;
            if ($validate_result !== true) {
                $this->error($validate_result);
            } else {
                // $data['password'] = md5($data['password'] . Config::get('salt'));
                // if ($this->admin_user_model->allowField(true)->save($data)) {
                    // $auth_group_access['uid']      = $this->admin_user_model->id;
                    // $auth_group_access['group_id'] = $group_id;
                    // $this->auth_group_access_model->save($auth_group_access);
                    // $this->success('保存成功');
					$company_id = Session::get('admin_id');
					// $num = get_hash_table($company_id);
					$data['company_id'] = $company_id;
					$data['create_time'] = date("Y-m-d H:i:s");
					if(Db::name('visitor')->insert($data)){
						$this->success('保存成功','/index/visitor/index');					
					}else{
						$this->error('保存失败');					
					}					

            }
        }
    }


    /**
     * 编辑访客记录
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $company_id = Session::get('admin_id');
        $num = get_hash_table($company_id);
        $where['company_id'] = $company_id;
        $member_list = Db::name('company_member_'.$num)->where($where)->paginate(10);
        $visit_type_list = ['面试','客户','亲友','其他'];
        $visitor = Db::name('visitor')->find($id);
        //var_dump($visitor);die;
        return $this->fetch('edit', ['visitor' => $visitor,'member_list' => $member_list,'visit_type_list' => $visit_type_list]);
    }

    /**
     * 更新访客记录
     * @param $id
     */
    public function update($id)
    {
        if ($this->request->isPost()) {
            $data            = $this->request->post();
            $validate_result = $this->validate($data, 'Visitor');

            if ($validate_result !== true) {
                $this->error($validate_result);
            } else {

                //$company_id = Session::get('admin_id');
                //$num = get_hash_table($company_id);
                // $user = Db::name('company_member_'.$num)->find($id);
                // Db::table('think_user')->where('id', 1)->update(['name' => 'thinkphp']);
                // Db::table('think_user')->update($data);


                if (Db::name('visitor')->update($data) !== false) {
                    $this->success('更新成功','/index/visitor');
                } else {
                    $this->error('更新失败');
                }
            }
        }
    }


    /**
     * 删除用户
     * @param $id
     */
    public function delete($id)
    {
        if (Db::name('visitor')->delete($id)) {
            $this->success('删除成功','/index/visitor');
        } else {
            $this->error('删除失败');
        }
    }
	
	
    /**
     * 导入访客记录
     *
     */
    public function import(){
		return $this->fetch();
    }	

}
