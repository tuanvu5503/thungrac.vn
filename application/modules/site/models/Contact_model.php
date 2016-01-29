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
}

