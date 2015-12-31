<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('cart');
        $this->load->model('Productmodel');
        $this->load->model('customer_model', 'Customer');
        // $this->load->model('Auth');
    }
    public function regist_account()
    {
        if ($this->input->post('registion_button')){
            // var_dump($insert_data['username']);
            $error = array();
            $insert_data = array();

            $insert_data['username'] = $this->input->post("username");
            $insert_data['password'] = $this->input->post("password1");
            $password2               = $this->input->post("password2");
            $insert_data['email']    = $this->input->post("email");
            $insert_data['phone']    = $this->input->post("phone");
            // var_dump($insert_data['phone'] ); die;
            //====================== Start: Validate  ======================
            if ($insert_data['username'] == '')  {
                $error[] = "Username không được rỗng";
            } else {
                if ((preg_match('/^[A-Za-z0-9_\.]{4,30}$/', $insert_data['username'], $maches))) {
                    $username = $insert_data['username'];
                    $username =  strtolower(trim($insert_data['username']));
                    $username = filter_var($username, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
                    $username_exist = $this->Customer->checkUsername($username);
                    if($username_exist) {
                        $error[] = "Username đã tồn tại";
                    }
                } else {
                    $error[] = "Username gồm kí tự a-Z và có độ dài 4 - 30";
                }
            }

             if ((!preg_match('/^[0-9]{9,11}$/', $insert_data['phone'], $maches))) {
                $error[] = "Số điện thoại không đúng!";
             }
           
            if (!filter_var($insert_data['email'], FILTER_VALIDATE_EMAIL)) {
                $error[] = "Email không hợp lệ!";
            }

            if ($this->input->post("email") == '')  {
                $error[] = "Email không được rỗng!";
            } elseif (!filter_var($insert_data['email'], FILTER_VALIDATE_EMAIL)) {
                $error[] = "Email không hợp lệ!";
            }
           
            if (empty($insert_data['password'])) {
                $error[] = "Password không được rỗng!";
            } elseif (strlen($insert_data['password']) < 4) {
                $error[] = "Password phải nhiều hơn hoặc bằng 4 kí tự!";
            } 
            
           if ($password2 != $insert_data['password']) {
                $error[] = "Password và Password2 phải giống nhau!";
            } 

            //====================== End: Validate  ======================
            
            if (count($error) > 0) { // If error occure
                $data['error']    = $error;
                $data['re_phone'] = $this->input->post("phone");
                $data['re_email'] = $this->input->post("email");
                $data['re_username']= $insert_data['username'];

               // print_r($error); die;
                //=========================== START: CONTENTS OF MENU ===========================
                $all_superCategory = $this->Productmodel->all_superCategory();
                foreach ($all_superCategory as $row) {
                    $menus[$row['super_categoryName']] = $this->Productmodel->getMenu($row['id']);
                }
                $data['menus'] = $menus;
                $data['menu'] = $this->Productmodel->listCategory();
                //=========================== END: CONTENTS OF MENU ===========================

                $data['title'] = "Đăng ký tài khoản";
                $data['subView'] = "/Auth/regist_account_layout";
                $data['subData'] = $data;

                $this->load->view('main_layout', $data);
                // exit();
            } else {
                $insert_data['password'] = MD5($insert_data['password']);
                    // var_dump($insert_data); die;
                $rs = $this->Customer->insert($insert_data); 

                if ($rs) {
                    echo "them thanh cong";
                    // $mess = 'Bạn vừa thêm tài khoản '.$insert_data["username"];
                    // setcookie('success', $mess, time() + 1000);
                    // header('location:'.base_url.'admin/account/');
                } else {
                    echo "them that bai";
                    // header('location:'.base_url.'admin/account/add');
                }
            }


        } else { // If no $Post 
            //=========================== START: CONTENTS OF MENU ===========================
            $all_superCategory = $this->Productmodel->all_superCategory();
            foreach ($all_superCategory as $row) {
                $menus[$row['super_categoryName']] = $this->Productmodel->getMenu($row['id']);
            }
            $data['menus'] = $menus;
            $data['menu'] = $this->Productmodel->listCategory();
            //=========================== END: CONTENTS OF MENU ===========================

            $data['title'] = "Đăng ký tài khoản";
            $data['subView'] = "/Auth/regist_account_layout";
            $data['subData'] = $data;

            $this->load->view('main_layout', $data);
        }
    }
}
