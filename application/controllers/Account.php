<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {
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

    public function account_sub_head_list(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['allAccountSubHead'] = $this->accounts_query->account_sub_head_list();
        
        $data['title'] = 'Account Sub Head list';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', '', true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/accounts/account_sub_head_list', $data, true);
        $this->load->view('index', $data);
    }//account_sub_head_list

    public function account_sub_sub_head_list(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['allAccountSubSubHead'] = $this->accounts_query->account_sub_sub_head_list();
        
        $data['title'] = 'Sub Sub Head List';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', '', true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/accounts/account_sub_sub_head_list', $data, true);
        $this->load->view('index', $data);
    }//account_sub_sub_head_list

    public function acnt_tansaction_head_list(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['allAccountTansHead'] = $this->accounts_query->account_tansaction_head_list();
        
        $data['title'] = 'Tansaction Head List';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', '', true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/accounts/acnt_tansaction_head_list', $data, true);
        $this->load->view('index', $data);
    }//acnt_tansaction_head_list

    public function fiscal_year(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['allFiscalYear'] = $this->accounts_query->fiscal_year_list();
        
        $data['title'] = 'Fiscal Year';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', '', true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/accounts/fiscal_year', $data, true);
        $this->load->view('index', $data);
    }//fiscal_year

    public function account_sub_head_add(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        
        $data['title'] = 'Account Sub Head Add';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', '', true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/accounts/account_sub_head_add', $data, true);
        $this->load->view('index', $data);
    }//account_sub_head_add

    public function account_sub_sub_head_add(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        
        $data['title'] = 'Account Sub Sub Head Add';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', '', true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/accounts/account_sub_sub_head_add', $data, true);
        $this->load->view('index', $data);
    }//account_sub_sub_head_add
    
    public function account_tansaction_head_add(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        
        $data['title'] = 'Account Tansaction Head Add';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', '', true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/accounts/account_tansaction_head_add', $data, true);
        $this->load->view('index', $data);
    }//account_tansaction_head_add
    
    public function fiscal_year_add(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        
        $data['title'] = 'Fiscal Year Add';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', '', true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/accounts/fiscal_year_add', $data, true);
        $this->load->view('index', $data);
    }//fiscal_year_add


    public function get_sub_head_by_contrl_id($ControlHead_id){
        $getSubHeadByContrlId = $this->accounts_query->get_sub_head_by_contrl_id($ControlHead_id);
        $output = null;
        $output .= '<option value="" disabled selected>----Select----</option>';
        foreach ($getSubHeadByContrlId as $subHead)
        {
            $output .= '<option value="'.$subHead->SubHeadID.'">'.$subHead->SubHeadDescription.'</option>';
        }
        echo $output;
    }//get_sub_head_by_contrl_id
    
    public function get_sub_sub_head_by_subId($SubHeadID){
        $getSubSubHeadByContrlId = $this->accounts_query->get_sub_sub_head_by_subId($SubHeadID);
        $output = null;
        $output .= '<option value="" disabled selected>----Select----</option>';
        foreach ($getSubSubHeadByContrlId as $subSubHead)
        {
            $output .= '<option value="'.$subSubHead->SSubHeadID.'">'.$subSubHead->SSubHeadDescription.'</option>';
        }
        echo $output;
    }//get_sub_sub_head_by_subId

    
    public function save_acnt_sub_head(){
        $this->form_validation->set_rules(
                'SubHeadDescription', 'Sub Head',
                'required|min_length[2]|max_length[150]|is_unique[tbl_subhead.SubHeadDescription]',
                array(
                        'required'      => 'You have not provided %s.',
                        'is_unique'     => 'This %s already exists.'
                )
        );     
        $this->form_validation->set_rules('ControlHead_id', 'Control Head', 'required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');    
        
        
        if($this->form_validation->run()){
            $data['SubHeadDescription'] = $this->input->post('SubHeadDescription', true);
            $data['ControlHead_id'] = $this->input->post('ControlHead_id', true);
            $data['note'] = $this->input->post('note', true);
            $data['viewState'] = $this->input->post('viewState', true);
            $data['active'] = 1;


            // echo '<pre>';
            // print_r($data);
            // exit();
            $this->accounts_query->save_acnt_sub_head($data);

            $sdata = array();
            $sdata['message'] = 'Sub Head successfully added';
            $this->session->set_userdata($sdata);
            $this->account_sub_head_add();
        } else {
            $this->account_sub_head_add();
        }
    }//save_acnt_sub_head

    public function save_acnt_sub_sub_head(){
        $this->form_validation->set_rules(
                'SSubHeadDescription', 'Sub Sub Head',
                'required|min_length[2]|max_length[150]|is_unique[tbl_subsubheads.SSubHeadDescription]',
                array(
                        'required'      => 'You have not provided %s.',
                        'is_unique'     => 'This %s already exists.'
                )
        );     
        $this->form_validation->set_rules('ControlHead_id', 'Control Head', 'required');
        $this->form_validation->set_rules('SSubHeadID', 'Sub Head', 'required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');    
        
        
        if($this->form_validation->run()){
            $data['SSubHeadDescription'] = $this->input->post('SSubHeadDescription', true);
            $data['SubHeadID'] = $this->input->post('SSubHeadID', true);
            $data['active'] = 1;


            // echo '<pre>';
            // print_r($data);
            // exit();
            $this->accounts_query->save_acnt_sub_sub_head($data);

            $sdata = array();
            $sdata['message'] = 'Sub Sub Head successfully added';
            $this->session->set_userdata($sdata);
            $this->account_sub_sub_head_add();
        } else {
            $this->account_sub_sub_head_add();
        }
    }//save_acnt_sub_head
    
    public function save_acnt_tansaction_head(){
            $this->form_validation->set_rules(
                    'TransHeadDescription', 'Transaction Head',
                    'required|min_length[2]|max_length[150]|is_unique[tbl_transactionhead.TransHeadDescription]',
                    array(
                            'required'      => 'You have not provided %s.',
                            'is_unique'     => 'This %s already exists.'
                    )
            );     
            $this->form_validation->set_rules('SSubHeadID', 'Sub Sub Head', 'required');
            $this->form_validation->set_rules('SubHeadID', 'Sub Head', 'required');
            $this->form_validation->set_rules('ControlHead_id', 'Control Head', 'required');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');    
            
            
            if($this->form_validation->run()){
                $data['TransHeadDescription'] = $this->input->post('TransHeadDescription', true);
                $data['SubHeadID'] = $this->input->post('SubHeadID', true);
                $data['SSubHeadID'] = $this->input->post('SSubHeadID', true);
                $data['active'] = 1;


            // echo '<pre>';
            // print_r($data);
            // exit();
            $this->accounts_query->save_acnt_tansaction_head($data);

            $sdata = array();
            $sdata['message'] = 'Tansaction Head successfully added';
            $this->session->set_userdata($sdata);
            $this->account_tansaction_head_add();
        } else {
            $this->account_tansaction_head_add();
        }
    }//save_acnt_tansaction_head

    public function save_fiscal_year(){
        $this->form_validation->set_rules('startDate', 'Start Date', 'required');
        $this->form_validation->set_rules('endDate', 'Last Date', 'required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>'); 

        if($this->form_validation->run()){
            $data['startDate'] = $this->input->post('startDate', true);
            $data['endDate'] = $this->input->post('endDate', true);
            $data['status'] = 'Active';
            
            $this->accounts_query->save_fiscal_year($data);

            $sdata = array();
            $sdata['message'] = 'Fiscal Year successfully added';
            $this->session->set_userdata($sdata);
            $this->fiscal_year_add();
        } else {
            $this->fiscal_year_add();
        }
    }//save_fiscal_year

}//controller_end