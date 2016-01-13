<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class customer_model extends CI_Model {

	public function checkUsername($username,$id='')
	{
		if (empty($id)) {
			$sql="select * from customer where username = '$username'";
		} else {
			$sql="select * from customer where username = '$username' and id !=".$id;
		}
		$query= $this->db->query($sql);
		$rs = $query->num_rows();
		return $rs ? true : false;
	}

	public function insert($array)
	{
		return $this->db->insert('customer', $array);
	}























	public function listAll()
	{
		$list = $this->db->select("select * from account");
		return $list;
	}

	public function del($del_id)
	{
		return $this->db->del('account', $del_id);
	}

	public function checkLevel($level)
	{
		return ($level == 1 || $level == 2) ? true : false;
	}

	public function getLevelbyID($id)
	{
		$list = $this->db->select("select level from account where id=".$id);
		foreach ($list as $row) {
			foreach ($row as $v) {
				$rs=$v;
			}
		}
		return (int) $rs;
	}

	public function get_level()
	{
		$rs = array(1,2);
		return $rs;
	}



	public function getAccountbyID($id)
	{
		$info = $this->db->select("select * from account where id=".$id);
		return $info;
	}

	public function getAvatarbyId($id)
	{
		$info = $this->db->select("select avatar from account where id=".$id);
		foreach ($info as $row) {
			return $row['avatar'];
		}; 
	}

	public function getUsernamebyId($id)
	{
		$info = $this->db->select("select username from account where id=".$id);
		foreach ($info as $row) {

			return $row['username'];
		}; 
	}

	public function update($id, $array)
	{
		return $this->db->update('account',$id, $array);
	}

}
