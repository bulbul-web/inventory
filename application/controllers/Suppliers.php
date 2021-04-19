<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Suppliers extends CI_Controller {

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






public function suppliers()
    {
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['suppliers'] = $this->query_model->viewAllSuppliers();
        
        $data['title'] = 'Suppliers';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/suppliers/suppliers', $data, true);
        $this->load->view('index', $data);
    }
    
    
    
    public function suppliers_add_form_view()
    {
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['suppliers'] = $this->query_model->viewAllSuppliers();
        
        $data['title'] = 'Suppliers';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/suppliers/suppliers_add_form', $data, true);
        $this->load->view('index', $data);
    }
    
    public function suppliers_edit_form_view($supplier_id)
    {
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['singleSupplier'] = $this->query_model->single_suppliers($supplier_id);
        
        $data['title'] = 'Suppliers';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/suppliers/suppliers_edit_form', $data, true);
        $this->load->view('index', $data);
    }
    
    
    public function save_suppliers()
    {
        
        $this->form_validation->set_rules(
                'supplier_name', 'Supplier Name',
                'required|min_length[1]|max_length[50]|is_unique[tbl_supplier.supplier_name]',
                array(
                        'required'      => 'You have not provided %s.',
                        'is_unique'     => 'This %s already exists.'
                )
        );  
        //$this->form_validation->set_rules('supplier_name', 'Supplier name', 'required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        if($this->form_validation->run()){
            $data['supplier_name'] = $this->input->post('supplier_name', true);
            $data['supplier_address'] = $this->input->post('supplier_address', true);
            $data['supplier_mobile'] = $this->input->post('supplier_mobile', true);
            $data['supplier_email'] = $this->input->post('supplier_email', true);
            $data['entry_by'] = $this->session->userdata('user_name');
            $data['entry_date'] = date("Y-m-d");
            $data['supplier_status'] = $this->input->post('supplier_status', true);
            $this->query_model->saveSupplierData($data);
            
            $sdata = array();
            $sdata['message'] = 'Successfully Save';
            $this->session->set_userdata($sdata);
            $this->suppliers_add_form_view();
        } else {
            $this->suppliers_add_form_view();
        }
    }
    
    
    public function update_suppliers()
    {
        
        $this->form_validation->set_rules('supplier_name', 'Supplier name', 'required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        $supplier_id = $this->input->post('supplier_id', true);
        
        if($this->form_validation->run()){
            $this->query_model->updateSupplierData();
            
            $sdata = array();
            $sdata['message'] = 'Successfully Updated';
            $this->session->set_userdata($sdata);
            $this->suppliers_edit_form_view($supplier_id);
        } else {
            $this->suppliers_edit_form_view($supplier_id);
        }
    }
    
    public function delete_supplier($id){
        $this->query_model->delete_supplier($id);
        $sdata = array();
        $sdata['message'] = 'Successfully deleted';
        $this->session->set_userdata($sdata);
        $this->suppliers();
    }
}