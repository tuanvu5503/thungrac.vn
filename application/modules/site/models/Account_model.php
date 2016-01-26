<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_model extends CI_Model {
 	private $table = 'account';

	public function get_list_email_admin()
	{
		$this->db->select('email');
		$rs = $this->db->get($this->table)->result_array();
		$arr_email_admin = array();
		foreach ($rs as $key => $item) {
			$arr_email_admin[] = $item['email'];
		}

		return $arr_email_admin;
	}

}
