<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Productmodel');
        $this->load->library('cart');
    }
    public function index()
    {
        $this->load->helper('convert');
        $all_superCategory = $this->Productmodel->all_superCategory();

        $products['SẢN PHẨM MỚI'] = $this->Productmodel->new_product();
        foreach ($all_superCategory as $row) {
            $products[$row['super_categoryName']] = $this->Productmodel->listProductbySuperId($row['id']);
            $menus[$row['super_categoryName']] = $this->Productmodel->getMenu($row['id']);
        }

        $data['products'] = $products;
        $data['menus'] = $menus;
        
        $data['title'] = "Thungrac Online";
        $data['subView'] = "allProduct_layout";
        $data['menu'] = $this->Productmodel->listCategory();
        $data['subData'] = $data;

        $this->load->view('main_layout', $data);
    }

    public function view_detail()
    {
        if ($this->uri->segment(5))
        {
            $id = explode('-', $this->uri->segment(5));
            $id = (int) end($id);
            
            $category_id=$this->Productmodel->get_categoryid_by_productid($id);
            $data['relative_product'] = $this->Productmodel->get_categorybyid($category_id);
            $data['info'] = $this->Productmodel->find_productbyid($id);
            if (count($data['info']) == 0)
            {
                $data['title'] = "View product";
                $data['error'] = "Không tìm thấy sản phẩm";
                $this->load->view('/product/error', $data);
                die;
            }
            $all_superCategory = $this->Productmodel->all_superCategory();

            foreach ($all_superCategory as $row) {
                $menus[$row['super_categoryName']] = $this->Productmodel->getMenu($row['id']);
            }

            $data['menus'] = $menus;
            $data['menu'] = $this->Productmodel->listCategory();
            
            $data['title'] = "View product";
            $this->load->view('/product/view_detail', $data);
        } else {
            $this->load->view('404-temp');
        }
    }
}
