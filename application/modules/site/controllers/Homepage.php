<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model','Product');
        $this->load->model('Category_model','Category');
        $this->load->model('Acticle_model','Acticle');
        $this->load->library('cart');
        $this->load->helper('convert');
    }
    public function index()
    {
        $all_superCategory = $this->Product->all_superCategory();
        $products['SẢN PHẨM MỚI|0'] = $this->Product->new_product();
        
        foreach ($all_superCategory as $row) {
            $products[$row['super_categoryName'].'|'.$row['id']] = $this->Product->listProductbySuperId($row['id']);
        }
        
        $data['acticle']  = $this->Acticle->get_all_acticle();
        $data['products'] = $products;
        $data['title'] = "Trang chủ";
        $subView = "allProduct_layout";
        $this->build($subView, $data);
    }

    public function view_detail()
    {
        if ($this->uri->segment(5))
        {
            $id = explode('-', $this->uri->segment(5));
            $id = (int) end($id);
            
            $data['info'] = $this->Product->find_productbyid($id);
            if (count($data['info']) == 0)
            {
                $data['title'] = "Xem chi tiết sản phẩm";
                $data['error'] = "Không tìm thấy sản phẩm";
                $this->load->view('/product/error', $data);
                die;
            }
            $data['title'] = "Xem chi tiết sản phẩm";
            $subView = "/product/view_detail";
            $this->build($subView, $data);
        } else {
            $this->load->view('404-temp');
        }
    }

    public function search_product()
    {
        if (isset($_GET['key'])) {
            $key = $_GET['key'];
        } else {
            $key = $this->uri->segment(4);
        }
        $key = filter_var($key, FILTER_SANITIZE_STRING);
        $key = trim($key);
        if ($key != '') {
            //=======================  PHÂN TRANG  ======================= 
            $total_record = $this->Product->total_record_product($key);
            $this->load->library('pagination');
            
            $config['base_url'] = base_url().'index.php/site/homepage/search_product/'.$key;
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
            $data['title_action'] = 'KẾT QUẢ TÌM KIẾM';

            $data['all_pro'] = $this->Product->limit_product($start, $config['per_page'], $key);

            foreach ($data['all_pro'] as &$item) {
                $item['categoryName'] = $this->Category->get_sub_category_name($item['category_id']);
                $item['super_categoryName'] = $this->Category->get_super_category_name($item['category_id']);
            }

            $data['title'] = "Tìm kiếm sản phẩm";
            $data['subData'] = $data;

            $arr_data = $data;
            $subView  = "/search/show_product_layout";

            $this->build($subView, $arr_data);
        } else {
            $data['total_product'] = 0;
            $data['title_action'] = 'KẾT QUẢ TÌM KIẾM';
            $data['all_pro'] = array();
            $data['title'] = "Tìm kiếm sản phẩm";
            $data['subData'] = $data;
            $arr_data = $data;
            $subView  = "/search/show_product_layout";
            $this->build($subView, $arr_data);
        }
    }

    public function product_in_super_category()
    {
        if (NULL !== $this->uri->segment(4) 
            && is_numeric($this->uri->segment(4))
            && $this->Category->has_super_category_exist_by_id($this->uri->segment(4))
        ) {
            $super_category_id = $this->uri->segment(4); 

            //========================== PHÂN TRANG ==========================
            $total_record = $this->Product->total_record_product_in_super_category($super_category_id);

            $this->load->library('pagination');
            
            $config['base_url'] = base_url().'index.php/site/homepage/product_in_super_category/'.$super_category_id;
            $config['total_rows'] = $total_record;
            $config['per_page'] = 12;
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

            foreach ($data['all_pro'] as &$item2) {
                $item2['categoryName'] = $this->Category->get_sub_category_name($item2['category_id']);
                $item2['super_categoryName'] = $this->Category->get_super_category_name($item2['category_id']);
            }
            $data['title'] = $data['all_pro'][0]['super_categoryName'];
            $data['title_action'] = $data['all_pro'][0]['super_categoryName'];
            $data['total_product'] = $total_record;

            $subView = "/search/show_product_layout";
            $arr_data = $data;
            $this->build($subView, $arr_data);
            // $this->output->cache(20);

        } else {
            $data['pre_page'] = base_url();
            $this->load->view('/error/404_layout', $data);
        }
    }

    public function acticle ()
    {
        if (NULL !== $this->uri->segment(4) 
            && is_numeric($this->uri->segment(4))
            && $this->Acticle->has_acticle_exist_by_id($this->uri->segment(4))
        ) {
            $acticle_id = $this->uri->segment(4); 

            $data['title'] = $this->Acticle->get_acticle_name_by_id($acticle_id);
            $data['acticle'] = $this->Acticle->get_acticle_by_id($acticle_id);

            $subView  = "/acticle/view_acticle";
            $arr_data = $data;
            $this->build($subView, $arr_data);
            // $this->output->cache(20);

        } else {
            $data['pre_page'] = base_url();
            $this->load->view('/error/404_layout', $data);
        }
    }

    public function product_in_sub_category()
    {
        if (NULL !== $this->uri->segment(4) 
            && is_numeric($this->uri->segment(4))
            && $this->Category->has_sub_category_exist_by_id($this->uri->segment(4))
        ) {
            $sub_category_id = $this->uri->segment(4); 

            //========================== PHÂN TRANG ==========================
            $total_record = $this->Product->total_record_product_in_sub_category($sub_category_id);

            $this->load->library('pagination');
            
            $config['base_url'] = base_url().'index.php/site/homepage/product_in_sub_category/'.$sub_category_id;
            $config['total_rows'] = $total_record;
            $config['per_page'] = 12;
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
            $data['all_pro'] = $this->Product->limit_product_in_sub_category($sub_category_id, $start, $config['per_page']);

            foreach ($data['all_pro'] as &$item2) {
                $item2['categoryName'] = $this->Category->get_sub_category_name($item2['category_id']);
                $item2['super_categoryName'] = $this->Category->get_super_category_name($item2['category_id']);
            }
            $data['title'] = $this->Category->get_sub_category_name($sub_category_id);
            $data['title_action'] = $data['title'];

            $data['total_product'] = $total_record;

            $subView = "/search/show_product_layout";
            $arr_data = $data;
            $this->build($subView, $arr_data);
            // $this->output->cache(20);

        } else {
            $data['pre_page'] = base_url();
            $this->load->view('/error/404_layout', $data);
        }
    }

    public function contact()
    {
        $this->load->model('Contact_model', 'Contact');
        $data['contact'] = $this->Contact->get_contact();

        $data['title'] = 'Liên hệ';
        $subView = '/contact/show_contact_layout';
        $arr_data = $data;
        $this->build($subView, $arr_data);
    }

    public function build($subView, $arr_data)
    {

        //==================== DATA FOR MENU: START ====================
        $all_superCategory = $this->Product->all_superCategory();
        $products['SẢN PHẨM MỚI'] = $this->Product->new_product();
        foreach ($all_superCategory as $row) {
            $menus[$row['super_categoryName']] = $this->Product->getMenu($row['id']);
        }
        $data['menus'] = $menus;
        $data['menu'] = $this->Product->listCategory();
        //==================== DATA FOR MENU: END ====================

        $data['title']   = $arr_data['title'];
        $data['subView'] = $subView;
        $data['subData'] = $arr_data;
        $this->load->view('main_layout', $data);
    }

}
