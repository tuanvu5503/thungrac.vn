<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model {

	private $table = 'order';

	public function total_record_order()
	{
		return $this->db->get($this->table)->num_rows();;
	}

	public function limit_order($start, $limit)
	{
		$this->db->order_by('order_datetime', 'desc');
		return $this->db->get($this->table, $limit, $start)->result_array();
	}

	public function has_order_exist_by_id($id)
	{
		$this->db->where('id', $id);
		$num_rows = $this->db->get($this->table)->num_rows();
		return $num_rows > 0 ? TRUE : FALSE;
	}

	public function delete_order_by_id($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete($this->table);
	}

	public function approve_order_by_id($id)
	{
		$this->db->where('id', $id);
		return $this->db->update($this->table, array('status' => 1));
	}

	public function total_record_un_approval_order()
	{
		$this->db->where('status', 0);
		return $this->db->get($this->table)->num_rows();
	}
	
}

