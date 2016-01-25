<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model','Product');
        $this->load->library('cart');
    }
    public function index()
    {
        $this->load->helper('convert');
        $all_superCategory = $this->Product->all_superCategory();
        $products['SẢN PHẨM MỚI'] = $this->Product->new_product();
        foreach ($all_superCategory as $row) {
            $products[$row['super_categoryName']] = $this->Product->listProductbySuperId($row['id']);
        }

        $data['products'] = $products;
        $data['title'] = "Tất cả sản phẩm";
        $subView = "allProduct_layout";
        $this->build($subView, $data);
    }

    public function view_detail()
    {
        if ($this->uri->segment(5))
        {
            $id = explode('-', $this->uri->segment(5));
            $id = (int) end($id);
            
            $data['info'] = $this->Product->find_productbyid($id);
            if (count($data['info']) == 0)
            {
                $data['title'] = "Xem chi tiết sản phẩm";
                $data['error'] = "Không tìm thấy sản phẩm";
                $this->load->view('/product/error', $data);
                die;
            }
            $data['title'] = "Xem chi tiết sản phẩm";
            $subView = "/product/view_detail";
            $this->build($subView, $data);
        } else {
            $this->load->view('404-temp');
        }
    }

    public function build($subView, $arr_data)
    {

        //==================== DATA FOR MENU: START ====================
        $all_superCategory = $this->Product->all_superCategory();
        $products['SẢN PHẨM MỚI'] = $this->Product->new_product();
        foreach ($all_superCategory as $row) {
            $menus[$row['super_categoryName']] = $this->Product->getMenu($row['id']);
        }
        $data['menus'] = $menus;
        $data['menu'] = $this->Product->listCategory();
        //==================== DATA FOR MENU: END ====================

        $data['title']   = $arr_data['title'];
        $data['subView'] = $subView;
        $data['subData'] = $arr_data;
        $this->load->view('main_layout', $data);
    }

}
