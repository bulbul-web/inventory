<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Warehouse extends CI_Controller {

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

public function warehouse()
    {
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['warehouse'] = $this->query_model->viewAllWarehouse();
        
        $data['title'] = 'Warehouse';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/warehouse/warehouse', $data, true);
        $this->load->view('index', $data);
    }
    
    
    
    public function warehouse_form_view()
    {
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        
        $data['title'] = 'Save Warehouse';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/warehouse/warehouse_add_form', $data, true);
        $this->load->view('index', $data);
    }
    
    public function save_warehouse()
    {
        
        $this->form_validation->set_rules('warehouse_name', 'Warehouse name', 'required');
        $this->form_validation->set_rules('warehouse_address', 'Warehouse Address', 'required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        if($this->form_validation->run()){
            $data['warehouse_name'] = $this->input->post('warehouse_name', true);
            $data['warehouse_address'] = $this->input->post('warehouse_address', true);
            $data['entry_by'] = $this->session->userdata('user_name');
            $data['entry_date'] = date("Y-m-d");
            $data['warehouse_status'] = $this->input->post('warehouse_status', true);
            $this->query_model->saveWarehouseData($data);
            
            $sdata = array();
            $sdata['message'] = 'Successfully Save';
            $this->session->set_userdata($sdata);
            $this->warehouse_form_view();
        } else {
            $this->warehouse_form_view();
        }
    }
    
    public function warehouse_edit_form_view($warehouse_id)
    {
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['singleWarehouse'] = $this->query_model->single_Warehouse($warehouse_id);
        
        $data['title'] = 'Update Customer';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/warehouse/warehouse_edit_form', $data, true);
        $this->load->view('index', $data);
    }
    
    
    
    
    
    public function update_warehouse()
    {
        
        $this->form_validation->set_rules('warehouse_name', 'Warehouse name', 'required');
        $this->form_validation->set_rules('warehouse_address', 'Warehouse Address', 'required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        if($this->form_validation->run()){
            $data['warehouse_id'] = $this->input->post('warehouse_id', true);
            $data['warehouse_name'] = $this->input->post('warehouse_name', true);
            $data['warehouse_address'] = $this->input->post('warehouse_address', true);
            $data['entry_by'] = $this->session->userdata('user_name');
            $data['entry_date'] = date("Y-m-d");
            $data['warehouse_status'] = $this->input->post('warehouse_status', true);
            $this->query_model->updateWarehouseData($data);
            
            $sdata = array();
            $sdata['message'] = 'Successfully Updated';
            $this->session->set_userdata($sdata);
            //redirect('edit-customer/'.$data['customer_id']);
            $this->warehouse_edit_form_view($data['warehouse_id']);
        } else {
            $data['warehouse_id'] = $this->input->post('warehouse_id', true);
            $sdata = array();
            $sdata['message'] = 'Try!';
            $this->session->set_userdata($sdata);
            $this->warehouse_edit_form_view($data['warehouse_id']);
        }
    }
    
    public function delete_warehouse($id){
        $this->query_model->delete_warehouse($id);
        $sdata = array();
        $sdata['message'] = 'Successfully deleted';
        $this->session->set_userdata($sdata);
        $this->warehouse();
    }
}