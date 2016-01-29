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
                if ($this->Slider->update($data_post['id'], $data_update)) {

                    // ============= Upload anh image_slider ===================
                     if ( ! empty($_FILES['image_slider']['name'])) //Neu insert thanh cong va co chon file
                     {
                        $path = "public/img/slider/";
                        if (move_uploaded_file($tmp_name_image_slider,$path.$data_update['link_slider'])) {
                            resizeImage($path.$data_update['link_slider'] , $path.$data_update['link_slider'] , 400, 400);
                            @unlink('public/img/products/'.$old_image_slider);
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
    
}

