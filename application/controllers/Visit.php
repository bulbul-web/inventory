<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visit extends CI_Controller {
    public function __construct() {
        parent::__construct();
        //$this->session->sess_destroy();
        $this->loged_out();
    }
    
    private function loged_out(){
        if(!$this->session->userdata('authenticated'))
        {
            redirect('login');
        }
    }

    public function visitor_list()
    {
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['allVisitor'] = $this->visit_query->allVisitor();
                
        $data['title'] = 'Visitor Add';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/visitor/visitors', $data, true);
        $this->load->view('index', $data);
    }

    public function visit_add_form()
    {
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        
        $data['title'] = 'Visitor Add';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/visitor/visitor_add_form', $data, true);
        $this->load->view('index', $data);
    }

    public function save_visitor()
    {
        $this->form_validation->set_rules(
                'name', 'Name',
                'required|min_length[2]|max_length[50]|is_unique[tbl_visit_info.name]|is_unique[tbl_customer.customer_name]',
                array(
                        'required'      => 'You have not provided %s.',
                        'is_unique'     => 'This %s already exists.'
                )
        );     
        
        
        if($this->form_validation->run()){


            $data = array();
            $data['name'] = $this->input->post('name', true);
            $data['phone'] = $this->input->post('phone', true);
            $data['email'] = $this->input->post('email', true);
            $data['description'] = $this->input->post('description', true);
            $data['address'] = $this->input->post('address', true);
            $data['visit_date'] = $this->input->post('visit_date', true);
            $data['next_visit_date'] = $this->input->post('next_visit_date', true);
            $user_id = $this->session->userdata('user_id');
            $salesman = $this->db->query("SELECT * FROM tbl_user WHERE user_id = '$user_id' ")->row();
            $data['user_id'] = $salesman->m_rm_s_id;
            $data['entry_date'] = date("Y-m-d");
            $data['image'] = '';
            $data['status'] = 1;


            $check = $this->input->post('check', true);

            $cdata = array();
            $cdata['customer_name'] = $data['name'];
            $cdata['customer_address']= $data['address'];
            $cdata['customer_mobile']= $data['phone'];
            $cdata['customer_email'] = $data['email'];
            $cdata['entry_by'] = $this->session->userdata('user_name');
            $cdata['entry_date'] = date("Y-m-d");
            $cdata['customer_status'] = 1;
            

            if($_FILES['image']['name'] == '' || $_FILES['image']['size'] == 0){
                $this->visit_query->saveVisitorData($data);
                if($check == 'customer'){          
                    $this->query_model->saveCustomerData($cdata);
                }

                $sdata = array();
                $sdata['message'] = 'Successfully Save';
                $this->session->set_userdata($sdata);
                $this->visit_add_form();
            } else {
            
                if ($_FILES['image']['size'] <= 10000000) {
        //           10000000
                
                    //file extension
                    $fileExt = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                    
                    if ($fileExt == 'jpg' || $fileExt == 'png'){
                        
                        
                        $result = $this->do_upload('image');
                        if ($result['upload_data']) {
                            $img = '/assets/images/products/' . $result['upload_data']['file_name'];
                            $data['image'] = $img;

                            $this->visit_query->saveVisitorData($data);
                            if($check == 'customer'){
                                $this->query_model->saveCustomerData($cdata);
                            }

                            $sdata = array();
                            $sdata['message'] = 'Successfully Save';
                            $this->session->set_userdata($sdata);
                            $this->visit_add_form();
                        }
                        
                    }else{
                        $sdata = array();
                        $sdata['message'] = 'Select an image (jpg/png)';
                        $this->session->set_userdata($sdata);
                        $this->visit_add_form();
                    }
                }else{
                    $sdata = array();
                    $sdata['message'] = 'Select an image in size less than 1MB';
                    $this->session->set_userdata($sdata);
                    $this->visit_add_form();
                }
            }  
        } else {
            $sdata = array();
            $sdata['message'] = 'Try';
            $this->session->set_userdata($sdata);
            $this->visit_add_form();
        }
    }


    function do_upload($image_file) {

        $config['upload_path'] = './assets/images/products/';
        $config['allowed_types'] = 'gif|jpg|png';
        //'pdf|csv';
//$config['file_name'] =  microtime();
        $new_name = microtime() . $_FILES["image"]['name'];
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