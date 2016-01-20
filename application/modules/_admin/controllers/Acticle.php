<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acticle extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Acticle_model', 'Acticle');
        require_once (FCPATH.'public/php_function_common/php_function.php');

    }

    public function show_acticle()
    {
        $this->load->helper('text');

        $data['all_acticle'] = $this->Acticle->list_all_acticle();
        $data['subView']     = '/acticle/show_acticle_layout';
        $data['title']       = "Quản lý bài viết";
        $data['subData']     = $data;
        $this->load->view('/main/main_layout', $data);
    }

    public function view_acticle()
    {
        // var_dump($this->uri->segment(4));
        if (null !== $this->uri->segment(4) 
            && is_numeric($this->uri->segment(4))
            && $this->Acticle->has_acticle_exist_by_id($this->uri->segment(4))
        ) {
            $acticle_id = $this->uri->segment(4);
            $data['acticle_info'] = $this->Acticle->get_acticle_info($acticle_id);
            
            // var_dump($data['acticle_info']); die;
            $data['subView']     = '/acticle/view_acticle_layout';
            $data['title']       = "Xem bài viết";
            $data['subData']     = $data;
            $this->load->view('/main/main_layout', $data);
        } else {
            $data['pre_page'] = base_url().'index.php/_admin/acticle/show_acticle';
            $this->load->view('/error/404_layout', $data);
        }
    }

    public function add_acticle()
    {
        if (null != $this->input->post('add_acticle_btn')) {
            $data_post = $this->input->post();
            $this->load->helper('Validation');
            $this->load->helper('HTMLPurifier');
            $config = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($config);
            // $clean_html = $purifier->purify($dirty_html); //su dung

            $data_insert['acticle_name'] = $purifier->purify($data_post['acticle_name']);
            $data_insert['acticle_content'] = ($data_post['acticle_content']);

            if ($this->Acticle->insert($data_insert)) {
                $content = 'Thêm bài viết thành công.';
                set_notice(SUCCESS_STATUS , $content);
                $this->show_acticle();
            } else {
                $content = 'Thêm bài viết không thành công.';
                set_notice(FAILED_STATUS , $content);
                $this->show_acticle();
            }
        } else {
            $data['subView'] = '/acticle/add_acticle_layout';
            $data['title']   = "Thêm bài viết";
            $this->load->view('/main/main_layout', $data);
        }
    }
}
