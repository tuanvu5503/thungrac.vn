<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productmodel extends CI_Model {
	
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














	public function limit_product($start,$limit,$key='')
	{
		if ($key != '') {
			$sql="select c.category_name, p.* from product p, category c where p.category_id = c.id and product_name like '%$key%' order by p.id desc limit $start, $limit";
		} else {
			$sql="select c.category_name, p.* from product p, category c where p.category_id = c.id ORDER BY RAND() limit $start, $limit";
		}
		$info = $this->db->select($sql);
		return $info;
	}

	public function limit_ProductbyCategoryId($category_id,$start='', $limit='')
	{
		if ($start == '' && $limit == '') {
			$sql="select * from product where category_id =".$category_id;
		} else {
			$sql="select * from product where category_id =".$category_id." limit $start, $limit";
		}
		// echo $sql; die;
		$info = $this->db->select($sql);
		return $info;
	}

	public function total_record_product($key='')
	{
		if (isset($key)) {
			$sql="select count(*) from product where product_name like '%$key%' ";
		} else {
			$sql="select count(*) from product";
		}
		// $info = $this->db->get_row($sql);
		return 20;
	}

	public function search($product_name, $price, $category, $start=0, $limit=0)
	{
		$product_name=filter_var($product_name, FILTER_SANITIZE_STRING);
		$category=filter_var($category, FILTER_SANITIZE_STRING);
		if ($start == 0 && $limit == 0){
			if (empty($price) && empty($product_name) && empty($category)) {
				$search = $this->db->select("select * from product ");
			} elseif (!empty($price) && empty($product_name) && empty($category)) {
				$search = $this->db->select("select * from product where price <= '$price'");
			} elseif (!empty($category) && empty($product_name) && empty($price)) {
				$search = $this->db->select("select * from product where category_id = '$category'");
			} elseif (!empty($product_name) && empty($price) && empty($category)) {
				$search = $this->db->select("select * from product where product_name like '%$product_name%'");
			} elseif(!empty($price) && !empty($product_name) && empty($category)) {
				$search = $this->db->select("select * from product where product_name like '%$product_name%' and price <= '$price'");
			} elseif(empty($price) && !empty($product_name) && !empty($category)) {
				$search = $this->db->select("select * from product where product_name like '%$product_name%' and category_id = '$category'");
			} elseif(!empty($price) && empty($product_name) && !empty($category)) {
				$search = $this->db->select("select * from product where price <= '$price' and category_id = '$category'");
			} else{
				$search = $this->db->select("select * from product where product_name like '%$product_name%' and price <= '$price' and category_id = '$category'");
			}
		} else {
			if (empty($price) && empty($product_name) && empty($category)) {
				$search = $this->db->select("select * from product order by id desc limit $start, $limit");
			} elseif (!empty($price) && empty($product_name) && empty($category)) {
				$search = $this->db->select("select * from product where price <= '$price' order by id desc limit $start, $limit");
			} elseif (!empty($category) && empty($product_name) && empty($price)) {
				$search = $this->db->select("select * from product where category_id = '$category' order by id desc limit $start, $limit");
			} elseif (!empty($product_name) && empty($price) && empty($category)) {
				$search = $this->db->select("select * from product where product_name like '%$product_name%' order by id desc limit $start, $limit");
			} elseif(!empty($price) && !empty($product_name) && empty($category)) {
				$search = $this->db->select("select * from product where product_name like '%$product_name%' and price <= '$price' order by id desc limit $start, $limit");
			} elseif(empty($price) && !empty($product_name) && !empty($category)) {
				$search = $this->db->select("select * from product where product_name like '%$product_name%' and category_id = '$category' order by id desc limit $start, $limit");
			} elseif(!empty($price) && empty($product_name) && !empty($category)) {
				$search = $this->db->select("select * from product where price <= '$price' and category_id = '$category' order by id desc limit $start, $limit");
			}else{
				$search = $this->db->select("select * from product where product_name like '%$product_name%' and price <= '$price' and category_id = '$category' order by id desc limit $start, $limit");
			}
		}
		return $search;
	}

	public function listCategory()
	{
		$info = $this->db->query("select * from category");
		return $info->result_array();
	}

	public function checkCategorybyId($category_id)
	{
		$sql="select count(*) from category where id =".$category_id;
		$rs = $this->db->get_row($sql);
		return $rs ? true : false;
	}

	public function getCategoryNamebyCategoryId($category_id)
	{
		$sql = "select category_name from category where id = ".$category_id;
		$info = $this->db->select($sql);
		foreach ($info as $value) {
			return $value['category_name'];
		}
	}
}

