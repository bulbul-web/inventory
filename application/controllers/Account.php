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
    
    public function opening_balance(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['allOpeningBalance'] = $this->accounts_query->opening_balance_list();
        
        $data['title'] = 'Opening Balance List';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', '', true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/accounts/opening_balance', $data, true);
        $this->load->view('index', $data);
    }//opening_balance
    
    public function transaction_list(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['AllTransaction'] = $this->accounts_query->transaction_list();
        
        $data['title'] = 'Transaction List';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', '', true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/accounts/transaction_list', $data, true);
        $this->load->view('index', $data);
    }//opening_balance

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
    
    public function account_opening_blnce_add(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        
        $data['title'] = 'Opening Balance Add';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', '', true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/accounts/account_opening_blnce_add', $data, true);
        $this->load->view('index', $data);
    }//account_opening_blnce_add
    
    public function account_transaction_add(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        
        $data['title'] = 'Transaction Add';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', '', true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        // $data['content'] = $this->load->view('pages/accounts/account_transaction_add', $data, true);
        $data['content'] = $this->load->view('pages/accounts/account_transaction_add_mltiple', $data, true);
        $this->load->view('index', $data);
    }//account_transaction_add


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
    
    public function get_transaction_head_by_sub_sub_Id($SSubHeadID){
        $getTransactionHeadBySubSubId = $this->accounts_query->get_transaction_head_by_sub_sub_Id($SSubHeadID);
        $output = null;
        $output .= '<option value="" disabled selected>----Select----</option>';
        foreach ($getTransactionHeadBySubSubId as $transactionHead)
        {
            $output .= '<option value="'.$transactionHead->TransactionHeadID.'">'.$transactionHead->TransHeadDescription.'</option>';
        }
        echo $output;
    }//get_transaction_head_by_sub_sub_Id
   
    public function get_transaction_by_contrl_head_id($ControlHead_id){
        $getTransactionHeadByControlId = $this->accounts_query->get_transaction_by_contrl_head_id($ControlHead_id);
        $output = null;
        $output .= '<option value="" disabled selected>----Select----</option>';
        foreach ($getTransactionHeadByControlId as $transactionHead)
        {
            $output .= '<option value="'.$transactionHead->TransactionHeadID.'">'.$transactionHead->TransHeadDescription.'</option>';
        }
        echo $output;
    }//get_transaction_by_contrl_head_id
   
    public function get_transaction_by_v_type($v_type){
        if($v_type == 'CR'){
            $getTransactionHeadByVType = $this->accounts_query->get_transaction_by_contrl_Vtype_CR();
        }elseif($v_type == 'DR'){
            $getTransactionHeadByVType = $this->accounts_query->get_transaction_by_contrl_Vtype_DR();
        }
        
        $output = null;
        $output .= '<option value="" disabled selected>----Select----</option>';
        foreach ($getTransactionHeadByVType as $transactionHead)
        {
            $output .= '<option value="'.$transactionHead->TransactionHeadID.'">'.$transactionHead->TransHeadDescription.'</option>';
        }
        echo $output;
    }//get_transaction_by_v_type
    
    public function get_control_head_by_v_type($v_type){
        if($v_type == 'CR'){
            $getControlHeadByVType = $this->accounts_query->get_control_head_by_v_type_CR();
        }elseif($v_type == 'DR'){
            $getControlHeadByVType = $this->accounts_query->get_control_head_by_v_type_DR();
        }
        
        $output = null;
        $output .= '<option value="" disabled selected>----Select----</option>';
        foreach ($getControlHeadByVType as $controlHead)
        {
            $output .= '<option value="'.$controlHead->ControlHead_id.'">'.$controlHead->HeadDescription.'</option>';
        }
        echo $output;
    }//get_control_head_by_v_type

    
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
    
    public function save_acnt_tansaction(){
        
        $this->form_validation->set_rules('project_id', 'Project', 'required');
        $this->form_validation->set_rules('TrnDate', 'Transaction Date', 'required');
        $this->form_validation->set_rules('V_Type', 'Voucher Type', 'required');
        $this->form_validation->set_rules('ControlHead_id', 'Control Head', 'required');
        $this->form_validation->set_rules('TransactionHeadID', 'Transaction Head', 'required');

        $data['CR'] = $this->input->post('CR', true);
        $data['DR'] = $this->input->post('DR', true);
        if($data['CR'] == ''){
            $data['CR'] = 0;
            $this->form_validation->set_rules('DR', 'Amount', 'required');
        }elseif($data['DR'] == ''){
            $data['DR'] = 0;
            $this->form_validation->set_rules('CR', 'Amount', 'required');
        }

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>'); 
        
        
        if($this->form_validation->run()){
            $data['TrasactionHeadID'] = $this->input->post('TransactionHeadID', true);
            $data['CR'] = $this->input->post('CR', true);
            $data['DR'] = $this->input->post('DR', true);

            if($data['CR'] == ''){
                $data['CR'] = 0;
                $data['DR'] = $this->input->post('DR', true);
            }elseif($data['DR'] == ''){
                $data['DR'] = 0;
                $data['CR'] = $this->input->post('CR', true);
            }
            $data['project_id'] = $this->input->post('project_id', true);
            $data['TrnDate'] = $this->input->post('TrnDate', true);
            $data['entry_date'] = date("Y-m-d");

            $lastid = $this->db->query('SELECT VoucherNo FROM tbl_transactions GROUP by VoucherNo ORDER BY CAST(VoucherNo AS int) DESC LIMIT 1')->row();
    
            if(!empty($lastid)){
                $lastid = $lastid->VoucherNo;
                
            }else{
                $lastid = 0;
            }
            $cc = intval($lastid)+1;//last_voucher_id increment
            $VoucherNo = $cc; //$coo
            /*generate voucher*/
            $data['VoucherNo'] = $VoucherNo;
            $data['Note'] = $this->input->post('Note', true);
            $data['VoucherID'] = $VoucherNo;
            $data['userid'] = $this->session->userdata('user_id');
            $data['V_Type'] = $this->input->post('V_Type', true);
            $data['month'] = date("M");
            $data['year'] = date("Y");

            $data['monthvoucher'] = $data['month'].'-'.$VoucherNo;
            $data['yearend'] = NULL;
            $data['MR_NO'] = NULL;
            $data['Member_ID'] = NULL;
            $data['fiscalYearID'] = $this->session->userdata('fiscalYearID');
            $data['status'] = 1;


            // echo '<pre>';
            // print_r($data);
            // exit();
            $this->accounts_query->save_acnt_tansaction($data);

            $sdata = array();
            $sdata['message'] = 'Tansaction successfully added';
            $this->session->set_userdata($sdata);
            $this->account_transaction_add();
            // redirect(current_url());
        } else {
            $sdata = array();
            $sdata['message'] = 'Tray again!';
            $this->session->set_userdata($sdata);
            $this->account_transaction_add();
        }
    }//save_acnt_tansaction

    public function save_acnt_tansaction_mltple(){
        print 'save_acnt_tansaction_mltple';
    }
    
    public function save_opening_balance(){

            $this->form_validation->set_rules('ControlHead_id', 'Control Head', 'required');
            $this->form_validation->set_rules('TransactionHeadID', 'Transaction Head', 'required');

            $data['CR'] = $this->input->post('CR', true);
            $data['DR'] = $this->input->post('DR', true);
            if($data['CR'] == ''){
                $data['CR'] = 0;
                $this->form_validation->set_rules('DR', 'Amount', 'required');
            }elseif($data['DR'] == ''){
                $data['DR'] = 0;
                $this->form_validation->set_rules('CR', 'Amount', 'required');
            }

            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');    
            
            
            if($this->form_validation->run()){
            $data['TransactionHeadID'] = $this->input->post('TransactionHeadID', true);

            $data['CR'] = $this->input->post('CR', true);
            $data['DR'] = $this->input->post('DR', true);

            if($data['CR'] == ''){
                $data['CR'] = 0;
                $data['DR'] = $this->input->post('DR', true);
            }elseif($data['DR'] == ''){
                $data['DR'] = 0;
                $data['CR'] = $this->input->post('CR', true);
            }

            $data['entry_date'] = date("Y-m-d");
            $data['fiscalYearID'] = $this->session->userdata('fiscalYearID');
            $data['opening_balance_date'] = $this->input->post('opening_balance_date', true);
                

            // echo '<pre>';
            // print_r($data);
            // exit();
            $this->accounts_query->save_opening_balance($data);

            $sdata = array();
            $sdata['message'] = 'Tansaction Head successfully added';
            $this->session->set_userdata($sdata);
            $this->account_opening_blnce_add();
        } else {
            $sdata = array();
            $sdata['message'] = 'Try Again!';
            $this->session->set_userdata($sdata);
            $this->account_opening_blnce_add();
        }
    }//save_opening_balance

    public function save_fiscal_year(){
        $this->form_validation->set_rules('startDate', 'Start Date', 'required');
        $this->form_validation->set_rules('endDate', 'Last Date', 'required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>'); 

        if($this->form_validation->run()){
            $data['startDate'] = $this->input->post('startDate', true);
            $data['endDate'] = $this->input->post('endDate', true);
            $data['status'] = 'Active';

            $lastid = $this->db->query("SELECT fiscalYearID FROM tbl_fiscalyear GROUP by fiscalYearID ORDER BY CAST(fiscalYearID AS int) DESC LIMIT 1")->row();
            $lastid = $lastid->fiscalYearID;
            $this->accounts_query->update_fiscal_year($lastid);
            
            $this->accounts_query->save_fiscal_year($data);

            $sdata = array();
            $sdata['message'] = 'Fiscal Year successfully added';
            $this->session->set_userdata($sdata);
            $this->fiscal_year_add();

            $this->session->sess_destroy();
            redirect('login');
        } else {
            $this->fiscal_year_add();
        }
    }//save_fiscal_year

}//controller_end