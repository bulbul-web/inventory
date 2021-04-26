<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
    public function __construct() {
        parent::__construct();
        
        //$this->session->sess_destroy();
        $this->load->model('users_model');
    }
    
    public function index()
    {
        if($this->session->userdata('authenticated'))
        {
            redirect('dashboard');
        } else {
            $this->load->view('login');
        }
    }
    
    public function login_check()
    {
        $this->form_validation->set_rules('user_email', 'Email', 'required');
        $this->form_validation->set_rules('user_pass', 'Password', 'required');
        
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        if($this->form_validation->run() == false ){
            $this->load->view('login');
        }else{
            $user_email = $this->security->xss_clean($this->input->post('user_email'));
            $user_pass = $this->security->xss_clean($this->input->post('user_pass'));
            
            $user = $this->users_model->login($user_email, $user_pass);

            $fiscal_year = $this->users_model->select_fiscal_year();
            
            if($user)
            {
                $userdata = array(
                    'user_id' => $user->user_id,
                    'user_name' => $user->user_name,
                    'user_email' => $user->user_email,
                    'user_role' => $user->user_role,
                    'authenticated' => TRUE,
                    'fiscalYearID' => $fiscal_year->fiscalYearID,
                    'fiscal_startDate' => $fiscal_year->startDate,
                    'fiscal_endDate' => $fiscal_year->endDate

                );
                
                $this->session->set_userdata($userdata);
                redirect('dashboard');
            }else{
                $sdata = array();
                $sdata['message'] = 'Invalid Email or password';
                $this->session->set_userdata($sdata);
                redirect('login');
            }
        }
    }
    
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }

    public function all_users(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['userList'] = $this->users_model->all_users();

        
        $data['title'] = 'User List';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/users/all_users', $data, true);
        $this->load->view('index', $data);
    }

    public function add_user_form(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);        
        $data['title'] = 'User Add Form';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/users/add_user_form', $data, true);
        $this->load->view('index', $data);
    }

    public function save_user(){

        $this->form_validation->set_rules('user_name', 'User Name', 'required|is_unique[tbl_user.user_name]');
        $this->form_validation->set_rules('user_email', 'User Email or login name', 'required|is_unique[tbl_user.user_email]');
        $this->form_validation->set_rules('user_mobile', 'User Mobile', 'required');
        $this->form_validation->set_rules('user_pass', 'User Password', 'required|min_length[4]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|min_length[4]|matches[user_pass]');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if($this->form_validation->run() == FALSE)
        {
            $this->add_user_form();
        }else{
            $data['user_mobile'] = $this->input->post('user_mobile');
            $data['user_email'] = $this->input->post('user_email');
            $data['user_name'] = $this->input->post('user_name');
            $data['user_pass'] = md5($this->input->post('user_pass'));
            $data['user_role'] = $this->input->post('user_role');
            $data['status'] = 1;

            $this->users_model->save_user($data);
            $sdata = array();
            $sdata['message'] = 'User added successfully';
            $this->session->set_userdata($sdata);
            $this->add_user_form();
        }

    }

    public function edit_user_form($user_id){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);        
        $data['singleUser'] = $this->users_model->single_user($user_id);        
        $data['title'] = 'User update Form';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/users/edit_user_form', $data, true);
        $this->load->view('index', $data);
    }

    public function update_user_particular(){
        $user_id = $this->input->post("user_id", true);
        $this->form_validation->set_rules('user_name', 'User Name', 'required');
        $this->form_validation->set_rules('user_email', 'User Email or login name', 'required');
        $this->form_validation->set_rules('user_mobile', 'User Mobile', 'required');        
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->edit_user_form($user_id);
        }else{  
            $data['user_id'] = $user_id;
            $data['user_mobile'] = $this->input->post('user_mobile');
            $data['user_email'] = $this->input->post('user_email');
            $data['user_name'] = $this->input->post('user_name');
            $data['user_role'] = $this->input->post('user_role');
            $data['status'] = $this->input->post('status');
            
            $this->users_model->update_user($data);
            $sdata = array();
            $sdata['message'] = 'User updated successfully!';
            $this->session->set_userdata($sdata);
            $this->edit_user_form($user_id);  
        }
    }
    
    
    
    
}