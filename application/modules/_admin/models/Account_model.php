<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_model extends CI_Model {

	private $table = 'account';

	public function has_account_exist_by_id($id)
	{
		$this->db->where('id', $id);
		$num_rows = $this->db->get($this->table)->num_rows();
		return $num_rows > 0 ? TRUE : FALSE;
	}

	public function get_account_info($id)
	{
		$this->db->where('id', $id);
		return $this->db->get($this->table)->result_array()[0];
	}

	public function check_username_exist($username,$id='')
	{
		if ($id != '') {
			$this->db->where('id !=', $id);
		} 
		
		$rs = $this->db->get($this->table)->num_rows;
		
		return $rs > 0 ? true : false;
	}

	public function get_avatar_by_id($id)
	{
		$this->db->where('id', $id);
		return $this->db->get($this->table)->row()->avatar;
	}

	public function update($id, $arr_data)
	{
		$this->db->where('id', $id);
		return $this->db->update($this->table, $arr_data);
	}
	
}

