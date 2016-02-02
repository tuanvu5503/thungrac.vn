<?php 

	function set_notice($status_name, $status, $content, $alert_time=7000) {
		$data['status'] = $status;
		$data['content'] = $content;
		$data['alert_time'] = $alert_time;
		
		$CI =& get_instance();
		$CI->session->set_flashdata($status_name, $data);
	}

	function build_site($subView, $arr_data)
	{
		$CI =& get_instance();

		$CI->load->helper('My_url');
		$CI->load->helper('Validation');
        $CI->load->model('Product_model','Product');

        //==================== DATA FOR MENU: START ====================
        $all_superCategory = $CI->Product->all_superCategory();
        $products['SẢN PHẨM MỚI'] = $CI->Product->new_product();
        foreach ($all_superCategory as $row) {
            $menus[$row['super_categoryName'].'|'.$row['id']] = $CI->Product->getMenu($row['id']);
        }
        $data['menus'] = $menus;
        $data['menu'] = $CI->Product->listCategory();
        //==================== DATA FOR MENU: END ====================

        $data['title']   = $arr_data['title'];
        $data['subView'] = $subView;
        $data['subData'] = $arr_data;
        $CI->load->view('main_layout', $data);
	}

?>
