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
|	https://codeigniter.com/user_guide/general/routing.html
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

// Default route
$route['default_controller'] = 'home';

// Public routes
$route['concerts'] = 'concert/index';
$route['concert/(:any)'] = 'concert/view/$1';
$route['concerts/search'] = 'concert/search';
$route['concerts/upcoming'] = 'concert/upcoming';
$route['concerts/popular'] = 'concert/popular';
$route['concerts/artist/(:any)'] = 'concert/artist/$1';
$route['concerts/venue/(:any)'] = 'concert/venue/$1';
$route['concerts/category/(:any)'] = 'concert/category/$1';
$route['search'] = 'home/search';

// Band Trokan routes
$route['band-trokan'] = 'bandtrokan/index';
$route['band-trokan/checkout'] = 'bandtrokan/checkout';
$route['band-trokan/process-payment'] = 'bandtrokan/process_payment';

// Auth routes
$route['login'] = 'auth/login';
$route['register'] = 'auth/register';
$route['logout'] = 'auth/logout';
$route['forgot-password'] = 'auth/forgot_password';
$route['reset-password/(:any)'] = 'auth/reset_password/$1';

// User routes (after login)
$route['dashboard'] = 'home/dashboard';
$route['profile'] = 'profile/index';
$route['orders'] = 'order/index';
$route['order/(:any)'] = 'order/view/$1';
$route['order/cancel/(:any)'] = 'order/cancel/$1';
$route['order/payment/(:any)'] = 'order/payment/$1';
$route['order/download/(:any)'] = 'order/download_ticket/$1';
$route['orders/success/(:any)'] = 'orders/success/$1';
$route['cart'] = 'cart/index';
$route['cart/add'] = 'cart/add';
$route['cart/update'] = 'cart/update';
$route['cart/remove'] = 'cart/remove';
$route['cart/clear'] = 'cart/clear';
$route['cart/checkout'] = 'cart/checkout';
$route['checkout'] = 'order/create';

// Admin routes
$route['admin'] = 'admin/index';
$route['admin/dashboard'] = 'admin/index';
$route['admin/profile'] = 'admin/profile';
$route['admin/change-password'] = 'admin/change_password';
$route['admin/settings'] = 'admin/settings';
$route['admin/reports'] = 'admin/reports';
$route['admin/logs'] = 'admin/logs';
$route['admin/backup'] = 'admin/backup';
$route['admin/export/(:any)'] = 'admin/export/$1';

// Admin Concert routes
$route['admin/concerts'] = 'admin_concert/index';
$route['admin/concerts/add'] = 'admin_concert/add';
$route['admin/concerts/edit/(:any)'] = 'admin_concert/edit/$1';
$route['admin/concerts/delete/(:any)'] = 'admin_concert/delete/$1';
$route['admin/concerts/view/(:any)'] = 'admin_concert/view/$1';
$route['admin/concerts/tickets/(:any)'] = 'admin_concert/tickets/$1';
$route['admin/concerts/add-ticket/(:any)'] = 'admin_concert/add_ticket/$1';
$route['admin/concerts/edit-ticket/(:any)'] = 'admin_concert/edit_ticket/$1';
$route['admin/concerts/delete-ticket/(:any)'] = 'admin_concert/delete_ticket/$1';
$route['admin/concerts/status/(:any)/(:any)'] = 'admin_concert/update_status/$1/$2';

// Admin User routes
$route['admin/users'] = 'admin_user/index';
$route['admin/users/add'] = 'admin_user/add';
$route['admin/users/edit/(:any)'] = 'admin_user/edit/$1';
$route['admin/users/delete/(:any)'] = 'admin_user/delete/$1';
$route['admin/users/view/(:any)'] = 'admin_user/view/$1';
$route['admin/users/block/(:any)'] = 'admin_user/block/$1';
$route['admin/users/unblock/(:any)'] = 'admin_user/unblock/$1';
$route['admin/users/reset-password/(:any)'] = 'admin_user/reset_password/$1';
$route['admin/users/search'] = 'admin_user/search';
$route['admin/users/role/(:any)'] = 'admin_user/by_role/$1';
$route['admin/users/active'] = 'admin_user/active';

// Admin Order routes
$route['admin/orders'] = 'admin_order/index';
$route['admin/orders/view/(:any)'] = 'admin_order/view/$1';
$route['admin/orders/update-status/(:any)'] = 'admin_order/update_status/$1';
$route['admin/orders/cancel/(:any)'] = 'admin_order/cancel/$1';
$route['admin/orders/delete/(:any)'] = 'admin_order/delete/$1';
$route['admin/orders/status/(:any)'] = 'admin_order/by_status/$1';
$route['admin/orders/search'] = 'admin_order/search';
$route['admin/orders/date'] = 'admin_order/by_date';
$route['admin/orders/user/(:any)'] = 'admin_order/by_user/$1';
$route['admin/orders/export'] = 'admin_order/export';
$route['admin/orders/print/(:any)'] = 'admin_order/print_order/$1';
$route['admin/orders/send-email/(:any)'] = 'admin_order/send_email/$1';
$route['admin/orders/statistics'] = 'admin_order/statistics';

// API routes (for AJAX)
$route['api/check-email'] = 'auth/check_email';
$route['api/check-username'] = 'auth/check_username';
$route['api/cart/add'] = 'cart/add';
$route['api/cart/update'] = 'cart/update';
$route['api/cart/remove'] = 'cart/remove';
$route['api/cart/summary'] = 'cart/summary';
$route['api/cart/validate'] = 'cart/validate';
$route['api/concert/tickets/(:any)'] = 'concert/get_tickets/$1';
$route['api/concert/ticket/(:any)'] = 'concert/get_ticket/$1';
$route['api/order/status/(:any)'] = 'order/status/$1';

// Migration routes (for development)
$route['migrate'] = 'migration/index';
$route['migrate/status'] = 'migration/status';
$route['migrate/reset'] = 'migration/reset';

// Static pages
$route['about'] = 'home/about';
$route['contact'] = 'home/contact';
$route['terms'] = 'home/terms';
$route['privacy'] = 'home/privacy';
$route['faq'] = 'home/faq';

// Error pages
$route['404_override'] = 'errors/page_missing';
$route['translate_uri_dashes'] = FALSE;
