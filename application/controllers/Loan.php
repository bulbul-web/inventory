<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loan extends CI_Controller {
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
    
    public function loan()
    {
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['loan'] = $this->query_model->viewAllLoan();
        
        $data['title'] = 'Loan';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', '', true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/loan/loan', $data, true);
        $this->load->view('index', $data);
    }
    public function loan_form_view()
    {
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        
        $data['title'] = 'New Loan';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', '', true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/loan/loan_add_form', $data, true);
        $this->load->view('index', $data);
    }
    
    public function save_loan()
    {
        $this->form_validation->set_rules('loan_from', 'Loan Form', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('loan_amount', 'Loan Amount', 'required');
        $this->form_validation->set_rules('start_date', 'Start Date', 'required');
        $this->form_validation->set_rules('end_date', 'End Date', 'required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        if($this->form_validation->run()){
            $data['loan_from'] = $this->input->post('loan_from', true);
            $data['mobile'] = $this->input->post('mobile', true);
            $data['email'] = $this->input->post('email', true);
            $data['address'] = $this->input->post('address', true);
            $data['description'] = $this->input->post('description', true);
            $data['loan_amount'] = $this->input->post('loan_amount', true);
            $data['start_date'] = $this->input->post('start_date', true);
            $data['end_date'] = $this->input->post('end_date', true);
            $data['entry_by'] = $this->session->userdata('user_name');
            $data['entry_date'] = date("Y-m-d");
            $data['status'] = $this->input->post('status', true);
            $this->query_model->saveLoanData($data);
            
            $sdata = array();
            $sdata['message'] = 'Successfully Save';
            $this->session->set_userdata($sdata);
            $this->loan_form_view();
        } else {
            $this->loan_form_view();
        }
    }
    public function details_loan_view($id)
    {
        $data = array();
        $user_id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($user_id);
        $data['loanSingle'] = $this->query_model->viewSingleLoan($id);
        
        $data['title'] = 'Loan Details';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', '', true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/loan/loan_single', $data, true);
        $this->load->view('index', $data);
    }
    public function edit_loan_form_vew($id)
    {
        $data = array();
        $user_id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($user_id);
        $data['loanSingle'] = $this->query_model->viewSingleLoan($id);
        
        $data['title'] = 'Edit Loan';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', '', true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/loan/loan_edit_form', $data, true);
        $this->load->view('index', $data);
    }
    public function update_loan()
    {
        $this->form_validation->set_rules('loan_from', 'Loan Form', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('loan_amount', 'Loan Amount', 'required');
        $this->form_validation->set_rules('start_date', 'Start Date', 'required');
        $this->form_validation->set_rules('end_date', 'End Date', 'required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        if($this->form_validation->run()){
            $data['id'] = $this->input->post('id', true);
            $data['loan_from'] = $this->input->post('loan_from', true);
            $data['mobile'] = $this->input->post('mobile', true);
            $data['email'] = $this->input->post('email', true);
            $data['address'] = $this->input->post('address', true);
            $data['description'] = $this->input->post('description', true);
            $data['loan_amount'] = $this->input->post('loan_amount', true);
            $data['start_date'] = $this->input->post('start_date', true);
            $data['end_date'] = $this->input->post('end_date', true);
            $data['entry_by'] = $this->session->userdata('user_name');
            $data['entry_date'] = date("Y-m-d");
            $data['status'] = $this->input->post('status', true);
            
            $this->query_model->updateLoanData($data);
            
            $sdata = array();
            $sdata['message'] = 'Successfully Updated';
            $this->session->set_userdata($sdata);
            //redirect('edit-customer/'.$data['customer_id']);
            $this->edit_loan_form_vew($data['id']);
        } else {
            $data['id'] = $this->input->post('id', true);
            $sdata = array();
            $sdata['message'] = 'Try!';
            $this->session->set_userdata($sdata);
            $this->edit_loan_form_vew($data['id']);
        }
    }
    
    public function delete_loan($id){
        $this->query_model->delete_loan($id);
        $sdata = array();
        $sdata['message'] = 'Successfully deleted';
        $this->session->set_userdata($sdata);
        $this->loan();
    }
    
    
    
}