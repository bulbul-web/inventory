<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
    
    
    public function index()
    {
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        
        $data['title'] = 'Dashboard';
        $data['css'] = $this->load->view('common/allcss', '', true);
        $data['scripts'] = $this->load->view('common/allscripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', '', true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/dashboard', '', true);
        $this->load->view('index', $data);
    }
    
    public function account_form_view()
    {
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        
        $data['title'] = 'Account';
        $data['css'] = $this->load->view('common/allcss', '', true);
        $data['scripts'] = $this->load->view('common/allscripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', '', true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/account-form-view', $data, true);
        $this->load->view('index', $data);
    }
    
    public function change_password_form_view()
    {
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        
        $data['title'] = 'Change Password';
        $data['css'] = $this->load->view('common/allcss', '', true);
        $data['scripts'] = $this->load->view('common/allscripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', '', true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/change-password-form-view', $data, true);
        $this->load->view('index', $data);
    }
    
    public function change_password()
    {
        
        $this->form_validation->set_rules('user_pass', 'Password', 'required|min_length[4]');
        $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[4]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|min_length[4]|matches[new_password]');
        
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->change_password_form_view();
        }else{
            $user_pass = md5($this->input->post('user_pass'));
            $id = $this->input->post('user_id', true);
            
            //password
            $userInfo = $this->users_model->user_info($id);
            
            
            if($user_pass == $userInfo->user_pass)
            {
                $data['user_id'] = $this->input->post('user_id', true);
                $data['user_pass'] = md5($this->input->post('new_password', true));
                
                $this->users_model->update_password($data);
                $sdata = array();
                $sdata['message'] = 'Password updated successfully!';
                $this->session->set_userdata($sdata);
                $this->change_password_form_view();
            }else{
                $sdata = array();
                $sdata['message'] = 'Invalid Password';
                $this->session->set_userdata($sdata);
                $this->change_password_form_view();
            }
            
            
            
        }
           
    }
    
    
    
    public function update_user(){
        $this->form_validation->set_rules('user_name', 'User Name', 'required');
        $this->form_validation->set_rules('user_email', 'User Email', 'required');
        
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        if($this->form_validation->run()){
            if($_FILES['file']['name'] == '' || $_FILES['file']['size'] == 0){
                $img = $this->input->post('old_file', TRUE);
                $this->users_model->update_users($img);

                $sdata = array();
                $sdata['message'] = 'Successfully Updated';
                $this->session->set_userdata($sdata);
                $this->account_form_view();
            }
            else{

                if ($_FILES['file']['size'] <= 10000000) {
        //           10000000

                    //file extension
                    $fileExt = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                    if ($fileExt == 'jpg' || $fileExt == 'png'){

                        //file size
                        $file = $_FILES["file"]['tmp_name'];
                        list($width, $height) = getimagesize($file);

                        if($width == "110" || $height == "110"){

                            $path = "./".$this->input->post('old_file', TRUE);
                            unlink($path);

                            $result = $this->do_upload('file');
                            if ($result['upload_data']) {
                                $img = '/assets/images/avatars/' . $result['upload_data']['file_name'];
                                $this->users_model->update_users($img);


                                $sdata = array();
                                $sdata['message'] = 'Successfully Updated';
                                $this->session->set_userdata($sdata);
                                $this->account_form_view();
                            }
                        }else{
                            $sdata = array();
                            $sdata['message'] = 'Image size will be (110 x 110)';
                            $this->session->set_userdata($sdata);
                            $this->account_form_view();
                        }
                    }else{
                        $sdata = array();
                        $sdata['message'] = 'Select an image (jpg/png)';
                        $this->session->set_userdata($sdata);
                        $this->account_form_view();
                    }
                }else{
                    $sdata = array();
                    $sdata['message'] = 'Select an image in size less than 1MB';
                    $this->session->set_userdata($sdata);
                    $this->account_form_view();
                }

            }
        } else {
            $sdata = array();
            $sdata['message'] = 'Try again!';
            $this->session->set_userdata($sdata);
            $this->account_form_view();
        }
        
    }
    
    
    
    
    
    
    
    
    
    //------------------------------------------------------- img upload function -------------------------------

    public function do_upload($image_file) {
        $config['upload_path'] = './assets/images/avatars/';
        $config['allowed_types'] = 'jpg|png';
        //$config['file_name'] =  microtime();
        $new_name = microtime() . $_FILES["file"]['name'];
		//$new_name = microtime() . $_FILES["admission_rules_url"]['name'];
		//$new_name = microtime() . $_FILES["admission_notice_url"]['name'];
        $config['file_name'] = md5($new_name);
        $config['encrypt_name'] = TRUE;
        $config['max_size'] = '1000000';
        $config['max_width'] = '1024000';
        $config['max_height'] = '768000';
        $config['overwrite'] = TRUE;

        $this->load->library('upload', $config);
        //$this->upload->resize();
        if (!$this->upload->do_upload($image_file)) {
            //  if ( ! $this->upload->resize())
            $error = array('error' => $this->upload->display_errors(), 'upload_data' => '');
            return $error;
        } else {
            $data = array('upload_data' => $this->upload->data(), 'error' => '');
            return $data;
        }
    }
    
    
    
    
    
    
}
