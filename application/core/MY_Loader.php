<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* load the MX_Loader class */
require APPPATH."third_party/MX/Loader.php";

class MY_Loader extends MX_Loader {
	public function __construct()
    {
        parent::__construct();
        require_once (FCPATH.'public/php_function_common/php_function.php');
    }
}