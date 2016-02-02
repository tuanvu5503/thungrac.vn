<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends MX_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Order_model','Order');
        $this->load->model('Product_model','Product');
    }
    
    public function show_order()
    {
        //========================== PHÂN TRANG ==========================
        $total_record = $this->Order->total_record_order();

        $this->load->library('pagination');
        
        $config['base_url'] = base_url().'index.php/_admin/order/show_order';
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

        $all_order  = $this->Order->limit_order($start, $config['per_page']);
        foreach ($all_order as &$item) {
            $arr_product_qty = explode('|', $item['product_id_and_qty']);
            $arr_product_name_and_qty = array();
            
            foreach ($arr_product_qty as $item2) {
                $tmp = explode('-', $item2);
                if ($this->Product->check_product_by_id($tmp[0])) {
                    $product_name = $this->Product->get_product_name_by_id($tmp[0]);
                    $qty = $tmp[1];
                    $price = $this->Product->get_product_price_by_id($tmp[0]);

                    $tmp2['product_name'] = $product_name;
                    $tmp2['order_qty'] = $qty;
                    $tmp2['price'] = $price;

                    $arr_product_name_and_qty[] = $tmp2;
                } else {
                    $tmp2['product_name'] = 'Sản phẩm không tồn tại hoặc đã bị xóa';
                    $tmp2['order_qty'] = 0;
                    $tmp2['price'] = 0;
                    
                    $arr_product_name_and_qty[] = $tmp2;
                }

            }
            $item['product_name_and_qty'] = $arr_product_name_and_qty;
            unset($item);
        }

        $data['all_order']   = $all_order;
        $data['un_approval_order'] = $this->Order->total_record_un_approval_order();
        $data['subView']     = '/order/show_order_layout';
        $data['title']       = "Quản lý đơn hàng";
        $data['subData']     = $data;
        $this->load->view('/main/main_layout', $data);
    }

    public function delete_order()
    {
        if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
            die();
        }

        if(isset($_POST["del_id"]) 
            && is_numeric($_POST["del_id"])
            && $this->Order->has_order_exist_by_id($_POST["del_id"])
        ){
            $error = array();
            $del_id = $_POST['del_id'];

            $error['status'] = $this->Order->delete_order_by_id($del_id);

            $error['un_approval_order'] = $this->Order->total_record_un_approval_order();
            $error['mess']   = $error['status'] == SUCCESS_STATUS ? 'Xóa đơn hàng thành công.' : 'Xóa đơn hàng thất bại.';
            echo json_encode($error);
        } else {
            $error['status'] = FAILED_STATUS;
            $error['mess']   = $error['status'] == SUCCESS_STATUS ? 'Xóa đơn hàng thành công.' : 'Xóa đơn hàng thất bại.';
            echo json_encode($error);
        }
    }

    public function approve_order()
    {
        if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
            die();
        }

        if(isset($_POST["approval_id"]) 
            && is_numeric($_POST["approval_id"])
            && $this->Order->has_order_exist_by_id($_POST["approval_id"])
        ){
            $error = array();
            $approval_id = $_POST['approval_id'];

            $error['status'] = $this->Order->approve_order_by_id($approval_id);
            
            $error['un_approval_order'] = $this->Order->total_record_un_approval_order();
            $error['mess']   = $error['status'] == SUCCESS_STATUS ? 'Duyệt đơn hàng thành công.' : 'Duyệt đơn hàng thất bại.';
            echo json_encode($error);
        } else {
            $error['status'] = FAILED_STATUS;
            $error['mess']   = $error['status'] == SUCCESS_STATUS ? 'Duyệt đơn hàng thành công.' : 'Duyệt đơn hàng thất bại.';
            echo json_encode($error);
        }
    }

    public function check_qty_unapprove()
    {
        $rs['un_approval_order'] = $this->Order->total_record_un_approval_order();
        echo json_encode($rs);
    }
}

