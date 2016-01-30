<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slider_model extends CI_Model {

	private $table = 'slider';

	public function get_all_slider()
	{
		return $this->db->get($this->table)->result_array();
	}

	public function update($id, $arr_data)
	{
		$this->db->where('id', $id);
		return $this->db->update($this->table, $arr_data);
	}

	public function has_exist_slider_by_id($id)
	{
		$this->db->where('id', $id);
		$num = $this->db->get($this->table)->num_rows();

		return $num > 0 ? TRUE : FALSE;
	}

	public function get_slider_by_id($id)
	{
		$this->db->where('id', $id);
		return $this->db->get($this->table)->result_array()[0];
	}

	public function get_link_slider_by_id($id)
	{
		$this->db->where('id', $id);
		return $this->db->get($this->table)->result_array()[0]['link_slider'];
	}

	public function insert($arr_data)
	{
		return $this->db->insert($this->table, $arr_data);
	}

	public function delete_slider($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete($this->table);
	}
}

