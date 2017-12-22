<?php 

/**
* 控制器基类
*
*/
abstract class Controller{
	
	public $actions = array(),$model;
	protected static $nonce = NULL;
	
	public function __construct($options){
		if(!is_array($options)){
			throw new Exception('no options were supplied for the rooe');
		}
	}

	protected function generate_nonce(){
		return 'tempnonce';
	}
	
	protected function sanitize($dirty){
		return htmlentities(strip_tags($dirty),ENT_QUOTES);
	}
	
	abstract public function get_title();
	abstract public function output_view();
}