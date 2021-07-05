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
$route['company-setup'] = 'dashboard/company_setup';
$route['update-company'] = 'dashboard/update_company';

$route['suppliers'] = 'suppliers/suppliers';
$route['suppliers-form'] = 'suppliers/suppliers_add_form_view';
$route['save-suppliers'] = 'suppliers/save_suppliers';
$route['edit-supplier/(.+)'] = 'suppliers/suppliers_edit_form_view/$1';
$route['update-suppliers'] = 'suppliers/update_suppliers';
$route['delete-supplier/(.+)'] = 'suppliers/delete_supplier/$1';


$route['products-category-form'] = 'products/products_category_form';
$route['save-products-category'] = 'products/save_products_category';
$route['product-category'] = 'products/product_category';
$route['edit-product-category/(.+)'] = 'products/edit_product_category/$1';
$route['update-product-category'] = 'products/update_product_category';

$route['product-type'] = 'products/product_type';
$route['products-type-form'] = 'products/products_type_add_form_view';
$route['save-products-type'] = 'products/save_products_type';
$route['edit-product-type/(.+)'] = 'products/edit_product_type_form_view/$1';
$route['update-product-type'] = 'products/update_product_type';
$route['delete-product-type/(.+)'] = 'products/delete_product_type/$1';

$route['products-section'] = 'products/products_section';
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
$route['purchase-report/(.+)'] = 'products/purchase_report/$1';

$route['pack-size'] = 'products/pack_size_list';
$route['pack-size-add'] = 'products/pack_size_add_form_view';
$route['save-pack-size'] = 'products/save_pack_size';
$route['edit-pack-size/(.+)'] = 'products/edit_pack_size_form_view/$1';
$route['update-pack-size'] = 'products/update_pack_size';
$route['delete-pack-size/(.+)'] = 'products/delete_pack_size/$1';

$route['customer-section'] = 'customers/customer_section';
$route['customer-category-form'] = 'customers/customer_category_form';
$route['save-customer-category'] = 'customers/save_customer_category';
$route['customer-category'] = 'customers/customer_category';
$route['edit-customer-category/(.+)'] = 'customers/edit_customer_category/$1';
$route['update-customer-category'] = 'customers/update_customer_category';
$route['customer-subcategory-form'] = 'customers/customer_subcategory_form';
$route['save-customer-subcategory'] = 'customers/save_customer_subcategory';
$route['customer-subcategory'] = 'customers/customer_subcategory';
$route['edit-customer-subcategory/(.+)'] = 'customers/edit_customer_subcategory/$1';
$route['update-customer-subcategory'] = 'customers/update_customer_subcategory';
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
$route['invoice-details-copy/(:any)'] = 'invoice/invoice_details_copy/$1';
$route['invoice-status/(:num)/(:num)'] = 'invoice/invoice_status/$1/$2';
$route['delete-invoice/(:num)'] = 'invoice/delete_invoice/$1';
$route['delete-invoice-product/(:num)/(:num)'] = 'invoice/delete_invoice_product/$1/$2';
$route['accept-order/(:any)'] = 'invoice/accept_order/$1';

$route['order'] = 'order/order';
$route['order-form'] = 'order/order_form_view';
$route['save-order'] = 'order/save_order';
$route['order-details/(:any)'] = 'order/order_single_details/$1';
$route['edit-order/(:any)'] = 'order/edit_order_form_view/$1';
$route['update-order'] = 'order/update_order';
$route['delete-order-product/(:num)/(:num)'] = 'order/delete_order_product/$1/$2';
$route['order-details-copy/(:any)'] = 'order/order_details_copy/$1';

$route['salesman-order'] = 'salesmanorder/order';
$route['reject-salesman-order-list'] = 'salesmanorder/reject_salesman_order_list';
$route['salesman-order-form'] = 'salesmanorder/order_form_view';
$route['save-salesman-order'] = 'salesmanorder/save_order';
$route['salesman-order-details/(:any)'] = 'salesmanorder/order_single_details/$1';
$route['edit-salesman-order/(:any)'] = 'salesmanorder/edit_order_form_view/$1';
$route['update-salesman-order'] = 'salesmanorder/update_order';
$route['delete-salesman-order-product/(:num)/(:num)'] = 'salesmanorder/delete_order_product/$1/$2';
$route['salesman-order-details-copy/(:any)'] = 'salesmanorder/order_details_copy/$1';
$route['accept-salesman-order/(:any)'] = 'salesmanorder/accept_salesman_order/$1';
$route['reject-salesman-order'] = 'salesmanorder/reject_salesman_order';

$route['loan'] = 'loan/loan';
$route['loan-form'] = 'loan/loan_form_view';
$route['save-loan'] = 'loan/save_loan';
$route['details-loan/(:any)'] = 'loan/details_loan_view/$1';
$route['edit-loan/(:any)'] = 'loan/edit_loan_form_vew/$1';
$route['update-loan'] = 'loan/update_loan';
$route['delete-loan/(.+)'] = 'loan/delete_loan/$1';

$route['month-report'] = 'reports/month_report';
$route['stock-report'] = 'reports/stock_report';
$route['product-datewise-report'] = 'reports/product_datewise_report';
$route['datewise-stock-report'] = 'reports/datewise_stock_report';
$route['all-products-stock-report'] = 'reports/all_products_stock_report';
$route['product-out-by-customer'] = 'reports/product_out_by_customer';
$route['datewise-product-out'] = 'reports/datewise_product_out';
$route['name-month-report'] = 'reports/name_and_month_report';
$route['all-report-section'] = 'reports/all_report_section';
$route['customer-wise-report-payment'] = 'reports/customer_wise_report_payment';
$route['datewise-collection-from-customer'] = 'reports/datewise_collection_from_customer';
$route['datewise-collection'] = 'reports/datewise_collection';
$route['supplier-and-datewise-buy-product'] = 'reports/supplier_and_datewise_buy_product';
$route['supplier-and-datewise-payment-history'] = 'reports/supplier_and_datewise_payment_history';
$route['datewise-payment-history'] = 'reports/datewise_payment_history';
$route['datewise-buy-product'] = 'reports/datewise_buy_product';
$route['productwise-profit'] = 'reports/productwise_profit';

$route['invoice-report-section'] = 'reports/invoice_report_section';
$route['stock-report-section'] = 'reports/stock_report_section';
$route['stock-out-report-section'] = 'reports/stock_out_report_section';
$route['collection-report-section'] = 'reports/collection_report_section';
$route['supplier-due-list'] = 'reports/supplier_due_list';

$route['account-reports-section'] = 'reports/account_reports_section';
$route['date-wise-transaction-report'] = 'reports/date_wise_transaction_report';
$route['transactionwise-voucher-report'] = 'reports/transactionwise_voucher_report';

$route['expense-report-section'] = 'reports/expense_report_section';
$route['datewise-expense'] = 'reports/datewise_expense';

$route['costs-head'] = 'costs/costs_head';
$route['transaction-head-add'] = 'costs/transaction_head_add_form';
$route['save-transaction-head'] = 'costs/save_transaction_head';
$route['edit-transaction-head/(.+)'] = 'costs/edit_transaction_head_form/$1';
$route['edit-transaction/(:any)'] = 'costs/edit_transaction_form/$1';
$route['update-transaction-head'] = 'costs/update_transaction_head';
$route['delete-transaction-head/(.+)'] = 'costs/delete_transaction_head/$1';

$route['costs-list'] = 'costs/costs_list';
$route['transaction-add'] = 'costs/transaction_add_form';
$route['save-expense'] = 'costs/save_expense';
$route['get-transaction-head/(:any)'] = 'costs/get_all_transaction_head_match/$1';
$route['costs-details/(.+)'] = 'costs/costs_details/$1';
$route['delete-expense/(:num)/(:num)'] = 'costs/delete_expense/$1/$2';
$route['delete-expense-status/(:num)/(:num)'] = 'costs/delete_expense_status/$1/$2';
$route['update-expense'] = 'costs/update_expense';

$route['account-sub-head'] = 'account/account_sub_head_list';
$route['account-sub-head-add'] = 'account/account_sub_head_add';
$route['save-acnt-sub-head'] = 'account/save_acnt_sub_head';
$route['sub-head-edit/(.+)'] = 'account/sub_head_edit_form/$1';
$route['update-acnt-sub-head'] = 'account/update_acnt_sub_head';

$route['account-sub-sub-head'] = 'account/account_sub_sub_head_list';
$route['account-sub-sub-head-add'] = 'account/account_sub_sub_head_add';
$route['get-sub-head-by-contrl-id/(.+)'] = 'account/get_sub_head_by_contrl_id/$1';
$route['get-transaction-head-account/(:any)'] = 'account/get_transaction_head_match/$1';
$route['save-acnt-sub-sub-head'] = 'account/save_acnt_sub_sub_head';

$route['acnt-tansaction-head-list'] = 'account/acnt_tansaction_head_list';
$route['account-tansaction-head-add'] = 'account/account_tansaction_head_add';
$route['save-acnt-tansaction-head'] = 'account/save_acnt_tansaction_head';
$route['get-sub-sub-head-by-subId/(.+)'] = 'account/get_sub_sub_head_by_subId/$1';

$route['fiscal-year'] = 'account/fiscal_year';
$route['fiscal-year-add'] = 'account/fiscal_year_add';
$route['save-fiscal-year'] = 'account/save_fiscal_year';

$route['opening-balance'] = 'account/opening_balance';
$route['account-opening-blnce-add'] = 'account/account_opening_blnce_add';
$route['save-opening-balance'] = 'account/save_opening_balance';
$route['get-transaction-head-by-sub-sub-Id/(.+)'] = 'account/get_transaction_head_by_sub_sub_Id/$1';
$route['get-transaction-by-contrl-head-id/(.+)'] = 'account/get_transaction_by_contrl_head_id/$1';

$route['transaction-list'] = 'account/transaction_list';
$route['account-transaction-add'] = 'account/account_transaction_add';
$route['save-acnt-tansaction-mltple'] = 'account/save_acnt_tansaction_mltple';
$route['save-acnt-tansaction-mltple-trns-all'] = 'account/save_acnt_tansaction_mltple_trns_all';
$route['save-acnt-tansaction'] = 'account/save_acnt_tansaction';
$route['get-transaction-by-v-type/(:any)'] = 'account/get_transaction_by_v_type/$1';
$route['get-control-head-by-v-type/(:any)'] = 'account/get_control_head_by_v_type/$1';
$route['edit-transaction-account/(:any)'] = 'account/edit_transaction_account_form/$1';
$route['update-acnt-tansaction-mltple-trns-all'] = 'account/update_acnt_tansaction_mltple_trns_all';
$route['delete-tansaction-status/(:num)/(:num)'] = 'account/delete_tansaction_status/$1/$2';

$route['DrCr-Voucher-Details/(.+)'] = 'account/DrCr_Voucher_Details/$1';

$route['journal-transaction-list'] = 'account/journal_transaction_list';
$route['account-journal-transaction-add'] = 'account/account_journal_transaction_add';
$route['save-acnt-journal-tansaction-mltple-trns-all'] = 'account/save_acnt_journal_tansaction_mltple_trns_all';
$route['edit-journal-transaction-account/(:any)'] = 'account/edit_journal_transaction_account_form/$1';
$route['update-acnt-journal-tansaction-mltple-trns-all'] = 'account/update_acnt_journal_tansaction_mltple_trns_all';


$route['all-users'] = 'users/all_users';
$route['add-user'] = 'users/add_user_form';
$route['save-user'] = 'users/save_user';
$route['edit-user/(:any)'] = 'users/edit_user_form/$1';
$route['update-user-particular'] = 'users/update_user_particular';

$route['marketing-setup-section'] = 'users/marketing_setup_section';
$route['manager-add'] = 'users/add_manager_form';
$route['save-manager'] = 'users/save_manager';
$route['manager-list'] = 'users/manager_list';
$route['edit-manager/(:any)'] = 'users/edit_manager_form/$1';
$route['update-manager-particular'] = 'users/update_manager_particular';
$route['change-password-manager/(:any)'] = 'users/change_password_form_view_manager/$1';
$route['update-password-manager'] = 'users/change_password_manager';

$route['regional-manager-add'] = 'users/add_regional_manager_form';
$route['save-regional-manager'] = 'users/save_regional_manager';
$route['regional-manager-list'] = 'users/regional_manager_list';
$route['edit-regional-manager/(:any)'] = 'users/edit_regional_manager_form/$1';
$route['update-regional-manager-particular'] = 'users/update_regional_manager_particular';
$route['change-password-regional-manager/(:any)'] = 'users/change_password_regional_manager/$1';
$route['update-password-regional-manager'] = 'users/update_password_regional_manager';

$route['salesman-add'] = 'users/add_salesman_form';
$route['save-salesman'] = 'users/save_salesman';
$route['salesman-list'] = 'users/salesman_list';
$route['edit-salesman/(:any)'] = 'users/edit_salesman_form/$1';
$route['update-salesman-particular'] = 'users/update_salesman_particular';
$route['change-password-salesman/(:any)'] = 'users/change_password_salesman/$1';
$route['update-password-salesman'] = 'users/update_password_salesman';

$route['qrcode'] = 'QrcodeController/qrcode_generator_by_input';
$route['qrcode-form'] = 'QrcodeController/qrcode_form';
$route['save-qrcode'] = 'QrcodeController/save_qrcode';

$route['sell-list-from-common-customer'] = 'AssignCollection/sell_list_from_common_customer';
$route['sell-from-common-customer-add'] = 'AssignCollection/sell_from_common_customer_add_form';
$route['save-assign-sell'] = 'AssignCollection/save_assign_sell';
$route['edit-assign-amount/(:any)'] = 'AssignCollection/edit_assign_amount_form/$1';
$route['update-assign-sell'] = 'AssignCollection/update_assign_sell';
$route['delete-assign-amount/(:any)'] = 'AssignCollection/delete_assign_amount/$1';

$route['amount-recieved-list-from-common-customer'] = 'AssignCollection/amount_recieved_list_from_common_customer';
$route['amount-recieved-common-customer-add'] = 'AssignCollection/amount_recieved_common_customer_add_form';
$route['save-received-amount'] = 'AssignCollection/save_received_amount';
$route['edit-received-amount/(:any)'] = 'AssignCollection/edit_received_amount_form/$1';
$route['update-received-amount'] = 'AssignCollection/update_received_amount';
$route['delete-received-amount/(:any)'] = 'AssignCollection/delete_received_amount/$1';

$route['assign-collection-report-section'] = 'AssignCollection/assign_collection_report_section';
$route['datewise-assign-collection-report'] = 'AssignCollection/datewise_assign_collection_report';
$route['customerwise-assign-collection-report'] = 'AssignCollection/customerwise_assign_collection_report';

$route['visit-add'] = 'Visit/visit_add_form';
$route['save-visitor'] = 'Visit/save_visitor';
$route['visitor'] = 'Visit/visitor_list';
$route['edit-visitor/(.+)'] = 'Visit/edit_visitor/$1';
$route['update-visitor'] = 'Visit/update_visitor';

$route['customer-report-all'] = 'Customers/customer_report_all';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
