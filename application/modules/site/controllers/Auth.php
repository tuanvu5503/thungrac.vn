<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('cart');
        // $this->load->model('Auth');
    }
    public function regist_account()
    {
        $this->load->model('Productmodel');

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
