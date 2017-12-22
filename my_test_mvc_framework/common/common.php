<?php 

function parse_uri(){
	$real_uri = preg_replace('~^'.APP_FOLDER.'~','',$_SERVER['REQUEST_URI']);
	$real_uri = $_SERVER['REQUEST_URI'];
	$uri_array = explode('/',$real_uri);
	if(empty($uri_array[0])){
		array_shift($uri_array);
	}
	
	if(empty($uri_array[count($uri_array)-1])){
		array_pop($uri_array);
	}
	return $uri_array;
}

function get_controller_classname(&$uri_array){
	$controller = array_shift($uri_array);
	return ucfirst($controller);
}

function get_action_name(&$uri_array){
	if(!empty($uri_array[0])){
		return $uri_array[0];
	}else{
		return 'index';
	}
}

function remove_unwanted_slashes($dirty_path){
	return preg_replace('~(?<!:)//~','/',$dirty_path);
}

function class_autoloader($class_name){
	// echo SYS_PATH;
	$fname = strtolower($class_name);
	$possible_locations = array(
		SYS_PATH.'/models/class.'.$fname.'.inc.php',
		SYS_PATH.'/controllers/class.'.$fname.'.inc.php',
		SYS_PATH.'/core/class.'.$fname.'.inc.php',
	);
	
	foreach($possible_locations as $loc){
		if(file_exists($loc)){
			require_once $loc;
			return true;
		}
	}
	
	throw new Exception("<h1>Class $class_name is not found</h1>");
}
