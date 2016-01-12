<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MX_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model', 'Product');
    }

    public function index()
    {
        $data['title'] = "Quản lý sản phẩm";
        // $this->load->menuadmin();
        //========================== PHÂN TRANG ==========================
        $total_record = $this->Product->total_record_product();

        $this->load->library('pagination');
        
        $config['base_url'] = base_url().'index.php/home/product/index';
        $config['total_rows'] = $total_record;
        $config['per_page'] = 5;
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
        // var_dump($start);
        $data['all_pro'] = $this->Product->limit_product($start, $config['per_page']);
        var_dump($data);
        $this->load->view('/product/product_layout', $data);

        // $this->output->cache(20);
    }

    public function search ()
    {
        if (isset($_GET['key']))
        {
            $key = filter_var($_GET['key'], FILTER_SANITIZE_STRING);
            $key = trim($key);

            //=======================  PHÂN TRANG  ======================= 
            $total_record = $this->Product->total_record_product($key);
            $limit = 5;
            $current_page=isset($_GET['page']) ? $_GET['page'] : 1;
            $start = ($current_page - 1) * $limit;
            //Cau hinh phan trang
            $config = array(
                'current_page'  => $current_page,
                'total_record'  => $total_record, 
                'limit'         => $limit,
                'link_full'     => '?key='.$key.'&page={page}',
                'link_first'    => '',
                'range'         => 5 
                );
            $this->load->library('Pagination');
            $this->Pagination->config($config);
            $data['pagination'] = $this->Pagination->create_link();
            //=======================  PHÂN TRANG  ======================= 

            $data['all_pro'] = $this->Product->limit_product($start, $limit, $key);
            $this->load->headeradmin();
            $this->load->menuadmin();
            $data['title'] = "Tìm kiếm";
            $this->load->view('/product/product_layout', $data);
        }
    }

    public function del_product ()
    {
        if(isset($_POST["del_id"]) && is_numeric($_POST["del_id"]))
        {
            if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
                die();
            }
            $alert = array();
            $del_id = $_POST['del_id'];
            $del_id = (int) filter_var($del_id, FILTER_SANITIZE_NUMBER_INT);

            $this->Product->removeImage($del_id);
            $alert['product_name'] = $this->Product->getProductNamebyId($del_id);
            $alert['status'] = $this->Product->del('product', $del_id);
            echo json_encode($alert);
        }
    }

    public function add ()
    {
        if(isset($_POST["btnSubmit"])){
            //============================== Purifier ==============================
            $this->load->helper('HTMLPurifier');
            $config = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($config);
            // $clean_html = $purifier->purify($dirty_html);
            //============================== Purifier ==============================

            $this->load->helper('Validation');
            $loi = array();
            $war = array();
            $insert_data = array();

            if (count($_FILES['detail_img']['name']) > 0) {
                $url='';
                $tmp_name_detail_img=array();
                for($i = 0; $i < count($_FILES['detail_img']['name']); $i++)
                {
                    if (strlen($_FILES['detail_img']['name'][$i]) > 0) {
                        $type = end(explode(".", $_FILES['detail_img']['name'][$i]));
                        if (strtolower($type) != 'jpg' && strtolower($type) != 'gif'
                            && strtolower($type) != 'png'
                            ) {
                            $war[] = "Không đúng định dạng ảnh cho phép!";
                    } elseif ( ! isImage($_FILES['detail_img']['tmp_name'][$i])) {
                        $war[] = "Không phải là file ảnh!";
                    } elseif ($_FILES['detail_img']['size'][$i] > 1024000) {
                        $war[] = "Ảnh chi tiết lớn hơn 1MB";
                    } else {
                        $url= $url.'|'.htmlspecialchars(md5($_POST['product_name'])).'-'.$i.time().'.'.$type;
                        $tmp_name_detail_img[] = $_FILES['detail_img']['tmp_name'][$i];
                    }
                }
            }
            $insert_data['detail_image'] = trim($url,'|');
        }
        $avatar_name = $_FILES['avatar']['name'];
            $avatar_type = end(explode(".",$avatar_name)); // lay phan mo rong(.jpg|.gif)
            $insert_data['product_name'] = trim_input($_POST["product_name"]);
            $insert_data['category_id'] = $_POST["category_id"];
            $insert_data['des'] = $purifier->purify($_POST["des"]);
            $insert_data['des'] = addslashes( $insert_data['des']);
            $insert_data['price'] = trim_input($_POST["price"]);
            $insert_data['qty'] = trim_input($_POST["qty"]);

            //====================== Validate  ======================
            if (!empty($_FILES['avatar']['name'])) {
                if (strtolower($avatar_type) != 'jpg' && strtolower($avatar_type) != 'gif'
                    && strtolower($avatar_type) != 'png'
                    ) {
                    $loi[] = "Định dạng ảnh không cho phép!";
            } elseif ( ! isImage($_FILES['avatar']['tmp_name'])) {
                $loi[] = "Không phải là file ảnh!";
            } elseif ($_FILES['avatar']['size'] > 1024000) {
                $loi[] = "Ảnh đại diện phải < 1MB";
            } else {
                $tmp_name_avatar = $_FILES['avatar']['tmp_name'];
                $insert_data['image'] = md5($insert_data['product_name']).'.'.$avatar_type;
            }
        }
        if (empty($_POST["product_name"]))  {
            $loi[] = "Tên sản phẩm không được rỗng";
        } elseif((strip_tags($_POST["product_name"]) == '')) {
            $loi[] = "Tên sản phẩm không hợp lệ!";
        } else {
            if (strlen($_POST["product_name"]) >= 4 && strlen($_POST["product_name"]) <= 100) {
                $insert_data['product_name'] = $_POST["product_name"];
                $insert_data['product_name'] = trim($_POST["product_name"]);
                $insert_data['product_name'] = strip_tags($_POST["product_name"]);
                $insert_data['product_name'] = addslashes($insert_data['product_name']);
                $product_name_exist = $this->Product->checkproduct_name($insert_data['product_name']);
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
            || !$this->Product->checkCategory($insert_data['category_id'])
            ) {
            $loi[] = "Loại sản phẩm không hợp lệ!";
        }
        if (!empty($insert_data['price'])){
            if (!is_numeric($insert_data['price'])) {
                $loi[] = "Giá phải là kiểu số!";
            }
        }
        if (!empty($insert_data['qty'])){
            if (!is_numeric($insert_data['qty'])) {
                $loi[] = "Số lượng phải là kiểu số!";
            } else {
                $data['re_qty'] = $insert_data['qty'];
            }
        } 
            //====================== END Validate  ======================

        if (count($loi) > 0) {
            $redata['re_product_name'] = $_POST['product_name'];
            $redata['re_category_id'] = $_POST['category_id'];
            $redata['re_price'] = $_POST['price'];
            $redata['re_qty'] = $_POST['qty'];
            $redata['re_des'] = $_POST['des'];
            $redata['title'] = "Thêm mới sản phẩm";
            $redata['error'] = $loi;
            $this->load->headeradmin();
            $this->load->menuadmin();
            $redata['category'] = $this->Product->get_category();
            $this->load->view('/product/add_layout', $redata);
            die;
        }
        $rs = $this->Product->insert('product', $insert_data); 

            // ============= Upload anh chi tiet ===================
        if ($rs && $insert_data['detail_image'] != '') {
            $detail_image_name = explode('|', $insert_data['detail_image']);
            for($i = 0; $i < count($detail_image_name); $i++)
            {
                move_uploaded_file($tmp_name_detail_img[$i],"public/img/detail_img/".$detail_image_name[$i]);
            }
        }
            // ============= Upload anh chi tiet ===================

            // ============= Upload anh avatar ===================
            if ($rs && $insert_data['image'] != '') //Neu insert thanh cong va co chon file
            {
                $path = "public/img/products/";
                move_uploaded_file($tmp_name_avatar,$path.$insert_data['image']);
            }
            // ============= Upload anh avatar===================

            if ($rs) {
                if (!empty($war)) {
                    session_start();
                    $war['title'] = 'Thêm sản phẩm '.$insert_data['product_name'].' thành công!';
                    $_SESSION['war'] = $war;
                    header('location:'.base_url.'admin/product');
                } else {
                    $mess = 'Bạn vừa thêm sản phẩm '.$insert_data["product_name"];
                    setcookie('success', $mess, time() + 1);
                    header('location:'.base_url.'admin/product');
                }
            } else {
                header('location:'.base_url.'admin/product/add');
            }
        } else {    //khi khong co submit
            $data['title'] = "Thêm mới sản phẩm";
            $this->load->headeradmin();
            $this->load->menuadmin();
            $data['category'] = $this->Product->get_category();
            $this->load->view('/product/add_layout', $data);
        }
    }

    public function edit ($arg)
    {
        if (isset($arg[0]) && is_numeric($arg[0]) && isset($arg[1]) && is_numeric($arg[1])) {
            $id = $arg[0];
            $data['page'] = $arg[1];
            $this->load->headeradmin();
            $this->load->menuadmin();
            $data['title'] = "Cập nhật sản phẩm";
            $data['category'] = $this->Product->get_category();
            $data['info'] = $this->Product->getProductbyID($id);

            $this->load->view('product/edit_layout', $data);
        } else {
            $this->load->view('404-temp');
        }
    }

    public function doedit ($arg)
    {
        if(isset($_POST["btnSubmit"])){
            //============================== Purifier ==============================
            $this->load->helper('Validation');
            $this->load->helper('HTMLPurifier');
            $config = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($config);
            // $clean_html = $purifier->purify($dirty_html); //su dung
            //============================== Purifier ==============================

            $war = array();
            $loi = array();
            $id = $_POST['id'];
            if (isset($_POST['page']) && is_numeric($_POST['page'])) {
                $page = $_POST['page'];
            } else {
                $page = 1;
            }
            $insert_data = array();
            $old_detail_image = $this->Product->getDetail_image($id);
            $old_avatar  = $this->Product->getAvatar($id);
            $delete_detail_img = $_POST['delete_detail_img'];

            $glad = false;
            if (count($_FILES['detail_img']['name']) > 0) {
                $imgs=$_FILES['detail_img'];
                $url='';
                $tmp_name_detail_img=array();
                for($i = 0; $i < count($_FILES['detail_img']['name']); $i++)
                {
                    if (strlen($_FILES['detail_img']['name'][$i]) > 0) {
                        $type = end(explode(".", $_FILES['detail_img']['name'][$i]));
                        if (strtolower($type) != 'jpg' && strtolower($type) != 'gif'
                            && strtolower($type) != 'png'
                            ) {
                            $war[] = "Không đúng định dạng ảnh cho phép!";
                    } elseif ( ! isImage($_FILES['detail_img']['tmp_name'][$i])) {
                        $war[] = "Không phải là file ảnh!";
                    } elseif ($_FILES['detail_img']['size'][$i] > 1024000) {
                        $war[] = "Ảnh chi tiết lớn hơn 1MB";
                    } else {
                        $url= $url.'|'.htmlspecialchars(md5($_POST['product_name'])).'-'.$i.time().'.'.$type;
                        $tmp_name_detail_img[] = $_FILES['detail_img']['tmp_name'][$i];
                    }
                }
            }
            if (trim($url,'|') != '') {
                $new_detail_image = trim($url,'|');
                $insert_data['detail_image'] = $old_detail_image.'|'.$new_detail_image;
                $insert_data['detail_image'] = trim($insert_data['detail_image'],'|');
                $glad = true;
            }
        }

        if (!empty($delete_detail_img)) {
            if ($glad) {
                foreach ($delete_detail_img as $value) {
                    $insert_data['detail_image'] = str_replace($value.'|', '', $insert_data['detail_image']);
                }
            } else {
                $insert_data['detail_image'] = $old_detail_image.'|';
                foreach ($delete_detail_img as $value) {
                    $insert_data['detail_image'] = str_replace($value.'|', '', $insert_data['detail_image']);
                }
            }
            $insert_data['detail_image'] = trim($insert_data['detail_image'],'|');
        }
        $avatar_name = $_FILES['avatar']['name'];
            $avatar_type = end(explode(".",$avatar_name)); // lay phan mo rong(.jpg|.gif)
            $insert_data['product_name'] = trim_input($_POST["product_name"]);
            $insert_data['category_id'] = $_POST["category_id"];
            $insert_data['des'] = $purifier->purify($_POST["des"]);
            $insert_data['des'] = addslashes($insert_data['des']);
            $insert_data['price'] = trim_input($_POST["price"]);
            $insert_data['qty'] = trim_input($_POST["qty"]);

            //====================== Validate  ======================
            if (!empty($_FILES['avatar']['name'])) {
                if (strtolower($avatar_type) != 'jpg' && strtolower($avatar_type) != 'gif'
                    && strtolower($avatar_type) != 'png'
                    ) {
                    $loi[] = "Định dạng ảnh không cho phép!";
            } elseif ( ! isImage($_FILES['avatar']['tmp_name'])) {
                $loi[] = "Không phải là file ảnh!";
            } elseif ($_FILES['avatar']['size'] > 1024000) {
                $loi[] = "Ảnh đại diện phải < 1MB";
            } else {
                $tmp_name_avatar = $_FILES['avatar']['tmp_name'];
                $insert_data['image'] = md5($insert_data['product_name']).'-'.time().'.'.$avatar_type;
            }
        }
        if (empty($_POST["product_name"]))  {
            $loi[] = "Tên sản phẩm không được rỗng";
        } elseif((strip_tags($_POST["product_name"]) == '')) {
            $loi[] = "Tên sản phẩm không hợp lệ!";
        } else {
            if (strlen($_POST["product_name"]) >= 4 && strlen($_POST["product_name"]) <= 100) {
                $insert_data['product_name'] = $_POST["product_name"];
                $insert_data['product_name'] = trim($_POST["product_name"]);
                $insert_data['product_name'] = strip_tags($_POST["product_name"]);
                $insert_data['product_name'] = addslashes($insert_data['product_name']);
                $product_name_exist = $this->Product->checkproduct_name($insert_data['product_name'], $id);
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
            || !$this->Product->checkCategory($insert_data['category_id'])
            ) {

            $loi[] = "Loại sản phẩm không hợp lệ!";
        } 
        if (!empty($insert_data['price'])){
            if (!is_numeric($insert_data['price'])) {
                $loi[] = "Giá phải là kiểu số!";
            }
        }
        if (!empty($insert_data['qty'])){
            if (!is_numeric($insert_data['qty'])) {
                $loi[] = "Số lượng phải là kiểu số!";
            }
        } 
            //====================== Validate  ======================

        if (count($loi) > 0) {
            $redata['re_product_name'] = $_POST['product_name'];
            $redata['re_category_id'] = $_POST['category_id'];
            $redata['re_price'] = $_POST['price'];
            $redata['re_qty'] = $_POST['qty'];
            $redata['re_des'] = $_POST['des'];
            $redata['re_page'] = $page;
            $redata['title'] = "Thêm mới sản phẩm";
            $redata['error'] = $loi;
            $this->load->headeradmin();
            $this->load->menuadmin();
            $redata['category'] = $this->Product->get_category();
            $redata['info'] = $this->Product->getProductbyID($id);
            $this->load->view('/product/edit_layout', $redata);
            die;
        }

        $rs = $this->Product->update($id, $insert_data); 

            // ============= Xoa anh chi tiet ===================
        if ($rs && !empty($delete_detail_img)) {
            foreach ($delete_detail_img as $value) {
                @unlink('public/img/detail_img/'.$value);
            }
        }
            // ============= Xoa anh chi tiet ===================

            // ============= Upload anh chi tiet ===================
        if ($rs && count($_FILES['detail_img']['name']) > 0) {
            $detail_image_name = explode('|', $new_detail_image);

            for($i = 0; $i < count($detail_image_name); $i++)
            {
                move_uploaded_file($tmp_name_detail_img[$i],"public/img/detail_img/".$detail_image_name[$i]);
            }
        }
            // ============= Upload anh chi tiet ===================

            // ============= Upload anh avatar ===================
             if ($rs && isset($_FILES['avatar'])) //Neu insert thanh cong va co chon file
             {

                $path = "public/img/products/";
                if (move_uploaded_file($tmp_name_avatar,$path.$insert_data['image'])) {
                    @unlink('public/img/products/'.$old_avatar);
                }
            }
            // ============= Upload anh avatar ===================

            if ($rs) {
                if (!empty($war)) {
                    session_start();
                    $war['title'] = 'Cập nhật sản phẩm '.$insert_data['product_name'].' thành công!';
                    $_SESSION['war'] = $war;
                    header('location:'.base_url.'admin/product');
                } else {
                    $mess = 'Cập nhật sản phẩm '.$insert_data["product_name"].' thành công!';
                    setcookie('success', $mess, time() + 1);
                    header('location:'.base_url.'admin/product?page='.$page);
                }
            } else {
                header('location:'.base_url.'admin/product');
            }
        }
    }

}

