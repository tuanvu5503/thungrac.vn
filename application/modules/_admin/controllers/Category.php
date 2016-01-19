<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MX_Controller {
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('Product_model', 'Product');
        $this->load->model('Category_model', 'Category');
        // session_start();
        if (!isset($_SESSION['user'])) {
            header("location:".base_url()."index.php/_admin/login/");
        }
    }

    public function show_sub_category()
    {
        $data['all_cate'] = $this->Category->list_all_sub_category();

        $data['subView'] = '/category/sub_category_layout';
        $data['title']   = "Quản lý danh mục";
        $data['subData'] = $data;
        $this->load->view('/main/main_layout', $data);
    }

    public function show_super_category()
    {
        $data['all_super_category'] = $this->Category->list_all_super_category();
// var_dump($data['all_super_category']); die;
        $data['subView'] = '/category/super_category_layout';
        $data['title']   = "Quản lý danh mục";
        $data['subData'] = $data;
        $this->load->view('/main/main_layout', $data);
    }

   

}

