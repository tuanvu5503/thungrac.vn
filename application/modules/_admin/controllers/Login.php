<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MX_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model','Login');
    }
    public function index()
    {
        if (isset($_POST['btnLogin'])) {  
            $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
            $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
            $password = md5($password);
            $login = $this->Login->checkLogin($username, $password);
            if ($login) {
                $user = $this->Login->getInfo($username);
            // var_dump($user); die;
                
                session_start();
                $_SESSION['user'] = $user;
                header("location:".base_url()."index.php/_admin/product");
            } else {
                $error[] = 'Sai tên đăng nhập hoặc mật khẩu!';
                $data['re_username'] = $_POST['username'];
                $data['re_password'] = $_POST['password'];
                $data['error'] = $error;
                $data['title'] = "Login - OnlineShop";
                $this->load->view('/login/login_layout', $data);
            }
        } else {
            $data['title'] = "Login - OnlineShop";
            $this->load->view('/login/login_layout', $data);
        }
    }

    public function logout()
    {
        session_destroy();
        $this->index();
    }
}

