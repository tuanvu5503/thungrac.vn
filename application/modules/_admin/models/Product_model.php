<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

	private $table = 'product';

	public function limit_product($start,$limit,$key='')
	{
		if (isset($key)) {
			$sql="select * from product where product_name like '%$key%'  order by id desc limit $start, $limit";
		} else {
			$sql="select * from product order by id desc limit $start, $limit";
		}
		$info = $this->db->query($sql);
		return $info->result_array();
	}

	public function limit_product_in_super_category($super_category_id, $start, $limit)
	{
		$this->db->join('Category', $this->table.'.category_id = Category.id', 'left');

		$this->db->select($this->table.'.*');
		$this->db->where('Category.super_categoryId', $super_category_id);
		return $this->db->get($this->table, $limit, $start)->result_array();
	}

	public function total_record_product($key='')
	{
		if (isset($key)) {
			$sql="select * from product where product_name like '%$key%' ";
		} else {
			$sql="select * from product";
		}
		$info = $this->db->query($sql);
		$row  = count($info->result_array());
		return $row;
	}

	public function get_category_name_by_id($product_id)
	{
		$this->db->join('category', 'product.category_id = category.id', 'left');
		$this->db->select('category.category_name');
		$this->db->where('product.id', $product_id);

		$query = $this->db->get('product');
		$arr_category_name = $query->result_array()[0];
		foreach ($arr_category_name as $value) {
			return $value;
		}
	}

	public function removeImage($del_id)
	{
		$detail_image='';
		$img = $this->db->query('select image, detail_image from product where id = '.$del_id);
		foreach ($img->result_array() as $row) {
			$detail_image=$row['detail_image'];
			@unlink('public/img/products/'.$row['image']);
		}
		$detail_image=explode('|',$detail_image);

		for ($i = 0; $i < count($detail_image); $i++) {
			@unlink('public/img/detail_img/'.$detail_image[$i]);
		}
	}

	public function get_product_name_by_id($id)
	{
		$info = $this->db->query("select product_name from product where id=".$id);
		foreach ($info->result_array() as $row) {

			return $row['product_name'];
		}; 
	}

	public function del_product_by_id($del_id)
	{
		return $this->db->delete($this->table,  array('id' => $del_id));
	}

	public function get_product_by_id($product_id)
	{
		$this->db->where('id', $product_id);
		return $this->db->get($this->table)->result_array();
	}

	public function check_product_by_id($product_id)
	{
		$this->db->where('id', $product_id);
		$num = $this->db->get($this->table)->num_rows();
		return $num > 0 ? true : false;
	}

	public function get_avatar($id)
	{
		$this->db->select('image');
		$this->db->where('id', $id);
		$image = $this->db->get($this->table)->result_array();
		foreach ($image as $row) {
			foreach ($row as $val) {
				$rs = $val;
			}
		}
		return $rs;
	}

	public function checkproduct_name($product_name, $id='')
	{
		if ($id != '') {
			$this->db->where('id !=', $id);
		}
		$this->db->where('product_name', $product_name);
		$num = $this->db->get($this->table)->num_rows();
		return $num > 0 ? true : false;
	}

	public function update($id, $arr_data)
	{
		$this->db->where('id', $id);
		return $this->db->update($this->table, $arr_data);
	}

	public function has_exist_product_name($product_name, $product_id='')
	{
		if ($product_id != '') {
			$this->db->where('id !=', $product_id);
		}

		$this->db->where('product_name', $product_name);
		$num = $this->db->get($this->table)->num_rows();
		return $num > 0 ? TRUE : FALSE;
	}

	public function insert($arr_data)
	{
		return $this->db->insert($this->table, $arr_data);
	}

	public function get_detail_image($id)
	{
		$this->db->select('detail_image');
		$this->db->where('id', $id);
		$list = $this->db->get($this->table)->result_array();
		foreach ($list as $row) {
			foreach ($row as $val) {
				$rs = $val;
			}
		}
		return $rs;
	}

	public function total_record_product_in_super_category($super_category_id)
	{
		$this->db->join('Category', $this->table.'.category_id = Category.id', 'left');

		$this->db->where('Category.super_categoryId', $super_category_id);
		return $this->db->get($this->table)->num_rows();
	}
	
}

