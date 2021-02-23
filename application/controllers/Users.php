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
            
            if($user)
            {
                $userdata = array(
                    'user_id' => $user->user_id,
                    'user_name' => $user->user_name,
                    'user_email' => $user->user_email,
                    'user_role' => $user->user_role,
                    'authenticated' => TRUE
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
    
    
    
    
}