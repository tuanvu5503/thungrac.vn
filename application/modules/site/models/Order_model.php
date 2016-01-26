<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model {
	private $table = 'order';

	public function insert($arr_data)
	{
		return $this->db->insert($this->table, $arr_data);
	}
}

