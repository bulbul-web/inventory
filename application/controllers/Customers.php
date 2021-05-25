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

    public function customer_section()
    {
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);        
        $data['title'] = 'Customers';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/customers/customer_section', $data, true);
        $this->load->view('index', $data);
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
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/customers/customers', $data, true);
        $this->load->view('index', $data);
    }
    
    public function findCustoemrSubcategory(){
        $category_id = $this->input->post('category_id');
        $customerSubcategory = $this->db->query("SELECT * FROM tbl_customer_subcategory WHERE customer_category = '$category_id' AND status = 1 ORDER BY name ASC")->result();
        echo "<option value=''>" . 'Select Customer Subcategory' . "</option>";
        foreach ($customerSubcategory as $value) :
            echo "<option value='$value->id'>" . ucfirst($value->name) . "</option>";
        endforeach;
    }
    
    
    public function customer_category_form()
    {
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        
        $data['title'] = 'Save Customer';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/customers/customer_category_form', $data, true);
        $this->load->view('index', $data);
    }

    public function customer_subcategory_form()
    {
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        
        $data['title'] = 'Save Customer';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/customers/customer_subcategory_form', $data, true);
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
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/customers/customers_add_form', $data, true);
        $this->load->view('index', $data);
    }

    public function save_customer_category(){
        $this->form_validation->set_rules('name', 'Customer category', 'required|is_unique[tbl_customer_category.name]');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        if($this->form_validation->run()){
            $data['name'] = $this->input->post('name', true);
            $data['status'] = $this->input->post('status', true);
            $this->query_model->saveCustomerCategoryData($data);
            
            $sdata = array();
            $sdata['message'] = 'Successfully Save';
            $this->session->set_userdata($sdata);
            $this->customer_category_form();
        } else {
            $this->customer_category_form();
        }
    }
    public function save_customer_subcategory(){
        $this->form_validation->set_rules('name', 'Customer subcategory', 'required|is_unique[tbl_customer_subcategory.name]');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        if($this->form_validation->run()){
            $data['customer_category'] = $this->input->post('customer_category', true);
            $data['name'] = $this->input->post('name', true);
            $data['status'] = $this->input->post('status', true);
            $this->query_model->saveCustomersubCategoryData($data);
            
            $sdata = array();
            $sdata['message'] = 'Successfully Save';
            $this->session->set_userdata($sdata);
            $this->customer_subcategory_form();
        } else {
            $this->customer_subcategory_form();
        }
    }

    public function customer_category(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['customerCategory'] = $this->query_model->viewAllcustomerCategory();
        
        $data['title'] = 'Category';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/customers/customer_category_list', $data, true);
        $this->load->view('index', $data);
    }
    public function customer_subcategory(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['customersubCategory'] = $this->query_model->viewAllcustomersubCategory();
        
        $data['title'] = 'Category';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/customers/customer_subcategory_list', $data, true);
        $this->load->view('index', $data);
    }

    public function edit_customer_category($id){
        $data = array();
        $user_id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($user_id);
        $data['value'] = $this->query_model->viewCustomerCatergoryById($id);
        
        $data['title'] = 'Category update';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/customers/customer_category_edit_form_view', $data, true);
        $this->load->view('index', $data);
    }

    public function edit_customer_subcategory($id){
        $data = array();
        $user_id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($user_id);
        $data['subCategory'] = $this->query_model->viewCustomersubCatergoryById($id);
        
        $data['title'] = 'Sub Category update';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/customers/customer_subcategory_edit_form_view', $data, true);
        $this->load->view('index', $data);
    }

    public function update_customer_category(){
        $this->form_validation->set_rules('name', 'Category Name', 'required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        if($this->form_validation->run()){
            $data['id'] = $this->input->post('id', true);
            $data['name'] = $this->input->post('name', true);
            $data['status'] = $this->input->post('status', true);
            $this->query_model->updatecustomerCategoryData($data);
            
            $sdata = array();
            $sdata['message'] = 'Successfully updated';
            $this->session->set_userdata($sdata);
            $this->edit_customer_category($data['id']);
        } else {
            $this->edit_customer_category($data['id']);
        }
    }

    public function update_customer_subcategory(){
        $this->form_validation->set_rules('name', 'Sub Category Name', 'required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        if($this->form_validation->run()){
            $data['id'] = $this->input->post('id', true);
            $data['customer_category'] = $this->input->post('customer_category', true);
            $data['name'] = $this->input->post('name', true);
            $data['status'] = $this->input->post('status', true);
            $this->query_model->updatecustomersubCategoryData($data);
            
            $sdata = array();
            $sdata['message'] = 'Successfully updated';
            $this->session->set_userdata($sdata);
            $this->edit_customer_subcategory($data['id']);
        } else {
            $this->edit_customer_subcategory($data['id']);
        }
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
            $data['customer_category'] = $this->input->post('customer_category', true);
            $data['customer_subcategory'] = $this->input->post('customer_subcategory', true);
            $data['user_id'] = $this->input->post('user_id', true);
            $data['customer_name'] = $this->input->post('customer_name', true);
            $data['customer_address'] = $this->input->post('customer_address', true);
            $data['customer_mobile'] = $this->input->post('customer_mobile', true);
            $data['customer_email'] = $this->input->post('customer_email', true);
            $data['entry_by'] = $this->session->userdata('user_name');
            $data['entry_date'] = date("Y-m-d");
            $data['customer_status'] = $this->input->post('customer_status', true);
            $data['potential_status'] = $this->input->post('potential_status', true);
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
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
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
            $data['customer_category'] = $this->input->post('customer_category', true);
            $data['customer_subcategory'] = $this->input->post('customer_subcategory', true);
            $data['user_id'] = $this->input->post('user_id', true);
            $data['customer_name'] = $this->input->post('customer_name', true);
            $data['customer_address'] = $this->input->post('customer_address', true);
            $data['customer_mobile'] = $this->input->post('customer_mobile', true);
            $data['customer_email'] = $this->input->post('customer_email', true);
            $data['entry_by'] = $this->session->userdata('user_name');
            $data['entry_date'] = date("Y-m-d");
            $data['customer_status'] = $this->input->post('customer_status', true);
            $data['potential_status'] = $this->input->post('potential_status', true);
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

    public function customer_report_all(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['customerReportAll'] = $this->query_model->customerReportAll();
        
        $data['title'] = 'Customer Report';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/customers/customer_report_all', $data, true);
        $this->load->view('index', $data);
    }

}