<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Costs extends CI_Controller {
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

    public function costs_head(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['allCostsHead'] = $this->query_model->viewAllCostsHead();
        
        $data['title'] = 'Transaction Head';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', '', true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/costs/costs_head', $data, true);
        $this->load->view('index', $data);
    }

    public function transaction_head_add_form(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        
        $data['title'] = 'Transaction Head Add';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', '', true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/costs/transaction_head_add_form', $data, true);
        $this->load->view('index', $data);
    }
    
    public function edit_transaction_head_form($trans_id){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['singleCostsHead'] = $this->query_model->viewSingleCostsHead($trans_id);

        $data['title'] = 'Transaction Head Update';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', '', true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/costs/transaction_head_edit_form', $data, true);
        $this->load->view('index', $data);
    }

    

    public function save_transaction_head(){
        $this->form_validation->set_rules(
                'trnsaction_head', 'Transaction Head',
                'required|min_length[2]|max_length[100]|is_unique[tbl_costs_head.trnsaction_head]',
                array(
                        'required'      => 'You have not provided %s.',
                        'is_unique'     => 'This %s already exists.'
                )
        );     
        
        
        if($this->form_validation->run()){
            $data['trnsaction_head'] = $this->input->post('trnsaction_head', true);
            $data['description'] = $this->input->post('description', true);
            $data['status'] = $this->input->post('status', true);
            $data['entry_by'] = $this->session->userdata('user_name');
            $data['entry_date'] = date("Y-m-d");

            // echo '<pre>';
            // print_r($data);
            // exit();
            $this->query_model->save_transaction_head($data);

            $sdata = array();
            $sdata['message'] = 'Product Head successfully added';
            $this->session->set_userdata($sdata);
            $this->transaction_head_add_form();
        } else {
            $this->transaction_head_add_form();
        }
    }

    public function update_transaction_head(){
        $data['id'] = $this->input->post('id', true);
        $this->form_validation->set_rules(
                'trnsaction_head', 'Transaction Head',
                'required|min_length[2]|max_length[100]',
                array(
                        'required'      => 'You have not provided %s.'
                )
        );     
        
        
        if($this->form_validation->run()){
            $data['id'] = $this->input->post('id', true);
            $data['trnsaction_head'] = $this->input->post('trnsaction_head', true);
            $data['description'] = $this->input->post('description', true);
            $data['status'] = $this->input->post('status', true);
            $data['entry_by'] = $this->session->userdata('user_name');
            $data['entry_date'] = date("Y-m-d");

            // echo '<pre>';
            // print_r($data);
            // exit();
            $this->query_model->update_transaction_head($data);

            $sdata = array();
            $sdata['message'] = 'Product Head successfully Updated';
            $this->session->set_userdata($sdata);
            $this->edit_transaction_head_form($data['id']);
        } else {
            $this->edit_transaction_head_form($data['id']);
        }
    }

    public function delete_transaction_head($id){
        $this->query_model->delete_transaction_head($id);
        $sdata = array();
        $sdata['message'] = 'Successfully deleted';
        $this->session->set_userdata($sdata);
        $this->costs_head();
    }
    
    public function costs_add_form(){
    print 'costs_add_form';
        //     $data = array();
    //     $id = $this->session->userdata('user_id');
    //     $data['userInfo'] = $this->users_model->user_info($id);
    //     $data['invoice'] = $this->query_model->viewInvoice();
        
    // //        echo '<pre>';
    // //        print_r($data['invoice']);
    // //        exit();
        
    //     $data['title'] = 'Invoice';
    //     $data['css'] = $this->load->view('common/dataTableCss', '', true);
    //     $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
    //     $data['sideMenu'] = $this->load->view('common/sideMenu', '', true);
    //     $data['topBar'] = $this->load->view('common/topBar', $data, true);
    //     $data['footer'] = $this->load->view('common/footer', '', true);
    //     $data['content'] = $this->load->view('pages/invoice/invoice', $data, true);
    //     $this->load->view('index', $data);
    }

}