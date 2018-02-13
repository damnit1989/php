<?php
namespace app\index\controller;

use app\common\controller\HomeBase;
use think\Db;

class About extends HomeBase
{
    public function index()
    {
		$list = Db::name('test')->paginate(10);
		// dump($user_list);
		$page = $list->render();
		$this->assign('list', $list);
		$this->assign('page', $page);		

        return $this->fetch();
    }


}
