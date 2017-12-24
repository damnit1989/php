<?php 

function call_back(){
	echo 'good';
	header("Content-type:text/html;charset=utf-8");
}
ob_start('call_back');

echo 'this is a test';
