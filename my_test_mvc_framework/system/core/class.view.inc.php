<?php 

class View{
	
	protected $view = array();
	protected $vars = array();
	
	public function __construct($view = Null){
		if(!$view){
			throw new Exception('no view slug was supplied');
		}
		$this->view = $view;
	}
	
	public function __set($key,$value){
		$this->vars[$key] = $value;
	}
	
	public function render($print=TRUE){
		extract($this->vars);
		
		// $view->nonce = $this->generate_nonce();
		// $view->join_action = APP_URL.'room/join';
		if(!$print){
			ob_start();
		}
		require_once SYS_PATH.'/inc/header.inc.php';

		$view_filepath = SYS_PATH.'/views/'.$this->view.'.inc.php';
		if(!file_exists($view_filepath)){
			throw new Exception('that view file does not exist');
		}
		

		require $view_filepath;
		require_once SYS_PATH.'/inc/footer.inc.php';	
		// ob_end_flush();
		if(!$print){
			return ob_get_clean();
		}
	
	}
	
	public function error(){
		echo 'This Page is Not Found';
	}
}