<?php
namespace app\index\controller;

use app\common\controller\HomeBase;
use think\Db;
use think\Session;

class Log extends HomeBase
{
    public function index()
    {
        $company_id = Session::get('admin_id');
		$list = Db::name('action_log')->where('company_id',$company_id)->order('create_time','desc')->paginate(10);

		$page = $list->render();
		$this->assign('list', $list);
		$this->assign('page', $page);		

		// $this->view->engine->layout(true);
        return $this->fetch();
    }

}
