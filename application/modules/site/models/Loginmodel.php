<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class Loginmodel extends Model {
	
	public function checklogin($username, $password)
	{
		$sql="select count(*) from user where username = '$username' and password = '$password'";
		$num=$this->db->get_row($sql);
		return $num > 0 ? 1 : 0;
	}
}

