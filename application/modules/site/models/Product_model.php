<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {
	private $table = 'product';
	
	public function new_product()
	{
		$new_product = $this->db->query("select c.category_name, p.* from category c, product p where p.category_id = c.id order by id desc limit 8");
		return $new_product->result_array();
	}

	public function all_product()
	{
		$all_product = $this->db->query("select * from product");
		return $all_product->result_array();
	}

	public function all_superCategory()
	{
		$all_superCategory = $this->db->query("select * from super_category");
		return $all_superCategory->result_array();
	}

	public function listProductbySuperId($id)
	{
		$list = $this->db->query("select c.category_name, p.* from category c, product p where c.super_categoryID = ".$id." and c.id = p.category_id");
		return $list->result_array();
	}

	public function getMenu($id)
	{
		$list = $this->db->query("select * from category where super_categoryID =".$id);
		return $list->result_array();
	}

	public function get_categoryid_by_productid($id)
	{
		$info = $this->db->query("select category_id from product where id = '$id'");
		$categoryID = $info->row_array(); 

		$categoryID = (int) $categoryID['category_id'];
		return $categoryID;	
	}

	public function get_categorybyid($category_id)
	{
		$category_id=filter_var($category_id, FILTER_SANITIZE_STRING);
		$info = $this->db->query("select * from product where category_id = '$category_id'");
		return $info->result_array();
	}

	public function find_productbyid($id)
	{
		$id=filter_var($id, FILTER_SANITIZE_STRING);
		$info = $this->db->query("select * from product where id = '$id'");
		return $info->result_array();
	}

	public function check_product_exist($id)
	{
		$this->db->where('id', $id);
		$num = $this->db->get('product')->num_rows();
		return $num > 0 ? TRUE : FALSE;
	}

	public function get_product_info_by_id($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('product');
		return $query->row_array();
	}

	public function info_of_order_product_array($order_product_info)
	{
		$info_of_product = array();
		$info_of_order_product = array();
		foreach ($order_product_info as $value) {
			$info_of_product =  $this->get_product_info_by_id($value['id']);
			$info_of_product['order_qty'] = $value['order_qty']; // Add order_qty field
			$info_of_product['price_x_order_qty'] = $info_of_product['price'] * $value['order_qty']; // Add price_x_order_qty field

			$info_of_order_product[] = $info_of_product;
		}
		
		return $info_of_order_product;
	}

	public function get_product_name_by_id($product_id)
	{
		$this->db->where('id', $product_id);
		return $this->db->get('product')->result_array()[0]['product_name'];
	}

	public function listCategory()
	{
		$info = $this->db->query("select * from category");
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

	public function total_record_product_in_super_category($super_category_id)
	{
		$this->db->join('category', $this->table.'.category_id = category.id', 'left');

		$this->db->where('category.super_categoryId', $super_category_id);
		return $this->db->get($this->table)->num_rows();
	}

	public function total_record_product_in_sub_category($sub_category_id)
	{
		$this->db->where('category_id', $sub_category_id);
		return $this->db->get($this->table)->num_rows();
	}


	public function limit_product_in_super_category($super_category_id, $start, $limit)
	{
		$this->db->join('category', $this->table.'.category_id = category.id', 'left');

		$this->db->select($this->table.'.*');
		$this->db->where('category.super_categoryId', $super_category_id);
		return $this->db->get($this->table, $limit, $start)->result_array();
	}

	public function limit_product_in_sub_category($sub_category_id, $start, $limit)
	{
		$this->db->where('category_id', $sub_category_id);
		return $this->db->get($this->table, $limit, $start)->result_array();
	}
}

