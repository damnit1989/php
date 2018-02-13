<?php
namespace org;

use org\Notify;


/**
* 发送短信类
*
*/
class Sms_Notify implements Notify{
	
	private $name = 'sms';
	public function send(){
		echo "this is sms send function";
	}
}
