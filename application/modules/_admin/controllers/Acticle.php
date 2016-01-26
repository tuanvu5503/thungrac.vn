<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acticle extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Acticle_model', 'Acticle');
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
        if (null !== $this->uri->segment(4) 
            && is_numeric($this->uri->segment(4))
            && $this->Acticle->has_acticle_exist_by_id($this->uri->segment(4))
        ) {
            $acticle_id = $this->uri->segment(4);
            $data['acticle_info'] = $this->Acticle->get_acticle_info($acticle_id);
            
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

            $data_insert['acticle_name'] = $purifier->purify($data_post['acticle_name']);
            $data_insert['acticle_content'] = ($data_post['acticle_content']);

            if ($this->Acticle->insert($data_insert)) {
                $content = 'Thêm bài viết thành công.';
                set_notice('status', SUCCESS_STATUS , $content);
                header('location:'.base_url().'index.php/_admin/acticle/show_acticle');
            } else {
                $content = 'Thêm bài viết thất bại.';
                set_notice('status', FAILED_STATUS , $content);
                header('location:'.base_url().'index.php/_admin/acticle/show_acticle');
            }
        } else {
            $data['subView'] = '/acticle/add_acticle_layout';
            $data['title']   = "Thêm bài viết";
            $this->load->view('/main/main_layout', $data);
        }
    }

    public function delete_acticle()
    {
        if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
            die();
        }

        if(isset($_POST["del_id"]) 
            && is_numeric($_POST["del_id"])
            && $this->Acticle->has_acticle_exist_by_id($_POST["del_id"])
        ){
            $error = array();
            $del_id = $_POST['del_id'];

            $acticle_name    = $this->Acticle->get_acticle_name_by_id($del_id);
            $error['status'] = $this->Acticle->delete_acticle_by_id($del_id);

            $error['mess']   = $error['status'] == SUCCESS_STATUS ? 'Xóa bài viết <span style="color:blue;">'.$acticle_name.'</span> thành công.' : 'Xóa bài viết <span style="color:blue;">'.$acticle_name.'</span> thất bại.';
            echo json_encode($error);
        } else {
            $error['status'] = FAILED_STATUS;
            $error['mess']   = $error['status'] == SUCCESS_STATUS ? 'Xóa bài viết <span style="color:blue;">'.$acticle_name.'</span> thành công.' : 'Xóa bài viết <span style="color:blue;">'.$acticle_name.'</span> thất bại.';
            echo json_encode($error);
        }
    }

    public function edit_acticle()
    {
        if (null != $this->input->post('edit_acticle_btn')) {
            $data_post = $this->input->post();
            $this->load->helper('Validation');
            $this->load->helper('HTMLPurifier');
            $config = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($config);

            $id = $data_post['acticle_id'];
            $data_update['acticle_name'] = $purifier->purify($data_post['acticle_name']);
            $data_update['acticle_content'] = $data_post['acticle_content'];

            if ($this->Acticle->update($id, $data_update)) {
                $content = 'Cập nhật bài viết thành công.';
                set_notice('status', SUCCESS_STATUS , $content);
                header('location:'.base_url().'index.php/_admin/acticle/show_acticle');
            } else {
                $content = 'Cập nhật bài viết thất bại.';
                set_notice('status', FAILED_STATUS , $content);
                header('location:'.base_url().'index.php/_admin/acticle/show_acticle');
            }
        } else {
            if (null !== $this->uri->segment(4) 
                && is_numeric($this->uri->segment(4))
                && $this->Acticle->has_acticle_exist_by_id($this->uri->segment(4))
            ) {
                $acticle_id = $this->uri->segment(4);
                $data['acticle_info'] = $this->Acticle->get_acticle_info($acticle_id);
                
                $data['subView']     = '/acticle/edit_acticle_layout';
                $data['title']       = "Chỉnh sửa bài viết";
                $data['subData']     = $data;
                $this->load->view('/main/main_layout', $data);
            } else {
                $data['pre_page'] = base_url().'index.php/_admin/acticle/show_acticle';
                $this->load->view('/error/404_layout', $data);
            }
        }
    }
}
