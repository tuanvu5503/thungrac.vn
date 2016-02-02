<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acticle_model extends CI_Model {
	private $table = 'acticle';

	public function insert($arr_data)
	{
		return $this->db->insert($this->table, $arr_data);
	}

	public function update($id, $arr_data)
	{
		$this->db->where('id', $id);
		return $this->db->update($this->table, $arr_data);
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

	public function get_acticle_name_by_id($id)
	{
		$this->db->where('id', $id);
		$rs = $this->db->get($this->table, 1, 0)->result_array()[0];
		return $rs['acticle_name'];
	}

	public function delete_acticle_by_id($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete($this->table);
	}

	public function total_record_acticle()
	{
		return $this->db->get($this->table)->num_rows();
	}

	public function limit_acticle($start, $limit)
	{
		$this->db->order_by('id', 'desc');
		return $this->db->get($this->table, $limit, $start)->result_array();
	}
}