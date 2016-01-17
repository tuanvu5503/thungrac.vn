<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {

	private $table = 'category';

	public function checkCategory($id)
	{
		$this->db->where('id', $id);
		$num = $this->db->get($this->table)->num_rows();
		return $num > 0 ? true : false;
	}













	public function listAll()
	{
		$list = $this->db->select("select * from category");
		return $list;
	}

	public function getCategorybyID($category_name)
	{
		$list = $this->db->select("select * from category where id=".$category_name);
		return $list;
	}

	public function getCategoryNamebyId($id)
	{
		$info = $this->db->select("select category_name from category where id=".$id);
		foreach ($info as $row) {
			return $row['category_name'];
		}; 
	}

	public function update($id, $category_name)
	{
		$data = array('category_name' => $category_name );
		return $this->db->update('category', $id, $data);
	}

	public function del($tbl, $del_id)
	{
		return $this->db->del($tbl, $del_id);
	}

	public function insert($array)
	{
		return $this->db->insert('category', $array);
	}

	
}

