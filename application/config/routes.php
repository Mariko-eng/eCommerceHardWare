<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// $route['addProduct'] = 'login/addProducts';
// $route['productupgrade/(:any)'] = 'login/updateProduct/$1';

// $route['uploading'] = 'upload';

// $route['work'] = 'mark/bio/40';
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// CUSTOMER ROUTES
$route['welcome'] = 'customer/home';
$route['customerlogin'] = 'customer/login';
$route['customerlogout'] = 'customer/logout';
$route['products'] = 'customer'; // listproducts for index()
$route['productdetail/(:any)'] = 'customer/singleproduct/$1';
$route['newcartitem/(:any)'] = 'customer/add_cart_item/$1';
$route['updatecartitem/(:any)'] = 'customer/update_cart_item/$1';
$route['deletecartitem/(:any)'] = 'customer/remove_cart_item/$1';
$route['displaycartitems'] = 'customer/display_cart';
$route['makeorder'] = 'customer/make_order';
$route['proceed_to_checkout'] = 'customer/checkout';

// ADMIN ROUTES
$route['adminlogin'] = 'admin'; //login
$route['adminlogout'] = 'admin/logout';
$route['newproduct'] = 'admin/newproduct';
$route['admin_dashboard'] = 'admin/adminDashboard';
$route['updateproduct/(:any)'] = 'admin/updateproduct/$1';
$route['deleteproduct/(:any)'] = 'admin/deleteproduct/$1';
$route['getorders'] = 'admin/getorders';
$route['confirmorder/(:any)'] = 'admin/confirmorder/$1';
$route['transactions/summary'] = 'admin/summary';
$route['transactions/inventory'] = 'admin/inventory';

$route['maps'] = 'home';