<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {

//=========================== FUNCTION OF SUB_CATEGORY: START ===========================
	public function list_all_sub_category()
	{
		$arr_sub_category = $this->db->get('category')->result_array();
		if( ! empty($arr_sub_category)) {
			foreach ($arr_sub_category as &$item) {
				$item['super_categoryName'] = $this->get_super_category_name_by_id($item['super_categoryId']);
			}
		}

		return $arr_sub_category;
	}

	public function has_duplicate_sub_category_name($sub_category_name, $id = '')
	{
		if ($id != '') {
			$this->db->where('id !=', $id);
		}

		$this->db->where('category_name', $sub_category_name);
		$num = $this->db->get('category')->num_rows();
		return $num > 0 ? true : false;
	}

	public function insert_sub_category($arr_data)
	{
		return $this->db->insert('category', $arr_data);
	}

	public function has_sub_category_exist_by_id($sub_category_id)
	{
		$this->db->where('id', $sub_category_id);
		$num = $this->db->get('category')->num_rows();
		return $num > 0 ? true : false;
	}

	public function get_sub_category_info($sub_category_id)
	{
		$this->db->where('id', $sub_category_id);
		return $this->db->get('category')->result_array()[0];
	}
//=========================== FUNCTION OF SUB_CATEGORY: END ===========================

//=========================== FUNCTION OF SUPER_CATEGORY: START ===========================
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

	public function insert_super_category($arr_data)
	{
		return $this->db->insert('super_category', $arr_data);
	}

	public function has_duplicate_super_category_name($super_category_name, $id = '')
	{
		if ($id != '') {
			$this->db->where('id !=', $id);
		}

		$this->db->where('super_categoryName', $super_category_name);
		$num = $this->db->get('super_category')->num_rows();
		return $num > 0 ? true : false;
	}

	public function has_super_category_exist_by_id($super_category_id)
	{
		$this->db->where('id', $super_category_id);
		$num = $this->db->get('super_category')->num_rows();
		return $num > 0 ? true : false;
	}

	public function get_super_category_info($super_category_id)
	{
		$this->db->where('id', $super_category_id);
		return $this->db->get('super_category')->result_array()[0];
	}

	public function update_super_category($super_category_id, $arr_data)
	{
		$this->db->where('id', $super_category_id);
		return $this->db->update('super_category', $arr_data);
	}

	public function delete_super_category($super_category_id)
	{
		$this->db->where('id', $super_category_id);
		return $this->db->delete('super_category');
	}

//=========================== FUNCTION OF SUPER_CATEGORY: END ===========================
}

