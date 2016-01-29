<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends MX_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Contact_model','Contact');
    }

    public function show_contact()
    {
        $data['contact'] = $this->Contact->get_contact();

        $data['subView'] = '/manage_site/contact/show_contact_layout';
        $data['title']   = "Quản lý thông tin liên hệ";
        $data['subData'] = $data;
        $this->load->view('/main/main_layout', $data);
    }

    public function edit_contact()
    {
        if (isset($_POST['edit_contact_btn'])) {
            $data_post = $this->input->post();
            $this->load->helper('HTMLPurifier');
            $config = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($config);

            $data_update['content'] = $purifier->purify($data_post['content_contact']);

            if ($this->Contact->update($data_update)) {
                $content = 'Cập nhật thông tin liên lạc thành công.';
                set_notice('status', SUCCESS_STATUS , $content);
                header('location:'.base_url().'index.php/_admin/manage_site/contact/show_contact');
            } else {
                $content = 'Cập nhật thông tin liên lạc thất bại.';
                set_notice('status', FAILED_STATUS , $content);
                header('location:'.base_url().'index.php/_admin/manage_site/contact/show_contact');
            }
        } else {
            $data['contact'] = $this->Contact->get_contact();

            $data['subView'] = '/manage_site/contact/edit_contact_layout';
            $data['title']   = "Cập nhật thông tin liên hệ";
            $data['subData'] = $data;
            $this->load->view('/main/main_layout', $data);   
        }
    }
    
}

