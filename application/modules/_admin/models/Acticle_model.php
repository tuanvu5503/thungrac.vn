<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acticle_model extends CI_Model {
	private $table = 'acticle';

	public function insert($arr_data)
	{
		return $this->db->insert($this->table, $arr_data);
	}

	public function list_all_acticle()
	{
		return $this->db->get($this->table)->result_array();
	}

	public function get_acticle_info($id)
	{
		$this->db->where('id', $id);
		return $this->db->get($this->table)->result_array()[0];
	}

	public function has_acticle_exist_by_id($id)
	{
		$this->db->where('id', $id);
		$num_rows = $this->db->get($this->table)->num_rows();
		return $num_rows > 0 ? TRUE : FALSE;
	}
}