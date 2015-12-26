<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Productmodel');
        $this->load->library('cart');
    }
    public function add_cart()
    {
        $this->load->helper('convert');

        $id = $this->input->post('id');
        $is_product_existed = $this->Productmodel->check_product_exist($id);
        
        if (is_numeric($id) && $is_product_existed) {
            // echo $id; die;
            $product_info = $this->Productmodel->get_product_info_by_id($id);
            
            $data = array(
                'id'      => $product_info['id'],
                'qty'     => 1,
                'price'   => $product_info['price'],
                'name'    => utf8convert($product_info['product_name']),
                'options' => array('image' => $product_info['image'])
                );

            print_r($data);
            // $ok = $this->cart->destroy($data);
            $ok = $this->cart->insert($data);
            var_dump($ok);
        }
    }
    public function view_order()
    {
        $all_superCategory = $this->Productmodel->all_superCategory();

        
        foreach ($all_superCategory as $row) {
            $menus[$row['super_categoryName']] = $this->Productmodel->getMenu($row['id']);
        }

        $data['menus'] = $menus;
        
        $data['title'] = "Đặt hàng";
        $data['subView'] = "/cart/view_order_layout";
        $data['menu'] = $this->Productmodel->listCategory();
        $data['subData'] = $data;

        $this->load->view('main_layout', $data);
    }
}
