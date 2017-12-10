<?php 

$redis = new Redis();
$redis->connect('127.0.0.1',6379);

$task = array(
	'do' => 'test',
	'data' => 'hello world'
);
#$redis->publish('take_queue',serialize($task)); 
$redis->publish('test1',serialize($task)); 
