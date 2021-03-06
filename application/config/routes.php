<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'site/homepage';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;

//=============================START: REWRITE URL SITE PAGE ===========================
$route['san-pham/(:any)/(:any)/(:any).html'] = 'site/homepage/view_detail/$1/$2/$3';

$route['dat-hang.html'] = 'site/cart/view_order';

$route['tim-kiem/(:any)/page/(:any)'] = 'site/homepage/search_product/$1/$2';
$route['tim-kiem/(:any)/page'] = 'site/homepage/search_product/$1';
$route['tim-kiem/(:any)'] = 'site/homepage/search_product/$1';

$route['danh-muc/(:any)/page/(:any).html'] = 'site/homepage/product_in_sub_category/$1/$2';
$route['danh-muc/(:any).html'] = 'site/homepage/product_in_sub_category/$1';

$route['xem-tat-ca/(:any)/page/(:any).html'] = 'site/homepage/product_in_super_category/$1/$2';
$route['xem-tat-ca/(:any).html'] = 'site/homepage/product_in_super_category/$1';

$route['lien-he.html'] = 'site/homepage/contact';

$route['bai-viet/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any).html'] = 'site/homepage/acticle/$1/$2/$3/$4/$5/$6/$7/$8/$9/$10';
$route['bai-viet/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any).html'] = 'site/homepage/acticle/$1/$2/$3/$4/$5/$6/$7/$8/$9';
$route['bai-viet/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any).html'] = 'site/homepage/acticle/$1/$2/$3/$4/$5/$6/$7/$8';
$route['bai-viet/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any).html'] = 'site/homepage/acticle/$1/$2/$3/$4/$5/$6/$7';
$route['bai-viet/(:any)/(:any)/(:any)/(:any)/(:any).html'] = 'site/homepage/acticle/$1/$2/$3/$4/$5';
$route['bai-viet/(:any)/(:any)/(:any)/(:any).html'] = 'site/homepage/acticle/$1/$2/$3/$4';
$route['bai-viet/(:any)/(:any)/(:any).html'] = 'site/homepage/acticle/$1/$2/$3';
$route['bai-viet/(:any)/(:any).html'] = 'site/homepage/acticle/$1/$2';
$route['bai-viet/(:any).html'] = 'site/homepage/acticle/$1';

//=============================END: REWRITE URL SITE PAGE =============================


//=============================START: REWRITE URL ADMIN PAGE ===========================
$route['login'] = '_admin/login/index';

//=============================END: REWRITE URL ADMIN PAGE =============================

