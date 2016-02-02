<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MX_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model', 'Product');
        $this->load->model('Category_model', 'Category');
        
    }

    public function index()
    {
        $data['title'] = "Quản lý sản phẩm";

        //========================== PHÂN TRANG ==========================
        $total_record = $this->Product->total_record_product();

        $this->load->library('pagination');
        
        $config['base_url'] = base_url().'index.php/_admin/product/index';
        $config['total_rows'] = $total_record;
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['num_links'] = 3;
        
        $config['full_tag_open'] = '<ul class="pagination pagination-small">';
        $config['full_tag_close'] = '</ul><!--pagination-->';
        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = 'Next &rarr;';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&larr; Previous';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
        //======================= END PHÂN TRANG ==========================

        $start=$this->uri->segment(4);
        $start = $start == null ? 0 : $start;
        $data['all_pro'] = $this->Product->limit_product($start, $config['per_page']);
        
        foreach ($data['all_pro'] as &$item) {
            $item['category_name'] = $this->Product->get_category_name_by_id($item['id']);
        }

        $data['super_category_name'] = 'TẤT CẢ SẢN PHẨM';
        $data['total_product'] = $total_record;
        $data['subView'] = "/product/show_product_layout";
        $data['subData'] = $data;
        $this->load->view('/main/main_layout', $data);

        // $this->output->cache(20);
    }

    public function add_product()
    {

        if(isset($_POST["btnSubmit"])){
            //============================== Purifier ==============================
            $this->load->helper('Validation');
            $this->load->helper('HTMLPurifier');
            $config = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($config);
            // $clean_html = $purifier->purify($dirty_html);
            //============================== Purifier ==============================

            $loi = array();
            $war = array();
            $url = '';
            $insert_data = array();
            $tmp_name_detail_img = array();
           
            for ($i = 0; $i < count($_FILES['detail_img']['name']); $i++)
            {
                if ($_FILES['detail_img']['name'][$i] != '') {
                    $tmp = new SplFileInfo($_FILES['detail_img']['name'][$i]);
                    $type = $tmp->getExtension();

                    if (   strtolower($type) != 'jpg' 
                        && strtolower($type) != 'gif'
                        && strtolower($type) != 'png'
                        ) {
                        $war[] = "Không đúng định dạng ảnh cho phép!";
                    } elseif ( ! isImage($_FILES['detail_img']['tmp_name'][$i])) {
                        $war[] = "Không phải là file ảnh!";
                    } elseif ($_FILES['detail_img']['size'][$i] > 2048000) {
                        $war[] = "Ảnh chi tiết lớn hơn 2MB";
                    } else {
                        $url= $url.'|'.htmlspecialchars(md5($_POST['product_name'])).'-'.$i.time().'.'.$type;
                        $tmp_name_detail_img[] = $_FILES['detail_img']['tmp_name'][$i];
                    }
                }
            }
            $insert_data['detail_image'] = trim($url,'|');
            $insert_data['product_name'] = trim_input($_POST["product_name"]);
            $insert_data['category_id'] = $_POST["category_id"];
            $insert_data['des'] = $purifier->purify($_POST["des"]);
            // $insert_data['des'] = addslashes( $insert_data['des']);
            $insert_data['price'] = trim_input($_POST["price"]);
            $insert_data['size'] = $purifier->purify($_POST["size"]);
            $insert_data['substance'] = $purifier->purify($_POST["substance"]);

            //====================== Validate  ======================
        if (!empty($_FILES['avatar']['name'])) {
            $avatar_name = $_FILES['avatar']['name'];
            $tmp = new SplFileInfo($avatar_name);
            $avatar_type = $tmp->getExtension();

            if (   strtolower($avatar_type) != 'jpg' 
                && strtolower($avatar_type) != 'gif'
                && strtolower($avatar_type) != 'png'
            ) {
                $loi[] = "Định dạng ảnh không cho phép!";
            } elseif ( ! isImage($_FILES['avatar']['tmp_name'])) {
                $loi[] = "Không phải là file ảnh!";
            } elseif ($_FILES['avatar']['size'] > 2048000) {
                $loi[] = "Ảnh đại diện phải < 2MB";
            } else {
                $tmp_name_avatar = $_FILES['avatar']['tmp_name'];
                $insert_data['image'] = md5($insert_data['product_name']).'.'.$avatar_type;
            }
        }
        if (empty($_POST["product_name"]))  {
            $loi[] = "Tên sản phẩm không được rỗng";
        } elseif(has_special_character($_POST['product_name'])) {
            $loi[] = "Tên sản phẩm không được chứa ký tự đặc biệt.";
        } else {
            if (strlen($_POST["product_name"]) >= 4 && strlen($_POST["product_name"]) <= 100) {
                $insert_data['product_name'] = $purifier->purify($_POST["product_name"]);
                $product_name_exist = $this->Product->has_exist_product_name($insert_data['product_name']);
                if($product_name_exist) {
                    $loi[] = "Sản phẩm đã tồn tại";
                }
            } else {
                $loi[] = "Tên sản phẩm phải dài hơn 4 và nhỏ hơn 100 kí tự!";
            }
        }

        if (empty($insert_data['category_id'])) {
            $loi[] = "Chưa chọn loại sản phẩm!";
        } elseif (!is_numeric($insert_data['category_id'])
            || !$this->Category->has_sub_category_exist_by_id($insert_data['category_id'])
            ) {
            $loi[] = "Loại sản phẩm không hợp lệ!";
        }
        if (!empty($insert_data['price'])){
            if (!is_numeric($insert_data['price'])) {
                $loi[] = "Giá phải là kiểu số!";
            }
        }
        
        if (trim($_POST['ribbon']) != '') {
            if (mb_strlen(trim_input($_POST['ribbon'])) > 9) {
                $loi[] = "Tem dán tối đa 9 kí tự.";
            } else {
                $insert_data['ribbon'] = trim_input($_POST['ribbon']);
            }
        }
        //====================== END Validate  ======================

        if (count($loi) > 0) {
            $alert_time = 20000;
            set_notice('status', FAILED_STATUS , $loi, $alert_time);
            
            $data['category'] = $this->Category->list_all_sub_category();

            $redata['re_product_name'] = $_POST['product_name'];
            $redata['re_category_id'] = $_POST['category_id'];
            $redata['re_price'] = $_POST['price'];
            $redata['re_size'] = $_POST['size'];
            $redata['re_substance'] = $_POST['substance'];
            $redata['re_des'] = $_POST['des'];
            $redata['re_ribbon'] = $_POST['ribbon'];
            
            $data['title'] = "Thêm mới sản phẩm";
            $data['subView'] = '/product/add_product_layout';
            $data['subData'] = $redata;
            $this->load->view('/main/main_layout', $data);
        } else {

            $rs = $this->Product->insert($insert_data); 

            // ============= Upload anh chi tiet ===================
            if ($rs && $insert_data['detail_image'] != '') {
                $detail_image_name = explode('|', $insert_data['detail_image']);
                for($i = 0; $i < count($detail_image_name); $i++)
                {
                    $path = "public/img/detail_img/";
                    move_uploaded_file($tmp_name_detail_img[$i],$path.$detail_image_name[$i]);
                    resizeImage($path.$detail_image_name[$i] , $path.$detail_image_name[$i] , 600, 600);
                }
            }
            // ============= Upload anh chi tiet ===================

            // ============= Upload anh avatar ===================
            if ($rs && !empty($_FILES['avatar']['name'])) //Neu insert thanh cong va co chon file
            {
                $path = "public/img/products/";
                move_uploaded_file($tmp_name_avatar,$path.$insert_data['image']);
                resizeImage($path.$insert_data['image'] , $path.$insert_data['image'] , 600, 600);
            }

            // ============= Upload anh avatar===================

            if ($rs) {
                if ( ! empty($war)) {
                    $war['title'] = 'Thêm sản phẩm '.$insert_data['product_name'].' thành công!';
                    $content = $war;
                    $alert_time = 15000;
                    set_notice('status', FAILED_STATUS,$content,$alert_time);
                    header('location:'.base_url().'index.php/_admin/product');
                } else {
                    $mess = 'Bạn vừa thêm sản phẩm '.$insert_data["product_name"];
                    set_notice('status', SUCCESS_STATUS, $mess);
                    header('location:'.base_url().'index.php/_admin/product');
                }
            } else {
                $mess = 'Có lỗi xảy ra khi thêm mới sản phẩm.';
                set_notice('status', FAILED_STATUS, $mess);

                header('location:'.base_url().'index.php/_admin/product/add_product');
            }
        }
        } else {    //khi khong co submit
            $data['category'] = $this->Category->list_all_sub_category();
            
            $data['title'] = "Thêm mới sản phẩm";
            $data['subView'] = '/product/add_product_layout';
            $data['subData'] = $data;
            $this->load->view('/main/main_layout', $data);
        }
    }

     public function del_product ()
    {
        if(isset($_POST["del_id"]) && is_numeric($_POST["del_id"]))
        {
            if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
                die();
            }
            $error = array();
            $del_id = $_POST['del_id'];
            $del_id = (int) filter_var($del_id, FILTER_SANITIZE_NUMBER_INT);

            $this->Product->removeImage($del_id);
            $product_name    = $this->Product->get_product_name_by_id($del_id);
            $error['status'] = $this->Product->del_product_by_id($del_id);

            $error['mess']   = $error['status'] == SUCCESS_STATUS ? 'Xóa sản phẩm <span style="color:blue;">'.$product_name.'</span> thành công.' : 'Xóa sản phẩm <span style="color:blue;">'.$product_name.'</span> thất bại.';
            echo json_encode($error);
        }
    }

    public function edit()
    {
        if (is_numeric($this->uri->segment(4)) 
            && $this->Product->check_product_by_id($this->uri->segment(4))
        ) {
            $id = $this->uri->segment(4);
            $data['category'] = $this->Category->list_all_sub_category();
            $data['info'] = $this->Product->get_product_by_id($id);
            $data['page'] = $this->uri->segment(5) == null ? 1 : $this->uri->segment(5);

            $data['title']   = "Cập nhật sản phẩm";
            $data['subView'] = 'product/edit_product_layout';

            $data['subData'] = $data;
            $this->load->view('/main/main_layout', $data);
        } else {
            $data['pre_page'] = base_url().'index.php/_admin/product';
            $this->load->view('/error/404_layout', $data);
        }
    }

    public function doedit()
    {
        if (isset($_POST["btnSubmit"])){
            //============================== Purifier ==============================
            $this->load->helper('Validation');
            $this->load->helper('HTMLPurifier');
            $config = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($config);
            // $clean_html = $purifier->purify($dirty_html); //su dung
            //============================== Purifier ==============================
            $update_data = array();
            $war = array();
            $loi = array();
            $has_new_detail_image = false;
            $product_id = $_POST['product_id'];
            $page = isset($_POST['page']) && is_numeric($_POST['page']) ? $_POST['page'] : 1;

            $old_detail_image = $this->Product->get_detail_image($product_id);
            $old_avatar  = $this->Product->get_avatar($product_id);
            $delete_detail_img = empty($_POST['delete_detail_img']) ? array() : $_POST['delete_detail_img'];
            
            if (count($_FILES['detail_img']['name']) > 0) {
                $imgs=$_FILES['detail_img'];
                $url='';
                $tmp_name_detail_img=array();
                for($i = 0; $i < count($_FILES['detail_img']['name']); $i++)
                {
                    if ($_FILES['detail_img']['name'][$i] != '') {
                        $tmp = new SplFileInfo($_FILES['detail_img']['name'][$i]);
                        $type = $tmp->getExtension();
                        if (strtolower($type) != 'jpg' 
                            && strtolower($type) != 'gif'
                            && strtolower($type) != 'png'
                        ){
                            $war[] = "Dịnh dạng ảnh chi tiết sản phẩm không cho phép!";
                            $type = $tmp->getExtension();
                        } elseif ($_FILES['detail_img']['size'][$i] > 1024000) {
                            $war[] = "Ảnh chi tiết sản phẩm phải nhỏ hơn 2MB";
                        } elseif ( ! isImage($_FILES['detail_img']['tmp_name'][$i])) {
                            $war[] = "Ảnh chi tiết không phải là file ảnh!";
                        } else {
                            $url= $url.'|'.htmlspecialchars(md5($_POST['product_name'])).'-'.$i.time().'.'.$type;
                            $tmp_name_detail_img[] = $_FILES['detail_img']['tmp_name'][$i];
                        }
                    }
                }

                if (trim($url,'|') != '') {
                    $new_detail_image = trim($url,'|');
                    $update_data['detail_image'] = $old_detail_image.'|'.$new_detail_image;
                    $update_data['detail_image'] = trim($update_data['detail_image'],'|');
                    $has_new_detail_image = true;
                }
            }

            if ( ! empty($delete_detail_img)) {
                if ($has_new_detail_image) {
                    foreach ($delete_detail_img as $value) {
                        $update_data['detail_image'] = str_replace($value.'|', '', $update_data['detail_image']);
                    }
                } else {
                    $update_data['detail_image'] = $old_detail_image.'|';
                    foreach ($delete_detail_img as $value) {
                        $update_data['detail_image'] = str_replace($value.'|', '', $update_data['detail_image']);
                    }
                }
                $update_data['detail_image'] = trim($update_data['detail_image'],'|');
            }


            $update_data['product_name'] = trim_input($_POST["product_name"]);
            $update_data['category_id'] = $_POST["category_id"];
            $update_data['des'] = $purifier->purify($_POST["des"]);
            $update_data['price'] = trim_input($_POST["price"]);
            $update_data['size'] = $purifier->purify($_POST["size"]);
            $update_data['substance'] = $purifier->purify($_POST["substance"]);


            //====================== Validate START ======================
            if ( ! empty($_FILES['avatar']['name'])) {
                $avatar_name = $_FILES['avatar']['name'];
                $tmp = new SplFileInfo($avatar_name);
                $avatar_type = $tmp->getExtension();

                if (   strtolower($avatar_type) != 'jpg' 
                    && strtolower($avatar_type) != 'gif'
                    && strtolower($avatar_type) != 'png'
                ) {
                    $loi[] = "Định dạng ảnh đại diện sản phẩm không cho phép!";
                } elseif ( ! isImage($_FILES['avatar']['tmp_name'])) {
                    $loi[] = "Ảnh đại diện sản phẩm không phải là file ảnh!";
                } elseif ($_FILES['avatar']['size'] > 2048000) {
                    $loi[] = "Ảnh đại diện sản phẩm phải nhỏ hơn 2MB";
                } else {
                    $tmp_name_avatar = $_FILES['avatar']['tmp_name'];
                    $update_data['image'] = md5($update_data['product_name']).'-'.time().'.'.$avatar_type;
                }
            }

            if (empty($_POST["product_name"]))  {
                $loi[] = "Tên sản phẩm không được rỗng";
            } elseif(has_special_character($_POST['product_name'])) {
                $loi[] = "Tên sản phẩm không được chứa ký tự đặc biệt.";
            } else {
                if (strlen($_POST["product_name"]) >= 4 && strlen($_POST["product_name"]) <= 100) {
                    $update_data['product_name'] = $_POST["product_name"];
                    $update_data['product_name'] = trim($_POST["product_name"]);
                    $update_data['product_name'] = strip_tags($_POST["product_name"]);
                    $update_data['product_name'] = addslashes($update_data['product_name']);
                    $product_name_exist = $this->Product->has_exist_product_name($update_data['product_name'], $product_id);
                    
                    if($product_name_exist) {
                        $loi[] = "Sản phẩm đã tồn tại";
                    }
                } else {
                    $loi[] = "Tên sản phẩm phải dài hơn 4 và nhỏ hơn 100 kí tự!";
                }
            }

            if (empty($update_data['category_id'])) {
                $loi[] = "Chưa chọn loại sản phẩm!";
            } elseif ( ! is_numeric($update_data['category_id'])
                || !$this->Category->has_sub_category_exist_by_id($update_data['category_id'])
            ) {
                $loi[] = "Loại sản phẩm không hợp lệ!";
            } 

            if ( ! empty($update_data['price'])){
                if ( ! is_numeric($update_data['price'])) {
                    $loi[] = "Giá phải là kiểu số!";
                }
            }

            $ribbon = trim($_POST['ribbon']);
            if ($ribbon != '') {
                if (mb_strlen($ribbon) > 9) {
                    $loi[] = "Tem dán tối đa 9 kí tự.";
                } else {
                    $update_data['ribbon'] = trim_input($_POST['ribbon']);
                }
            }
            //====================== Validate END ======================

            if (count($loi) > 0) {
                $alert_time = 20000;
                set_notice('status', FAILED_STATUS , $loi, $alert_time);
                
                $data['category'] = $this->Category->list_all_sub_category();
                $redata['info'] = $this->Product->get_product_by_id($product_id);

                $redata['re_product_name'] = $_POST['product_name'];
                $redata['re_category_id'] = $_POST['category_id'];
                $redata['re_price'] = $_POST['price'];
                $redata['re_size'] = $_POST['size'];
                $redata['re_substance'] = $_POST['substance'];
                $redata['re_des'] = $_POST['des'];
                $redata['re_ribbon'] = $_POST['ribbon'];

                
                $data['subView'] = '/product/edit_product_layout';
                $data['title'] = 'Cập nhật sản phẩm';
                $data['subData'] = $redata;
                $this->load->view('/main/main_layout', $data);
            } else {
                $rs = $this->Product->update($product_id, $update_data); 

                // ============= Xoa anh chi tiet ===================
                if ($rs && ! empty($delete_detail_img)) {
                    foreach ($delete_detail_img as $value) {
                        @unlink('public/img/detail_img/'.$value);
                    }
                }
                // ============= Xoa anh chi tiet ===================

                // ============= Upload anh chi tiet ===================
                if ($rs && $has_new_detail_image) {
                    $detail_image_name = explode('|', $new_detail_image);

                    for($i=0; $i < count($detail_image_name); $i++)
                    {
                        $path = "public/img/detail_img/";
                        move_uploaded_file($tmp_name_detail_img[$i],$path.$detail_image_name[$i]);
                        resizeImage($path.$detail_image_name[$i] , $path.$detail_image_name[$i] , 600, 600);
                    }
                }
                // ============= Upload anh chi tiet ===================

                // ============= Upload anh avatar ===================
                 if ($rs && isset($_FILES['avatar'])) //Neu insert thanh cong va co chon file
                 {
                    $path = "public/img/products/";
                    if (move_uploaded_file($tmp_name_avatar,$path.$update_data['image'])) {
                        resizeImage($path.$update_data['image'] , $path.$update_data['image'] , 600, 600);
                        @unlink('public/img/products/'.$old_avatar);
                    }
                }
                // ============= Upload anh avatar ===================

                if ($rs) {
                    if ( ! empty($war)) {
                        $war['title'] = 'Cập nhật sản phẩm <span style="color:blue;"> '.$update_data['product_name'].'</span> thành công!';
                        $content = $war;
                        $alert_time = 15000;
                        set_notice('status', FAILED_STATUS,$content,$alert_time);
                        
                        header('location:'.base_url().'index.php/_admin/product');
                    } else {
                        $mess = 'Cập nhật sản phẩm <span style="color:blue;"> '.$update_data['product_name'].'</span> thành công!';
                        set_notice('status', SUCCESS_STATUS, $mess);
                        
                        header('location:'.base_url().'index.php/_admin/product');
                    }
                } else {
                    $mess = 'Có lỗi xảy ra cập nhật sản phẩm.';
                    set_notice('status', FAILED_STATUS, $mess);

                    header('location:'.base_url().'index.php/_admin/product/add_product');
                }
            }
        }
    }

    public function product_in_category()
    {
        if (NULL !== $this->uri->segment(4) 
            && is_numeric($this->uri->segment(4))
            && $this->Category->has_super_category_exist_by_id($this->uri->segment(4))
        ) {
            $super_category_id = $this->uri->segment(4); 

            $data['title'] = "Quản lý sản phẩm";

            //========================== PHÂN TRANG ==========================
            $total_record = $this->Product->total_record_product_in_super_category($super_category_id);

            $this->load->library('pagination');
            
            $config['base_url'] = base_url().'index.php/_admin/product/product_in_category/'.$super_category_id;
            $config['total_rows'] = $total_record;
            $config['per_page'] = 10;
            $config['uri_segment'] = 5;
            $config['num_links'] = 3;
            
            $config['full_tag_open'] = '<ul class="pagination pagination-small">';
            $config['full_tag_close'] = '</ul><!--pagination-->';
            $config['first_link'] = '&laquo; First';
            $config['first_tag_open'] = '<li class="prev page">';
            $config['first_tag_close'] = '</li>';
            $config['last_link'] = 'Last &raquo;';
            $config['last_tag_open'] = '<li class="next page">';
            $config['last_tag_close'] = '</li>';
            $config['next_link'] = 'Next &rarr;';
            $config['next_tag_open'] = '<li class="next page">';
            $config['next_tag_close'] = '</li>';
            $config['prev_link'] = '&larr; Previous';
            $config['prev_tag_open'] = '<li class="prev page">';
            $config['prev_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li class="page">';
            $config['num_tag_close'] = '</li>';

            $this->pagination->initialize($config);

            $data['pagination'] = $this->pagination->create_links();
            //======================= END PHÂN TRANG ==========================

            $start=$this->uri->segment(5);
            $start = $start == null ? 0 : $start;
            $data['all_pro'] = $this->Product->limit_product_in_super_category($super_category_id, $start, $config['per_page']);

            foreach ($data['all_pro'] as &$item) {
                $item['category_name'] = $this->Product->get_category_name_by_id($item['id']);
            }

            $data['super_category_name'] = $this->Category->get_super_category_name_by_id($super_category_id);
            $data['total_product'] = $total_record;
            $data['subView'] = "/product/show_product_layout";
            $data['subData'] = $data;
            $this->load->view('/main/main_layout', $data);

            // $this->output->cache(20);

        } else {
            $data['pre_page'] = base_url().'index.php/_admin/product';
            $this->load->view('/error/404_layout', $data);
        }
    }

    public function search_product ()
    {
            if (isset($_GET['key'])) {
                $key = $_GET['key'];
            } else {
                $key = $this->uri->segment(4);
            }
            $key = filter_var($key, FILTER_SANITIZE_STRING);
            $key = trim($key);

            //=======================  PHÂN TRANG  ======================= 
            $total_record = $this->Product->total_record_product($key);
            $this->load->library('pagination');
            
            $config['base_url'] = base_url().'index.php/_admin/product/search_product/'.$key;
            $config['total_rows'] = $total_record;
            $config['per_page'] = 10;
            $config['uri_segment'] = 0; //tai sao
            $config['num_links'] = 3;

            $config['full_tag_open'] = '<ul class="pagination pagination-small">';
            $config['full_tag_close'] = '</ul><!--pagination-->';
            $config['first_link'] = '&laquo; First';
            $config['first_tag_open'] = '<li class="prev page">';
            $config['first_tag_close'] = '</li>';
            $config['last_link'] = 'Last &raquo;';
            $config['last_tag_open'] = '<li class="next page">';
            $config['last_tag_close'] = '</li>';
            $config['next_link'] = 'Next &rarr;';
            $config['next_tag_open'] = '<li class="next page">';
            $config['next_tag_close'] = '</li>';
            $config['prev_link'] = '&larr; Previous';
            $config['prev_tag_open'] = '<li class="prev page">';
            $config['prev_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li class="page">';
            $config['num_tag_close'] = '</li>';

            $this->pagination->initialize($config);

            $data['pagination'] = $this->pagination->create_links();
            //=======================  PHÂN TRANG  ======================= 

            $start = NULL !== $this->uri->segment(5) ? $this->uri->segment(5) : 0;

            $data['total_product'] = $total_record;
            $data['super_category_name'] = 'KẾT QUẢ TÌM KIẾM';

            $data['all_pro'] = $this->Product->limit_product($start, $config['per_page'], $key);
            
            foreach ($data['all_pro'] as &$item) {
                $item['category_name'] = $this->Product->get_category_name_by_id($item['id']);
            }

            $data['title'] = "Tìm kiếm sản phẩm";
            $data['subView'] = "/product/show_product_layout";
            $data['subData'] = $data;

            $this->load->view('/main/main_layout', $data);
        
    }

}

