<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {
    public function __construct() {
        parent::__construct();
        //$this->session->sess_destroy();
        $this->loged_out();
    }
    
    private function loged_out(){
        if(!$this->session->userdata('authenticated'))
        {
            redirect('login');
        }
    }
    
    public function month_report()
    {
        
        
        if(isset($_POST['status'])){
            $status = $this->input->post('status', true);
            $from_date = date("Y-m-d", strtotime($this->input->post('from_date', true)));
            $to_date = date("Y-m-d", strtotime($this->input->post('to_date', true)));
        }else{
            $status = 1;
            $from_date = date("Y-m-d");
            $to_date = date("Y-m-d");
        }
        $result = $this->db->query
                (
                "SELECT c.customer_name, i.voucher_id, sum(i.quantity * i.sale_price) as grandTotal, i.paid_amount, i.discount, i.invoice_date, i.status, i.note"
                    . " FROM tbl_customer c, tbl_invoice i"
                    . " WHERE i.customer_id = c.customer_id and i.invoice_date BETWEEN '$from_date' AND '$to_date' AND i.status = $status AND NOT (i.delete_status <=> 'deleted')"
                    . " GROUP BY i.voucher_id"
                    . " ORDER BY i.id DESC"
                )->result();
        $data = array();
        
        
        $data['status'] = $status;
        $data['from_date'] = $from_date;
        $data['to_date'] = $to_date;
        $data['result'] = $result;
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        
        
        
        
        $data['title'] = 'Month Wise Report';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('reports/month_report', $data, true);
        $this->load->view('index', $data);
    }
    
    public function stock_report(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['title'] = 'Stock Report';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('reports/stock_report', $data, true);
        $this->load->view('index', $data);
    }
    
    public function product_datewise_report(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['title'] = 'Stock Report';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('reports/product_datewise_report', $data, true);
        $this->load->view('index', $data);
    }
    
    public function datewise_stock_report(){
        if(isset($_POST['status'])){
            $status = $this->input->post('status', true);
            $from_date = date("Y-m-d", strtotime($this->input->post('from_date', true)));
            $to_date = date("Y-m-d", strtotime($this->input->post('to_date', true)));
        }else{
            $status = 1;
            $from_date = date("Y-m-d");
            $to_date = date("Y-m-d");
        }
        $result = $this->db->query
                (
                "SELECT a.*, b.product_name, c.pack_size, (a.quantity_in * a.buying_price) as totalPrice FROM tbl_stock_in a, tbl_product_info b, tbl_pack_size c WHERE a.product_id = b.product_id AND b.pack_size = c.id AND a.bill_date BETWEEN '$from_date' AND '$to_date' AND a.status = '$status'"
                )->result();
        $data = array();
        $data['status'] = $status;
        $data['from_date'] = $from_date;
        $data['to_date'] = $to_date;
        $data['result'] = $result;
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['title'] = 'Stock Report';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('reports/datewise_stock_report', $data, true);
        $this->load->view('index', $data);
    }

    public function all_products_stock_report(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['title'] = 'Stock Report';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('reports/all_products_stock_report', $data, true);
        $this->load->view('index', $data);
    }

    public function product_out_by_customer(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['allCustomer'] = $this->users_model->allCustomer();
        if(isset($_POST['customer_id'])):
            $customer_id = $this->input->post('customer_id', true);
            $data['singleCustomer'] = $this->users_model->singleCustomer($customer_id);
            $from_date = $this->input->post('from_date', true);
            $to_date = $this->input->post('to_date', true);
            $data['customerWiseProductInfo'] = $this->users_model->product_out_by_customer($customer_id, $from_date, $to_date);
        endif;
        $data['title'] = 'Customer Product Report';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('reports/product_out_by_customer', $data, true);
        $this->load->view('index', $data);
    }
    
    public function datewise_product_out(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        if(isset($_POST['from_date'])):
            $from_date = $this->input->post('from_date', true);
            $to_date = $this->input->post('to_date', true);
            $data['datewiseProductStockOut'] = $this->users_model->datewise_product_out($from_date, $to_date);
        endif;
        $data['title'] = 'Product stock out datewise';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('reports/datewise_product_out', $data, true);
        $this->load->view('index', $data);
    }
    
    public function datewise_collection_from_customer(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['allCustomer'] = $this->users_model->allCustomer();
        if(isset($_POST['customer_id'])):
            $customer_id = $this->input->post('customer_id', true);
            $data['singleCustomer'] = $this->users_model->singleCustomer($customer_id);
            $from_date = $this->input->post('from_date', true);
            $to_date = $this->input->post('to_date', true);
            $data['datewiseCollectionFromCustomer'] = $this->users_model->datewise_collection_from_customer($customer_id, $from_date, $to_date);
        endif;
        $data['title'] = 'Collection Report';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('reports/datewise_collection_from_customer', $data, true);
        $this->load->view('index', $data);
    }
    
    public function supplier_and_datewise_buy_product(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['allSupplier'] = $this->users_model->allSupplier();
        if(isset($_POST['supplier_id'])):
            $supplier_id = $this->input->post('supplier_id', true);
            $data['singleSupplier'] = $this->users_model->singleSupplier($supplier_id);
            $from_date = $this->input->post('from_date', true);
            $to_date = $this->input->post('to_date', true);
            $data['supplierAndDatewiseBuyProduct'] = $this->users_model->supplier_and_datewise_buy_product($supplier_id, $from_date, $to_date);
        endif;
        $data['title'] = 'Supplier and datewise buy product';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('reports/supplier_and_datewise_buy_product', $data, true);
        $this->load->view('index', $data);
    }

    public function supplier_and_datewise_payment_history(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['allSupplier'] = $this->users_model->allSupplier();
        if(isset($_POST['supplier_id'])):
            $supplier_id = $this->input->post('supplier_id', true);
            $data['singleSupplier'] = $this->users_model->singleSupplier($supplier_id);
            $from_date = $this->input->post('from_date', true);
            $to_date = $this->input->post('to_date', true);
            $data['supplierAndDatewisePaymentHistory'] = $this->users_model->supplier_and_datewise_payment_history($supplier_id, $from_date, $to_date);
        endif;
        $data['title'] = 'Supplier and datewise Payment History';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('reports/supplier_and_datewise_payment_history', $data, true);
        $this->load->view('index', $data);
    }

    public function datewise_payment_history(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        if(isset($_POST['from_date'])):
            $from_date = $this->input->post('from_date', true);
            $to_date = $this->input->post('to_date', true);
            $data['datewisePaymentHistory'] = $this->users_model->datewise_payment_history($from_date, $to_date);
        endif;
        $data['title'] = 'Datewise Payment History';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('reports/datewise_payment_history', $data, true);
        $this->load->view('index', $data);
    }

    public function supplier_due_list(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['supplierDueList'] = $this->users_model->supplier_due_list();
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['title'] = 'Supplier due list';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('reports/supplier_due_list', $data, true);
        $this->load->view('index', $data);
    }

    public function productwise_profit(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['title'] = 'Buy Sell Info';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('reports/productwise_profit', $data, true);
        $this->load->view('index', $data);
    }

    public function datewise_profit(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['title'] = 'Datewise Product Profit';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('reports/datewise_profit', $data, true);
        $this->load->view('index', $data);
    }
    
    public function datewise_buy_product(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        if(isset($_POST['from_date'])):
            $from_date = $this->input->post('from_date', true);
            $to_date = $this->input->post('to_date', true);
            $data['DatewiseBuyProduct'] = $this->users_model->datewise_buy_product($from_date, $to_date);
        endif;
        $data['title'] = 'Datewise buy product';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('reports/datewise_buy_product', $data, true);
        $this->load->view('index', $data);
    }

    public function datewise_collection(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        if(isset($_POST['from_date'])):
            $from_date = $this->input->post('from_date', true);
            $to_date = $this->input->post('to_date', true);
            $data['datewiseCollection'] = $this->users_model->datewise_collection($from_date, $to_date);
        endif;
        $data['title'] = 'Collection Report';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('reports/datewise_collection', $data, true);
        $this->load->view('index', $data);
    }

    public function name_and_month_report(){
        $customer_id = 1;
        if(isset($_POST['status'])){
            $status = $this->input->post('status', true);
            $customer_id = $this->input->post('customer_id', true);
            $from_date = date("Y-m-d", strtotime($this->input->post('from_date', true)));
            $to_date = date("Y-m-d", strtotime($this->input->post('to_date', true)));
            $data['singleCustomer'] = $this->users_model->singleCustomer($customer_id);
        }else{
            $status = 1;
            $from_date = date("Y-m-d");
            $to_date = date("Y-m-d");
        }
        $result = $this->db->query
                (
                "SELECT c.customer_name, i.customer_id, i.voucher_id, i.product_id, pi.product_name, i.quantity, i.sale_price, sum(i.quantity * i.sale_price) as grandTotal, i.paid_amount, i.discount, i.invoice_date, i.status, i.note
                FROM tbl_customer c, tbl_invoice i, tbl_product_info pi
                WHERE i.customer_id = c.customer_id AND i.invoice_date BETWEEN '$from_date' AND '$to_date' AND i.customer_id = '$customer_id' AND pi.product_id = i.product_id and i.status = $status AND NOT (i.delete_status <=> 'deleted')
                GROUP BY i.voucher_id
               ORDER BY i.id DESC"
                )->result();
        $data = array();
        
        $data['allCustomer'] = $this->users_model->allCustomer();
        $data['singleCustomer'] = $this->users_model->singleCustomer($customer_id);
        $data['status'] = $status;
        $data['from_date'] = $from_date;
        $data['to_date'] = $to_date;
        $data['result'] = $result;
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        
        
        
        
        $data['title'] = 'Month Wise Report';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('reports/name_and_month_report', $data, true);
        $this->load->view('index', $data);
    }

    public function all_report_section(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['title'] = 'Reports';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('reports/reports_section', $data, true);
        $this->load->view('index', $data);
    }
   
    public function account_reports_section(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['title'] = 'Account Reports';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('reports/account_reports_section', $data, true);
        $this->load->view('index', $data);
    }

    
    public function customer_wise_report_payment(){

        // if(isset($_POST['from_date'])){
        //     $from_date = date("Y-m-d", strtotime($this->input->post('from_date', true)));
        //     $to_date = date("Y-m-d", strtotime($this->input->post('to_date', true)));
        // }else{
        //     $from_date = date("Y-m-d");
        //     $to_date = date("Y-m-d");
        // }
        $result = $this->db->query
                (
                // "SELECT c.customer_name, sum(i.quantity * i.sale_price) as grandTotal, i.paid_amount, i.discount, i.invoice_date, i.status, i.note FROM tbl_customer c, tbl_invoice i WHERE i.customer_id = c.customer_id AND i.invoice_date BETWEEN '$from_date' AND '$to_date' GROUP BY c.customer_name ORDER BY i.id DESC"
                "SELECT a.customer_name, a.grandTotal, sum(b.discount) as discount, SUM(b.paid_amount) AS paid_amount FROM (SELECT i.customer_id, c.customer_name, sum(i.quantity * i.sale_price) as grandTotal FROM tbl_invoice i, tbl_customer c WHERE c.customer_id = i.customer_id AND NOT (i.delete_status <=> 'deleted') GROUP BY c.customer_name) a LEFT JOIN (SELECT i.paid_amount, i.voucher_id, i.customer_id, c.customer_name, i.discount FROM tbl_invoice i, tbl_customer c WHERE i.customer_id = c.customer_id GROUP BY i.voucher_id) b ON a.customer_id = b.customer_id GROUP BY a.customer_id"
                )->result();

               


        $data = array();
        $data['result'] = $result;

        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['title'] = 'Customer Payment';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('reports/customer_wise_report_payment', $data, true);
        $this->load->view('index', $data);
    }

    public function expense_report_section(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['title'] = 'Expense Reports';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('reports/expense_report_section', $data, true);
        $this->load->view('index', $data);
    }

    public function datewise_expense(){
        if(isset($_POST['status'])){
            $status = $this->input->post('status', true);
            $from_date = date("Y-m-d", strtotime($this->input->post('from_date', true)));
            $to_date = date("Y-m-d", strtotime($this->input->post('to_date', true)));
        }else{
            $status = 1;
            $from_date = date("Y-m-d");
            $to_date = date("Y-m-d");
        }
        $result = $this->db->query
                (
                "SELECT *, sum(amount) as totalAmount FROM tbl_costs WHERE trnsction_date BETWEEN '$from_date' AND '$to_date' AND status = $status GROUP BY trnsction_id"
                )->result();
        $data = array();

        $data['totalPaidDateWise'] = $this->db->query("SELECT *, SUM(paid_amount) AS totalPaid FROM tbl_invoice WHERE invoice_date BETWEEN '$from_date' AND '$to_date' AND status = $status")->row();
        $data['totalCostsDateWise'] = $this->db->query("SELECT *, sum(amount) as totalCostsAmount FROM tbl_costs WHERE trnsction_date BETWEEN '$from_date' AND '$to_date' AND status = $status")->row();
        
        $data['status'] = $status;
        $data['from_date'] = $from_date;
        $data['to_date'] = $to_date;
        $data['result'] = $result;
        
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['title'] = 'Expense Reports';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('reports/datewise_expense', $data, true);
        $this->load->view('index', $data);
    }
    
    public function date_wise_transaction_report(){
        if(isset($_POST['status'])){
            $status = $this->input->post('status', true);
            $from_date = date("Y-m-d", strtotime($this->input->post('from_date', true)));
            $to_date = date("Y-m-d", strtotime($this->input->post('to_date', true)));
        }else{
            $status = 1;
            $from_date = date("Y-m-d");
            $to_date = date("Y-m-d");
        }
        $result = $this->db->query
                (
                "SELECT a.*, sum(a.CR) as totalCR, sum(a.DR) as totalDR, b.TransHeadDescription FROM tbl_transactions a, tbl_transactionhead b WHERE b.TransactionHeadID = a.TrasactionHeadID AND NOT (a.status <=> '0') AND NOT (a.delete_status <=> 'deleted') AND a.TrnDate BETWEEN '$from_date' AND '$to_date' AND a.status = '$status' GROUP BY a.VoucherNo ORDER BY a.TransactionID DESC"
                )->result();
        $data = array();
        
        $data['status'] = $status;
        $data['from_date'] = $from_date;
        $data['to_date'] = $to_date;
        $data['result'] = $result;
        
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['title'] = 'Datewise Transaction Reports';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('reports/date_wise_transaction_report', $data, true);
        $this->load->view('index', $data);
    }

    public function transactionwise_voucher_report(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['allTransaction'] = $this->query_model->all_transaction_active();
        if(isset($_POST['TrasactionHeadID'])):
            $TrasactionHeadID = $this->input->post('TrasactionHeadID', true);
            $data['singleTransaction'] = $this->query_model->single_transaction($TrasactionHeadID);
            $from_date = $this->input->post('from_date', true);
            $to_date = $this->input->post('to_date', true);
            // $data['trnsWiseVoucherReport'] = $this->query_model->transactionwise_voucher_report($TrasactionHeadID, $from_date, $to_date);
            // $data['trnsWiseVoucherAmountBfrCrtnDate'] = $this->query_model->transactionwise_voucher_report_before_certain_date($TrasactionHeadID, $from_date);
        endif;
        $data['title'] = 'Transactionwise voucher report';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('reports/transactionwise_voucher_report', $data, true);
        $this->load->view('index', $data);
    }

    public function invoice_report_section(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['title'] = 'Account Reports';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('reports/invoice_report_section', $data, true);
        $this->load->view('index', $data);
    }

    public function stock_report_section(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['title'] = 'Stock In Report Section';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('reports/stock_report_section', $data, true);
        $this->load->view('index', $data);
    }

    public function stock_out_report_section(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['title'] = 'Stock Out Report Section';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('reports/stock_out_report_section', $data, true);
        $this->load->view('index', $data);
    }

    public function collection_report_section(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['title'] = 'Collection Report Section';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('reports/collection_report_section', $data, true);
        $this->load->view('index', $data);
    }
    
    
}