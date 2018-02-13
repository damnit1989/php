<?php
namespace app\behavior;
 
use think\Controller;
use think\Db;
use think\Session;


/**
 * 日志记录事件类
 * Class AdminBase
 * @package app\common\controller
 */
class RecordLog extends Controller{
    use \traits\controller\Jump;//类里面引入jump;类

    public function run(&$content){
	
		$log_data = [
			'company_id' => Session::get('admin_id'),
			'username' => Session::get('admin_name'),
			'content' => $content,
			'ip' => $this->request->ip(),
			'create_time' => date("Y-m-d H:i:s")
		];		
		Db::name('action_log')->insert($log_data);
	}
}