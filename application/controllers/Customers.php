<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->loged_out();
    }
    
    private function loged_out(){
        if(!$this->session->userdata('authenticated'))
        {
            redirect('login');
        }
    }

    public function customers()
    {
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['customers'] = $this->query_model->viewAllCustomers();
        
        $data['title'] = 'Customers';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', '', true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/customers/customers', $data, true);
        $this->load->view('index', $data);
    }
    
    
    
    public function customer_form_view()
    {
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        
        $data['title'] = 'Save Customer';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', '', true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/customers/customers_add_form', $data, true);
        $this->load->view('index', $data);
    }
    
    public function save_customers()
    {
        
        $this->form_validation->set_rules(
                'customer_name', 'Customer Name',
                'required|min_length[1]|max_length[50]|is_unique[tbl_customer.customer_name]',
                array(
                        'required'      => 'You have not provided %s.',
                        'is_unique'     => 'This %s already exists.'
                )
        );  
        //$this->form_validation->set_rules('customer_name', 'Customer name', 'required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        if($this->form_validation->run()){
            $data['customer_name'] = $this->input->post('customer_name', true);
            $data['customer_address'] = $this->input->post('customer_address', true);
            $data['customer_mobile'] = $this->input->post('customer_mobile', true);
            $data['customer_email'] = $this->input->post('customer_email', true);
            $data['entry_by'] = $this->session->userdata('user_name');
            $data['entry_date'] = date("Y-m-d");
            $data['customer_status'] = $this->input->post('customer_status', true);
            $this->query_model->saveCustomerData($data);
            
            $sdata = array();
            $sdata['message'] = 'Successfully Save';
            $this->session->set_userdata($sdata);
            $this->customer_form_view();
        } else {
            $this->customer_form_view();
        }
    }
    
    public function customer_edit_form_view($customer_id)
    {
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['singleCustomer'] = $this->query_model->single_Customer($customer_id);
        
        $data['title'] = 'Update Customer';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', '', true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/customers/customers_edit_form', $data, true);
        $this->load->view('index', $data);
    }
    
    
    
    
    
    public function update_customers()
    {
        
        $this->form_validation->set_rules('customer_name', 'Customer name', 'required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        if($this->form_validation->run()){
            $data['customer_id'] = $this->input->post('customer_id', true);
            $data['customer_name'] = $this->input->post('customer_name', true);
            $data['customer_address'] = $this->input->post('customer_address', true);
            $data['customer_mobile'] = $this->input->post('customer_mobile', true);
            $data['customer_email'] = $this->input->post('customer_email', true);
            $data['entry_by'] = $this->session->userdata('user_name');
            $data['entry_date'] = date("Y-m-d");
            $data['customer_status'] = $this->input->post('customer_status', true);
            $this->query_model->updateCustomerData($data);
            
            $sdata = array();
            $sdata['message'] = 'Successfully Save';
            $this->session->set_userdata($sdata);
            //redirect('edit-customer/'.$data['customer_id']);
            $this->customer_edit_form_view($data['customer_id']);
        } else {
            $data['customer_id'] = $this->input->post('customer_id', true);
            $sdata = array();
            $sdata['message'] = 'Try!';
            $this->session->set_userdata($sdata);
            $this->customer_edit_form_view($data['customer_id']);
        }
    }
    
    public function delete_customer($id){
        $this->query_model->delete_customer($id);
        $sdata = array();
        $sdata['message'] = 'Successfully deleted';
        $this->session->set_userdata($sdata);
        $this->customers();
    }
}