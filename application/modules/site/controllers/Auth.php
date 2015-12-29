<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('cart');
        $this->load->model('Productmodel');
        // $this->load->model('Auth');
    }
    public function regist_account()
    {
        if ($this->input->post('registion_button')){
            var_dump($this->input->post("username"));
            $error = array();
            $insert_data = array();

            $insert_data['username'] = $this->input->post("username");
            $insert_data['password'] = $this->input->post("password");
            $password2              = $this->input->post("password2");
 
            //====================== Validate  ======================
            if ($this->input->post("username") == '')  {
                $error[] = "Username không được rỗng";
            } else {
                if ((preg_match('/^[A-Za-z0-9_\.]{4,30}$/', $this->input->post("username"), $maches)
                    || preg_match('/^[A-Za-z0-9_\.]{4,30}$/', $this->input->post("username"), $maches))
                    && (strlen($this->input->post("username") >= 4 && strlen($this->input->post("username") <= 30)))
                ) {
                    $username = $this->input->post("username");
                    $username =  strtolower(trim($this->input->post("username")));
                    $username = filter_var($username, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
                    // $username_exist = $this->Account->checkUsername($username);
                    // if($username_exist) {
                    //     $error[] = "Username đã tồn tại";
                    // }
                } else {
                    $error[] = "Username gồm kí tự a-Z và có độ dài 4 - 30";
                }
            }
            $data['re_email'] = $this->input->post("email");
            $data['re_username']= $this->input->post("username");

            $regex = "/^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[a-zA-Z]+$/";
            if ($this->input->post("email") == '')  {
                $error[] = "Email không được rỗng!";
            } elseif (preg_match( $regex, $this->input->post("email", $maches))) {
                $insert_data['email'] = $this->input->post("email");
            } else {
                $error[] = "Email không hợp lệ!";
            }
           
            if (empty($insert_data['password'])) {
                $error[] = "Password không được rỗng!";
            } elseif (strlen($insert_data['password']) < 4) {
                $error[] = "Password phải nhiều hơn hoặc bằng 4 kí tự!";
            } else {
                $data['re_password'] = $insert_data['password'];
            }
            
           if ($password2 != $insert_data['password']) {
                $error[] = "Password và Password2 phải giống nhau!";
            } else {
                $data['re_password2'] = $password2;
            }

            if (count($error) > 0) {
               print_r($error);
                die;
            }
            //====================== Validate  ======================
            
        //     $insert_data['password'] = MD5(($this->input->post("password"));
        //     $rs = $this->Account->insert($insert_data); 

        //     // ============= Upload anh ===================
        //     if ($rs && isset($_FILES['avatar'])) //Neu insert thanh cong va co chon file
        //     {
        //         $path = "public/img/avatar/";
        //         $tmp_name = $_FILES['avatar']['tmp_name'];
        //         move_uploaded_file($tmp_name,$path.$insert_data['avatar']);
        //     }
        //     // ============= Upload anh ===================
        //     if ($rs) {
        //         $mess = 'Bạn vừa thêm tài khoản '.$insert_data["username"];
        //         setcookie('success', $mess, time() + 1000);
        //         header('location:'.base_url.'admin/account/');
        //     } else {
        //         header('location:'.base_url.'admin/account/add');
        //     }
        } else {
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
