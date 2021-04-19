<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class QrcodeController extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('Ciqrcode');
        $this->loged_out();
    }

    public function QRcodebuild($text = '123456789')
    {
        QRcode::png(
                $text,
                $outfile = false,
                $level = QR_ECLEVEL_H,
                $size = 5,
                $margin = 2
        );
    }

    public function index(){
        $data['title'] = 'this is title';
        $this->load->view('render', $data);
    }
    
    private function loged_out(){
        if(!$this->session->userdata('authenticated'))
        {
            $this->session->sess_destroy();
            redirect('login');
        }
    }

    public function qrcode_generator_by_input(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['qrcodelist'] = $this->query_model->qrcodeList();
        
        $data['title'] = 'QR Code';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/QR_Code/qrcodelist', $data, true);
        $this->load->view('index', $data);
    }

    public function qrcode_form(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        
        $data['title'] = 'QR Code Generate';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/QR_Code/qrcode_form', $data, true);
        $this->load->view('index', $data);
    }

    public function save_qrcode(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        
        $data['title'] = 'QR Code View';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/QR_Code/qrcode_details', $data, true);
        $this->load->view('index', $data);
    }

}