<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Salesmanorder extends CI_Controller {
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

    public function order()
    {
        $data = array();
        $id = $this->session->userdata('user_id');
        $userRole = $this->session->userdata('user_role');
        $data['userInfo'] = $this->users_model->user_info($id);
        if($userRole == 3){
            $data['order'] = $this->order_query->view_salesman_order($id);
        }else{
            $data['order'] = $this->order_query->view_salesman_order_all();
        }
        
//        echo '<pre>';
//        print_r($data['order']);
//        exit();
        
        $data['title'] = 'order';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/salesmanorder/order', $data, true);
        $this->load->view('index', $data);
    }
    
    
    
    public function order_form_view()
    {
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        
        $data['title'] = 'Save order';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/salesmanorder/order_add_form', $data, true);
        $this->load->view('index', $data);
    }
    public function edit_order_form_view($order_id)
    {
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['order_info_customer'] = $this->query_model->order_info_customer($order_id);
        $data['order_info_product'] = $this->query_model->order_info_product($order_id);
        
        $data['title'] = 'Update order';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/salesmanorder/order_edit_form', $data, true);
        $this->load->view('index', $data);
    }
    
    

    
    public function save_order(){
        $this->form_validation->set_rules('customer_name', 'Customer Name', 'required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        /*generate order ID*/
        
//        $lastid = $this->db->query('SELECT MAX(id) as max_id FROM tbl_order')->row();
//        $cc = $lastid->max_id+1; //last_id

        
        $lastid = $this->db->query('SELECT order_id FROM tbl_order GROUP by order_id ORDER BY CAST(order_id AS int) DESC LIMIT 1')->row();
        
        if(!empty($lastid)){
            $lastid = $lastid->order_id;
            
        }else{
            $lastid = 0;
        }
        $cc = intval($lastid)+1;//last_order_id increment
        $order_id = $cc; //$coo
        /*generate order ID*/
        
        $orderId_manual = $this->input->post('orderId_manual', true);
        
        // echo $order_id.'<br>';
        // echo $orderId_manual.'<br>';
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
                    $this->order_form_view();
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
        
        $order_date = $this->input->post('order_date', true);
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
                'order_date' => $order_date,
                'note' => $note,
                'discount' => $discount,
                'paid_amount' => $paid_amount,
                'payment_day' => $payment_day,
                'orderId_manual' => $orderId_manual,
                'order_id' => $order_id,
                'entry_by' => $this->session->userdata('user_name'),
                'order_by' => $this->session->userdata('user_id'),
                'entry_date' => date("Y-m-d"),
                'status' => 1,
                'order_status' => 0
            ];
        }

        //insert batch
        $insert_batch = $this->db->insert_batch('tbl_order', $data);
        if($insert_batch){
            $sdata = array();
            $sdata['message'] = 'order Created successfully';
            $this->session->set_userdata($sdata);
            $this->insert_order_history($order_id);
            // $this->order_form_view();
            $this->order_single_details($order_id);
        }else{
            $sdata = array();
            $sdata['message'] = 'Error';
            $this->session->set_userdata($sdata);
            $this->order_form_view();
        }
    }
    
    
    public function update_order(){
        
        $id = $this->input->post('id', true);
        $order_id = $this->input->post('order_id', true);
        $order_by = $this->input->post('order_by', true);
        $orderId_manual = $this->input->post('orderId_manual', true);
        $customer_id = $this->input->post('customer_id', true);
        $order_date = $this->input->post('order_date', true);
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
                'order_date' => $order_date,
                'last_paid_date_manual' => $last_paid_date_manual,
                'note' => $note,
                'discount' => $discount,
                'paid_amount' => $paid_amount,
                'payment_day' => $payment_day,
                'orderId_manual' => $orderId_manual,
                'order_id' => $order_id,
                'entry_by' => $this->session->userdata('user_name'),
                'order_by' => $order_by,
                'last_paid_date' => date("Y-m-d"),
                'status' => 1,
                'order_status' => 0
            ];
           $data1[] = [
                'product_id' => $product_id[$i],
            ];
            
           
        }
        

        for($x=0;$x<count($data1);$x++){
        
             $product_id = $data1[$x]['product_id'];
             $result = $this->db->query("SELECT * FROM tbl_order WHERE order_id = '$order_id' AND product_id = $product_id")->num_rows();
             if( $result > 0){
                $this->db->where('id', $data[$x]['id']);
                $this->db->update('tbl_order', $data[$x]);
             }else{
                $this->db->insert('tbl_order', $data[$x]);
             }
         }
         
        $sdata = array();
        $sdata['message'] = 'order Updated successfully';
        $this->session->set_userdata($sdata);

        $this->update_order_history($order_id);
        redirect(base_url()."edit-salesman-order/".$order_id);
      
        
    }

    public function insert_order_history($order_id){
        $data['order_id'] = $order_id;
        $data['customer_id'] = $this->input->post('customer_id', true);
        if(empty($data['customer_id'])){
            $data['customer_id'] = 1;
        }else{
            $data['customer_id'] = $this->input->post('customer_id', true);
        }
        $data['last_paid_date'] = date("Y-m-d");
        $data['last_paid_date_manual'] = $this->input->post('order_date', true);
        $data['order_by'] = $this->session->userdata('user_id');
        $data['collection_amount'] = $this->input->post('paid_amount', true);
        $this->db->insert('tbl_order_history', $data);
    }

    public function update_order_history($order_id){
        $orderInfo = $this->db->query("SELECT * FROM tbl_order WHERE order_id = '$order_id' GROUP BY order_id")->row();
        $data['order_id'] = $orderInfo->order_id;
        $data['customer_id'] = $orderInfo->customer_id;
        $data['last_paid_date'] = $orderInfo->last_paid_date;
        $data['last_paid_date_manual'] = $orderInfo->last_paid_date_manual;
        $data['order_by'] = $orderInfo->order_by;
        $data['collection_amount'] = $this->input->post('collection_amount', true);
        $this->db->insert('tbl_order_history', $data);
    }
    
    public function order_single_details($order_id)
    {
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['order_info_customer'] = $this->query_model->order_info_customer($order_id);
        $data['order_info_product'] = $this->query_model->order_info_product($order_id);
        
        $data['title'] = 'Order Details';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        // $data['content'] = $this->load->view('pages/salesmanorder/order_single_view', $data, true);
        $data['content'] = $this->load->view('pages/salesmanorder/order_single_view_ndscc', $data, true);
        $this->load->view('index', $data);
    }
    
    public function order_status($order_id, $order_status){
        $this->order_query->order_status($order_id, $order_status);
        
        $sdata = array();
        if($order_status == 1){
            $sdata['message'] = "Inactive";
        }else{
            $sdata['message'] = "Active";
        }
        
        $this->session->set_userdata($sdata);
        $this->order();
    }
    
    
    public function delete_order_product($id, $order_id){
        $this->query_model->delete_salesman_order_product($id);
        redirect(base_url()."edit-salesman-order/".$order_id);
    }

    public function order_details_copy($order_id){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['order_info_customer'] = $this->query_model->order_info_customer($order_id);
        $data['order_info_product'] = $this->query_model->order_info_product($order_id);
        
        $this->load->view('pages/salesmanorder/order_details_copy', $data);
        // $this->load->view('pages/salesmanorder/order_details_copy_ndscc', $data);
    }

    public function accept_salesman_order($order_id){
        $this->db->set('status', 1);
        $this->db->set('order_status', 1);
        $this->db->where('order_id', $order_id);
        $this->db->update('tbl_order');

        $order = $this->db->query("select * from tbl_order where order_id = '$order_id' AND NOT (delete_status <=> 'deleted') ")->result();

        $lastid = $this->db->query('SELECT voucher_id FROM tbl_invoice GROUP by voucher_id ORDER BY CAST(voucher_id AS int) DESC LIMIT 1')->row();
        
        if(!empty($lastid)){
            $lastid = $lastid->voucher_id;
            
        }else{
            $lastid = 0;
        }
        $cc = intval($lastid)+1;//last_voucher_id increment
        $voucher_id = $cc;

        for($x = 0; $x < count($order); $x++){
            $customer_id[$x] =  $order[$x]->customer_id;
            $product_id[$x] =  $order[$x]->product_id;
            $order_id[$x] =  $order[$x]->order_id;
            $quantity[$x] =  $order[$x]->quantity;
            $sale_price[$x] =  $order[$x]->sale_price;
            $discount[$x] =  $order[$x]->discount;
            $paid_amount[$x] =  $order[$x]->paid_amount;
            $entry_by[$x] =  $order[$x]->entry_by;
            $entry_date[$x] =  $order[$x]->entry_date;
            $last_paid_date[$x] =  $order[$x]->last_paid_date;
            $last_paid_date_manual[$x] =  $order[$x]->last_paid_date_manual;
            $order_by[$x] =  $order[$x]->order_by;
            $payment_day[$x] =  $order[$x]->payment_day;
            $status[$x] =  1;
            
        }

        for($i = 0; $i < count($product_id); $i++){
            $data[] = [
                'product_id' => $product_id[$i],
                'quantity' => $quantity[$i],
                'sale_price' => $sale_price[$i],
                'customer_id' => $customer_id[$i],
                'invoice_date' => date("Y-m-d"),
                'discount' => $discount[$i],
                'paid_amount' => $paid_amount[$i],
                'payment_day' => $payment_day[$i],
                'voucher_id' => $voucher_id,
                'entry_by' => $this->session->userdata('user_name'),
                'entry_date' => date("Y-m-d"),
                'order_by' => $order_by[$i],
                'order_id' => $order_id[$i],
                'order_by' => $order_by[$i],
                'status' => $status[$i],
                'order_status' => 1
            ];
        }

        $insert_batch = $this->db->insert_batch('tbl_invoice', $data);
        if($insert_batch){
            $this->insert_invoice_history($voucher_id);
            redirect('invoice-details/'. $voucher_id); 
        }

        $this->order_single_details($order_id);
    }

    public function insert_invoice_history($voucher_id){
        $invoice = $this->db->query("select * from tbl_invoice where voucher_id = '$voucher_id' group by voucher_id")->row();
        
        $data['voucher_id'] = $voucher_id;
        $data['customer_id'] = $invoice->customer_id;
        $data['last_paid_date'] = date("Y-m-d");
        $data['last_paid_date_manual'] = date("Y-m-d");
        $data['entry_by'] = $this->session->userdata('user_name');
        $data['collection_amount'] = $invoice->paid_amount;
        $this->db->insert('tbl_invoice_history', $data);
    }



    
    
    
}