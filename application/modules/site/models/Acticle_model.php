<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acticle_model extends CI_Model {
 	private $table = 'acticle';

	public function get_all_acticle()
	{
		$this->db->order_by('id', 'desc');
		return $this->db->get($this->table,30)->result_array();
	}

	public function has_acticle_exist_by_id($id)
	{
		$this->db->where('id', $id);
		$num = $this->db->get($this->table)->num_rows();
		return $num > 0 ? TRUE : FALSE;
	}
	
	public function total_acticle()
	{
		$this->db->where('id', $id);
		$num = $this->db->get($this->table)->num_rows();
		return $num;
	}

	public function get_acticle_name_by_id($id)
	{
		$this->db->where('id', $id);
		return $this->db->get($this->table)->result_array()[0]['acticle_name'];
	}

	public function get_acticle_by_id($id)
	{
		$this->db->where('id', $id);
		return $this->db->get($this->table)->result_array()[0];
	}

}
