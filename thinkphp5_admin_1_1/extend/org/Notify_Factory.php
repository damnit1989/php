<?php
namespace org;

use org\Notify;


/**
* 通知工厂类
*
*/
class Notify_Factory{
	
	private $_notify_obj = [];

	
	/**
	* 执行发送
	*/
	public function doSend(){
		if(!empty($this->_notify_obj)){
			foreach($this->_notify_obj as $key => $val){
				$val->send();
			}
		}
	}


	/**
	* 添加通知对象到通知对象数组中
	*/
	public function addNotifyObj(Notify $notify){
		$this->_notify_obj[] = $notify;
	}
}

