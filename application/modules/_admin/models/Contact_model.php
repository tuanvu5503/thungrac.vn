<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_model extends CI_Model {

	private $table = 'contact';

	public function get_contact()
	{
		$id = $this->db->select_max('id')->get($this->table)->row()->id;
		$this->db->where('id', $id);
		$rs = $this->db->get($this->table)->result_array();
		return empty($rs) ? null : $rs[0]['content'];
	}

	public function update($arr_data)
	{
		$id = $this->db->select_max('id')->get($this->table)->row()->id;
		
		if ($id === NULL) {
			return $this->db->insert($this->table, $arr_data);
		}

		$this->db->where('id', $id);
		return $this->db->update($this->table, $arr_data);
	}
	
}

