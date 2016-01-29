<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends MX_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Account_model','Account');
    }
    
    public function edit_account()
    {
        if (null != $this->input->post('edit_account_btn')) {
            $data_post = $this->input->post();
            $this->load->helper('Validation');
            $this->load->helper('HTMLPurifier');
            $config = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($config);

            //====================== Validate  ======================
            $error = array();
            
            if (empty($_POST["username"]))  {
                $error[] = "Username không được rỗng";
            } else {
                if ((preg_match('/^[A-Za-z0-9_\.]{4,30}$/', $_POST["username"], $maches)
                    || preg_match('/^[A-Za-z0-9_\.]{4,30}$/', $_POST["username"], $maches))
                    && (strlen($_POST["username"]) >= 4 && strlen($_POST["username"]) <= 30)
                    ) {
                    $username = $_POST["username"];
                    $username =  trim_input(trim($_POST["username"]));
                    $username_exist = $this->Account->check_username_exist($username,$data_post['id']);
                    if($username_exist) {
                        $error[] = "Username đã tồn tại";
                    }
                } else {
                    $error[] = "Username gồm kí tự a-Z và có độ dài 4 - 30";
                }
            }
                        
            $regex = "/^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[a-zA-Z]+$/";
            if (empty($_POST["email"]))  {
                $error[] = "Email không được rỗng!";
            } elseif (preg_match( $regex, $_POST["email"], $maches)) {
                $insert_data['email'] = $_POST["email"];
            } else {
                $error[] = "Email không hợp lệ!";
            }


            if ($_POST['password'] != '' && strlen($_POST['password']) < 4) {
                $error[] = "Password phải nhiều hơn hoặc bằng 4 kí tự!";
            } 

            if ($data_post['password'] != '') {
                if (strlen($_POST['password']) < 4 || strlen($_POST['password']) > 32) {
                    $error[] = "Password từ 4 đến 32 kí tự!";
                } else {
                    $data_update['password']    = md5($data_post['password']);
                } 
            }


            if ( ! empty($_FILES['avatar']['name'])) {
                $avatar_name = $_FILES['avatar']['name'];
                $tmp = new SplFileInfo($avatar_name);
                $avatar_type = $tmp->getExtension();

                if (   strtolower($avatar_type) != 'jpg' 
                    && strtolower($avatar_type) != 'gif'
                    && strtolower($avatar_type) != 'png'
                ) {
                    $error[] = "Định dạng ảnh đại diện sản phẩm không cho phép!";
                } elseif ( ! isImage($_FILES['avatar']['tmp_name'])) {
                    $error[] = "Ảnh đại diện sản phẩm không phải là file ảnh!";
                } elseif ($_FILES['avatar']['size'] > 2048000) {
                    $error[] = "Ảnh đại diện sản phẩm phải nhỏ hơn 2MB";
                } else {
                    $tmp_name_avatar = $_FILES['avatar']['tmp_name'];
                    $data_update['avatar'] = md5($_POST["username"]).'-'.time().'.'.$avatar_type;
                }
            }
            //====================== Validate  ======================

            if (count($error) > 0) {
                $redata['re_id'] = $_POST['id'];
                $redata['re_username'] = $_POST['username'];
                $redata['re_email'] = $_POST['email'];
                $redata['avatar'] = $this->Account->get_avatar_by_id($_POST['id']);

                $alert_time = 20000;
                set_notice('status', FAILED_STATUS , $error, $alert_time);

                $data['subData']     = $redata;
                $data['title']       = "Cập nhật tài khoản";
                $data['subView']     = '/account/edit_account_layout';
                $this->load->view('/main/main_layout', $data);
            } else {
                $id = $data_post['id'];
                $data_update['username'] = $purifier->purify($data_post['username']);
                $data_update['email']    = $data_post['email'];

                $old_avatar  = $this->Account->get_avatar_by_id($id);
                $rs = $this->Account->update($id, $data_update);
                if (rs) {
                    // ============= Upload anh avatar ===================
                    if ($rs && isset($_FILES['avatar'])) //Neu insert thanh cong va co chon file
                    {
                        $path = "public/img/avatar/";
                        if (move_uploaded_file($tmp_name_avatar,$path.$data_update['avatar'])) {
                            resizeImage($path.$data_update['avatar'] , $path.$data_update['avatar'] , 600, 600);
                            @unlink($path.$old_avatar);

                        }
                    }
                    // ============= Upload anh avatar ===================

                    $this->load->model('Login_model', 'Login');
                    $user = $this->Login->getInfo($username);
                    $_SESSION['user'] = $user;

                    $content = 'Cập nhật tài khoản thành công.';
                    set_notice('status', SUCCESS_STATUS , $content);
                    header('location:'.base_url().'index.php/_admin/order/show_order');
                } else {
                    $content = 'Cập nhật tài khoản thất bại.';
                    set_notice('status', FAILED_STATUS , $content);
                    header('location:'.base_url().'index.php/_admin/order/show_order');
                }
                
            }
        } else {
            if (null !== $this->uri->segment(4) 
                && is_numeric($this->uri->segment(4))
                && $this->Account->has_account_exist_by_id($this->uri->segment(4))
            ) {
                $account_id = $this->uri->segment(4);
                $data['account_info'] = $this->Account->get_account_info($account_id);
                
                $data['subView']     = '/account/edit_account_layout';
                $data['title']       = "Cập nhật tài khoản";
                $data['subData']     = $data;
                $this->load->view('/main/main_layout', $data);
            } else {
                $data['pre_page'] = base_url().'index.php/_admin/acticle/show_account';
                $this->load->view('/error/404_layout', $data);
            }
        }
    }
}

