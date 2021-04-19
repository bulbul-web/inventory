<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AssignCollection extends CI_Controller {
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

    public function sell_list_from_common_customer(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['allSellAsignList'] = $this->query_model->view_all_sell_assign_list();      
        $data['title'] = 'Sell List';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/assignCollection/sell_list_from_common_customer', $data, true);
        $this->load->view('index', $data);
    }
    
    public function amount_recieved_list_from_common_customer(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['allSellReceivedList'] = $this->query_model->view_all_sell_received_list();      
        $data['title'] = 'Amount Recieved List';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/assignCollection/amount_recieved_list_from_common_customer', $data, true);
        $this->load->view('index', $data);
    }

    public function customerwise_assign_collection_report(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['allCustomer'] = $this->query_model->all_Customer_active();
        if(isset($_POST['customer_id'])):
            $customer_id = $this->input->post('customer_id', true);
            $data['singleCustomer'] = $this->users_model->singleCustomer($customer_id);
            $from_date = $this->input->post('from_date', true);
            $to_date = $this->input->post('to_date', true);
            $data['customerWiseAssignCollection'] = $this->query_model->customerwise_assign_collection_report($customer_id, $from_date, $to_date);
            $data['customerWiseAssgnClctnBfrCrtnDate'] = $this->query_model->customerwise_assign_collection_report_before_certain_date($customer_id, $from_date);
        endif;
        $data['title'] = 'Customerwise assign collection report';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/assignCollection/customerwise_assign_collection_report', $data, true);
        $this->load->view('index', $data);
    }
    
    
    public function sell_from_common_customer_add_form(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);    
        $data['allCustomer'] = $this->query_model->viewAllCustomers();
        $data['title'] = 'Assign Sell';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/assignCollection/sell_from_common_customer_add_form', $data, true);
        $this->load->view('index', $data);
    }
    
    public function amount_recieved_common_customer_add_form(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);    
        $data['allCustomer'] = $this->query_model->viewAllCustomers();
        $data['title'] = 'Amount Received';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/assignCollection/amount_recieved_common_customer_add_form', $data, true);
        $this->load->view('index', $data);
    }
    
    public function edit_assign_amount_form($assign_id){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);    
        $data['allCustomer'] = $this->query_model->viewAllCustomers();
        $data['SellAsignSingle'] = $this->query_model->view_sell_assign_single($assign_id); 
        $data['title'] = 'Assign Sell Update';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/assignCollection/edit_assign_amount_form', $data, true);
        $this->load->view('index', $data);
    }
    
    public function edit_received_amount_form($received_id){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);    
        $data['allCustomer'] = $this->query_model->viewAllCustomers();
        $data['SellReceivedSingle'] = $this->query_model->view_sell_received_single($received_id); 
        $data['title'] = 'Received Amount Update';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/assignCollection/edit_received_amount_form', $data, true);
        $this->load->view('index', $data);
    }

    public function assign_collection_report_section(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);     
        $data['title'] = 'Assign Collection Report Section';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/assignCollection/assign_collection_report_section', $data, true);
        $this->load->view('index', $data);
    }

    public function datewise_assign_collection_report(){
        if(isset($_POST['status'])){
            $status = $this->input->post('status', true);
            $from_date = date("Y-m-d", strtotime($this->input->post('from_date', true)));
            $to_date = date("Y-m-d", strtotime($this->input->post('to_date', true)));
        }else{
            $status = 1;
            $from_date = date("Y-m-d");
            $to_date = date("Y-m-d");
        }
        

        $data['customerWiseAssignAmount'] = $this->db->query("SELECT a.*, sum(a.sell_amount) as totalAssign, b.customer_name FROM tbl_cltn_frm_cmn_cstmr a, tbl_customer b WHERE a.customer_id = b.customer_id AND a.trans_status = 'assign' AND a.trns_date BETWEEN '$from_date' AND '$to_date' AND a.status = '$status' AND NOT (a.delete_status <=> 'deleted') GROUP BY a.customer_id")->result();
        $data['customerWiseReceivedAmount'] = $this->db->query("SELECT a.*, sum(a.recived_amount) as totalReceived, b.customer_name FROM tbl_cltn_frm_cmn_cstmr a, tbl_customer b WHERE a.customer_id = b.customer_id AND a.trans_status = 'received' AND a.trns_date BETWEEN '$from_date' AND '$to_date' AND a.status = '$status' AND NOT (a.delete_status <=> 'deleted') GROUP BY a.customer_id")->result();
        $data['AllAssignCollectionReport'] = $this->db->query("SELECT a.customer_name, a.assignAmount, a.totalReceived,(a.assignAmount - a.totalReceived) AS due FROM (select c.customer_name, sum(b.sell_amount) as assignAmount, sum(b.recived_amount) as totalReceived from tbl_cltn_frm_cmn_cstmr b , tbl_customer c where c.customer_id = b.customer_id AND b.trns_date BETWEEN '$from_date' AND '$to_date' AND b.status = '$status' AND NOT (b.delete_status <=> 'deleted') GROUP BY c.customer_name) a")->result();
        
        $data['status'] = $status;
        $data['from_date'] = $from_date;
        $data['to_date'] = $to_date;
        
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['title'] = 'Collection & Assign Report';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/assignCollection/datewise_assign_collection_report', $data, true);
        $this->load->view('index', $data);
    }

    public function save_assign_sell(){
        $data['customer_id'] = $this->input->post('customer_id', TRUE);
        $data['sell_amount'] = $this->input->post('sell_amount', TRUE);
        $data['recived_amount'] = 0;
        $data['note'] = $this->input->post('note', TRUE);
        $data['trns_date'] = $this->input->post('trns_date', TRUE);
        $data['entry_date'] = date('Y-m-d');
        $data['entry_by'] = $this->session->userdata('user_name');
        $data['status'] = 1;
        $data['trans_status'] = 'assign';

        $this->query_model->save_assign_sell($data);

        $sdata = array();
        $sdata['message'] = 'Sell amount assign succesfully';
        $this->session->set_userdata($sdata);
        $this->sell_from_common_customer_add_form();
        
    }
    
    public function save_received_amount(){
        $data['customer_id'] = $this->input->post('customer_id', TRUE);
        $data['sell_amount'] = 0;
        $data['recived_amount'] = $this->input->post('recived_amount', TRUE);
        $data['note'] = $this->input->post('note', TRUE);
        $data['trns_date'] = $this->input->post('trns_date', TRUE);
        $data['entry_date'] = date('Y-m-d');
        $data['entry_by'] = $this->session->userdata('user_name');
        $data['status'] = 1;
        $data['trans_status'] = 'received';

        $this->query_model->save_received_amount($data);

        $sdata = array();
        $sdata['message'] = 'Sell amount received succesfully';
        $this->session->set_userdata($sdata);
        $this->amount_recieved_common_customer_add_form();
        
    }

    public function update_assign_sell(){
        $data['id'] = $this->input->post('id', TRUE);
        $data['customer_id'] = $this->input->post('customer_id', TRUE);
        $data['sell_amount'] = $this->input->post('sell_amount', TRUE);
        
        $data['note'] = $this->input->post('note', TRUE);
        $data['trns_date'] = $this->input->post('trns_date', TRUE);
        $data['update_date'] = date('Y-m-d');
        $data['entry_by'] = $this->session->userdata('user_name');
        $data['status'] = $this->input->post('status', TRUE);
        

        $this->query_model->update_assign_sell($data);

        $sdata = array();
        $sdata['message'] = 'Sell amount assign update succesfully';
        $this->session->set_userdata($sdata);
        $this->edit_assign_amount_form($data['id']);
    }
    
    public function update_received_amount(){
        $data['id'] = $this->input->post('id', TRUE);
        $data['customer_id'] = $this->input->post('customer_id', TRUE);
        $data['recived_amount'] = $this->input->post('recived_amount', TRUE);
        
        $data['note'] = $this->input->post('note', TRUE);
        $data['trns_date'] = $this->input->post('trns_date', TRUE);
        $data['update_date'] = date('Y-m-d');
        $data['entry_by'] = $this->session->userdata('user_name');
        $data['status'] = $this->input->post('status', TRUE);
        

        $this->query_model->update_received_amount($data);

        $sdata = array();
        $sdata['message'] = 'Sell amount received update succesfully';
        $this->session->set_userdata($sdata);
        $this->edit_received_amount_form($data['id']);
    }

    public function delete_assign_amount($assign_id){
        $this->query_model->delete_assign_amount($assign_id);
        $sdata = array();
        $sdata['message'] = 'Successfully deleted';
        $this->session->set_userdata($sdata);
        $this->sell_list_from_common_customer();
    }
    
    public function delete_received_amount($received_id){
        $this->query_model->delete_received_amount($received_id);
        $sdata = array();
        $sdata['message'] = 'Successfully deleted';
        $this->session->set_userdata($sdata);
        $this->amount_recieved_list_from_common_customer();
    }

     


}