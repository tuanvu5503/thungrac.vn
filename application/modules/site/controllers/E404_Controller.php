<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class E404_Controller extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
        $this->load->view('404-temp');
    }
}

