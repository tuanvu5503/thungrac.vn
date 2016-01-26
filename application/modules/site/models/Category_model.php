<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {
 	private $sub_table = 'category';
 	private $super_table = 'super_category';

	public function get_sub_category_name($sub_category_id)
	{
		$this->db->select('category_name');
		$this->db->where('id', $sub_category_id);
		return $this->db->get($this->sub_table)->result_array()[0]['category_name'];
	}
	public function has_sub_category_exist_by_id($sub_category_id)
	{
		$this->db->where('id', $sub_category_id);
		$num = $this->db->get($this->sub_table)->num_rows();
		return $num > 0 ? true : false;
	}













	public function get_super_category_name($sub_category_id)
	{
		$this->db->join($this->super_table, $this->sub_table.'.super_categoryId = '.$this->super_table.'.id', 'left');
		$this->db->select($this->super_table.'.super_categoryName');
		$this->db->where($this->sub_table.'.id', $sub_category_id);
		return $this->db->get($this->sub_table)->result_array()[0]['super_categoryName'];
	}

	public function has_super_category_exist_by_id($super_category_id)
	{
		$this->db->where('id', $super_category_id);
		$num = $this->db->get($this->super_table)->num_rows();
		return $num > 0 ? true : false;
	}
}
