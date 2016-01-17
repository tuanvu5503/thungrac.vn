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
		$this->db->select('category_name');
		$this->db->where('product.id', $product_id);
		$this->db->join('category', 'product.category_id = category.id', 'left');

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

	public function getProductNamebyId($id)
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

	public function getProductbyID($product_id)
	{
		$list = $this->db->query("select * from product where id=".$product_id);
		return $list->result_array();
	}

	public function check_product_by_id($product_id)
	{
		$this->db->where('id', $product_id);
		$num = $this->db->get($this->table)->num_rows();
		return $num > 0 ? true : false;
	}

	public function getAvatar($id)
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

	public function update($id, $array)
	{
		$this->db->where('id', $id);
		return $this->db->update($this->table, $array);
	}



















	public function all_product()
	{
		$all_product = $this->db->select("select * from product p, category c where p.category_id = c.id");
		return $all_product;
	}

	

	public function checkProductName($product_name, $id='')
	{
		if (isset($id)) {
			$id  = (int) $id;
			$sql = "select count(*) from product where product_name = '$product_name' and id !=".$id;
		} else {
			$sql = "select count(*) from product where product_name = '$product_name'";
		}
		$rs = $this->db->get_row($sql);
		return $rs ? true : false;
	}

	public function get_category()
	{
		return $this->db->query('select * from category')->result_array();
	}

	public function getDetail_image($id)
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

	public function insert($table, $array)
	{
		return $this->db->insert($table, $array);
	}

	


	
	
}

