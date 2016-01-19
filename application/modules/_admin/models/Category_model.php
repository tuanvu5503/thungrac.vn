<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {

	public function checkCategory($id)
	{
		$this->db->where('id', $id);
		$num = $this->db->get('category')->num_rows();
		return $num > 0 ? true : false;
	}

	public function list_all_sub_category()
	{
		$arr_sub_category = $this->db->get('category')->result_array();
		if( ! empty($arr_sub_category)) {
			foreach ($arr_sub_category as &$item) {
				$item['super_categoryName'] = $this->get_super_category_name_by_id($item['super_categoryId']);
				// unset($item);
				// var_dump($item['super_categoryName']); die;
			}
		}

		return $arr_sub_category;
	}

	public function list_all_super_category()
	{
		return $this->db->get('super_category')->result_array();
	}

	public function get_super_category_name_by_id($super_categoryId) 
	{
		$this->db->select('super_categoryName');
		$this->db->where('id', $super_categoryId);
		return $this->db->get('super_category')->result_array()[0]['super_categoryName'];
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

