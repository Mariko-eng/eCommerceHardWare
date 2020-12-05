<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// CUSTOMER ROUTES
$route['ezimba/welcome'] = 'customer/myindex';
$route['ezimba/allproducts'] = 'customer/myproducts';
$route['ezimba/singleproduct/(:any)'] = 'customer/myproduct/$1';
$route['ezimba/cartitems'] = 'customer/mycartitems';
$route['ezimba/addcartitem'] = 'customer/add_new_cart_item';
$route['ezimba/updatecartitemqty'] = 'customer/update_cart_item_qty';
$route['ezimba/removeitemfromcart'] = 'customer/remove_item_from_cart';
$route['ezimba/checkout'] = 'customer/myproductcheckout';
$route['ezimba/placeorder'] = 'customer/place_order';
$route['ezimba/login'] = 'customer/mylogin';
$route['ezimba/logout'] = 'customer/mylogout';

// ADMIN ROUTES
$route['adminlogin'] = 'admin'; //login
$route['adminlogout'] = 'admin/logout';
$route['products'] = 'admin/allproducts';
$route['newproduct'] = 'admin/newproduct';
$route['admin_dashboard'] = 'admin/adminDashboard';
$route['updateproduct/(:any)'] = 'admin/updateproduct/$1';
$route['deleteproduct/(:any)'] = 'admin/deleteproduct/$1';
$route['getorders'] = 'admin/getorders';
$route['confirmorder/(:any)'] = 'admin/confirmorder/$1';
$route['transactions/summary'] = 'admin/summary';
$route['transactions/inventory'] = 'admin/inventory';
