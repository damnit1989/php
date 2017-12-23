<?php 

class Home extends Controller{
	public function __construct($options){
		parent::__construct($options);
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
		$view = new View('home');

		$view->title = 'index';
		$view->nonce = $this->generate_nonce();
		$view->join_action = APP_URL.'room/join';		
		$view->render();
	}
	
	public function name(){

		$static_html = STATIC_HTML."/name.html";
		
		//如果静态文件存在，则直接静态文件内容，反之，则从新生成
		if(file_exists($static_html)){
			$content = file_get_contents($static_html);
		}else{
			$view = new View('home');
			
			$view->title = $this->get_title();
			$view->nonce = $this->generate_nonce();
			$view->join_action = APP_URL.'room/join';
			
			//讲缓冲区的内容存入到静态html文件中
			$content = $view->render(False);
			$f = fopen($static_html,'w');
			fwrite($f,$content);
			fclose($f);
		}
		echo $content;	
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