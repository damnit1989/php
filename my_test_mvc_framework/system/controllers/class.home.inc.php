<?php 

class Home extends Controller{
	public function __construct(){
		$this->user_model = new User();
		return TRUE;
	}
	
	public function get_title(){
		return 'home';
	}
	
	public function index(){
		// $arr = array(
			// 'key' => 'val',
			// 'key1' => 'val2',
		// );
		// extract($arr);
		// echo $key,$key1;
		$ret = $this->user_model->getUserList();
		print_R($ret);
	}
	
	public function name(){
		$view = new View('home');
		$view->title = $this->get_title();
		$view->nonce = $this->generate_nonce();
		$view->join_action = APP_URL.'room/join';
		$view->render();		
	}
	
	public function lmm(){
		echo 'this is a test lmm';
	}
	
	public function output_view(){
		// $view = new View('home');
		// $view->nonce = $this->generate_nonce();
		// $view->join_action = APP_URL.'room/join';
		// // echo '<br />';
		// // print_R($view);
		// $view->render();
	}
}