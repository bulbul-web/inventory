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
        
        $data['title'] = 'Transaction Head';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', '', true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/accounts/account_sub_head_list', $data, true);
        $this->load->view('index', $data);
    }//account_sub_head_list

    public function account_sub_head_add(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        
        $data['title'] = 'Transaction Head';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', '', true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/accounts/account_sub_head_add', $data, true);
        $this->load->view('index', $data);
    }//account_sub_head_add

    
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


}//controller_end