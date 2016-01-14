<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	private $table = 'account';

	public function checklogin($username, $password)
	{
		$sql="select count(*) from user where username = '$username' and password = '$password'";
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$rs = $this->db->get($this->table)->result_array();
		return count($rs) > 0 ? true : false;
	}

	public function getInfo($username)
	{
		$this->db->where('username', $username);
		$info = $this->db->get($this->table)->result_array();
		foreach ($info as $value) {
            $rs = $value;
        }
        
		return $rs;
	}
	
}

