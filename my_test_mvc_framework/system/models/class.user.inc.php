<?php 


class User extends Model{


	public function getUserList(){
		$sql = "select * from user_1";
		foreach($this->db->query($sql) as $row){        // 输出结果集中的数据
			print($row['id']);
			print($row['name']);
		}
		return $result;
	}
}