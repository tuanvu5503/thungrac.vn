<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

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














	public function getProductbyID($product_id)
	{
		$list = $this->db->query("select * from product where id=".$product_id);
		var_dump( $list->result_array()); die;
		return $list->result_array();
	}


	public function all_product()
	{
		$all_product = $this->db->select("select * from product p, category c where p.category_id = c.id");
		return $all_product;
	}

	public function checkCategory($category_id)
	{
		$sql="select count(*) from category where id = ".$category_id;
		$rs = $this->db->get_row($sql);
		return $rs ? true : false;
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



	public function del($tbl, $del_id)
	{
		return $this->db->del($tbl, $del_id);
	}

	public function removeImage($del_id)
	{
		$detail_image='';
		$img = $this->db->select('select image, detail_image from product where id = '.$del_id);
		foreach ($img as $row) {
			$detail_image=$row['detail_image'];
			@unlink('public/img/products/'.$row['image']);
		}
		$detail_image=explode('|',$detail_image);

		for ($i = 0; $i < count($detail_image); $i++) {
			@unlink('public/img/detail_img/'.$detail_image[$i]);
		}
	}

	public function get_category()
	{
		return $this->db->select('select * from category');
	}

	public function insert($table, $array)
	{
		return $this->db->insert($table, $array);
	}

	public function update($id, $array)
	{
		return $this->db->update('product',$id, $array);
	}

	public function getAvatar($id)
	{
		$image = $this->db->select('select image from product where id='.$id);
		foreach ($image as $row) {
			foreach ($row as $val) {
				$rs = $val;
			}
		}
		return $rs;
	}

	public function getDetail_image($id)
	{
		$detail_image = $this->db->select('select detail_image from product where id='.$id);
		foreach ($detail_image as $row) {
			foreach ($row as $val) {
				$rs = $val;
			}
		}
		return $rs;
	}

	public function getProductNamebyId($id)
	{
		$info = $this->db->select("select product_name from product where id=".$id);
		foreach ($info as $row) {

			return $row['product_name'];
		}; 
	}
}

