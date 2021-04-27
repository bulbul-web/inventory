<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->loged_out();
    }
    
    private function loged_out(){
        if(!$this->session->userdata('authenticated'))
        {
            $this->session->sess_destroy();
            redirect('login');
        }
    }

    public function invoice()
    {
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['invoice'] = $this->query_model->viewInvoice();
        
//        echo '<pre>';
//        print_r($data['invoice']);
//        exit();
        
        $data['title'] = 'Invoice';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/invoice/invoice', $data, true);
        $this->load->view('index', $data);
    }
    
    
    
    public function invoice_form_view()
    {
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        
        $data['title'] = 'Save Invoice';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/invoice/invoice_add_form', $data, true);
        $this->load->view('index', $data);
    }
    public function edit_invoice_form_view($voucher_id)
    {
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['voucher_info_customer'] = $this->query_model->voucher_info_customer($voucher_id);
        $data['voucher_info_product'] = $this->query_model->voucher_info_product($voucher_id);
        
        $data['title'] = 'Update Invoice';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/invoice/invoice_edit_form', $data, true);
        $this->load->view('index', $data);
    }
    
    
    
    //for ajax field match and auto fill filds
    public function get_all_customer_match($customer_name){

        if(empty($customer_name)){
            echo json_encode([]);
            exit;
        }
        
        $customers = $this->query_model->viewAllCustomersMatch($customer_name);
        echo json_encode($customers);exit;
    }
    //for ajax field match and auto fill filds
    
    //for ajax field match and auto fill filds
    public function get_all_products_match($product_name){

        if(empty($product_name)){
            echo json_encode([]);
            exit;
        }
        
        $products = $this->query_model->viewAllProductsMatch($product_name);
        echo json_encode($products);exit;
    }
    //for ajax field match and auto fill filds


    public function avalbaleStockStatus() {
        $product_id = $this->input->post('product_id');
        $stockin = $this->db->query("SELECT a.*, sum(a.quantity_in) as totalStockIn, c.pack_size FROM tbl_stock_in a, tbl_product_info b, tbl_pack_size c WHERE a.product_id = '$product_id' AND a.product_id = b.product_id AND b.pack_size = c.id")->row();
        $stockOut = $this->db->query("SELECT a.*, sum(a.quantity) as totalStockOut, c.pack_size FROM tbl_invoice a, tbl_product_info b, tbl_pack_size c WHERE a.product_id = '$product_id' AND a.product_id = b.product_id AND b.pack_size = c.id")->row();
        
        if(isset($stockin->totalStockIn)){
            $totalStockIn = $stockin->totalStockIn;
        }else {
            $totalStockIn = 0;
        }

        if(isset($stockOut->totalStockOut)){
            $totalStockOut = $stockOut->totalStockOut;
        }else {
            $totalStockOut = 0;
        }

        $available = $totalStockIn - $totalStockOut;
        if($available <= 0 ){
            $available = 'Out of stock';
        }

        if(isset($stockin->totalStockIn)){
            $pack_size = $stockin->pack_size;
        }elseif(isset($stockOut->totalStockOut)) {
            $pack_size = $stockOut->pack_size;
        }

        $resultdata = array();
        $resultdata['available'] = $available;
        $resultdata['pack_size'] = $pack_size;
        echo json_encode($resultdata);
    }

    
    public function save_invoice(){
        $this->form_validation->set_rules('customer_name', 'Customer Name', 'required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        /*generate voucher ID*/
        
//        $lastid = $this->db->query('SELECT MAX(id) as max_id FROM tbl_invoice')->row();
//        $cc = $lastid->max_id+1; //last_id

        
        $lastid = $this->db->query('SELECT voucher_id FROM tbl_invoice GROUP by voucher_id ORDER BY CAST(voucher_id AS int) DESC LIMIT 1')->row();
        
        if(!empty($lastid)){
            $lastid = $lastid->voucher_id;
            
        }else{
            $lastid = 0;
        }
        $cc = intval($lastid)+1;//last_voucher_id increment
        $voucher_id = $cc; //$coo
        /*generate voucher ID*/
        
        $voucherId_manual = $this->input->post('voucherId_manual', true);
        
        // echo $voucher_id.'<br>';
        // echo $voucherId_manual.'<br>';
        // exit();
        $customer_id = $this->input->post('customer_id', true);
        if(empty($customer_id)){
            if(!empty($this->input->post('customer_name_new', true))){
                $cdata = array();
                $cdata['customer_name'] = $this->input->post('customer_name_new', true);
                $cdata['customer_address']= $this->input->post('customer_address_new', true);
                $cdata['customer_mobile']= $this->input->post('customer_mobile_new', true);
                $cdata['customer_email'] = $this->input->post('customer_email_new', true);
                $cdata['entry_by'] = $this->session->userdata('user_name');
                $cdata['entry_date'] = date("Y-m-d");
                $cdata['customer_status'] = 1;
                $customer_name = $cdata['customer_name'];
                $checkingQr = $this->db->query("SELECT customer_name FROM tbl_customer WHERE customer_name='$customer_name'")->row();
                if($checkingQr){
                    $sdata = array();
                    $sdata['message'] = 'Customer Name already exits';
                    $this->session->set_userdata($sdata);
                    $this->invoice_form_view();
                }else{
                    $this->query_model->saveCustomerData($cdata);
                    $lastCustmoerId = $this->db->query("SELECT * FROM tbl_customer ORDER BY customer_id DESC LIMIT 1")->row();
                    $customer_id = $lastCustmoerId->customer_id;//new customer id
                }
            }else{
                $customer_id = 1;//for common customer
            }
        }else{
            $customer_id = $this->input->post('customer_id', true);//exits customer id
        }
        
        $invoice_date = $this->input->post('invoice_date', true);
        $note = $this->input->post('note', true);
        
        $discount = $this->input->post('discount', true);
        $paid_amount = $this->input->post('paid_amount', true);
        $payment_day = $this->input->post('payment_day', true);
        
        $product_id = $this->input->post('product_id', true);
        $quantity = $this->input->post('quantity', true);
        $sale_price = $this->input->post('sale_price', true);
        
        for($i=0; $i<count($product_id); $i++){
            $data[] = [
                'product_id' => $product_id[$i],
                'quantity' => $quantity[$i],
                'sale_price' => $sale_price[$i],
                'customer_id' => $customer_id,
                'invoice_date' => $invoice_date,
                'note' => $note,
                'discount' => $discount,
                'paid_amount' => $paid_amount,
                'payment_day' => $payment_day,
                'voucherId_manual' => $voucherId_manual,
                'voucher_id' => $voucher_id,
                'entry_by' => $this->session->userdata('user_name'),
                'entry_date' => date("Y-m-d"),
                'status' => 1
            ];
        }
//        echo '<pre>';
//        print_r($data);
//        exit();

        //insert batch
        $insert_batch = $this->db->insert_batch('tbl_invoice', $data);
        if($insert_batch){
            $sdata = array();
            $sdata['message'] = 'Invoice Created successfully';
            $this->session->set_userdata($sdata);
            $this->insert_invoice_history($voucher_id);
            // $this->invoice_form_view();
            $this->invoice_single_details($voucher_id);
        }else{
            $sdata = array();
            $sdata['message'] = 'Error';
            $this->session->set_userdata($sdata);
            $this->invoice_form_view();
        }
    }
    
    
    public function update_invoice(){
        
        $id = $this->input->post('id', true);
        $voucher_id = $this->input->post('voucher_id', true);
        $status = $this->input->post('status', true);
        $voucherId_manual = $voucher_id;//$this->input->post('voucherId_manual', true);
        $customer_id = $this->input->post('customer_id', true);
        $invoice_date = $this->input->post('invoice_date', true);
        $last_paid_date_manual = $this->input->post('last_paid_date_manual', true);
        $note = $this->input->post('note', true);
        
        $discount = $this->input->post('discount', true);
        $paid_amount = $this->input->post('paid_amount', true);
        $payment_day = $this->input->post('payment_day', true);
        $collection_amount = $this->input->post('collection_amount', true);
        $paid_amount = $paid_amount + $collection_amount;
        
        $product_id = $this->input->post('product_id', true);
        $quantity = $this->input->post('quantity', true);
        $sale_price = $this->input->post('sale_price', true);
        
        for($i=0; $i<count($product_id); $i++){
            $data[] = [
                'id' => $id[$i],
                'product_id' => $product_id[$i],
                'quantity' => $quantity[$i],
                'sale_price' => $sale_price[$i],
                'customer_id' => $customer_id,
                'invoice_date' => $invoice_date,
                'last_paid_date_manual' => $last_paid_date_manual,
                'note' => $note,
                'discount' => $discount,
                'paid_amount' => $paid_amount,
                'payment_day' => $payment_day,
                'voucherId_manual' => $voucherId_manual,
                'voucher_id' => $voucher_id,
                'entry_by' => $this->session->userdata('user_name'),
                'last_paid_date' => date("Y-m-d"),
                'status' => $status
            ];
           $data1[] = [
                'product_id' => $product_id[$i],
            ];
            
           
        }

        for($x=0;$x<count($data1);$x++){
        
             $product_id = $data1[$x]['product_id'];
             $result = $this->db->query("SELECT * FROM tbl_invoice WHERE voucher_id = '$voucher_id' AND product_id = $product_id")->num_rows();
             if( $result > 0){
                $this->db->where('id', $data[$x]['id']);
                $this->db->update('tbl_invoice', $data[$x]);
             }else{
                $this->db->insert('tbl_invoice', $data[$x]);
             }
         }
        $sdata = array();
        $sdata['message'] = 'Invoice Updated successfully';
        $this->session->set_userdata($sdata);

        $this->update_invoice_history($voucher_id);
        redirect(base_url()."edit-invoice/".$voucher_id);
      
        
    }

    public function insert_invoice_history($voucher_id){
        $data['voucher_id'] = $voucher_id;
        $data['customer_id'] = $this->input->post('customer_id', true);
        if(empty($data['customer_id'])){
            $data['customer_id'] = 1;
        }else{
            $data['customer_id'] = $this->input->post('customer_id', true);
        }
        $data['last_paid_date'] = date("Y-m-d");
        $data['last_paid_date_manual'] = $this->input->post('invoice_date', true);
        $data['entry_by'] = $this->session->userdata('user_name');
        $data['collection_amount'] = $this->input->post('paid_amount', true);
        $this->db->insert('tbl_invoice_history', $data);
    }

    public function update_invoice_history($voucher_id){
        $invoiceInfo = $this->db->query("SELECT * FROM tbl_invoice WHERE voucher_id = '$voucher_id' GROUP BY voucher_id")->row();
        $data['voucher_id'] = $invoiceInfo->voucher_id;
        $data['customer_id'] = $invoiceInfo->customer_id;
        $data['last_paid_date'] = $invoiceInfo->last_paid_date;
        $data['last_paid_date_manual'] = $invoiceInfo->last_paid_date_manual;
        $data['entry_by'] = $invoiceInfo->entry_by;
        $data['collection_amount'] = $this->input->post('collection_amount', true);
        $this->db->insert('tbl_invoice_history', $data);
    }
    
    public function invoice_single_details($voucher_id)
    {
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['voucher_info_customer'] = $this->query_model->voucher_info_customer($voucher_id);
        $data['voucher_info_product'] = $this->query_model->voucher_info_product($voucher_id);
        
        $data['title'] = 'Invoice Details';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        // $data['content'] = $this->load->view('pages/invoice/invoice_single_view', $data, true);
        $data['content'] = $this->load->view('pages/invoice/invoice_single_view_ndscc', $data, true);
        $this->load->view('index', $data);
    }
    
    public function invoice_status($voucher_id, $invoice_status){
        $this->query_model->invoice_status($voucher_id, $invoice_status);
        
        $sdata = array();
        if($invoice_status == 1){
            $sdata['message'] = "Inactive";
        }else{
            $sdata['message'] = "Active";
        }
        
        $this->session->set_userdata($sdata);
        $this->invoice();
    }
    
    public function delete_invoice($voucher_id){
        $this->query_model->delete_invoice($voucher_id);
        $sdata = array();
        $sdata['message'] = 'Successfully deleted';
        $this->session->set_userdata($sdata);
        $this->invoice();
    }
    public function delete_invoice_product($id, $voucher_id){
        $this->query_model->delete_invoice_product($id);
        redirect(base_url()."edit-invoice/".$voucher_id);
    }

    public function invoice_details_copy($voucher_id){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['voucher_info_customer'] = $this->query_model->voucher_info_customer($voucher_id);
        $data['voucher_info_product'] = $this->query_model->voucher_info_product($voucher_id);
        
        // $this->load->view('pages/invoice/invoice_details_copy', $data);
        $this->load->view('pages/invoice/invoice_details_copy_ndscc', $data);
    }

    public function accept_order($voucher_id){
        $this->db->set('status', 1);
        $this->db->set('order_status', 1);
        $this->db->where('voucher_id', $voucher_id);
        $this->db->update('tbl_invoice');

        $this->invoice_single_details($voucher_id);
    }
    
    
}