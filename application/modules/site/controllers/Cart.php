<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model','Product');
        $this->load->library('cart');
    }
    public function add_cart()
    {
        $this->load->helper('convert');

        $id = $this->input->post('id');
        $is_product_existed = $this->Product->check_product_exist($id);
        
        if (is_numeric($id) && $is_product_existed) {
            $product_info = $this->Product->get_product_info_by_id($id);
            
            $data = array(
                'id'      => $product_info['id'],
                'qty'     => 1,
                'price'   => $product_info['price'],
                'name'    => utf8convert($product_info['product_name']),
                'options' => array('image' => $product_info['image'])
                );

            $ok = $this->cart->insert($data);
            if ($ok) {
                $rs['status'] = true;
            } else {
                $rs['status'] = false;
            }

            echo json_encode($rs);
        }
    }
    public function view_order()
    {
        $cart = $this->cart->contents();
        if ( ! empty($cart) ){

            //=========================== START: INFOMATION OF ORDER PRODUCT ===========================
            $order_product_id = array(); // Array ID of order product
            foreach ($this->cart->contents() as $item) {
                $info = array('id' => $item['id'], 'order_qty' => $item['qty'] );
                $order_product_info[] = $info;
            }
            $info_of_order_product_array = $this->Product->info_of_order_product_array($order_product_info);
            //=========================== END: INFOMATION OF ORDER PRODUCT ===========================

            //=========================== START: CONTENTS OF MENU ===========================
            $all_superCategory = $this->Product->all_superCategory();
            foreach ($all_superCategory as $row) {
                $menus[$row['super_categoryName']] = $this->Product->getMenu($row['id']);
            }
            //=========================== END: CONTENTS OF MENU ===========================

            
            $data['info_of_order_product_array'] = $info_of_order_product_array;
            $data['menus'] = $menus;
            $data['title'] = "Đặt hàng";
            $data['subView'] = "/cart/view_order_layout";
            $data['menu'] = $this->Product->listCategory();
           

            $data['subData'] = $data;

            $this->load->view('main_layout', $data);
        } else {
            $content = 'Chưa có sản phẩm nào trong giỏ hàng.';
            set_notice('order', FAILED_STATUS, $content);
            header("location:".base_url());
        }
    }

    public function do_order()
    {
        $this->load->model('Order_model', 'Order');
        if (isset($_POST['phone'])) {
            $this->load->helper('validation');
            
            $customer_name = trim_input($_POST['customer_name']);
            $phone = trim_input($_POST['phone']);
            
            $arr_product_id = $_POST['product_id'];
            $arr_order_qty = $_POST['order_qty'];
            $error = array();

            //====================== VALIDATION: START ====================
            if ($customer_name == '') {
                $error[] = 'Tên khách hàng không được để trống.';
            }
            $regex = "/^[0-9]{9,}$/";
            if ($phone == '')  {
                $error[] = "Số điện thoại không được rỗng.";
            } elseif ( ! preg_match( $regex, $phone, $maches)) {
                $error[] = "Số điện thoại không đúng.";
            } 

            if (empty($arr_product_id)) {
                $error[] = "Không có có sản phẩm nào trong đơn hàng.";
            } else {
                foreach ($arr_product_id as $key => $value) {
                    if( ! $this->Product->check_product_exist($value)) {
                        $error[] = 'Sản phẩm có mã <span style="color:red;">'.$value.'</span> không có trong hệ thống.';
                    } else {
                        if ($arr_order_qty[$key] <= 0) {
                            $product_name = $this->Product->get_product_name_by_id($arr_product_id[$key]);
                            $error[] = 'Số lượng sản phẩm <span style="color:red;">'.$product_name.'</span> không thể bằng '.'<span style="color:red;">'.$arr_order_qty[$key].'</span>';
                        }
                    }
                }
            }
            //====================== VALIDATION: END ======================
            
            if (count($error) > 0) {
                set_notice('status', FAILED_STATUS , $error, 15000);
                header("location:".base_url()."index.php/site/cart/view_order");
            } else {
                $data_insert['product_id_and_qty'] = '';
                for ($i=0; $i<count($arr_product_id); $i++) {
                    $data_insert['product_id_and_qty'] .= $arr_product_id[$i].'-'.$arr_order_qty[$i].'|';
                }
                
                $data_insert['product_id_and_qty'] = trim($data_insert['product_id_and_qty'],'|');
                $data_insert['customer_name'] = $customer_name;
                $data_insert['phone'] = $phone;

                if ($this->Order->insert($data_insert)) {
                    $this->cart->destroy();
                    $content = '<div style="color: rgb(129, 127, 123); font-size: 16px;">'
                            .'Khách hàng: <span style="color:rgb(0, 165, 255);">'.$customer_name.'</span>'
                            .'<br> Số điện thoại: <span style="color:rgb(0, 165, 255);">'.$phone.'</span>'
                            .'<br><span style="color:rgb(129, 127, 123);"> Chúng tôi sẽ liên lạc lại cho quý khách trong thời gian sớm nhất!</span>'
                            .'</div>';

                    set_notice('order', SUCCESS_STATUS, $content);


                    $this->load->library('email');

                    $this->email->from('vu1111482@gmail.com', 'Website-thungrac');
                    $this->email->to('vu1111482@gmail.com');
                    $this->email->cc('vu111482@student.ctu.edu.vn');

                    $this->email->subject('Email Test');
                    $this->email->message('Testing the email class.');

                    $mail = $this->email->send();
                    var_dump($mail); die;


                    header("location:".base_url());
                } else {
                    header("location:".base_url()."index.php/site/cart/view_order");
                    $content = 'Có lỗi trong quá trình đặt hàng. <br> Vui lòng làm lại thực hiện lại!';
                    set_notice('order', FAILED_STATUS, $content);
                }
            }

        } else {
            header("location:".base_url());
        }
    }
}
