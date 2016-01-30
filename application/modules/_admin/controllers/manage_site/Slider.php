<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slider extends MX_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Slider_model','Slider');
    }

    public function show_slider()
    {
        $data['slider_info'] = $this->Slider->get_all_slider();

        $data['subView'] = '/manage_site/slider/show_slider_layout';
        $data['title']   = "Quản lý slider";
        $data['subData'] = $data;
        $this->load->view('/main/main_layout', $data);
    }

    public function edit_slider()
    {
        if (isset($_POST['edit_slider_btn'])) {
            $data_post = $this->input->post();
            $this->load->helper('Validation');
            $this->load->helper('HTMLPurifier');
            $config = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($config);

            //====================== Validate START ======================
            $error = array();

            if ( ! empty($_FILES['image_slider']['name'])) {
                $image_slider_name = $_FILES['image_slider']['name'];
                $tmp = new SplFileInfo($image_slider_name);
                $image_slider_type = $tmp->getExtension();

                if (   strtolower($image_slider_type) != 'jpg' 
                    && strtolower($image_slider_type) != 'gif'
                    && strtolower($image_slider_type) != 'png'
                ) {
                    $error[] = "Định dạng ảnh slide không cho phép!";
                } elseif ( ! isImage($_FILES['image_slider']['tmp_name'])) {
                    $error[] = "Ảnh slide không phải là file ảnh!";
                } elseif ($_FILES['image_slider']['size'] > 2048000) {
                    $error[] = "Ảnh slide phải nhỏ hơn 2MB";
                } else {
                    $tmp_name_image_slider = $_FILES['image_slider']['tmp_name'];
                    $data_update['link_slider'] = md5($data_post['id']).'-'.time().'.'.$image_slider_type;
                }
            }

            if ($data_post['des_slider'] !== '') {
                $data_update['des_slider'] = $purifier->purify($data_post['des_slider']); 
            }
            //====================== Validate END ======================

            if (count($error) > 0) {
                $alert_time = 20000;
                set_notice('status', FAILED_STATUS , $error, $alert_time);
                
                $redata['re_link_slider'] = $data_post['target_link'];
                $redata['re_id'] = $data_post['id'];
                $redata['re_des_slider'] = $data_post['des_slider'];
                $slider_info = $redata;
                
                $data['subView'] = '/manage_site/slider/edit_slider_layout';
                $data['title']   = "Cập nhật hình ảnh slider";
                $data['subData'] = $slider_info;
                $this->load->view('/main/main_layout', $data);  
            } else {
                $old_image_slider = $this->Slider->get_link_slider_by_id($data_post['id']);
                if ( ! empty($data_update)) {
                    $this->Slider->update($data_post['id'], $data_update);
                    // ============= Upload anh image_slider ===================
                     if ( ! empty($_FILES['image_slider']['name'])) //Neu insert thanh cong va co chon file
                     {
                        $path = "public/img/slider/";
                        if (move_uploaded_file($tmp_name_image_slider,$path.$data_update['link_slider'])) {
                            resizeImage($path.$data_update['link_slider'] , $path.$data_update['link_slider'] , 400, 400);
                            @unlink('public/img/slider/'.$old_image_slider);
                        }
                    }
                    // ============= Upload anh image_slider ===================


                    $content = 'Cập nhật hình slider thành công.';
                    set_notice('status', SUCCESS_STATUS , $content);
                    header('location:'.base_url().'index.php/_admin/manage_site/slider/show_slider');
                } else {
                    $content = 'Cập nhật hình slider thất bại.';
                    set_notice('status', FAILED_STATUS , $content);
                    header('location:'.base_url().'index.php/_admin/manage_site/slider/show_slider');
                }
            }
        } else {
            if (NULL !== $this->uri->segment(5)
                && is_numeric($this->uri->segment(5))
                && $this->Slider->has_exist_slider_by_id($this->uri->segment(5))
            ) {
                $id = $this->uri->segment(5);
                $data['slider_info'] = $this->Slider->get_slider_by_id($id);

                $data['subView'] = '/manage_site/slider/edit_slider_layout';
                $data['title']   = "Cập nhật hình ảnh slider";
                $data['subData'] = $data;
                $this->load->view('/main/main_layout', $data);   
            } else {
                $data['pre_page'] = base_url().'index.php/_admin/manage_site/slider/show_slider';
                $this->load->view('/error/404_layout', $data);
            }
        }
    }

    public function add_slider()
    {
        if (isset($_POST['edit_slider_btn'])) {
            $data_post = $this->input->post();
            $this->load->helper('Validation');
            $this->load->helper('HTMLPurifier');
            $config = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($config);
            //====================== Validate START ======================
            $error = array();
            $link_slider = array();

            for ($i = 0; $i < count($_FILES['image_slider']['name']); $i++)
            {
                $data_insert['link_slider'][$i] = '';

                if ($_FILES['image_slider']['name'][$i] != '') {
                    $tmp = new SplFileInfo($_FILES['image_slider']['name'][$i]);
                    $type = $tmp->getExtension();

                    if (   strtolower($type) != 'jpg' 
                        && strtolower($type) != 'gif'
                        && strtolower($type) != 'png'
                        ) {
                        $error[] = "Không đúng định dạng ảnh cho phép!";
                    } elseif ( ! isImage($_FILES['image_slider']['tmp_name'][$i])) {
                        $error[] = "Không phải là file ảnh!";
                    } elseif ($_FILES['image_slider']['size'][$i] > 2048000) {
                        $error[] = "Ảnh lớn hơn 2MB";
                    } else {
                        $data_insert['link_slider'][$i] = $i.microtime().'.'.$type;
                        $tmp_name_image_slider[$i] = $_FILES['image_slider']['tmp_name'][$i];
                    }
                } else {
                        $error[] = "Bắt buộc phải upload 1 ảnh cho 1 slide.";
                }
            }
            for ($i = 0; $i < count($data_post['des_slider']); $i++) {
                if ($data_post['des_slider'][$i] !== '') {
                    $data_insert['des_slider'][$i] = $purifier->purify($data_post['des_slider'][$i]); 
                } else {
                    $data_insert['des_slider'][$i] = ''; 
                }
            }
            //====================== Validate END ======================
            if (count($error) > 0) {
                $alert_time = 15000;
                set_notice('status', FAILED_STATUS , $error, $alert_time);
                
                $redata['re_des_slider'] = $data_post['des_slider'];
                
                $data['subView'] = '/manage_site/slider/add_slider_layout';
                $data['title']   = "Thêm hình ảnh vào slider";
                $data['subData'] = $redata;
                $this->load->view('/main/main_layout', $data);  
            } else {

                $tmp_insert = array();
                for ($i = 0; $i < count($data_post['des_slider']); $i++) {
                    // $this->Slider->insert($data_insert[]);
                    $tmp_insert['link_slider'] = $data_insert['link_slider'][$i];
                    $tmp_insert['des_slider'] = $data_insert['des_slider'][$i];
                    $tmp_rs = $this->Slider->insert($tmp_insert);   
                }

                // ============= Upload anh image_slider ===================
            for ($i = 0; $i < count($_FILES['image_slider']['name']); $i++) {
                if ( ! empty($_FILES['image_slider']['name'][$i])) //Neu insert thanh cong va co chon file
                 {
                    $path = "public/img/slider/";
                    if (move_uploaded_file($tmp_name_image_slider[$i],$path.$data_insert['link_slider'][$i])) {
                        resizeImage($path.$data_insert['link_slider'][$i] , $path.$data_insert['link_slider'][$i] , 400, 400);
                    }
                }
            }
                // ============= Upload anh image_slider ===================


                $content = 'Thêm mới slide thành công.';
                set_notice('status', SUCCESS_STATUS , $content);
                header('location:'.base_url().'index.php/_admin/manage_site/slider/show_slider');
            }
        } else {
            $data['subView'] = '/manage_site/slider/add_slider_layout';
            $data['title']   = "Thêm hình ảnh vào slider";
            $data['subData'] = $data;
            $this->load->view('/main/main_layout', $data);   
        }
    }

    public function delete_slider ()
    {
        if(isset($_POST["del_id"]) && is_numeric($_POST["del_id"]))
        {
            if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
                die();
            }
            $error = array();
            $del_id = $_POST['del_id'];
            $del_id = (int) filter_var($del_id, FILTER_SANITIZE_NUMBER_INT);

            $old_image_slider = $this->Slider->get_link_slider_by_id($del_id);
            $rs = $this->Slider->delete_slider($del_id);

            if ($rs == true) {
                @unlink('public/img/slider/'.$old_image_slider);
            }

            $error['status'] = $rs;
            $error['mess']   = $error['status'] == SUCCESS_STATUS ? 'Xóa slider thành công.' : 'Xóa slider thất bại.';
            echo json_encode($error);
        }
    }
    
}

