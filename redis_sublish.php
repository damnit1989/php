<?php 
//在命令行启动，在后台一直执行  
ini_set('default_socket_timeout',-1);
$redis = new Redis();
$redis->connect('127.0.0.1',6379);
$redis->subscribe(['take_queue','test1'],function($redis,$cha,$msg){
	switch($cha){
		case 'take_queue':
			$pub_data = unserialize($msg);
			if($pub_data['do'] == 'test'){
				#echo '<script>alert('.$pub_data['data'].')</script>';
				print_r($pub_data);
				echo $redis->get('name');
				$result = $redis->set('name','lmm');
				var_dump($result);
			}
			break;
		case 'test1':
			echo 'this is test1 message';
			break;
		default:
			break;
	}
});
