<?php 

/**
* 模型基类
*
*/
abstract class Model{
	protected  $db;
	
	public function __construct(){

		$dsn = 'mysql:'.DB_NAME.';host='.DB_HOST;
		try{
			//pdo模式
			// $this->db = new PDO($dsn,DB_USER,DB_PASS);
			
			//mysqli模式
			$this->db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		}catch(PDOException $e){
			die("con't connect to the datebase");
		}
		
		return TRUE;
	}
}