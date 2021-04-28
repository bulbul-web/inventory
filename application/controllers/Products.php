<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('Ciqrcode');
        $this->load->library('Zend');
        $this->loged_out();
    }
    
    private function loged_out(){
        if(!$this->session->userdata('authenticated'))
        {
            redirect('login');
        }
    }
    
    
    
    public function QRcode($text = '123456')
    {
        QRcode::png(
                $text,
                $outfile = false,
                $level = QR_ECLEVEL_H,
                $size = 5,
                $margin = 2
        );
    }
    
    

    public function product_type()
    {
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['productsType'] = $this->query_model->viewAllProductsType();
        
        $data['title'] = 'Product Type';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/products/products_type', $data, true);
        $this->load->view('index', $data);
    }
    
    public function pack_size_list()
    {
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['packSize'] = $this->query_model->viewAllPackSize();
        
        $data['title'] = 'Pack Size';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/products/pack_size_list', $data, true);
        $this->load->view('index', $data);
    }
    public function pack_size_add_form_view(){
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        
        $data['title'] = 'Pack Size Add';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/products/pack_size_add_form_view', $data, true);
        $this->load->view('index', $data);
    }
    public function save_pack_size(){
        $this->form_validation->set_rules('pack_size', 'Pack Size', 'required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        if($this->form_validation->run()){
            $data['pack_size'] = $this->input->post('pack_size', true);
            $data['description'] = $this->input->post('description', true);
            $data['entry_by'] = $this->session->userdata('user_name');
            $data['entry_date'] = date("Y-m-d");
            $data['status'] = $this->input->post('status', true);
            $this->query_model->savePackSizeData($data);
            
            $sdata = array();
            $sdata['message'] = 'Successfully Save';
            $this->session->set_userdata($sdata);
            $this->pack_size_add_form_view();
        } else {
            $this->pack_size_add_form_view();
        }
    }
    public function edit_pack_size_form_view($id){
        

        $data = array();
        $user_id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($user_id);
        $data['value'] = $this->query_model->viewAllPackSizeId($id);
        
        $data['title'] = 'Pack Size update';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/products/pack_size_edit_form_view', $data, true);
        $this->load->view('index', $data);
    }
    public function update_pack_size(){
        $this->form_validation->set_rules('pack_size', 'Pack Size', 'required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        if($this->form_validation->run()){
            $data['id'] = $this->input->post('id', true);
            $data['pack_size'] = $this->input->post('pack_size', true);
            $data['description'] = $this->input->post('description', true);
            $data['entry_by'] = $this->session->userdata('user_name');
            $data['entry_date'] = date("Y-m-d");
            $data['status'] = $this->input->post('status', true);
            $this->query_model->updatePackSizeData($data);
            
            $sdata = array();
            $sdata['message'] = 'Successfully Save';
            $this->session->set_userdata($sdata);
            $this->edit_pack_size_form_view($data['id']);
        } else {
            $this->edit_pack_size_form_view($data['id']);
        }
    }
    public function delete_pack_size($id){
        $this->query_model->delete_pack_size($id);
        $sdata = array();
        $sdata['message'] = 'Successfully deleted';
        $this->session->set_userdata($sdata);
        $this->pack_size_list();
    }

    
    public function products()
    {
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['products'] = $this->query_model->viewAllProducts();
        
        $data['title'] = 'All Product';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/products/products', $data, true);
        $this->load->view('index', $data);
    }
    public function stock_in()
    {
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['stockIn'] = $this->query_model->viewAllStockIn();
        
        $data['title'] = 'Stock In';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/products/stock_in', $data, true);
        $this->load->view('index', $data);
    }
    public function product_details($id)
    {
        $data = array();
        $user_id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($user_id);
        $data['singleProduct'] = $this->query_model->viewSingleProducts($id);
        
        $data['title'] = 'Product Details';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/products/product_single', $data, true);
        $this->load->view('index', $data);
    }
    public function stock_in_details($id)
    {
        $data = array();
        $user_id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($user_id);
        $data['singleStockIn'] = $this->query_model->viewSingleStockIn($id);
        
        $data['title'] = 'Stock In Details';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/products/stock_in_single', $data, true);
        $this->load->view('index', $data);
    }
    
    
    
    public function products_type_add_form_view()
    {
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['suppliers'] = $this->query_model->viewAllSuppliers();
        
        $data['title'] = 'Product Type Add';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/products/products_type_add_form', $data, true);
        $this->load->view('index', $data);
    }
    public function products_form()
    {
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['AllproductType'] = $this->query_model->viewAllProductsTypeActive();
        $data['AllSupplier'] = $this->query_model->viewAllSuppliersActive();
        $data['AllWarehouse'] = $this->query_model->viewAllWarehouseActive();
        
        $data['title'] = 'Product Add';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/products/products_add_form', $data, true);
        $this->load->view('index', $data);
    }
    public function stock_in_form()
    {
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['Allproduct'] = $this->query_model->viewAllProductsActive();
        $data['AllSupplier'] = $this->query_model->viewAllSuppliersActive();
        $data['AllWarehouse'] = $this->query_model->viewAllWarehouseActive();
        
        $data['title'] = 'Stock In';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/products/stock_in_add_form', $data, true);
        $this->load->view('index', $data);
    }
    public function edit_stock_in_form($id)
    {
        $data = array();
        $user_id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($user_id);
        $data['Allproduct'] = $this->query_model->viewAllProductsActive();
        $data['AllSupplier'] = $this->query_model->viewAllSuppliersActive();
        $data['AllWarehouse'] = $this->query_model->viewAllWarehouseActive();
        $data['singleStockIn'] = $this->query_model->viewSingleStockIn($id);
        
        $data['title'] = 'Stock In Update';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/products/stock_in_edit_form', $data, true);
        $this->load->view('index', $data);
    }
    
    public function edit_product_type_form_view($product_type_id)
    {
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['singleProductType'] = $this->query_model->single_product_type($product_type_id);
        
        $data['title'] = 'Product Update';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/products/products_type_edit_form', $data, true);
        $this->load->view('index', $data);
    }
    public function edit_product_form($product_id)
    {
        $data = array();
        $id = $this->session->userdata('user_id');
        $data['userInfo'] = $this->users_model->user_info($id);
        $data['AllproductType'] = $this->query_model->viewAllProductsTypeActive();
        $data['AllSupplier'] = $this->query_model->viewAllSuppliersActive();
        $data['AllWarehouse'] = $this->query_model->viewAllWarehouseActive();
        $data['singleProduct'] = $this->query_model->single_product($product_id);
        
        $data['title'] = 'Product Update';
        $data['css'] = $this->load->view('common/dataTableCss', '', true);
        $data['scripts'] = $this->load->view('common/dataTableScripts', '', true);
        $data['sideMenu'] = $this->load->view('common/sideMenu', $data, true);
        $data['topBar'] = $this->load->view('common/topBar', $data, true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $data['content'] = $this->load->view('pages/products/edit_product_form', $data, true);
        $this->load->view('index', $data);
    }
    
    
    public function save_products_type()
    {
        
        $this->form_validation->set_rules('product_type_name', 'Product Type', 'required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        if($this->form_validation->run()){
            $data['product_type_name'] = $this->input->post('product_type_name', true);
            $data['product_type_descrip'] = $this->input->post('product_type_descrip', true);
            $data['entry_by'] = $this->session->userdata('user_name');
            $data['entry_date'] = date("Y-m-d");
            $data['product_type_status'] = $this->input->post('product_type_status', true);
            $this->query_model->saveProductTypeData($data);
            
            $sdata = array();
            $sdata['message'] = 'Successfully Save';
            $this->session->set_userdata($sdata);
            $this->products_type_add_form_view();
        } else {
            $this->products_type_add_form_view();
        }
    }
    public function save_stock_in()
    {
        $this->form_validation->set_rules('challan_date', 'Challan Date', 'required');
        //$this->form_validation->set_rules('bill_no', 'Bill No', 'required');
        $this->form_validation->set_rules('bill_date', 'Bill Date', 'required');
        $this->form_validation->set_rules('supplier_id', 'Supplier Name', 'required');
        $this->form_validation->set_rules('product_id', 'Product Name', 'required');
        $this->form_validation->set_rules('warehouse_id', 'Warehouse Name', 'required');
        $this->form_validation->set_rules('quantity_in', 'Quantity', 'required');
        $this->form_validation->set_rules('buying_price', 'Buying Price', 'required');
        $this->form_validation->set_rules('sale_price', 'Sale Price', 'required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        if($this->form_validation->run()){
            $data['challan_date'] = $this->input->post('challan_date', true);

            $bill_no = $this->db->query("SELECT bill_no FROM tbl_stock_in ORDER BY id DESC  LIMIT 1")->row();
        
            $data['bill_no'] = sprintf("%03d", $bill_no->bill_no + 1);

            // $data['bill_no'] = $this->input->post('bill_no', true);
            $data['bill_date'] = $this->input->post('bill_date', true);
            $data['supplier_id'] = $this->input->post('supplier_id', true);
            $data['product_id'] = $this->input->post('product_id', true);
            $data['warehouse_id'] = $this->input->post('warehouse_id', true);
            $data['quantity_in'] = $this->input->post('quantity_in', true);
            $data['buying_price'] = $this->input->post('buying_price', true);
            $data['sale_price'] = $this->input->post('sale_price', true);
            $data['note'] = $this->input->post('note', true);
            $data['entry_by'] = $this->session->userdata('user_name');
            $data['entry_date'] = date("Y-m-d");
            $data['status'] = $this->input->post('status', true);

            // echo '<pre>';
            // print_r($data);
            // exit();
            $this->query_model->saveStockInData($data);
            
            $sdata = array();
            $sdata['message'] = 'Stock in successfully added';
            $this->session->set_userdata($sdata);
            $this->stock_in_form();
        } else {
            $this->stock_in_form();
        }
    }
    public function update_stock_in()
    {
        $this->form_validation->set_rules('challan_date', 'Challan Date', 'required');
        $this->form_validation->set_rules('bill_no', 'Bill No', 'required');
        $this->form_validation->set_rules('bill_date', 'Bill Date', 'required');
        $this->form_validation->set_rules('supplier_id', 'Supplier Name', 'required');
        $this->form_validation->set_rules('product_id', 'Product Name', 'required');
        $this->form_validation->set_rules('warehouse_id', 'Warehouse Name', 'required');
        $this->form_validation->set_rules('quantity_in', 'Quantity', 'required');
        $this->form_validation->set_rules('buying_price', 'Buying Price', 'required');
        $this->form_validation->set_rules('sale_price', 'Sale Price', 'required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        if($this->form_validation->run()){
            $data = array();
            $data['id'] = $this->input->post('id', true);
            $data['challan_date'] = $this->input->post('challan_date', true);
            $data['bill_no'] = $this->input->post('bill_no', true);
            $data['bill_date'] = $this->input->post('bill_date', true);
            $data['supplier_id'] = $this->input->post('supplier_id', true);
            $data['product_id'] = $this->input->post('product_id', true);
            $data['warehouse_id'] = $this->input->post('warehouse_id', true);
            $data['quantity_in'] = $this->input->post('quantity_in', true);
            $data['buying_price'] = $this->input->post('buying_price', true);
            $data['sale_price'] = $this->input->post('sale_price', true);
            $data['note'] = $this->input->post('note', true);
            $data['entry_by'] = $this->session->userdata('user_name');
            $data['entry_date'] = date("Y-m-d");
            $data['status'] = $this->input->post('status', true);
            $this->query_model->updateStockInData($data);
            
            $sdata = array();
            $sdata['message'] = 'Stock in successfully Updated';
            $this->session->set_userdata($sdata);
            $this->edit_stock_in_form($data['id']);
        } else {
            $this->edit_stock_in_form($data['id']);
        }
    }
    
    
    
    public function Barcode($text, $height, $type)
    {
        $this->zend->load('Zend/Barcode');
        //$barcodeCreate = Zend_Barcode::render($type, 'image', array('text' => $text, 'barHeight' => $height));//for_show_barcode
        $barcodeCreate = Zend_Barcode::factory($type, 'image', array('text' => $text, 'barHeight' => $height))->draw();//for_png_file_save
        $barcodeImage = $text.'.png';
        imagepng($barcodeCreate, './assets/images/product-barcode/' . $barcodeImage);//for_save_png_file
        return $barcodeImage;
        
    }
    
    public function save_products()
    {
        $this->form_validation->set_rules(
                'product_name', 'Product Name',
                'required|min_length[2]|max_length[50]|is_unique[tbl_product_info.product_name]',
                array(
                        'required'      => 'You have not provided %s.',
                        'is_unique'     => 'This %s already exists.'
                )
        );     
        $this->form_validation->set_rules('product_type_id', 'Product Type', 'required');
        //$this->form_validation->set_rules('product_name', 'Product Name', 'required');
        $this->form_validation->set_rules('pack_size', 'Pack Size', 'required');
        $this->form_validation->set_rules('product_code', 'Product Code', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        if($this->form_validation->run()){


            $data['product_type_id'] = $this->input->post('product_type_id', true);
            $data['product_name'] = $this->input->post('product_name', true);
            $data['product_name_bangla'] = $this->input->post('product_name_bangla', true);
            $data['product_descrip'] = $this->input->post('product_descrip', true);
            $data['product_code'] = $this->input->post('product_code', true);
            $data['pack_size'] = $this->input->post('pack_size', true);
            $data['total_pack_size'] = $this->input->post('total_pack_size', true);
            $data['packet'] = $this->input->post('packet', true);
            $data['product_segment'] = $this->input->post('product_segment', true);
            $data['price'] = $this->input->post('price', true);
            $data['entry_by'] = $this->session->userdata('user_name');
            $data['entry_date'] = date("Y-m-d");
            $data['image'] = '';
            $data['product_status'] = $this->input->post('product_status', true);
            
            $text = $this->db->query('SELECT product_id FROM tbl_product_info ORDER BY product_id DESC LIMIT 1')->row();
            if(!empty($text)){
                $text = $text->product_id;

            }else{
                $text = 0;
            }
            $text = intval($text)+1;
            $height = '80';
            $type = 'code128';
            $data['barcode'] = '/assets/images/product-barcode/'.$this->Barcode($text, $height, $type);//barcode xampp old a kaj kore but 

            if($_FILES['image']['name'] == '' || $_FILES['image']['size'] == 0){
                $this->query_model->saveProductData($data);
                $sdata = array();
                $sdata['message'] = 'Successfully Save';
                $this->session->set_userdata($sdata);
                $this->products_form();
            } else {
            
                if ($_FILES['image']['size'] <= 10000000) {
        //           10000000
                
                    //file extension
                    $fileExt = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                    
                    if ($fileExt == 'jpg' || $fileExt == 'png'){
                        
                        //file size
                        $file = $_FILES["image"]['tmp_name'];
                        list($width, $height) = getimagesize($file);
                        
                        if($width <= "1000" || $height <= "1000"){
                            $result = $this->do_upload('image');
                            if ($result['upload_data']) {
                                $img = '/assets/images/products/' . $result['upload_data']['file_name'];
                                $data['image'] = $img;

                                $this->query_model->saveProductData($data);

                                $sdata = array();
                                $sdata['message'] = 'Successfully Save';
                                $this->session->set_userdata($sdata);
                                $this->products_form();
                            }
                        }else{
                            $sdata = array();
                            $sdata['message'] = 'Image size will be (400 x 400)';
                            $this->session->set_userdata($sdata);
                            $this->products_form();
                        }
                    }else{
                        $sdata = array();
                        $sdata['message'] = 'Select an image (jpg/png)';
                        $this->session->set_userdata($sdata);
                        $this->products_form();
                    }
                }else{
                    $sdata = array();
                    $sdata['message'] = 'Select an image in size less than 1MB';
                    $this->session->set_userdata($sdata);
                    $this->products_form();
                }
            }  
        } else {
            $sdata = array();
            $sdata['message'] = 'Try';
            $this->session->set_userdata($sdata);
            $this->products_form();
        }
    }
    
    public function update_products()
    {
        $this->form_validation->set_rules('product_type_id', 'Product Type', 'required');
        $this->form_validation->set_rules('product_name', 'Product Name', 'required');
        $this->form_validation->set_rules('product_code', 'Product Code', 'required');
        $this->form_validation->set_rules('pack_size', 'Pack Size', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        if($this->form_validation->run()){
            if($_FILES['image']['name'] == '' || $_FILES['image']['size'] == 0)
            {
                
                $img = $this->input->post('old_image', true);
                $data['product_id'] = $this->input->post('product_id', true);
                $data['product_type_id'] = $this->input->post('product_type_id', true);
                $data['product_name'] = $this->input->post('product_name', true);
                $data['product_name_bangla'] = $this->input->post('product_name_bangla', true);
                $data['product_descrip'] = $this->input->post('product_descrip', true);
                $data['product_code'] = $this->input->post('product_code', true);
                $data['pack_size'] = $this->input->post('pack_size', true);
                $data['total_pack_size'] = $this->input->post('total_pack_size', true);
                $data['packet'] = $this->input->post('packet', true);
                $data['product_segment'] = $this->input->post('product_segment', true);
                $data['price'] = $this->input->post('price', true);
                $data['entry_by'] = $this->session->userdata('user_name');
                $data['entry_date'] = date("Y-m-d");
                $data['image'] = $img;
                $data['product_status'] = $this->input->post('product_status', true);
                
                $data['barcode'] = $this->input->post('old_barcode', true);
                
                $this->query_model->updateProductData($data);

                $sdata = array();
                $sdata['message'] = 'Successfully update';
                $this->session->set_userdata($sdata);
                //redirect('edit-product/'.$data['product_id']);
                $this->edit_product_form($data['product_id']);
            } else {
            
                if ($_FILES['image']['size'] <= 10000000) {
    //           10000000
               
                //file extension
                $fileExt = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                
                if ($fileExt == 'jpg' || $fileExt == 'png'){
                    
                    //file size
                    $file = $_FILES["image"]['tmp_name'];
                    list($width, $height) = getimagesize($file);
                    
                    if($width <= "1000" || $height <= "1000"){
                        $path = "./".$this->input->post('old_image', TRUE);
                        unlink($path);
                        $result = $this->do_upload('image');
                        if ($result['upload_data']) {
                            
                            $img = '/assets/images/products/' . $result['upload_data']['file_name'];
                            $data['product_id'] = $this->input->post('product_id', true);
                            $data['product_type_id'] = $this->input->post('product_type_id', true);
                            $data['product_name'] = $this->input->post('product_name', true);
                            $data['product_name_bangla'] = $this->input->post('product_name_bangla', true);
                            $data['product_descrip'] = $this->input->post('product_descrip', true);
                            $data['product_code'] = $this->input->post('product_code', true);
                            $data['pack_size'] = $this->input->post('pack_size', true);
                            $data['price'] = $this->input->post('price', true);
                            $data['entry_by'] = $this->session->userdata('user_name');
                            $data['entry_date'] = date("Y-m-d");
                            $data['image'] = $img;
                            $data['product_status'] = $this->input->post('product_status', true);
                            
                            $data['barcode'] = $this->input->post('old_barcode', true);
                            
                            $this->query_model->updateProductData($data);

                            $sdata = array();
                            $sdata['message'] = 'Successfully Updated';
                            $this->session->set_userdata($sdata);
                            $this->edit_product_form($data['product_id']);
                        }
                    }else{
                        $data['product_id'] = $this->input->post('product_id', true);
                        $sdata = array();
                        $sdata['message'] = 'Image size will be (400 x 400)';
                        $this->session->set_userdata($sdata);
                        $this->edit_product_form($data['product_id']);
                    }
                }else{
                    $data['product_id'] = $this->input->post('product_id', true);
                    $sdata = array();
                    $sdata['message'] = 'Select an image (jpg/png)';
                    $this->session->set_userdata($sdata);
                    $this->edit_product_form($data['product_id']);
                }
            }else{
                $data['product_id'] = $this->input->post('product_id', true);
                $sdata = array();
                $sdata['message'] = 'Select an image in size less than 1MB';
                $this->session->set_userdata($sdata);
                $this->edit_product_form($data['product_id']);
            }
            }
        }else{
            $data['product_id'] = $this->input->post('product_id', true);
            $sdata = array();
            $sdata['message'] = 'Try';
            $this->session->set_userdata($sdata);
            //redirect('edit-product/'.$data['product_id']);
            $this->edit_product_form($data['product_id']);
        }
    }
    
    
    public function update_product_type()
    {
        
        $this->form_validation->set_rules('product_type_name', 'Product Type', 'required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        $product_type_id = $this->input->post('product_type_id', true);
        
        if($this->form_validation->run()){
            $this->query_model->updateProductTypeData();
            
            $sdata = array();
            $sdata['message'] = 'Successfully Updated';
            $this->session->set_userdata($sdata);
            $this->edit_product_type_form_view($product_type_id);
        } else {
            $this->edit_product_type_form_view($product_type_id);
        }
    }
    
    public function delete_product_type($id){
        $this->query_model->delete_product_type($id);
        $sdata = array();
        $sdata['message'] = 'Successfully deleted';
        $this->session->set_userdata($sdata);
        $this->product_type();
    }
    public function delete_stock_in($id){
        $this->query_model->delete_stock_in($id);
        $sdata = array();
        $sdata['message'] = 'Successfully deleted';
        $this->session->set_userdata($sdata);
        $this->stock_in_form();
    }
    
    public function delete_product($id){
        $imgPath = $this->query_model->single_product($id);
        $path = "./".$imgPath->image;
        $barcode = "./".$imgPath->barcode;
        unlink($path);
        unlink($barcode);
        
        $this->query_model->delete_product($id);
        $sdata = array();
        $sdata['message'] = 'Successfully deleted';
        $this->session->set_userdata($sdata);
        redirect('products');
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