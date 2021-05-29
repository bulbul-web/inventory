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

    public function manager_list(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['managerList'] = $this->users_model->manager_list();

        
        $data['title'] = 'Manager List';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/users/manager/all_manager', $data, true);
        $this->load->view('index', $data);
    }

    public function regional_manager_list(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['regionalmanagerList'] = $this->users_model->regional_manager_list();

        $data['title'] = 'Regional Manager List';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/users/regional_manager/all_regional_manager', $data, true);
        $this->load->view('index', $data);
    }

    public function salesman_list(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['salesmanList'] = $this->users_model->salesman_list();

        $data['title'] = 'Salesman List';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/users/salesman/all_salesman', $data, true);
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
    
    public function add_manager_form(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);        
        $data['title'] = 'Manager Add Form';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/users/manager/add_manager_form', $data, true);
        $this->load->view('index', $data);
    }

    public function add_regional_manager_form(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id); 
        $data['managerListActive'] = $this->users_model->manager_list_active();
        $data['title'] = 'Regional Manager Add Form';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/users/regional_manager/add_regional_manager_form', $data, true);
        $this->load->view('index', $data);
    }

    public function add_salesman_form(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['managerListActive'] = $this->users_model->manager_list_active(); 
        $data['regionalManagerListActive'] = $this->users_model->regional_manager_list_active();
        $data['title'] = 'Salesman Add Form';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/users/salesman/add_salesman_form', $data, true);
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

    public function save_manager(){

        $this->form_validation->set_rules('name', 'Manager Name', 'required|is_unique[tbl_user.user_name]|is_unique[tbl_manager.name]');
        $this->form_validation->set_rules('user_email', 'login name', 'required|is_unique[tbl_user.user_email]');
        $this->form_validation->set_rules('user_pass', 'User Password', 'required|min_length[4]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|min_length[4]|matches[user_pass]');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if($this->form_validation->run() == FALSE)
        {
            $this->add_manager_form();
        }else{
            $datam['name'] = $this->input->post('name');
            $datam['phone'] = $this->input->post('phone');
            $datam['email'] = $this->input->post('email');
            $datam['status'] = 1;
            $datam['entry_by'] = $this->session->userdata('user_name');
            $datam['entry_date'] = date("Y-m-d");
            // $datam['warehouse_id'] = '';
            $this->users_model->save_manager($datam);

            $lastid = $this->db->query('SELECT MAX(id) as max_id FROM tbl_manager')->row();
            $m_rm_s_id = $lastid->max_id; //last_id

            $data['m_rm_s_id'] = $m_rm_s_id;
            $data['user_name'] = $this->input->post('name');
            $data['user_email'] = $this->input->post('user_email');
            $data['user_mobile'] = $this->input->post('phone');
            $data['status'] = 1;
            $data['user_pass'] = md5($this->input->post('user_pass'));
            $data['user_role'] = 4; //manager = 4

            $this->users_model->save_user($data);
            $sdata = array();
            $sdata['message'] = 'Manager added successfully';
            $this->session->set_userdata($sdata);
            $this->add_manager_form();
        }

    }

    public function save_regional_manager(){

        $this->form_validation->set_rules('manager_id', 'Manager Name', 'required');
        $this->form_validation->set_rules('name', 'Regional Manager Name', 'required|is_unique[tbl_user.user_name]|is_unique[tbl_regional_manager.name]');
        $this->form_validation->set_rules('user_email', 'login name', 'required|is_unique[tbl_user.user_email]');
        $this->form_validation->set_rules('user_pass', 'User Password', 'required|min_length[4]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|min_length[4]|matches[user_pass]');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if($this->form_validation->run() == FALSE)
        {
            $this->add_manager_form();
        }else{
            $datam['manager_id'] = $this->input->post('manager_id');
            $datam['name'] = $this->input->post('name');
            $datam['phone'] = $this->input->post('phone');
            $datam['email'] = $this->input->post('email');
            $datam['status'] = 1;
            $datam['entry_by'] = $this->session->userdata('user_name');
            $datam['entry_date'] = date("Y-m-d");
            // $datam['warehouse_id'] = '';
            $this->users_model->save_regional_manager($datam);

            $lastid = $this->db->query('SELECT MAX(id) as max_id FROM tbl_regional_manager')->row();
            $m_rm_s_id = $lastid->max_id; //last_id

            $data['m_rm_s_id'] = $m_rm_s_id;
            $data['user_name'] = $this->input->post('name');
            $data['user_email'] = $this->input->post('user_email');
            $data['user_mobile'] = $this->input->post('phone');
            $data['status'] = 1;
            $data['user_pass'] = md5($this->input->post('user_pass'));
            $data['user_role'] = 2; //regional manager = 2

            $this->users_model->save_user($data);
            $sdata = array();
            $sdata['message'] = 'Regional Manager added successfully';
            $this->session->set_userdata($sdata);
            $this->add_regional_manager_form();
        }

    }

    public function save_salesman(){

        $this->form_validation->set_rules('manager_id', 'Manager Name', 'required');
        $this->form_validation->set_rules('regional_manager_id', 'Regional Manager Name', 'required');
        $this->form_validation->set_rules('name', 'Salesman Name', 'required|is_unique[tbl_user.user_name]|is_unique[tbl_salesman.name]');
        $this->form_validation->set_rules('user_email', 'login name', 'required|is_unique[tbl_user.user_email]');
        $this->form_validation->set_rules('user_pass', 'User Password', 'required|min_length[4]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|min_length[4]|matches[user_pass]');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if($this->form_validation->run() == FALSE)
        {
            $this->add_salesman_form();
        }else{
            $datam['manager_id'] = $this->input->post('manager_id');
            $datam['regional_manager_id'] = $this->input->post('regional_manager_id');
            $datam['name'] = $this->input->post('name');
            $datam['phone'] = $this->input->post('phone');
            $datam['email'] = $this->input->post('email');
            $datam['status'] = 1;
            $datam['entry_by'] = $this->session->userdata('user_name');
            $datam['entry_date'] = date("Y-m-d");
            // $datam['warehouse_id'] = '';
            $this->users_model->save_salesman($datam);

            $lastid = $this->db->query('SELECT MAX(id) as max_id FROM tbl_salesman')->row();
            $m_rm_s_id = $lastid->max_id; //last_id

            $data['m_rm_s_id'] = $m_rm_s_id;
            $data['user_name'] = $this->input->post('name');
            $data['user_email'] = $this->input->post('user_email');
            $data['user_mobile'] = $this->input->post('phone');
            $data['status'] = 1;
            $data['user_pass'] = md5($this->input->post('user_pass'));
            $data['user_role'] = 3; //salesman = 3

            $this->users_model->save_user($data);
            $sdata = array();
            $sdata['message'] = 'Salesman added successfully';
            $this->session->set_userdata($sdata);
            $this->add_salesman_form();
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

    public function edit_manager_form($manager_id){
        
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id); 

        $data['singleManager'] = $this->users_model->single_manager($manager_id);        
        $data['title'] = 'User update Form';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/users/manager/edit_manager_form', $data, true);
        $this->load->view('index', $data);
    }

    public function edit_regional_manager_form($regional_manager_id){
        
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id); 
        $data['managerListActive'] = $this->users_model->manager_list_active();

        $data['singleRegionalManager'] = $this->users_model->single_regional_manager($regional_manager_id);        
        $data['title'] = 'User update Form';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/users/regional_manager/edit_regional_manager_form', $data, true);
        $this->load->view('index', $data);
    }

    public function edit_salesman_form($salesman_id){
        
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id); 
        $data['managerListActive'] = $this->users_model->manager_list_active();
        $data['regionalManagerListActive'] = $this->users_model->regional_manager_list_active();

        $data['singleSalesman'] = $this->users_model->single_salesman($salesman_id);        
        $data['title'] = 'User update Form';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/users/salesman/edit_salesman_form', $data, true);
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

    public function update_manager_particular(){
        $manager_id = $this->input->post('id');
        $user_id = $this->input->post('user_id');
        $this->form_validation->set_rules('name', 'Manager Name', 'required');
        $this->form_validation->set_rules('user_email', 'login name', 'required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if($this->form_validation->run() == FALSE)
        {
            $this->edit_manager_form($manager_id);
        }else{
            $datam['id'] = $manager_id;
            $datam['name'] = $this->input->post('name');
            $datam['phone'] = $this->input->post('phone');
            $datam['email'] = $this->input->post('email');
            $datam['status'] = $this->input->post('status');
            $datam['entry_by'] = $this->session->userdata('user_name');
            $datam['entry_date'] = date("Y-m-d");
            // $datam['warehouse_id'] = '';
            $this->users_model->update_manager($datam);

            $data['user_id'] = $user_id;
            $data['user_name'] = $this->input->post('name');
            $data['user_email'] = $this->input->post('user_email');
            $data['user_mobile'] = $this->input->post('phone');
            $data['status'] = $this->input->post('status');

            $this->users_model->update_user($data);
            $sdata = array();
            $sdata['message'] = 'Manager updated successfully';
            $this->session->set_userdata($sdata);
            $this->edit_manager_form($manager_id);
        }
    }

    public function update_regional_manager_particular(){
        $regional_manager_id = $this->input->post('id');
        $user_id = $this->input->post('user_id');
        $this->form_validation->set_rules('manager_id', 'Manager Name', 'required');
        $this->form_validation->set_rules('name', 'Regional Manager Name', 'required');
        $this->form_validation->set_rules('user_email', 'login name', 'required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if($this->form_validation->run() == FALSE)
        {
            $this->edit_regional_manager_form($regional_manager_id);
        }else{
            $datam['id'] = $regional_manager_id;
            $datam['manager_id'] = $this->input->post('manager_id');
            $datam['name'] = $this->input->post('name');
            $datam['phone'] = $this->input->post('phone');
            $datam['email'] = $this->input->post('email');
            $datam['status'] = $this->input->post('status');
            $datam['entry_by'] = $this->session->userdata('user_name');
            $datam['entry_date'] = date("Y-m-d");
            // $datam['warehouse_id'] = '';
            $this->users_model->update_regional_manager($datam);

            $data['user_id'] = $user_id;
            $data['user_name'] = $this->input->post('name');
            $data['user_email'] = $this->input->post('user_email');
            $data['user_mobile'] = $this->input->post('phone');
            $data['status'] = $this->input->post('status');

            $this->users_model->update_user($data);
            $sdata = array();
            $sdata['message'] = 'Regional Manager updated successfully';
            $this->session->set_userdata($sdata);
            $this->edit_regional_manager_form($regional_manager_id);
        }
    }

    public function update_salesman_particular(){
        $salesman_id = $this->input->post('id');
        $user_id = $this->input->post('user_id');
        $this->form_validation->set_rules('manager_id', 'Manager Name', 'required');
        $this->form_validation->set_rules('regional_manager_id', 'Regional Manager Name', 'required');
        $this->form_validation->set_rules('name', 'Salesman Name', 'required');
        $this->form_validation->set_rules('user_email', 'login name', 'required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if($this->form_validation->run() == FALSE)
        {
            $this->edit_salesman_form($salesman_id);
        }else{
            $datam['id'] = $salesman_id;
            $datam['manager_id'] = $this->input->post('manager_id');
            $datam['regional_manager_id'] = $this->input->post('regional_manager_id');
            $datam['name'] = $this->input->post('name');
            $datam['phone'] = $this->input->post('phone');
            $datam['email'] = $this->input->post('email');
            $datam['status'] = $this->input->post('status');
            $datam['entry_by'] = $this->session->userdata('user_name');
            $datam['entry_date'] = date("Y-m-d");
            // $datam['warehouse_id'] = '';
            $this->users_model->update_salesman($datam);

            $data['user_id'] = $user_id;
            $data['user_name'] = $this->input->post('name');
            $data['user_email'] = $this->input->post('user_email');
            $data['user_mobile'] = $this->input->post('phone');
            $data['status'] = $this->input->post('status');

            $this->users_model->update_user($data);
            $sdata = array();
            $sdata['message'] = 'Salesman updated successfully';
            $this->session->set_userdata($sdata);
            $this->edit_salesman_form($salesman_id);
        }
    }


    public function change_password_form_view_manager($manager_id)
    {
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        
        $data['singleManager'] = $this->users_model->single_manager($manager_id);
        $data['title'] = 'Change Password';
        $data['css'] = $this->load->view('common/allcss', '', true);
        $data['scripts'] = $this->load->view('common/allscripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/change-password-form-view-manager', $data, true);
        $this->load->view('index', $data);
    }

    public function change_password_regional_manager($regional_manager_id)
    {
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        
        $data['singleRegionalManager'] = $this->users_model->single_regional_manager($regional_manager_id);
        $data['title'] = 'Change Password';
        $data['css'] = $this->load->view('common/allcss', '', true);
        $data['scripts'] = $this->load->view('common/allscripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/change-password-form-view-regional-manager', $data, true);
        $this->load->view('index', $data);
    }

    public function change_password_salesman($salesman_id)
    {
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        
        $data['singleSalesman'] = $this->users_model->single_salesman($salesman_id);
        $data['title'] = 'Change Password';
        $data['css'] = $this->load->view('common/allcss', '', true);
        $data['scripts'] = $this->load->view('common/allscripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/change-password-form-view-salesman', $data, true);
        $this->load->view('index', $data);
    }
    
    public function change_password_manager()
    {
        $manager_id = $this->input->post('id', true);
        $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[4]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|min_length[4]|matches[new_password]');
        
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->change_password_form_view_manager($manager_id);
        }else{
                        
            $data['user_id'] = $this->input->post('user_id', true);
            $data['user_pass'] = md5($this->input->post('new_password', true));
            
            $this->users_model->update_password($data);
            $sdata = array();
            $sdata['message'] = 'Password updated successfully!';
            $this->session->set_userdata($sdata);
            $this->change_password_form_view_manager($manager_id);
        }
           
    }

    public function update_password_regional_manager()
    {
        $regional_manager_id = $this->input->post('id', true);
        $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[4]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|min_length[4]|matches[new_password]');
        
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->change_password_regional_manager($regional_manager_id);
        }else{
                        
            $data['user_id'] = $this->input->post('user_id', true);
            $data['user_pass'] = md5($this->input->post('new_password', true));
            
            $this->users_model->update_password($data);
            $sdata = array();
            $sdata['message'] = 'Password updated successfully!';
            $this->session->set_userdata($sdata);
            $this->change_password_regional_manager($regional_manager_id);
        }
           
    }

    public function update_password_salesman()
    {
        $salesman_id = $this->input->post('id', true);
        $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[4]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|min_length[4]|matches[new_password]');
        
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->change_password_salesman($salesman_id);
        }else{
                        
            $data['user_id'] = $this->input->post('user_id', true);
            $data['user_pass'] = md5($this->input->post('new_password', true));
            
            $this->users_model->update_password($data);
            $sdata = array();
            $sdata['message'] = 'Password updated successfully!';
            $this->session->set_userdata($sdata);
            $this->change_password_salesman($salesman_id);
        }
           
    }


    public function findRegionalManager(){
        $manager_id = $this->input->post('manager_id');
        $regionalManager = $this->db->query("SELECT * FROM tbl_regional_manager WHERE manager_id = '$manager_id' AND status = 1 ORDER BY name ASC")->result();
        echo "<option value=''>" . 'Select Regional Manager' . "</option>";
        foreach ($regionalManager as $value) :
            echo "<option value='$value->id'>" . ucfirst($value->name) . "</option>";
        endforeach;
    }

    public function marketing_setup_section()
    {
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['title'] = 'Marketing Setup';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/users/salesman/marketing_setup_section', $data, true);
        $this->load->view('index', $data);
    }
    
    
    
    
}