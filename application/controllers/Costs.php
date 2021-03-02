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
    
    public function costs_list(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['allCosts'] = $this->query_model->viewAllCosts();
        
        $data['title'] = 'Transaction Head';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', '', true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/costs/costs_list', $data, true);
        $this->load->view('index', $data);
    }

    public function transaction_add_form(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        
        $data['title'] = 'Transaction Head';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', '', true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/costs/transaction_add_form', $data, true);
        $this->load->view('index', $data);
    }

    //for ajax field match and auto fill filds
    public function get_all_transaction_head_match($trans_head){

        if(empty($trans_head)){
            echo json_encode([]);
            exit;
        }
        
        $trans_head = $this->query_model->viewAllTransHeadMatch($trans_head);
        echo json_encode($trans_head);exit;
    }
    //for ajax field match and auto fill filds

    public function save_expense(){
        $this->form_validation->set_rules('trnsction_date', 'Trnsction Date', 'required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        if($this->form_validation->run()){
            $lastid = $this->db->query('SELECT trnsction_id FROM tbl_costs GROUP by trnsction_id ORDER BY CAST(trnsction_id AS int) DESC LIMIT 1')->row();
            
            if(!empty($lastid)){
                $lastid = $lastid->trnsction_id;
                
            }else{
                $lastid = 0;
            }
            $cc = intval($lastid)+1;
            $trnsction_id = $cc; 

            
            $trnsction_date = $this->input->post('trnsction_date', true);
            $note = $this->input->post('note', true);
            $amount = $this->input->post('amount', true);
            $costs_head_id = $this->input->post('id', true);
            
            for($i=0; $i<count($costs_head_id); $i++){
                $data[] = [
                    'costs_head_id' => $costs_head_id[$i],
                    'amount' => $amount[$i],
                    'trnsction_date' => $trnsction_date,
                    'note' => $note,
                    'trnsction_id' => $trnsction_id,
                    'entry_by' => $this->session->userdata('user_name'),
                    'entry_date' => date("Y-m-d"),
                    'status' => 1
                ];
            }
        //    echo '<pre>';
        //    print_r($data);
        //    exit();

            //insert batch
            $insert_batch = $this->db->insert_batch('tbl_costs', $data);
            if($insert_batch){
                $sdata = array();
                $sdata['message'] = 'Expenses Created successfully';
                $this->session->set_userdata($sdata);
                $this->transaction_add_form();
            }else{
                $sdata = array();
                $sdata['message'] = 'Error';
                $this->session->set_userdata($sdata);
                $this->transaction_add_form();
            }
        }else{
            $sdata = array();
            $sdata['message'] = 'Validation Error';
            $this->session->set_userdata($sdata);
            $this->transaction_add_form();
        }
    }

    public function costs_details($trnsction_id){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['expense_details'] = $this->query_model->expense_details($trnsction_id);
        $data['expense_details_all'] = $this->query_model->expense_details_all($trnsction_id);
        
        $data['title'] = 'Expense Details';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', '', true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/costs/transaction_single_view', $data, true);
        $this->load->view('index', $data);
    }

    public function edit_transaction_form($trnsction_id){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['expense_details'] = $this->query_model->expense_details($trnsction_id);
        $data['expense_details_all'] = $this->query_model->expense_details_all($trnsction_id);
        
        $data['title'] = 'Expense Update';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', '', true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/costs/edit_transaction_form', $data, true);
        $this->load->view('index', $data);
    }


    public function update_expense(){
        $this->form_validation->set_rules('trnsction_date', 'Trnsction Date', 'required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $trnsction_id = $this->input->post('trnsction_id', true); 
        
        if($this->form_validation->run()){
            
            $trns_prmr_id = $this->input->post('trns_prmr_id', true);
            $trnsction_id = $this->input->post('trnsction_id', true); 
            $trnsction_date = $this->input->post('trnsction_date', true);
            $note = $this->input->post('note', true);
            $amount = $this->input->post('amount', true);
            $costs_head_id = $this->input->post('id', true);
            
            for($i=0; $i<count($costs_head_id); $i++){
                $data[] = [
                    'id' => $trns_prmr_id[$i],
                    'costs_head_id' => $costs_head_id[$i],
                    'amount' => $amount[$i],
                    'trnsction_date' => $trnsction_date,
                    'note' => $note,
                    'trnsction_id' => $trnsction_id,
                    'entry_by' => $this->session->userdata('user_name'),
                    // 'entry_date' => date("Y-m-d"),
                    'status' => 1
                ];
                $data1[] = [
                    'costs_head_id' => $costs_head_id[$i]
                ];
            }

            

            for($x=0;$x<count($data1);$x++){
                $costs_head_id = $data1[$x]['costs_head_id'];
                $result = $this->db->query("SELECT * FROM tbl_costs WHERE trnsction_id = '$trnsction_id' AND costs_head_id = $costs_head_id")->num_rows();
                if( $result > 0){
                   $this->db->where('id', $data[$x]['id']);
                   $this->db->update('tbl_costs', $data[$x]);
                }else{
                   $this->db->insert('tbl_costs', $data[$x]);
                }
            }

            $sdata = array();
            $sdata['message'] = 'Expense Updated successfully';
            $this->session->set_userdata($sdata);
            redirect(base_url()."edit-transaction/".$trnsction_id);

          
        }else{
            $sdata = array();
            $sdata['message'] = 'Validation Error';
            $this->session->set_userdata($sdata);
            redirect(base_url()."edit-transaction/".$trnsction_id);
        }
    }

    public function delete_expense($id, $trnsction_id){
        $this->query_model->delete_expense_single($id);
        redirect(base_url()."edit-transaction/".$trnsction_id);
    }

    public function delete_expense_status($id, $trnsction_id){
        $this->query_model->delete_expense_status($id);
        redirect(base_url()."edit-transaction/".$trnsction_id);
    }



}