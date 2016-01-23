<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MX_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Category_model', 'Category');
    }

//=========================== FUNCTION OF SUB_CATEGORY: START ===========================
    public function show_sub_category()
    {
        $data['all_cate'] = $this->Category->list_all_sub_category();

        $data['subView'] = '/category/sub_category_layout';
        $data['title']   = "Quản lý danh mục";
        $data['subData'] = $data;
        $this->load->view('/main/main_layout', $data);
    }

    public function add_sub_category()
    {
        if (null != $this->input->post('add_sub_category_btn')) {
            $data_post = $this->input->post();
            $this->load->helper('Validation');
            $this->load->helper('HTMLPurifier');
            $config = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($config);

            $data_insert['category_name'] = $purifier->purify($data_post['sub_category_name']);
            $data_insert['super_categoryId'] = $data_post['super_category_id'];

            //========================= VALIDATION: START =======================
            $error = array();
            if (trim_input($data_insert['category_name']) == '') {
                $error = 'Tên loại sản phẩm không thể rỗng.';
            }

            if ($this->Category->has_duplicate_sub_category_name($data_insert['category_name'])) {
                $error = 'Loại sản phẩm này đã tồn tại.';
            }

            if (trim_input($data_insert['super_categoryId']) == '') {
                $error = 'Bạn chưa chọn loại danh mục.';
            } elseif ( ! is_numeric($data_insert['super_categoryId']) 
                || ! $this->Category->has_super_category_exist_by_id($data_insert['super_categoryId'])
            ) {
                $error = 'Loại danh mục bạn chọn không tồn tại.';
            }
            //========================= VALIDATION: END =========================
            if (count($error) > 0) { // has error validate
                set_notice(FAILED_STATUS , $error);
           
                $data['all_super_category'] = $this->Category->list_all_super_category();
                $data['subData'] = $data;
                $data['re_sub_category_name'] = $data_post['sub_category_name'];
                $data['subView'] = '/category/add_sub_category_layout';
                $data['title']   = "Thêm loại danh mục";
                $data['subData'] = $data;
                $this->load->view('/main/main_layout', $data);
            } else { // not error validate
                if ($this->Category->insert_sub_category($data_insert)) {
                    $content = 'Thêm loại sản phẩm <span style="color:blue">'. $data_insert['category_name'].'</span> thành công.';
                    set_notice(SUCCESS_STATUS , $content);
                    
                    header('location:'.base_url().'index.php/_admin/category/show_sub_category');
                } else {
                    $content = 'Thêm loại sản phẩm thất bại.';
                    set_notice(FAILED_STATUS , $content);
                    
                    header('location:'.base_url().'index.php/_admin/category/show_sub_category');
                }
            }
        } else {
            $data['all_super_category'] = $this->Category->list_all_super_category();
            $data['subView'] = '/category/add_sub_category_layout';
            $data['title']   = "Thêm loại sản phẩm";
            $data['subData'] = $data;
            $this->load->view('/main/main_layout', $data);
        }
    }
    
    public function edit_sub_category()
    {
        if (null != $this->input->post('edit_sub_category_btn')) {
            $data_post = $this->input->post();

            $this->load->helper('Validation');
            $this->load->helper('HTMLPurifier');
            $config = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($config);
            
            $data_update['category_name'] = $purifier->purify($data_post['sub_category_name']);
            $data_update['super_categoryId'] = $data_post['super_category_id'];
            $sub_category_id = $data_post['sub_category_id'];
            //========================= VALIDATION: START =======================
            $error = array();
            if (trim_input($data_update['category_name']) == '') {
                $error = 'Tên loại sản phẩm không thể rỗng.';
            }

            if ($this->Category->has_duplicate_sub_category_name($data_update['category_name'], $sub_category_id)) {
                $error = 'Loại sản phẩm này đã tồn tại.';
            }

            if (trim_input($data_update['super_categoryId']) == '') {
                $error = 'Bạn chưa chọn loại danh mục.';
            } elseif ( ! is_numeric($data_update['super_categoryId']) 
                || ! $this->Category->has_super_category_exist_by_id($data_update['super_categoryId'])
            ) {
                $error = 'Loại danh mục bạn chọn không tồn tại.';
            }
            //========================= VALIDATION: END =========================
            if (count($error) > 0) { // has error validate
                set_notice(FAILED_STATUS , $error);
           
                $data['sub_category_info'] = $this->Category->get_sub_category_info($sub_category_id);
                $data['all_super_category'] = $this->Category->list_all_super_category();
                $data['re_sub_category_id'] = $data_post['sub_category_id'];
                $data['re_sub_category_name'] = $data_post['sub_category_name'];
                
                $data['subView'] = '/category/edit_sub_category_layout';
                $data['title']   = "Thêm loại sản phẩm";
                $data['subData'] = $data;
                $this->load->view('/main/main_layout', $data);
            } else { // not error validate

                $old_sub_category_name = $this->Category->get_sub_category_name_by_id($sub_category_id);
                $new_sub_category_name = $data_post['sub_category_name'];

                if ($this->Category->update_sub_category($sub_category_id, $data_update)) {
                    $content = 'Cập nhật loại danh mục <span style="color:blue;">'.$old_sub_category_name.'</span> thành <span style="color:blue;">'.$new_sub_category_name.'</span>';
                    set_notice(SUCCESS_STATUS , $content);
                    header('location:'.base_url().'index.php/_admin/category/show_sub_category');
                } else {
                    $content = 'Cập nhật loại danh mục <span style="color:blue;">'.$old_sub_category_name.'</span> thất bại.';
                    set_notice(FAILED_STATUS , $content);
                    header('location:'.base_url().'index.php/_admin/category/show_sub_category');
                }
            }
        } else {
            if (null !== $this->uri->segment(4) 
                && is_numeric($this->uri->segment(4))
                && $this->Category->has_sub_category_exist_by_id($this->uri->segment(4))
            ) {
                $sub_category_id = $this->uri->segment(4);
                $data['all_super_category'] = $this->Category->list_all_super_category();
                $data['sub_category_info'] = $this->Category->get_sub_category_info($sub_category_id);
                
                $data['subView']     = '/category/edit_sub_category_layout';
                $data['title']       = "Cập nhật loại sản phẩm";
                $data['subData']     = $data;
                $this->load->view('/main/main_layout', $data);
            } else {
                $data['pre_page'] = base_url().'index.php/_admin/category/show_sub_category';
                $this->load->view('/error/404_layout', $data);
            }
        }
    }

    public function delete_sub_category()
    {
        if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
            die();
        }

        if(isset($_POST["del_id"]) 
            && is_numeric($_POST["del_id"])
            && $this->Category->has_sub_category_exist_by_id($_POST["del_id"])
        ){
            $error = array();
            $del_id = $_POST['del_id'];

            $sub_category_name = $this->Category->get_sub_category_name_by_id($del_id);
            $error['status']     = $this->Category->delete_sub_category($del_id);

            $error['mess']   = $error['status'] == SUCCESS_STATUS ? 'Xóa danh mục <span style="color:blue;">'.$sub_category_name.'</span> thành công.' : 'Xóa danh mục <span style="color:blue;">'.$sub_category_name.'</span> thất bại.';
            echo json_encode($error);
        } else {
            $error['status'] = FAILED_STATUS;
            $error['mess']   = 'Danh mục không tồn tại.';
            echo json_encode($error);
        }
    }
//=========================== FUNCTION OF SUB_CATEGORY: END ===========================


//=========================== FUNCTION OF SUPER_CATEGORY: START ===========================
    public function show_super_category()
    {
        $data['all_super_category'] = $this->Category->list_all_super_category();

        $data['subView'] = '/category/super_category_layout';
        $data['title']   = "Quản lý danh mục";
        $data['subData'] = $data;
        $this->load->view('/main/main_layout', $data);
    }

    public function add_super_category()
    {
        if (null != $this->input->post('add_super_category_btn')) {
            $data_post = $this->input->post();
            $this->load->helper('Validation');
            $this->load->helper('HTMLPurifier');
            $config = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($config);

            $data_insert['super_categoryName'] = $purifier->purify($data_post['super_category_name']);
           
            //========================= VALIDATION: START =======================
            $error = array();
            if (trim_input($data_insert['super_categoryName']) == '') {
                $error = 'Tên loại danh mục không thể rỗng.';
            }

            if ($this->Category->has_duplicate_super_category_name($data_insert['super_categoryName'])) {
                $error = 'Loại danh mục này đã tồn tại.';
            }
            //========================= VALIDATION: END =========================
            if (count($error) > 0) { // has error validate
                set_notice(FAILED_STATUS , $error);

                $data['re_super_category_name'] = $data_post['super_category_name'];
                $data['subView'] = '/category/add_super_category_layout';
                $data['title']   = "Thêm loại danh mục";
                $data['subData'] = $data;
                $this->load->view('/main/main_layout', $data);
            } else { // not error validate
                if ($this->Category->insert_super_category($data_insert)) {
                    $content = 'Thêm loại danh mục <span style="color:blue">'. $data_insert['super_categoryName'].'</span> thành công.';
                    set_notice(SUCCESS_STATUS , $content);
                    header('location:'.base_url().'index.php/_admin/category/show_super_category');
                } else {
                    $content = 'Thêm loại danh mục <span style="color:blue">'. $data_insert['super_categoryName'].'</span> thất bại.';
                    set_notice(FAILED_STATUS , $content);
                    header('location:'.base_url().'index.php/_admin/category/show_super_category');
                }
            }
        } else {
            $data['subView'] = '/category/add_super_category_layout';
            $data['title']   = "Thêm loại danh mục";
            $this->load->view('/main/main_layout', $data);
        }
    }
    
    public function edit_super_category()
    {
        if (null != $this->input->post('edit_super_category_btn')) {
            $data_post = $this->input->post();
            $this->load->helper('Validation');
            $this->load->helper('HTMLPurifier');
            $config = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($config);

            $id = $data_post['super_category_id'];
            $data_update['super_categoryName'] = $purifier->purify($data_post['super_categoryName']);

            //========================= VALIDATION: START =======================
            $error = array();
            if (trim_input($data_update['super_categoryName']) == '') {
                $error = 'Tên loại danh mục không thể rỗng.';
            }

            if ($this->Category->has_duplicate_super_category_name($data_update['super_categoryName'], $id)) {
                $error = 'Loại danh mục này đã tồn tại.';
            }
            //========================= VALIDATION: END =========================
            
            if (count($error) > 0) { // has error validate
                set_notice(FAILED_STATUS , $error);

                $data['re_super_category_name'] = $data_post['super_categoryName'];
                $data['re_super_category_id'] = $data_post['super_category_id'];
                $data['subView'] = '/category/edit_super_category_layout';
                $data['title']   = "Cập nhật loại danh mục";
                $data['subData'] = $data;
                $this->load->view('/main/main_layout', $data);
            } else { // not error validate
                $old_super_category_name = $this->Category->get_super_category_name_by_id($id);
                $new_super_category_name = $data_post['super_categoryName'];

                if ($this->Category->update_super_category($id, $data_update)) {
                    if ($old_super_category_name != $new_super_category_name) {
                        $content = 'Cập nhật loại danh mục <span style="color:blue;">'.$old_super_category_name.'</span> thành <span style="color:blue;">'.$new_super_category_name.'</span>';
                    } else {
                        $content = 'Cập nhật loại danh mục <span style="color:blue;">'.$old_super_category_name.'</span> thành công.';
                    }
                    set_notice(SUCCESS_STATUS , $content);
                    
                    header('location:'.base_url().'index.php/_admin/category/show_super_category');
                } else {
                    $content = 'Cập nhật loại danh mục <span style="color:blue;">'.$old_super_category_name.'</span> thất bại.';
                    set_notice(FAILED_STATUS , $content);
                    
                    header('location:'.base_url().'index.php/_admin/category/show_super_category');
                }
            }
        } else {
            if (null !== $this->uri->segment(4) 
                && is_numeric($this->uri->segment(4))
                && $this->Category->has_super_category_exist_by_id($this->uri->segment(4))
            ) {
                $super_category_id = $this->uri->segment(4);
                $data['super_category_info'] = $this->Category->get_super_category_info($super_category_id);
                
                $data['subView']     = '/category/edit_super_category_layout';
                $data['title']       = "Cập nhật loại danh mục";
                $data['subData']     = $data;
                $this->load->view('/main/main_layout', $data);
            } else {
                $data['pre_page'] = base_url().'index.php/_admin/category/show_super_category';
                $this->load->view('/error/404_layout', $data);
            }
        }
    }

    public function delete_super_category()
    {
        if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
            die();
        }

        if(isset($_POST["del_id"]) 
            && is_numeric($_POST["del_id"])
            && $this->Category->has_super_category_exist_by_id($_POST["del_id"])
        ){
            $error = array();
            $del_id = $_POST['del_id'];

            $super_category_name = $this->Category->get_super_category_name_by_id($del_id);
            $error['status']     = $this->Category->delete_super_category($del_id);

            $error['mess']   = $error['status'] == SUCCESS_STATUS ? 'Xóa danh mục <span style="color:blue;">'.$super_category_name.'</span> thành công.' : 'Xóa danh mục <span style="color:blue;">'.$super_category_name.'</span> thất bại.';
            echo json_encode($error);
        } else {
            $error['status'] = FAILED_STATUS;
            $error['mess']   = 'Danh mục không tồn tại.';
            echo json_encode($error);
        }
    }
//=========================== FUNCTION OF SUPER_CATEGORY: END ===========================

}

