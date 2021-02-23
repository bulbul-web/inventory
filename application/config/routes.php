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


$route['login'] = 'users';
$route['login-check'] = 'users/login_check';
$route['logout'] = 'users/logout';



$route['default_controller'] = 'dashboard';
$route['account'] = 'dashboard/account_form_view';
$route['update-user'] = 'dashboard/update_user';
$route['change-password'] = 'dashboard/change_password_form_view';
$route['update-password'] = 'dashboard/change_password';

$route['suppliers'] = 'suppliers/suppliers';
$route['suppliers-form'] = 'suppliers/suppliers_add_form_view';
$route['save-suppliers'] = 'suppliers/save_suppliers';
$route['edit-supplier/(.+)'] = 'suppliers/suppliers_edit_form_view/$1';
$route['update-suppliers'] = 'suppliers/update_suppliers';
$route['delete-supplier/(.+)'] = 'suppliers/delete_supplier/$1';


$route['product-type'] = 'products/product_type';
$route['products-type-form'] = 'products/products_type_add_form_view';
$route['save-products-type'] = 'products/save_products_type';
$route['edit-product-type/(.+)'] = 'products/edit_product_type_form_view/$1';
$route['update-product-type'] = 'products/update_product_type';
$route['delete-product-type/(.+)'] = 'products/delete_product_type/$1';

$route['products'] = 'products/products';
$route['product-details/(.+)'] = 'products/product_details/$1';
$route['products-form'] = 'products/products_form';
$route['save-products'] = 'products/save_products';
$route['edit-product/(.+)'] = 'products/edit_product_form/$1';
$route['update-products'] = 'products/update_products';
$route['delete-product/(.+)'] = 'products/delete_product/$1';

$route['products-stock-in'] = 'products/stock_in';
$route['stock-in-form'] = 'products/stock_in_form';
$route['save-stock-in'] = 'products/save_stock_in';
$route['stock-details/(.+)'] = 'products/stock_in_details/$1';
$route['edit-stock-in/(.+)'] = 'products/edit_stock_in_form/$1';
$route['update-stock-in'] = 'products/update_stock_in';
$route['delete-stock-in/(.+)'] = 'products/delete_stock_in/$1';

$route['pack-size'] = 'products/pack_size_list';
$route['pack-size-add'] = 'products/pack_size_add_form_view';
$route['save-pack-size'] = 'products/save_pack_size';
$route['edit-pack-size/(.+)'] = 'products/edit_pack_size_form_view/$1';
$route['update-pack-size'] = 'products/update_pack_size';
$route['delete-pack-size/(.+)'] = 'products/delete_pack_size/$1';

$route['customers'] = 'customers/customers';
$route['customer-form'] = 'customers/customer_form_view';
$route['save-customers'] = 'customers/save_customers';
$route['edit-customer/(.+)'] = 'customers/customer_edit_form_view/$1';
$route['update-customers'] = 'customers/update_customers';
$route['delete-customer/(.+)'] = 'customers/delete_customer/$1';

$route['warehouse'] = 'warehouse/warehouse';
$route['warehouse-form'] = 'warehouse/warehouse_form_view';
$route['save-warehouse'] = 'warehouse/save_warehouse';
$route['edit-warehouse/(.+)'] = 'warehouse/warehouse_edit_form_view/$1';
$route['update-warehouse'] = 'warehouse/update_warehouse';
$route['delete-warehouse/(.+)'] = 'warehouse/delete_warehouse/$1';

$route['invoice'] = 'invoice/invoice';
$route['invoice-form'] = 'invoice/invoice_form_view';
$route['get-customers/(:any)'] = 'invoice/get_all_customer_match/$1';
$route['get-products/(:any)'] = 'invoice/get_all_products_match/$1';
$route['save-invoice'] = 'invoice/save_invoice';
$route['edit-invoice/(:any)'] = 'invoice/edit_invoice_form_view/$1';
$route['update-invoice'] = 'invoice/update_invoice';
$route['invoice-details/(:any)'] = 'invoice/invoice_single_details/$1';
$route['invoice-status/(:num)/(:num)'] = 'invoice/invoice_status/$1/$2';
$route['delete-invoice/(:num)'] = 'invoice/delete_invoice/$1';
$route['delete-invoice-product/(:num)/(:num)'] = 'invoice/delete_invoice_product/$1/$2';

$route['loan'] = 'loan/loan';
$route['loan-form'] = 'loan/loan_form_view';
$route['save-loan'] = 'loan/save_loan';
$route['details-loan/(:any)'] = 'loan/details_loan_view/$1';
$route['edit-loan/(:any)'] = 'loan/edit_loan_form_vew/$1';
$route['update-loan'] = 'loan/update_loan';
$route['delete-loan/(.+)'] = 'loan/delete_loan/$1';

$route['month-report'] = 'reports/month_report';
$route['stock-report'] = 'reports/stock_report';
$route['all-products-stock-report'] = 'reports/all_products_stock_report';
$route['product-out-by-customer'] = 'reports/product_out_by_customer';
$route['name-month-report'] = 'reports/name_and_month_report';
$route['all-report-section'] = 'reports/all_report_section';
$route['customer-wise-report-payment'] = 'reports/customer_wise_report_payment';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
