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
        $this->load->model('Slider_model','Slider');
        $this->load->library('cart');
        $this->load->helper('My_url');
        $this->load->helper('convert');
    }
    public function index()
    {
        $all_superCategory = $this->Product->all_superCategory();
        $products['SẢN PHẨM MỚI|0'] = $this->Product->new_product();
        
        foreach ($all_superCategory as $row) {
            $products[$row['super_categoryName'].'|'.$row['id']] = $this->Product->listProductbySuperId($row['id']);
        }
        
        $data['slider_info'] = $this->Slider->get_all_slider();
        $data['acticle']  = $this->Acticle->get_all_acticle();
        $data['products'] = $products;
        $data['title'] = "Trang chủ";
        $subView = "allProduct_layout";
        build_site($subView, $data);
    }

    public function view_detail()
    {
        if (NULL != $this->uri->segment(4)
            && $this->Product->check_product_exist(get_id_in_url($this->uri->segment(4)))
        ){
            $id = substr( strrchr($this->uri->segment(4), '-'), 1);

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
            build_site($subView, $data);
        } else {
            $data['pre_page'] = base_url();
            $this->load->view('/error/404_layout', $data);
        }
    }

    public function search_product()
    {
        $key = $this->uri->segment(2);
        
        $key = filter_var($key, FILTER_SANITIZE_STRING);
        $key = trim($key);
        if ($key != '') {
            //=======================  PHÂN TRANG  ======================= 
            $total_record = $this->Product->total_record_product($key);
            $this->load->library('pagination');
            
            $config['base_url'] = base_url().'tim-kiem/'.$key.'/page';
            $config['total_rows'] = $total_record;
            $config['per_page'] = 16;
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

            $start = NULL !== $this->uri->segment(4) ? $this->uri->segment(4) : 0;

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

            build_site($subView, $arr_data);
        } else {
            $data['total_product'] = 0;
            $data['title_action'] = 'KẾT QUẢ TÌM KIẾM';
            $data['all_pro'] = array();
            $data['title'] = "Tìm kiếm sản phẩm";
            $data['subData'] = $data;
            $arr_data = $data;
            $subView  = "/search/show_product_layout";
            build_site($subView, $arr_data);
        }
    }

    public function product_in_super_category()
    {
        if (NULL !== $this->uri->segment(2) 
            && is_numeric(get_id_in_url($this->uri->segment(2)))
            && $this->Category->has_super_category_exist_by_id(get_id_in_url($this->uri->segment(2)))
        ) {
            $super_category_id = get_id_in_url($this->uri->segment(2)); 
            $super_category_name = $this->Category->get_super_category_name($super_category_id);
            $url_super_category_name = name_in_url($super_category_name);

            //========================== PHÂN TRANG ==========================
            $total_record = $this->Product->total_record_product_in_super_category($super_category_id);

            $this->load->library('pagination');
            
            $config['base_url'] = base_url().'xem-tat-ca/'.$url_super_category_name.'-'.$super_category_id.'/page';
            $config['total_rows'] = $total_record;
            $config['per_page'] = 16;
            $config['uri_segment'] = 4;
            $config['num_links'] = 3;
            $config['suffix'] = '.html';
            $config['first_url'] = '0.html';

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
            build_site($subView, $arr_data);
            // $this->output->cache(20);

        } else {
            $data['pre_page'] = base_url();
            $this->load->view('/error/404_layout', $data);
        }
    }

    public function acticle ()
    {
        if (NULL !== $this->uri->segment(2) 
            && is_numeric(get_id_in_url($this->uri->segment(2)))
            && $this->Acticle->has_acticle_exist_by_id(get_id_in_url($this->uri->segment(2)))
        ) {
            $acticle_id = get_id_in_url($this->uri->segment(2));
            
            $data['title'] = $this->Acticle->get_acticle_name_by_id($acticle_id);
            $data['acticle'] = $this->Acticle->get_acticle_by_id($acticle_id);

            $subView  = "/acticle/view_acticle";
            $arr_data = $data;
            build_site($subView, $arr_data);
            // $this->output->cache(20);

        } else {
            $data['pre_page'] = base_url();
            $this->load->view('/error/404_layout', $data);
        }
    }

    public function product_in_sub_category()
    {
        if (NULL !== $this->uri->segment(2) 
            && $this->Category->has_sub_category_exist_by_id(get_id_in_url($this->uri->segment(2)))
        ) {
            $sub_category_id = get_id_in_url($this->uri->segment(2)); 
            $category_name = $this->Category->get_sub_category_name($sub_category_id);
            $url_category_name = name_in_url($category_name);

            //========================== PHÂN TRANG ==========================
            $total_record = $this->Product->total_record_product_in_sub_category($sub_category_id);

            $this->load->library('pagination');
            
            $config['base_url'] = base_url().'danh-muc/'.$url_category_name.'-'.$sub_category_id.'/page';
            $config['total_rows'] = $total_record;
            $config['per_page'] = 16;
            $config['uri_segment'] = 4;
            $config['num_links'] = 3;
            $config['suffix'] = '.html';
            $config['first_url'] = '0.html';
            
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
            build_site($subView, $arr_data);
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
        build_site($subView, $arr_data);
    }

}
